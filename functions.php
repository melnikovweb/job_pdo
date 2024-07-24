<?php

/**
 * SECRET functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SECRET
 */
require_once get_template_directory() . '/functions-parts/theme-version.php';

require_once get_template_directory() . '/includes/utilities/index.php';
require_once get_template_directory() . '/includes/filters/index.php';

require_once get_template_directory() . '/functions-parts/enqueue-scripts/index.php';
require_once get_template_directory() . '/functions-parts/theme-bootstrap/index.php';
require_once get_template_directory() . '/functions-parts/acf/index.php';
require_once get_template_directory() . '/functions-parts/cf7/index.php';
require_once get_template_directory() . '/functions-parts/latepoint/index.php';

require_once get_template_directory() . '/functions-parts/images-sizes.php';

require_once get_template_directory() . '/functions-parts/glossary-search.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function SECRET_setup()
{
  /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on SECRET, use a find and replace
		* to change 'SECRET' to the name of your theme in all the template files.
		*/
  load_theme_textdomain('SECRET', get_template_directory() . '/languages');

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
  register_nav_menus(
    array(
      'header_menu' => 'Header Menu',
      'business_header_menu' => 'Business header Menu',
      'footer_menu' => 'Footer Menu',
      'mobile_menu' => 'Mobile Menu',
      'business_mobile_menu' => 'Business mobile Menu',
    )
  );

  /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
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

  // Set up the WordPress core custom background feature.
  add_theme_support(
    'custom-background',
    apply_filters(
      'SECRET_custom_background_args',
      array(
        'default-color' => 'ffffff',
        'default-image' => '',
      )
    )
  );

  // Add theme support for selective refresh for widgets.
  add_theme_support('customize-selective-refresh-widgets');

  /**
   * Add support for core custom logo.
   *
   * @link https://codex.wordpress.org/Theme_Logo
   */
  add_theme_support(
    'custom-logo',
    array(
      'height'      => 250,
      'width'       => 250,
      'flex-width'  => true,
      'flex-height' => true,
    )
  );
}
add_action('after_setup_theme', 'SECRET_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function SECRET_content_width()
{
  $GLOBALS['content_width'] = apply_filters('SECRET_content_width', 640);
}
add_action('after_setup_theme', 'SECRET_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function SECRET_widgets_init()
{
  register_sidebar(
    array(
      'name'          => esc_html__('Sidebar', 'SECRET-domain-admin'),
      'id'            => 'sidebar-1',
      'description'   => esc_html__('Add widgets here.', 'SECRET-domain-admin'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action('widgets_init', 'SECRET_widgets_init');

function set_header_theme($theme)
{
  // array(
  // 	'background' => string,
  // 	'invert' => boolean
  // )
  $post_id = get_the_ID();
  update_post_meta($post_id, 'header_theme', $theme);
}

function get_header_theme()
{
  $post_id = get_the_ID();
  $theme = get_post_meta($post_id, 'header_theme', true);

  return array(
    'background' => $theme['background'] ?? '',
    'invert' => $theme['invert'] ?? false,
  );
}

/**
 * Custom post types and taxonomies
 */
require get_template_directory() . '/structure/index.php';

/**
 * Duplicating pages and posts
 */
require get_template_directory() . '/functions/duplicatepages.php';

/**
 * Ajax search on blog and categories
 */
require get_template_directory() . '/functions/blogsearch.php';

/**
 * Settings for CF7 forms
 */
require get_template_directory() . '/functions/contactform7.php';

/**
 * Ajax subscribtion form by newsletter plugin
 */
require get_template_directory() . '/functions/ajax/newsletter.php';

/**
 * Pricing page
 */
require get_template_directory() . '/functions/pricing-functions.php';

show_admin_bar(false);


function remove_menus()
{
  remove_menu_page('edit-comments.php'); // Remove comments
}
add_action('admin_menu', 'remove_menus');

// svg, json upload
function add_file_types_to_uploads($file_types)
{
  $new_filetypes = [];
  $new_filetypes['svg'] = 'image/svg+xml';
  $new_filetypes['json'] = 'text/plain';
  $file_types = array_merge($file_types, $new_filetypes);
  return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

// custom class logo
function helpwp_custom_logo_output($html)
{
  $html = str_replace('custom-logo-link', 'hd-logo__link', $html);
  return $html;
}
add_filter('get_custom_logo', 'helpwp_custom_logo_output', 10);

add_filter('wp_get_attachment_image_attributes', function ($attr) {
  if (isset($attr['class'])  && 'custom-logo' === $attr['class'])
    $attr['class'] = 'logo-img';

  return $attr;
});

// add classes to menu <a>
function add_menu_link_class($atts, $item, $args)
{
  if (property_exists($args, 'link_class')) {
    $atts['class'] = $args->link_class;
  }
  return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

if (function_exists('acf_add_options_page')) {

  // Register options page.
  $option_page = acf_add_options_page(array(
    'page_title' => __('General information', 'SECRET-domain-admin'),
  ));
}

function custom_archive_title($title)
{
  if (is_category() || is_tag()) {
    $title = single_cat_title('', false);
  } elseif (is_archive() || is_home()) {
    $title = __('Blog', 'SECRET-domain');
  }

  return $title;
}
add_filter('get_the_archive_title', 'custom_archive_title');
