<?php

/**
 * Template part for the PAGE / (home)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

?>

<?php get_template_part('template-parts/components/component-builder__header', get_post_type()); ?>


<section class="sec-wrap">
  <div class="sec-wrap__inner">

    <h1 class="mt0">Ein h1-Mustertitel<br>auf zwei Zeilen</h1>
    <h2>Ein h2-Mustertitel<br>auf zwei Zeilen</h2>
    <h3>Ein h3-Mustertitel<br>auf zwei Zeilen</h3>
    <h4>Ein h4-Mustertitel<br>auf zwei Zeilen</h4>
    <h5>Ein h5-Mustertitel<br>auf zwei Zeilen</h5>
    <h6>Ein h6-Mustertitel<br>auf zwei Zeilen</h6>

    <p>Lorem <b>ipsum dolor sit amet</b>, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
      et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
      clita kasd gubergren, <a href="">no sea takimata sanctus</a> est.</p>

    <p class="s">Lorem <b>ipsum dolor sit amet</b>, consetetur sadipscing elitr, sed diam nonumy eirmod
      tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
      dolores et ea rebum. Stet clita kasd gubergren, <a href="">no sea takimata sanctus</a> est.</p>

    <div class="mt-xl-2">
      <a href="#intro">
        <span class="button p">Erfahre mehr!</span>
      </a>
    </div>


    <div class="blocker-wrap" data-content-type="google-maps">
      <?php include(get_template_directory() . '/cookie-banner/php/cookie-content-blocker.php'); ?>

      <aside id="map" class="map-container mt4 ratio--16_10 bg--primary">
        <script src="<?= append_version('/js/google-maps.js') ?>"></script>
      </aside>
      <script data-src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUgyqrNA9hpdlEs9l1Epm6Gxzq6ykXAhs&callback=initMap"></script>
    </div>



  </div>
</section>

<section id="intro" class="sec-wrap">
  <div class="sec-wrap__inner">

    <h2>Intro-Sektion</h2>
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
      et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet
      clita kasd gubergren, <a href="">no sea takimata sanctus</a> est.</p>


  </div>
</section>


<?php get_template_part('template-parts/components/component-builder__dynamic', get_post_type()); ?>