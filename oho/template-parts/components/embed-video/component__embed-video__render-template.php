<?php

/**
 * ACF Extended layout builder component — Embed video backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$iframe = $component['video-url'] ?? get_sub_field('video-url');
?>
<div class="render-wrap block--embed-video block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">

  <div class="sec-wrap">
    <div class="sec-wrap__inner pxy0">

      <div class="embed-video-wrap">
        <?php
        // use preg_match to find iframe src
        preg_match('/src="(.+?)"/', $iframe, $matches);
        $src = $matches[1];
        // add extra params to iframe src
        $params = array(
          'controls' => 0,
          'hd' => 0,
          'autohide' => 0,
          'modestbranding' => 0,
        );
        $new_src = add_query_arg($params, $src);
        $iframe = str_replace($src, $new_src, $iframe);
        // add extra attributes to iframe html
        $attributes = '';

        $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

        // remove deprecated frameborder attribute
        $iframe = preg_replace('/\s*frameborder="[^"]*"/i', '', $iframe);

        // print video
        echo $iframe;
        ?>
      </div>

    </div>
  </div>

</div>