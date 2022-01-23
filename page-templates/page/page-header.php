<?php
/**
 * The template header for displaying all pages
 */
 $page_id = get_the_ID();
 $show_banner = get_field('show_banner', $page_id); 
 $banner_option = get_field('banner_option', $page_id); 

// Get settings for Static Banner and Image Slider
 $banner_height = get_field('banner_height', $page_id).'px'; 
 $in_container = get_field('banner_in_box_container', $page_id);
 
$show_in_container = '';
if($in_container != 1){
	$show_in_container .= 'container';
}

?>
		
<!---  .header-section Start -->
<?php if(!empty($show_banner)) :
			
		if($banner_option == 1) {

			// Image slider Section Start 	
		 	$bannerHtml = '';
			$image_sliders = get_field('image_sliders');
			$image_slide_count = count($image_sliders);

			if($image_slide_count == 1){
			
				if( have_rows('image_sliders') ):

					while( have_rows('image_sliders') ): the_row(); 

						$slider_desktop_image = get_sub_field('desktop_image');
						$slider_tablet_image = get_sub_field('tablet_image');
						$slider_mobile_image = get_sub_field('mobile_image');
						$slide_heading = get_sub_field('img_heading');
						$slide_description = get_sub_field('img_caption'); 
						$button_link = get_sub_field('img_button_link');
						$button_text = get_sub_field('img_button_text');
						$open_in = get_sub_field('open_in_a_new_window');
						$target = '';

						if(my_wp_is_mobile()){
							$slide_banner_image =  $slider_mobile_image['url'];
						} else if(my_wp_is_tablet()){
							
							$slide_banner_image =  $slider_tablet_image['url'];
						}else{
							$slide_banner_image =  $slider_desktop_image['url'];
						}

						if($open_in  == 1) {
							$target = 'target="_blank"';	
						} 

				$bannerHtml .='<div class="header-section">
						<div class="header-layout '. $show_in_container.'">';

					$bannerHtml .='<div class="banner-image inner-banner" style="background-image: url('.$slide_banner_image.'); background-position: left top; background-repeat: no-repeat; min-height: 250px;">
						<div class="container">
									<div class="caption">';
										if(!empty($slide_heading)): 
											$bannerHtml .= '<h2>'. $slide_heading.'</h2>'; 
										endif;
										if(!empty($slide_description)): $bannerHtml .= '<div class="banner_desc">'. $slide_description.'</div>'; endif;
										if(!empty($button_text)): 
										$bannerHtml .='<div class="banner-btn">
												<a href="'. $button_link.'" '.$target.'>'. $button_text.'</a>
											</div>';
										endif;
						$bannerHtml .= '</div>
								</div>
							</div>
						</div>
					</div>';
					 endwhile;
				endif;

			} else {


			$bannerHtml .= '<div class="header-section slider">
					<div class="slider-layout">';
						
					 if( have_rows('image_sliders') ): 

				$bannerHtml .='<div class="slides owl-carousel owl-theme">';

							while( have_rows('image_sliders') ): the_row(); 

							$slider_desktop_image = get_sub_field('desktop_image');
							$slider_tablet_image = get_sub_field('tablet_image');
							$slider_mobile_image = get_sub_field('mobile_image');
							$slide_heading = get_sub_field('img_heading');
							$slide_description = get_sub_field('img_caption'); 
							$button_text = get_sub_field('img_button_text');
							$button_link = get_sub_field('img_button_link');
							$open_in = get_sub_field('open_in_a_new_window');
							$target = '';
							
							if(my_wp_is_mobile()){
								$slide_banner_image =  $slider_mobile_image['url'];
							}else if(my_wp_is_tablet()){
								$slide_banner_image =  $slider_tablet_image['url'];
							}else{
								$slide_banner_image =  $slider_desktop_image['url'];
							}

							if($open_in  == 1) {
								$target = 'target="_blank"';
							} 

							$bannerHtml .= '<div class="item banner-image" style="background-image: url('. $slide_banner_image.')">';
								$bannerHtml .= '<div class="container">
													<div class="caption">';
														 if(!empty($slide_heading)): $bannerHtml .='<h2>'.$slide_heading.'</h2>'; endif;
														 if(!empty($slide_description)): $bannerHtml .='<div class="banner_desc">'. $slide_description.'</div> '; endif;
														 if(!empty($button_text)): 
															$bannerHtml .= '<div class="banner-btn">
																	<a href="'. $button_link .'" '.$target.' class="cta-button">'. $button_text .'</a>
																</div>';
														endif;	
									$bannerHtml .=	'</div>
												</div>
											</div>';
									 endwhile; 
					$bannerHtml .='</div>';
							 endif; 

				$bannerHtml .='</div>		
						</div>';
				}

				echo $bannerHtml;
			
			} else {
				 // Video Section Start
				 // Get Video Section Options
				$videoHtml = '';
				$video_slides = get_field('video_slides');
				$video_slide_count = count($video_slides);
				$clItem = '';

				if( have_rows('video_slides') ): 
					if($video_slide_count > 1){
						$clItem = 'item';
						$videoHtml .= '<div class="slides owl-carousel owl-theme">';
					}

						while( have_rows('video_slides') ): the_row();

							$video_fallback_image = get_sub_field('video_fallback_image');  
							$video_caption_heading = get_sub_field('video_caption_heading');
							$video_caption_description = get_sub_field('video_caption_description');
							$video_button_text = get_sub_field('video_button_text');
							$video_button_url = get_sub_field('video_button_url');
							$video_open_in_a_new_window = get_sub_field('video_open_in_a_new_window');

							$video_options = get_sub_field('video_options');

							$target = '';
							if($video_open_in_a_new_window == 1) {
								$target = 'target="_blank"';
							}

							if(empty($video_button_url)) {
								$video_button_url = '#';				
							}

							$videoHtml .='<div class="header-section video slider '.$clItem.'">
											<div class="container">
												<div class="caption">';
													if(!empty($video_caption_heading)): $videoHtml .= '<h2>'. $video_caption_heading.'</h2>'; endif;
													if(!empty($video_caption_description)): $videoHtml .= '<div class="banner_desc">'. $video_caption_description.'</div>'; endif;
													if(!empty($video_button_text)): 
														$videoHtml .='<div class="banner-btn">
															<a href="'. $video_button_url.'" '.$target.'>'. $video_button_text.'</a>
														</div>'; 
													endif;	
									$videoHtml .='</div>
										</div>';

								if($video_options == 'youtube_video'){

									$youtube_video_id = get_sub_field('youtube_video_id');

									if(!empty($youtube_video_id)){

									$videoHtml .='<div class="video_wrapper">
		            					<iframe id="'.$youtube_video_id.'" src="https://www.youtube.com/embed/'.$youtube_video_id.'?title=0&byline=0&portrait=0&api=1&autoplay=0&controls=0&rel=0" width="100%" frameborder="0"></iframe>
		            				</div>';

									} 

								} elseif($video_options == 'vimeo_video') {
									$vimeo_video_id = get_sub_field('vimeo_video_id');
									if(!empty($vimeo_video_id)){

										$videoHtml .='<div class="video_wrapper">
		            					<iframe id="'.$vimeo_video_id.'" src="https://player.vimeo.com/video/'.$vimeo_video_id.'?title=0&byline=0&portrait=0&api=1&autoplay=0&controls=0&rel=0" width="100%" frameborder="0"></iframe>
		            					</div>';

									}

								} else {

									$video_mp4 = get_sub_field('video_url_mp4');
									$video_ogg = get_sub_field('video_url_ogg');
									$video_webm = get_sub_field('video_url_webm');

									$videoHtml .= '<video loop id="video-background" muted plays-inline width="100%" height="500" controls>';
											if(!empty($video_mp4)){
												$videoHtml .= '<source src="'. $video_mp4 .'" type="video/mp4">';
											}
											if(!empty($video_ogg)){
												$videoHtml .= '<source src="'.  $video_ogg.'" type="video/ogg">';
											}
											if(!empty($video_webm)){
												$videoHtml .= '<source src="'. $video_webm .'" type="video/webm">';
											}
										$videoHtml .='Your browser does not support HTML5 video.</video>';
								}
							$videoHtml .='</div>';		
						endwhile;
					if($video_slide_count > 1){
						$videoHtml .='</div>';
					}

				endif;

				echo $videoHtml;

			 }
		 
		endif;


	/*======================================================
	 *       PRINT BREADCRUMB ON PAGE
	 *====================================================== */		
	 
		if( function_exists('show_breadcrumb' ) ): show_breadcrumb(); endif; 
?>

<!---  .header-section Start -->