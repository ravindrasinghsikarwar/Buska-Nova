<?php
$left_section_title = get_sub_field('left_section_title');
$left_section_description = get_sub_field('left_section_description');
$right_section_image = get_sub_field('right_section_image');
?>
<?php if($left_section_title || $left_section_description || $right_section_image) : ?>
<section class="get-ticket-section about-ticket">
	<div class="container d-flex">
		<div class="concert-details column-5">
			<?php echo (!empty($left_section_title) ? '<h4>'.$left_section_title.'</h4>' : ''); ?>
			<div class="concert-inner">
				<?php echo (!empty($left_section_description) ? $left_section_description : ''); ?>
			</div>
		</div>
		<div class="concert-img column-7">
		<?php if($right_section_image) : ?>
			<figure class="bg-set filter" style="background-image: url(<?php echo $right_section_image; ?>);"></figure>
		<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>