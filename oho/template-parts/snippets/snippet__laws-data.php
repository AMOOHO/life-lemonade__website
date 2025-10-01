<?php

/**
 * Snippet to display privacy policy from CMS
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>
<h1>Datenschutz</h1>
<div class="grid-wrap gap-xl-2">
  <div class="box box-sm-12 box-xl-6">
    <?= get_field('data__left', 'options__law-and-order'); ?>
  </div>
  <div class="box box-sm-12 box-xl-6">
    <?= secure_mail_links(get_field('data__right', 'options__law-and-order')); ?>
  </div>
</div>