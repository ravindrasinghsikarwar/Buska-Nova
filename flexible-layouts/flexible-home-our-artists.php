<?php
include_once ( get_template_directory() . '/includes/Mobile_Detect.php');
$section_heading = get_sub_field('heading');
$artists = get_sub_field('select_artists');

$detect = new Mobile_Detect;

if(empty($artists)) : 
$artists = get_terms( array(
    'taxonomy' => 'artist',
    'hide_empty' => false,
	'orderby' => 'menu_order', 
    'order' => 'DESC', 
	'number'     => '8'
) );
endif;
$button = get_sub_field('button');
$target = (!empty($button['target']) ? 'target="_blank"' : '');
if( !empty($section_heading) || is_array($artists) && !empty($artists)) :
?>
<section class="our-artist">
    <div class="full-container">
        <div class="artist-inner">
            <?php echo (!empty($section_heading) ? '<h2 data-aos="fade-up" data-aos-anchor-placement="top" data-aos-delay="0">'.$section_heading.'</h2>' : ''); ?>
			<?php if(is_array($artists) && !empty($artists)): ?>
				<ul class="artist-details">
				<?php 
				$i=0;
				foreach($artists as $row) : 
					$artist_music = get_field('music_type', $row->taxonomy.'_'.$row->term_id);
					$artist_image = get_field('artist_image', $row->taxonomy.'_'.$row->term_id);
				?>
					<li data-aos="fade-up" data-aos-anchor-placement="top" data-aos-delay="0"><a href="<?php echo get_term_link($row->slug, 'artist'); ?>" title="<?php echo $row->name; ?>"><figure class="bg-set" style="background-image: url(<?php echo $artist_image; ?>);"></figure><h6><?php echo $row->name; ?></h6><p><?php echo $artist_music; ?></p></a></li>
				<?php 
				$i++;
				if( $detect->isMobile() && !$detect->isTablet() ) {
	
					if($i==6) break;

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