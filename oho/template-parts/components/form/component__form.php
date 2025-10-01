<?php

/**
 * ACF layout builder component — Form block
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];

// Load HazzelForms
include(__DIR__ . '/component__form--config.php');

$formTextToggler = $component['text--toggle'] ?? get_sub_field('text--toggle');
$formText = $component['text'] ?? get_sub_field('text');
?>

<div class="block--form block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="grid-wrap gap-xl-2">
    <?php if ($formTextToggler): ?>
      <div class="box box-xl-5 box-md-12 wysiwyg">
        <?= $formText; ?>
      </div>
    <?php endif; ?>
    <div class="box <?= $formTextToggler ? 'box-xl-6 box-md-12' : 'box-xl-12' ?>">
      <div id="success-<?= get_row_index(); ?>" class="form-wrap">
        <?php $form->renderAll(); ?>
      </div>
    </div>
  </div>
</div>