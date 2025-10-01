<?php

/**
 * Template Name: Impressum / Datenschutz
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header();
?>

<main>
  <div id="content-spacing" class=" main__inner">


    <article>

      <section class="sec-wrap">
        <div class="sec-wrap__inner">

          <?php
          if (is_page(44)) {

            get_template_part('template-parts/snippets/snippet__laws-imprint');
          } elseif (is_page(3)) {

            get_template_part('template-parts/snippets/snippet__laws-data');
          }
          ?>

        </div>
      </section>

    </article>


  </div>
</main>

<?php
get_sidebar();
get_footer();
