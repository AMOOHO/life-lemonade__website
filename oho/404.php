<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

get_header(); ?>

<main class="error error-404 not-found">
  <div id="content-spacing" class="main__inner">

    <article>

      <section class="sec-wrap">
        <div class="sec-wrap__inner">

          <h1>404</h1>

          <?php
          // Aktuelle Sprache ermitteln (z. B. mit Polylang, WPML oder get_locale())
          $lang = substr(get_locale(), 0, 2); // 'de', 'en', 'fr', 'it'

          // Texte definieren
          $texts = [
            'formal' => [
              'de' => [
                'line1' => 'Leider existiert die von Ihnen gesuchte Seite nicht.',
                'line2' => 'Geben Sie die URL erneut in die Adressleiste ein oder gehen Sie auf unsere',
                'home'  => 'Startseite',
              ],
              'en' => [
                'line1' => 'Unfortunately, the page you are looking for does not exist.',
                'line2' => 'Please re-enter the URL in the address bar or go to our',
                'home'  => 'Home page',
              ],
              'fr' => [
                'line1' => 'Malheureusement, la page que vous recherchez n’existe pas.',
                'line2' => 'Veuillez saisir à nouveau l’URL dans la barre d’adresse ou aller sur notre',
                'home'  => 'Page d’accueil',
              ],
              'it' => [
                'line1' => 'Purtroppo, la pagina che sta cercando non esiste.',
                'line2' => 'Inserisca nuovamente l’URL nella barra degli indirizzi o vada alla nostra',
                'home'  => 'Pagina iniziale',
              ],
            ],
            'informal' => [
              'de' => [
                'line1' => 'Leider existiert die von Dir gesuchte Seite nicht.',
                'line2' => 'Bitte gib die URL erneut in die Adressleiste ein oder geh zurück auf unsere',
                'home'  => 'Startseite',
              ],
              'en' => [
                'line1' => 'Unfortunately, the page you are looking for does not exist.',
                'line2' => 'Please re-enter the URL in the address bar or go back to our',
                'home'  => 'Home page',
              ],
              'fr' => [
                'line1' => 'Malheureusement, la page que tu recherches n’existe pas.',
                'line2' => 'Veuillez saisir à nouveau l’URL dans la barre d’adresse ou revenir à notre',
                'home'  => 'Page d’accueil',
              ],
              'it' => [
                'line1' => 'Purtroppo, la pagina che stai cercando non esiste.',
                'line2' => 'Inserisci nuovamente l’URL nella barra degli indirizzi o torna alla nostra',
                'home'  => 'Pagina iniziale',
              ],
            ]
          ];

          // Falls Sprache nicht existiert, fallback auf Deutsch
          if (!isset($texts['formal'][$lang])) {
            $lang = 'de';
          }
          ?>

          <?php if (USE_FORMAL_LANGUAGE) : ?>
            <p><br>
              <?= $texts['formal'][$lang]['line1']; ?><br>
              <?= $texts['formal'][$lang]['line2']; ?> <a href="<?= esc_url(home_url('/')); ?>"><?= $texts['formal'][$lang]['home']; ?></a>.
            </p>
          <?php else : ?>
            <p><br>
              <?= $texts['informal'][$lang]['line1']; ?><br>
              <?= $texts['informal'][$lang]['line2']; ?> <a href="<?= esc_url(home_url('/')); ?>"><?= $texts['informal'][$lang]['home']; ?></a>.
            </p>
          <?php endif; ?>


        </div>
      </section>


    </article>

  </div>
</main>

<?php
get_footer();
