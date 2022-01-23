<?php
$section_heading = get_sub_field('heading');
$section_image = get_sub_field('image');
$posts = get_sub_field('select_blogs');

if(empty($posts)) : 
	$posts = get_posts( array(
		 'posts_per_page' => 3,
		 'orderby'        => 'date',
		 'order'		  => 'DESC',
		 'post_status'    => 'publish'
	) );
endif;
$button = get_sub_field('button');
$target = (!empty($button['target']) ? 'target="_blank"' : '');
if( !empty($section_heading) || !empty($section_image) || is_array($posts) && !empty($posts)) :
?>
<section class="blog-home">
    <div class="full-container d-flex">
        <div class="blog-home-inner" data-aos="fade-up" data-aos-anchor-placement="top" data-aos-delay="0">
			<?php if(is_array($posts) && !empty($posts)): ?>
				<ul>
				<?php foreach($posts as $row) : 
				/* grab the url for the medium size featured image */
				$featured_img_url = get_the_post_thumbnail_url($row->ID,'medium');
				?>
					<li>
						<a href="<?php echo get_permalink( $row->ID ); ?>" class="d-flex" title="<?php echo $row->post_title; ?>">
							<figure class="bg-set filter" style="background-image: url(<?php echo esc_url($featured_img_url); ?>);"></figure>
							<div class="blog-title"><h6><?php echo $row->post_title; ?></h6><p>by <?php echo get_the_author_meta('display_name', $row->post_author); ?>, <?php echo strtoupper(date('jS \of M', strtotime($row->post_date))); ?></p></div>
						</a>
					</li>
				<?php endforeach; ?>	
				</ul>
			<?php endif; ?>
            <?php if(is_array($button) && !empty($button)): ?>
				<div class="view-all"><a href="<?php echo $button['url']; ?>" title="<?php echo $button['title']; ?>" class="bg-gradient" <?php echo $target; ?>><?php echo $button['title']; ?></a></div>
			<?php endif; ?>
        </div>
        <div class="home-recent-blog">
            <div class="blog-inner" data-aos="fade-up" data-aos-anchor-placement="top" data-aos-delay="0">
                <?php echo (!empty($section_heading) ? '<h2>'.$section_heading.'</h2>' : ''); ?>
				<?php if($section_image) : ?>
					<figure><img src="<?php echo $section_image; ?>" alt="<?php echo $section_heading; ?>"></figure>
				<?php endif; ?>
            </div>          
        </div>              
    </div>
</section>
<?php endif; ?>