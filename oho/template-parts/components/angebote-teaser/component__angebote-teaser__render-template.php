<?php

/**
 * ACF Extended layout builder component —  angebote teaser block backend render template
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

<div class="render-wrap block--angebote-teaser block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="sec-wrap">
    <div class="sec-wrap__inner">
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
          $teaserText = get_field('teaser-text');
          $color['slug'] = 'lemon';
        ?>
          <div class="angebot-item ratio--angebot-teaser box box-xl-4 box-md-6 box-sm-12">
            <a href="<?php the_permalink(); ?>">
              <div class="flex-wrap dir-col space-between-xl h-full pxy-xl-3 pr-xl-5 pb-xl-25 pxy-md-2 pr-md-4 pb-md-15 <?= $color ? 'bg--' . $color['slug'] : 'bg--offwhite'; ?> nowrap">
                <div class="mb-xl-2 mb-md-2 mb-sm-15">
                  <h3 class="post-title h2 mt0 mb05 factor-a-bold-ss01"><?= $title; ?></h3>
                  <p class="my0"><?= mb_substr($teaserText, 0, 500) . (mb_strlen($teaserText) > 500 ? '...' : ''); ?></p>
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
  </div>
</div>