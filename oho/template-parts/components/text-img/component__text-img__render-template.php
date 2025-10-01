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
$layoutChoice = $component['layout--radio'] ?? get_sub_field('layout--radio');
$imgGroup = $component['img--group'] ?? get_sub_field('img--group');
$textGroup = $component['text--group'] ?? get_sub_field('text--group');
$img = $imgGroup['img'];
$text = $textGroup['text'];
?>
<div class="render-wrap block--text-img block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="sec-wrap">
    <div class="sec-wrap__inner grid">
      <div class="grid-wrap gap-xl-2">
        <div class="box box-sm-12 box-md-10 box-xl-6 box-text wysiwyg" <?php if ($layoutChoice == 'right') : ?>style="order:2;" <?php endif; ?>>
          <?= $text; ?>
        </div>
        <div class="box box-sm-12 box-md-12 box-xl-6 box-image">
          <img src="<?= $img['sizes']['size_1200']; ?>" alt="<?= get_alt_tag($img['id']); ?>" />
        </div>
      </div>
    </div>
  </div>
</div>