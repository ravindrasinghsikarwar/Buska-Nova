<?php 
$left_section_heading = get_sub_field('left_section_heading');
$left_section_image = get_sub_field('left_section_image');
$left_section_bottom_link = get_sub_field('left_section_bottom_link');
$right_section_heading = get_sub_field('right_section_heading');
$subscription_form_id = get_sub_field('subscription_form_id');
if ( !is_front_page() ) :
	$class = ' inner-subscription';
else:
	$class = '';
endif;
if( !empty($left_section_heading) || !empty($left_section_image) || !empty($right_section_heading) || !empty($subscription_form_id)) :
?>
<section class="about-artist<?php echo $class; ?>" id="subscribe">
	<div class="full-container d-flex">
		<div class="about-our-mission" data-aos="fade-up" data-aos-anchor-placement="top" data-aos-delay="500" data-aos-duration="1500">
			<?php echo (!empty($left_section_heading) ? '<h2>'.$left_section_heading.'</h2>' : ''); ?>
			<?php if($left_section_image) : ?>
				<div class="artist-image">
					<figure class="filter"><img src="<?php echo $left_section_image; ?>" alt="<?php echo $left_section_heading; ?>"></figure>
				</div>
			<?php endif; ?>
			<?php if(is_array($left_section_bottom_link) && !empty($left_section_bottom_link) ): 
			$target = (!empty($left_section_bottom_link['target']) ? 'target="_blank"' : '');
			?>
			<div class="about-title">
				<a href="<?php echo $left_section_bottom_link['url']; ?>" title="<?php echo $left_section_bottom_link['title']; ?>" <?php echo $target; ?>><?php echo $left_section_bottom_link['title']; ?><svg version="1.2" baseProfile="tiny-ps" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 33 13" width="33" height="13"><style>tspan { white-space:pre }.shp0 { fill: #ffffff }</style><path id="Layer" fill-rule="evenodd" class="shp0" d="M26.04 0.64C26.24 0.45 26.56 0.45 26.76 0.64L32.85 6.41C32.95 6.5 33 6.62 33 6.75C33 6.88 32.95 7 32.85 7.09L26.76 12.86C26.56 13.05 26.24 13.05 26.04 12.86C25.84 12.67 25.84 12.37 26.04 12.18L30.4 8.05C30.54 7.91 30.59 7.71 30.51 7.53C30.43 7.35 30.25 7.23 30.04 7.23L1.01 7.23C0.73 7.23 0.5 7.02 0.5 6.75C0.5 6.48 0.73 6.27 1.01 6.27L30.04 6.27C30.25 6.27 30.43 6.15 30.51 5.97C30.59 5.79 30.54 5.59 30.4 5.45L26.04 1.32C25.84 1.13 25.84 0.83 26.04 0.64Z" />
				</svg></a>
			</div>
			<?php endif; ?>
		</div>
		<?php if(!empty($right_section_heading) || !empty($subscription_form_id)): ?>
			<div class="subscribe-mail" data-aos="fade-up" data-aos-anchor-placement="top" data-aos-delay="500" data-aos-duration="1500">
				<div class="subscribe-inner">
					<?php echo (!empty($right_section_heading) ? '<h2>'.$right_section_heading.'</h2>' : ''); ?>
					<?php if($subscription_form_id): ?>
					<?php echo do_shortcode('[mc4wp_form id="'.$subscription_form_id.'"]'); ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>