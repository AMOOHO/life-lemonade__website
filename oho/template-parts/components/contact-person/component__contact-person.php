<?php

/**
 * ACF layout builder component — Contact person block
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$contactPerson = $component['contact-person--group'] ?? get_sub_field('contact-person--group');
$portrait = $contactPerson['img'];
$name = $contactPerson['name'];
$function = $contactPerson['function'];
$email = $contactPerson['email'];
$tel = $contactPerson['tel'];
?>

<div class="block--contact-person block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">
  <div class="grid-wrap gap-xl-2">

    <div class="box box-xl-12">
      <h2 class="h3 my0">Kontaktperson</h2>
    </div>

    <div class="box box-xl-6 box-md-12">
      <div class="grid-wrap col-gap-xl-2 col-gap-xs-0 row-gap-xs-1">
        <div class="box box-xl-7 box-md-6 box-xs-12">
          <div class="covered-image-wrap portrait-box ratio--3_4">
            <img src="<?= $portrait['sizes']['size_1200'] ?>" alt="<?= get_alt_tag($portrait['id']); ?>" title="<?= $name; ?>">
          </div>
        </div>
        <div class="box box-xl-5 box-md-6 box-xs-12">
          <p class="my0"><b><?= $name ?></b><br>
            <?php if ($function) : ?><?= $function ?><br><?php endif; ?>
          <?php if ($email) : ?><a class="mail-link" <?= secure_mail_link_attr($email); ?>>E-Mail</a><br><?php endif; ?>
          <?php if ($tel) : ?><a href="tel:<?= format_phone_nr($tel, true, ''); ?>"><?= format_phone_nr($tel); ?></a><?php endif; ?>
          </p>
        </div>
      </div>
    </div>

  </div>
</div>