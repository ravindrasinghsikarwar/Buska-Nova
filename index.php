<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Revolution
 * @since Revolution 1.0
 */

get_header(); 
global $wp_query; 
$post_id = $wp_query->get_queried_object_id();
$mobile_view_image = get_field( "mobile_view_image", $post_id );
$load_more_button_label = get_field( "load_more_button_label", $post_id );
?>
<div id="main" class="wrapper">
    <div class="page-title"><div class="full-container"><?php echo (!empty(get_the_title( $post_id )) ? '<h2>'.get_the_title( $post_id ).'</h2>' : ''); ?></div></div>
    <div class="blog-main">
        <div class="home-recent-blog">
            <div class="blog-inner aos-init aos-animate" data-aos="fade-up" data-aos-anchor-placement="top" data-aos-delay="0">
                                <ul class="mobile-filter">
                    <li class="search-toggle closed"><a href="#" title="" class="search-icon icon-search"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg"></a></li>
                </ul>
                <?php echo (!empty(get_the_title( get_the_ID() )) ? '<h2>'.get_the_title( $post_id ).'</h2>' : ''); ?>
				<?php if($mobile_view_image) : ?>
					<figure><img src="<?php echo $mobile_view_image; ?>" alt="<?php echo get_the_title( $post_id ); ?>"></figure>
				<?php endif; ?>
			</div>          
        </div>
    </div>
    <section class="blog-inside">
        <div class="container blog-innner">
			<div class="row" id="blog-listings"></div>
			<div class="load-more-btn">
                <?php if($load_more_button_label) : ?>
    				<div  style="display:none;" class="load-more bg-gradient" id="loadmore"><?php echo $load_more_button_label; ?></div>
    			<?php endif; ?>
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
