<?php defined( 'ABSPATH' ) || exit;


/**
*   REMOVE DEFAULT WP ARCHIVES
*
*   Wordpress provides default archive pages for all categories, tags, dates, authors, files etc.
*   This might be helpful for blogs & shops but not for 99% of the websites, therefore we disable it
*
*/

add_action('template_redirect', function() {

  // If we are on category or tag or date or author archive -> rediret to 404
  if(is_category() || is_tag() || is_date() || is_author() || is_attachment()) {
    global $wp_query;
    $wp_query->set_404();
  }

});
