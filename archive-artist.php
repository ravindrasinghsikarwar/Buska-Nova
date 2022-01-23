<?php /* Template Name: Archive artist */ 
get_header(); 
global $wp_query; 
$post_id = $wp_query->get_queried_object_id();
$post_title = get_the_title( $post_id );
?>

<div id="main" class="wrapper">
    <div class="listing-title page-title">
        <div class="full-container">
			<?php echo (!empty($post_title) ? '<h2>'.$post_title.'</h2>' : ''); ?>
        </div>
    </div>
    <section class="listing-inner">
        <div class="full-container">
            <ul class="artist-details" id="artist-details">

            </ul>
			<div class="load-more-btn">
				<div style="display:none;" class="load-more bg-gradient" id="loadmore">Load more</div>
    			<div class="loader-icon">
                    <figure id="blogLoader" style="display:none;">    					
    					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/product-loader.svg"  alt="preloader"  />
    			    </figure>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>