<?php

// create a form instance and store it in the form repository
$form = FormRepository::getInstance()->createFormInstance('contact', [
  'formname'    => 'contact',
  'lang'        => USE_FORMAL_LANGUAGE ? 'de' : 'de_informal',
  'uses_ajax'   => true,
  'novalidate'  => true,
]);

// define form fields
$form->addField('Name',             'text',      ['label' => 'Name / Vorname *']);
$form->addField('Firma',            'text',      ['label' => 'Firma *']);
$form->addField('E-Mail',           'email',     ['label' => 'E-Mail *']);
$form->addField('Telefon',          'tel',       ['label' => 'Telefon *']);
$form->addField('Mitteilung',       'textarea',  ['label' => 'Ihre Mitteilung', 'rows' => 4, 'required' => false]);

// Add Google reCAPTCHA
/*
$form->addField('Captcha',  'recaptcha-v3', [
  'sitekey'   => 'XXXXXXXXXXXX',
  'secretkey' => 'XXXXXXXXXXXX',
  'min_score' => 0.3,
]);
*/

// Alternative: add Math captcha
/*
*  WARNING: Math captcha is date/time based and is not compatible with caching!
*  You must exclude all pages with contact form from the cache.
*/
/*
$form->addField('Captcha',  'math-captcha', [
  'label'       => "Spam-Schutz: was gibt <challenge>?",  // <challenge> will be replaced with the actual math question
  'secret'      => 'YOUR_SECRET_KEY',       // secret salt for captcha (generate a random string)
  'use_image'   => true,                    // use an image instead of text (recommended)
  // 'color'     => [0, 0, 0],              // -- optionally override the text color using [R, G, B]
  // 'font_path' => ''                      // -- optionally override the font path
]);
*/


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
      'noreply@vsa-firate.cyon.net', // from (if possible, use a real email address over SMTP to avoid spam filter issues)
      '', // replyTo (better leave this empty due to spam filter issues)
      $site_name . ' – Kontaktformular', // sender name
      'Kontaktformular – Neue Anfrage' // subject
    );

    if (isset($form) && method_exists($form, 'usesAjax') && $form->usesAjax()) {
      // get success message HTML 
      ob_start();
      require(get_template_directory() . "/template-parts/forms/form__{$form->getFormName()}--success.php");
      $success_message = ob_get_clean();

      // Return response as JSON
      wp_send_json([
        'status'  => 'success',
        'message' => $success_message
      ]);
      exit;
    }
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

    if (isset($form) && method_exists($form, 'usesAjax') && $form->usesAjax()) {
      wp_send_json([
        'status'  => 'error',
        'message' => $user_message
      ]);
      exit;
    } else {
      exit($user_message);
    }
  }
}

// AJAX ERROR HANDLING
if (wp_doing_ajax() && $form->hasError()) {
  // Return response as JSON
  wp_send_json([
    'status'       => 'error',
    'fields'       => $form->getFieldErrors(),
    'submit_error' => $form->getSubmitErrors(),
  ]);
  exit;
}
