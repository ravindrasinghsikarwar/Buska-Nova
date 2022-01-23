<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Buska Nova
 */
/**********************
 *** Merch filter Script ***
 *********************/
add_action( 'wp_enqueue_scripts', 'merch_script_enqueuer' );
function merch_script_enqueuer() {
	$queried_object = get_queried_object(); 
	if(my_wp_is_mobile()):
		$postsPerPage = '6';
	else:
		$postsPerPage = '8';
	endif;
	$paged = '';
	$args = array(
		'post_type' => 'product',
		'post_status' => array('publish'),
		'order' => 'DESC',
		'orderby' => 'date',
		'posts_per_page' => $postsPerPage,
		'paged' => $paged,
		'meta_query' => array(
			array(
			  'key' => 'is_wc_donation',
			  'compare' => 'NOT EXISTS'
			)
		  ),
	);
	$products = new WP_Query($args);
	if( is_shop() ) :	
		wp_register_script( "merch-filter-script", get_template_directory_uri().'/assets/js/merch-filter.js', array(), true);
		wp_localize_script( 'merch-filter-script', 'merch_filter_ajax_params', array( 			
			'ajax_url' => admin_url( 'admin-ajax.php' ), // WordPress AJAX
			'posts' => json_encode($products->query_vars), // everything about your loop is here
			'current_page' => $products->get_query_var('paged') ? $products->get_query_var('paged') : 1,
			'max_page' => $products->max_num_pages,
		));     
		wp_enqueue_script( 'merch-filter-script' );
	endif;
	wp_reset_postdata();
}

add_action('wp_ajax_merchfilter', 'fn_merchs_filter');
add_action('wp_ajax_nopriv_merchfilter', 'fn_merchs_filter');
function fn_merchs_filter(){
	$query_data = $_REQUEST;
	$paged = ($query_data['paged']) ? $query_data['paged'] : 1;
	$size = ($query_data['size']) ? $query_data['size'] : '';
	$price = ($query_data['price']) ? $query_data['price'] : '';
	$collection = ($query_data['collection']) ? $query_data['collection'] : '';
	if(my_wp_is_mobile()):
		$postsPerPage = '6';
	else:
		$postsPerPage = '8';
	endif;
	if(!empty($size) && !empty($price) && !empty($collection)) {
		$order = ($price == 'low') ? 'ASC' : 'DESC';
		$args = array(
		'post_type' => 'product',
		'post_status' => array('publish'),
		'orderby' => 'meta_value_num',
		'meta_key' => '_price',
		'order' => $order,
		'posts_per_page' => $postsPerPage,
		'paged' => $paged,
		'meta_query' => array(
			array(
			  'key' => 'is_wc_donation',
			  'compare' => 'NOT EXISTS'
			)
		  ),
		'tax_query' => array(
			array(
				'taxonomy' => 'pa_size',
				'field'    => 'term_id',
				'terms'    => $size,
			),
			array(
				'taxonomy' => 'artist',
				'field'    => 'term_id',
				'terms'    => $collection,
			),
		),
	);
	} elseif(!empty($size) && !empty($price) && empty($collection)) {
		$order = ($price == 'low') ? 'ASC' : 'DESC';
		$args = array(
		'post_type' => 'product',
		'post_status' => array('publish'),
		'orderby' => 'meta_value_num',
		'meta_key' => '_price',
		'order' => $order,
		'posts_per_page' => $postsPerPage,
		'paged' => $paged,
		'meta_query' => array(
			array(
			  'key' => 'is_wc_donation',
			  'compare' => 'NOT EXISTS'
			)
		  ),
		'tax_query' => array(
			array(
				'taxonomy' => 'pa_size',
				'field'    => 'term_id',
				'terms'    => $size,
			),
		),
	);
	} elseif(!empty($size) && empty($price) && !empty($collection)) {
		$order = ($price == 'low') ? 'ASC' : 'DESC';
		$args = array(
		'post_type' => 'product',
		'post_status' => array('publish'),
		'order' => 'DESC',
		'orderby' => 'date',
		'posts_per_page' => $postsPerPage,
		'paged' => $paged,
		'meta_query' => array(
			array(
			  'key' => 'is_wc_donation',
			  'compare' => 'NOT EXISTS'
			)
		  ),
		'tax_query' => array(
			array(
				'taxonomy' => 'pa_size',
				'field'    => 'term_id',
				'terms'    => $size,
			),
			array(
				'taxonomy' => 'artist',
				'field'    => 'term_id',
				'terms'    => $collection,
			),
		),
	);
	} elseif(empty($size) && !empty($price) && !empty($collection)) {
		$order = ($price == 'low') ? 'ASC' : 'DESC';
		$args = array(
		'post_type' => 'product',
		'post_status' => array('publish'),
		'orderby' => 'meta_value_num',
		'meta_key' => '_price',
		'order' => $order,
		'posts_per_page' => $postsPerPage,
		'paged' => $paged,
		'meta_query' => array(
			array(
			  'key' => 'is_wc_donation',
			  'compare' => 'NOT EXISTS'
			)
		  ),
		'tax_query' => array(
			array(
				'taxonomy' => 'artist',
				'field'    => 'term_id',
				'terms'    => $collection,
			),
		),
	);
	} elseif(!empty($size) && empty($price) && empty($collection)) {
		$order = ($price == 'low') ? 'ASC' : 'DESC';
		$args = array(
		'post_type' => 'product',
		'post_status' => array('publish'),
		'order' => 'DESC',
		'orderby' => 'date',
		'posts_per_page' => $postsPerPage,
		'paged' => $paged,
		'meta_query' => array(
			array(
			  'key' => 'is_wc_donation',
			  'compare' => 'NOT EXISTS'
			)
		  ),
		'tax_query' => array(
			array(
				'taxonomy' => 'pa_size',
				'field'    => 'term_id',
				'terms'    => $size,
			),
		),
	);
	} elseif(empty($size) && !empty($price) && empty($collection)) {
			$order = ($price == 'low') ? 'ASC' : 'DESC';
			$args = array(
			'post_type' => 'product',
			'post_status' => array('publish'),
			'orderby' => 'meta_value_num',
			'meta_key' => '_price',
			'order' => $order,
			'posts_per_page' => $postsPerPage,
			'paged' => $paged,
			'meta_query' => array(
				array(
				  'key' => 'is_wc_donation',
				  'compare' => 'NOT EXISTS'
				)
			  ),
		);
	} elseif(empty($size) && empty($price) && !empty($collection)) {
			$order = ($price == 'low') ? 'ASC' : 'DESC';
			$args = array(
			'post_type' => 'product',
			'post_status' => array('publish'),
			'order' => 'DESC',
			'orderby' => 'date',
			'posts_per_page' => $postsPerPage,
			'paged' => $paged,
			'meta_query' => array(
				array(
				  'key' => 'is_wc_donation',
				  'compare' => 'NOT EXISTS'
				)
			 ),
			 'tax_query' => array(
				array(
					'taxonomy' => 'artist',
					'field'    => 'term_id',
					'terms'    => $collection,
				),
			),
		);
	} else {
		$args = array(
			'post_type' => 'product',
			'post_status' => array('publish'),
			'order' => 'DESC',
			'orderby' => 'date',
			'posts_per_page' => $postsPerPage,
			'paged' => $paged,
			'meta_query' => array(
				array(
				  'key' => 'is_wc_donation',
				  'compare' => 'NOT EXISTS'
				)
			  ),
		);
	}
	//$dataPost = $postsPerPage * $paged;
	//echo '<pre>'; print_r($args); echo '</pre>';
	$products = new WP_Query($args);
	//debug($products);
			if($products->have_posts()): 
				while ($products->have_posts()) : $products->the_post();
						$blogID = $products->post->ID;
						$featureURL = get_the_post_thumbnail_url($blogID);
						$product = wc_get_product( $blogID );
		
				?>
						<li class="merch-details" data-total="<?php echo $products->found_posts; ?>" data-post="<?php echo $postsPerPage; ?>">
							<a href="<?php echo get_permalink( $blogID ); ?>" title="<?php echo get_the_title($blogID); ?>"><figure class="bg-set" style="background-image: url(<?php echo $featureURL; ?>)"></figure><h6><?php echo get_the_title($blogID); ?></h6><p><?php echo $product->get_price_html(); ?></p></a>
						</li>
					<?php 
				endwhile; 
				wp_reset_postdata();
		else:
			echo '<div class="noData" id="no-data-found">There are no more products available.</div>';
		endif;
		wp_die();
}