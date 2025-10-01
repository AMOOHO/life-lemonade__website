<?php
/**
* ACF Extended layout builder component — Accordion Start block
*
* @package    TacoCat Boilerplate
* @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
* Do not use this software or replicate without permission of the owner.
*/
?>
<div class="block--accordion accordion--<?= get_row_index(); ?>">
  <div class="grid-wrap gap-xl-1 accordion-wrap">
    <div class="box box-xl-12">
      <div class="accordion-trigger">
        <span class="h5"><?= get_sub_field('title'); ?></span>
        <span class="toggler"></span>
      </div>
      <div class="accordion-content">
        <div class="accordion-content__inner">
