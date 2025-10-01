<?php defined('ABSPATH') || exit;

/*
 * LOAD TEMPLATE PART
 * usage: $html = load_template_part('template-parts/snippets/your-snippet', null, ['title' => 'Hello World']);
 */
if (!function_exists('load_template_part')) {
  function load_template_part($template_name, $part_name = null, $args = []) {
    ob_start();
    get_template_part($template_name, $part_name, $args);
    return ob_get_clean();
  }
}
