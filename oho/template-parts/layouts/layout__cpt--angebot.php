<?php

/**
 * Template part for the CPT / (angebot)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header();
?>


<header class="__default header-wrap bg--theme">
  <div class="header-wrap__bg bg--theme"></div>
  <div class="header-wrap__inner">
    <div class="mt-xl-5">
      <nav class="breadcrumb mb2 fcolor--dark" aria-label="Breadcrumb">
        <a href="<?= get_post_type_archive_link('angebot'); ?>" class="p">Angebot</a>
        <span class="breadcrumb-separator mx-xl-05"><span class="icon-arrow-twisted isize-sm"></span></span>
        <span class="breadcrumb-current p"><?= get_the_title(); ?></span>
      </nav>
      <h1 class="my0 fcolor--dark factor-a-bold-ss01 pr-xl-4"><?= get_the_title(); ?></h1>
    </div>
  </div>
</header>



<section class="sec-wrap">
  <div class="sec-wrap__inner">
    <div class="pr-xl-8">


      <!-- Text -->

      <?php if (have_rows('fix--components__text')) : ?>
        <?php while (have_rows('fix--components__text')) : the_row(); ?>

          <?php
          // Text Block
          if (get_row_layout() == 'block--text') {
            get_template_part('template-parts/components/text/component__text');
          }
          ?>

        <?php endwhile; ?>
      <?php endif; ?>

    </div>
  </div>
</section>

<section class="sec-wrap">
  <div class="sec-wrap__inner full pb-xl-2">
    <div class="grid-wrap gap-xl-2">
      <div class="box box-xl-4 box-md-6 box-sm-12">
        <h2 class="factor-a-bold-ss01">weitere<br>Themen für dein Unternehmen</h2>
      </div>

      <?php
      $current_id = get_the_ID();
      $args = array(
        'post_type'      => 'angebot',
        'posts_per_page' => 2,
        'post__not_in'   => array($current_id),
        'orderby'        => 'rand',
        'post_status'    => 'publish',

      );
      $random_query = new WP_Query($args);
      if ($random_query->have_posts()) :
        while ($random_query->have_posts()) : $random_query->the_post();
          $color = get_field('colorpicker');
          $teaserTitle = get_field('teaser-title');
          $teaserSubtitle = get_field('teaser-subtitle');
          $teaserText = get_field('teaser-text');
      ?>
          <div class="post-item box box-xl-4 box-sm-6">
            <a href="<?php the_permalink(); ?>">
              <div class="flex-wrap dir-col space-between-xl h-full pxy-xl-3 pb-xl-25 rounded-sm <?= $color ? 'bg--' . $color['slug'] : 'bg--offwhite'; ?>">
                <div>
                  <h2 class="post-title mt0 mb0 factor-a-bold-ss01"><?= $teaserTitle; ?></h2>
                  <?php if ($teaserSubtitle): ?>
                    <h3 class="post-title mt05 mb0 factor-a-bold-ss01"><?= $teaserSubtitle; ?></h3>
                  <?php endif; ?>
                </div>
                <div class="mt25">
                  <span class="button button--themed block w-fit">mehr erfahren</span>
                </div>
              </div>
            </a>
          </div>
      <?php endwhile;
        wp_reset_postdata();
      endif;
      ?>

    </div>

  </div>
</section>