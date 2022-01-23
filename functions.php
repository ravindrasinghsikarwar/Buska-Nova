<?php

/**

 * Revolution functions and definitions

 *

 * Sets up the theme and provides some helper functions, which are used

 * in the theme as custom template tags. Others are attached to action and

 * filter hooks in WordPress to change core functionality.

 *

 * When using a child theme (see https://codex.wordpress.org/Theme_Development and

 * https://codex.wordpress.org/Child_Themes), you can override certain functions

 * (those wrapped in a function_exists() call) by defining them first in your child theme's

 * functions.php file. The child theme's functions.php file is included before the parent

 * theme's file, so the child theme functions would be used.

 *

 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached

 * to a filter or action hook.

 *

 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API

 *

 * @package WordPress

 * @subpackage Revolution

 * @since Revolution 1.0

 */

define("CSS_PATH", get_template_directory_uri().'/assets/css/' );
define("JS_PATH", get_template_directory_uri().'/assets/js/' );
define("IMG_PATH", get_template_directory_uri().'/assets/images/' );
// Set up the content width value based on the theme's design and stylesheet.

if ( ! isset( $content_width ) )

	$content_width = 625;



/**

 * Revolution setup.

 *

 * Sets up theme defaults and registers the various WordPress features that

 * Revolution supports.

 *

 * @uses load_theme_textdomain() For translation/localization support.

 * @uses add_editor_style() To add a Visual Editor stylesheet.

 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,

 * 	custom background, and post formats.

 * @uses register_nav_menu() To add support for navigation menus.

 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.

 *

 * @since Revolution 1.0

 */

function revolution_setup() {

	/*
	 * Makes Revolution available for translation.
	 *
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/revolution
	 * If you're building a theme based on Revolution, use a find and replace
	 * to change 'text-domain' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'text-domain' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( array( 'assets/css/admin/editor-style.css', revolution_fonts_url() ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Adds RSS feed links to <head> for posts and comments.
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme supports a variety of post formats.
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	/**
	 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
	 * Adding Primary & Footer menu location for wp_nav_menu
	 */
	register_nav_menu( 'primary', __( 'Primary Menu', 'text-domain' ) );
	register_nav_menu( 'mobile', __( 'Mobile Menu', 'text-domain' ) );
	register_nav_menu( 'footer', __( 'Footer Menu', 'text-domain' ) );

	/**
	 * This theme supports custom background color and image, and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	/**
	 * This theme uses a custom image size for featured images, displayed on "standard" posts.
	 */
	add_theme_support( 'post-thumbnails' );	
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

	/**
	 * Support for Woocommerce
	 */
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-slider' );

	/**
	 * Indicate widget sidebars can use selective refresh in the Customizer.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

}

add_action( 'after_setup_theme', 'revolution_setup' );


/**

 * Register custom fonts.

 */

function revolution_fonts_url() {

	$fonts_url = '';

	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {

		$font_families = array();
		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**

 * Add support for a custom header image.

 */

require( get_template_directory() . '/includes/custom-header.php' );
require( get_template_directory() . '/includes/theme-functions.php' );
require( get_template_directory() . '/includes/blog-filter-functions.php' );
require( get_template_directory() . '/includes/merch-filter-functions.php' );
require( get_template_directory() . '/includes/woocommerce-functions.php' );
require( get_template_directory() . '/includes/artist-filter-functions.php' );

/**

 * Enqueue scripts and styles for front end.

 *

 * @since Revolution 1.0

 */
function revolution_scripts_styles() {

	global $wp_styles;

	/**

	 * Adds JavaScript to pages with the comment form to support

	 * sites with threaded comments (when in use).

	 */

	wp_enqueue_script( 'jquery' );

	$translation_array = array('templateUrl' => get_stylesheet_directory_uri(), 'siteUrl' => get_bloginfo('url'), 'tagline' => get_bloginfo('description'), 'ajax_url' => admin_url('admin-ajax.php'));

    wp_localize_script('jquery', 'object_name', $translation_array);
	// Register Owl-slider Library

	//wp_register_style( 'owl-slider', CSS_PATH . 'owl.carousel.min.css', '', '', '');
	wp_enqueue_script( 'owl.carousel', JS_PATH . 'owl.carousel.min.js', '', '', true );
	wp_enqueue_script( 'owl.navigation', JS_PATH . 'owl.navigation.js', '', '', true  );
	wp_enqueue_script('owl.animate', JS_PATH . 'owl.animate.js', '', '', true  );
	wp_enqueue_script('lazy', JS_PATH . 'jquery.lazy.min.js', '', '', true  );
	wp_enqueue_script('aos', JS_PATH . 'aos.js', '', '', true  );

	//wp_enqueue_style( 'bootstrap-min', CSS_PATH.'bootstrap.min.css' );
	wp_enqueue_style( 'theme-default', CSS_PATH.'theme-default.css' );
	wp_enqueue_style( 'owl-min', CSS_PATH.'owl.carousel.min.css' );
	wp_enqueue_style( 'main-min', CSS_PATH.'main.css' );
	/*Temporary css for Woocommerce's work */
	wp_enqueue_style( 'custom-woocommerce', CSS_PATH.'woocommerce_custom.css' );
	//wp_enqueue_style( 'slick-theme-min', CSS_PATH.'slick-theme.css' );
	wp_enqueue_style( 'magnific-popup', CSS_PATH.'magnific-popup.css' );
	wp_enqueue_style( 'aos', CSS_PATH.'aos.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )

		wp_enqueue_script( 'comment-reply' );
		wp_enqueue_script( 'slick-min-js', JS_PATH.'slick.min.js', '', '', true );
		wp_enqueue_script( 'jquery-magnific-popup-min-js', JS_PATH.'jquery.magnific-popup.min.js', '', '', true );
		wp_enqueue_script( 'general-js', JS_PATH.'general.js', '', '', true );
		wp_enqueue_script( 'theme-main-js', JS_PATH.'theme-main.js', '', '', true );
		wp_enqueue_style( 'revolution-ie', CSS_PATH.'admin/ie.css' );
		$wp_styles->add_data( 'revolution-ie', 'conditional', 'lt IE 9' );
		// Loads our main stylesheet.
		wp_enqueue_style( 'revolution-style', get_stylesheet_uri() );

}

add_action( 'wp_enqueue_scripts', 'revolution_scripts_styles' );


/**

 * Add preconnect for Google Fonts.

 *

 * @since Revolution 2.2

 *

 * @param array   $urls          URLs to print for resource hints.

 * @param string  $relation_type The relation type the URLs are printed.

 * @return array URLs to print for resource hints.

 */

function revolution_resource_hints( $urls, $relation_type ) {

	if ( wp_style_is( 'revolution-fonts', 'queue' ) && 'preconnect' === $relation_type ) {

		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {

			$urls[] = array(

				'href' => 'https://fonts.gstatic.com',

				'crossorigin',

			);

		} else {

			$urls[] = 'https://fonts.gstatic.com';

		}

	}



	return $urls;

}

add_filter( 'wp_resource_hints', 'revolution_resource_hints', 10, 2 );

/**

 * Filter the page title.

 *

 * Creates a nicely formatted and more specific title element text

 * for output in head of document, based on current view.

 *

 * @since Revolution 1.0

 *

 * @param string $title Default title text for current view.

 * @param string $sep Optional separator.

 * @return string Filtered title.

 */

function revolution_wp_title( $title, $sep ) {

	global $paged, $page;

	if ( is_feed() )

		return $title;



	// Add the site name.

	$title .= get_bloginfo( 'name', 'display' );



	// Add the site description for the home/front page.

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )

		$title = "$title $sep $site_description";



	// Add a page number if necessary.

	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )

		$title = "$title $sep " . sprintf( __( 'Page %s', 'text-domain' ), max( $paged, $page ) );



	return $title;

}

add_filter( 'wp_title', 'revolution_wp_title', 10, 2 );

/**

 * Filter the page menu arguments.

 *

 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.

 *

 * @since Revolution 1.0

 */
function revolution_page_menu_args( $args ) {

	if ( ! isset( $args['show_home'] ) )

		$args['show_home'] = true;

	return $args;

}

add_filter( 'wp_page_menu_args', 'revolution_page_menu_args' );

if ( ! function_exists( 'revolution_content_nav' ) ) :

/**

 * Displays navigation to next/previous pages when applicable.

 *

 * @since Revolution 1.0

 */

function revolution_content_nav( $html_id ) {

	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>

		<nav id="<?php echo esc_attr( $html_id ); ?>" class="navigation" role="navigation">

			<h3 class="assistive-text"><?php _e( 'Post navigation', 'text-domain' ); ?></h3>

			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'text-domain' ) ); ?></div>

			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'text-domain' ) ); ?></div>

		</nav><!-- .navigation -->

	<?php endif;

}

endif;

if ( ! function_exists( 'revolution_comment' ) ) :

/**

 * Template for comments and pingbacks.

 *

 * To override this walker in a child theme without modifying the comments template

 * simply create your own revolution_comment(), and that function will be used instead.

 *

 * Used as a callback by wp_list_comments() for displaying the comments.

 *

 * @since Revolution 1.0

 */

function revolution_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :

		case 'pingback' :

		case 'trackback' :

		// Display trackbacks differently than normal comments.

	?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">

		<p><?php _e( 'Pingback:', 'text-domain' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'text-domain' ), '<span class="edit-link">', '</span>' ); ?></p>

	<?php

			break;

		default :

		// Proceed with normal comments.

		global $post;

	?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

		<article id="comment-<?php comment_ID(); ?>" class="comment">

			<header class="comment-meta comment-author vcard">

				<?php

					echo get_avatar( $comment, 44 );

					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',

						get_comment_author_link(),

						// If current post author is also comment author, make it known visually.

						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'text-domain' ) . '</span>' : ''

					);

					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',

						esc_url( get_comment_link( $comment->comment_ID ) ),

						get_comment_time( 'c' ),

						/* translators: 1: date, 2: time */

						sprintf( __( '%1$s at %2$s', 'text-domain' ), get_comment_date(), get_comment_time() )

					);

				?>

			</header><!-- .comment-meta -->



			<?php if ( '0' == $comment->comment_approved ) : ?>

				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'text-domain' ); ?></p>

			<?php endif; ?>



			<section class="comment-content comment">

				<?php comment_text(); ?>

				<?php edit_comment_link( __( 'Edit', 'text-domain' ), '<p class="edit-link">', '</p>' ); ?>

			</section><!-- .comment-content -->



			<div class="reply">

				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'text-domain' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

			</div><!-- .reply -->

		</article><!-- #comment-## -->

	<?php

		break;

	endswitch; // end comment_type check

}

endif;

if ( ! function_exists( 'revolution_entry_meta' ) ) :

/**

 * Set up post entry meta.

 *

 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.

 *

 * Create your own revolution_entry_meta() to override in a child theme.

 *

 * @since Revolution 1.0

 */

function revolution_entry_meta() {

	// Translators: used between list items, there is a space after the comma.

	$categories_list = get_the_category_list( __( ', ', 'text-domain' ) );



	// Translators: used between list items, there is a space after the comma.

	$tag_list = get_the_tag_list( '', __( ', ', 'text-domain' ) );



	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',

		esc_url( get_permalink() ),

		esc_attr( get_the_time() ),

		esc_attr( get_the_date( 'c' ) ),

		esc_html( get_the_date() )

	);



	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',

		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),

		esc_attr( sprintf( __( 'View all posts by %s', 'text-domain' ), get_the_author() ) ),

		get_the_author()

	);



	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.

	if ( $tag_list ) {

		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'text-domain' );

	} elseif ( $categories_list ) {

		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'text-domain' );

	} else {

		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'text-domain' );

	}



	printf(

		$utility_text,

		$categories_list,

		$tag_list,

		$date,

		$author

	);

}

endif;

/**

 * Extend the default WordPress body classes.

 *

 * Extends the default WordPress body class to denote:

 * 1. Using a full-width layout, when no active widgets in the sidebar

 *    or full-width template.

 * 2. Front Page template: thumbnail in use and number of sidebars for

 *    widget areas.

 * 3. White or empty background color to change the layout and spacing.

 * 4. Custom fonts enabled.

 * 5. Single or multiple authors.

 *

 * @since Revolution 1.0

 *

 * @param array $classes Existing class values.

 * @return array Filtered class values.

 */

function revolution_body_class( $classes ) {

	global $post;

		

	if(isset( $post->post_name )){		

		$post_slug = $post->post_name;    

		$classes[] =  $post_slug;

	}

    

	$background_color = get_background_color();

	$background_image = get_background_image();



	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )

		$classes[] = 'full-width';



	if ( is_page_template( 'page-templates/front-page.php' ) ) {

		$classes[] = 'template-front-page';

		if ( has_post_thumbnail() )

			$classes[] = 'has-post-thumbnail';

		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )

			$classes[] = 'two-sidebars';

	}



	if ( empty( $background_image ) ) {

		if ( empty( $background_color ) )

			$classes[] = 'custom-background-empty';

		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )

			$classes[] = 'custom-background-white';

	}



	// Enable custom font class only if the font CSS is queued to load.

	if ( wp_style_is( 'revolution-fonts', 'queue' ) )

		$classes[] = 'custom-font-enabled';



	if ( ! is_multi_author() )

		$classes[] = 'single-author';



	return $classes;

}

add_filter( 'body_class', 'revolution_body_class' );

/**

 * Adjust content width in certain contexts.

 *

 * Adjusts content_width value for full-width and single image attachment

 * templates, and when there are no active widgets in the sidebar.

 *

 * @since Revolution 1.0

 */

function revolution_content_width() {

	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {

		global $content_width;

		$content_width = 960;

	}

}

add_action( 'template_redirect', 'revolution_content_width' );
/**

 * Register postMessage support.

 *

 * Add postMessage support for site title and description for the Customizer.

 *

 * @since Revolution 1.0

 *

 * @param WP_Customize_Manager $wp_customize Customizer object.

 */

function revolution_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';

	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial( 'blogname', array(

			'selector' => '.site-title > a',

			'container_inclusive' => false,

			'render_callback' => 'revolution_customize_partial_blogname',

		) );

		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(

			'selector' => '.site-description',

			'container_inclusive' => false,

			'render_callback' => 'revolution_customize_partial_blogdescription',

		) );

	}

}

add_action( 'customize_register', 'revolution_customize_register' );

/**

 * Render the site title for the selective refresh partial.

 *

 * @since Revolution 2.0

 * @see revolution_customize_register()

 *

 * @return void

 */

function revolution_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**

 * Render the site tagline for the selective refresh partial.

 *

 * @since Revolution 2.0

 * @see revolution_customize_register()

 *

 * @return void

 */

function revolution_customize_partial_blogdescription() {

	bloginfo( 'description' );

}

/**

 * Enqueue Javascript postMessage handlers for the Customizer.

 *

 * Binds JS handlers to make the Customizer preview reload changes asynchronously.

 *

 * @since Revolution 1.0

 */

function revolution_customize_preview_js() {

	wp_enqueue_script( 'revolution-customizer', JS_PATH.'theme-customizer.js', array( 'customize-preview' ), '20141120', true );

}

//add_action( 'customize_preview_init', 'revolution_customize_preview_js' );


/**

 * For Upload SVG Image Support

 */

function revolution_mime_types($mimes) {

  $mimes['svg'] = 'image/svg';
  $mimes['ico'] = 'image/x-icon';
  
  return $mimes;

}

add_filter('upload_mimes', 'revolution_mime_types');

//allow ico file in media
add_filter( 'wp_mime_type_icon', function( $icon, $mime, $post_id )
{
    if( $src = false || 'image/x-icon' === $mime && $post_id > 0 )
        $src = wp_get_attachment_image_src( $post_id );

    return is_array( $src ) ? array_shift( $src ) : $icon;
}, 10, 3 ); 



/**

 * function to print an array with PRE tag

 */

function debug($array  = array()){

	echo "<pre>";

	print_r($array);

	echo "</pre>";

}

/**

 * function to retrieve global options (Theme Options)

 * 

 * @args : name of option field

 */

function options($args)
{
	return get_field($args, 'options');
}

/**
 * function to manage login window of wordpress, /wp-admin
 * 
 * It takes parameter from "Admin Login Panel" under "Theme Options"
 */	

	add_action( 'login_enqueue_scripts', 'my_login_logo' );

	function my_login_logo() 

	{ 

		$logo = options('admin_logo');

		$logo_width = options('admin_logo_width').'px'; 

		$logo_height = options('admin_logo_height').'px'; 

		$bg_color = options('admin_background_color');

		$btn_color = options('admin_login_button_color');

		$label_color = options('admin_label_color');

		$btn_style = options('admin_button_style');

		// Background Color

		if($bg_color != '')

		{$bg_color = $bg_color ;}

		else

		{ $bg_color = '#fff'; } 

		

		// Button Color

		if($btn_color != '')

		{$btn_color = $btn_color ;}

		else

		{ $btn_color = '#cf202f'; } 

		

		// Label Color

		if($label_color != '')

		{$label_color = $label_color ;}

		else

		{ $label_color = '#182A54'; } 

	?>

    <style type="text/css">

        #login h1 a, .login h1 a {

        background-image: url(<?php echo $logo; ?>);

		height:<?php echo $logo_height; ?>;

		width:<?php echo $logo_width; ?>;

		background-size:<?php echo $logo_width .' '. $logo_height; ?>;

		background-repeat: no-repeat;

        padding-bottom: 0px;

        }

        body.login, #loginform label{

		  background: #fff none repeat scroll 0 0 !important;

		  color: <?php echo $label_color; ?>;

		  font-size: 18px;

		}

		<?php if($btn_style == 'round'):?>

		.login .button.button-primary.button-large {

		  background: <?php echo $btn_color; ?> none repeat scroll 0 0;

		  border: 1px solid <?php echo $btn_color; ?>;

		  border-radius: 100%;

		  height: 65px !important;

		  width: 65px !important;

		  color:#fff;

		  padding:0 !important;

		  font-size: 15px;

		  box-shadow:none;

		  text-shadow:none;

		}

		.login .forgetmenot > label {

		  padding-top: 40px;

		}

		<?php else : ?>

		

		.login .button.button-primary.button-large {

		  background: <?php echo $btn_color; ?> none repeat scroll 0 0;

		  border: 1px solid <?php echo $btn_color; ?>;

		  border-radius: 5px;

		  color:#fff;

		  font-size: 15px;

		  box-shadow:none;

		  text-shadow:none;

		}

			

		<?php endif;?>

				

		.login .button.button-primary.button-large:hover{

			background-color: transparent;

			border: 1px solid <?php echo $btn_color; ?>;

			color: <?php echo $btn_color; ?>;

			font-size: 15px;

		}

		.login.login-action-login {

			background: <?php echo $bg_color;?> !important;

		}

    </style>

<?php }

/**

 * Changing WordPress URL to site url from logo, from WordPress login page

 */

add_filter( 'login_headerurl', 'custom_loginlogo_url' );

function custom_loginlogo_url($url) {

    return site_url();

}

/**

 * Change title from logo, from WordPress login page

 */

add_filter( 'login_headertext', 'my_login_logo_url_title' );

function my_login_logo_url_title() {

    $site_title = get_bloginfo( 'name' ) ;

    return $site_title;

} 

/**

 * Removing admin bar from non-admin users. After login, on front-end, only admin users can see admin bar on the top

 */

if ( ! current_user_can( 'manage_options' ) ) {

	show_admin_bar( false );

}
/**

 * Creating 'theme-option-settings' as option page

 */

if( function_exists('acf_add_options_page') ) {
	$option_page = acf_add_options_page(array(

		'page_title' 	=> 'Theme Options',

		'menu_title' 	=> 'Theme Options',

		'menu_slug' 	=> 'theme-option-settings',

		'capability' => 'edit_posts',

		'redirect' 	=> false

	));

	acf_add_options_page($option_page);

}

/**

 * Registering Google Map Api key for ACF Google Map

 */
add_filter('acf/fields/google_map/api', 'acf_google_map_api');

function acf_google_map_api( $api ){

	$api['key'] = options('google_map_api');

 	return $api;

}

/**

 * Standard Pagination Code to be placed out of loop (WP_Query)

 */
function show_pagination( $max_num_pages ){

	if($max_num_pages > 1)

	{

		$big = 999999999;		

		$pagination = '<div class="column paginetion-blk"><div class="left-blk">';

		$pagination .= paginate_links( array(

				'type' => 'list',

				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),

				'format' => '?paged=%#%',

				'current' => max( 1, get_query_var('paged') ),

				'total' => $max_num_pages,

				'prev_next' => true,

				'prev_text' => '<span class="icon icon-prev"></span> Previous',

				'next_text' => 'Next <span class="icon icon-next"></span>',

			) ); 

		$pagination .= 	'</div></div>';

		return $pagination;

	}

	else

	{

		return '';

	}

}

/**

 * Shortcode : Showing custom breadcrumbs

 */

add_shortcode('custom-breadcrumb','show_breadcrumb');

function show_breadcrumb() {

    global $post;

	

	if(options('show_bradcrumb') == '1'){

	

	global $post;	

	$post_id = get_the_ID();	

	$listClass = 'breadcrumb-item';

	$breadcrumbHtml = '';

	

    $breadcrumbHtml .= "<div class='breadcrumb p-0 m-0 breadcrumb-main'><div class='container'><ul class='breadcrumb m-0 pl-0 pr-0'>";

	if (!is_front_page()) {

		

		$breadcrumbHtml .= "<li class='home $listClass'><a href='". esc_url( home_url( '/' ) )."'> Home</a></li>";

		

			

		if ( is_category() ||  is_tax() || is_single() || is_tag() ) {

			

			// Get the Post Type Name of each and individual 

			$cat_type = '';

			if( get_post_type($post_id) == 'post') 

			{

			  $breadcrumbHtml .= "<li class='$listClass'><a href='".site_url()."/news'> News </a></li>";

			  $cat_type = 'category';

			  	

			}

			else if( get_post_type($post_id) == 'resources') 

			{

			  $breadcrumbHtml .= "<li class='$listClass'><a href='".site_url()."/resource'>".ucfirst( get_post_type($post_id) )."</a></li>";

			  $cat_type = 'resources_categories';

			  	

			}

			else {

				 $breadcrumbHtml .= "<li class='$listClass'><span>" .ucfirst( get_post_type($post_id) )."</span></li>";

			}

			

			// Get the Category of each Post type			

				

			if(is_category() || is_tax( $cat_type ) ){

				$categories = get_the_terms( $post_id, $cat_type );

				$cats = array();

				if(is_array($categories) && !empty($categories)){

					foreach( $categories as $category ) {

						array_push($cats, $category->name);										

					}

				}

				if (sizeOf($category) > 0) {

					$post_categories = implode(', ', $cats);

					$breadcrumbHtml .= "<li class='$listClass'><span>".$post_categories."</span></li>";

				} 

			}

			else if( is_tag() ){

				

				$post_categories = single_tag_title("", false);

				$breadcrumbHtml .= "<li class='$listClass'><span>".$post_categories."</span></li>";

				 

			}

			else

			{

				// else goes here

			}

			

			$category = get_queried_object();

			$page_tax_id = $category->term_id; 

		

			// print the Single page title

			if ( is_single() ) {

				

				$categories = get_the_terms( $post_id, $cat_type );

				

				$cats = array();

				if(is_array( $categories ) && !empty( $categories )){

				foreach( $categories as $category ) {

					$category_link = esc_url ( get_category_link( $category->term_id ) );

					$cate_with_url = "<a href='$category_link'>".$category->name."</a>";

					array_push($cats, $cate_with_url);

				}

				

				

				if (sizeOf($category) > 0) {

				$post_categories = implode(', ', $cats);

					

					

					$breadcrumbHtml .= "<li class='$listClass'><span>".$post_categories."</span></li>";

				} 

				

				$breadcrumbHtml .= "<li class='$listClass'><span>".get_the_title()."</span></li>";

				}

			}

		} 

		elseif ( is_page() && $post->post_parent ) 

		{

			$home = get_page(get_option('page_on_front'));

			for ($i = count($post->ancestors)-1; $i >= 0; $i--) 

			{

				if (($home->ID) != ($post->ancestors[$i])) 

				{

					$np_id = $post->ancestors[$i];

					$breadcrumbHtml .= "<li class='$listClass'><a href='".get_permalink($np_id)."'>".trim( get_the_title($np_id) )."</a></li>";

				}

			}

			$breadcrumbHtml .= "<li class='$listClass'><span>".get_the_title()."</span></li>";

		} 

		elseif (is_page()) 

		{

			$breadcrumbHtml .= "<li class='$listClass'><span>".get_the_title()."</span></li>";

		} 

		elseif (is_404()) 

		{

			$breadcrumbHtml .= "<li class='$listClass'><span>404</span></li>";

		}

	} 

	else 

	{

		$breadcrumbHtml .= "<li class='$listClass'>".get_bloginfo('name')."</li>";

	}

	$breadcrumbHtml .= "</ul></div></div>";

	

	echo $breadcrumbHtml;

	

	}

}
/*=========================================================================

 *  			Header Logo function to show

 * ========================================================================*/
if(! function_exists('logo_header') ) {

	function logo_header() {

		$blogName =  get_bloginfo( "name" );

		$logo = options('main_logo');

		$sticky_header = options('sticky_header');

		$sticky_logo = options('sticky_logo');

		

		echo '<div class="logo-wrap">';

			if($logo != '')

			{			

				if($sticky_header == 1 && $sticky_logo != '')

				{

					echo '<a href="'. esc_url( home_url( '/' ) ).'"><img src="'.$sticky_logo.'" alt="'.$blogName.'" /></a>';

				}

				else

				{

					echo '<a href="'. esc_url( home_url( '/' ) ).'"><img src="'.$logo.'" alt="'.$blogName.'" /></a>';

				}	

			}

			else

			{			

				echo '<h1 class="site-title"><a href="'. esc_url( home_url( '/' ) ).'" rel="home">'. $blogName .'</a></h1>';			

			}

			$description = get_bloginfo( 'description', 'display' );

			if ( $description || is_customize_preview() ) : 

				echo '<p class="site-description">'. $description.'</p>';

			endif; 

		echo '</div>';

	}

}

/*==================================================================

 *  Include Script in HEAD

 *================================================================== */
function google_analytics_code()

{

	if(!empty(options('google_analytics_code')))

	{

		echo trim( options('google_analytics_code') ) ;	

	}

	

} 

/*==================================================================

 *  Include Script in Body

 *================================================================== */



function scipt_print_in_body()

{

	if(!empty(options('body_analytics_code_gtm')))

	{

		echo trim( options('body_analytics_code_gtm') ) ;	

	}
} 


/*==================================================================

 *  Blog Comment form Hook to arange order and fields

 *================================================================== */



function move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;

}

add_filter( 'comment_form_fields', 'move_comment_field_to_bottom' );


// ==============================================================================

// Get Taxonomy list

// ==============================================================================

function print_taxonomy_list($post_id, $taxonomy_name)  {
	 $category = '';

	 $post_categories = '';
	 $categories = get_the_terms( $post_id, $taxonomy_name );

	 $cats = array();

	 $count = 0;

	 if( is_array($categories) && !empty($categories)){

		foreach( $categories as $category ) {										

			$category_url = get_term_link($category->term_id);

			$categorying = '<span><a href="'.$category_url.'">'.$category->name.'</a></span>';					

			array_push($cats, $categorying);										

		}

	 }

	 if (sizeOf($category) > 0) {

		$post_categories = implode(', ', $cats);

	 } 

	 return $post_categories;	 

}

// ==============================================================================

// Get template with with pass custom parameters

// ==============================================================================

if( ! function_exists('rev_get_template_part')){

	function rev_get_template_part($slug = null, $name = null, array $params = array()) {

		global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

		do_action("get_template_part_{$slug}", $slug, $name);

		$templates = array();

		if (isset($name))

			$templates[] = "{$slug}-{$name}.php";

			$templates[] = "{$slug}.php";

			$_template_file = locate_template($templates, false, false);

		if (is_array($wp_query->query_vars)) {

			extract($wp_query->query_vars, EXTR_SKIP);

		}

		extract($params, EXTR_SKIP);

		require($_template_file);

	}

}

/**

 * Detect only cellular mobile devices and no tablets

 */

function my_wp_is_mobile() {

	include_once ( get_template_directory() . '/includes/Mobile_Detect.php');

	$detect = new Mobile_Detect;

	if( $detect->isMobile() && !$detect->isTablet() ) {

		return true;

	} else {

		return false;

	}

}

/**

 * Detect only tablets and no cellular mobile devices

 */
function my_wp_is_tablet() {

	include_once ( get_template_directory() . '/includes/Mobile_Detect.php');

	$detect = new Mobile_Detect;

	if( $detect->isTablet()) {

		return true;

	} else {		

		return false;

	}

}

/**

 * including TGM file for installing plugin bundle on theme activation

 */  

require_once( get_stylesheet_directory().'/TGM/run.php' );


add_shortcode( 'flexlayout','flexLayout' );
function flexLayout($attr)
{
	$fields = get_field_objects();
	debug($fields);
	$flex_field=$attr['name'];
	$fid=$fields[$flex_field]['ID'];
	if ( isset($fid) && $fid!='')
	{
		$sections = array();
		$mydata = get_post_field('post_content',$fid);
		$mydata = unserialize($mydata);
		$newdata=$mydata['layouts'];
		foreach($newdata as $l){
			array_push($sections,$l['name']);
		}
		if ( have_rows( $flex_field ) ) : 
			while ( have_rows( $flex_field ) ) : the_row(); 
				if ( in_array(get_row_layout(),$sections) ) : 
					$filename = get_stylesheet_directory()."/flexible-sections/".get_row_layout().".php";
					if(!file_exists($filename)):
					    $myfile = fopen( get_template_directory()."/flexible-sections/".get_row_layout().".php", "w") or die("Unable to open file!");
				        $txt = '<section id="'.get_row_layout().'">Add HTML code Here</section>';
				        fwrite($myfile, $txt);
				        fclose($myfile);
					endif;								
					get_template_part("/flexible-sections/".get_row_layout());
				endif;
			endwhile;
		else: 
			get_template_part( 'content', 'noflex' );
		endif;
	}else{
		get_template_part( 'content', 'noflex' );
	}	
}



/**

 * shifting default js files to footer from header

 */  

//add_action( 'wp_enqueue_scripts', 'shiftingJSToFooter' );

function shiftingJSToFooter() { 

   remove_action('wp_head', 'wp_print_scripts'); 

   remove_action('wp_head', 'wp_print_head_scripts', 9); 

   remove_action('wp_head', 'wp_enqueue_scripts', 1);

 

   add_action('wp_footer', 'wp_print_scripts', 5);

   add_action('wp_footer', 'wp_enqueue_scripts', 5);

   add_action('wp_footer', 'wp_print_head_scripts', 5); 

} 





function _remove_script_version($src) {

    $parts = explode('?ver', $src);
    return $parts[0];

}



/**

 * shifting default js files to footer from header

 */  
add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);
