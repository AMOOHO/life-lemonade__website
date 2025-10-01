<?php defined('ABSPATH') || exit; // Allows to be executed in WP environment only. Prevents direct access to file via URL 
?>

<?php if (USE_FORMAL_LANGUAGE) : ?>

  <div class="cookie-content-blocker">
    <span class="p fcolor--light"><?= __('Akzeptieren Sie Cookies für externe Medien, um diesen Inhalt sehen zu können.', 'cb'); ?>
    </span>
    <span class="accept-external button neg mt-xl-2">Jetzt akzeptieren</span>
  </div>

<?php else : // informal 
?>

  <div class="cookie-content-blocker">
    <span class="p fcolor--light"><?= __('Akzeptier Cookies für externe Medien, um diesen Inhalt sehen zu können.', 'cb'); ?>
    </span>
    <span class="accept-external button neg mt-xl-2">Jetzt akzeptieren</span>
  </div>

<?php endif; ?>