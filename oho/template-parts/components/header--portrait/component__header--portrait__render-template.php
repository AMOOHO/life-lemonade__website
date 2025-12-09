<?php

/**
 * ACF Extended layout builder component — Header scene backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$titleGroup = get_sub_field('title--group');
$contextTitle = $titleGroup['context-title'];
$title = $titleGroup['title'];
$imgGroup = get_sub_field('img--group');
$img1 = $imgGroup['img'];
$img2 = $imgGroup['img_2'];
$quoteGroup = get_sub_field('quote--group');
$quote = $quoteGroup['quote'];
$quoteAuthor = $quoteGroup['author'];
?>

<div class="render-wrap">
  <header class="__portrait header-wrap">
    <div class="header-wrap__bg"></div>
    <div class="header-wrap__inner">
      <div class="mt-xl-5 mt-md-0">
        <div class="grid-wrap">
          <div class="box box-xl-8 pr-xl-10 pr-md-0">
            <span class="inline-block p optical-alignment"><b><?= $contextTitle; ?></b></span>
            <div class="mt-xl-1">
              <h1 class="my0 fcolor--dark factor-a-bold-ss01"><?= $title; ?></h1>
            </div>
          </div>
          <div class="box box-xl-4">
            <div class="slanted-image-wrap relative" data-anim="slanted-images-switch" data-anim-trigger="hover">
              <div class="slanted-image slanted-image--2 covered-image-wrap ratio--16_10 bg--mint">
                <picture>
                  <source media="(max-width: 27em)" srcset="<?= $img2['sizes']['size_1200']; ?>">
                  <source media="(max-width: 55em)" srcset="<?= $img2['sizes']['size_1800']; ?>">
                  <img src="<?= $img2['sizes']['size_1800']; ?>" alt="<?= get_alt_tag($img2['id']); ?>">
                </picture>
              </div>
              <div class="slanted-image slanted-image--1 covered-image-wrap ratio--16_10 bg--mint">
                <picture>
                  <source media="(max-width: 27em)" srcset="<?= $img1['sizes']['size_1200']; ?>">
                  <source media="(max-width: 55em)" srcset="<?= $img1['sizes']['size_1800']; ?>">
                  <img src="<?= $img1['sizes']['size_1800']; ?>" alt="<?= get_alt_tag($img1['id']); ?>">
                </picture>
              </div>
            </div>
          </div>
        </div>
        <div class="grid-wrap mt-xl-8 pr-xl-4">
          <div class="box box-xl-8 offset-xl-4">
            <blockquote class="quote text-right">
              <p class="h2 mb-0 factor-a-bold-ss01"><?= $quote; ?>&nbsp;–&nbsp;<?= $quoteAuthor; ?></p>
            </blockquote>
          </div>
        </div>
      </div>
    </div>
  </header>
</div>