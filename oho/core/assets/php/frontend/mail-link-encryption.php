<?php defined( 'ABSPATH' ) || exit;

/**
*  Function to dynamically generate decure mail link attributes
*  The corresponding JS-Function in scripts.js will add the href tag
*
*	Usage:
*	<a class="mail-link" <?= secure_mail_link_attr('hallo@ohodesign'); ?>></a> (without href)
*	If the a tag innerHTML is empty, the Mail-Address itself will be printed
*
*/
function secure_mail_link_attr($mailAddress) {
	$mailParts = explode('@', $mailAddress);
	return ' data-name="'.$mailParts[0].'" data-domain="'.$mailParts[1].'"';
}



/**
*   This function replaces all unsave email links
*   in combination with a javascript function
*
*   The replacement does only work when email is a link
*/
function secure_mail_links($text){

  $regex = '%<a href="mailto:(.*?)">(.*?)</a>%'; // mail link pattern

  while(preg_match($regex, $text, $matches)) {

    $emailAddress = $matches[1];
    $linkContent = $matches[2];
    $oldLink = '<a href="mailto:'.$emailAddress.'">'.$linkContent.'</a>';

    // generate secure string
    $linkContent = ($emailAddress == $linkContent) ?  "" : $linkContent;
    $newLink = '<a class="mail-link" '.secure_mail_link_attr($emailAddress).'>'.$linkContent.'</a>';

    // replace link -> must not match regex pattern anymore!
    $text = str_replace($oldLink, $newLink, $text);

  }

  return $text;
}
