<?php 
/* Start Your Customization here*/

/*****************************************************
 * Add image size instruction in post named post type
 */
function buska_masonry_add_featured_image_html( $html ) {
	$post_type = get_current_screen()->post_type;
	if ( $post_type == 'post' ) {
		$html .= '<p>Recommended image size should be <b>600px X 650px</b>.<br> Please upload the optimized image, should be in KBs.</p>';
	} elseif ( $post_type == 'event' ) {
		$html .= '<p>Recommended image size should be <b>560px X 660px</b>.<br> Please upload the optimized image, should be in KBs.</p>';
	} elseif ( $post_type == 'product' ) {
		$html .= '<p>Recommended image size should be <b>586px X 586px</b>.<br> Please upload the optimized image, should be in KBs.</p>';
	}
    return $html;
}
add_filter( 'admin_post_thumbnail_html', 'buska_masonry_add_featured_image_html');

//fixed multiple repeating error messages on contact form 7

add_action( 'wp_footer', 'prevent_cf7_multiple_emails' );

function prevent_cf7_multiple_emails() {
?>

	<script type="text/javascript">
	var disableSubmit = false; 
	var wpcf7Elm = document.querySelector( '.wpcf7' );
	
	if (wpcf7Elm) {
		wpcf7Elm.addEventListener( 'wpcf7_before_send_mail', function( event ) {
			//jQuery(':input[type="submit"]').attr('value',"Sent");
			disableSubmit = false;
		}, false );
		
		wpcf7Elm.addEventListener( 'wpcf7mailsent', function( event ) {
			//jQuery(':input[type="submit"]').attr('value',"Sent");
			disableSubmit = false;
		}, false );

		wpcf7Elm.addEventListener( 'wpcf7invalid', function( event ) {
			jQuery(':input[type="submit"]').attr('value',"Submit")
			disableSubmit = false;
		}, false );
	}
	</script>
	<?php
}

//disable gutenberg
add_filter('use_block_editor_for_post_type', '__return_false');

//hide content editor for page post type
add_action('init', 'init_remove_support',100);
function init_remove_support(){
    $post_type = 'page';
    remove_post_type_support( $post_type, 'editor');
}


//disable style tab from admin for popup plugin
function custom_admin_js() {
    $url = get_bloginfo('template_directory') . '/assets/js/wp-admin.js';
    echo '"<script type="text/javascript" src="'. $url . '"></script>"';
}

add_action('admin_footer', 'custom_admin_js');

//pass phone number to mailchimp list from contact form 7
add_filter( 'mc4wp_integration_contact-form-7_subscriber_data', function( MC4WP_MailChimp_Subscriber $subscriber ) {
    if(isset($_POST['phone']) && !empty($_POST['phone'])) {
		$subscriber->merge_fields[ "PHONE" ] = sanitize_text_field( $_POST['phone'] );
	}
	if(isset($_POST['phone-number']) && !empty($_POST['phone-number'])) {
		$subscriber->merge_fields[ "PHONE" ] = sanitize_text_field( $_POST['phone-number'] );
	}
    return $subscriber;
});



?>