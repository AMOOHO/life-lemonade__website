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
    get_template_part('template-parts/layouts/layout__page--home', get_post_type());
  } elseif (is_page(array(48))) { // Fonts
    get_template_part('template-parts/layouts/layout__page--fonts', get_post_type());
  } elseif (is_page(array(50))) { // Contact
    get_template_part('template-parts/layouts/layout__page--contact', get_post_type());
  } elseif (is_page(array(52))) { // Posts
    get_template_part('template-parts/layouts/layout__page--posts', get_post_type());
  }

  // Custom Post Types
  // elseif ( is_singular( 'default-cpt' ) ) { // CPT
  //   set_post_views( get_the_ID() );
  //   get_template_part( 'template-parts/layouts/layout__cpt--default', get_post_type() );
  // }
  // // Default post type page
  // elseif ( is_singular( 'page' ) && (!is_page( array( 50, 2473 ) )) ) { // Kontakt
  //   get_template_part( 'template-parts/layouts/layout__pt--page', get_post_type() );
  // }

  // All other cases + header
  else {
    get_template_part('template-parts/components/component-builder__header', get_post_type());
    get_template_part('template-parts/components/component-builder__dynamic', get_post_type());
  }


  ?>

</article>