<?php defined( 'ABSPATH' ) || exit;

/* Add dynamic classes to body tag */
add_filter( 'body_class', function( $classes ) {

  // remove unnecessary body classes
  if(ENABLE_BODY_CLASS_FILTER){
    foreach ($classes as $key => $class) {
      if( in_array($class, ['page', 'single-post']) // exact matches
      || str_starts_with($class, 'page-id-')
      || str_starts_with($class, 'postid-')
      || str_starts_with($class, 'page-template')
      || str_starts_with($class, 'post-template')
      || str_starts_with($class, 'single-format-')
      || str_ends_with($class, '-php')
    ){
      unset($classes[$key]);
    }
  }
}

return $classes;

});