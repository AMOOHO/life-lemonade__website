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

  <div id="page">
    <header class="site-header">
      <nav id="nav" class="site-nav">
        <?php include('template-parts/snippets/snippet__nav--desktop.php'); /* Desktop Navigation */ ?>
        <?php include('template-parts/snippets/snippet__nav--mobile.php'); /* Mobile Navigation */ ?>
      </nav>
    </header>

    <div data-barba="container" data-barba-namespace="page-<?= get_the_ID(); ?>">
      <div class="site-content">