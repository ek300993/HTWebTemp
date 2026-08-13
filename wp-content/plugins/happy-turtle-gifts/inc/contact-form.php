<?php
/**
 * The inquiry form.
 *
 * Four fields — email, phone, what they're after, and a message — posted to
 * admin-post.php and emailed on. It lives in the plugin rather than the theme so
 * it survives a re-theme, and it is deliberately small: a full form plugin
 * (Fluent Forms, WPForms) is still the right answer the day file uploads,
 * conditional fields or a stored record of every inquiry are wanted. This covers
 * the one job the site can't launch without.
 *
 * What it does about spam: a nonce, a honeypot field that only a bot fills in,
 * and a per-address rate limit. No captcha — those cost every real visitor
 * something to stop a problem this site doesn't have yet. If the inbox does
 * start filling up, that's the moment for a form plugin with proper filtering.
 *
 * Delivery is wp_mail(), which hands off to PHP mail() unless something else is
 * configured. On a lot of shared hosting that lands in spam or vanishes, so an
 * SMTP plugin is worth setting up at launch — see the README.
 *
 * @package HappyTurtleGifts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Where inquiries are sent.
 *
 * Settings → General → "Gift basket inquiries", falling back to the site admin
 * address so the form can never silently post into a void.
 *
 * @return string
 */
function happy_turtle_contact_recipient() {

	$address = get_option( 'happy_turtle_contact_email' );

	if ( ! is_email( $address ) ) {
		$address = get_option( 'admin_email' );
	}

	/**
	 * Filter the address inquiries are delivered to.
	 *
	 * @param string $address Email address.
	 */
	return apply_filters( 'happy_turtle_contact_recipient', $address );
}


/**
 * The options in the "What are you after?" menu.
 *
 * Built from the Occasions taxonomy so the form follows the site rather than
 * drifting from it, with two catch-alls appended for the things an occasion
 * doesn't cover.
 *
 * @return array<string,string> value => label
 */
function happy_turtle_contact_request_types() {

	$types = array();

	$terms = get_terms(
		array(
			'taxonomy'   => 'basket_occasion',
			'hide_empty' => false,
			'orderby'    => 'term_id',
		)
	);

	if ( ! is_wp_error( $terms ) ) {
		foreach ( $terms as $term ) {
			$types[ $term->slug ] = $term->name;
		}
	}

	$types['individual-item'] = __( 'An individual item (mug, onesie, sweatshirt…)', 'happy-turtle-gifts' );
	$types['bulk']            = __( 'Bulk or corporate gifting', 'happy-turtle-gifts' );
	$types['other']           = __( 'Something else', 'happy-turtle-gifts' );

	return $types;
}


/**
 * Render the inquiry form.
 *
 * Used as [happy_turtle_contact_form], which is what sits in the contact
 * pattern. A shortcode rather than a block: it can be moved, duplicated or
 * dropped into any page or widget without a build step, and it degrades to
 * visible-but-harmless text if the plugin is ever deactivated.
 *
 * @return string
 */
function happy_turtle_contact_form() {

	$types  = happy_turtle_contact_request_types();
	$status = isset( $_GET['ht_contact'] ) ? sanitize_key( wp_unslash( $_GET['ht_contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- read-only status flag from our own redirect.

	$messages = array(
		'sent'      => array( 'ht-form__note--good', __( 'Thank you — your message is on its way. I’ll come back to you shortly.', 'happy-turtle-gifts' ) ),
		'invalid'   => array( 'ht-form__note--bad', __( 'Something in the form wasn’t quite right. Please check your email address and message and try again.', 'happy-turtle-gifts' ) ),
		'throttled' => array( 'ht-form__note--bad', __( 'That’s a few messages in a short space of time. Please give it a few minutes, or email me directly.', 'happy-turtle-gifts' ) ),
		'failed'    => array( 'ht-form__note--bad', __( 'Sorry — the message couldn’t be sent just now. Please email me directly and I’ll pick it up there.', 'happy-turtle-gifts' ) ),
	);

	ob_start();

	if ( isset( $messages[ $status ] ) ) {
		printf(
			'<p class="ht-form__note %1$s" role="status">%2$s</p>',
			esc_attr( $messages[ $status ][0] ),
			esc_html( $messages[ $status ][1] )
		);
	}

	?>
	<form class="ht-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">

		<input type="hidden" name="action" value="happy_turtle_contact">
		<input type="hidden" name="ht_return" value="<?php echo esc_url( get_permalink() ); ?>">
		<?php wp_nonce_field( 'happy_turtle_contact', 'ht_nonce' ); ?>

		<p class="ht-form__field">
			<label for="ht-email"><?php esc_html_e( 'Your email', 'happy-turtle-gifts' ); ?> <span class="ht-form__req" aria-hidden="true">*</span></label>
			<input type="email" id="ht-email" name="ht_email" autocomplete="email" required>
		</p>

		<p class="ht-form__field">
			<label for="ht-phone"><?php esc_html_e( 'Phone number', 'happy-turtle-gifts' ); ?></label>
			<input type="tel" id="ht-phone" name="ht_phone" autocomplete="tel" aria-describedby="ht-phone-hint">
			<span class="ht-form__hint" id="ht-phone-hint"><?php esc_html_e( 'Optional — handy if a quick call is easier than typing.', 'happy-turtle-gifts' ); ?></span>
		</p>

		<p class="ht-form__field">
			<label for="ht-type"><?php esc_html_e( 'What are you after?', 'happy-turtle-gifts' ); ?> <span class="ht-form__req" aria-hidden="true">*</span></label>
			<select id="ht-type" name="ht_type" required>
				<option value=""><?php esc_html_e( 'Choose one…', 'happy-turtle-gifts' ); ?></option>
				<?php foreach ( $types as $value => $label ) : ?>
					<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>

		<p class="ht-form__field">
			<label for="ht-message"><?php esc_html_e( 'A little about it', 'happy-turtle-gifts' ); ?> <span class="ht-form__req" aria-hidden="true">*</span></label>
			<textarea id="ht-message" name="ht_message" rows="5" required aria-describedby="ht-message-hint"></textarea>
			<span class="ht-form__hint" id="ht-message-hint"><?php esc_html_e( 'Who it’s for, the occasion, roughly when you need it, and a budget if you have one in mind.', 'happy-turtle-gifts' ); ?></span>
		</p>

		<?php /* Honeypot. Hidden from people, irresistible to bots. */ ?>
		<p class="ht-form__pot" aria-hidden="true">
			<label for="ht-website"><?php esc_html_e( 'Leave this field empty', 'happy-turtle-gifts' ); ?></label>
			<input type="text" id="ht-website" name="ht_website" tabindex="-1" autocomplete="off">
		</p>

		<p class="ht-form__actions">
			<button type="submit" class="wp-element-button"><?php esc_html_e( 'Send it over', 'happy-turtle-gifts' ); ?></button>
		</p>

	</form>
	<?php

	return (string) ob_get_clean();
}
add_shortcode( 'happy_turtle_contact_form', 'happy_turtle_contact_form' );


/**
 * Send the visitor back where they came from with a status flag.
 *
 * @param string $status One of sent, invalid, throttled, failed.
 * @param string $return Page to go back to.
 */
function happy_turtle_contact_bounce( $status, $return ) {

	$url = $return ? $return : home_url( '/' );

	wp_safe_redirect( add_query_arg( 'ht_contact', $status, $url ) . '#order-form' );
	exit;
}


/**
 * Handle a submitted inquiry.
 */
function happy_turtle_contact_submit() {

	$return = isset( $_POST['ht_return'] ) ? esc_url_raw( wp_unslash( $_POST['ht_return'] ) ) : '';

	// Only accept a return address on this site — the field is attacker-controlled.
	if ( ! $return || 0 !== strpos( $return, home_url() ) ) {
		$return = home_url( '/' );
	}

	if ( ! isset( $_POST['ht_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['ht_nonce'] ) ), 'happy_turtle_contact' ) ) {
		happy_turtle_contact_bounce( 'invalid', $return );
	}

	/*
	 * The honeypot is filled in, so this is a bot. Report success rather than an
	 * error: an error tells whoever wrote the bot what to fix.
	 */
	if ( ! empty( $_POST['ht_website'] ) ) {
		happy_turtle_contact_bounce( 'sent', $return );
	}

	$email   = isset( $_POST['ht_email'] ) ? sanitize_email( wp_unslash( $_POST['ht_email'] ) ) : '';
	$phone   = isset( $_POST['ht_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['ht_phone'] ) ) : '';
	$type    = isset( $_POST['ht_type'] ) ? sanitize_key( wp_unslash( $_POST['ht_type'] ) ) : '';
	$message = isset( $_POST['ht_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['ht_message'] ) ) : '';

	$types = happy_turtle_contact_request_types();

	if ( ! is_email( $email ) || ! isset( $types[ $type ] ) || strlen( trim( $message ) ) < 5 ) {
		happy_turtle_contact_bounce( 'invalid', $return );
	}

	// Three in fifteen minutes from one address is plenty for a real inquiry.
	$key   = 'ht_contact_' . md5( $email );
	$count = (int) get_transient( $key );

	if ( $count >= 3 ) {
		happy_turtle_contact_bounce( 'throttled', $return );
	}

	set_transient( $key, $count + 1, 15 * MINUTE_IN_SECONDS );

	$subject = sprintf(
		/* translators: %s: the kind of inquiry, e.g. New Baby. */
		__( 'Website inquiry — %s', 'happy-turtle-gifts' ),
		$types[ $type ]
	);

	$body = implode(
		"\n",
		array(
			__( 'A new inquiry from the website.', 'happy-turtle-gifts' ),
			'',
			__( 'Email:', 'happy-turtle-gifts' ) . ' ' . $email,
			__( 'Phone:', 'happy-turtle-gifts' ) . ' ' . ( $phone ? $phone : __( 'not given', 'happy-turtle-gifts' ) ),
			__( 'Looking for:', 'happy-turtle-gifts' ) . ' ' . $types[ $type ],
			'',
			__( 'Message:', 'happy-turtle-gifts' ),
			$message,
			'',
			'---',
			/* translators: %s: the page the form was submitted from. */
			sprintf( __( 'Sent from %s', 'happy-turtle-gifts' ), $return ),
		)
	);

	$sent = wp_mail(
		happy_turtle_contact_recipient(),
		wp_specialchars_decode( $subject, ENT_QUOTES ),
		$body,
		array(
			'Content-Type: text/plain; charset=UTF-8',
			'Reply-To: ' . $email,
		)
	);

	happy_turtle_contact_bounce( $sent ? 'sent' : 'failed', $return );
}
add_action( 'admin_post_nopriv_happy_turtle_contact', 'happy_turtle_contact_submit' );
add_action( 'admin_post_happy_turtle_contact', 'happy_turtle_contact_submit' );


/**
 * A place to set the inquiry address without editing code.
 *
 * Settings → General, under the site's own email address, because that is where
 * someone goes looking for it.
 */
function happy_turtle_contact_setting() {

	register_setting(
		'general',
		'happy_turtle_contact_email',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_email',
			'default'           => '',
			'show_in_rest'      => false,
		)
	);

	add_settings_field(
		'happy_turtle_contact_email',
		__( 'Gift basket inquiries', 'happy-turtle-gifts' ),
		'happy_turtle_contact_setting_field',
		'general',
		'default'
	);
}
add_action( 'admin_init', 'happy_turtle_contact_setting' );


/**
 * Render the settings field.
 */
function happy_turtle_contact_setting_field() {
	?>
	<input type="email" class="regular-text ltr" name="happy_turtle_contact_email" id="happy_turtle_contact_email"
		value="<?php echo esc_attr( (string) get_option( 'happy_turtle_contact_email' ) ); ?>">
	<p class="description">
		<?php
		printf(
			/* translators: %s: the address currently receiving inquiries. */
			esc_html__( 'Where the inquiry form on the Contact page delivers. Currently going to %s.', 'happy-turtle-gifts' ),
			'<code>' . esc_html( happy_turtle_contact_recipient() ) . '</code>'
		);
		?>
	</p>
	<?php
}
