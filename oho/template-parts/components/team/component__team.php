<?php

/**
 * ACF layout builder component — Team block
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$filterToggle = $component['filter--toggle'] ?? get_sub_field('filter--toggle');
$filter1 = $component['filterCategory-1'] ?? get_sub_field('filterCategory-1');
$filter2 = $component['filterCategory-2'] ?? get_sub_field('filterCategory-2');
$filter3 = $component['filterCategory-3'] ?? get_sub_field('filterCategory-3');
$filter4 = $component['filterCategory-4'] ?? get_sub_field('filterCategory-4');
$teamRepeater = $component['team--repeater'] ?? get_sub_field('team--repeater');
?>

<div class="block--team block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">

  <h2 class="h3 mt0">Team</h2>

  <?php if ($filterToggle) : ?>
    <div class="grid-wrap gap-xl-2">
      <div class="box box-xl-12">
        <div class="filterButton-wrap mb-xl-15">
          <div class="filter-group">
            <?php if ($filter1) : ?>
              <span class="filter-btn filter__<?= $rowIndex; ?><?= $componentIndex; ?> button neg" data-filter=".tag--1__<?= $rowIndex; ?><?= $componentIndex; ?>"><?= $filter1; ?></span>
            <?php endif; ?>
            <?php if ($filter2) : ?>
              <span class="filter-btn filter__<?= $rowIndex; ?><?= $componentIndex; ?> button neg" data-filter=".tag--2__<?= $rowIndex; ?><?= $componentIndex; ?>"><?= $filter2; ?></span>
            <?php endif; ?>
            <?php if ($filter3) : ?>
              <span class="filter-btn filter__<?= $rowIndex; ?><?= $componentIndex; ?> button neg" data-filter=".tag--3__<?= $rowIndex; ?><?= $componentIndex; ?>"><?= $filter3; ?></span>
            <?php endif; ?>
            <?php if ($filter4) : ?>
              <span class="filter-btn filter__<?= $rowIndex; ?><?= $componentIndex; ?> button neg" data-filter=".tag--4__<?= $rowIndex; ?><?= $componentIndex; ?>"><?= $filter4; ?></span>
            <?php endif; ?>

            <?php if (!empty($teamRepeater) && is_array($teamRepeater)) : ?>
              <?php foreach ($teamRepeater as $teamMember) :
                $vacancy = $teamMember['vacancy--toggle'] ?? null;
              ?>
                <?php if ($vacancy) : ?>
                  <span class="filter-btn filter__<?= $rowIndex; ?><?= $componentIndex; ?> button neg" data-filter=".tag--vakanz__<?= $rowIndex; ?><?= $componentIndex; ?>">Vakanzen</span>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div id="mixitup-teamGrid__<?= $rowIndex; ?><?= $componentIndex; ?>" class="grid-wrap gap-xl-2">
    <?php if (!empty($teamRepeater) && is_array($teamRepeater)) : ?>
      <?php foreach ($teamRepeater as $teamMember) :
        // vars
        $portrait = $teamMember['img'] ?? null;
        $name = $teamMember['name'] ?? '';
        $color = $teamMember['color'] ?? '';
        $jobdescr = $teamMember['desc'] ?? '';
        $function = $teamMember['function'] ?? '';
        $phone = $teamMember['tel'] ?? '';
        $mail = $teamMember['email'] ?? '';
        $vacancy = $teamMember['vacancy--toggle'] ?? false;
        $filters = $teamMember['filter'] ?? [];
      ?>
        <div class="mix box box-xl-4 box-md-6 box-sm-12
    <?php if (!$vacancy) : ?>
      <?php foreach ($filters as $filter) : ?>
      <?php echo $filter; ?>__<?= $rowIndex; ?><?= $componentIndex; ?>
      <?php endforeach; ?>
    <?php else : ?>
      tag--vakanz__<?= $rowIndex; ?><?= $componentIndex; ?>
    <?php endif; ?>
    ">
          <?php if (!$vacancy) : ?>
            <?php if ($mail) : ?><a class="mail-link" <?= secure_mail_link_attr($mail); ?>><?php endif; ?>
              <div class="covered-image-wrap portrait-box ratio--3_4 mb-xl-1">
                <img src="<?= $portrait['sizes']['size_1200'] ?>" alt="<?= get_alt_tag($portrait['id']); ?>" title="<?= $name ?>">
              </div>
              <?php if ($mail) : ?>
              </a><?php endif; ?>
          <?php else : ?>
            <a href="<?= $jobdescr; ?>" target="_blank">
              <div class="vakanz-box ratio--3_4  mb-xl-1" style="background-color:<?= $color ?>"></div>
            </a>
          <?php endif; ?>
          <p class="my0"><b><?php if (!$vacancy) : ?><?= $name ?><?php else : ?>Vakanz<?php endif; ?></b><br>
            <?= $function ?><br>
            <?php if ($mail) : ?>
              <a class="plain mail-link" <?= secure_mail_link_attr($mail); ?>>E-Mail</a><br>
            <?php endif; ?>
            <?php if ($phone) : ?><a href="tel:<?= format_phone_nr($phone, true, ''); ?>" class="plain"><?= format_phone_nr($phone); ?></a><?php endif; ?>
          </p>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>

  </div>

  <script>
    /* must include mixitup to make this work
docReady(() => {
  const mixer = mixitup('#mixitup-teamGrid__<?= $rowIndex; ?><?= $componentIndex; ?>', {
    selectors: {
      control: '.filter__<?= $rowIndex; ?><?= $componentIndex; ?>'
    },
  });
});
*/
  </script>

</div>