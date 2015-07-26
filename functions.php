<?php

/*
 * Set up the content width value based on the theme's design.
 */
global $educate_options;
$educate_options = get_option('educate_theme_options');

if (!function_exists('educate_setup')) :

    function educate_setup() {

        register_nav_menus(array(
            'primary' => __('Main Menu', 'educate'),
        ));
        global $content_width;
        if (!isset($content_width))
            $content_width = 1170;


        // Make educate theme available for translation.
        load_theme_textdomain('educate', get_template_directory() . '/languages');
        // This theme styles the visual editor to resemble the theme style.
        add_editor_style(array('css/editor-style.css', educate_font_url()));
        // Add RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(672, 372, true);

        add_image_size('educate-blog-image', 370, 245, true);
        add_image_size('educate-single-blog-image', 800, 450, true);
        add_image_size('educate-full-width', 1110, 576, true);
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list',
        ));
        // Add support for featured content.
        add_theme_support('featured-content', array(
            'featured_content_filter' => 'educate_get_featured_posts',
            'max_posts' => 6,
        ));

        add_theme_support('custom-header', apply_filters('educate_custom_header_args', array(
            'uploads' => true,
            'flex-height' => true,
            'default-text-color' => '#fff',
            'header-text' => true,
            'height' => '120',
            'width' => '1370'
        )));
        add_theme_support('custom-background', apply_filters('educate_custom_background_args', array(
            'default-color' => 'f5f5f5',
        )));
        // This theme uses its own gallery styles.
        add_filter('use_default_gallery_style', '__return_false');
    }

endif; // educate_setup
add_action('after_setup_theme', 'educate_setup');


/* * * Enqueue css and js files ** */
require get_template_directory() . '/functions/enqueue-files.php';

/* * * Theme Default Setup ** */
require get_template_directory() . '/functions/theme-default-setup.php';

/* * * Custom Header ** */
require get_template_directory() . '/functions/custom-header.php';

/* * * Breadcrumbs ** */
require get_template_directory() . '/functions/breadcrumbs.php';
/* * * Theme Option ** */
require get_template_directory() . '/theme-options/theme-options.php';


// https://pippinsplugins.com/a-better-wordpress-excerpt-by-id-function/
function pippin_excerpt_by_id($post, $length = 10, $tags = '<a><em><strong>', $extra = ' . . .') {

    if(is_int($post)) {
        // get the post object of the passed ID
        $post = get_post($post);
    } elseif(!is_object($post)) {
        return false;
    }

    if(has_excerpt($post->ID)) {
        $the_excerpt = $post->post_excerpt;
        return apply_filters('the_content', $the_excerpt);
    } else {
        $the_excerpt = $post->post_content;
    }

    $the_excerpt = strip_shortcodes(strip_tags($the_excerpt), $tags);
    $the_excerpt = preg_split('/\b/', $the_excerpt, $length * 2+1);
    $excerpt_waste = array_pop($the_excerpt);
    $the_excerpt = implode($the_excerpt);
    $the_excerpt .= $extra;

    return apply_filters('the_content', $the_excerpt);
}
