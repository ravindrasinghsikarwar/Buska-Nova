<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.5
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post, $product, $woocommerce;
$version = '3.0';
?>
<link rel='owl-css' href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
<?php
	if ( has_post_thumbnail() ) 
	{
		if( version_compare( $woocommerce->version, $version, ">=" ) ) {
			$attachment_ids = $product->get_gallery_image_ids();
		}else{
			$attachment_ids = $product->get_gallery_attachment_ids();
		}
		array_unshift($attachment_ids, get_post_thumbnail_id($post->ID));
		//debug($attachment_ids);
	}


if(is_array($attachment_ids) && !empty($attachment_ids)) : ?>

<div class="images">
<div class="gallery-wrapper-section">
	
	<div id="sync1" class="owl-carousel">
	<?php foreach($attachment_ids as $attachment_id) : 
	$image_url = wp_get_attachment_url( $attachment_id )
	?>
	  <div class="item">
	  	<div class="tile" data-scale="2" data-image="<?php echo $image_url; ?>"></div>
	  </div>
	<?php endforeach; ?>
	  
	</div>
	


	<div id="sync2" class="owl-carousel">
	<?php foreach($attachment_ids as $p_id) : 
	$image_src = wp_get_attachment_image_src( $p_id, 'thumbnail' );
	?>
	  <div class="item">
	  	<div class="product-theme-image" style="background-image: url(<?php echo $image_src[0]; ?>);"></div>
	  </div>
	<?php endforeach; ?>  
	</div>

</div>
</div>
<?php endif; ?>