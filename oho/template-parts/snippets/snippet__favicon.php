<?php

/**
 * Snippet to display Favicon in light and dark mode
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

/**
 * To generate favicons for your site, visit https://realfavicongenerator.net/.
 * For dark mode support, create a separate set of favicons with a dark background and place them in /media/icons/darkmode/.
 */

?>


<!-- Standard (light) favicons -->

<link id="favicon-png" rel="icon" type="image/png" href="<?= theme_URL(); ?>/media/icons/favicon-96x96.png" sizes="96x96" />
<link id="favicon-svg" rel="icon" type="image/svg+xml" href="<?= theme_URL(); ?>/media/icons/favicon.svg" />
<link id="favicon-ico" rel="shortcut icon" href="<?= theme_URL(); ?>/media/icons/favicon.ico" />
<link id="apple-touch-icon" rel="apple-touch-icon" sizes="180x180" href="<?= theme_URL(); ?>/media/icons/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="Life Lemonade" />
<link rel="manifest" href="<?= theme_URL(); ?>/media/icons/site.webmanifest" />
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<script>
  (function() {
    const themeURL = "<?= theme_URL(); ?>";

    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (prefersDark) {
      // console.log("Dark mode detected, switching favicons...");
      document.getElementById('favicon-ico').href = themeURL + "/media/icons/darkmode/favicon.ico";
      document.getElementById('favicon-png').href = themeURL + "/media/icons/darkmode/favicon-96x96.png";
      document.getElementById('favicon-svg').href = themeURL + "/media/icons/darkmode/favicon.svg";
      document.getElementById('apple-touch-icon').href = themeURL + "/media/icons/darkmode/apple-touch-icon.png";
      // Optional: Auch das Manifest umschalten, falls du dort Farben hinterlegt hast
      // document.querySelector('link[rel="manifest"]').href = themeURL + "/media/icons/darkmode/site.webmanifest";
    }

    // console.log("Current color scheme:", prefersDark ? "dark" : "light");

    // Dynamisch auf Darkmode-Änderung reagieren
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
      const dark = e.matches;
      const path = dark ? "/media/icons/darkmode/" : "/media/icons/";
      document.getElementById('favicon-ico').href = themeURL + path + "favicon.ico";
      document.getElementById('favicon-png').href = themeURL + path + "favicon-96x96.png";
      document.getElementById('favicon-svg').href = themeURL + path + "favicon.svg";
      document.getElementById('apple-touch-icon').href = themeURL + path + "apple-touch-icon.png";
    });
  })();
</script>