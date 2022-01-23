<?php 
/* Start Your Customization here*/
add_action('xoo_el_before_header', 'customize_login_heading');
function customize_login_heading() {
	if(get_field('heading','option')) : ?>
		<div class="heading-popup-text woo-login-popup-sc-show"><?php echo the_field('heading','option'); ?></div>
	<?php 
	endif; 
}

//add_action('xoo_el_after_form', 'customize_login_footer');
function customize_login_footer() {
	if(get_field('login_button_text','option')) : ?>
	<span id="login-link"><?php echo do_shortcode('[xoo_el_action type="login" display="link" text="'.the_field('login_button_text','option').'" change_to="hide" redirect_to="same"]'); ?></span>
	<?php endif; if(get_field('signup_button_text','option')) : ?>
	<span id="signup-link"><?php echo do_shortcode('[xoo_el_action type="register" display="link" text="'.the_field('signup_button_text','option').'" change_to="hide" redirect_to="same"]'); ?></span>
	<?php endif; if(get_field('forgot_password_label','option')) : ?>
	<span id="forgot-link"><?php echo do_shortcode('[xoo_el_action type="lost-password" display="link" text="'.the_field('forgot_password_label','option').'" change_to="hide" redirect_to="same"]'); ?></span>
	<?php 
	endif; 
}

//modify login popup
remove_action( 'woo_login_popup_sc_modal', 'woo_login_popup_sc_login' );
add_action( 'woo_login_popup_sc_modal', 'woo_login_popup_sc_login_new' );
function woo_login_popup_sc_login_new( $visible ){ ?>

	<div id="woo-login-popup-sc-login" class="woo-login-popup-sc <?php echo ( $visible == 'login' ) ? 'woo-login-popup-sc-show' : '';?> ">
		<?php if(get_field('heading','option')) : ?>
			<?php echo the_field('heading','option'); ?>
		<?php endif; ?>

		<form method="post" class="login">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php (!empty(get_field('email_placeholder','option')) ? the_field('email_placeholder','option') : ''); ?>" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</p>
			<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php (!empty(get_field('password_placeholder','option')) ? the_field('password_placeholder','option') : ''); ?>" type="password" name="password" id="password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( (!empty(get_field('login_button_text','option')) ? the_field('login_button_text','option') : ''), 'woo-login-popup-shortcodes' ); ?>" />
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<?php if( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) :?>
					<a href="#woo-login-popup-sc-register" class="woo-login-popup-sc-toggle"><?php (!empty(get_field('signup_label','option')) ? the_field('signup_label','option') : ''); ?></a>
				<?php endif;?>
				<a href="#woo-login-popup-sc-password" class="woo-login-popup-sc-toggle"><?php (!empty(get_field('forgot_password_label','option')) ? the_field('forgot_password_label','option') : ''); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
	</div>

<?php }

//register popup modification
remove_action( 'woo_login_popup_sc_modal', 'woo_login_popup_sc_register' );
add_action( 'woo_login_popup_sc_modal', 'woo_login_popup_sc_register_new' );
function woo_login_popup_sc_register_new( $visible ){
	if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
		<div id="woo-login-popup-sc-register" class="woo-login-popup-sc <?php echo ( $visible == 'register' ) ? 'woo-login-popup-sc-show' : '';?>">

			<?php if(get_field('heading','option')) : ?>
				<?php echo the_field('heading','option'); ?>
			<?php endif; ?>

			<form method="post" class="register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
						<label for="reg_username"><?php _e( 'Username', 'woo-login-popup-shortcodes' ); ?> <span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</p>

				<?php endif; ?>

				<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php (!empty(get_field('email_field_placeholder','option')) ? the_field('email_field_placeholder','option') : ''); ?>" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
						<input type="password" maxlength="20" minlength="6" placeholder="<?php (!empty(get_field('password_field_placeholder','option')) ? the_field('password_field_placeholder','option') : ''); ?>" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" />
					</p>
					
					<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
						<input type="password" placeholder="<?php (!empty(get_field('confirm_password_field_placeholder','option')) ? the_field('confirm_password_field_placeholder','option') : ''); ?>" class="woocommerce-Input woocommerce-Input--text input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
					</p>
					<p>
						<label>
							<input type="checkbox" name="mc4wp-subscribe" value="1" checked="checked" />
							<span><?php (!empty(get_field('subscribe_text','option')) ? the_field('subscribe_text','option') : ''); ?></span>	</label>
					</p>


				<?php endif; ?>

				<!-- Spam Trap -->
				<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woo-login-popup-shortcodes' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>

				<p class="woocomerce-FormRow form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<input type="submit" class="woocommerce-Button button" name="register" value="<?php (!empty(get_field('signup_label','option')) ? the_field('signup_label','option') : ''); ?>" />
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

				<p class="woocommerce-plogin">
					<a href="#woo-login-popup-sc-login" class="woo-login-popup-sc-toggle"><?php (!empty(get_field('signin_label','option')) ? the_field('signin_label','option') : ''); ?></a> <a href="#woo-login-popup-sc-password" class="woo-login-popup-sc-toggle"><?php _e( 'FORGOT PASSWORD?', 'woo-login-popup-shortcodes' ); ?></a>
				</p>

			</form>
		</div>
<?php
	endif;
}

//modify reset password form popup
remove_action( 'woo_login_popup_sc_modal', 'woo_login_popup_sc_password' );
add_action( 'woo_login_popup_sc_modal', 'woo_login_popup_sc_register_new_forgot' );
function woo_login_popup_sc_register_new_forgot( $visible ){ ?>

	<div id="woo-login-popup-sc-password" class="woo-login-popup-sc <?php echo ( $visible == 'password' ) ? 'woo-login-popup-sc-show' : '';?>">
		<?php if(!empty(get_field('forgot_password_heading','option'))) { ?>
		<h5><?php the_field('forgot_password_heading','option'); ?></h5>
		<?php } ?>
		
		<div class="lost-pass-success" style="display:none">
			<div class="woocommerce-message" role="alert">
				<p>Password reset email has been sent.</p>
				<span class="close-button">X</span>
			</div>


		<p>A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.</p>

		</div>

		<form method="post" class="woocommerce-ResetPassword lost_reset_password">

		<p><?php echo apply_filters( 'woocommerce_lost_password_message', __( (!empty(get_field('forgot_password_description','option')) ? the_field('forgot_password_description','option') : ''), 'woo-login-popup-shortcodes' ) ); ?></p>

		<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
			<input class="woocommerce-Input woocommerce-Input--text input-text" type="email" name="user_login" id="user_login" placeholder="<?php (!empty(get_field('forgot_placeholder_text','option')) ? the_field('forgot_placeholder_text','option') : ''); ?>" />
		</p>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_lostpassword_form' ); ?>

		<p class="woocommerce-FormRow form-row">
			<input type="hidden" name="wc_reset_password" value="true" />
			<input type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( (!empty(get_field('forgot_button_text','option')) ? the_field('forgot_button_text','option') : ''), 'woo-login-popup-shortcodes' ); ?>" />
		</p>
		<p class="woocommerce-plogin">
			<a href="#woo-login-popup-sc-login" class="woo-login-popup-sc-toggle"><?php _e( (!empty(get_field('signin_label','option')) ? the_field('signin_label','option') : ''), 'woo-login-popup-shortcodes' ); ?></a>
			<?php if( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) :?>
			 <a href="#woo-login-popup-sc-register" class="woo-login-popup-sc-toggle"><?php _e( (!empty(get_field('signup_label','option')) ? the_field('signup_label','option') : ''), 'woo-login-popup-shortcodes' ); ?></a>
			<?php endif; ?>
		</p>

		<?php wp_nonce_field( 'lost_password' ); ?>

	</form>
	</div>

<?php }

//validate confirm password field
function woocommerce_registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}
add_filter('woocommerce_registration_errors', 'woocommerce_registration_errors_validation', 10, 3);

/**
 * Hide the term description in the artist edit form
 */
add_action( "artist_edit_form", function( $tag, $taxonomy )
{ 
    ?><style>.term-description-wrap{display:none;}</style><?php
}, 10, 2 );



//change cart total text
add_filter( 'gettext', 'change_cart_totals_text', 20, 3 );
function change_cart_totals_text( $translated, $text, $domain ) {
    if( is_cart() && $translated == 'Cart totals' ){
        $translated = __('ORDER INFO', 'woocommerce');
    }
    return $translated;
}

add_filter( 'woocommerce_product_variation_title_include_attributes', 'variation_title_not_include_attributes' );
function variation_title_not_include_attributes( $boolean ){
    if ( ! is_cart() )
        $boolean = false;
    return $boolean;
}

add_filter( 'woocommerce_is_attribute_in_product_name', 'remove_attribute_in_product_name' );
function remove_attribute_in_product_name( $boolean){
    if ( ! is_cart() )
        $boolean = false;
    return $boolean;
}

//Remove the quantity from the product title:
add_filter( 'woocommerce_checkout_cart_item_quantity', 'remove_product_variation_qty_from_title', 10, 3 );
function remove_product_variation_qty_from_title( $quantity_html, $cart_item, $cart_item_key ){
    if ( $cart_item['data']->is_type('variation') && is_checkout() )
        $quantity_html = '';

    return $quantity_html;
}

//Add back the cart item quantity in a separate row:
add_filter( 'woocommerce_get_item_data', 'filter_get_item_data', 10, 2 );
function filter_get_item_data( $item_data, $cart_item ) {

    if ( $cart_item['data']->is_type('variation') && is_checkout() )
        $item_data[] = array(
            'key'      => __('QTY'),
            'display'  => $cart_item['quantity']
        );

    return $item_data;
}

add_filter('woocommerce_cart_item_remove_link', 'remove_icon_and_add_text', 10, 2);

function remove_icon_and_add_text($string, $cart_item_key) {
    $string = str_replace('class="remove"', '', $string);
    return str_replace('&times;', 'Remove from cart', $string);
}

//shortcode for my account page
function loggedin_shortcode(){
    if (is_user_logged_in()){
        echo do_shortcode('[woocommerce_my_account]');
    }elseif(isset($_GET['show-reset-form'])) {
		echo do_shortcode('[woocommerce_my_account]');
	}else{
        echo do_shortcode('[woo-login-popup]');
    }       
}

add_shortcode('myaccountShortcode', 'loggedin_shortcode');


//shortcode for donation login page
function donation_loggedin_shortcode(){
    if (is_user_logged_in()){ ?>
		<div class="donation-box-login">
        <?php echo do_shortcode('[wc_woo_donation id="385"]'); ?>
		</div>
    <?php }else{ ?>
		
	<div class="form-main" id="artist-popup">
		<?php if( get_field('heading_popup', 'option') ) { the_field('heading_popup', 'option'); } ?>
		<ul>
			<?php if( get_field('login_tab_text', 'option') ) : ?>
				<li><a href="#woo-login-popup-sc-login" class="woo-login-popup-sc-toggle active" id="login-link" title="log in"><?php the_field('login_tab_text', 'option'); ?></a></li>
			<?php endif; ?>
			<?php if( get_field('register_tab_text', 'option') ) : ?>
				<li><a href="#woo-login-popup-sc-register" class="woo-login-popup-sc-toggle" id="signup-link" title="sign in"><?php the_field('register_tab_text', 'option'); ?></a></li>
			<?php endif; ?>
		</ul>

		<div class="popup-form">
			<?php echo do_shortcode('[woo-login-popup]'); ?>
		</div>
	</div>
    <?php }       
}

add_shortcode('donationShortcode', 'donation_loggedin_shortcode');


/**
 * Opening div for our content wrapper
 */
add_action('woocommerce_before_main_content', 'iconic_open_div', 5);

function iconic_open_div() {
    echo '<div class="container">';
}

/**
 * Closing div for our content wrapper
 */
add_action('woocommerce_after_main_content', 'iconic_close_div', 50);

function iconic_close_div() {
    echo '</div>';
}

//remove additional information tab, review tab from single product page
add_filter( 'woocommerce_product_tabs', 'buska_remove_product_tabs', 9999 );
  
function buska_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
	unset( $tabs['reviews'] );
	unset( $tabs['description'] );
    return $tabs;
}

//disable order notes from checkout page
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );

// Auto uncheck "Ship to a different address"
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

/**

* @ snippet         Hide the Company Name Field from the Checkout Page

*/

add_filter( 'woocommerce_checkout_fields' , 'remove_company_name' );

function remove_company_name( $fields ) {

     unset($fields['billing']['billing_company']);
	 unset($fields['billing']['billing_address_2']);
	 unset($fields['shipping']['shipping_company']);
	 unset($fields['shipping']['shipping_address_2']);
     return $fields;

}

//change place order button text
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); 

function woo_custom_order_button_text() {
	$title = 'checkout('.get_woocommerce_currency_symbol().WC()->cart->total.')';
    return __( $title, 'woocommerce' ); 
}

// Change WooCommerce "Related products" text

add_filter('gettext', 'change_rp_text', 10, 3);
add_filter('ngettext', 'change_rp_text', 10, 3);

function change_rp_text($translated, $text, $domain)
{
     if ($text === 'Related products' && $domain === 'woocommerce') {
		 $new_text = "Other Merch that You Might Like.";
         $translated = $new_text;
     }
     return $translated;
}

// add amount label on product quantity
add_action( 'woocommerce_before_add_to_cart_quantity', 'wp_echo_qty_front_add_cart' );
 
function wp_echo_qty_front_add_cart() {
	echo '<div class="main-quantity">';
 echo '<div class="qty">AMOUNT </div>'; 

}

add_action( 'woocommerce_after_add_to_cart_quantity', 'wp_echo_qty_front_add_cart_end' );
 
function wp_echo_qty_front_add_cart_end() {
	echo '</div>'; 

}

/**
 * @snippet       Remove add to cart from shop loop item
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

//remove sale icon from products
add_filter('woocommerce_sale_flash', 'lw_hide_sale_flash');
function lw_hide_sale_flash()
{
return false;
}

//custom recipients emails
add_filter( 'woocommerce_email_recipient_new_order', 'custom_email_recipient_new_order', 10, 2 );
function custom_email_recipient_new_order( $recipient, $order ) {
	global $wp;
	if(is_array($order) && !empty($order)) : 
		// Loop through order items
		foreach ( $order->get_items() as $item ) {
			$product_id   = $item->get_product_id();
			$term_obj_lists = get_the_terms( $product_id, 'artist' );
			$variation_id = $item->get_variation_id();
			if( is_array($term_obj_lists) && !empty($term_obj_lists) ) {
				foreach($term_obj_lists as $term) {
					$email = get_field('email_address', $term->taxonomy . '_' . $term->term_id); //get artist email address
					$recipient .= ',' . $email;
				}
			}
		}
		return $recipient;
	endif;
}

//disable downloads page from my account section

function custom_my_account_menu_items( $items ) {
    unset($items['downloads']);
    return $items;
}
add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );


//move variation price from bottom to top
add_action( 'woocommerce_before_single_product', 'move_variations_single_price', 1 );
function move_variations_single_price(){
    global $product, $post;

    if ( $product->is_type( 'variable' ) ) {
        // removing the variations price for variable products
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

        // Change location and inserting back the variations price
        add_action( 'woocommerce_single_product_summary', 'replace_variation_single_price', 10 );
    }
}

function replace_variation_single_price(){
    global $product;

    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'From: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice && $product->is_on_sale() ) {
        $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
    }

    ?>
    <style>
        div.woocommerce-variation-price,
        div.woocommerce-variation-availability,
        div.hidden-variable-price {
            height: 0px !important;
            overflow:hidden;
            position:relative;
            line-height: 0px !important;
            font-size: 0% !important;
        }
    </style>
    <script>
    jQuery(document).ready(function($) {
		
        $('select').change(function(){
			setTimeout(function() {
				if( '' != $('input.variation_id').val() ){
					if($('p.availability'))
						$('p.availability').remove();
					var availability = $('div.woocommerce-variation-availability').html();
					if (availability == null){
						availability = '';
					}
					setTimeout(function() {
						$('p.price').html($('div.woocommerce-variation-price > span.price').html()).append('<p class="availability">'+availability+'</p>');
					}, 500);
					//console.log($('input.variation_id').val());
				} else {
					$('p.price').html($('div.hidden-variable-price').html());
					if($('p.availability'))
						$('p.availability').remove();
					//console.log('NULL');
				}
			}, 500);
        });
		
    });
    </script>
    <?php

    echo '<p class="price">'.$price.'</p>
    <div class="hidden-variable-price" >'.$price.'</div>';
}


// define the shipping message for shopping outside of AUS or NZ 
function custom_woocommerce_before_shipping_calculator(){ 
	$shipping_info = ( !empty(get_field('shipping_info_text', 'option') )) ? the_field('shipping_info_text', 'option') : '';
	echo $shipping_info;
} 

//add the action 
add_action('woocommerce_before_shipping_calculator', 'custom_woocommerce_before_shipping_calculator');
add_action( 'woocommerce_checkout_before_order_review', 'custom_woocommerce_before_shipping_calculator' );

//cart count filter
add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments){
    ob_start();
    $items_count = WC()->cart->get_cart_contents_count();
    ?>
    <div id="mini-cart-count"><?php echo $items_count ? $items_count : '0'; ?></div>
    <?php
        $fragments['#mini-cart-count'] = ob_get_clean();
    return $fragments;
}


//redirect to homepage after logout from my account page
function wpdocs_redirect_after_logout() {
 
     $current_user   = wp_get_current_user();
     $role_name      = $current_user->roles[0];
 
     if ( 'customer' === $role_name ) {
         wp_redirect( home_url() );
         exit;
     } 
 
 }
 add_action( 'wp_logout', 'wpdocs_redirect_after_logout' );


//redirect add payment method page to 404
function my_page_template_redirect() {
	$url = $_SERVER["REQUEST_URI"];

	$isItBlog = strpos($url, 'add-payment-method');
	$isItBlogNew = strpos($url, 'ppcp-paypal-payment-tokens');

	if ($isItBlog!==false || $isItBlogNew!==false)
	{
		 global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 ); exit();
	}

}
add_action( 'template_redirect', 'my_page_template_redirect' );

//Disable Password Strength Meter In WooCommerce 
function webroom_wc_remove_password_strength() {
if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {
    wp_dequeue_script( 'wc-password-strength-meter' );
  }
} 
add_action( 'wp_print_scripts', 'webroom_wc_remove_password_strength', 100 );



//Validate popup register form
function xoo_cu_el_validate_registeration_fields( $validation_error, $username, $password, $email ){
	if ( empty( $_POST['xoo_el_reg_email'] ) ) {
		$validation_error->add( 'user-email-register-error', "Error: Email is required!"  );
	}
	if ( empty( $_POST['xoo_el_reg_pass'] ) ) {
		$validation_error->add( 'user-password-register-error', "Error: Please enter an account password."  );
	}
	if ( $_POST['xoo_el_reg_pass'] !== $_POST['xoo_el_reg_pass_again'] ) {
		$validation_error->add( 'user-confirm-password-register-error', "Error: Passwords do not match."  );
	}
	return $validation_error;
}
add_filter( 'xoo_el_process_registration_errors', 'xoo_cu_el_validate_registeration_fields', 10, 4 );


//Validate email address field on popup login
function xoo_cu_el_validate_login_fields( $validation_error, $creds ){
	if ( empty( $creds['user_login'] ) ) {
		$validation_error->add( 'user-login-error', "Email is required!"  );
	}
	if (!filter_var($creds['user_login'], FILTER_VALIDATE_EMAIL)) //<--recommend option
    {
       $validation_error->add( 'user-login-error', "Email is invalid."  );
    }
	if ( empty( $creds['user_password'] ) ) {
		//$string_with_shortcodes = "The password you entered for the email address ".$creds['user_login']." is incorrect. ".do_shortcode('[xoo_el_action type="lost-password" display="link" text="Lost your password?" change_to="hide" redirect_to="same"]')."";
		$validation_error->add( 'user-password-error', 'Password is required.' );
	}
	
	//Check if user exists in WordPress database
    $user = get_user_by('email', $creds['user_login']);

    //bad email
    if(!$user){
		$validation_error->add( 'user-login-error', "Either the email or password you entered is invalid."  );
    }
    else{ //check password
        if(!wp_check_password($creds['user_password'], $user->user_pass, $user->ID)){ //bad password
            $validation_error->add( 'user-password-error', "Either the email or password you entered is invalid."  );
        }
    }
	return $validation_error;
}
add_filter( 'xoo_el_process_login_errors', 'xoo_cu_el_validate_login_fields', 10, 4 );



// define the woocommerce_process_login_errors callback 
function filter_woocommerce_process_login_errors_new($validation_error, $post_username, $post_password)
{
    //if (strpos($post_username, '@') == FALSE)
    if (empty($post_username)) //<--recommend option
    {
        throw new Exception( '<strong>' . __( 'Error', 'woocommerce' ) . ':</strong> ' . __( 'Email is required.', 'woocommerce' ) );
    }
	if (!filter_var($post_username, FILTER_VALIDATE_EMAIL)) //<--recommend option
    {
       throw new Exception( '<strong>' . __( 'Error', 'woocommerce' ) . ':</strong> ' . __( 'Email is invalid.', 'woocommerce' ) );
    }
	if ( empty($post_password)) //<--recommend option
    {
		//$link = '<a href="#woo-login-popup-sc-password" class="woo-login-popup-sc-toggle">Lost your password?</a>';
		//$string_with_shortcodes = "The password you entered for the email address ".$post_username." is incorrect.".$link."";
        throw new Exception( '<strong>' . __( 'Error', 'woocommerce' ) . ':</strong> ' . __( 'Password is required.', 'woocommerce' ) );
    }
	//Check if user exists in WordPress database
    $user = get_user_by('email', $post_username);
	//debug($user);
    //bad email
    if(!$user){
        throw new Exception( '<strong>' . __( 'Error', 'woocommerce' ) . ':</strong> ' . __( 'Either the email or password you entered is invalid.', 'woocommerce' ) );
    }
    else{ //check password
        if(!wp_check_password($post_password, $user->user_pass, $user->ID)){ //bad password
            throw new Exception( '<strong>' . __( 'Error', 'woocommerce' ) . ':</strong> ' . __( 'Either the email or password you entered is invalid.', 'woocommerce' ) );
        }
    }
	return $validation_error;

}

// add the filter 
add_filter('woocommerce_process_login_errors', 'filter_woocommerce_process_login_errors_new', 10, 3);

//override error messages
add_filter('woocommerce_add_error', 'change_email_error');
function change_email_error( $message ) {
    if ($message == 'Enter a username or email address.' ) {
        $message = 'Enter a valid email address.';
    }
    if ($message == 'Invalid username or email.' ) {
        $message = 'Invalid email address.';
    }
    return $message;
}

//registration validation hook
add_filter( 'woocommerce_process_registration_errors', 'process_registration_errors' );

function process_registration_errors( $errors ) {

   if ( isset( $_POST['email'] ) && empty( $_POST['email'] ) ) {
		$errors->add( 'email_error',
		__( 'Email is required!', 'woocommerce' ) );
   }
   return $errors;
}

//set min length for phone number
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields )
{        
     $fields['billing']['billing_phone']['custom_attributes'] = array( "type" => "number", "minlength" => "10", "maxlength" => "10" );      
     return $fields;    
}

function ple_hook_javascript() {
	if(get_field('donation_description', 'option')) {
  ?>
  <script>
  var desc = "<?php echo '<div class="donation-tip">'. get_field('donation_description', 'option').'</div>' ?>";
  // Your JavaScript code goes here...
  jQuery(document).ready(function() {
		if ($(".in-action-elements").length > 0) {
			$( ".row2" ).before( desc );
		}
	});
  </script>
  <?php
	}
}

add_action( 'wp_footer', 'ple_hook_javascript' );


//disable paypal from my account
add_filter('woocommerce_account_menu_items', 'misha_remove_my_account_links', 50);

function misha_remove_my_account_links($menu_links)
{

    unset($menu_links['ppcp-paypal-payment-tokens']);

    return $menu_links;
}

?>