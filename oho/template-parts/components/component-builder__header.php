<?php

/**
 * Template part for HEADER SCENE layout parts
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

?>

<?php if (have_rows('header--components')) : ?>
  <?php while (have_rows('header--components')) : the_row();



    // Full BG-Image
    if (get_row_layout() == 'header--bg-img') {
      get_template_part('template-parts/components/header--bg-img/component__header--bg-img');
    }

    // Text Image
    elseif (get_row_layout() == 'header--text-bg-img') {
      get_template_part('template-parts/components/header--text-bg-img/component__header--text-bg-img');
    }

    // Fallback Title
    elseif (!get_row_layout()) {
      echo '<section class="sec-wrap"><div class="sec-wrap__inner">' . get_template_part('template-parts/snippets/snippet__breadcrumb') . '<h1>' . the_title() . '</h1></div></section>';
    }

  endwhile; ?>

<?php else :  // Fallback Title 
?>
  <header class="header-wrap">
    <div class="header-wrap__bg bg--secondary"></div>
    <div class="header-wrap__inner">
      <?php get_template_part('template-parts/snippets/snippet__breadcrumb'); ?>
      <h1 class="my0"><?php the_title(); ?></h1>
    </div>
  </header>
<?php endif; ?>