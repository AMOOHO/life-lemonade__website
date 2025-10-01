<?php

/**
 * ACF Extended layout builder component — Header scene backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$imgGroup = get_sub_field('img--group');
$img = $imgGroup['img'];
$imgPosition = $imgGroup['img-position'];
?>

<div class="render-wrap header--bg-img">
  <header class="__bg-img header-wrap">
    <div class="header-wrap__bg">
      <div class="covered-image-wrap <?= esc_attr($imgPosition); ?>">
        <picture>
          <source media="(max-width: 27em)" srcset="<?= $img['sizes']['size_600']; ?>">
          <source media="(max-width: 55em)" srcset="<?= $img['sizes']['size_1200']; ?>">
          <img src="<?= $img['sizes']['size_2200']; ?>" alt="<?= get_alt_tag($img['id']); ?>">
        </picture>
      </div>
    </div>
  </header>
</div>