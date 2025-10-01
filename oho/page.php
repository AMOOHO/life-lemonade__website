<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
    while (have_posts()) :
      the_post();


      if (post_password_required($post)) {
        get_template_part('template-parts/content-pass', get_post_type());
      } else {
        get_template_part('template-parts/content-single', get_post_type());
      }

      // If comments are open or we have at least one comment, load up the comment template.
      if (comments_open() || get_comments_number()) :
        comments_template();
      endif;

    endwhile; // End of the loop.
    ?>

  </div>
</main><?php // #main 
        ?>

<?php
get_sidebar();
get_footer();
