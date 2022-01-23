<?php
$social_links = get_sub_field('social_links');
$heading = get_sub_field('heading');
$right_section_image = get_sub_field('right_section_image');
$share_link_label = get_sub_field('share_link_label');
$share_link = (!empty(get_sub_field('share_link'))) ? get_sub_field('share_link') : '#';
if( $social_links || $heading || $right_section_image || $share_link_label): ?>
<section class="connect-section">
	<div class="full-container d-flex">
		<div class="social-media">
			<ul class="d-flex">

				<?php if($social_links): 
					foreach($social_links as $social_link) : 
					$target = (!empty($social_link['link']['target']) ? $social_link['link']['target'] : '');
				?>
					<li><a href="<?php echo $social_link['link']['url']; ?>" title="<?php echo $social_link['link']['title']; ?>" target="<?php echo $target; ?>"><?php echo $social_link['link']['title']; ?></a></li>
				<?php 
					endforeach;
				endif; ?>
				
			</ul>
			<?php if(!empty($share_link_label) && !empty($share_link)) : ?>
			<div class="about-title">
				<a href="<?php echo $share_link; ?>" title="<?php echo $share_link_label; ?>"><?php echo $share_link_label; ?><svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.34975 6.75008L13.9074 6.52712L13.6886 14.0998L15.5456 14.1858L15.7665 6.53786C15.7969 5.48409 14.9461 4.63701 13.8889 4.66819L6.26259 4.89317L6.34975 6.75008Z" fill="white"/><path d="M1.29605 17.8246L2.62109 19.1497L14.5993 7.17141L13.2743 5.84636L1.29605 17.8246Z" fill="white"/>
				</svg></a>
			</div>
			<?php endif; ?>
		</div>

		<?php if(!empty($heading) || !empty($right_section_image)) : ?>
			<div class="home-recent-blog">
				<div class="blog-inner">
					<?php echo (!empty($heading) ? '<h2>'.$heading.'</h2>' : ''); ?>
					<?php if($right_section_image) : ?>
						<figure><img src="<?php echo $right_section_image; ?>" alt="<?php echo $heading; ?>"></figure>
					<?php endif; ?>
				</div>          
			</div>
		<?php endif; ?>
	</div>
</section>
<?php endif; ?>