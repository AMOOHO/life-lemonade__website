<?php

/**
 * Snippet to display Meta Image
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>

<?php if (is_single()) : ?>

  <?php while (have_rows('main-img--group')) : the_row();
    $mainImg = get_sub_field('main-img');
  ?>
    <?php if ($mainImg) : ?>
      <?php // thanks to whatsapp and telegram we have to define if after the ones yoast defines 
      ?>
      <?php // image sizes shouldnt be bigger than 300kb otherwise whatsapp will display the one defined before it 
      ?>
      <meta property="og:image" content="<?= $mainImg['sizes']['size_300']; ?>" />
      <meta property="og:image" content="<?= $mainImg['sizes']['size_600']; ?>" />
    <?php endif; ?>
  <?php endwhile; ?>

<?php endif; ?>

<!-- Add Meta Images for CPTs below -->