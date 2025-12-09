<?php

/**
 * Template part for the ARCHIVE / (blog)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header();
?>


<header class="header-wrap">
  <div class="header-wrap__bg"></div>
  <div class="header-wrap__inner pb-xl-1">
    <div class="mt-xl-5 mt-md-0">
      <div class="grid-wrap">
        <div class="box box-xl-12 pr-xl-10 pr-md-0">
          <span class="inline-block p optical-alignment"><b>Lemonade Lab Insights und neuste Forschungs-Ergebnisse</b></span>
          <div class="mt-xl-1">
            <h1 class="my0 fcolor--dark factor-a-bold-ss01">Happiness-Blog</h1>
          </div>
        </div>

      </div>
    </div>
  </div>
</header>


<?php
$args = array(
  'posts_per_page' => -1,
  'post_type'      => 'blog',
  'has_password'   => false,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC'
);
?>

<section id="fma-container" class="sec-wrap">
  <div class="sec-wrap__bg"></div>
  <div class="sec-wrap__inner">
    <div class="max-w--content">

      <?php
      $postTypeSlug = 'blog';
      get_template_part('template-parts/snippets/' . $postTypeSlug . '/snippet__grid', null, [
        'posttype'     => $postTypeSlug,
        'taxonomy'     => 'category',
        'filter_title' => 'xxx'
      ]);
      ?>

    </div>
  </div>
</section>

<?php /*

<?php
$query = new WP_Query($args);

if ($query->have_posts()) : ?>
  <div class="grid-wrap gap-xl-2">
    <?php while ($query->have_posts()) : $query->the_post();
      $color = get_field('colorpicker');
      $teaserText = get_field('teaser-text');
      $mainImg = get_field('main-img--group');
    ?>
      <div class="post-item box box-xl-4 box-sm-6">
        <a href="<?php the_permalink(); ?>">
          <div class="overflow-hidden">
            <?php
            if ($mainImg && isset($mainImg['main-img'])) :
              $MainImg = $mainImg['main-img'];
              $MainImgPosition = isset($mainImg['img-position']) ? $mainImg['img-position'] : '';
              $img_position_class = esc_attr($MainImgPosition);
              $img_alt = esc_attr(get_the_title());
              $img_url_600 = esc_url($MainImg['sizes']['size_600']);
              $img_url_1200 = esc_url($MainImg['sizes']['size_1200']);
              $img_url_2200 = esc_url($MainImg['sizes']['size_2200']);
            ?>
              <div class="covered-image-wrap <?= $img_position_class; ?> ratio--16_10 bg--dark">
                <picture>
                  <source media="(max-width: 27em)" srcset="<?= $img_url_600; ?>">
                  <source media="(max-width: 55em)" srcset="<?= $img_url_1200; ?>">
                  <img src="<?= $img_url_1200; ?>" alt="<?= $img_alt; ?>">
                </picture>
              </div>
            <?php endif; ?>

            <div class="flex-wrap dir-col space-between-xl h-full pxy-xl-2 pb-xl-25 <?= $color ? 'bg--' . $color['slug'] : 'bg--offwhite'; ?>">
              <div>
                <h3 class="post-title mt0"><?php the_title(); ?></h3>
                <p class="mt0"><?= $teaserText; ?></p>
              </div>
              <span class="button button--themed block w-fit">mehr erfahren</span>
            </div>
          </div>
        </a>
      </div>
    <?php endwhile; ?>
  </div>
  <?php wp_reset_postdata(); ?>
<?php else : ?>
  <p>Keine Beiträge gefunden.</p>
<?php endif; ?>
*/ ?>