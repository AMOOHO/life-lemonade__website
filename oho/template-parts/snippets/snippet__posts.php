<?php

/**
 * Snippet to display post grid items
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>

<div class="box box-xl-4 box-sm-6 box-xs-12" data-postid="<?php echo the_ID(); ?>">
  <a href="<?php the_permalink(); ?>">
    <?php if (have_rows('main-img--group')) : ?>
      <?php while (have_rows('main-img--group')) : the_row(); ?>
        <?php
        $MainImg = get_sub_field('main-img');
        $MainImgPosition = get_sub_field('img-position');
        ?>
        <?php if ($MainImg) : ?>
          <div class="covered-image-wrap <?php $field = get_sub_field_object('img-position');
                                          echo esc_attr($field['value']); ?>">
            <img src="<?= $MainImg['sizes']['size_600']; ?>" alt="<?= get_alt_tag($MainImg['id']); ?>" />
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
    <?php endif; ?>
    <h3><?php the_title(); ?></h3>
  </a>
</div>