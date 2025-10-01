<?php

/**
 * ACF layout builder component — Quote block
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$quote = $component['quote--group'] ?? get_sub_field('quote--group');
$portrait = $quote['img'] ?? null;
$title = $quote['title'] ?? '';
$quote = $quote['text'] ?? '';
$author = $quote['author'] ?? '';
$function = $quote['function'] ?? '';
?>

<div class="block--quote block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">

  <div class="grid-wrap mt-xl-6">
    <?php if ($portrait) : ?>
      <div class="box box-xl-6 box-md-12">
        <div class="covered-image-wrap">
          <picture>
            <source media="(max-width: 27em)" srcset="<?= $portrait['sizes']['size_600']; ?>">
            <source media="(max-width: 55em)" srcset="<?= $portrait['sizes']['size_1200']; ?>">
            <img src="<?= $portrait['sizes']['size_1200']; ?>" alt="<?= get_alt_tag($portrait['id']); ?>" title="<?= $author; ?>">
          </picture>
        </div>
      </div>
    <?php endif; ?>
    <div class="box <?php if ($portrait) : ?>box-xl-6 box-md-12<?php else : ?>box-xl-8 box-md-12<?php endif; ?>">
      <div class="quote-wrap bg--secondary">
        <div class="quote-wrap__inner">
          <?php if ($title) : ?><h2 class="h3 mt0"><?= $title; ?></h2><?php endif; ?>
          <blockquote class="p mb1"><?= $quote ?></blockquote>
          <?php if ($author) : ?><span class="s"><b><?= $author ?></b><br></span><?php endif; ?>
          <?php if ($function) : ?><span class="s"><?= $function; ?></span><?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</div>