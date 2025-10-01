<?php

/**
 * ACF Extended layout builder component — Single image backend render template
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

<div class="render-wrap block--img block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="sec-wrap">
    <div class="sec-wrap__inner">
      <div class="single-image-wrap" style="background-image: url(<?= $img['sizes']['size_1200']; ?>);">
      </div>
    </div>
  </div>
</div>