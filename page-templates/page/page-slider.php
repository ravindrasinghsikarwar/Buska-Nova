<?php
/**
 * The template header for displaying all pages
 */
 $page_id = get_the_ID();

?>
<!---  .header-section Start -->
<div class="header-section slider">
	<div class="slider-layout">
		
	<?php if( have_rows('slide') ): ?>

		<div class="slides owl-carousel owl-theme">

		<?php while( have_rows('slide') ): the_row(); 
		
		
			$slider_image = get_sub_field('slide_image');
			$slide_heading = get_sub_field('slide_heading_text');
			$slide_description = get_sub_field('slide_caption_text'); 
			$button_link = get_sub_field('call_to_action_link');
			$button_text = get_sub_field('call_to_action_text');
			$open_in = get_sub_field('open_in_a_new_window');
			$target = '';
			
			if($open_in  == 1)
			{
				$target = '_blank';	
			}			
			
		?>
			<div class="item banner-image" style="background-image: url('<?php echo $slider_image['url']; ?>')">
				<div class="container">
					<div class="caption">
						<?php if($slide_heading != ''){ echo '<h2>'.$slide_heading.'</h2>'; } ?>
						<?php if($slide_description != ''){ echo '<div class="banner_desc">'. $slide_description.'</div> '; } ?>
						<?php if($button_text != ''){ ?>
							<div class="banner-btn">
								<a href="<?php echo $button_link; ?>" target="<?php echo $target; ?>" class="cta-button"><?php echo $button_text; ?></a>
							</div>
						<?php } ?>	
					</div>
				</div>
			</div>
		
		<?php endwhile; ?>

	</div>

<?php endif; ?>
		
	</div>		
</div>

<!---  .header-section Start -->
