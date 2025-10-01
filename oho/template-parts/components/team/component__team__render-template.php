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
$filterToggle = get_sub_field('filter--toggle');
?>

<div class="render-wrap block--team block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">

  <div class="sec-wrap">
    <div class="sec-wrap__inner grid">

      <h2 class="h3 mt0">Team</h2>

      <?php if ($filterToggle) : ?>
        <div class="grid-wrap gap-xl-1 mb-xl-15">
          <div class="box box-xl-12">
            <div class="filterButton-wrap">
              <?php
              // vars
              $filter1 = get_sub_field('filterCategory-1');
              $filter2 = get_sub_field('filterCategory-2');
              $filter3 = get_sub_field('filterCategory-3');
              $filter4 = get_sub_field('filterCategory-4');
              ?>
              <?php if ($filter1) : ?>
                <button class="button neg"><?= $filter1; ?></button>
              <?php endif; ?>
              <?php if ($filter2) : ?>
                <button class="button neg"><?= $filter2; ?></button>
              <?php endif; ?>
              <?php if ($filter3) : ?>
                <button class="button neg"><?= $filter3; ?></button>
              <?php endif; ?>
              <?php if ($filter4) : ?>
                <button class="button neg"><?= $filter4; ?></button>
              <?php endif; ?>
              <?php if (have_rows('team--repeater')) : ?>
                <?php while (have_rows('team--repeater')) : the_row();
                  // vars
                  $vacancy = get_sub_field('vacancy--toggle');
                ?>
                  <?php if ($vacancy) : ?>
                    <button class="button neg">Vakanzen</button>
                  <?php endif; ?>
                <?php endwhile; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
      <div class="grid-wrap gap-xl-1">
        <?php if (have_rows('team--repeater')) : ?>
          <?php while (have_rows('team--repeater')) : the_row();
            // vars
            $portrait = get_sub_field('img');
            $name = get_sub_field('name');
            $color = get_sub_field('color');
            $function = get_sub_field('function');
            $phone = get_sub_field('tel');
            $mail = get_sub_field('email');
            $vacancy = get_sub_field('vacancy--toggle');
          ?>
            <div class="box box-xl-4">
              <?php if (!$vacancy) : ?>
                <div class="covered-image-wrap portrait-box ratio--3_4 mb-xl-05">
                  <img src="<?= $portrait['sizes']['size_1200'] ?>" alt="<?= get_alt_tag($portrait['id']); ?>" title="<?= $name ?>">
                </div>
              <?php else : ?>
                <div class="covered-image-wrap portrait-box ratio--3_4 mb-xl-05" style="background-color:<?= $color ?>"></div>
              <?php endif; ?>
              <p class="my0"><b><?php if (!$vacancy) : ?><?= $name ?><?php else : ?>Vakanz<?php endif; ?></b><br>
                <?= $function ?><br>
                <?php if ($mail) : ?>E-Mail<br><?php endif; ?>
              <?php if ($phone) : ?><?= $phone ?><?php endif; ?>
              </p>
            </div>

          <?php endwhile; ?>
        <?php endif; ?>
      </div>

    </div>
  </div>

</div>