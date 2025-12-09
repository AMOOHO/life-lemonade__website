<?php

/**
 * Template part for the PAGE / (portrait)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header();
$scope = $args['scope'] ?? null;
$text = get_sub_field('text', $scope);
?>


<?php if (have_rows('fix--components__header--portrait', $scope)) : ?>
  <?php while (have_rows('fix--components__header--portrait', $scope)) : the_row(); ?>

    <?php
    // Header portrait
    if (get_row_layout() == 'header--portrait') {
      get_template_part('template-parts/components/header--portrait/component__header--portrait', null, ['scope' => $scope]);
    }
    ?>

  <?php endwhile; ?>
<?php else : ?>
  <?php /* Fallback */ ?>
  <header class="header-wrap bg--lemon--light header--default">
    <div class="header-wrap__inner pb3">
      <h1 class="mb0 mt-xl-15 mt-lg-1 fcolor--light factor-a-bold-ss01"><?= get_the_title(); ?></h1>
    </div>
  </header>
<?php endif; ?>



<section class="sec-wrap">
  <div class="sec-wrap__inner">
    <div class="pr-xl-8 pr-md-4 pr-sm-0">

      <!-- Text -->

      <?php if (have_rows('fix--components__text', $scope)) : ?>
        <?php while (have_rows('fix--components__text', $scope)) : the_row(); ?>

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
  <div class="sec-wrap__inner"></div>
</section>