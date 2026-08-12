#!/usr/bin/env python3
"""Crawl the local WordPress site into a static mirror for GitHub Pages.

The Playground preview depends on a third-party service loading correctly in
whoever's browser. This produces a plain-HTML copy that can't fail that way:
it's just files. The editor and the order form obviously don't work in it —
it's for looking at, not for trying.

Absolute http://localhost:8080/ URLs are rewritten to /HTWebTemp/ because
GitHub Pages serves project sites under the repository name.
"""
import os
import re
import sys
from collections import deque
from pathlib import Path
from urllib.parse import urljoin, urlparse, unquote
from urllib.request import urlopen
from urllib.error import HTTPError, URLError

SRC = "http://localhost:8080"
BASE = "/HTWebTemp"                      # GitHub Pages project path

# Relative to the repository, not to whoever is running it — this has to work
# from a git worktree as well as from the main checkout. MIRROR_OUT overrides.
OUT = Path(os.environ.get("MIRROR_OUT") or Path(__file__).resolve().parent.parent / "docs")

SKIP = re.compile(r"/wp-admin|/wp-login|/wp-json|[?&]s=|/feed/?$|xmlrpc")
ASSET_EXT = re.compile(r"\.(css|js|jpe?g|png|gif|svg|webp|woff2?|ttf|eot|ico|mp4)$", re.I)

pages, assets, failed = {}, {}, []


def fetch(url):
    try:
        with urlopen(url, timeout=30) as r:
            return r.status, r.read(), r.headers.get_content_type()
    except HTTPError as e:
        return e.code, e.read(), e.headers.get_content_type()
    except (URLError, OSError) as e:
        failed.append((url, str(e)))
        return None, b"", ""


def local_path(url):
    """Map a site URL to a path inside the mirror."""
    p = unquote(urlparse(url).path)
    if p.endswith("/") or p == "":
        return (p.lstrip("/") + "index.html").lstrip("/") or "index.html"
    return p.lstrip("/")


def discover(html, base_url):
    """Return (page_links, asset_links) found in a document."""
    urls = set()
    for m in re.finditer(r'(?:href|src)=["\']([^"\']+)["\']', html):
        urls.add(m.group(1))
    # og:image and friends live in content=, but so does the viewport meta —
    # only take values that actually look like a URL.
    for m in re.finditer(r'content=["\']([^"\']+)["\']', html):
        v = m.group(1)
        if re.match(r'^(https?:)?//|^/[^/\s]|^\./', v) and " " not in v:
            urls.add(v)
    for m in re.finditer(r'srcset=["\']([^"\']+)["\']', html):
        for part in m.group(1).split(","):
            u = part.strip().split(" ")[0]
            if u:
                urls.add(u)
    for m in re.finditer(r'url\((["\']?)([^)"\']+)\1\)', html):
        urls.add(m.group(2))

    page_links, asset_links = set(), set()
    for u in urls:
        if u.startswith(("data:", "mailto:", "tel:", "#", "javascript:")):
            continue
        full = urljoin(base_url, u)
        if urlparse(full).netloc != urlparse(SRC).netloc:
            continue
        clean = full.split("#")[0]
        if SKIP.search(clean):
            continue
        if ASSET_EXT.search(urlparse(clean).path):
            asset_links.add(clean)
        elif clean.split("?")[0].rstrip("/") != "" or clean.endswith("/"):
            page_links.add(clean.split("?")[0])
    return page_links, asset_links


def rewrite(text):
    """Point every local URL at the Pages base path.

    Two kinds need handling. WordPress emits absolute URLs
    (http://localhost:8080/shop/), but the theme's own patterns hardcode
    root-relative ones (href="/shop/") — and those are the buttons and occasion
    tiles. Left alone they resolve to the domain root, not the project path,
    and 404.
    """
    text = text.replace(SRC + "/", BASE + "/")
    text = text.replace(SRC, BASE)

    # root-relative links and assets that aren't already under the base path
    text = re.sub(
        r'(href|src|action)=(["\'])/(?!' + re.escape(BASE.lstrip("/")) + r'/)(?!/)',
        r"\1=\2" + BASE + "/",
        text,
    )
    text = re.sub(
        r'url\((["\']?)/(?!' + re.escape(BASE.lstrip("/")) + r'/)(?!/)',
        r"url(\1" + BASE + "/",
        text,
    )

    # strip cache-busting query strings so the saved filenames resolve
    text = re.sub(r'(' + re.escape(BASE) + r'/[^"\'\s()]+?)\?[^"\'\s()>]*', r"\1", text)

    # Drop the <head> links pointing at things a static copy doesn't have —
    # RSS feeds, the REST API, xmlrpc. Invisible to a visitor, but they're dead
    # ends and there's no reason to ship them.
    text = re.sub(
        r'<link[^>]*href="[^"]*(?:/feed/|wp-json|xmlrpc)[^"]*"[^>]*/?>\s*',
        "", text, flags=re.I,
    )
    text = re.sub(r'<link[^>]*rel="EditURI"[^>]*/?>\s*', "", text, flags=re.I)
    return text


def main():
    # The basket archive is no longer linked from the homepage — Browse Baskets
    # took over that job — so the crawl has to be told about it, or it drops out
    # of the mirror while still being a live page.
    seeds = [f"{SRC}/", f"{SRC}/shop/"]
    seen = set()
    q = deque(seeds)

    while q:
        url = q.popleft()
        if url in seen:
            continue
        seen.add(url)
        status, body, ctype = fetch(url)
        if status is None or "html" not in ctype:
            continue
        html = body.decode("utf-8", "replace")
        pages[url] = html
        pl, al = discover(html, url)
        for a in al:
            assets.setdefault(a.split("?")[0], None)
        for p in pl:
            if p not in seen:
                q.append(p)

    # the 404 page has to be requested from a URL that doesn't exist
    s, b, c = fetch(f"{SRC}/__not_found__/")
    if b:
        pages["__404__"] = b.decode("utf-8", "replace")
        _, al = discover(pages["__404__"], SRC + "/")
        for a in al:
            assets.setdefault(a.split("?")[0], None)

    # Fetch the assets, following stylesheets into whatever they reference.
    #
    # A stylesheet can be the only place an image is named — the hero's narrow
    # layout swaps the picture with a CSS `background-image`, because CSS can't
    # change an <img> src. Discovering assets from HTML alone silently drops
    # those, and the miss doesn't show up until someone opens the static preview
    # on a phone and finds the hero empty. Keep going until a pass finds nothing
    # new; in practice that's two.
    pending = list(assets)
    while pending:
        found = set()
        for url in pending:
            s, b, c = fetch(url)
            if not b:
                continue
            assets[url] = b
            if urlparse(url).path.lower().endswith(".css"):
                _, nested = discover(b.decode("utf-8", "replace"), url)
                found |= {n.split("?")[0] for n in nested}
        pending = [u for u in found if u not in assets]
        for u in pending:
            assets.setdefault(u, None)

    # write everything out
    OUT.mkdir(parents=True, exist_ok=True)
    for url, html in pages.items():
        rel = "404.html" if url == "__404__" else local_path(url)
        dest = OUT / rel
        dest.parent.mkdir(parents=True, exist_ok=True)
        dest.write_text(rewrite(html), encoding="utf-8")

    for url, data in assets.items():
        if data is None:
            continue
        dest = OUT / local_path(url)
        dest.parent.mkdir(parents=True, exist_ok=True)
        if urlparse(url).path.lower().endswith((".css", ".js", ".svg")):
            dest.write_text(rewrite(data.decode("utf-8", "replace")), encoding="utf-8")
        else:
            dest.write_bytes(data)

    (OUT / ".nojekyll").write_text("")  # keep Pages from filtering _-prefixed dirs

    print(f"  pages : {len(pages)}")
    print(f"  assets: {sum(1 for v in assets.values() if v is not None)}")
    if failed:
        print(f"  failed: {len(failed)}")
        for u, e in failed[:5]:
            print(f"    {u} — {e}")
    for u in sorted(pages):
        print(f"    {'404.html' if u == '__404__' else local_path(u)}")


if __name__ == "__main__":
    main()
