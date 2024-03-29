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


// ***************** Add/Delete Pages on Theme
function add_pages()
{
    $page_amcallback = array(
        'post_title'    => 'amcallback',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'page'
    );
    wp_insert_post($page_amcallback);

    $page_anymarket = array(
        'post_title'    => 'anymarket',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'page'
    );
    wp_insert_post($page_anymarket);

    $page_invoiced = array(
        'post_title'    => 'invoiced',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'page'
    );
    wp_insert_post($page_invoiced);

    $page_completed = array(
        'post_title'    => 'completed',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'page'
    );
    wp_insert_post($page_completed);
}
register_activation_hook(__FILE__, 'add_pages');

function remove_pages()
{
    $page_amcallback = new WP_Query(array('pagename' => 'amcallback'));
    while ($page_amcallback->have_posts()) {
        $page_amcallback->the_post();
        $id = get_the_ID();
    }
    wp_delete_post($id, true);

    $page_anymarket = new WP_Query(array('pagename' => 'anymarket'));
    while ($page_anymarket->have_posts()) {
        $page_anymarket->the_post();
        $id = get_the_ID();
    }
    wp_delete_post($id, true);

    $page_invoiced = new WP_Query(array('pagename' => 'invoiced'));
    while ($page_invoiced->have_posts()) {
        $page_invoiced->the_post();
        $id = get_the_ID();
    }
    wp_delete_post($id, true);

    $page_completed = new WP_Query(array('pagename' => 'completed'));
    while ($page_completed->have_posts()) {
        $page_completed->the_post();
        $id = get_the_ID();
    }
    wp_delete_post($id, true);
}
register_deactivation_hook(__FILE__, 'remove_pages');


// ***************** Alter Template
function amcallbacktemplate($amcallbacktemplate)
{
    if (is_page('amcallback')) {
        $amcallbacktemplate = ABSPATH . '/wp-content/plugins/anymarket/includes/create-amcallback.php';
    }
    return $amcallbacktemplate;
}
add_filter('page_template', 'amcallbacktemplate');

function anymarkettemplate($anymarkettemplate)
{
    if (is_page('anymarket')) {
        $anymarkettemplate = ABSPATH . '/wp-content/plugins/anymarket/includes/create-anymarket.php';
    }
    return $anymarkettemplate;
}
add_filter('page_template', 'anymarkettemplate');

function invoicedtemplate($invoicedtemplate)
{
    if (is_page('invoiced')) {
        $invoicedtemplate = ABSPATH . '/wp-content/plugins/anymarket/includes/invoiced-anymarket.php';
    }
    return $invoicedtemplate;
}
add_filter('page_template', 'invoicedtemplate');

function completedtemplate($completedtemplate)
{
    if (is_page('completed')) {
        $completedtemplate = ABSPATH . '/wp-content/plugins/anymarket/includes/completed-anymarket.php';
    }
    return $completedtemplate;
}
add_filter('page_template', 'completedtemplate');


// ***************** Add DB anymarket
function add_db_anymarket()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'anymarket';
    $sql = "CREATE TABLE $table_name (`id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,`id_wc` varchar(10) NOT NULL,`id_am` varchar(10) NOT NULL,`content` text NOT NULL,`time` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL)$charset_collate;";

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
register_activation_hook(__FILE__, 'add_db_anymarket');


// ***************** Add style & script for Admin
function style_and_script($hook)
{
    //Load only on ?page=anymarket,settings,products,response
    if ($hook == "toplevel_page_anymarket" || is_page_template("/wp-admin/admin.php?page=settings") || $hook == "toplevel_page_products" || $hook == "toplevel_page_response") {
        wp_enqueue_style("style1", "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css");
        wp_enqueue_style("style2", "https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css");
        wp_enqueue_style("style3", "https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css");
        wp_enqueue_style("style4", "/wp-content/plugins/anymarket/includes/assets/anymarket.css");
        wp_enqueue_script("script1", "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js");
        wp_enqueue_script("script2", "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js");
        wp_enqueue_script("script3", "https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js");
        wp_enqueue_script("script4", "/wp-content/plugins/anymarket/includes/assets/anymarket.js");
    }
}
add_action("admin_enqueue_scripts", "style_and_script");


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


// ***************** Page response
function response_anymarket()
{
    add_submenu_page('anymarket', 'Response', 'Response', 'edit_posts', 'response', 'function_response', 3);
}
add_action('admin_menu', 'response_anymarket');

function function_response()
{
    include ABSPATH . '/wp-content/plugins/anymarket/includes/response-anymarket.php';
}
add_action('function_response', 'function_response');
