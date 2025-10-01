<?php

/**
 * ACF Extended layout builder component — Accordions backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$accordions = get_sub_field('accordion--repeater');
?>

<div class="render-wrap block--accordions block--<?= $rowIndex; ?>">
  <div class="sec-wrap">
    <div class="sec-wrap__inner">
      <div class="accordions flex-wrap dir-col">
        <?php foreach ($accordions as $accordion):
          $title = $accordion['accordion-title'];
          $text = $accordion['accordion-content']['text'];
        ?>
          <div class="accordion-wrap box box-xl-12">
            <div class="accordion">
              <div class="accordion-trigger" data-group="accordions-<?= $rowIndex; ?>">
                <h3><?= $title; ?></span><span class="toggler"></h3>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>