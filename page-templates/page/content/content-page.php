<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Revolution
 * @since Revolution 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( ! is_page_template( 'page-templates/front-page.php' ) ) : ?>
			<?php the_post_thumbnail(); ?>
			<?php endif; ?>
			<h2 class="entry-title"><?php the_title(); ?></h2>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'text-domain' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<!-- <footer class="entry-meta">
			<?php //edit_post_link( __( 'Edit', 'text-domain' ), '<span class="edit-link">', '</span>' ); ?>
		</footer> --><!-- .entry-meta -->
		
	</article><!-- #post -->
