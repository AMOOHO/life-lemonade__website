<?php defined( 'ABSPATH' ) || exit;

// remove wp 5.3 + default scale function
add_filter('big_image_size_threshold', '__return_false');

// fixes image upload on bigger sizes
add_filter( 'wp_image_editors', 'force_gd_editor' );
function force_gd_editor($array) {
  return array( 'WP_Image_Editor_GD' );
}
