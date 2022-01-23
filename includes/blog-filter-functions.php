<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Buska Nova
 */
/**********************
 *** Blog filter Script ***
 *********************/
add_action( 'wp_enqueue_scripts', 'blog_script_enqueuer' );
function blog_script_enqueuer() {
	$queried_object = get_queried_object(); 
	if(my_wp_is_mobile()):
		$postsPerPage = '5';
	else:
		$postsPerPage = '6';
	endif;
	$paged = '';
	$args = array(
		'post_status' => array('publish'),
		'order' => 'DESC',
		'orderby' => 'date',
		'posts_per_page' => $postsPerPage,
		'paged' => $paged,
	);
	$loop = new WP_Query($args);
		if(is_home()) : 
		
			wp_register_script( "blog-filter-script", get_template_directory_uri().'/assets/js/blog-filter.js', array(), true);
			wp_localize_script( 'blog-filter-script', 'blog_filter_ajax_params', array( 			
				'ajax_url' => admin_url( 'admin-ajax.php' ), // WordPress AJAX
				'posts' => json_encode($loop->query_vars), // everything about your loop is here
				'current_page' => $loop->get_query_var('paged') ? $loop->get_query_var('paged') : 1,
				'max_page' => $loop->max_num_pages,
			));     
			wp_enqueue_script( 'blog-filter-script' );
			
		endif;
	
	wp_reset_postdata();
}

add_action('wp_ajax_blogfilter', 'fn_blogs_filter');
add_action('wp_ajax_nopriv_blogfilter', 'fn_blogs_filter');
function fn_blogs_filter(){
	$query_data = $_REQUEST;
	$paged = ($query_data['paged']) ? $query_data['paged'] : 1;
	if(my_wp_is_mobile()):
		$postsPerPage = '5';
	else:
		$postsPerPage = '6';
	endif;
	
	$args = array(
		'post_status' => array('publish'),
		'order' => 'DESC',
		'orderby' => 'date',
		'posts_per_page' => $postsPerPage,
		'paged' => $paged,
	);

	//echo '<pre>'; print_r($args); echo '</pre>';
	$loop = new WP_Query($args);
	//debug($loop);
			if($loop->have_posts()):
				while ($loop->have_posts()) : $loop->the_post();
						$blogID = $loop->post->ID;
						$featureURL = get_the_post_thumbnail_url($blogID);
						$excerpt = get_the_excerpt($blogID);
						$author_id = $loop->post->post_author; 
						$post_date = $loop->post->post_date;
						$day = date("jS", strtotime($post_date));
						$month = date("F", strtotime($post_date));
		
				?>
						<div class="column-6 blog-details" data-total="<?php echo $loop->found_posts; ?>" data-post="<?php echo $postsPerPage; ?>">
							<a href="<?php echo get_permalink( $blogID ); ?>" title="">
								<figure class="bg-set" style="background-image: url(<?php echo $featureURL; ?>);"></figure>
								<div class="blog-content">
									<div class="blog-title-wrap">
										<?php echo (!empty(get_the_title($blogID)) ? '<h3>'.get_the_title($blogID).'</h3>' : ''); ?>
										<div class="date-inner"><div class="date-person"><?php if(get_the_author_meta( 'nicename', $author_id )): ?>by <?php echo get_the_author_meta( 'nicename', $author_id ); ?>,<?php endif; ?> <span class="blog=date"><?php if(!empty($day) && !empty($month)): ?><?php echo $day; ?> of <?php echo $month; ?><?php endif; ?></span></div></div>
									</div>
									<div class="text-blog"><?php echo (!empty($excerpt) ? '<p>'.$excerpt.'</p>' : ''); ?></div>
								</div>
							</a>
						</div>
					<?php 
				endwhile;
				wp_reset_postdata();
		else:
			echo '<div class="noData" id="no-data-found">There are no more blog post available.</div>';
		endif;
		wp_die();
}