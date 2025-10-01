<?php defined('ABSPATH') || exit; // Allows to be executed in WP environment only. Prevents direct access to file via URL 
?>

<?php
// Substitue theme_URL() and append_version() functions for legacy framework versions before 3.9.11
if (!function_exists('theme_URL') || !function_exists('append_version')) {
  function theme_URL() {
    return get_template_directory_uri();
  }
  function append_version($filePath) {
    return theme_URL() . $filePath . "?v=" . filemtime(get_template_directory() . $filePath);
  }
}
?>

<div id="cookie-banner__lightbox" class="cookie-banner__lightbox">
  <div class="bg"></div>
  <div id="advanced-cookie-banner" class="cookie-banner closed" data-nosnippet>

    <div id="closeCookieSettingsBtn" class="closer"></div>
    <div class="cookie-banner__inner">

      <?php // Cookie-Banner, Small default version 
      ?>
      <div id="cookie-main" class="cookie-main-wrap">
        <div class="grid-wrap gap-xl-1">
          <div class="box box-xl-12">
            <div class="banner-text-wrap">
              <span class="p"><?= __('Wir verwenden Cookies auf unserer Website.', 'cb'); ?>
              </span>
            </div>
          </div>
          <div class="box box-xl-12">
            <span id="acceptAllCookiesBtn-1" class="btn--primary close-banner-btn accept-all-btn"><?= __('Alle akzeptieren', 'cb'); ?></span>
            <span class="btn--secondary accept-essential-btn js-accept-essential"><?= __('Nur Essenzielle', 'cb'); ?></span>
            <div class="mt-xl-1">
              <span id="openCookieSettingsBtn" class="btn--text"><?= __('Einstellungen anpassen', 'cb'); ?></span>
            </div>
          </div>
        </div>
      </div>

      <?php // Cookie-Einstellungen, Lightbox 
      ?>
      <div id="cookie-settings" class="cookie-settings-wrap">
        <div class="section-top">
          <span class="h3"><?= __('Cookie-Einstellungen', 'cb'); ?></span><br>
        </div>
        <div class="section-intro">
          <span class="p">
            <?= __('Hier finden Sie eine Übersicht über alle verwendeten Cookies.', 'cb'); ?><br><br>
          </span>
          <div id="toggleAllCookiesBtnWrap" class="grid-wrap col-gap-xl-05">
            <div class="box box-xl-2 box-sm-3">
              <div class="cookie-switch-wrap cookie-switch--enabled type">
                <label class="cookie-switch">
                  <input id="toggleAllCookiesBtn" type="checkbox" class="cookie-checkbox" checked>
                  <span class="cookie-slider-wrap">
                    <span class="cookie-slider"></span>
                  </span>
                </label>
              </div>
            </div>
            <div class="box box-xl-10 box-sm-9">
              <span class="p"><?= __('Alle umschalten', 'cb'); ?></span>
            </div>
          </div>
        </div>
        <div class="section-content" data-lenis-prevent>
          <div id="cookie-types">
          </div>
        </div>
        <div class="section-bottom">
          <span id="saveCookieSettingsBtn" class="btn--primaryPos close-banner-btn accept-essential-btn"><?= __('Speichern', 'cb'); ?></span>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= append_version('/cookie-banner/js/cookie.min.js'); ?>"></script>
<script src="<?= append_version('/cookie-banner/js/cookie-helpers.js'); ?>" defer></script>
<script src="<?= append_version('/cookie-banner/js/cookie-single.js'); ?>" defer></script>
<script src="<?= append_version('/cookie-banner/js/cookie-category.js'); ?>" defer></script>
<script src="<?= append_version('/cookie-banner/js/cookie-banner.js'); ?>" defer></script>