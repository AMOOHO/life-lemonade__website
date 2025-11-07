<?php

/**
 * ACF layout builder component — Gallery Slider block
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

<div class="block--gallery-slider block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="splide splide-default max-w-media">
    <div class="splide__track">
      <ul class="splide__list">
        <?php
        foreach ($galleryImgs as $img):
        ?>
          <li class="splide__slide bg--primary">
            <picture>
              <source media="(max-width: 27em)" srcset="<?= $img['sizes']['size_600']; ?>">
              <source media="(max-width: 55em)" srcset="<?= $img['sizes']['size_1200']; ?>">
              <img src="<?= $img['sizes']['size_1200']; ?>" alt="<?= get_alt_tag($img['id']); ?>">
            </picture>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Navigation -->
    <div class="splide__nav">
      <div
        class="prev-slide nav-button">
        <span class="icon-arrow-twisted-back inline-block isize-md"></span>
      </div>
      <div
        class="next-slide nav-button">
        <span class="icon-arrow-twisted inline-block isize-md"></span>
      </div>
    </div>
  </div>

  <div class="lightbox lightbox__splide" style="visibility: hidden; pointer-events:none;">
    <div class="lightbox__bg"></div>
    <div class="lightbox__close">
      <span class="icon_base_cross fcolor--dark"></span>
    </div>
    <div class="lightbox__inner">

      <div class="splide splide--default-lightbox" style="visibility:hidden; pointer-events:none;">
        <div class="splide__track">
          <div class="splide__list">

            <?php
            foreach ($galleryImgs as $img):
            ?>
              <div class="splide__slide">
                <picture>
                  <source media="(max-width: 27em)" srcset="<?= $img['sizes']['size_600']; ?>">
                  <source media="(max-width: 55em)" srcset="<?= $img['sizes']['size_1200']; ?>">
                  <img src="<?= $img['sizes']['size_1200']; ?>" alt="<?= get_alt_tag($img['id']); ?>">
                </picture>
              </div>
            <?php endforeach; ?>

          </div>
        </div>

        <!-- Navigation -->
        <div class="splide__nav">
          <div
            class="prev-slide nav-button">
            <span class="icon-arrow-twisted-back isize-md"></span>
          </div>
          <div
            class="next-slide nav-button">
            <span class="icon-arrow-twisted isize-md"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>