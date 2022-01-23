<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>
	<section class="product-slider">
        <div class="full-container">
		<?php if(get_field('related_products_heading', 'option')) : ?>
			<?php the_field('related_products_heading', 'option'); ?>
		<?php endif; ?>
            <div class="product-main">
                <?php global $post;
				$related_products = get_posts( 
				  array( 
				  'category__in' => wp_get_post_categories( $post->ID ), 
				  'numberposts'  => 4, 
				  'post__not_in' => array( $post->ID ),
				  'post_type'    => 'product'
				  ) 
				); 
				if($related_products) :
				foreach ( $related_products as $post ) : 
						
						setup_postdata($post); 
						$thumbnail = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'medium' );
						$product = wc_get_product( get_the_ID() );
						$permalink = get_the_permalink(get_the_ID());
						$title = get_the_title();
						$price = get_post_meta( get_the_ID(), '_price', true);
						?>
						<div class="product-details">
							<a href="<?php echo $permalink; ?>" title="<?php echo $title; ?>"><figure class="bg-set filter" style="background-image: url(<?php echo $thumbnail; ?>)"></figure>
							<h6><?php echo $title; ?></h6>
							<p><?php echo $product->get_price_html(); ?></p></a>
						</div> 
				<?php endforeach; 
				endif;
				?>

            </div>
        </div>
    </section>
	<?php
endif;

wp_reset_postdata();
