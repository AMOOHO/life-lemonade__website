<?php defined( 'ABSPATH' ) || exit;

/**
* Title Shortener
* Trims the post title to a given amount of characters
*
* [ @param int    $maxLength   max chars the title can have (defaults to 60) ]
* @return string  $title       trimmed post title
*/

function short_title($maxLength = 60) {
  global $post;
  if (!$post) {
    return;
  }

  $title = trim($post->post_title);
  if ($maxLength < strlen($title)) {
    $title = substr($title, 0, $maxLength) . '...';
  }

  echo $title;
}
