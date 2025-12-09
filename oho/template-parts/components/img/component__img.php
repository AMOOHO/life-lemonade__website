<?php

/**
 * ACF layout builder component — Single image
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$img = $component['img'] ?? get_sub_field('img');
?>

<div class="block--img block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="max-w-media">
    <picture>
      <source media="(max-width: 27em)" srcset="<?= $img['sizes']['size_600']; ?>">
      <source media="(max-width: 55em)" srcset="<?= $img['sizes']['size_1200']; ?>">
      <img src="<?= $img['sizes']['size_2200']; ?>" alt="<?= get_alt_tag($img['id']); ?>">
    </picture>
  </div>
</div>