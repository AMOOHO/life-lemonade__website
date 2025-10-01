<?php defined( 'ABSPATH' ) || exit;

/**
* This file makes new functions that are introduced with PHP 8
* available for older PHP versions
*
* @package    TacoCat Boilerplate
* @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
* Do not use this software or replicate without permission of the owner.
*/




/**
 * Determine if a string contains a given substring
 *
 * @param string $haystack  The string to search in.
 * @param string $needle    The substring to search for in the haystack.
 *
 * @return bool  Returns true if needle is in haystack, false otherwise.
 */
if(!function_exists('str_contains')){
  function str_contains( $haystack, $needle){
    return '' === $needle || false !== strpos($haystack, $needle);
  }
}




/**
 * Checks if a string starts with a given substring
 *
 * @param string $haystack  The string to search in.
 * @param string $needle    The substring to search for in the haystack.
 *
 * @return bool   Returns true if haystack begins with needle, false otherwise.
 */
if(!function_exists('str_starts_with')){
  function str_starts_with( $haystack,  $needle){
    return 0 === strncmp($haystack, $needle, strlen($needle));
  }
}



/**
 * Checks if a string ends with a given substring
 *
 * @param string $haystack  The string to search in.
 * @param string $needle    The substring to search for in the haystack.
 *
 * @return bool   Returns true if haystack ends with needle, false otherwise.
 */
if(!function_exists('str_ends_with')){
  function str_ends_with($haystack, $needle){
    return '' === $needle || ('' !== $haystack && 0 === substr_compare($haystack, $needle, -strlen($needle)));
  }
}
