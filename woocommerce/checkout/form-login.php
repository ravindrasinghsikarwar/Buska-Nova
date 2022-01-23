<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>
<div class="form-main checkout-login" id="artist-popup">
	<ul>
		<li><a href="#woo-login-popup-sc-login" class="woo-login-popup-sc-toggle active" id="login-link" title="log in">I HAVE AN ACCOUNT</a></li>
		<li><a href="#woo-login-popup-sc-register" class="woo-login-popup-sc-toggle" id="signup-link" title="sign in">I AM A NEWBIE</a></li>
	</ul>
	<div class="popup-form">
		<?php echo do_shortcode('[woo-login-popup]'); ?>
	</div>
</div>


