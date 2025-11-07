<?php

/**
 * The template for displaying archive pages
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
    // CPT ARCHIVE LAYOUTS

    if (is_post_type_archive('blog')) {  // Check if is Archive of CPT "blog"
      get_template_part('template-parts/layouts/layout__archive--blog');
    } elseif (is_post_type_archive('angebot')) {  // Check if is Archive of CPT "angebot"
      get_template_part('template-parts/layouts/layout__archive--angebot');
    } else {
      get_template_part('template-parts/content-single', 'none');
    }
    ?>
  </div><!-- #content-spacing -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
