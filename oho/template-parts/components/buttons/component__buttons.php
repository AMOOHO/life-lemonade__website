<?php

/**
 * ACF layout builder component — Buttons / Links
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$btns = $component['button--repeater'] ?? get_sub_field('button--repeater');
?>

<div class="block--buttons block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <?php foreach ($btns as $btn) :
    $url = "";
    $type = $btn['type'];
    $caption = $btn['caption'];
    if ($type == 'internal-link') {
      $url = $btn['internal-link'];
    } elseif ($type == 'url') {
      $url = $btn['url'];
    } elseif ($type == 'file') {
      $url = $btn['file']['url'];
    } elseif ($type == 'email') {
      $email = $btn['email'];
      $emailAsCaptionToggle = $btn['email-as-caption--toggle'] ?? false;
    } elseif ($type == 'tel') {
      $tel = $btn['tel']['number'];
      $telAsCaptionToggle = $btn['tel-as-caption--toggle'] ?? false;
    }
  ?>

    <?php if ($type == 'email'): ?>
      <a class="mail-link" <?= secure_mail_link_attr($email); ?>><span class="button p"><?= $emailAsCaptionToggle ? antispambot($email) : $caption; ?></span></a>
    <?php elseif ($type == 'tel') : ?>
      <a href="tel:<?= format_phone_nr($tel, true, ''); ?>"><span class="button p"><?= $telAsCaptionToggle ? format_phone_nr($tel) : $caption; ?></span></a>
    <?php elseif ($type == 'internal-link'): ?>
      <a href="<?= $url; ?>" target="_self"><span class="button p <?= $type; ?>"><?= $caption; ?></span></a>
    <?php else: ?>
      <a href="<?= $url; ?>" target="_blank" rel="noopener"><span class="button p <?= $type; ?>"><?= $caption; ?></span></a>
    <?php endif; ?>
  <?php endforeach; ?>
</div>