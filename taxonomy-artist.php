<?php
/**
 * The Template for displaying Artist taxonomy
 */

get_header(); 

$term = get_queried_object();
// load thumbnail for this taxonomy term
$thumbnail = get_field('artist_image', $term->taxonomy . '_' . $term->term_id);
$music_type = get_field('music_type', $term->taxonomy . '_' . $term->term_id);
$description = term_description( $term->term_id, $term->taxonomy );
$args = array(
	'post_type' => 'event',
	'post_status' => 'publish',
	'meta_key' => 'event_date', //name of custom field
	'orderby' => 'meta_value_num', 
	'order' => 'ASC',
	'tax_query' => array(
		array(
		'taxonomy' => 'artist',
		'field' => 'term_id',
		'terms' => $term->term_id
		)
	 )
);
$events = get_posts($args);
//debug($events);
//social-media
$youtube = get_field('youtube_', $term->taxonomy . '_' . $term->term_id);
$instagram = get_field('instagram', $term->taxonomy . '_' . $term->term_id);
$tiktok = get_field('tiktok', $term->taxonomy . '_' . $term->term_id);

$donation_button_text = get_field('donation_button_text', $term->taxonomy . '_' . $term->term_id);
$donation_compaign_id = get_field('donation_compaign_id', $term->taxonomy . '_' . $term->term_id);
?>
<?php if($term): ?>
<div id="main" class="wrapper">
    <section class="artist-banner">
        <div class="container d-flex">
            <div class="counter-sec column-6">
				<?php if($events[0]) : 
					$event_date = get_field('event_date', $events[0]->ID);
					$date = str_replace('/', '-', $event_date);
				?>
					<?php if($date): ?><div class="show-date"><p><span><?php echo strtoupper(date("j", strtotime($date)) ); ?></span><?php echo strtoupper(date("M", strtotime($date)) ); ?></p></div><?php endif; ?>
				<?php endif; ?>
                <div class="mobile-title">
                	<?php echo (!empty($term->name) ? '<h2>'.$term->name.'</h2>' : ''); ?>
                	<?php echo (!empty($music_type) ? '<p>'.$music_type.'</p>' : ''); ?>
                </div>
				
				<div class="time-counter">
					<div id="date-counter">
						<?php 
						$event_start_time = get_field('event_start_time', $events[0]->ID);
						$time = date("H:i", strtotime($event_start_time));
						$time = substr($time, 0, strpos($time, ":"));

						$timestamp = strtotime(str_replace("/", "-", $event_date));
						$date_time = date("Y-m-d H:i:s", $timestamp);
						$new_time = date("M j, Y H:i:s", strtotime('+'.$time.' hours', strtotime($date_time)));
						//$final_date = date_format($new_time,"M j, Y H:i:s");
						?>	
						<script>
						var eventDate = '<?php echo $event_date; ?>';
						var eventTime = '<?php echo $new_time; ?>';

						// Set the date we're counting down to
						var countDownDate = new Date(eventTime).getTime();

						// Update the count down every 1 second
						var x = setInterval(function() {

						  // Get today's date and time
						  var now = new Date().getTime();

						  // Find the distance between now and the count down date
						  var distance = countDownDate - now;

						  // Time calculations for days, hours, minutes and seconds
						  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
						  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
						  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

						  // Display the result in the element with id="date-counter"
						  document.getElementById("date-counter").innerHTML = "<ul class='d-flex'><li>" + days + "<strong> Days</strong></li><li>" + hours + "<strong> Hours</strong></li><li>"
						  + minutes + "<strong> Mins</strong></li><li>" + seconds + "<strong> Secs</strong></li></ul>";

						  // If the count down is finished, write some text
						  if (distance < 0) {
							clearInterval(x);
							document.getElementById("date-counter").innerHTML = " ";
						  }
						}, 1000);
						</script>
					</div>
					<?php if($events[0]) : ?>
						<?php if(!empty($donation_button_text) && my_wp_is_mobile() == false && is_user_logged_in() == false) { ?>
							<a href="#donation-popup" title="donation11" class="open-popup-link bg-gradient"><?php echo $donation_button_text; ?></a>
						<?php } elseif(!empty($donation_button_text) && my_wp_is_mobile() == true && is_user_logged_in() == true) { ?>
							<a href="<?php echo site_url().'/donation'; ?>" title="donation" class="bg-gradient"><?php echo $donation_button_text; ?></a>
						<?php } elseif(!empty($donation_button_text) && my_wp_is_mobile() == false && is_user_logged_in() == true) { ?>
							<a href="#donation-popup" title="donation" class="open-popup-link bg-gradient"><?php echo $donation_button_text; ?></a>
						<?php } elseif(!empty($donation_button_text) && my_wp_is_mobile() == true && is_user_logged_in() == false) { ?>
							<a href="<?php echo site_url().'/donation'; ?>" title="donation" class="bg-gradient"><?php echo $donation_button_text; ?></a>
						<?php } ?>
					<?php endif; ?>
                </div>
            </div>

            <div class="artist-banner-img column-6"><figure class="bg-set filter" style="background-image: url(<?php echo $thumbnail; ?>);"></figure></div>
        </div>
    </section>
	<?php 
	$about_artist_section = get_field('about_artist_section', $term->taxonomy . '_' . $term->term_id);
	if(!empty($about_artist_section['left_section_heading']) || !empty($about_artist_section['right_section_heading']) || !empty($about_artist_section['right_section_heading'])): ?>
		<section class="about-band">
			<div class="container d-flex">
				<div class="band-title column-5">
					<?php echo (!empty($about_artist_section['left_section_heading']) ? '<h5>'.$about_artist_section['left_section_heading'].'</h5>' : ''); ?>
				</div>
				<div class="band-details column-7">
					<?php echo (!empty($about_artist_section['right_section_heading']) ? '<h4>'.$about_artist_section['right_section_heading'].'</h4>' : ''); ?>
					<?php echo $about_artist_section['right_section_description']; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<?php
	array_shift($events);
	if(is_array($events) && !empty($events)):
	foreach($events as $event) :
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'single-post-thumbnail' );
	$event_date = get_field( "event_date", $event->ID );
	$timestamp = strtotime(str_replace("/", "-", $event_date));
	$date_time = date("Y-m-d", $timestamp);
	$newDate = date("D j F", strtotime($date_time));  
	$event_start_time = get_field( "event_start_time", $event->ID );
	$event_end_time = get_field( "event_end_time", $event->ID );
	$donation_text = get_field( "donation_text", $event->ID );
	$donation_button_label = get_field( "donation_button_label", $event->ID );
	?>
    <section class="get-ticket-section">
        <div class="container d-flex">
            <div class="concert-details column-5">
                <?php echo (!empty($newDate) ? '<h5>'.$newDate.'</h5>' : ''); ?>
				<?php if($event_start_time && $event_end_time): ?>
                <p><?php echo $event_start_time; ?> - <?php echo $event_end_time; ?></p>
				<?php endif; ?>
                <?php echo (!empty($event->post_title) ? '<h4>'.$event->post_title.'</h4>' : ''); ?>
                <div class="concert-inner">
                	<?php echo (!empty($event->post_content) ? '<p>'.$event->post_content.'</p>' : ''); ?>
                	<figure class="content-img bg-set" style="background-image: url(<?php echo $image[0]; ?>);"></figure>
                	<?php if($donation_text) : ?>
						<h5><?php echo $donation_text; ?></h5>
					<?php endif; ?>
					<?php if(!empty($donation_button_label) && my_wp_is_mobile() == false && is_user_logged_in() == false) { ?>
						<a href="#donation-popup" title="donation11" class="open-popup-link bg-gradient"><?php echo $donation_button_text; ?></a>
					<?php } elseif(!empty($donation_button_label) && my_wp_is_mobile() == true && is_user_logged_in() == true) { ?>
						<a href="<?php echo site_url().'/donation'; ?>" title="donation" class="bg-gradient"><?php echo $donation_button_text; ?></a>
					<?php } elseif(!empty($donation_button_label) && my_wp_is_mobile() == false && is_user_logged_in() == true) { ?>
						<a href="#donation-popup" title="donation" class="open-popup-link bg-gradient"><?php echo $donation_button_text; ?></a>
					<?php } elseif(!empty($donation_button_text) && my_wp_is_mobile() == true && is_user_logged_in() == false) { ?>
						<a href="<?php echo site_url().'/donation'; ?>" title="donation" class="bg-gradient"><?php echo $donation_button_text; ?></a>
					<?php } ?>
                </div>
            </div>
            <div class="concert-img column-7">
                <figure class="bg-set filter" style="background-image: url(<?php echo $image[0]; ?>);"></figure>
            </div>
        </div>
    </section>
	<?php endforeach; endif; ?>
	<?php
	include_once ( get_template_directory() . '/includes/Mobile_Detect.php');
	$detect = new Mobile_Detect;
	$artist_merch_section = get_field('artist_merch_section', $term->taxonomy . '_' . $term->term_id);
	//debug($artist_merch_section);
	$section_heading = $artist_merch_section['heading'];
	$section_image = $artist_merch_section['left_section_image'];
	$merchentises = $artist_merch_section['select_products'];
	
	if(empty($merchentises)) : 
	$merchentises = get_posts( array(
		 'post_type'      => 'product',
		 'posts_per_page' => 4,
		 'orderby'        => 'date',
		 'order'		  => 'DESC',
		 'post_status'    => 'publish'
	) );
	endif;
	$button = $artist_merch_section['view_button'];
	$target = (!empty($button['target']) ? 'target="_blank"' : '');
	if( !empty($section_heading) || !empty($section_image) || !empty($merchentises)) :
	?>
    <!-- add merch section -->
    <section class="merch-section">
        <div class="full-container d-flex">
            <div class="merch-innner aos-init aos-animate" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-delay="200">
            <?php if($section_image): ?>
				<figure><img src="<?php echo $section_image; ?>" alt="<?php echo $section_heading; ?>"></figure>
			<?php else: ?>
				<figure><img src="<?php echo get_template_directory_uri().'/assets/images/home-merch.svg'; ?>" alt="<?php echo $section_heading; ?>"></figure>
			<?php endif; ?>
                <?php echo (!empty($section_heading) ? '<h2>'.$section_heading.'</h2>' : ''); ?>
                <?php if(is_array($button) && !empty($button)): ?>
				<div class="view-all"><a href="<?php echo $button['url']; ?>" title="<?php echo $button['title']; ?>" class="bg-gradient" <?php echo $target; ?>><?php echo $button['title']; ?></a></div>
				<?php else: 
				$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
				$button_title = 'VIEW ALL';
				?>
				<div class="view-all"><a href="<?php echo $shop_page_url; ?>" title="<?php echo $button_title; ?>" class="bg-gradient" target="_blank"><?php echo $button_title; ?></a></div>
				<?php endif; ?>
            </div>
            <div class="merch-detail">
			<?php if(is_array($merchentises) && !empty($merchentises)): ?>
                <ul class="artist-details aos-init aos-animate" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-delay="400">
					<?php 
				$i=0;
				foreach($merchentises as $row) : 
					$product = wc_get_product( $row->ID );
					if ($product->is_type( 'simple' )) {
						$sale_price     =  $product->get_sale_price();
						$regular_price  =  $product->get_regular_price();
					}
					elseif($product->is_type('variable')){
						$sale_price     =  $product->get_variation_sale_price( 'min', true );
						$regular_price  =  $product->get_variation_regular_price( 'max', true );
					}
					$currency = get_woocommerce_currency_symbol();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID ), 'large' );
				?>
                    <li><a href="<?php echo esc_url( get_permalink($row->ID) ); ?>" title="<?php echo $row->post_title; ?>"><figure class="bg-set" style="background-image: url(<?php echo (!empty($image[0]) ? $image[0] : ''); ?>"></figure><h6><?php echo $row->post_title; ?></h6><p><?php echo $currency; ?> <?php echo $sale_price; ?></p></a></li>
                <?php 
			$i++;
			if( $detect->isMobile() && !$detect->isTablet() ) {

				if($i==2) break;

			}
			endforeach; ?>
                </ul>
			<?php endif; ?>
			<?php if(is_array($button) && !empty($button)): ?>
            <div class="view-all"><a href="<?php echo $button['url']; ?>" title="<?php echo $button['title']; ?>" class="bg-gradient" <?php echo $target; ?>><?php echo $button['title']; ?></a></div>
            <?php endif; ?>
			</div>              
        </div>
    </section>
	<?php endif; ?>
	
	<?php
	$social_group = get_field('artist_social_group', $term->taxonomy . '_' . $term->term_id);
	if( !empty($social_group['heading']) || !empty($social_group['image']) ||  !empty($social_group['share_link_label']) || !empty($social_group['social_links'])): ?>
    <section class="connect-section">
        <div class="full-container d-flex">
            <div class="social-media">
                <ul class="d-flex">

					<?php if($social_group['social_links']): 
						foreach($social_group['social_links'] as $social_link) : 
						$target = (!empty($social_link['link']['target']) ? $social_link['link']['target'] : '');
					?>
						<li><a href="<?php echo $social_link['link']['url']; ?>" title="<?php echo $social_link['link']['title']; ?>" target="<?php echo $target; ?>"><?php echo $social_link['link']['title']; ?></a></li>
					<?php 
						endforeach;
					endif; ?>
                    
                </ul>
				<?php 
				$share_link = (!empty($social_group['share_link'])) ? $social_group['share_link'] : '#';
				if(!empty($social_group['share_link_label']) && !empty($share_link)) : ?>
                <div class="about-title">
                    <a href="<?php echo $social_group['share_link']; ?>" title="<?php echo $social_group['share_link_label']; ?>"><?php echo $social_group['share_link_label']; ?><svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.34975 6.75008L13.9074 6.52712L13.6886 14.0998L15.5456 14.1858L15.7665 6.53786C15.7969 5.48409 14.9461 4.63701 13.8889 4.66819L6.26259 4.89317L6.34975 6.75008Z" fill="white"/><path d="M1.29605 17.8246L2.62109 19.1497L14.5993 7.17141L13.2743 5.84636L1.29605 17.8246Z" fill="white"/>
                    </svg></a>
                </div>
				<?php endif; ?>

            </div>

            
            <div class="home-recent-blog">
                <div class="blog-inner">
                    <?php echo (!empty($social_group['heading']) ? '<h2>'.$social_group['heading'].'</h2>' : ''); ?>
					<?php if($social_group['image']) : ?>
						<figure><img src="<?php echo $social_group['image']; ?>" alt="Social links."></figure>
					<?php endif; ?>
                </div>          
            </div>
        </div>
    </section>
	<?php endif; ?>
	<?php
	$subscription_section = get_field('subscription_section', $term->taxonomy . '_' . $term->term_id);
	if( !empty($subscription_section['left_section_image']) || !empty($subscription_section['form_title']) || !empty($subscription_section['subscription_form_id']) ): ?>
    <section class="subscribe-follow">
        <div class="container d-flex">
            <div class="subscribe-image column-7">
                <figure class="bg-set filter" style="background-image: url(<?php echo $subscription_section['left_section_image']; ?>);"></figure>
            </div>        
            
            <div class="subscribe-mail column-5">
                <div class="subscribe-inner">
                    <?php echo (!empty($subscription_section['form_title']) ? '<h2>'.$subscription_section['form_title'].'</h2>' : ''); ?>
                    <?php if($subscription_section['subscription_form_id']): ?>
                    <?php echo do_shortcode('[mc4wp_form id="'.$subscription_section['subscription_form_id'].'"]'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
	<?php endif; ?>


</div>
<div id="donation-popup" class="white-popup mfp-hide">
	<?php 
	if ( is_user_logged_in() ) :
		if(!empty($donation_compaign_id)) :?>
		<div class="donation-box">
			<?php echo do_shortcode('[wc_woo_donation id="'.$donation_compaign_id.'"]'); ?>
		</div>
		<?php endif;
	else : ?>
	<?php //echo do_shortcode('[woo-login-popup]'); ?>
	<div class="form-main" id="artist-popup">
		<?php if( get_field('heading_popup','option') ) { the_field('heading_popup','option'); } ?>

		<div class="popup-form">
			<?php //echo do_shortcode('[woo-login-popup]'); ?>
			<?php echo do_shortcode('[xoo_el_inline_form active="login" redirect_to="same"]'); ?>
		</div>
	</div>
	<?php
		
	endif;
	?>
</div>
<?php endif; ?>
<?php get_footer(); ?>