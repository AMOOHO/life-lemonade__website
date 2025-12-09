<?php

/**
 * Snippet to display mobile navigation
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>

<div id="nav--mobile" class="nav--mobile">
  <div class="nav-wrap">
    <div class="nav-wrap__inner">

      <?php /* Menu */ ?>

      <div class="menu" style="visibility: hidden; pointer-events: none;">
        <div class="menu__bg" style="opacity: 0;"></div>
        <div class="menu__inner pxy4 pb7 pxy-sm-25 pb-sm-4 pxy-xs-2 pb-xs-25">
          <div class="menu-card" style="visibility: hidden;">
            <div class="close"><span class="icon icon-cross"></span></div>

            <!-- Nav-List -->
            <ul class="nav-list">
              <li class="factor-a-bold-ss01"><a class="<?php the_nav_class(1077); ?>" href="<?= get_permalink(1077); /* Portrait */ ?>">Portrait</a></li>
              <li class="factor-a-bold-ss01"><a class="<?php the_nav_class(get_post_type_archive_link('blog')); ?>" href="<?= get_post_type_archive_link('blog'); ?>">Blog</a></li>
              <li class="factor-a-bold-ss01"><a class="<?php the_nav_class(get_post_type_archive_link('angebot')); ?>" href="<?= get_post_type_archive_link('angebot'); ?>">Angebot</a></li>
              <li class="factor-a-bold-ss01"><a class="<?php the_nav_class(1079); ?>" href="<?= get_permalink(1079);/* Kontakt */ ?>">Kontakt</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <?php /* Navbar */ ?>

    <div class="navbar bg--dark">
      <div class="navbar__inner">

        <!-- Logo -->
        <div class="logo-wrap">
          <a class="<?php the_nav_class(2); ?>" href="/">
            <?php include(get_template_directory() . "/media/life-lemonade-logo.svg"); ?>
          </a>
        </div>

        <!-- Nav-Trigger -->
        <div id="nav-trigger" class="nav-trigger">
          <span class="icon icon-cross" style="visibility:hidden;"></span>
          <span class="menu-label h3 fcolor--primary">Menü</span>
        </div>

      </div>
    </div>

  </div>
</div>