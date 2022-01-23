<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
global $product;
$sizes = $product->get_attributes( 'pa_size' );

global $wp_query; 
$post_id = $wp_query->get_queried_object_id();
?>

<div id="main" class="wrapper">
    <div class="page-title mearch-filter">
        <div class="full-container">
            <?php echo (!empty(get_the_title( get_option( 'woocommerce_shop_page_id' ) )) ? '<h2>'.get_the_title( get_option( 'woocommerce_shop_page_id' ) ).'</h2>' : ''); ?>
            <div class="filter-inner">
                <form>
					<?php
						$terms = get_terms( 'pa_size', array(
							'hide_empty' => true,
						) );
						//debug($terms);
						if(is_array($terms) && !empty($terms)) :
					?>
						<select id="size" class="event-type-select">
							<?php if(get_field('size_filter_label','option')) : ?>
								<option value=""><?php the_field('size_filter_label','option'); ?></option>
							<?php endif; ?>
							<?php foreach($terms as $term) : ?>
								<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
							<?php endforeach; ?>
						</select>
					<?php endif; ?>
                    <select id="price" class="event-type-select">
                        <?php if(get_field('price_filter_label','option')) : ?>
							<option value=""><?php the_field('price_filter_label','option'); ?></option>
						<?php endif; ?>
                        <option value="low">Low - High</option>
						<option value="high">High - Low</option>
                    </select>
					<?php
						$artists = get_terms( 'artist', array(
							'hide_empty' => true,
						) );
						//debug($artists);
						if(is_array($artists) && !empty($artists)) :
					?>
						<select id="collection" class="event-type-select">
							<?php if(get_field('collection_filter_label','option')) : ?>
								<option value=""><?php the_field('collection_filter_label','option'); ?></option>
							<?php endif; ?>
							<?php foreach($artists as $artist) : ?>
								<option value="<?php echo $artist->term_id; ?>"><?php echo $artist->name; ?></option>
							<?php endforeach; ?>
						</select>
					<?php endif; ?>
                </form>
                
                <ul class="mobile-filter">
                	<li class="filter-inner">
                		<figure style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/filter.svg);"></figure>
						<form>
							<?php
							$terms = get_terms( 'pa_size', array(
							'hide_empty' => true,
							) );
							//debug($terms);
							if(is_array($terms) && !empty($terms)) :
							?>
							<select id="mobile-size" class="mobile-event-type-select">
								<?php if(get_field('size_filter_label','option')) : ?>
								<option value=""><?php the_field('size_filter_label','option'); ?></option>
								<?php endif; ?>
								<?php foreach($terms as $term) : ?>
								<option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
								<?php endforeach; ?>
							</select>
							<?php endif; ?>
							<select id="mobile-price" class="mobile-event-type-select">
								 <?php if(get_field('price_filter_label','option')) : ?>
									<option value=""><?php the_field('price_filter_label','option'); ?></option>
								<?php endif; ?>
								<option value="low">Low - High</option>
								<option value="high">High - Low</option>
							</select>
							<?php
							$artists = get_terms( 'artist', array(
							'hide_empty' => true,
							) );
							//debug($artists);
							if(is_array($artists) && !empty($artists)) :
							?>
							<select id="mobile-collection" class="mobile-event-type-select">
								<?php if(get_field('collection_filter_label','option')) : ?>
									<option value=""><?php the_field('collection_filter_label','option'); ?></option>
								<?php endif; ?>
								<?php foreach($artists as $artist) : ?>
								<option value="<?php echo $artist->term_id; ?>"><?php echo $artist->name; ?></option>
								<?php endforeach; ?>
							</select>
							<?php endif; ?>
						</form>
                	</li>
                	<li class="search-toggle"><a href="#" title="" class="search-icon icon-search"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <section class="mearch-main">
        <div class="full-container d-flex">
		<ul class="artist-details" id="merch-listings"></ul>
			<div class="load-more-btn">
                <?php //if($load_more_button_label) : ?>
    				<div style="display:none;" class="load-more bg-gradient" id="loadmore">LOAD MORE</div>
    			<?php //endif; ?>
    			<div class="loader-icon">
                    <figure id="blogLoader" style="display:none;">    					
    					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/product-loader.svg"  alt="preloader"  />
    			    </figure>
                </div>
            </div>
            
        </div>
    </section>



</div>

<?php
get_footer( 'shop' );
