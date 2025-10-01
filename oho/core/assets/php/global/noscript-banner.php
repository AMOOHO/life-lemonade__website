<?php defined('ABSPATH') || exit; // Allows to be executed in WP environment only. Prevents direct access to file via URL 
?>

<?php if (defined('USE_FORMAL_LANGUAGE') && USE_FORMAL_LANGUAGE) : ?>

  <noscript>
    <input type="checkbox" id="hide-button" class="hide-noscript-banner">
    <div id="noscript" class="warning-banner noscript-banner" data-nosnippet>
      <div>
        <span class="p"><b>Bitte aktivieren Sie Javascript um den vollen Funktionsumfang dieser Webseite nutzen zu können.</b></span>
      </div>
      <div class="button-wrap">
        <a href="https://www.enable-javascript.com/de/" target="_blank">Wie geht das?</a>
        <label for="hide-button" class="hide-button-label">
          <span>Ausblenden</span>
        </label>
      </div>
    </div>
  </noscript>

<?php else : // informal 
?>

  <noscript>
    <input type="checkbox" id="hide-button" class="hide-noscript-banner">
    <div id="noscript" class="warning-banner noscript-banner" data-nosnippet>
      <div>
        <span class="p"><b>Bitte aktiviere Javascript um den vollen Funktionsumfang dieser Webseite nutzen zu können.</b></span>
      </div>
      <div class="button-wrap">
        <a href="https://www.enable-javascript.com/de/" target="_blank">Wie geht das?</a>
        <label for="hide-button" class="hide-button-label">
          <span>Ausblenden</span>
        </label>
      </div>
    </div>
  </noscript>

<?php endif; ?>