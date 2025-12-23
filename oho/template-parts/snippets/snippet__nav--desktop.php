<?php

/**
 * Snippet to display desktop navigation
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>


<div id="nav--desktop" class="nav--desktop">
  <div class="nav-wrap" style="<?= is_home() || is_front_page() ? 'visibility:hidden;' : ''; ?>">
    <div class="nav-wrap__inner">
      <?php
      // ! ACHTUNG  *******
      // * Die Navigation wird hier für Mobile und Desktop in zwei DOM-Snippers integriert.
      // * Die Inhalte / Navigationselemente müssen also in beiden Snippets angepasst werden.
      // * *************************
      ?>

      <div class="relative flex-wrap space-between-xl align-middle-xl h-full">

        <!-- Logo -->

        <a class="<?php the_nav_class(2); ?> relative cc--hoverscale" href="/">
          <?php include(get_template_directory() . "/media/life-lemonade-logo.svg"); ?>
        </a>

        <!-- Nav-List -->

        <ul class="nav-list relative">
          <li><a class="<?php the_nav_class(1077); ?> cc--hoverscale" href="<?= get_permalink(1077); /* Portrait */ ?>"><b>Portrait</b></a></li>
          <li><a class="<?php the_nav_class(get_post_type_archive_link('blog')); ?> cc--hoverscale" href="<?= get_post_type_archive_link('blog'); ?>"><b>Blog</b></a></li>
          <li><a class="<?php the_nav_class(get_post_type_archive_link('angebot')); ?> cc--hoverscale" href="<?= get_post_type_archive_link('angebot'); ?>"><b>Angebot</b></a></li>
          <li class="has-icon"><a class="<?php the_nav_class(1079); ?> cc--hoverscale" href="<?= get_permalink(1079);/* Kontakt */ ?>"><span class="icon-wrap"><span class="icon-mail fcolor--dark"></span></span></a></li>
        </ul>
      </div>

    </div>
  </div>
</div>