<?php

/**
 * ACF Extended layout builder component — Contact person block backend render template
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

// Vars
$rowIndex = get_row_index();
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$contactPersons = $component['contact-person--repeater'] ?? get_sub_field('contact-person--repeater');
?>

<div class="render-wrap block--contact-persons block--<?= $rowIndex; ?><?= $componentIndex ?? '' ?>">

  <div class="sec-wrap">
    <div class="sec-wrap__inner grid">
      <div class="grid-wrap gap-xl-2">

        <div class="box box-xl-12">
          <h2 class="h3 my0">Kontaktpersonen</h2>
        </div>

        <?php if ($contactPersons) : ?>
          <?php foreach ($contactPersons as $contactPerson) :

            // vars
            $contactPersonGroup = $contactPerson['contact-person--group'];
            $portrait = $contactPersonGroup['img'];
            $name = $contactPersonGroup['name'];
            $function = $contactPersonGroup['function'];
            $phone = $contactPersonGroup['tel'];
            $email = $contactPersonGroup['email'];
          ?>
            <div class="box box-xl-6 box-md-12">
              <div class="grid-wrap col-gap-xl-2 col-gap-xs-0 row-gap-xs-1">
                <div class="box box-xl-7 box-md-6 box-xs-12">
                  <div class="covered-image-wrap portrait-box ratio--3_4">
                    <img src="<?= $portrait['sizes']['size_1200'] ?>" title="<?= $name; ?>">
                  </div>
                </div>
                <div class="box box-xl-5 box-md-6 box-xs-12">
                  <p class="my0"><b><?= $name ?></b><br>
                    <?php if ($function) : ?><?= $function ?><br><?php endif; ?>
                  <?php if ($email) : ?>E-Mail<br><?php endif; ?>
                <?php if ($phone) : ?><?= $phone; ?><?php endif; ?>
                  </p>
                </div>
              </div>
            </div>

          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>