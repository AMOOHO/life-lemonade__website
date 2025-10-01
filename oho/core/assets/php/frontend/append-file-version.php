<?php defined( 'ABSPATH' ) || exit;

/**
 * This function helps forcing the browsers to flush the cache and reload fresh content
 * It simply adds the unix timestamp of the file modification date as the version number to the file-link
 *
 * @param  string  file path
 * @return string  file path + version number
 */
function append_version( $filePath ) {
  return theme_URL() . $filePath . "?v=" . filemtime(get_template_directory() . $filePath);
}
