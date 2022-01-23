<?php
/**
 * The template header for displaying all pages
 */
 $page_id = get_the_ID();
 $banner_image = options('single_page_banner'); 
 $banner_height = options('single_banner_height').'px'; 
 
 $banner_heading = options('single_page_heading');
 $banner_description = options('single_page_caption');
 
 $in_container = options('single_banner_in_box_container');
 

 $show_in_container = '';
 if($in_container != 1)
 {
	$show_in_container .= 'container';
 }

?>
<!---  .header-section Start -->
<div class="header-section" style="height:<?php echo $banner_height;?>;">
	<div class="<?php echo $show_in_container; ?> header-layout">		
		<div class="banner-image innerpage-banner" style="background-image: url('<?php echo $banner_image['url']; ?>'); background-position: left top; background-repeat: no-repeat; min-height: 250px; height:<?php echo $banner_height;?>;">
			<div class="container">
				<div class="caption">
					<h1><?php echo $banner_heading?></h1>
					<div class="banner_desc"><?php echo $banner_description; ?></div>					
				</div>
			</div>
		</div>		
	</div>
</div>
<!---  .header-section Start -->
<?php
		/*======================================================
		 *       PRINT BREADCRUMB ON PAGE
		 *====================================================== */		
		 
			if( function_exists('show_breadcrumb' ) ): show_breadcrumb(); endif; 
		?>
