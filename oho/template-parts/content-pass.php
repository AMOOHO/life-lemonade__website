<?php
/**
* Template part for displaying password protected posts
*
* @package    TacoCat Boilerplate
* @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
* Do not use this software or replicate without permission of the owner.
*/

?>

<article id="post-<?php the_ID(); ?>">

  <section class="sec-wrap">
    <div class="sec-wrap__inner slimmer centered-text">

      <?php if(USE_FORMAL_LANGUAGE): ?>
      <p>Dieser Inhalt ist passwortgeschützt.<br>Um ihn anzuschauen, geben Sie bitte Ihr Passwort unten ein.</p>
      <?php else: // informal ?>
      <p>Dieser Inhalt ist passwortgeschützt.<br>Um ihn anzuschauen, gib bitte Dein Passwort unten ein.</p>
      <?php endif; ?>

    </div>
  </section>

  <section class="sec-wrap">
    <div class="sec-wrap__inner slim-af centered-text">

      <?php echo get_the_password_form(); ?>
      <br><br>
    </div>
  </section>

</article><!-- #post-<?php the_ID(); ?> -->