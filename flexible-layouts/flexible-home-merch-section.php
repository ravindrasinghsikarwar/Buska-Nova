<?php
include_once ( get_template_directory() . '/includes/Mobile_Detect.php');
$detect = new Mobile_Detect;
$section_heading = get_sub_field('heading');
$section_image = get_sub_field('image');
$merchentises = get_sub_field('select_products');
if(empty($merchentises)) : 
$merchentises = get_posts( array(
     'post_type'      => 'product',
     'posts_per_page' => 4,
     'orderby'        => 'date',
	 'order'		  => 'DESC',
     'post_status'    => 'publish'
) );
endif;
$button = get_sub_field('button');
$target = (!empty($button['target']) ? 'target="_blank"' : '');
if( !empty($section_heading) || !empty($section_image) || is_array($merchentises) && !empty($merchentises)) :
?>
<section class="merch-section">
    <div class="full-container d-flex">
        <div class="merch-innner" data-aos="fade-up" data-aos-anchor-placement="top" data-aos-delay="0">
			<?php if($section_image): ?>
            <figure><img src="<?php echo $section_image; ?>" alt="<?php echo $section_heading; ?>"></figure>
			<?php endif; ?>
            <?php echo (!empty($section_heading) ? '<h2>'.$section_heading.'</h2>' : ''); ?>
            <?php if(is_array($button) && !empty($button)): ?>
            <div class="view-all"><a href="<?php echo $button['url']; ?>" title="<?php echo $button['title']; ?>" class="bg-gradient" <?php echo $target; ?>><?php echo $button['title']; ?></a></div>
			<?php endif; ?>
        </div>
        <div class="merch-detail">
		<?php if(is_array($merchentises) && !empty($merchentises)): ?>
            <ul class="artist-details" data-aos="fade-up" data-aos-anchor-placement="top" data-aos-delay="0">
			<?php 
				$i=0;
				foreach($merchentises as $row) : 
					$product = wc_get_product( $row->ID );
					if ($product->is_type( 'simple' )) {
						$sale_price     =  $product->get_sale_price();
						$regular_price  =  $product->get_regular_price();
					}
					elseif($product->is_type('variable')){
						$sale_price     =  $product->get_variation_sale_price( 'min', true );
						$regular_price  =  $product->get_variation_regular_price( 'max', true );
					}
					$currency = get_woocommerce_currency_symbol();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID ), 'large' );
				?>
                <li><a href="<?php echo esc_url( get_permalink($row->ID) ); ?>" title="<?php echo $row->post_title; ?>"><figure class="bg-set" style="background-image: url(<?php echo (!empty($image[0]) ? $image[0] : ''); ?>"></figure><h6><?php echo $row->post_title; ?></h6><p><?php echo $currency; ?> <?php echo $sale_price; ?></p></a></li>
            <?php 
			$i++;
			if( $detect->isMobile() && !$detect->isTablet() ) {

				if($i==2) break;

			}
			endforeach; ?>               
			</ul>
		<?php endif; ?>
		<?php if(is_array($button) && !empty($button)) : ?>
			<div class="view-all"><a href="<?php echo $button['url']; ?>" title="<?php echo $button['title']; ?>" class="bg-gradient" <?php echo $target; ?>><?php echo $button['title']; ?></a></div>
        <?php endif; ?>
		</div>              
    </div>
</section>
<?php endif; ?>