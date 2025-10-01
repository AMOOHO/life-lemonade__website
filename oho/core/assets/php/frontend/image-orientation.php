<?php defined( 'ABSPATH' ) || exit;

/**
*	This function identifies the orientation of an image
*	using wp_get_attachment_metadata() function from wordpress
*
*	@param int id of the image
*	@return string orientation
*/
function get_image_orientation( $imgId ){

	$imgMeta = wp_get_attachment_metadata( $imgId );

	if ($imgMeta['width'] > $imgMeta['height']) {
		return 'landscape';
	} else if ($imgMeta['width'] < $imgMeta['height']) {
		return 'portrait';
	} else {
		return 'square';
	}

}
