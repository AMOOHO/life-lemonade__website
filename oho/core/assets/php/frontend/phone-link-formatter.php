<?php defined('ABSPATH') || exit;


/**
 * This file contains a helper function to format swiss phone numbers
 * 
 * usage:
 * 
 * $phone_nr = "+410619222020";
 * <a href="tel:<?= format_phone_nr($phone_nr, true, ''); ?>"><?= format_phone_nr($phone_nr); ?></a>
 */


/**
 * @param string  $number         swiss phone number eg. +41791234567 or 0619222020
 * @param bool    $international  whether output should use international format or local format
 * @param string  $delimiter      usually a space, but can be any other character or an empty string
 * @return string                 formatted phone number eg. +41 79 123 45 67 or 061 922 20 20
 */
function format_phone_nr($number, $international = false, $delimiter = ' ') {
  // Remove spaces from the number
  $number = preg_replace('/\s+/', '', $number);

  // Keep only the last 9 digits as they are the actual phone number
  $number = substr($number, -9);

  // Format based on the chosen format
  if ($international) {
    // International format: +41 XX XXX XX XX
    $formattedNumber = '+41' . $delimiter . substr($number, 0, 2);
  } else {
    // Local format: 0XX XXX XX XX
    $formattedNumber = '0' . substr($number, 0, 2);
  }

  // Add the rest of the number
  $formattedNumber .= $delimiter . substr($number, 2, 3) . $delimiter . substr($number, 5, 2) . $delimiter . substr($number, 7, 2);


  return $formattedNumber;
}
