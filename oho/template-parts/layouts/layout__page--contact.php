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


<header class="header-wrap">
  <div class="header-wrap__bg bg--secondary"></div>
  <div class="header-wrap__inner pb-xl-0">
    <div class="mt-xl-10 mt-md-0">
      <div class="grid-wrap">
        <div class="box box-xl-8 box-sm-12 pr-xl-10 pr-md-0">
          <h1 class="my0 fcolor--dark">BGM-<span class="factor-a-bold-ss01">Angebote</span><br>anfragen</h1>
        </div>
        <div class="box box-xl-4 box-md-8 mt-md-3 mb-md-4">
          <div class="bg--dark pxy-xl-25 pxy-md-2">
            <address class="h3 fcolor--secondary">
              Life Lemonade GmbH<br><br>

              Holbeinstrasse 18<br>
              4051 Basel<br><br>

              <a class="mail-link" data-name="hello" data-domain="lifelemonade.ch"></a><br>
              <a href="tel:<?= format_phone_nr("+41 79 123 45 67", true, ''); ?>"><?= format_phone_nr("+41 79 123 45 67"); ?></a>
            </address>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="sec-wrap">
  <div class="sec-wrap__bg bg--secondary"></div>
  <div class="sec-wrap__inner pt-xl-0">

    <div class="grid-wrap">
      <div class="box box-xl-8 box-md-10 box-sm-12">

        <?php get_template_part('template-parts/forms/form__contact--render'); ?>
      </div>
    </div>

  </div>
</section>