<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Buska Nova
 */
/**********************
 *** Artist filter Script ***
 *********************/
add_action( 'wp_enqueue_scripts', 'artist_script_enqueuer' );
function artist_script_enqueuer() {

	if ( is_page_template( 'archive-artist.php' ) ) {	
		wp_register_script( "artist-filter-script", get_template_directory_uri().'/assets/js/artist-filter.js', array(), true);
		wp_localize_script( 'artist-filter-script', 'artist_filter_ajax_params', array( 			
			'ajax_url' => admin_url( 'admin-ajax.php' )
		));     
		wp_enqueue_script( 'artist-filter-script' );
	}
}

add_action('wp_ajax_artistfilter', 'fn_artists_filter');
add_action('wp_ajax_nopriv_artistfilter', 'fn_artists_filter');
function fn_artists_filter(){
	$query_data = $_REQUEST;
	$paged = ($query_data['paged']) ? $query_data['paged'] : 1;
	if(my_wp_is_mobile()):
		$postsPerPage = '8';
	else:
		$postsPerPage = '16';
	endif;
	
	$args = array(
		'taxonomy'  => 'artist',
		'number'    => $postsPerPage,
		'offset'    => ($paged - 1) * $postsPerPage,
		'orderby'   => 'date',
		'order'     => 'DESC',
		'hide_empty'    => false,
	);
	$total_terms = get_terms(array(
	'taxonomy' => 'artist',//i guess campaign_action  is your  taxonomy 
	'hide_empty' => false
	));
	
	$dataPost = $paged * $postsPerPage;
	//echo '<pre>'; print_r($args); echo '</pre>';
	$loop = new WP_Term_Query($args);
	//debug($loop);
		if(is_array($loop->terms) && !empty($loop->terms)):
			foreach ( $loop->terms as $term ) {
				$term_id = $term->term_id;
				$artist_title = $term->name;
				$thumbnail = get_field('artist_image', $term->taxonomy . '_' . $term->term_id);
				$music_type = get_field('music_type', $term->taxonomy . '_' . $term->term_id);
			?>
					<li class="ArtistcountData" data-totalpost="<?php echo count($total_terms); ?>" data-postpage="<?php echo $postsPerPage; ?>">
						<a href="<?php echo get_term_link($term->slug, 'artist'); ?>" title="<?php echo $artist_title; ?>">
						<figure class="bg-set" style="background-image: url(<?php echo $thumbnail; ?>);"></figure>
						<?php echo (!empty($artist_title) ? '<h6>'.$artist_title.'</h6>' : ''); ?><?php echo (!empty($music_type) ? '<p>'.$music_type.'</p>' : ''); ?></a>
					</li>
				<?php 
			}
		else:
			echo '<div class="noData" id="no-data-found">There are no more artist available.</div>';
		endif;
		wp_die();
}