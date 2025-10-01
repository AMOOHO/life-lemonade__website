<?php

/**
 * ACF layout builder component — Text block
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$layoutChoice = $component['layout--radio'] ?? get_sub_field('layout--radio');
$imgGroup = $component['img--group'] ?? get_sub_field('img--group');
$textGroup = $component['text--group'] ?? get_sub_field('text--group');
$img = $imgGroup['img'];
$text = $textGroup['text'];
?>

<div class="block--text-img block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="grid-wrap gap-xl-2">

    <div class="box box-sm-12 box-md-10 box-xl-6 box-text wysiwyg <?= $layoutChoice == 'right' ? 'box-text--right' : ''; ?>">
      <?= $text; ?>
    </div>
    <div class="box box-sm-12 box-md-12 box-xl-6 box-image">
      <picture>
        <source media="(max-width: 27em)" srcset="<?= $img['sizes']['size_600']; ?>">
        <source media="(max-width: 55em)" srcset="<?= $img['sizes']['size_1200']; ?>">
        <img src="<?= $img['sizes']['size_2200']; ?>" alt="<?= get_alt_tag($img['id']); ?>">
      </picture>

      <?php /*
      <?php
      // get img Attachements
      $galleryimgCaption = get_field('attachement__img-caption', $img['ID']);
      $galleryimgCopyright = get_field('attachement__img-copyright', $img['ID']);
      ?>
      <?php if (!empty($galleryimgCaption) || !empty($galleryimgCopyright)) : ?>
        <div class="caption s">
          <?php if (!empty($galleryimgCaption)) : ?>
            <?= $galleryimgCaption ?><br>
          <?php endif; ?>
          <?php if (!empty($galleryimgCopyright)) : ?>
            <span>&copy; <?= $galleryimgCopyright ?></span>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      */ ?>
    </div>

  </div>
</div>