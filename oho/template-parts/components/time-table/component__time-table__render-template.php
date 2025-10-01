<?php

/**
 * ACF Extended layout builder component — Time table backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$title = $component['title'] ?? get_sub_field('title');
$timeTableRepeater = $component['timetable--repeater'] ?? get_sub_field('timetable--repeater');
?>

<div class="render-wrap block--timetable block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="sec-wrap">
    <div class="sec-wrap__inner slim">

      <?php if ($title) : ?>
        <h2 class="h3 mt0"><?= $title; ?></h2>
      <?php endif; ?>

      <table class="p">
        <tbody>
          <?php if (!empty($timeTableRepeater) && is_array($timeTableRepeater)): ?>
            <?php foreach ($timeTableRepeater as $row):
              $title = $row['title'] ?? '';
              $time = $row['time'] ?? '';
              $text = $row['text'] ?? '';
            ?>
              <tr>
                <td><b><?= $time; ?></b></td>
                <td><?= $text; ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>