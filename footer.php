<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Revolution
 * @since Revolution 1.0
 */
?>
	
	<footer id="colophon" role="contentinfo">
		<div class="full-container d-flex">
			<div class="column3">
				<div class="footer-logo">
					<?php if(get_field('footer_logo','option')) : ?>
					<a href="<?php echo site_url(); ?>" title="<?php echo get_bloginfo( 'name' ); ?>"><img src="<?php the_field('footer_logo','option'); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
					<?php endif; ?>
					<?php if(get_field('copyright_text','option')): ?>
					<p><?php the_field('copyright_text','option'); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php if( have_rows('footer_menu', 'option') ): ?>
				<?php while( have_rows('footer_menu', 'option') ): the_row(); ?>
					<div class="column3">
						<?php if( get_sub_field('menu_title') ): ?><h5><?php the_sub_field('menu_title'); ?></h5><?php endif; ?>
						<?php if( have_rows('menu_items', 'option') ): ?>
							<ul>
								<?php while( have_rows('menu_items', 'option') ): the_row(); ?>
								<li><a href="<?php the_sub_field('url'); ?>" title="<?php the_sub_field('label'); ?>"><?php the_sub_field('label'); ?><img src="<?php echo get_template_directory_uri(); ?>/assets/images/follow-us.svg" alt=""></a></li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
				<?php endif; ?>
				<?php if( have_rows('footer_social_icons', 'option') ): ?>
					<?php while( have_rows('footer_social_icons', 'option') ): the_row(); ?>
					<div class="column3">
						<?php if( get_sub_field('title') ): ?><h5><?php the_sub_field('title'); ?></h5><?php endif; ?>
						<?php if( have_rows('social_icons', 'option') ): ?>
						<ul>
							<?php while( have_rows('social_icons', 'option') ): the_row(); ?>
							<li><a href="<?php the_sub_field('url'); ?>" title="<?php the_sub_field('title'); ?>" target="_blank">
								<img class="svg" src="<?php the_sub_field('select_icon'); ?>" alt="<?php the_sub_field('title'); ?>">
								</a>
							</li>
							<?php endwhile; ?>
						</ul>
						<?php endif; ?>
					</div>
					<?php endwhile; ?>
				<?php endif; ?>
		</div>	
	</footer><!-- #colophon -->
	<div id="test-popup" class="white-popup mfp-hide">
		<?php //echo do_shortcode('[woo-login-popup]'); ?>
		<?php echo do_shortcode('[xoo_el_inline_form active="login"]'); ?>
	</div>
</div><!-- #page -->
<?php wp_footer(); ?>
<?php
if ( class_exists( 'WooCommerce' ) ) {
if( is_wc_endpoint_url( 'edit-address' ) ){ 
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
   $("#billing_country").change(function () {
	   var label1 = $('label[for="billing_address_1"]').text();
	   var label2 = label1.replace(/\u00A0/g, '');
	   var label3 = label2.replace('*', '');
	   $('label[for="billing_address_1"]').text(label3);
	   
	   var label4 = $('label[for="billing_postcode"]').text();
	   var label5 = label4.replace(/\u00A0/g, '');
	   var label6 = label5.replace('*', '');
	   $('label[for="billing_postcode"]').text(label6);
   });
   
   $("#shipping_country").change(function () {
	   var label1 = $('label[for="shipping_address_1"]').text();
	   var label2 = label1.replace(/\u00A0/g, '');
	   var label3 = label2.replace('*', '');
	   $('label[for="shipping_address_1"]').text(label3);
	   
	   var label4 = $('label[for="shipping_postcode"]').text();
	   var label5 = label4.replace(/\u00A0/g, '');
	   var label6 = label5.replace('*', '');
	   $('label[for="shipping_postcode"]').text(label6);
   });
})
</script>
<?php } 
if ( is_product() ) {
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/easyzoom.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  var sync1 = $("#sync1");
  var sync2 = $("#sync2");
 
  sync1.owlCarousel({
    items: 1,
    //singleItem: true,
    autoPlay: false,
    slideSpeed: 1000,
    navigation: false,
    pagination: false,
    touchDrag  : false,
     mouseDrag  : false,
    afterAction: syncPosition,
    responsiveRefreshRate: 200,
    itemsDesktop      : [1199,1],
    itemsDesktopSmall : [979,1],
    itemsTablet       : [768,1],
    itemsMobile       : [479,1],
  });
 
  sync2.owlCarousel({
    items : 7,
    itemsDesktop      : [1199,7],
    itemsDesktopSmall : [979,6],
    itemsTablet       : [768,6],
    itemsMobile       : [479,6],
    pagination: false,
    responsiveRefreshRate: 100,
	  
    afterInit : function(el){
      el.find(".owl-item").eq(0).addClass("synced");
    }
  });
 
  function syncPosition(el){
    var current = this.currentItem;
    $("#sync2")
      .find(".owl-item")
      .removeClass("synced")
      .eq(current)
      .addClass("synced")
    if($("#sync2").data("owlCarousel") !== undefined){
      center(current)
    }
  }
 
  $("#sync2").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
  });
 
  function center(number){
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
      if(num === sync2visible[i]){
        var found = true;
      }
    }
 
    if(found===false){
      if(num>sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", num - sync2visible.length+2)
      }else{
        if(num - 1 === -1){
          num = 0;
        }
        sync2.trigger("owl.goTo", num);
      }
    } else if(num === sync2visible[sync2visible.length-1]){
      sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
      sync2.trigger("owl.goTo", num-1)
    }
    
  }

  $('.tile')
    // tile mouse actions
    .on('mouseover', function(){
      $(this).children('.photo').css({'transform': 'scale('+ $(this).attr('data-scale') +')'});
    })
    .on('mouseout', function(){
      $(this).children('.photo').css({'transform': 'scale(1)'});
    })
    .on('mousemove', function(e){
      $(this).children('.photo').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
    })
    // tiles set up
    .each(function(){
      $(this)
        // add a photo container
        .append('<div class="photo"></div>')
        // set up a background image for each tile based on data-image attribute
        .children('.photo').css({'background-image': 'url('+ $(this).attr('data-image') +')'});
    });
 
});
</script>
<?php } 
}
?>
</body>
</html>