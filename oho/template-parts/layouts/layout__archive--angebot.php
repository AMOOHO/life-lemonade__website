<?php

/**
 * Template part for the ARCHIVE / (angebot)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header();
?>


<header class="header-wrap">
  <div class="header-wrap__bg"></div>
  <div class="header-wrap__inner full pb-xl-0">
    <div class="mt-xl-5 mt-md-0">
      <div class="grid-wrap">
        <div class="box box-xl-12 pr-xl-10 pr-md-0">
          <span class="inline-block p optical-alignment"><b>Unsere Angebote für dein<br>betriebliches Gesundheitsmanagement</b></span>
          <div class="mt-xl-1">
            <h1 class="my0 fcolor--dark factor-a-bold-ss01">Die Glücksforschung<br>für Unternehmen nutzen</h1>
          </div>
        </div>

      </div>
    </div>
  </div>
</header>

<section class="sec-wrap">
  <div class="sec-wrap__bg bg--split-dark__strawberry"></div>
  <div class="sec-wrap__inner full pt-xl-2 pt-md-4">
    <div class="max-w--content">


      <?php
      $args = array(
        'post_type'      => 'angebot',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
      );

      $query = new WP_Query($args);

      if ($query->have_posts()) : ?>
        <div class="flex-wrap gap-xl-2">
          <?php while ($query->have_posts()) : $query->the_post();
            $color = get_field('colorpicker');
            $teaserTitle = get_field('teaser-title');
            $teaserSubtitle = get_field('teaser-subtitle');
            $teaserText = get_field('teaser-text');
          ?>
            <div class="post-item box box-xl-4 box-md-10 box-sm-12">
              <a href="<?php the_permalink(); ?>">
                <div class="flex-wrap dir-col space-between-xl h-full pxy-xl-3 pr-xl-5 pb-xl-25 pxy-md-2 pr-md-4 pb-md-15 <?= $color ? 'bg--' . $color['slug'] : 'bg--offwhite'; ?>">
                  <div class="mb-xl-4 mb-md-2 mb-sm-15">
                    <h2 class="post-title mt0 mb0 factor-a-bold-ss01"><?= $teaserTitle; ?></h2>
                    <?php if ($teaserSubtitle): ?>
                      <h3 class="mt05 mb0 factor-a-bold-ss01"><?= $teaserSubtitle; ?></h3>
                    <?php endif; ?>
                    <div class="mt-xl-25 mt-md-15"></div>
                    <p class="text-teaser my0"><?= mb_substr($teaserText, 0, 500) . (mb_strlen($teaserText) > 500 ? '...' : ''); ?></p>
                  </div>
                  <div>
                    <span class="button button--themed block w-fit">mehr erfahren</span>
                  </div>
                </div>
              </a>
            </div>
          <?php endwhile; ?>
        </div>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <p>Keine Angebote gefunden.</p>
      <?php endif; ?>

    </div>
  </div>
</section>