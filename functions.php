<?php

add_action('phpmailer_init', 'send_smtp_email');
function send_smtp_email($phpmailer)
{
    $phpmailer->isSMTP();
    $phpmailer->Host = SMTP_HOST;
    $phpmailer->SMTPAuth = SMTP_AUTH;
    $phpmailer->Port = SMTP_PORT;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->Username = SMTP_USERNAME;
    $phpmailer->Password = SMTP_PASSWORD;
    $phpmailer->From = SMTP_FROM;
    $phpmailer->FromName = SMTP_FROMNAME;
}

/* ========================================================================================================================

Add language support to theme

======================================================================================================================== */
// Method 1: Filter.
function my_acf_google_map_api($api)
{
    $api['key'] = 'AIzaSyD7hUGh__LGCHINuhwO1Nv2-58LJNtvO5I';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Method 2: Setting.
function my_acf_init()
{
    acf_update_setting('google_api_key', 'AIzaSyD7hUGh__LGCHINuhwO1Nv2-58LJNtvO5I');
}
add_action('acf/init', 'my_acf_init');

/* ========================================================================================================================

Required external files

======================================================================================================================== */

require_once 'external/bootstrap-utilities.php';
require_once 'external/bs4navwalker.php';
require_once 'function/class-worpdress-function.php';
require_once 'function/theme-custome-post-type.php';
require_once 'function/wp-send-mail.php';

/* ========================================================================================================================

Add html 5 support to wordpress elements

======================================================================================================================== */
add_theme_support('html5', array(
    'comment-list',
    'search-form',
    'comment-form',
    'gallery',
    'caption',
));

/* ========================================================================================================================

Theme specific settings

======================================================================================================================== */

add_theme_support('post-thumbnails');

//add_image_size( 'name', width, height, crop true|false );

register_nav_menus(array('primary' => 'Primary Navigation'));
register_nav_menus(array('lang' => 'Language'));

/* ========================================================================================================================

Actions and Filters

======================================================================================================================== */
add_image_size('cover', 640, 480, true);
add_image_size('thumbnail-big', 1000, 1000, true);
add_action('wp_enqueue_scripts', 'bootstrap_script_init');
add_filter('body_class', array('BsWp', 'add_slug_to_body_class'));

/* ========================================================================================================================

Custom Post Types - include custom post types and taxonomies here e.g.

e.g. require_once( 'custom-post-types/your-custom-post-type.php' );

======================================================================================================================== */

/**
 * Add scripts via wp_head()
 *
 * @return void
 * @author Keir Whitaker
 */

function bootstrap_script_init()
{

    wp_register_script('reCAPTCHA', 'https://www.google.com/recaptcha/api.js', array('jquery'), '2.0.7', true);
    wp_enqueue_script('reCAPTCHA');

    wp_register_script('slick.min', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '2.0.7', true);
    wp_enqueue_script('slick.min');

    wp_register_script('tether', get_template_directory_uri() . '/js/tether.min.js', array('jquery'), '4.3.1', true);
    wp_enqueue_script('tether');

    wp_register_script('popper', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '4.3.1', true);
    wp_enqueue_script('popper');

    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '4.3.1', true);
    wp_enqueue_script('bootstrap');

    wp_register_script('jqueryunveil', get_template_directory_uri() . '/js/jquery.unveil.js', array('jquery'), '2.0.1', true);
    wp_enqueue_script('jqueryunveil');

    wp_register_script('aosjs', get_template_directory_uri() . '/js/aos.js', array('jquery'), '2.0.1', true);
    wp_enqueue_script('aosjs');

    wp_register_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '2.0.7', true);
    wp_enqueue_script('lightbox');

    wp_register_script('parallax', get_template_directory_uri() . '/js/parallax.min.js', array('jquery'), '2.0.7', true);
    wp_enqueue_script('parallax');

    wp_register_script('player', get_template_directory_uri() . '/js/player.js', array('jquery'), '2.0.7', true);
    wp_enqueue_script('player');

    wp_register_script('player-app', get_template_directory_uri() . '/js/player-app.js', array('jquery'), '2.0.7', true);
    wp_enqueue_script('player-app');

    wp_register_script('site', get_template_directory_uri() . '/js/site.js', array('jquery', 'bootstrap'), '0.0.1', true);
    wp_enqueue_script('site');

    wp_register_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', '', '2.0.7', 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('slick', get_stylesheet_directory_uri() . '/css/slick.css', '', '3.3.7', 'all');
    wp_enqueue_style('slick');

    wp_register_style('slick-theme', get_stylesheet_directory_uri() . '/css/slick-theme.css', '', '3.3.7', 'all');
    wp_enqueue_style('slick-theme');

    wp_register_style('lightbox', get_stylesheet_directory_uri() . '/css/lightbox.css', '', '3.3.7', 'all');
    wp_enqueue_style('lightbox');

    wp_register_style('aoscss', get_stylesheet_directory_uri() . '/css/aos.css', '', '3.3.7', 'all');
    wp_enqueue_style('aoscss');

    wp_register_style('fa', get_stylesheet_directory_uri() . '/css/all.css', '', '3.3.7', 'all');
    wp_enqueue_style('fa');

    wp_register_style('screen', get_stylesheet_directory_uri() . '/style.css', '', array(), 'screen');
    wp_enqueue_style('screen');
}

/* ========================================================================================================================

Security & cleanup wp admin

======================================================================================================================== */

//remove wp version
function theme_remove_version()
{
    return '';
}

add_filter('the_generator', 'theme_remove_version');

//remove default footer text
function remove_footer_admin()
{
    echo "";
}

add_filter('admin_footer_text', 'remove_footer_admin');

//remove wordpress logo from adminbar
function wp_logo_admin_bar_remove()
{
    global $wp_admin_bar;

    /* Remove their stuff */
    $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0);

// Remove default Dashboard widgets
function disable_default_dashboard_widgets()
{
    //remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    remove_meta_box('dashboard_activity', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

remove_action('welcome_panel', 'wp_welcome_panel');

/* ========================================================================================================================

Custom login

======================================================================================================================== */

// Add custom css
function my_custom_login()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/custom-login-style.css" />';
}
add_action('login_head', 'my_custom_login');

// Link the logo to the home of our website
function my_login_logo_url()
{
    return get_bloginfo('url');
}
add_filter('login_headerurl', 'my_login_logo_url');

// Change the title text
function my_login_logo_url_title()
{
    return 'Bootstrap 4 on WordPress';
}
add_filter('login_headertitle', 'my_login_logo_url_title');

/* ========================================================================================================================

Comments

======================================================================================================================== */

/**
 * Custom callback for outputting comments
 *
 * @return void
 * @author Keir Whitaker
 */
//     function bootstrap_comment( $comment, $args, $depth ) {
//         $GLOBALS['comment'] = $comment;

//  if ( $comment->comment_approved == '1' ):
// <li class="media">
//     <div class="media-left">
//          echo get_avatar( $comment );
//     </div>
//     <div class="media-body">
//         <h4 class="media-heading"> comment_author_link() </h4>
//         <time><a href="#comment- comment_ID() " pubdate> comment_date()  at
//                  comment_time() </a></time>
//          comment_text()
//     </div>
//      endif;
//     }

/* ========================================================================================================================

Data PL

======================================================================================================================== */

function dateV($format, $timestamp = null)
{
    $to_convert = array(
        'l' => array('dat' => 'N', 'str' => array('Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota', 'Niedziela')),
        'F' => array('dat' => 'n', 'str' => array('styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień')),
        'f' => array('dat' => 'n', 'str' => array('stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia')),
    );
    if ($pieces = preg_split('#[:/.\-, ]#', $format)) {
        if (null === $timestamp) {$timestamp = time();}
        foreach ($pieces as $datepart) {
            if (array_key_exists($datepart, $to_convert)) {
                $replace[] = $to_convert[$datepart]['str'][(date($to_convert[$datepart]['dat'], $timestamp) - 1)];
            } else {
                $replace[] = date($datepart, $timestamp);
            }
        }
        $result = strtr($format, array_combine($pieces, $replace));
        return $result;
    }
}
/* ========================================================================================================================

Menu Option

======================================================================================================================== */

/* ========================================================================================================================

theme function

======================================================================================================================== */

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup()
{
    load_theme_textdomain('wp_babobski', get_template_directory() . '/language');
}

add_theme_support('custom-logo');

function logo()
{
    $custom_logo_id = get_theme_mod('custom_logo');
    $custom_logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
    return $custom_logo_url;
}

function yearNow()
{
    $yearNow = date('Y');
    return $yearNow;
}

function convertDate($date)
{
    return date("Y m d", strtotime($date));
    $date = "";
}
function reConvertDate($date)
{
    return date("d/m Y", strtotime($date));
    $date = "";
}

function afterTheConcert($date)
{
    $concertDate = convertDate($date);
    $now = date("Y m d");
    if ($concertDate > $now) {
        return true;
    }
    $concertDate = "";
}

/* ========================================================================================================================

Mpas API

======================================================================================================================== */
function upcomingConcert()
{

    $the_query = new WP_Query(array(
        'post_type' => 'road',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    )); ?>

<?php if ($the_query->have_posts()): ?>
<?php while ($the_query->have_posts()): $the_query->the_post(); ?>

<?php
    $month = (string)get_field('data');
        $newDate = date("m-d-Y", strtotime($month));
        echo $newDate;

        ?>

<?php the_title(); ?>




<?php wp_reset_postdata(); ?>
<?php endwhile; ?>
<?php endif;

}

/*
========================================================================================================================

Mpas API

========================================================================================================================
 */

add_action('admin_menu', 'addCustomMenuItem');
function addCustomMenuItem()
{
    add_menu_page('Baza linków', 'Baza linków', 'manage_options', 'custom_admin_page_slug',
        'custom_admin_page_options_function', '', 3);

}
function create_posttype()
{
    register_post_type('concert',
// CPT Options
        array(
            'labels' => array(
                'name' => __('Koncert'),
                'singular_name' => __('Koncert'),
            ),
            'public' => true,
            'has_archive' => false,
            'show_in_menu' => 'custom_admin_page_slug',
            'rewrite' => array('slug' => 'koncert'),
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype');

/*
========================================================================================================================

Mpas API

========================================================================================================================
 */

// function road_columns($columns)
// {
// $columns = array(
// 'cb' => '
// <input type="checkbox" />',
// 'title' => 'Miasto',
// 'road-date' => 'Data wydarzenia',
// 'road-hour' => 'Godzina wydarzenia',
// );
// return $columns;
// }

// function road_column($column)
// {
// global $post;
// if ('road-date' == $column) {
// the_field('data', $post->ID);
// } else {
// echo '';
// }
// }

// function hour_column($column)
// {
// global $post;
// if ('road-hour' == $column) {
// the_field('godzina', $post->ID);
// } else {
// echo '';
// }
// }
// add_filter("manage_edit-road_columns", "road_columns");
// add_action("manage_road_posts_custom_column", "place_column");
// add_action("manage_road_posts_custom_column", "hour_column");

add_action('wp_ajax_ordered_discs', 'ordered_discs');
add_action('wp_ajax_nopriv_ordered_discs', 'ordered_discs');

acf_add_options_page(array(
    'page_title' => __('Formularze kontaktowe'),
    'menu_title' => __('Formularze'),
    'menu_slug' => 'theme-general-form',
    'capability' => 'edit_posts',
    'redirect' => false,
));

acf_add_options_page(array(
    'page_title' => __('Bileterie'),
    'menu_title' => __('Bileterie'),
    'menu_slug' => 'theme-general-tickets',
    'capability' => 'edit_posts',
    'redirect' => false,
));