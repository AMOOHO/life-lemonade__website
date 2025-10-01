<?php
/**
* The sidebar containing the main widget area
*
* @package    TacoCat Boilerplate
* @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
* Do not use this software or replicate without permission of the owner.
*/

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
  return;
}
?>

<aside id="secondary" class="widget-area">
  <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><?php // #secondary ?>
