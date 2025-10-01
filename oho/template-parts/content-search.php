<?php
/**
* Template part for displaying results in search pages
*
* @package    TacoCat Boilerplate
* @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
* Do not use this software or replicate without permission of the owner.
*/

?>

<article id="post-<?php the_ID(); ?>">
  <header class="entry-header">
    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

    <?php if ( 'post' === get_post_type() ) : ?>
    <div class="entry-meta">
      <?php
        oho_posted_on();
        oho_posted_by();
        ?>
    </div><!-- .entry-meta -->
    <?php endif; ?>
  </header><!-- .entry-header -->

  <?php oho_post_thumbnail(); ?>

  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->