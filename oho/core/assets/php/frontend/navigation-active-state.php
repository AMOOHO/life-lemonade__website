<?php defined('ABSPATH') || exit;



/**
 * get html classes to highlight current navi link
 *
 * @param   int  $prequestedId   ID of the calling navi-point
 *
 * @return  string  $navClass    hmtl classes for the navi-link
 */
function get_nav_class_by_id($requestedId) {
  // Init return value;
  $navClass = '';
  // Get ID of current site
  global $post;
  $currentId = (isset($post) && is_object($post) && isset($post->ID)) ? $post->ID : null;

  // if the current site and the requested site match set class 'actual-site'
  if ($currentId == $requestedId) {
    $navClass = 'actual-site';
  }

  // If the current ID is a sub page of the requested ID -> requested id is a parent page -> set class 'actual-parent'
  if (wp_get_post_parent_id($currentId) == $requestedId) {
    $navClass = 'actual-parent';
  }

  // return class
  return trim($navClass);
}


/**
 * get html classes to highlight current navi link
 *
 * @param   string  $permalink   permalink of the calling navi-point
 * @param   string  [ $parent ]  optional permalink of the parent level
 *
 * @return  string  $navClass    hmtl classes for the navi-link
 */
function get_nav_class_by_permalink($permalink = '', $parent = null) {

  // get actual page from wordpress
  global $wp;
  $currentSlug = add_query_arg(array(), $wp->request);

  // remove language attributes from currentSlug
  $firstExplode = explode('/', $currentSlug)[0];
  $languageAttributes = array('de', 'en', 'fr', 'ch', 'it');
  foreach ($languageAttributes as $lang) {
    if ($firstExplode == $lang) {
      $currentSlug = preg_replace('@' . $lang . '/@', '', $currentSlug, 1);
    }
  }

  // split slug if parent is iset
  $levels = 0;
  $levels = substr_count($currentSlug, '/');
  if ($levels > 0) {
    // permalink has multiple levels, thus parent is set
    $navLevels = explode('/', $currentSlug);

    $parentPointer = array_search($parent, $navLevels);
    $bypass = $navLevels[$parentPointer]; // bypass: solves problems when parent and permalink are identical
    $navLevels[$parentPointer] = '';
    $permalinkPointer = array_search($permalink, $navLevels);
    $navLevels[$parentPointer] = $bypass; // rebuild array after bypass
  }

  // find matching case
  if (isset($parent)) {
    // $parent is set
    if (isset($navLevels) && end($navLevels) == $permalink && $navLevels[$levels - 1] == $parent) {
      // this permalink is the actual site in the subtree of parent
      $navClass = 'actual-site';
    } elseif (isset($navLevels) && in_array($permalink, $navLevels) && $parentPointer + 1 == $permalinkPointer) {
      // this permalink is within the actual tree but not on top and not the actual site itself
      $navClass = 'actual-parent';
    } else {
      // this permalink is not in subtree of actual site or wrong usage of function
      return;
    }
  } else {
    // NO $parent
    if ($currentSlug == '' && $permalink == '') {
      // this permalink is the home page
      $navClass = 'actual-site';
    } elseif ($permalink == $currentSlug) {
      // actual level 1 nav link
      $navClass = 'actual-site';
    } elseif (isset($navLevels) && $navLevels[0] == $permalink) {
      // this permalink is the parent of the actual site
      $navClass = 'actual-parent';
    } else {
      // this permalink is not in subtree of actual site or wrong usage of function
      return;
    }
  }

  return $navClass;
}


/**
 * just printing the return sting of get_nav_class()
 * for param info see get_nav_class()
 */

function the_nav_class($id = '') {
  if (gettype($id) == 'integer') {
    $navClassString = get_nav_class_by_id($id);
  } elseif (gettype($id) == 'string') {
    $navClassString = get_nav_class_by_permalink($id);
  }
  if (!empty($navClassString)) {
    echo ' ' . $navClassString . ' ';
  }
}
