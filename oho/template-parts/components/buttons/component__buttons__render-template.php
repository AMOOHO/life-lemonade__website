<?php

/**
 * ACF Extended layout builder component — Buttons backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$btns = $component['button--repeater'] ?? get_sub_field('button--repeater');
?>

<div class="render-wrap block--buttons block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">

  <div class="sec-wrap">
    <div class="sec-wrap__inner">
      <div class="buttons-wrap text-center">
        <?php foreach ($btns as $btn) :
          $url = "";
          $type = $btn['type'];
          $caption = $btn['caption'];
          if ($type == 'internal-link') {
            $url = $btn['internal-link'];
          } elseif ($type == 'url') {
            $url = $btn['url'];
          } elseif ($type == 'file') {
            $url = $btn['file']['url'];
          } elseif ($type == 'email') {
            $email = $btn['email'];
            $emailAsCaptionToggle = $btn['email-as-caption--toggle'] ?? false;
          } elseif ($type == 'tel') {
            $tel = $btn['tel']['number'];
            $telAsCaptionToggle = $btn['tel-as-caption--toggle'] ?? false;
          }
        ?>

          <?php if ($type == 'email'): ?>
            <h3 class="button"><?= $emailAsCaptionToggle ? $email : $caption; ?></h3>
          <?php elseif ($type == 'tel') : ?>
            <h3 class="button"><?= $telAsCaptionToggle ? $tel : $caption; ?></h3>
          <?php elseif ($type == 'internal-link'): ?>
            <h3 class="button <?= $type; ?>"><?= $caption; ?></h3>
          <?php else: ?>
            <h3 class="button <?= $type; ?>"><?= $caption; ?></h3>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

</div>