<?php

/**
 * Snippet to generate array with post grid item data
 * Used for CPT Blog
 */


// prepare image data
$mainImgGroup = get_field('main-img--group');
if ($mainImgGroup) {
  $mainImg = $mainImgGroup['main-img'];
  $mainImgPosition = $mainImgGroup['img-position'] ?? 'center-center';
}

// get the taxonomy data
$term_slugs   = [];
$taxonomySlug = 'category';
$post_terms   = get_the_terms(get_the_ID(), $taxonomySlug);
if ($post_terms) {
  foreach ($post_terms as $term) {
    $term_slugs[] = $term->slug; // using slug instead of id for simpler debugging. use whatever suits you
  }
}

$color = get_field('colorpicker');
$teaserText = get_field('teaser-text');


// post data array
return  [
  'id'           => get_the_ID(),
  'permalink'    => get_permalink(),
  'title'        => get_the_title(),
  'img'          => [
    'sizes'    => $mainImg ? $mainImg['sizes'] : [],
    'alt'      => $mainImg ? get_alt_tag($mainImg['id']) : '',
    'position' => $mainImgPosition ? esc_attr($mainImgPosition) : '',
  ],
  'color'        => $color ? $color['slug'] : '',
  'teaser_text'  => $teaserText ? $teaserText : '',
  'terms' => $term_slugs,
];
