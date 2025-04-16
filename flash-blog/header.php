<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flash Blog
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    }
    ?>

    <?php if (flash_blog_get_option('enable_preloader_option') == 1){ ?>
        <div class="preloader">
            <div class="layer"></div>
            <div class="layer"></div>
            <div class="layer"></div>
            <div class="layer"></div>
            <div class="inner">
                <figure class="animateFadeInUp">
                    <div class="load-spinner"></div>
                </figure>
            </div>
            <!-- end inner -->
        </div>
        <!-- end preloader -->
        <div class="transition-overlay">
            <div class="layer"></div>
            <div class="layer"></div>
            <div class="layer"></div>
            <div class="layer"></div>
        </div>
        <!-- end transition-overlay -->
    <?php } ?>
    <?php if (flash_blog_get_option('enable_cursor_option') == 1){ ?>
        <div class="theme-custom-cursor theme-cursor-primary"></div>
        <div class="theme-custom-cursor theme-cursor-secondary">
            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.06055 0H20.0605V18H17.0605V5.12155L2.12132 20.0608L0 17.9395L14.9395 3H2.06055V0Z"/>
            </svg>
        </div>
    <?php } ?>
<div id="page" class="site <?php if (flash_blog_get_option('enable_featured_page_section') == 1) {
    echo "content-block";
} ?>">
<?php if (has_header_image()) {
    $flash_blog_header_img_cl = "header-image";
} else {
    $flash_blog_header_img_cl = "header-image-null";
}
$flash_blog_header_color = "";
$flash_blog_header_color = flash_blog_get_option('header_bg_scheme');
if ($flash_blog_header_color == 'dark-scheme') {
    $flash_blog_header_colors = "dark-scheme";
} else {
    $flash_blog_header_colors = "light-scheme";
}
$flash_blog_header_img = get_header_image(); ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'flash-blog'); ?></a>
    <header id="masthead" class="site-header <?php echo esc_attr($flash_blog_header_img_cl); ?> <?php echo esc_attr($flash_blog_header_colors); ?>" data-background="<?php echo esc_url($flash_blog_header_img); ?>">
        <!-- header -->
        <div class="wrapper">
            <div class="site-header-panel">
                <div class="site-branding">
                    <div class="logo">
                        <?php
                        the_custom_logo();
                        if (is_front_page() && is_home()) : ?>
                            <h1 class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </h1>
                        <?php else : ?>
                            <p class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </p>
                        <?php
                        endif;

                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) : ?>
                            <p class="site-description">
                                <?php echo esc_html($description); ?>
                            </p>
                        <?php
                        endif; ?>
                    </div>
                </div>
                <div class="united-navigation">
                    <nav id="site-navigation" class="main-navigation">
                        <button class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                            <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'flash-blog'); ?></span>
                            <i class="united-toggle-icon"></i>
                        </button>
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'mainnav',
                            'menu_id' => 'primary-menu',
                            'container' => 'div',
                            'container_class' => 'menu'
                        ));
                        ?>

                        <button type="button" class="icon-search" aria-label="search">
                            <?php echo flash_blog_get_svg( array( 'icon' => 'loupe' ) ); ?>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div class="model-search">
        <a href="javascript:void(0)" class="searchbar-skip-link"></a>
        <a href="javascript:void(0)" class="cross-exit"></a>
        <div class="model-search-wrapper">
            <div class="popup-form">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>

    <div id="content" class="site-content">