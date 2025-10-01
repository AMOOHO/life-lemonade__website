<?php defined( 'ABSPATH' ) || exit;

/**
* Alias for the long wordpress function
*
*  @return string URI to current theme's template directory.
*/

function theme_URL() {
  return get_template_directory_uri();
}
