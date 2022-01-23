<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Revolution
 * @since Revolution 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="profile" href="http://gmpg.org/xfn/11" />

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<script>
  var adminurl = '<?php echo admin_url('admin-ajax.php '); ?>';
  var tempurl = '<?php echo get_template_directory_uri(); ?>';
</script>
<?php //google_analytics_code(); ?>
<script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=vjodh6vnxdpkesrutsx1ta" async="true"></script>
</head>

<body <?php body_class(); ?>>
	<?php //site_loader(); ?>
	<?php //scipt_print_in_body(); ?>

	<div id="page" class="hfeed site">
		
		<header id="masthead" class="site-header">
			<!-- top header start --> 
			<?php if(get_field('social','options') == '1'):?>
			<div class="top-header">
				<div class="container">
					<div class="row">						
						<div class="social-listing col-md-8 col-6 d-flex align-items-center justify-content-end"><?php social_list(); ?></div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<!-- top header end -->

			<div class="header-top">
			<div class="main-header container">
				<div class="row">
					<div class="header-inner">
						<div class="logo-wrap">
							<a href="<?php echo site_url(); ?>" title="Buska nova">
		                    <?php if( get_field('header_logo', 'option') ): ?><img src="<?php the_field('header_logo', 'option'); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"><?php else: echo get_bloginfo( 'name' ); endif; ?>
		                </a>
							<?php $description = get_bloginfo( 'description', 'display' ); ?>
						</div>	
							<div class="login-menu">
								<ul class="login">
										<?php if( get_field('header_search_icon', 'option') ): ?>
											<li class="search-toggle closed"><a href="#" title="search here" class="search-icon icon-search"><img class="svg" src="<?php the_field('header_search_icon', 'option'); ?>" alt="search icon"></a></li>
										<?php endif; ?>
									<?php if ( class_exists( 'WooCommerce' ) ) : 
										$obj = get_queried_object();
										//echo 'Hello '.$obj->term_id;
									?>
										<?php if( get_field('header_user_icon', 'option') ): ?>
											<?php if ( is_user_logged_in() ) : ?>
											<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="user" class=""><img class="svg" src="<?php the_field('header_user_icon', 'option'); ?>" alt="user icon"></a></li>
											<?php elseif(is_account_page() == true || is_checkout() == true || is_page( 'Donation' ) == true) : ?>
											<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="user" class=""><img class="svg" src="<?php the_field('header_user_icon', 'option'); ?>" alt="user icon"></a></li>
											<?php else : ?>
											<li><a href="#test-popup" id="header-login" title="user" class="header-popup-link"><img class="svg" src="<?php the_field('header_user_icon', 'option'); ?>" alt="user icon"></a></li>
											<?php endif; ?>
										<?php endif; ?>
										<?php if( get_field('header_cart_icon', 'option') ): ?>
											<li><a href="<?php echo wc_get_cart_url() ?>" title="cart" class="buska-cart"><img class="svg" src="<?php the_field('header_cart_icon', 'option'); ?>" alt="cart icon"><?php $items_count = WC()->cart->get_cart_contents_count(); if($items_count) :?><span id="mini-cart-count"><?php echo $items_count ? $items_count : '0'; ?></span><?php endif; ?></a></li>
										<?php endif; ?>
									<?php endif; ?>
								</ul>
							<!-- <?php  //logo_header(); 	?> -->
								<!-- hamburger start -->
								<div class="hamburger hamburger--3dxy-r">
								    <div class="hamburger-box">
								    	<!-- <div class="hamburger-inner"></div> --><svg class="desktop-icon" width="28" height="22" viewBox="0 0 28 22" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M0.666504 2.66667C0.666504 1.74619 1.4127 1 2.33317 1H25.6665C26.587 1 27.3332 1.74619 27.3332 2.66667C27.3332 3.58714 26.587 4.33333 25.6665 4.33333H2.33317C1.4127 4.33333 0.666504 3.58714 0.666504 2.66667ZM0.666504 11C0.666504 10.0795 1.4127 9.33333 2.33317 9.33333H25.6665C26.587 9.33333 27.3332 10.0795 27.3332 11C27.3332 11.9205 26.587 12.6667 25.6665 12.6667H2.33317C1.4127 12.6667 0.666504 11.9205 0.666504 11ZM0.666504 19.3333C0.666504 18.4129 1.4127 17.6667 2.33317 17.6667H25.6665C26.587 17.6667 27.3332 18.4129 27.3332 19.3333C27.3332 20.2538 26.587 21 25.6665 21H2.33317C1.4127 21 0.666504 20.2538 0.666504 19.3333Z" fill="white" stroke="#0D0D0D" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
											<svg class="mobile-icon" version="1.2" baseProfile="tiny-ps" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 252 252" width="252" height="252">
												<style>
													tspan { white-space:pre }
													.shp0 { fill: #ffffff } 
												</style>
												<g id="Layer">
													<g id="Layer1">
														<path id="Layer2" class="shp0" d="M19.57 252.04C14.55 252.04 9.53 250.12 5.71 246.29C-1.95 238.64 -1.95 226.22 5.71 218.57L218.57 5.71C226.22 -1.95 238.64 -1.95 246.29 5.71C253.95 13.36 253.95 25.78 246.29 33.43L33.43 246.29C29.6 250.12 24.59 252.04 19.57 252.04Z" />
														<path id="Layer3" class="shp0" d="M232.43 252.04C227.41 252.04 222.4 250.12 218.57 246.29L5.71 33.43C-1.95 25.78 -1.95 13.36 5.71 5.71C13.36 -1.95 25.78 -1.95 33.43 5.71L246.29 218.57C253.95 226.23 253.95 238.64 246.29 246.3C242.47 250.12 237.45 252.04 232.43 252.04Z" />
													</g>
												</g>
											</svg>
									</div>
								</div>								
								<!-- hamburger end -->
						</div>						
					</div>
					<nav id="site-navigation" class="top-nav main-navigation">                      
	            <?php wp_nav_menu( array( 'theme_location' => 'mobile', 'menu_class' => 'nav-menu' ) ); ?>
	            <ul class="login menu-open-login">
										<?php if( get_field('header_search_icon', 'option') ): ?>
											<li class="search-toggle closed"><a href="#" title="search here" class="search-icon icon-search"><img class="svg" src="<?php the_field('header_search_icon', 'option'); ?>" alt="search icon"></a></li>
										<?php endif; ?>
										<?php if ( class_exists( 'WooCommerce' ) ) : ?>
										<?php if( get_field('header_user_icon', 'option') ): ?>
											<?php if ( is_user_logged_in() ) : ?>
												<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="user" class=""><img class="svg" src="<?php the_field('header_user_icon', 'option'); ?>" alt="user icon"></a></li>
											<?php else : ?>
												<li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="user" class=""><img class="svg" src="<?php the_field('header_user_icon', 'option'); ?>" alt="user icon"></a></li>
											<?php endif; ?>
										<?php endif; ?>
										<?php if( get_field('header_cart_icon', 'option') ): ?>
											<li><a href="<?php echo wc_get_cart_url() ?>" title="cart" class="buska-cart"><img class="svg" src="<?php the_field('header_cart_icon', 'option'); ?>" alt="cart icon"><?php $items_count = WC()->cart->get_cart_contents_count(); if($items_count) : ?><span id="mini-cart-count"><?php echo $items_count ? $items_count : '0'; ?></span><?php endif; ?></a></li>
										<?php endif; ?>
									<?php endif; ?>
								</ul>
	        </nav>
				</div>
				<div class="search-inner">
					<div class="search-container">
						<div class="search-top">
							<form>
							<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
							</form>
							<div class="search-toggle">
							<button class="search-icon icon-close"><svg  class="" version="1.2" baseProfile="tiny-ps" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 252 252" width="252" height="252">
							<style>
							tspan { white-space:pre }
							.shp0 { fill: #ffffff } 
							</style>
							<g id="Layer4">
							<g id="Layer5">
							<path id="Layer6" class="shp0" d="M19.57 252.04C14.55 252.04 9.53 250.12 5.71 246.29C-1.95 238.64 -1.95 226.22 5.71 218.57L218.57 5.71C226.22 -1.95 238.64 -1.95 246.29 5.71C253.95 13.36 253.95 25.78 246.29 33.43L33.43 246.29C29.6 250.12 24.59 252.04 19.57 252.04Z"></path>
							<path id="Layer7" class="shp0" d="M232.43 252.04C227.41 252.04 222.4 250.12 218.57 246.29L5.71 33.43C-1.95 25.78 -1.95 13.36 5.71 5.71C13.36 -1.95 25.78 -1.95 33.43 5.71L246.29 218.57C253.95 226.23 253.95 238.64 246.29 246.3C242.47 250.12 237.45 252.04 232.43 252.04Z"></path>
							</g>
							</g>
							</svg></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</header>