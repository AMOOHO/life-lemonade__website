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
  <div class="nav-wrap">
    <div class="nav-wrap__inner">
      <?php
      // ! ACHTUNG  *******
      // * Die Navigation wird hier für Mobile und Desktop in zwei DOM-Snippers integriert.
      // * Die Inhalte / Navigationselemente müssen also in beiden Snippets angepasst werden.
      // * *************************
      ?>

      <div class="flex-wrap space-between-xl align-middle-xl h-full">

        <!-- Logo -->

        <a class="<?php the_nav_class(2); ?>" href="/">
          <span style="font-size: 25px; letter-spacing: 0.004em; color: #fff;">Boilerplate
            <?= wp_get_theme()['Version']; ?></span><br>
          <span style="font-size: 0.79em; opacity: 0.5; color: #fff;"><?php echo get_bloginfo('name'); ?></span>
        </a>

        <!-- Nav-List -->

        <ul class="nav-list">
          <?php /* <li><a class="<?php the_nav_class(xxx); ?>" href="/">Posts</a></li> */ ?>
        </ul>
      </div>

    </div>
  </div>
</div>