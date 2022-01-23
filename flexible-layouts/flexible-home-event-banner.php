<?php 
$title = get_sub_field('heading');

$banner_right_side_text = get_sub_field('banner_right_side_text');

$help_text = get_sub_field('help_text');

$live_icon = get_sub_field('live_icon');

$artist_profile_button_text = get_sub_field('artist_profile_button_text');

$events = get_posts(array(
	'numberposts'	=> -1,
	'post_type'		=> 'event',
	'orderby' 		=> 'date',
    'order'   		=> 'ASC',
	'meta_key'		=> 'featured',
	'meta_value'	=> '1'
));	
if( !empty($title) || !empty($banner_right_side_text) || !empty($help_text) || !empty($live_icon) || is_array($events) && !empty($events)) :
?>
<section class="hero-banner">
    <div class="container d-flex">
        <div class="text-slider">
            <div class="hero-title">
                <?php echo (!empty($title) ? '<h1>'.$title.'</h1>' : ''); ?>
				<?php if(!empty($help_text)) : ?>
                <div class="scroll-main"><a class="scroll-bottom" href="#next-section-scroll" id="scroll-bottom" title=""><?php echo $help_text; ?></a></div>
				<?php endif; ?>
            </div>
            <div class="slider-sec clearfix">        
                <div class="banner-slider">
				<?php if(is_array($events) && !empty($events)): 
					foreach($events as $event) :
					$event_date = get_field('event_date', $event->ID);
					$date = str_replace('/', '-', $event_date);
					$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($event->ID), 'single-post-thumbnail' );
					$artists_categories = get_the_terms( $event->ID, 'artist' );
					if ( ! empty( $artists_categories )) {
						$term_id = $artists_categories[0]->term_id;
						$term_url = get_term_link( (int) $term_id, 'artist' );
					} else {
						$term_url = '';
					}
					?>
						<div class="banner-details" style="background-image: url(<?php echo (!empty($featured_image[0]) ? $featured_image[0] : ''); ?>);">
							<div class="banner-main d-flex">
								<?php if($event_date) : ?>
									<div class="show-date"><p><span><?php echo strtoupper(date("j", strtotime($date)) ); ?></span><?php echo strtoupper(date("M", strtotime($date)) ); ?></p></div>
								<?php endif; ?>
								<div class="show-details">
									<?php if($live_icon): ?>
										<figure><img src="<?php echo $live_icon; ?>" alt="live"></figure>
									<?php endif; ?>
									 <?php echo (!empty($event->post_title) ? '<h3>'.$event->post_title.'</h3>' : ''); ?>
									 <?php if(!empty($artist_profile_button_text)): ?>
										<a href="<?php echo $term_url; ?>" title="View artist profile" class="bg-gradient"><?php echo $artist_profile_button_text; ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
                <?php 
					endforeach;
				endif; ?>                          
                </div>
            </div>
        </div>
        <div class="artist-block">
			<?php if( !empty($banner_right_side_text)) : ?>
            <div class="artist-title"><?php echo (!empty($title) ? '<h5>'.$banner_right_side_text.'</h5>' : ''); ?></div>
			<?php endif; ?>     
			<div class="artist-title-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</div>       
        </div>
    </div>
</section>
<?php endif; ?>