<?php
$content = get_sub_field('content');
$page_title = get_sub_field('page_title_show');
$title = get_the_title( get_the_ID() );
?>
<?php if(!empty($title) || !empty($content)) : ?>
<div id="main">
    <section class="content-section">
        <div class="container d-flex">
            <div class="counter-sec column-12">
				<?php if($page_title == true) : ?>
					<?php echo (!empty($title) ? '<div class="title"><h2>'.$title.'</h2></div>' : ''); ?>
				<?php endif; ?>
				<?php echo (!empty($content) ? $content : ''); ?>
			</div>
		</div>
	</section>
</div>
<?php endif; ?>