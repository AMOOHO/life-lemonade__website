<?php

/**
 * Template part for the PAGE / (posts)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

?>

<?php get_template_part('template-parts/components/component-builder__header', get_post_type()); ?>

<section class="sec-wrap">
  <div class="sec-wrap__inner grid">

    <h2 class="centered-text">Basic</h2>

    <div class="grid-wrap post-grid gap-xl-2 gap-sm-1 gap-xs-0"> <?php // If needed place your Sub-Class here 
                                                                  ?>
      <?php
      $wp_query = new WP_Query([
        'posts_per_page' => -1,
        'has_password'   => false,
      ]);
      ?>
      <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

        <?php get_template_part('template-parts/snippets/snippet__posts'); ?>

      <?php endwhile;
      wp_reset_query(); ?>

    </div>

  </div>
</section>