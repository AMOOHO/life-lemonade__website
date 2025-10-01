<?php
/**
* This is the template that displays the area of the page that contains both the current comments
* and the comment form.
*
* @package    TacoCat Boilerplate
* @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
* Do not use this software or replicate without permission of the owner.
*/
?>


<?php
/*
* If the current post is protected by a password and
* the visitor has not yet entered the password we will
* return early without loading the comments.
*/
if ( post_password_required() ) {
  return;
}
?>

<div id="comments" class="comments-area">

  <?php // You can start editing here -- including this comment! ?>
  <?php if (have_comments()) { ?>
    <h2 class="comments-title">
      <?php
      $oho_comment_count = get_comments_number();
      if ('1' === $oho_comment_count) {
        printf(
          /* translators: 1: title. */
          esc_html__('One thought on &ldquo;%1$s&rdquo;', 'oho'),
          '<span>' . get_the_title() . '</span>'
        );
      } else {
        printf( // WPCS: XSS OK.
          /* translators: 1: comment count number, 2: title. */
          esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $oho_comment_count, 'comments title', 'oho' ) ),
          number_format_i18n($oho_comment_count),
          '<span>' . get_the_title() . '</span>'
        );
      }
      ?>
    </h2><!-- .comments-title -->

    <?php the_comments_navigation(); ?>

    <ol class="comment-list">
      <?php
      wp_list_comments(array(
        'style'      => 'ol',
        'short_ping' => true,
      ));
      ?>
    </ol><!-- .comment-list -->

    <?php the_comments_navigation(); ?>

    <?php // If comments are closed and there are comments, let's leave a little note, shall we? ?>
    <?php if (!comments_open()) { ?>
      <p class="no-comments"><?php esc_html_e('Comments are closed.', 'oho'); ?></p>
    <?php } ?>

  <?php }; // Check for have_comments(). ?>

  <?php comment_form();	?>

</div><!-- #comments -->
