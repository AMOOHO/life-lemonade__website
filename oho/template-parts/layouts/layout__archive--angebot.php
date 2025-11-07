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
    <div class="mt-xl-5">
      <div class="grid-wrap">
        <div class="box box-xl-12 pr-xl-10">
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
  <div class="sec-wrap__bg bg--darksplit"></div>
  <div class="sec-wrap__inner full pt-xl-2">
    <div class="max-w--content">


      <?php
      $args = array(
        'post_type'      => 'angebot',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
      );

      $query = new WP_Query($args);

      if ($query->have_posts()) : ?>
        <div class="grid-wrap gap-xl-2">
          <?php while ($query->have_posts()) : $query->the_post();
            $color = get_field('colorpicker');
            $teaserText = get_field('teaser-text');
          ?>
            <div class="post-item box box-xl-4 box-sm-6">
              <a href="<?php the_permalink(); ?>">
                <div class="flex-wrap dir-col space-between-xl h-full pxy-xl-3 pr-xl-5 pb-xl-25 rounded-sm <?= $color ? 'bg--' . $color['slug'] : 'bg--offwhite'; ?>">
                  <div class="mb-xl-4">
                    <h3 class="post-title h2 mt0 mb05 factor-a-bold-ss01"><?php the_title(); ?></h3>
                    <p class="my0"><?= $teaserText; ?></p>
                  </div>
                  <span class="button button--themed block w-fit">mehr erfahren</span>
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