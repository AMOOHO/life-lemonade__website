<?php

/**
 * Template part for the CPT / (blog)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars

$img = get_field('main-img--group');
if ($img) {
  $img = $img['main-img'];
  $img_position = $img['img-position'] ?? 'center-center';
}
?>

<header class="__default header-wrap bg--theme mb-md-12">
  <div class="header-wrap__bg bg--theme"></div>
  <div class="header-wrap__inner">
    <div class="mt-xl-5 mt-md-0">
      <div class="grid-wrap gap-xl-4 gap-md-2">
        <div class="box box-xl-7 box-md-12 pr-xl-4 pr-sm-0">
          <nav class="breadcrumb mb2 fcolor--dark" aria-label="Breadcrumb">
            <span class="breadcrumb-separator mr-xl-05"><span class="icon-arrow-twisted-back isize-sm"></span></span>
            <a href="<?= get_post_type_archive_link('blog'); ?>" class="p">zurück zur Übersicht</a>
          </nav>
          <h1 class="h2 my0 fcolor--dark factor-a-bold-ss01"><?= get_the_title(); ?></h1>
        </div>
        <div class="box box-xl-4 box-md-8 mb-md-6 mb-sm-1 relative">
          <?php if ($img) : ?>
            <div class="slanted-image-wrap relative">
              <div class="slanted-image slanted-image--overlap covered-image-wrap ratio--16_10 bg--dark">
                <picture>
                  <source media="(max-width: 27em)" srcset="<?= $img['sizes']['size_600']; ?>">
                  <source media="(max-width: 55em)" srcset="<?= $img['sizes']['size_1200']; ?>">
                  <img src="<?= $img['sizes']['size_1200']; ?>" alt="<?= get_alt_tag($img['id']); ?>">
                </picture>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</header>



<?php get_template_part('template-parts/components/component-builder__dynamic', get_post_type()); ?>


<section class="sec-wrap">
  <div class="sec-wrap__bg bg--strawberry--light"></div>
  <div class="sec-wrap__inner">
    <h2 class="text-center my0 factor-a-bold-ss01">Auch interessant</h2>


    <?php
    $current_id = get_the_ID();
    $args = [
      'post_type'      => 'blog',
      'posts_per_page' => 3,
      'post__not_in'   => [$current_id],
      'orderby'        => 'rand',
      'post_status'    => 'publish',
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>

      <div class="mt-xl-4 mt-md-3">
        <div class="flex-wrap gap-xl-2 gap-md-15">
          <?php while ($query->have_posts()) : $query->the_post();
            $color = get_field('colorpicker');
            $teaserText = get_field('teaser-text');

            $bgClass = $color ? 'bg--' . $color['slug'] : 'bg--offwhite';

            $placehoderBgClass = $color && $color['slug'] !== 'strawberry'
              ? 'bg--' . $color['slug'] . '--light'
              : 'bg--offwhite--yellow';

          ?>

            <div class="post-item box box-xl-4 box-md-6 box-sm-12">
              <a href="<?= get_permalink(); ?>" class="cc--hoverscale">
                <div class="flex-wrap dir-col overflow-hidden h-full">
                  <!-- Main Image -->
                  <?php
                  $img = get_field('main-img--group');
                  $imgData = $img ? $img['main-img'] : null;
                  $imgPosition = $imgData['img-position'] ?? 'center-center';
                  ?>
                  <div class="covered-image-wrap ratio--3_2 <?= $placehoderBgClass; ?> <?= $imgPosition; ?>">
                    <?php if (!empty($imgData['sizes'])) : ?>
                      <picture>
                        <source media="(max-width: 27em)" srcset="<?= $imgData['sizes']['size_600']; ?>">
                        <source media="(max-width: 55em)" srcset="<?= $imgData['sizes']['size_1200']; ?>">
                        <img src="<?= $imgData['sizes']['size_1800']; ?>" alt="<?= get_alt_tag($imgData['id']); ?>">
                      </picture>
                    <?php endif; ?>
                  </div>

                  <div class="relative flex-wrap dir-col grow space-between-xl pxy-xl-2 <?= $bgClass; ?>">
                    <div class="mb-xl-25">
                      <h3 class="post-title mt0"><?= get_the_title(); ?></h3>
                      <p class="my0 s"><?= $teaserText; ?></p>
                    </div>
                    <div>
                      <span class="button button--themed block w-fit">mehr erfahren</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>

          <?php endwhile; ?>
        </div>
      </div>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
    <a href="<?= get_post_type_archive_link('blog'); ?>" class="block text-center mt-xl-5 mt-md-3 mt-sm-2 cc--hoverscale">
      <div class="button p bg--dark fcolor--strawberry">alle Beiträge ansehen</div>
    </a>
  </div>
</section>