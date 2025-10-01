<?php
/**
* Template part for displaying a message that posts cannot be found
*
* @package    TacoCat Boilerplate
* @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
* Do not use this software or replicate without permission of the owner.
*/

?>

<section class="no-results not-found">
  <header class="page-header">
    <h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'oho' ); ?></h1>
  </header><!-- .page-header -->

  <div class="page-content">
    <?php
    if ( is_home() && current_user_can( 'publish_posts' ) ) :

      printf(
        '<p>' . wp_kses(
          /* translators: 1: link to WP admin new post page. */
          __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'oho' ),
          array(
            'a' => array(
              'href' => array(),
            ),
          )
          ) . '</p>',
          esc_url( admin_url( 'post-new.php' ) )
        );

        elseif ( is_search() ) :
          ?>

          <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'oho' ); ?></p>
          <?php
          get_search_form();

          else :
            ?>

            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'oho' ); ?></p>
            <?php
            get_search_form();

          endif;
          ?>
        </div><!-- .page-content -->
      </section><!-- .no-results -->
