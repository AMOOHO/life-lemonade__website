<?php

/**
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */
?>
<!DOCTYPE html>
<?php get_framework_part('prehead'); /* LOAD OHO Design GmbH Web Development Framework Part 3/5 */ ?>
<html <?php language_attributes(); ?> style="margin-top: 0!important;">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1">

  <?php if (is_page_template($template = 'laws.php')) : ?>
    <meta name="robots" content="noindex">
  <?php endif; ?>

  <?php /* Preload Used Fonts (only .woff2 needed) */ ?>
  <?php /*
  <link rel="preload" href="<?= theme_URL(); ?>/font/subset-OpenSans-Regular.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= theme_URL(); ?>/font/subset-OpenSans-Bold.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="<?= theme_URL(); ?>/font/subset-OpenSans-Light.woff2" as="font" type="font/woff2" crossorigin>
  */ ?>

  <?php /* CSS Libs */ ?>
  <link rel="stylesheet" type="text/css" href="<?= append_version('/css/splide.min.css'); ?>">

  <?php /* Custom CSS */ ?>
  <link rel="stylesheet" type="text/css" href="<?= append_version('/css/factor-a-bold-wakamaifondue.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= append_version('/css/default.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= append_version('/css/banner.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= append_version('/css/main.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= append_version('/css/nav.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= append_version('/css/inner.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= append_version('/css/atomic.css'); ?>">

  <script src="<?= append_version('/js/header.js') ?>"></script>

  <?php get_framework_part('head'); /* LOAD OHO Design GmbH Web Development Framework Part 4/5 */ ?>
  <?php get_template_part('template-parts/snippets/snippet__meta-img'); /* Load Meta Image for Opengraph */ ?>
  <?php get_template_part('template-parts/snippets/snippet__favicon'); /* Load Favicon */ ?>
  <?php wp_head(); ?>
  <?php get_template_part('template-parts/snippets/snippet__meta-img'); /* Load Meta Image for Opengraph again to be safe */ ?>

</head>

<body <?php body_class(); ?> id="body">
  <?php /* === start developer mode === */ if ($_SERVER['REMOTE_ADDR'] != '62.12.150.60'): ?>

    <aside id="popup-previewlockdown-wrap">
      <div id="previewlockdown-popup">
        <div id="popup-content">
          <p>
            <?php
            date_default_timezone_set('Europe/Zurich');
            $time = date("H");
            if ($time < 12) {
              echo "Guten Morgen";
            } elseif ($time < 17) {
              echo "Guten Tag";
            } else {
              echo "Guten Abend";
            }
            ?>!
          </p>
          <p class="subtext">
            Die Optimierung dieser Webseite für schmale Bildschirme und Smartphones ist noch in Arbeit.
          </p>
        </div>
      </div>
    </aside>

    <style>
      #popup-previewlockdown-wrap {
        display: none;
      }

      @media only screen and (max-width: 880px) {
        #popup-previewlockdown-wrap {
          position: fixed;
          inset: 0;
          background: rgba(0, 0, 0, 0.8);
          backdrop-filter: blur(4px);
          display: flex;
          align-items: center;
          justify-content: center;
          z-index: 999999;
          padding: 20px;
        }

        #previewlockdown-popup {
          background: #ffffff;
          border-radius: 10px;
          box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
          max-width: 420px;
          width: 100%;
          text-align: center;
          padding: 40px 25px;
          animation: popupFadeIn 0.4s ease;
        }

        #popup-content p {
          font-family: system-ui, sans-serif;
          color: #333;
          margin: 0;
          font-size: 1.2rem;
          line-height: 1.5;
        }

        #popup-content .subtext {
          margin-top: 1rem;
          color: #666;
          font-size: 0.95rem;
        }

        @keyframes popupFadeIn {
          from {
            opacity: 0;
            transform: translateY(20px);
          }

          to {
            opacity: 1;
            transform: translateY(0);
          }
        }
      }
    </style>
  <?php /* === end developer mode === */ endif; ?>


  <div id="page">
    <header class="site-header">
      <nav id="nav" class="site-nav">
        <?php include('template-parts/snippets/snippet__nav--desktop.php'); /* Desktop Navigation */ ?>
        <?php include('template-parts/snippets/snippet__nav--mobile.php'); /* Mobile Navigation */ ?>
      </nav>
    </header>

    <div data-barba="container" data-barba-namespace="page-<?= get_the_ID(); ?>">
      <div class="site-content">