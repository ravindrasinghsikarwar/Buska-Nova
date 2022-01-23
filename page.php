<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Revolution
 * @since Revolution 1.0
 */

get_header(); 
global $wp_query; 
$post_id = $wp_query->get_queried_object_id();
$show_page_header = get_field( "show_page_header", $post_id );
$author_id = get_post_field( 'post_author', $post_id );
$post_date = get_post_field( 'post_date', $post_id );
$day = date("jS", strtotime($post_date));
$month = date("F", strtotime($post_date));
$image = get_the_post_thumbnail_url($post_id,'full');
?>

<div id="main" class="wrapper">
	<?php if ( $show_page_header == '1' ) : ?>
		<section class="about-main artist-banner">
			<div class="container d-flex">
				<div class="artist-banner-img column-6">
				<?php if($image) : ?>
					<figure class="bg-set filter" style="background-image: url(<?php echo $image; ?>);"></figure>
				<?php endif; ?>
				</div>
				<div class="counter-sec column-6">
					<div class="mobile-title">
						<?php echo (!empty(get_the_title( get_the_ID() )) ? '<h2>'.get_the_title( $post_id ).'</h2>' : ''); ?>
						<p><?php if(get_the_author_meta( 'nicename', $author_id )): ?>by <?php echo get_the_author_meta( 'nicename', $author_id ); ?>,<?php endif; ?> <?php if(!empty($day) && !empty($month)): ?><?php echo $day; ?> of <?php echo $month; ?><?php endif; ?></p>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php 
		/*======================================================
		 *       PAGE HEADER OR BANNER SECTION 
		 *====================================================== */
			
		//get_template_part( 'page-templates/page/page', 'header' ); 
			
	?>
	<?php
	// ID of the current item in the WordPress Loop
	$id = get_the_ID();
	
	// check if the flexible content field has rows of data
	if ( have_rows( 'flexible_layouts', $id ) ) :

		// loop through the selected ACF layouts and display the matching partial
		while ( have_rows( 'flexible_layouts', $id ) ) : the_row();

			get_template_part( 'flexible-layouts/' . get_row_layout() );

		endwhile;

	endif;
	?>
</div><!-- #main .wrapper -->
<?php get_footer(); ?>
