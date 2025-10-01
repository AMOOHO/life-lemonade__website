<?php

/**
 * The template for displaying all single posts
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header();
?>


<main>
  <div id="content-spacing" class="main__inner">

    <?php
    while (have_posts()) : the_post();

      if (post_password_required($post)) {
        get_template_part('template-parts/content-pass', get_post_type());
      } else {
        get_template_part('template-parts/content-single', get_post_type());
      }

    endwhile; // End of the loop.
    ?>

  </div>
</main>


<?php
get_sidebar();
get_footer();
