<?php

/**
 * ACF Extended layout builder component — Gallery Slider block backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$galleryImgs = $component['gallery'] ?? get_sub_field('gallery');
?>

<div class="render-wrap block--gallery-slider block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="sec-wrap">
    <div class="sec-wrap__inner">

      <?php foreach ($galleryImgs as $img) : ?>
        <?php if ($img === reset($galleryImgs)) : ?>
          <div class="gallery-image-wrap" style="background-image: url(<?= $img['sizes']['size_1200']; ?>);">
          </div>
        <?php endif; ?>
      <?php endforeach; ?>

    </div>
  </div>
</div>