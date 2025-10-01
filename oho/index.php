<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header();
?>

<main>
  <div id="content-spacing" class="main__inner">

    <?php if (have_posts()) {

      if (is_home() && !is_front_page()) {
    ?>
        <header>
          <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
        </header>
    <?php
      }

      /* Start the Loop */
      while (have_posts()) {

        the_post();

        /*
        * Include the Post-Type-specific template for the content.
        * If you want to override this in a child theme, then include a file
        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
        */
        get_template_part('template-parts/content-single', get_post_type());
      }
      the_posts_navigation();
    } else {
      get_template_part('template-parts/content-single', 'none');
    } ?>

  </div>
</main>


<?php
get_sidebar();
get_footer();
