<?php

/**
 * Template part for displaying single posts
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

?>

<article>

  <?php
  // Static Pages
  if (is_front_page()) { // Home
    get_template_part('template-parts/layouts/layout__page--home', get_post_type(), ['scope' => 'options_home']);
  } elseif (is_page(1077)) { // Portrait
    get_template_part('template-parts/layouts/layout__page--portrait', get_post_type(), ['scope' => 'options_portrait']);
  } elseif (is_page(1079)) { // Kontakt
    get_template_part('template-parts/layouts/layout__page--contact', get_post_type(), ['scope' => 'options_kontakt']);
  }
  // Custom Post Types
  elseif (is_singular('blog')) { // CPT "blog"
    get_template_part('template-parts/layouts/layout__cpt--blog', get_post_type());
  } elseif (is_singular('angebot')) { // CPT "angebot"
    get_template_part('template-parts/layouts/layout__cpt--angebot', get_post_type());
  }

  // All other cases + header
  else {
    get_template_part('template-parts/components/component-builder__header', get_post_type());
    get_template_part('template-parts/components/component-builder__dynamic', get_post_type());
  }


  ?>

</article>