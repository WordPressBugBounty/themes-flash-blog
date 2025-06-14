<?php
/**
 * Flash Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flash Blog
 */

if (!function_exists('flash_blog_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function flash_blog_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Flash Blog, use a find and replace
	 * to change 'flash-blog' to the name of your theme in all the template files.
	 */
    load_theme_textdomain('flash-blog', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(array(
			'mainnav' => esc_html__('Primary Menu', 'flash-blog'),
			'social'  => __('Social Menu', 'flash-blog'),
		));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

	// Set up the WordPress core custom background feature.
	add_theme_support('custom-background', apply_filters('flash_blog_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)));

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		));

    /**
     * Add theme support for gutenberg block
     *
     */
    add_theme_support( 'align-wide' );

    add_theme_support( 'responsive-embeds' );

    add_theme_support( 'wp-block-styles' );
}
endif;
add_action('after_setup_theme', 'flash_blog_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flash_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters('flash_blog_content_width', 640);
}
add_action('after_setup_theme', 'flash_blog_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flash_blog_widgets_init() {
	register_sidebar(array(
			'name'          => esc_html__('Sidebar', 'flash-blog'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'flash-blog'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		));
    register_sidebar(array(
        'name' => esc_html__('Footer Column 1', 'flash-blog'),
        'id' => 'footer-col-1',
        'description' => esc_html__('Displays items on footer section.', 'flash-blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Column 2', 'flash-blog'),
        'id' => 'footer-col-2',
        'description' => esc_html__('Displays items on footer section.', 'flash-blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Column 3', 'flash-blog'),
        'id' => 'footer-col-3',
        'description' => esc_html__('Displays items on footer section.', 'flash-blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
}
add_action('widgets_init', 'flash_blog_widgets_init');

/**
 * Add Google Font
 */
if (!function_exists('flash_blog_fonts_url')):

/**
 * Return fonts URL.
 *
 * @since 1.0.0
 * @return string Fonts URL.
 */
function flash_blog_fonts_url() {

	$fonts_url = '';
    $fonts = array();

    $font_1 = 'Inter:300,300i,400,400i,500,500i,600,600i,700,700i';
    $font_2 = 'Oswald:300,400,500,700';

    $font_array = array();
    $font_array[] = $font_1;
    $font_array[] = $font_2;

    $flash_blog_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

    $i = 0;
    for ($i = 0; $i < count($font_array); $i++) {

        if ('off' !== sprintf(_x('on', '%s font: on or off', 'flash-blog'), $font_array[$i])) {
            $fonts[] = $font_array[$i];
        }

    }

    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urldecode(implode('|', $fonts)),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css');

    }
    return $fonts_url;

}
endif;

/**
 * Enqueue scripts and styles.
 */
function flash_blog_scripts() {
	$min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG?'':'.min';

	$theme_version = wp_get_theme()->get( 'Version' );
    $fonts_url = flash_blog_fonts_url();
    if( $fonts_url ){
        
        require_once get_theme_file_path( 'assets/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
            'flash-blog-google-fonts',
            wptt_get_webfont_url( $fonts_url ),
            array(),
            $theme_version
        );
    }

	wp_enqueue_style('jquery-slick', get_template_directory_uri().'/assets/slick/css/slick'.$min.'.css');
	wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/magnific-popup.css');

	wp_enqueue_style('flash-blog-style', get_stylesheet_uri(), array(), $theme_version );
    wp_style_add_data('flash-blog-style', 'rtl', 'replace');

	wp_enqueue_script('flash-blog-navigation', get_template_directory_uri().'/js/navigation.js', array(), '20151215', true);

	wp_enqueue_script('flash-blog-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array(), '20151215', true);

	wp_enqueue_script('jquery-slick', get_template_directory_uri().'/assets/slick/js/slick'.$min.'.js', array('jquery'), '', true);
	wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri() . '/assets/magnific-popup/jquery.magnific-popup' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('theiaStickySidebar', get_template_directory_uri() . '/assets/theiaStickySidebar/theia-sticky-sidebar'.$min.'.js', array('jquery'), '', true);
	wp_enqueue_script('flash-blog-script', get_template_directory_uri().'/js/script.js', array('jquery'), '', 1);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
    $custom_css = flash_blog_custom_css();
    if ( $custom_css ) {
        wp_add_inline_style( 'flash-blog-style', $custom_css );
    }

}
add_action('wp_enqueue_scripts', 'flash_blog_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function flash_blog_admin_scripts()
{
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/admin-style.css');
    wp_enqueue_script('flash-admin-script', get_template_directory_uri() . '/assets/js/admin-page.js', array('jquery'), '', 1);
    
}

add_action('admin_enqueue_scripts', 'flash_blog_admin_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory().'/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-tags.php';

/**
 * Custom functions for this theme.
 */
require get_template_directory().'/inc/custom-functions.php';

/**
 * Custom hooks for this theme.
 */
require get_template_directory().'/inc/custom-hooks.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory().'/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer/customizer.php';

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory().'/inc/jetpack.php';
}

/**
 * admin page.
 */
require get_parent_theme_file_path('/inc/admin-page/admin-about.php');

/**
 * CSS related hooks.
 */

if (!function_exists('flash_blog_custom_css')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
    function flash_blog_custom_css()
    {
    }

endif;