<?php
/**
 * Contains Header HTML for switching tabs.
 *
 * This template can be overridden by copying it to yourtheme/templates/easy-login-woocommerce/global/xoo-el-header.php.
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

$register_args 	= $args['forms']['register'];
$form_active 	= $args['form_active'];

?>

<div class="xoo-el-header">
	<ul class="xoo-el-tabs">
		<?php if(get_field('login_tab_text','option')) : ?>
		<li data-tab="login" class="xoo-el-login-tgr"><?php _e( the_field('login_tab_text','option'), 'easy-login-woocommerce' ); ?></li>
		<?php endif; ?>
		<?php if( isset( $register_args['enable'] ) && $register_args['enable'] === "yes" ): ?> 
			<?php if(get_field('register_tab_text','option')) : ?>
			<li data-tab="register" class="xoo-el-reg-tgr"><?php _e( the_field('register_tab_text','option'), 'easy-login-woocommerce' ); ?></li>
		<?php endif; 
		endif; ?>

	</ul>
</div>