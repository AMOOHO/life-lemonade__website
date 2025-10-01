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
      <?php
      // ! ACHTUNG  *******
      // * Die Navigation wird hier für Mobile und Desktop in zwei DOM-Snippers integriert.
      // * Die Inhalte / Navigationselemente müssen also in beiden Snippets angepasst werden.
      // * *************************
      ?>

      <!-- Logo -->

      <div class="logo-wrap">
        <a class="<?php the_nav_class(2); ?>" href="/">
          <span style="font-size: 15px; letter-spacing: 0.004em;">Boilerplate
            <?= wp_get_theme()['Version']; ?></span><br>
          <span style="font-size: 0.79em; opacity: 0.5;"><?php echo get_bloginfo('name'); ?></span>
        </a>
      </div>


      <!-- Nav-List -->

      <ul class="nav-list">
        <li><a class="<?php the_nav_class("xxx"); ?>" href="/">XXX</a></li>
        <li><a class="<?php the_nav_class("xxx"); ?>" href="/">XXX</a></li>
        <li><a class="<?php the_nav_class("xxx"); ?>" href="/">XXX</a></li>
      </ul>

      <!-- Nav-Trigger -->

      <div id="nav-trigger" class="nav-trigger">
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
</div>