<?php

/**
 * ACF layout builder component — Accordions
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$accordions = $component['accordion--repeater'] ?? get_sub_field('accordion--repeater');
?>

<div class="block--accordions block--<?= $rowIndex; ?>">

  <div class="accordions flex-wrap dir-col">
    <?php foreach ($accordions as $accordion):
      $title = $accordion['accordion-title'];
      $text = $accordion['accordion-content']['text'];
    ?>
      <div class="accordion-wrap box box-xl-12">
        <div class="accordion">
          <div class="accordion-trigger" data-group="accordions-<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
            <h3><?= $title; ?></h3><span class="toggler"></span>
          </div>
          <div class="accordion-content">
            <?= $text; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>