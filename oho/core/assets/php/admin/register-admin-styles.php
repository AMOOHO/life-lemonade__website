<?php defined( 'ABSPATH' ) || exit;

if (is_user_logged_in()) {
  add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('admin-defaults', get_template_directory_uri() . '/css/default.css', array(), filemtime(get_template_directory() . '/css/default.css'));
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/css/admin/admin.css', array(), filemtime(get_template_directory() . '/css/admin/admin.css'));
    wp_enqueue_style('admin-styles-dash', get_template_directory_uri() . '/css/admin/admin-custom_dashicons.css', array(), filemtime(get_template_directory() . '/css/admin/admin-custom_dashicons.css'));
    wp_enqueue_style('admin-styles-acf',  get_template_directory_uri() . '/css/admin/admin-acf.css', array(), filemtime(get_template_directory() . '/css/admin/admin-acf.css'));
    wp_enqueue_style('admin-styles-acfe',  get_template_directory_uri() . '/css/admin/admin-acfe-render_templates.css', array(), filemtime(get_template_directory() . '/css/admin/admin-acfe-render_templates.css'));
  });
  add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('admin-styles-dash', get_template_directory_uri() . '/css/admin/admin-custom_dashicons.css', array(), filemtime(get_template_directory() . '/css/admin/admin-custom_dashicons.css'));
  });
}
