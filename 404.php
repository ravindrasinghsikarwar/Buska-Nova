<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Revolution
 * @since Revolution 1.0
 */

get_header(); ?>

<div class="page-content-section d-flex flex-wrap justify-content-center align-center align-items-center page404-wrap">
	<div class="bg-image" style="background-color: #0D0D0D;"></div>
	<div class="container">
		<div id="content">
			<div class="main-con-sec error-main">

				<?php //logo_header(); ?>
				<?php if( get_field('header_logo', 'option') ): ?><img src="<?php the_field('header_logo', 'option'); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"><?php else: echo get_bloginfo( 'name' ); endif; ?>

				<h1 class="title-404 fadeInUp"><?php _e( '404', 'text-domain' ); ?></h1>
				
				<div class="content-404">
					<h3><?php _e( 'Page Not Found!', 'text-domain' ); ?></h3>
					<?php 
						if(!empty(options('msg_404_page'))):
							echo '<p>'.options('msg_404_page').'</p>'; 
						endif;
					?>
					<div class="orange-link">
						<a href="<?php echo site_url(); ?>" class="bg-gradient cta-button">Back to Home</a>
					</div>
				</div><!-- .entry-content -->
				
			</div>
		</div><!-- #content -->
	</div><!-- .container -->
</div>
<?php get_footer(); ?>
