<?php

/**
 * ACF Extended layout builder component — Text block backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$text = $component['text'] ?? get_sub_field('text');
?>

<div class="render-wrap block--text block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="sec-wrap">
    <div class="sec-wrap__inner text-center">
      <?= strip_tags($text); ?>
    </div>
  </div>
</div>