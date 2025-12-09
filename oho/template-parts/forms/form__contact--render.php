<?php
$form = FormRepository::getInstance()->getForm('contact');
?>

<div class="form-wrap <?= $form->usesAjax() ? 'use-ajax' : ''; ?>">
  <?php $form->openForm(); ?>
  <div class="grid-wrap row-gap-xl-2 pr-xl-10 pr-md-0">

    <div class="box box-xl-12">
      <?php $form->renderField('Name'); ?>
    </div>
    <div class="box box-xl-12">
      <?php $form->renderField('Firma'); ?>
    </div>
    <div class="box box-xl-12">
      <?php $form->renderField('E-Mail'); ?>
    </div>
    <div class="box box-xl-12">
      <?php $form->renderField('Telefon'); ?>
    </div>
    <div class="box box-sm-12 box-md-12 box-xl-12">
      <?php $form->renderField('Mitteilung'); ?>
    </div>
    <div class="box box-sm-12 box-md-12 box-xl-12 clearfix">
      <?php
      if ($form->fieldExists('Captcha')) {
        $form->renderLabel('Captcha');
        $form->renderInput('Captcha');
      }

      $form->renderSubmitErrors();
      $form->renderSubmit('Anfrage absenden');
      ?>
      <?php /*
      <div class="mt-lg-2">
        <p class="s fcolor--darkGrey">
          Dieses Formular ist durch reCAPTCHA geschützt.<br>
          Es gelten die <a href="https://policies.google.com/privacy?hl=de" class="s" target="_blank">Datenschutzbestimmungen</a> von Google.
        </p>
      </div>
      */ ?>
    </div>
  </div>

</div>
<?php $form->closeForm(); ?>

<?php if ($form->isValid() && !$form->usesAjax()) {
  require_once(get_template_directory() . "/template-parts/forms/form__{$form->getFormName()}--success.php");
} ?>
</div>