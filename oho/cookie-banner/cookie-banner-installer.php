<?php defined('ABSPATH') || exit; // Allows to be executed in WP environment only. Prevents direct access to file via URL 
?>

<?php
/*
* Load plugin textdomain.
*/
// function cb_load_textdomain() {
// load_plugin_textdomain( 'cb', false, basename( dirname( __FILE__ ) ) . '/languages/' );
// }
// add_action( 'init', 'cb_load_textdomain' );

?>



<?php /* Append Cookie Styles Script to Head */ ?>

<script>
  const cookieHead = document.getElementsByTagName('HEAD')[0];
  const cookieStyles = document.createElement('link');
  cookieStyles.rel = 'stylesheet';
  cookieStyles.type = 'text/css';
  cookieStyles.href = '<?= get_template_directory_uri(); ?>/cookie-banner/css/cookie.css';
  cookieHead.appendChild(cookieStyles);
</script>


<?php /* Include all Cookie-Banner PHP-Files (except cookie-content-blocker.php) */ ?>

<?php
foreach (glob(get_template_directory() . '/cookie-banner/php/*.php') as $cookieFile) {
  if (basename($cookieFile) !== 'cookie-content-blocker.php') {
    include $cookieFile;
  }
}
?>