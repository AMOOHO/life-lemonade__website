<?php

/**
 * ACF layout builder component — Form block
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */


// Initialize HazzelForms
require_once(get_template_directory() . '/inc/HazzelForms/autoload.php');
$form = new HazzelForms\HazzelForm(['lang' => 'DE', 'novalidate' => true, 'submitcaption' => 'absenden']);

// get ACF data vars
// ––– form setups
$counter = 0;
$componentIndex = isset($args['componentIndex']) ? '_' . $args['componentIndex'] : '';
$component = $args['component'] ?? [];
$formRepeater = $component['form--repeater'] ?? get_sub_field('form--repeater');
$formSettings = $component['form--settings'] ?? get_sub_field('form--settings');

if (is_array($formRepeater)) {
  foreach ($formRepeater as $row) {

    if (($row['type'] ?? '') == "salutation") {
      // if field is "Anrede" -> use prepared field settings
      $form->addField(++$counter . ' – ' . ($row['label'] ?? ''), 'radio', [
        'label'    => $row['label'] ?? '',
        'options'  => ['Herr', 'Frau'],
        'required' => empty($row['required']) || is_admin() ? false : true, // not required when admin
      ]);
    } else {
      // prepare field settings
      $fieldId      = ++$counter . ' – ' . ($row['label'] ?? '');
      $fieldType    = mb_strtolower($row['type'] ?? '');
      $isRequired   = empty($row['required']) || is_admin() ? false : true; // not required when admin
      $fieldOptions = [
        'label'    => $row['label'] ?? '',
        'required' => $isRequired,
      ];

      // add required indicator
      if ($isRequired) {
        $fieldOptions['label'] .= ' <span class="star">*</span>';
      }

      // add options
      if ($fieldType == 'checkbox' || $fieldType == 'dropdown') {
        $fieldOptions['options'] = array_column($row['options'] ?? [], 'option');
      }
      if ($fieldType == 'dropdown') {
        $fieldOptions['first'] = 'Bitte auswählen';
      }

      // add field
      $form->addField($fieldId, $fieldType, $fieldOptions);
    }
  }
}

// ––– form settings
if (is_array($formSettings)) {
  foreach ($formSettings as $row) {
    $receiver  = $row['receiver'] ?? '';
    $subject   = $row['email-subject'] ?? '';
    $sucessMsg = $row['success-msg'] ?? '';
  }
}

if ($form->validate()) {

  try {
    $site_name = function_exists('get_bloginfo') ? get_bloginfo('name') : 'Website';

    // create PHP Mailer
    $mailer = createMailer();
    if (!empty($mailer)) {
      $form->setMailer($mailer);
    }

    $form->sendMail(
      'wordpress@ohodesign.ch', // to
      'noreply@lifelemonade.ch', // from (if possible, use a real email address over SMTP to avoid spam filter issues)
      // 'noreply@vsa-firate.cyon.net', // from (if possible, use a real email address over SMTP to avoid spam filter issues)
      '', // replyTo (better leave this empty due to spam filter issues)
      $site_name . ' – Kontaktformular (DE)', // sender name
      $subject // subject
    );
  } catch (Exception $e) {

    $site_name = function_exists('get_bloginfo') ? get_bloginfo('name') : 'Website';

    // Send email notification to admin (fallback)
    $to      = "wordpress@ohodesign.ch";
    $subject = sprintf("%s :: Error while submitting a form over SMTP", $site_name);
    $message = $e->getMessage();
    $headers = "From: noreply@vsa-firate.cyon.net";

    // Try to send the fallback mail (use @ to suppress potential warnings)
    @mail($to, $subject, $message, $headers);

    // Return an appropriate error response depending on AJAX or not
    $user_message = "Es ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.";
    exit($user_message);
  }


  $successMarkup = "
  <div class='sec-wrap__inner'>
  <div class='success-wrap'>
  <p>{$sucessMsg}</p>
  </div>
  </div>";

  echo $successMarkup;
}
