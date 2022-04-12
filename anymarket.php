<?php

/**
 * Plugin Name: Anymarket
 * Plugin URI: https://ic.unicamp.br/~everton
 * Description: Plugin Anymarket para integraçao com o Woocommerce
 * Author: B2S_EvM.
 * Version: 1.0
 * Text Domain: Anymarket
 * Plugin Anymarket
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// ***************** Add script on Theme
function header_scripts()
{
    wp_enqueue_script('scripts', '/wp-content/plugins/anymarket/includes/assets/anymarket.js');
}
add_action('wp_head', 'header_scripts');


// ***************** Add Shortcode
function scanymarket()
{
    include ABSPATH . '/wp-content/plugins/anymarket/includes/create-anymarket.php';
}
add_shortcode('scanymarket', 'scanymarket');

function amcallback()
{
    include ABSPATH . '/wp-content/plugins/anymarket/includes/create-amcallback.php';
}
add_shortcode('amcallback', 'amcallback');


// ***************** Add/Delete Page on Theme
function add_page_anymarket()
{
    $page_anymarket = array(
        'post_title'    => wp_strip_all_tags('anymarket'),
        'post_content'  => "",
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'page'
    );
    wp_insert_post($page_anymarket);
}
register_activation_hook(__FILE__, 'add_page_anymarket');


function remove_page_anymarket()
{
    $page_anymarket = new WP_Query(array('pagename' => 'anymarket'));
    while ($page_anymarket->have_posts()) {
        $page_anymarket->the_post();
        $id = get_the_ID();
    }
    wp_delete_post($id, true);
}
register_deactivation_hook(__FILE__, 'remove_page_anymarket');

function add_page_amcallback()
{
    $page_amcallback = array(
        'post_title'    => wp_strip_all_tags('amcallback'),
        'post_content'  => "",
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'page'
    );
    wp_insert_post($page_amcallback);
}
register_activation_hook(__FILE__, 'add_page_amcallback');


function remove_page_amcallback()
{
    $page_amcallback = new WP_Query(array('pagename' => 'amcallback'));
    while ($page_amcallback->have_posts()) {
        $page_amcallback->the_post();
        $id = get_the_ID();
    }
    wp_delete_post($id, true);
}
register_deactivation_hook(__FILE__, 'remove_page_amcallback');


// ***************** Add style & script for Admin
function style_and_script()
{
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
<?php
    wp_enqueue_style('stilos', '/wp-content/plugins/anymarket/includes/assets/anymarket.css');
    wp_enqueue_script('scripts', '/wp-content/plugins/anymarket/includes/assets/anymarket.js');
}
add_action('admin_enqueue_scripts', 'style_and_script');


// ***************** Page About
function menu_anymarket()
{
    add_menu_page('Anymarket', 'Anymarket', 'edit_posts', 'anymarket', 'function_about', 'dashicons-screenoptions', 1);
}
add_action('admin_menu', 'menu_anymarket');

function function_about()
{
    include ABSPATH . '/wp-content/plugins/anymarket/includes/about.php';
}
add_action('function_about', 'function_about');


// ***************** Include Settings
include ABSPATH . '/wp-content/plugins/anymarket/includes/settings.php';


// ***************** Page products
function products_anymarket()
{
    add_submenu_page('anymarket', 'Products', 'Products', 'edit_posts', 'products', 'function_products', 2);
}
add_action('admin_menu', 'products_anymarket');

function function_products()
{
    include ABSPATH . '/wp-content/plugins/anymarket/includes/products-anymarket.php';
}
add_action('function_products', 'function_products');
