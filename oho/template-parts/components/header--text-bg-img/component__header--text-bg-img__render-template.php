<?php

/**
 * ACF Extended layout builder component — Header scene backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$headerTextBgImg = get_sub_field('header__text-bg-img--group');
$imgGroup = $headerTextBgImg['img--group'];
$img = $imgGroup['img'];
$imgPosition = $imgGroup['img-position'];
$title = $headerTextBgImg['title'];
$text = $headerTextBgImg['text'];
?>

<div class="render-wrap">

  <header class="__text-bg-img header-wrap">
    <div class="header-wrap__bg">
      <div class="covered-image-wrap <?= esc_attr($imgPosition); ?>">
        <picture>
          <source media="(max-width: 27em)" srcset="<?= $img['sizes']['size_600']; ?>">
          <source media="(max-width: 55em)" srcset="<?= $img['sizes']['size_1200']; ?>">
          <img src="<?= $img['sizes']['size_2200']; ?>" alt="<?= get_alt_tag($img['id']); ?>">
        </picture>
      </div>
    </div>
    <div class="header-wrap__inner">
      <?php if ($title) : ?>
        <h1 class="title my0 fcolor--light"><?= $title; ?></h1>
      <?php else : ?>
        <h1 class="title my0 fcolor--light"><?php the_title(); ?></h1>
      <?php endif; ?>
      <p class="mb0 fcolor--light"><?= $text; ?></p>
    </div>
  </header>

</div>