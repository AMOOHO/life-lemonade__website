<?php

/**
 * Template part for the PAGE / (contact)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header();
?>


<?php get_template_part('template-parts/components/component-builder__header', get_post_type()); ?>


<section class="sec-wrap">
  <div class="sec-wrap__inner">

    <?php get_template_part('template-parts/forms/form__contact--render'); ?>

  </div>
</section>