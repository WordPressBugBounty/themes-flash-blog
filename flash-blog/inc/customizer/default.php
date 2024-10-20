<?php
/**
 * Default theme options.
 *
 * @package Flash Blog
 */

if (!function_exists('flash_blog_get_default_theme_options')):

/**
 * Get default theme options
 *
 * @since 1.0.0
 *
 * @return array Default theme options.
 */
function flash_blog_get_default_theme_options() {

	$defaults = array();

    $defaults['enable_featured_blog'] = 0;
    $defaults['select_category_for_featured_blog'] = 0;
	$defaults['featured_blog_title']    = esc_html__('You May Also Like', 'flash-blog');

	$defaults['header_bg_scheme']            = 'light-scheme';

    $defaults['ed_floating_next_previous_nav']          = 0;

    /*layout*/
	$defaults['read_more_button_text']    = esc_html__('Continue Reading', 'flash-blog');
	$defaults['global_layout']            = 'right-sidebar';
	$defaults['related_post_title']    = esc_html__('Related Post', 'flash-blog');
	$defaults['related_post']            = 1;
	$defaults['excerpt_length_global']    = 50;
	$defaults['pagination_type']          = 'numeric';
	$defaults['copyright_text']           = esc_html__('Copyright All rights reserved', 'flash-blog');

    $defaults['enable_preloader_option']               = 1;
    $defaults['enable_cursor_option']               = 1;
	// Pass through filter.
	$defaults = apply_filters('flash_blog_filter_default_theme_options', $defaults);

	return $defaults;

}

endif;