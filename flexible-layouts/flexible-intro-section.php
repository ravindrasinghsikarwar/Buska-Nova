<?php
$left_section_title = get_sub_field('left_section_title');
$right_section_title = get_sub_field('right_section_title');
$right_section_description = get_sub_field('right_section_description');
?>
<?php if($left_section_title || $right_section_title || $right_section_description) : ?>
<section class="about-band about-details">
	<div class="container d-flex">
		<div class="band-title column-5">
			<?php echo (!empty($left_section_title) ? '<h5>'.$left_section_title.'</h5>' : ''); ?>
		</div>
		<div class="band-details column-7">
			<?php echo (!empty($right_section_title) ? '<h4>'.$right_section_title.'</h4>' : ''); ?>
			<?php echo (!empty($right_section_description) ? $right_section_description : ''); ?>
		</div>
	</div>
</section>
<?php endif; ?>