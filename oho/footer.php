<?php

/**
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>

<footer id="footer" class="site-footer">
  <div class="footer-wrap bg--primary">
    <div class="footer-wrap__inner">
      <div class="flex-wrap space-between-xl dir-col-sm gap-xl-2">
        <div class="box">
          <div class="flex-wrap gap-xl-2">
            <div class="box">
              <address>
                <span class="p fcolor--light">
                  XXXXXXXXX<br>
                  XXXXXXX<br>
                  XXXXXXXXXXXX
                </span>
              </address>
            </div>
            <div class="box">
              <span class="p fcolor--light">
                XXXXXXXXX<br>
                XXXXXXXXX
              </span>
            </div>
          </div>
        </div>
        <div class="box">
          <span class="p fcolor--light">
            XXXXXXXXX<br>
            <a class="mail-link" data-name="XXXXXXXXXXX" data-domain="XXXXXXXXXXX"></a><br>
            <a href="tel:<?= format_phone_nr("XXXXXXXXXX", true, ''); ?>"><?= format_phone_nr("XXXXXXXXXX"); ?></a>
          </span>
        </div>
      </div>

    </div>
  </div>

  <div class="flex-wrap justify-center-xl align-middle-xl pxy1">
    <span class="s">
      ©&#8198; <?php echo date('Y'); ?> XXXXXXXXXXXXXXXX • <a href="/impressum">Impressum</a> • <a href="/datenschutz">Datenschutz</a> •
      <span class="adjustCookieSettingsBtn">
        Cookies
      </span>
      • <a href="https://ohodesign.ch" target="_blank" rel="noopener">Design&nbsp;&&nbsp;Realisation:&nbsp;OHO&nbsp;Design</a>
    </span>
  </div>
</footer>
</div><?php /* .site-content */ ?>
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

<?php /* Custom JS Libs */ ?>

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

</body>

</html>