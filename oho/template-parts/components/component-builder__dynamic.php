<?php

/**
 * Template part for DYNAMIC layout parts
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>

<section class="sec-wrap">
  <div class="sec-wrap__inner full px0">
    <div class="content-wrap">

      <?php while (have_rows('dynamic--components')) : the_row();

        // text block

        if (get_row_layout() == 'block--text') {
          get_template_part('template-parts/components/text/component__text');
        }

        // text image block

        elseif (get_row_layout() == 'block--text-img') {
          get_template_part('template-parts/components/text-image/component__text-img');
        }

        // single image block

        elseif (get_row_layout() == 'block--img') {
          get_template_part('template-parts/components/img/component__img');
        }

        // gallery block

        elseif (get_row_layout() == 'block--gallery-slider') {
          get_template_part('template-parts/components/gallery-slider/component__gallery-slider');
        }

        // buttons (link or file)

        elseif (get_row_layout() == 'block--buttons') {
          get_template_part('template-parts/components/buttons/component__buttons');
        }

        // accordions block

        elseif (get_row_layout() == 'block--accordions') {
          get_template_part('template-parts/components/accordions/component__accordions');
        }

        // accordions all modules block

        elseif (get_row_layout() == 'block--accordions--all-modules') {
          get_template_part('template-parts/components/accordions--all-modules/component__accordions--all-modules');
        }

        // quote block

        elseif (get_row_layout() == 'block--quote') {
          get_template_part('template-parts/components/quote/component__quote');
        }

        // quote slider block

        elseif (get_row_layout() == 'block--quote-slider') {
          get_template_part('template-parts/components/quote-slider/component__quote-slider');
        }

        // form block

        elseif (get_row_layout() == 'block--form') {
          get_template_part('template-parts/components/form/component__form');
        }

        // contact-person block

        elseif (get_row_layout() == 'block--contact-person') {
          get_template_part('template-parts/components/contact-person/component__contact-person');
        }

        // contact-persons block

        elseif (get_row_layout() == 'block--contact-persons') {
          get_template_part('template-parts/components/contact-persons/component__contact-persons');
        }

        // team block

        elseif (get_row_layout() == 'block--team') {
          get_template_part('template-parts/components/team/component__team');
        }

        // time table (program)

        elseif (get_row_layout() == 'block--timetable') {
          get_template_part('template-parts/components/time-table/component__time-table');
        }

        // Youtube/Vimeo video block

        elseif (get_row_layout() == 'block--embed-video') {
          get_template_part('template-parts/components/embed-video/component__embed-video');
        }


      endwhile; ?>

    </div>
  </div>
</section>

<script>
  // number blocks
  (() => {
    const blocks = document.querySelectorAll(".content-wrap > div");

    blocks.forEach((block, i) => {
      block.setAttribute('id', 'row--' + i);
    });
  })();
</script>