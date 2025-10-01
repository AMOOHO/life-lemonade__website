<?php

/**
 * Snippet to display imprint content from CMS
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>

<h1>Impressum</h1>
<div class="grid-wrap gap-xl-2">
  <div class="box box-sm-12 box-xl-6">
    <?= secure_mail_links(get_field('imprint__left', 'options__law-and-order')); ?>
    <h3>Design & Programmierung</h3>

    <h2 class="p">
      OHO Design GmbH<br>
      Interaktion + Grafik<br>
      <a href="https://ohodesign.ch" target="_blank">ohodesign.ch</a>
    </h2>

  </div>
  <div class="box box-sm-12 box-xl-6">
    <?= get_field('imprint__right', 'options__law-and-order'); ?>
  </div>
</div>