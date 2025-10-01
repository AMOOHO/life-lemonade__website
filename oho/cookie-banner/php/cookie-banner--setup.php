<?php
defined('ABSPATH') || exit; // Allows to be executed in WP environment only. Prevents direct access to file via URL 
?>

<script>
  /* COOKIE HEADQUARTERS *************************************************************** */

  const domain = '<?= $_SERVER['HTTP_HOST']; ?>'; // gets Domain from PHP

  /* --- Cookie Types */

  const essentialCookiesActive = true; // true or false
  const marketingCookiesActive = false; // true or false
  const statisticsCookiesActive = true; // true or false
  const externalCookiesActive = true; // true or false

  /* --- Cookie Categories Init */

  let externalCookies = null;
  window.externalCookies = externalCookies; // make it available in the global scope

  /* --- Cookies */

  const googleAnalyticsCookieActive = true; // true or false
  const gaIDHash = 'XXXXXXXXXXXXXXX'; // Hash value for GA ID XXXXXXXXXXXXXXX
  const gaID = 'G-' + gaIDHash;

  const googleTagManagerCookieActive = false; // true or false
  const gtmID = 'GTM-XXXXXXX'; // GTM-XXXXXXX

  const youtubeCookieActive = true; // true or false
  const googleMapsCookieActive = true; // true or false

  /* ********************************************************************************** */

  // Multilang Labels

  const cookieBannerTranslations = {
    cookieKeys: {
      title: `<?= __('Name',         'cb'); ?>`,
      name_slug: `<?= __('Cookie-Name',  'cb'); ?>`,
      provider: `<?= __('Anbieter',      'cb'); ?>`,
      description: `<?= __('Zweck',        'cb'); ?>`,
      privacy: `<?= __('Datenschutz',  'cb'); ?>`,
      runtime: `<?= __('Laufzeit',     'cb'); ?>`,
      accept: `<?= __('Akzeptieren',  'cb'); ?>`,
    },
    buttons: {
      show_cookie_info: `<?= __('Details anzeigen',   'cb'); ?>`,
      hide_cookie_info: `<?= __('Details ausblenden', 'cb'); ?>`,
    },
    toggle: {
      on: `<?= __('Ein', 'cb'); ?>`,
      off: `<?= __('Aus', 'cb'); ?>`,
    },
  };


  window.addEventListener('DOMContentLoaded', () => {

    // guard: check if cookie banner Class exists. It might be blocked by sneaky browser extensions like "I don't care about cookies"
    if (typeof(CookieBanner) == 'undefined') {
      return;
    }

    /* COOKIE BANNER ************************************************************** */

    // select elements
    const cookieBannerLightbox = document.getElementById('cookie-banner__lightbox');
    const cookieBanner = document.getElementById('advanced-cookie-banner');
    const cookieBannerInfoWrap = document.getElementById('cookie-types');
    const cookieBannerModel = new CookieBanner(cookieBanner, cookieBannerInfoWrap);
    window.cookieBannerModel = cookieBannerModel; // make it available in the global scope

    /* ***** Essential Cookies */

    if (essentialCookiesActive) {

      const essentialCookies = cookieBannerModel.addCategory(
        `<?= __('Notwendige', 'cb'); ?>`, // just one word!
        `<?= __('Notwendige Cookies ermöglichen grundlegende Funktionen und sind für die einwandfreie Funktion der Website erforderlich.', 'cb'); ?>`,
        false // toggleAble
      );

      essentialCookies.addCookie(
        'Cookie Banner', // cookie title
        'cookie-banner', // cookie name
        `<?= __('Eigentümer der Website', 'cb'); ?>`, // provider
        `<?= __('Speichert die Einstellungen der Besucher, die in den globalen Cookie-Einstellungen ausgewählt wurden.', 'cb'); ?>`, // purpose
        '', // link to privacy page
        `<?= __('1 Jahr', 'cb'); ?>`, // runtime (for display only)
        true, // default cookie status
        (isRestored) => { // callback code if accepted
          // COOKIE SETUP: add code here

          /**
           * NOTE:
           * The isRestored parameter is true, if the callback function runs automatically – based on earlier stored cookie settings.
           * When the user manually accepts the cookie (which usually equals the first run of the callback),
           * this parameter is false
           */
        },
      );
    }

    /* ***** Marketing Cookies */

    if (marketingCookiesActive) {

      const marketingCookies = cookieBannerModel.addCategory(
        `<?= __('Marketing', 'cb'); ?>`, // just one word!
        `<?= __('Marketing-Cookies speichern Informationen über besuchte Websites von Nutzern. Diese Daten werden verwendet, um personalisierte Werbung anzuzeigen, die auf die Interessen der Nutzer zugeschnitten ist.', 'cb'); ?>`
      );

    }


    /* ***** Statistik Cookies */

    if (statisticsCookiesActive) {

      const statisticsCookies = cookieBannerModel.addCategory(
        `<?= __('Statistiken', 'cb'); ?>`, // just one word!
        `<?= __('Statistik Cookies erfassen Informationen anonym. Diese Informationen helfen uns zu verstehen, wie unsere Besucher unsere Website nutzen.', 'cb'); ?>`
      );


      // Google Analytics cookie

      if (googleAnalyticsCookieActive) {

        statisticsCookies.addCookie(
          'Google Analytics', // cookie title
          '_ga,_gat,_gid', // cookie names
          'Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Ireland', // provider
          `<?= __('Wir nutzen Google Analytics, um die Besucherzahlen unserer Webseite zu messen.', 'cb'); ?>`, // purpose
          '<a href="https://policies.google.com/privacy?hl=de" target="_blank" rel="noopener noreferrer"><?= __('Datenschutzerklärung', 'cb'); ?></a>', // link to privacy page
          `<?= __('2 Jahre', 'cb'); ?>`, // runtime (for display only)
          true, // default cookie status
          () => { // callback function if accepted

            const gaTag = {
              tag: 'script',
              id: '_ga',
              async: true,
              src: `https://www.googletagmanager.com/gtag/js?id=${gaID}`,
            };
            appendTagToHead(createTag(gaTag));

            const gaInlineTag = {
              tag: 'script',
              id: '_ga-inline',
              content: `window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '${gaID}');`,
            };
            appendTagToHead(createTag(gaInlineTag));

          },
          () => { // callback function if disabled

            removeTag('_ga');
            removeTag('_ga-inline');

            delete_cookie('_ga', '/', `.${domain}`);
            delete_cookie('_gid', '/', `.${domain}`);
            delete_cookie(`_ga_${gaIDHash}`, '/', `.${domain}`);

          },
        );
      }

      // Google Tag Manager cookie

      if (googleTagManagerCookieActive) {

        statisticsCookies.addCookie(
          'Google Tag Manager',
          'gtm',
          'Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Ireland',
          `<?= __('Wir nutzen Google Tag Manager, um die Besucherzahlen unserer Webseite zu messen.', 'cb'); ?>`,
          '<a href="https://policies.google.com/privacy?hl=de" target="_blank" rel="noopener noreferrer"><?= __('Datenschutzerklärung', 'cb'); ?></a>',
          `<?= __('2 Jahre', 'cb'); ?>`,
          true,
          () => { // callback function if accepted

            const gtmTag = {
              tag: 'script',
              id: '_gtm',
              content: `(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','${gtmID}');`,
            }
            appendTagToHead(createTag(gtmTag));

            const gtmNoscriptTag = {
              tag: 'noscript',
              id: '_gtm-noscript',
              content: `<iframe src="https://www.googletagmanager.com/ns.html?id=${gtmID}" height="0" width="0" style="display:none;visibility:hidden"></iframe>`,
            }

          },
          () => { // callback function if disabled

            removeTag('_gtm');
            removeTag('_gtm-noscript');

            delete_cookie('_gtm', '/', `.${domain}`);
            delete_cookie('_gtm_auth', '/', `.${domain}`);
            delete_cookie('_gtm_debug', '/', `.${domain}`);
            delete_cookie('_gtm_debug_preview', '/', `.${domain}`);
            delete_cookie('_gtm_preview', '/', `.${domain}`);

          },
        )
      }
    }

    /* ***** External Cookies */

    if (externalCookiesActive) {

      externalCookies = cookieBannerModel.addCategory(
        `<?= __('Extern', 'cb'); ?>`, // just one word!
        `<?= __('Externe Inhalte von Videoplattformen, Social Media Plattformen oder andere externe Dienste werden standardmässig blockiert. Durch das Akzeptieren dieser Cookies können Sie unsere Webseite uneingeschränkt nutzen.', 'cb'); ?>`
      );

      // youtube cookie

      if (youtubeCookieActive) {
        externalCookies.addCookie(
          'YouTube', // cookie title
          'youtube-cookie', // cookie names
          'Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Ireland', // provider
          `<?= __('Wird zum Entsperren von Youtube-Inhalten verwendet.', 'cb'); ?>`, // purpose
          '<a href="https://policies.google.com/privacy?hl=de" target="_blank" rel="noopener noreferrer"><?= __('Datenschutzerklärung', 'cb'); ?></a>', // link to privacy page
          `<?= __('6 Monate', 'cb'); ?>`, // runtime (for display only)
          true, // default cookie status
          () => { // callback function if accepted

            unblockElsByClass(".blocker-wrap[data-content-type='embedded-video']");

          },
          () => { // callback function if disabled

            blockElsByClass(".blocker-wrap[data-content-type='embedded-video']");

          },
        );
      }

      // google maps cookie

      if (googleMapsCookieActive) {
        externalCookies.addCookie(
          'Google Maps', // cookie title
          'google-maps-cookie', // cookie names
          'Google Ireland Limited, Gordon House, Barrow Street, Dublin 4, Ireland', // provider
          `<?= __('Wird zum Entsperren von Google Maps-Inhalten verwendet.', 'cb'); ?>`, // purpose
          '<a href="https://policies.google.com/privacy?hl=de" target="_blank" rel="noopener noreferrer"><?= __('Datenschutzerklärung', 'cb'); ?></a>', // link to privacy page
          `<?= __('6 Monate', 'cb'); ?>`, // runtime (for display only)
          true, // default cookie status
          () => { // callback function if accepted

            unblockElsByClass(".blocker-wrap[data-content-type='google-maps']");

          },
          () => { // callback function if disabled

            blockElsByClass(".blocker-wrap[data-content-type='google-maps']");

          },
        );
      }
    }
    // render advanced cookies
    cookieBannerModel.setup();

    /* EVENT LISTENERS ********************************************************************************************/

    const cookieSettingsWrap = document.querySelector('#cookie-settings');
    const openCookieSettingsBtn = document.querySelector('#openCookieSettingsBtn');
    const closeCookieSettingsBtn = document.querySelector('#closeCookieSettingsBtn');
    const adjustCookieSettingsBtns = document.querySelectorAll('.adjustCookieSettingsBtn');
    const acceptAllCookiesBtn = document.querySelectorAll('.accept-all-btn');
    const toggleAllCookiesBtnWrap = document.querySelector('#toggleAllCookiesBtnWrap');
    const toggleAllCookiesBtn = document.querySelector('#toggleAllCookiesBtn');
    let toggleAllState = true;
    const acceptEssentialCookiesBtn = document.querySelectorAll('.js-accept-essential');
    const saveCookieSettingsBtn = document.querySelector('#saveCookieSettingsBtn');
    const closer = document.querySelector('#advanced-cookie-banner .closer');
    const cookieTypeMarketing = document.querySelector('#cookie-type-marketing');
    const cookieTypeStatistcs = document.querySelector('#cookie-type-statistiken');
    const cookieTypeMedia = document.querySelector('#cookie-type-medien');

    /* ***** Functions */

    const adjustCookieSettings = () => {

      const cookieBannerLightbox = document.getElementById('cookie-banner__lightbox');
      const cookieBanner = document.getElementById('advanced-cookie-banner');
      const closer = document.querySelector('#advanced-cookie-banner .closer');

      cookieBanner.classList.remove('closed');
      cookieBannerLightbox.classList.add('active');
      cookieBanner.classList.add('extended');
      closer.classList.add('active');
    }

    /* ***** Accept all Cookies */

    acceptAllCookiesBtn.forEach(btn => {
      btn.addEventListener('click', () => {
        cookieBannerModel.acceptAll();
        document.getElementById('cookie-banner__lightbox').classList.remove('active');
      });
    });

    /* ***** Accept essential Cookies */

    acceptEssentialCookiesBtn.forEach(btn => {
      btn.addEventListener('click', () => {
        cookieBannerModel.acceptEssential();
        document.getElementById('cookie-banner__lightbox').classList.remove('active');
      });
    });

    /* ***** Accept selected Cookies */

    saveCookieSettingsBtn.addEventListener('click', () => {
      cookieBannerModel.storeSettings();
      cookieBanner.classList.add('closed');
      cookieBannerLightbox.classList.remove('active');
      cookieBanner.classList.remove('extended');
      closer.classList.remove('active');
    });

    /* ***** Toggle All Cookies Button */

    toggleAllCookiesBtn.addEventListener('click', (event) => {
      cookieBannerModel.toggleAll(toggleAllState);
      toggleAllState ? toggleAllState = false : toggleAllState = true;
    });

    /* --- Hide Toggle All Cookies Button */

    if (
      typeof(cookieTypeMarketing) != 'undefined' && cookieTypeMarketing != null ||
      typeof(cookieTypeStatistcs) != 'undefined' && cookieTypeStatistcs != null ||
      typeof(cookieTypeMedia) != 'undefined' && cookieTypeMedia != null
    ) {} else {
      toggleAllCookiesBtnWrap.style.display = 'none';
    }

    /* ***** Extend Cookie Settings */

    openCookieSettingsBtn.addEventListener('click', () => {
      cookieBannerLightbox.classList.add('active');
      cookieBanner.classList.add('extended');
    });

    /* ***** Close Cookie Settings */

    closeCookieSettingsBtn.addEventListener('click', () => {
      cookieBannerLightbox.classList.remove('active');
      cookieBanner.classList.remove('extended');
    });


    /* USER ACCEPT ALL EXTERNAL ***************************************************************************************************/

    const blockerButtons = document.querySelectorAll('.blocker-wrap .accept-external');

    blockerButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        cookieBannerModel.acceptAllFromCategory(externalCookies);
        document.getElementById('cookie-banner__lightbox').classList.remove('active');
      });
    });


    /* USER ADJUST COOKIE SETTINGS ********************************************************************************************/

    if (typeof(adjustCookieSettingsBtns) != 'undefined' && adjustCookieSettingsBtns != null) {
      adjustCookieSettingsBtns.forEach((btn, i) => {
        btn.addEventListener('click', () => {
          adjustCookieSettings();
        });
      });
    }

    closer.addEventListener('click', () => {
      cookieBanner.classList.add('closed');
      cookieBannerLightbox.classList.remove('active');
      cookieBanner.classList.remove('extended');
      closer.classList.remove('active');
    });


  });
</script>