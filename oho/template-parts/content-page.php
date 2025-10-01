<?php
/**
* Template part for displaying page content in page.php
*
* @package    TacoCat Boilerplate
* @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
* Do not use this software or replicate without permission of the owner.
*/

?>

<article id="post-<?php the_ID(); ?>">
  <section class="sec-wrap <?php /* get woocommerce site */ echo is_checkout() ? 'checkout' : ''; ?><?php echo is_cart() ? 'cart' : ''; ?>">
    <div class="sec-wrap__inner">

      <h1 class="entry-title"><?php the_title(); ?></h1>

      <?php
      the_content();

      wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'oho' ),
        'after'  => '</div>',
      ) );
      ?>

    </div>
  </section>

</article><!-- #post-<?php the_ID(); ?> -->
