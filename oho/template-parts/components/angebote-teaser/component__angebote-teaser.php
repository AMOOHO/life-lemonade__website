<?php

/**
 * ACF layout builder component — angebote teaser block
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$offersPosts = $component['offers'] ?? get_sub_field('offers');
?>

<div class="block--angebote-teaser block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>" data-anim="angebot-teasers-move-up" data-trigger="scroll">
  <div class="grid-wrap">

    <?php
    foreach ($offersPosts as $post):
      setup_postdata($post);
      $title = get_the_title();

      if ($title === 'Glücksforschung') {
        $title = 'Glücks-<br>forschung';
      } else {
        $title = esc_html($title);
      }
      $color = get_field('colorpicker');
      $teaserTitle = get_field('teaser-title');
      $teaserSubtitle = get_field('teaser-subtitle');
      $teaserText = get_field('teaser-text');
    ?>
      <div class="angebot-item box box-xl-4 box-md-6 box-sm-12">
        <a href="<?php the_permalink(); ?>">
          <div class="flex-wrap dir-col space-between-xl pxy-xl-3 pr-xl-5 pb-xl-25 rounded-sm <?= $color ? 'bg--' . $color['slug'] : 'bg--offwhite'; ?>">
            <div class="mb-xl-4">
              <h2 class="post-title mt0 mb0 factor-a-bold-ss01"><?= $teaserTitle; ?></h2>
              <?php if ($teaserSubtitle): ?>
                <h3 class="mt05 mb0 factor-a-bold-ss01"><?= $teaserSubtitle; ?></h3>
              <?php endif; ?>
              <div class="mt25"></div>
              <p class="text-teaser my0"><?= mb_substr($teaserText, 0, 500) . (mb_strlen($teaserText) > 500 ? '...' : ''); ?></p>
            </div>
            <div>
              <span class="button button--themed block w-fit">mehr erfahren</span>
            </div>
          </div>
        </a>
      </div>
    <?php
    endforeach;
    wp_reset_postdata();
    ?>

  </div>
</div>