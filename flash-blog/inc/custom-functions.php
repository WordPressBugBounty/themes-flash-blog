<?php /**
 * Returns word count of the sentences.
 *
 * @since Flash Blog 1.0.0
 */
if (!function_exists('flash_blog_words_count')) :
    function flash_blog_words_count($length = 25, $flash_blog_content = null)
    {
        $length = absint($length);
        $source_content = preg_replace('`\[[^\]]*\]`', '', $flash_blog_content);
        $trimmed_content = wp_trim_words($source_content, $length, '');
        return $trimmed_content;
    }
endif;


if (!function_exists('flash_blog_body_class')) :

    /**
     * body class.
     *
     * @since 1.0.0
     */
    function flash_blog_body_class($flash_blog_body_class)
    {
        $global_layout = flash_blog_get_option('global_layout');
        if ($global_layout == 'left-sidebar') {
            $flash_blog_body_class[] = 'left-sidebar ';
        } elseif ($global_layout == 'no-sidebar') {
            $flash_blog_body_class[] = 'no-sidebar ';
        } else {
            $flash_blog_body_class[] = 'right-sidebar ';

        }
        return $flash_blog_body_class;
    }
endif;

add_action('body_class', 'flash_blog_body_class');


if (!function_exists('flash_blog_excerpt_length')):

    /**
     * Excerpt length
     *
     * @since  flash_blog 1.0.0
     *
     * @param null
     * @return int
     */
    function flash_blog_excerpt_length($length) {
        if ( is_admin() ) {
                return $length;
        }
        $excerpt_length = flash_blog_get_option('excerpt_length_global');
        if (absint($excerpt_length) > 0) {
            $excerpt_length = absint($excerpt_length);
        }

        return absint($excerpt_length);

    }

endif;
add_filter('excerpt_length', 'flash_blog_excerpt_length', 999);

if (!function_exists('flash_blog_excerpt_more') ):

    /**
     * Implement read more in excerpt.
     *
     * @since 1.0.0
     *
     * @param string $more The string shown within the more link.
     * @return string The excerpt.
     */
    function flash_blog_excerpt_more($more) {

        if ( is_admin() ) {
                return $more;
        }
        $flag_apply_excerpt_read_more = apply_filters('flash_blog_filter_excerpt_read_more', true);
        if (true !== $flag_apply_excerpt_read_more) {
            return $more;
        }

        $output         = $more;
        $read_more_text = esc_html(flash_blog_get_option('read_more_button_text'));
        if (!empty($read_more_text)) {
            $output = ' <a href="'.esc_url(get_permalink()).'" class="btn btn-link continue-link">'.esc_html($read_more_text).'</a>';
            $output = apply_filters('flash_blog_filter_read_more_link', $output);
        }
        return $output;

    }

    add_filter('excerpt_more', 'flash_blog_excerpt_more');
endif;

if (!function_exists('flash_blog_posts_navigations')):
    /**
     * Posts navigation.
     *
     * @since 1.0.0
     */
    function flash_blog_posts_navigations() {

        $pagination_type = flash_blog_get_option('pagination_type');

        switch ($pagination_type) {

            case 'default':
                the_posts_navigation();
                break;

            case 'numeric':
                the_posts_pagination();
                break;

            default:
                break;
        }

    }
endif;

add_action('flash_blog_posts_navigation', 'flash_blog_posts_navigations');

if( !function_exists('flash_blog_post_floating_nav') ):

    function flash_blog_post_floating_nav(){

        $ed_floating_next_previous_nav = flash_blog_get_option('ed_floating_next_previous_nav');
        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">

                    <?php
                    if ( get_the_post_thumbnail( $prev_post->ID, 'medium' ) ) {
                        echo get_the_post_thumbnail( $prev_post->ID, 'medium', array( 'class' => 'attachment-medium_large size-medium_large image-responsive' ) );
                    }
                    ?>


                    <a href="<?php echo esc_url( $prev_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'flash-blog'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>

                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">

                    <?php
                    if ( get_the_post_thumbnail( $next_post->ID, 'medium' ) ) {
                        echo get_the_post_thumbnail( $next_post->ID, 'medium', array( 'class' => 'attachment-medium_large size-medium_large image-responsive' ) );
                    }
                    ?>

                    <a href="<?php echo esc_url( $next_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'flash-blog'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>

                </div>

                <?php
            }

        }

    }

endif;

add_action( 'flash_blog_navigation_action','flash_blog_post_floating_nav',10 );

function flash_blog_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    }
    elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    }
    elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }
    elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    }
    elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
    elseif ( is_date() ) {
        $title = single_term_title( '', false );
    }
    return $title;
}

add_filter( 'get_the_archive_title', 'flash_blog_archive_title' );