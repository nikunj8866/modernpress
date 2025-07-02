<?php
/**
 * ModernPress functions and definitions
 *
 * @package ModernPress
 */

if (!defined('ABSPATH')) {
    exit;
}

define('MODERNPRESS_VERSION', '1.0.0');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function modernpress_setup() {
    // Make theme available for translation
    load_theme_textdomain('modernpress', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(
        array(
            'primary' => esc_html__('Primary', 'modernpress'),
            'footer' => esc_html__('Footer Menu', 'modernpress'),
        )
    );

    // Switch default core markup to output valid HTML5
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature
    add_theme_support(
        'custom-background',
        apply_filters(
            'modernpress_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for custom logo
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
        )
    );

    // Add support for full and wide align images
    add_theme_support('align-wide');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Enqueue editor styles
    add_editor_style('assets/css/editor-style.css');

    // Add support for core block patterns
    add_theme_support('core-block-patterns');

    // Add support for custom line height controls
    add_theme_support('custom-line-height');

    // Add support for custom units
    add_theme_support('custom-units');

    // Add support for custom spacing
    add_theme_support('custom-spacing');

    // Add support for appearance tools
    add_theme_support('appearance-tools');

    // Add support for border controls
    add_theme_support('border');

    // Add support for link color controls
    add_theme_support('link-color');
}
add_action('after_setup_theme', 'modernpress_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function modernpress_content_width() {
    $GLOBALS['content_width'] = apply_filters('modernpress_content_width', 800);
}
add_action('after_setup_theme', 'modernpress_content_width', 0);

/**
 * Register widget area.
 */
function modernpress_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'modernpress'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'modernpress'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    // Footer widget areas
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar(
            array(
                'name'          => sprintf(esc_html__('Footer Widget Area %d', 'modernpress'), $i),
                'id'            => 'footer-' . $i,
                'description'   => sprintf(esc_html__('Footer widget area %d', 'modernpress'), $i),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );
    }
}
add_action('widgets_init', 'modernpress_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function modernpress_scripts() {
    wp_enqueue_style('modernpress-style', get_stylesheet_uri(), array(), MODERNPRESS_VERSION);
    wp_style_add_data('modernpress-style', 'rtl', 'replace');

    wp_enqueue_script('modernpress-navigation', get_template_directory_uri() . '/assets/js/theme.js', array(), MODERNPRESS_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'modernpress_scripts');

/**
 * Enqueue block editor styles.
 */
function modernpress_block_editor_styles() {
    wp_enqueue_style('modernpress-block-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css', array(), MODERNPRESS_VERSION);
}
add_action('enqueue_block_editor_assets', 'modernpress_block_editor_styles');

/**
 * Add custom colors to the editor.
 */
function modernpress_editor_color_palette() {
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => esc_attr__('Primary Blue', 'modernpress'),
                'slug'  => 'primary-blue',
                'color' => '#0073aa',
            ),
            array(
                'name'  => esc_attr__('Dark Blue', 'modernpress'),
                'slug'  => 'dark-blue',
                'color' => '#005177',
            ),
            array(
                'name'  => esc_attr__('Dark Gray', 'modernpress'),
                'slug'  => 'dark-gray',
                'color' => '#333333',
            ),
            array(
                'name'  => esc_attr__('Medium Gray', 'modernpress'),
                'slug'  => 'medium-gray',
                'color' => '#666666',
            ),
            array(
                'name'  => esc_attr__('Light Gray', 'modernpress'),
                'slug'  => 'light-gray',
                'color' => '#f9f9f9',
            ),
            array(
                'name'  => esc_attr__('White', 'modernpress'),
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
        )
    );
}
add_action('after_setup_theme', 'modernpress_editor_color_palette');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add block patterns.
 */
function modernpress_register_block_patterns() {
    if (function_exists('register_block_pattern')) {
        register_block_pattern(
            'modernpress/hero-section',
            array(
                'title'       => __('Hero Section', 'modernpress'),
                'description' => _x('A hero section with title and description', 'Block pattern description', 'modernpress'),
                'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"backgroundColor":"light-gray"} -->
<div class="wp-block-group alignfull has-light-gray-background-color has-background" style="padding-top:4rem;padding-bottom:4rem"><!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="has-text-align-center">Welcome to Our Website</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">This is a hero section that you can customize with your own content.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
                'categories'  => array('featured'),
            )
        );
    }
}
add_action('init', 'modernpress_register_block_patterns');
