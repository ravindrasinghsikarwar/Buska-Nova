<?php
/**
 * The template for displaying page with right side bar
 */

get_header(); ?>


	<div class="right-sidebar-layout">
		<div class="row">			
			<div class="col-sm-9">
				<div class="site-content">
					<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'page-templates/page/content/content', 'page' ); ?>
					<?php endwhile; // end of the loop. ?>
				</div><!-- .site-content -->
			</div><!-- .col-sm-9 -->			
			<div class="col-sm-3">
				<?php get_sidebar(); ?>
			</div>
		</div><!--.#row -->
	</div>
