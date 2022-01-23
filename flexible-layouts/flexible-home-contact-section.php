<?php
include_once ( get_template_directory() . '/includes/Mobile_Detect.php');
$detect = new Mobile_Detect;
$section_heading = get_sub_field('heading');
$section_image = get_sub_field('image');
$image_mobile_view = get_sub_field('image_mobile_view');
$toggle1 = get_sub_field('artist_toggle_text');
$toggle2 = get_sub_field('fan_toggle_text');
$artist_form = get_sub_field('artist_form');
$fan_form = get_sub_field('fan_form');
$button = get_sub_field('link');
$target = (!empty($button['target']) ? 'target="_blank"' : '');
if( !empty($section_heading) || !empty($section_image) || !empty($artist_form) || !empty($fan_form)) :
?>
<section class="join-our-mission">
    <div class="full-container d-flex">
        <div class="about-mission">
			<?php if( $detect->isMobile() && !$detect->isTablet() ) : ?>
				<?php if($image_mobile_view): ?>
					<figure><img src="<?php echo $image_mobile_view; ?>" alt="<?php echo $section_heading; ?>"></figure>
				<?php else : ?>
					<figure><img src="<?php echo $section_image; ?>" alt="<?php echo $section_heading; ?>"></figure>
				<?php endif; ?>
			<?php else: ?>
				<?php if($section_image): ?>
					<figure><img src="<?php echo $section_image; ?>" alt="<?php echo $section_heading; ?>"></figure>
				<?php endif;
			endif; ?>
            <div class="about-title">
                <?php echo (!empty($section_heading) ? '<h2>'.$section_heading.'</h2>' : ''); ?>
				<?php if(is_array($button) || !empty($button)) : ?>
					<a href="<?php echo $button['url']; ?>" title="<?php echo $button['title']; ?>" <?php echo $target; ?>><?php echo $button['title']; ?><svg version="1.2" baseProfile="tiny-ps" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 13" width="33" height="13"><style>tspan { white-space:pre }.shp0 { fill: #ffffff }</style><path id="Layer" fill-rule="evenodd" class="shp0" d="M26.04 0.64C26.24 0.45 26.56 0.45 26.76 0.64L32.85 6.41C32.95 6.5 33 6.62 33 6.75C33 6.88 32.95 7 32.85 7.09L26.76 12.86C26.56 13.05 26.24 13.05 26.04 12.86C25.84 12.67 25.84 12.37 26.04 12.18L30.4 8.05C30.54 7.91 30.59 7.71 30.51 7.53C30.43 7.35 30.25 7.23 30.04 7.23L1.01 7.23C0.73 7.23 0.5 7.02 0.5 6.75C0.5 6.48 0.73 6.27 1.01 6.27L30.04 6.27C30.25 6.27 30.43 6.15 30.51 5.97C30.59 5.79 30.54 5.59 30.4 5.45L26.04 1.32C25.84 1.13 25.84 0.83 26.04 0.64Z"></path>
					</svg></a>
				<?php endif; ?>
            </div>
        </div>
        <div class="artist-fan">
            <div id="tabs">
                <ul class="tabs">
                    <?php if($toggle1): ?><li class="tab-link current" data-tab="tab-1"><?php echo $toggle1; ?></li><?php endif; ?>
                    <?php if($toggle2): ?><li class="tab-link" data-tab="tab-2"><?php echo $toggle2; ?></li><?php endif; ?>
                </ul>
                <div  id="tab-1" class="tab-content current"><?php if($artist_form) : echo do_shortcode('[contact-form-7 id="5" title="Artist form"]'); endif; ?></div>
                <div  id="tab-2" class="tab-content"><?php if($fan_form) : echo do_shortcode('[contact-form-7 id="140" title="Fan Form"]'); endif; ?></div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>