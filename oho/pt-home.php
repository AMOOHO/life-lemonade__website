<?php

/**
 * Template Name: Startseite
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header();
?>

<main>
  <div id="content-spacing" class="main__inner">

    <article>

      <section class="sec-wrap">
        <div class="sec-wrap__inner">
          <div class="centered-text">
            <h1>TacoCat Boilerplate</h1>
          </div>

          <div class="centered-text">
            <div class="centered-button">
              <a href="/kontakt">
                <span class="button p">Erfahre mehr!</span>
              </a>
            </div>

            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr.</p>

          </div>

        </div>
      </section>

    </article>


  </div>
</main>

<?php wp_reset_postdata(); ?>

<?php
get_sidebar();
get_footer();
