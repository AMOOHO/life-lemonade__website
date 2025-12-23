<?php

/**
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>

<?php if (!is_page(1079)) : /* Contact Page */ ?>
  <?php get_template_part('template-parts/snippets/snippet__marquees', get_post_type()); ?>
<?php endif; ?>

<footer id="footer" class="site-footer">
  <div class="footer-wrap">
    <div class="footer-wrap__inner">

      <div class="relative flex-wrap space-between-xl align-middle-xl dir-col-sm justify-start-sm align-top-sm gap-sm-15 pb-sm-2">
        <div class="box">
          <div class="flex-wrap gap-xl-2 gap-sm-15 dir-col-sm">
            <div class="box">
              <span class="xs"><b>©</b>&nbsp;Life&nbsp;Lemonade&nbsp;GmbH</span>
            </div>

            <div class="box">
              <div class="flex-wrap gap-xl-2">
                <div class="box">
                  <a href="/impressum/" class="xs cc--hoverscale">Impressum</a>
                </div>
                <div class="box">
                  <a href="/datenschutz/" class="xs cc--hoverscale">Datenschutz</a>
                </div>
                <div class="box">
                  <span class="adjustCookieSettingsBtn xs cc--hoverscale">Cookies</span>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="box">
          <span class="xs">Design&nbsp;&&nbsp;Code:&nbsp;OHO&nbsp;Design</span>
        </div>
      </div>

    </div>
  </div>
</footer>

</div><?php /* .site-content */ ?>

<?php if (is_page(1079)) : /* Contact Page */ ?>
  <div class="twisted-line-wrap">
    <?php include(get_template_directory() . "/media/placeholders/twisted-line-4.svg"); ?>
  </div>
<?php endif; ?>

</div><?php /* data-barba: container */ ?>
</div><?php /* #page */ ?>

<?php /* JS Libs */ ?>
<?php /*<script defer src="<?= append_version('/js/barba/barba.min.js') ?>"></script>*/ ?>
<script defer src="<?= append_version('/js/gsap/gsap.min.js') ?>"></script>
<script defer src="<?= append_version('/js/gsap/ScrollTrigger.min.js') ?>"></script>
<script defer src="<?= append_version('/js/gsap/ScrollSmoother.min.js') ?>"></script>
<script defer src="<?= append_version('/js/gsap/SplitText.min.js') ?>"></script>
<script defer src="<?= append_version('/js/gsap/CustomEase.min.js') ?>"></script>
<script defer src="<?= append_version('/js/splide/splide.min.js') ?>"></script>
<script defer src="<?= append_version('/js/splide/splide-extension-auto-scroll.min.js') ?>"></script>
<script defer src="<?= append_version('/js/lenis/lenis.min.js') ?>"></script>
<script defer src="<?= append_version('/js/fma/mixitup.min.js') ?>"></script>

<?php /* Custom JS Libs */ ?>
<script defer src="<?= append_version('/js/fma/engine/FilterEngine.js') ?>"></script>
<script defer src="<?= append_version('/js/fma/engine/AsyncLoader.js') ?>"></script>
<script defer src="<?= append_version('/js/fma/engine/UrlHandler.js') ?>"></script>
<script defer src="<?= append_version('/js/fma/engine/InfiniteScrollHandler.js') ?>"></script>
<script defer src="<?= append_version('/js/fma/filters/TaxonomyFilter.js') ?>"></script>
<script defer src="<?= append_version('/js/fma/fma-config.js') ?>"></script>

<?php /* Custom JS */ ?>
<script defer src="<?= append_version('/js/default.js') ?>"></script>
<script defer src="<?= append_version('/js/AsyncFormHandler.js') ?>"></script>
<script defer src="<?= append_version('/js/splide-config.js') ?>"></script>
<script defer src="<?= append_version('/js/main.js') ?>"></script>
<?php /*<script defer src="<?= append_version('/js/barba-config.js') ?>"></script>*/ ?>

<?php /* Cookie Banner */ ?>
<?php include(get_template_directory() . '/cookie-banner/cookie-banner-installer.php'); /* LOAD Cookie Banner */ ?>

<?php /* Footer Init */ ?>
<?php get_framework_part('footer'); /* LOAD OHO Design GmbH Web Development Framework Part 5/5 */ ?>
<?php wp_footer(); ?>

<!-- Custom Cursor -->
<div id="cc" class="cc" style="visibility: hidden;"></div>

</body>

</html>