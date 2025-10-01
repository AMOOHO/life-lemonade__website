<?php

/**
 * ACF layout builder component — Embed video
 * © 2023
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2022 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$iframe = $component['video-url'] ?? get_sub_field('video-url');
?>

<div class="block--embed-video blocker-wrap block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>" data-content-type="embedded-video">
  <?php include(get_template_directory() . '/cookie-banner/php/cookie-content-blocker.php'); ?>

  <div class="video-wrap ratio--16_9">
    <div class="iframe-wrap">
      <?php
      if (preg_match('/src="(.+?)"/', $iframe, $matches)) {
        $src = $matches[1];

        // YouTube/Vimeo URL-Parameter
        $params = array(
          'controls' => 1,
          'hd' => 1,
          'autohide' => 1,
          'modestbranding' => 1,
        );

        $new_src = add_query_arg($params, $src);

        // Ersetze src durch neue URL
        $iframe = str_replace($src, $new_src, $iframe);

        // Entferne frameborder
        $iframe = preg_replace('/\s*frameborder="[^"]*"/i', '', $iframe);

        // Setze allow-Attribute und optional loading lazy
        if (preg_match('/<iframe(.*?)>/', $iframe, $tag_matches)) {
          $old_tag = $tag_matches[0];
          $new_tag = str_replace('<iframe', '<iframe allow="autoplay; fullscreen; picture-in-picture" loading="lazy"', $old_tag);
          $iframe = str_replace($old_tag, $new_tag, $iframe);
        }

        echo $iframe;
      } else {
        echo 'Dieses Video ist nicht mehr verfügbar!';
      }
      ?>
    </div>

  </div>
</div>