<?php

/**
 * ACF layout builder component — Accordions
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$accordions = get_sub_field('accordion--repeater');
?>

<div class="block--accordions block--<?= $rowIndex; ?>">

  <div class="accordions flex-wrap dir-col">
    <?php foreach ($accordions as $accordion):
      $title = $accordion['accordion-title'];
      $content = $accordion['accordion-content'];
      $components = $content['accordion--components'] ?? [];

      // if (!empty($content)) {
      //   echo '<div class="accordion-debug" style="background:#f8f9fa;border:1px solid #ddd;padding:10px;margin-bottom:10px;color:#333;font-size:14px;">';
      //   echo '<strong>Accordion Content Debug:</strong><pre style="white-space:pre-wrap;">' . htmlspecialchars(print_r($content, true)) . '</pre>';
      //   echo '</div>';
      // }

    ?>
      <div class="accordion-wrap box box-xl-12">
        <div class="accordion">
          <div class="accordion-trigger" data-group="accordions-<?= $rowIndex; ?>">
            <h3><?= $title; ?></h3><span class="toggler"></span>
          </div>
          <div class="accordion-content">

            <?php
            $componentIndex = 0;
            foreach ($components as $component) :
              $layout = $component['acf_fc_layout'] ?? '';

              // text block
              if ($layout == 'block--text') {
                get_template_part('template-parts/components/text/component__text', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // text image block
              elseif ($layout == 'block--text-img') {
                get_template_part('template-parts/components/text-image/component__text-img', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // single image block
              elseif ($layout == 'block--img') {
                get_template_part('template-parts/components/img/component__img', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // gallery block
              elseif ($layout == 'block--gallery-slider') {
                get_template_part('template-parts/components/gallery-slider/component__gallery-slider', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // buttons (link or file)
              elseif ($layout == 'block--buttons') {
                get_template_part('template-parts/components/buttons/component__buttons', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // accordions block
              elseif ($layout == 'block--accordions') {
                get_template_part('template-parts/components/accordions/component__accordions', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // quote block
              elseif ($layout == 'block--quote') {
                get_template_part('template-parts/components/quote/component__quote', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // quote slider block
              elseif ($layout == 'block--quote-slider') {
                get_template_part('template-parts/components/quote-slider/component__quote-slider', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // form block
              elseif ($layout == 'block--form') {
                get_template_part('template-parts/components/form/component__form', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // contact-person block
              elseif ($layout == 'block--contact-person') {
                get_template_part('template-parts/components/contact-person/component__contact-person', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // contact-persons block
              elseif ($layout == 'block--contact-persons') {
                get_template_part('template-parts/components/contact-persons/component__contact-persons', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // team block
              elseif ($layout == 'block--team') {
                get_template_part('template-parts/components/team/component__team', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // time table (program)
              elseif ($layout == 'block--timetable') {
                get_template_part('template-parts/components/time-table/component__time-table', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }

              // Youtube/Vimeo video block
              elseif ($layout == 'block--embed-video') {
                get_template_part('template-parts/components/embed-video/component__embed-video', null, ['component' => $component, 'componentIndex' => $componentIndex]);
              }
              $componentIndex++;
            endforeach;
            ?>


          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>