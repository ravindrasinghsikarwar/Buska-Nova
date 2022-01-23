<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/templates/easy-login-woocommerce/global/xoo-el-login-section.php
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 * @see     https://docs.xootix.com/easy-login-woocommerce/
 * @version 2.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$redirect 	= xoo_el_helper()->get_general_option( 'm-red-login' );
$redirect 	= !empty( $redirect ) ? $redirect : sanitize_text_field( $_SERVER['REQUEST_URI'] );

$fields = array(
	'xoo-el-username' => array(
		'input_type' 		=> 'text',
		'icon' 				=> 'far fa-user',
		'placeholder' 		=> __( 'Your Email', 'easy-login-woocommerce' ),
		'cont_class' 		=> array( 'xoo-aff-grou' ),
		'required' 			=> 'no',
		'autocomplete' => 'email'
	),

	'xoo-el-password' => array(
		'input_type' 	=> 'password',
		'icon' 			=> 'fas fa-key',
		'placeholder' 	=> __( 'Password', 'easy-login-woocommerce' ),
		'cont_class' 	=> array( 'xoo-aff-grou' ),
		'required' 		=> 'no'
	),
);

$fields = apply_filters( 'xoo_el_login_fields', $fields, $args );

foreach ( $fields as $field_id => $field_args ) {
	xoo_el()->aff->fields->get_input_html( $field_id, $field_args );
}

?>


<?php do_action( 'xoo_el_login_add_fields', $args ); ?>

<input type="hidden" name="_xoo_el_form" value="login">
<?php if(get_field('login_button_text','option')) : ?>
<button type="submit" class="button btn xoo-el-action-btn xoo-el-login-btn" <?php if( !xoo_el_is_limit_login_ok() ) echo "disabled"; ?>><?php _e(the_field('login_button_text','option'),'easy-login-woocommerce'); ?></button>
<?php endif; ?>
<input type="hidden" name="xoo_el_redirect" value="<?php echo esc_url( $redirect ); ?>">

<?php if(get_field('signup_button_text','option')) : ?>
	<span id="signup-bottom-link"><?php echo do_shortcode('[xoo_el_action type="register" display="link" text="'.get_field('signup_button_text','option').'" change_to="hide" redirect_to="same"]'); ?></span>
	<?php endif; 
	if(get_field('forgot_password_label','option')) : ?>
	<span id="forgot-bottom-link"><?php echo do_shortcode('[xoo_el_action type="lost-password" display="link" text="'.get_field('forgot_password_label','option').'" change_to="hide" redirect_to="same"]'); ?></span>
<?php 
endif; 