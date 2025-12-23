<?php

/**
 * Template part for the PAGE / (home)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

$scope = $args['scope'] ?? null;
?>

<header class="__home header-wrap">
  <div class="header-wrap__bg bg--lemon"></div>

  <div class="twisted-line-wrap twisted-line-wrap--1">
    <?php include(get_template_directory() . "/media/placeholders/twisted-line-1.svg"); ?>
  </div>

  <nav>
    <div id="nav--home" class="nav--home">
      <div class="nav-wrap w-full">
        <div class="nav-wrap__inner">
          <div class="flex-wrap space-between-xl align-top-xl h-full">

            <div class="logo-wrap pxy-xl-1">
              <?php include(get_template_directory() . "/media/Life_Lemonade_Signet_RZ.svg"); ?>
            </div>

            <!-- Nav-List -->

            <ul class="nav-list">
              <li><a class="<?php the_nav_class(1077); ?> cc--hoverscale" href="<?= get_permalink(1077); /* Portrait */ ?>"><b>Portrait</b></a></li>
              <li><a class="<?php the_nav_class(get_post_type_archive_link('blog')); ?> cc--hoverscale" href="<?= get_post_type_archive_link('blog'); ?>"><b>Blog</b></a></li>
              <li><a class="<?php the_nav_class(get_post_type_archive_link('angebot')); ?> cc--hoverscale" href="<?= get_post_type_archive_link('angebot'); ?>"><b>Angebot</b></a></li>
              <li class="has-icon"><a class="<?php the_nav_class(1079); ?> cc--hoverscale" href="<?= get_permalink(1079);/* Kontakt */ ?>"><span class="icon-wrap"><span class="icon-mail fcolor--lemon"></span></span></a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </nav>


  <div class="header-wrap__inner w-full h-full pb-xl-15">
    <div class="flex-wrap align-bottom-xl h-full">
      <div class="box box-xl-12">
        <div class="grid-wrap">
          <div class="box box-xl-12">
            <span class="inline-block p optical-alignment"><b>Mentale Gesundheit & Corporate Happiness</b></span>
            <div class="mt-xl-1">
              <h1 class="my0 fcolor--dark factor-a-bold-ss01">Zufriedenheit als<br>Schlüssel zum Erfolg</h1>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="twisted-line-wrap twisted-line-wrap--2">
      <?php include(get_template_directory() . "/media/placeholders/twisted-line-2.svg"); ?>
    </div>
  </div>
</header>

<section class="sec-wrap">
  <div class="sec-wrap__bg bg--dark"></div>
  <div class="sec-wrap__inner slim">
    <h2 class="leading-large text-center fcolor--strawberry">

      Life Lemonade stärkt die Zufriedenheit, mentale Gesundheit und Innovationskraft deiner Mitarbeitenden nachhaltig und spürbar. Mit <a href="<?= get_post_type_archive_link('angebot'); ?>" class="underline cc--hoverscale">Workshops und Impulsen</a> rund um Positive Psychologie und Life Design machen wir aus den Zitronen des Arbeitsalltags spritzige Erfolge und verwandeln Potenzial in Wirkung:
      Für starke Teams, kreative Lösungen und mehr Impact für die Zukunft.
    </h2>
  </div>
</section>

<section class="sec-wrap">
  <div class="sec-wrap__bg bg--split-dark__primary"></div>
  <div class="sec-wrap__inner wide pt-xl-0">


    <!-- Angebote Teaser -->

    <?php if (have_rows('fix--components__angebote-teaser', $scope)) : ?>
      <?php while (have_rows('fix--components__angebote-teaser', $scope)) : the_row(); ?>

        <?php
        // Angebote-teaser Block
        if (get_row_layout() == 'block--angebote-teaser') {

          get_template_part('template-parts/components/angebote-teaser/component__angebote-teaser', null, ['scope' => $scope]);
        }
        ?>

      <?php endwhile; ?>
    <?php endif; ?>

  </div>

</section>


<section class="sec-wrap">
  <div class="sec-wrap__bg bg--primary"></div>


  <div class="sec-wrap__inner">

    <div class="text-center">
      <h2 class="h1 my0 factor-a-bold-ss01">Happiness Blog</h2>
      <span class="p inline-block mt-xl-1">Lemonade Lab Insights und neuste<br>Forschungs-Ergebnisse</span>
    </div>




    <?php
    $current_id = get_the_ID();
    $args = [
      'post_type'      => 'blog',
      'posts_per_page' => 3,
      'post__not_in'   => [$current_id],
      'orderby'        => 'date',
      'order'          => 'DESC',
      'post_status'    => 'publish',
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>
      <div class="mt-xl-4 mt-md-3">
        <div class="flex-wrap gap-xl-2 justify-center-md">
          <?php while ($query->have_posts()) : $query->the_post();
            $color = get_field('colorpicker');
            $teaserText = get_field('teaser-text');
          ?>


            <div class="post-item box box-xl-4 box-md-9 box-sm-12">
              <a href="<?= get_permalink(); ?>" class="cc--hoverscale">
                <div class="relative flex-wrap dir-col overflow-hidden h-full">
                  <!-- Main Image -->
                  <?php
                  $img = get_field('main-img--group');
                  $imgData = $img ? $img['main-img'] : null;
                  $imgPosition = $imgData['img-position'] ?? 'center-center';

                  $bgClass = $color ? 'bg--' . $color['slug'] : 'bg--offwhite';

                  $placehoderBgClass = $color && $color['slug'] !== 'strawberry'
                    ? 'bg--' . $color['slug'] . '--light'
                    : 'bg--offwhite--yellow';

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
                      <h3 class="post-title mt0 factor-a-bold-ss01"><?= get_the_title(); ?></h3>
                      <p class="s my0"><?= $teaserText; ?></p>
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
    <div class="flex-wrap justify-center-xl mt-xl-5 mt-md-3 mt-sm-2">
      <div class="box">
        <a href="<?= get_post_type_archive_link('blog'); ?>" class="cc--hoverscale">
          <div class="button p bg--dark fcolor--strawberry">alle Beiträge ansehen</div>
        </a>
      </div>
    </div>
  </div>
</section>