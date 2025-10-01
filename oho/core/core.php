<?php defined('ABSPATH') || exit;

/**
 * Framework entry point to load all framework core files and assets
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

/* load resources  ----------------------------------- */

require_once('config.php');
require_once(get_template_directory() . '/core/assets/php/loader.php');

/* JUMP TO POSITION ************************************************************* */

function get_framework_part($frameworkPart) {
  switch ($frameworkPart) {

    /* BEFORE SENDING HTML STUFF **************************************************************** */

    case 'prehtml':

      /* Tools for development ----------------------------------- */

      if (ENABLE_DEVELOPER_MODE === true) {

        // guard: disable for cronjobs
        if (!$_SERVER['REMOTE_ADDR']) {
          break;
        }

        // get office ip

        $officeIP = json_decode(file_get_contents("https://cdn.ohodesign.ch/services/office-ip/"), true)['ip'];

        /* Public Access ----------------------------------- */

        if (
          ALLOW_PUBLIC_ACCESS === false
          && $_SERVER['REMOTE_ADDR'] != $officeIP
          && !is_user_logged_in()
        ) {

          /* Enable restricted access backdoor */

          if (
            ENABLE_PREVIEW_BACKDOOR === true
            && ((isset($_GET['access']) && $_GET['access'] == "preview")
              || isset($_COOKIE['preview_biscuit']))
          ) {

            // allow access and set cookie if not done yet

            if (!isset($_COOKIE['preview_biscuit'])) {
              setcookie("preview_biscuit", "enjoy_the_preview", current_time('U') + (10 * 365 * 24 * 60 * 60), "/"); // available forever (ten years)
            }
          } else {
            wp_die("Zugriff gesperrt – bitte klicken Sie zuerst auf den erhaltenen Vorschau-Link.");
          }
        }

        /* Show PHP errors ----------------------------------- */

        if (SHOW_PHP_ERRORS === true) {
          ini_set('display_errors', 1);
          ini_set('display_startup_errors', 1);
          error_reporting(E_ALL);
        }
      }

      break;


    /* BEFORE HEADER **************************************************************** */

    case 'prehead':


      /* Ascii Art in header ------------------------- */

      if (INCLUDE_OHO_ASCII_ART === true) {
        include(get_template_directory() . '/core/assets/html/ascii-art.php');
      }

      break;


    /* HEADER PART **************************************************************** */

    case 'head':
      // not used yet
      break;


    /* FOOTER PART **************************************************************** */

    case 'footer':

      /*  Banners ----------------------------------
    *   The banners are located before footer and moved to the right position with css
    *   because this way its content won't be visible in search engine snippets
    */

      // NoScript

      if (INCLUDE_NOSCRIPT_BANNER) {
        include(get_template_directory() . '/core/assets/php/global/noscript-banner.php');
      }

      break;


    /* BACKEND PART **************************************************************** */

    case 'backend':
      break;
    default:
      exit;
  }
}
