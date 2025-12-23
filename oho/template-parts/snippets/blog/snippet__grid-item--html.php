<?php

/**
 * Snippet to generate array with post grid item data
 * Used for CPT - Blog
 * 
 * Data must be passed as $args['data'] to the snippet using get_template_part( <path>, null, ['data' => $postData] )
 */

$postData = $args['data'] ?? [];

// guard: 
if (empty($postData)) {
  exit('Template part arguments missing in snippet__grid-item--html.php');
}

$bgPlaceholderClass = $postData['color'] && $postData['color'] !== 'strawberry'
  ? 'bg--' . $postData['color'] . '--light'
  : 'bg--offwhite--yellow';

$bgClass = $postData['color'] ? 'bg--' . $postData['color'] : 'bg--offwhite';
$elementThemeClass = $postData['color'] ? 'element-theme--' . $postData['color'] : 'element-theme--offwhite';
?>
<div class="mix post-item box box-xl-4 box-md-6 box-sm-12" data-id="<?= $postData['id']; ?>">
  <a href="<?= $postData['permalink']; ?>" class="cc--hoverscale">
    <div class="flex-wrap dir-col overflow-hidden h-full <?= $bgClass; ?> <?= $elementThemeClass; ?>">
      <!-- Main Image -->
      <div class="covered-image-wrap ratio--3_2 <?= $bgPlaceholderClass; ?> <?= $postData['img']['position']; ?>">
        <?php if (!empty($postData['img']['sizes'])) : ?>
          <?php $imgData = $postData['img']; ?>
          <picture>
            <source media="(max-width: 27em)" srcset="<?= $imgData['sizes']['size_600']; ?>">
            <source media="(max-width: 55em)" srcset="<?= $imgData['sizes']['size_1200']; ?>">
            <img src="<?= $imgData['sizes']['size_1800']; ?>" alt="<?= $imgData['alt']; ?>">
          </picture>
        <?php endif; ?>
      </div>

      <div class="relative flex-wrap dir-col grow space-between-xl pxy-xl-2">
        <div class="mb-xl-25">
          <h3 class="post-title mt0 factor-a-bold-ss01"><?= $postData['title'] ?></h3>
          <p class="s my0"><?= $postData['teaser_text'] ?></p>
        </div>
        <div>
          <span class="button button--themed block w-fit">mehr erfahren</span>
        </div>
      </div>
    </div>
  </a>
</div>