<?php

/**
 * ACF layout builder component — Text block
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

<div class="block--text block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="wysiwyg max-w-text">
    <?= $text; ?>
  </div>
</div>