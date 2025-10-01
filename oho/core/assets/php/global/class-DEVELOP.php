<?php defined( 'ABSPATH' ) || exit;

/**
* This class handels development preview access
* It does not really benefit from being a class as everything is static...
*
* @package    TacoCat Boilerplate
* @copyright  © 2021 OHO Design GmbH (https://ohodesign.ch)
* Do not use this software or replicate without permission of the owner.
*/

class DEVELOP
{


  /**
  *   Use this function to start a development section on a live installation
  *   It uses output buffering to prevent the public from seeing it
  */
  public static function start( $accessKey = 'preview', $highlight = false ) {

    // store params
    $GLOBALS['oho_dev_mode']['current_key'] = $accessKey;
    $GLOBALS['oho_dev_mode'][$accessKey]    = [
      'highlight' => $highlight,
      'has_else'  => false
    ];

    // start output buffer
    ob_start();

  }


  /**
  *   This function will display all content from the private section
  *   And start will then output buffer again to prevent the output of the public section inhouse
  *
  *   On the public side, it will discard the buffer of the private section and
  *   start the buffer again
  */
  public static function public() {

    $accessKey = $GLOBALS['oho_dev_mode']['current_key'];

    // handle collected buffer
    if(self::is_office_ip()){
      echo self::highlight_buffer( ob_get_clean() );
    } elseif(self::is_preview_mode()){
      // if preview and no else case
      ob_end_flush();
      self::set_preview_cookie();
    } else {
      // delete content if not in office
      ob_end_clean();
    }

    // start output buffer again
    $GLOBALS['oho_dev_mode'][$accessKey]['has_else'] = true;
    ob_start();

  }


  /**
  *   Use this function to end the development section
  *
  *   This will automatically trigger the buffer_callback function
  *   before printing or deleting the buffer content
  */
  public static function end() {

    $accessKey = $GLOBALS['oho_dev_mode']['current_key'];

    if(self::is_office_ip() && ! $GLOBALS['oho_dev_mode'][$accessKey]['has_else']){
      // if office and no else case
      echo self::highlight_buffer( ob_get_clean() );
    } elseif(self::is_preview_mode() && ! $GLOBALS['oho_dev_mode'][$accessKey]['has_else']){
      // if preview and no else case
      ob_end_flush();
      self::set_preview_cookie();
    } elseif(!self::is_office_ip() && !self::is_preview_mode() && $GLOBALS['oho_dev_mode'][$accessKey]['has_else']) {
      // is not office and else case exists
      ob_end_flush(); // show buffered content
    } else {
      // not office and no else case (private) OR office and else case (public)
      ob_end_clean(); // discard buffered content
    }

    // clean globals
    unset($GLOBALS['oho_dev_mode'][$accessKey]);

  }


  /**
  *   This function checks if a user is allowed to see the buffered development section
  *
  *   Allowed:
  *   — Preview Backdoor is enabled + The user uses the correct access key as GET parameter
  *   — Preview Backdoor is enabled + The user returns from a differnt page but has already used the access token before (cookie is already set)
  */
  private static function is_preview_mode() {

    $accessKey = $GLOBALS['oho_dev_mode']['current_key'];

    return (
      (isset($_GET['access']) && $_GET['access'] == $accessKey)
      || (isset($_COOKIE['develop_biscuit_'.$accessKey]))
    );

  }


  /**
  *   Check if user request is from oho design office
  */
  public static function is_office_ip() {
    return $_SERVER['REMOTE_ADDR'] == json_decode( file_get_contents("https://cdn.ohodesign.ch/services/office-ip/"), true)['ip'];
  }


  /**
  *   Highlight private section with a red outline (only in oho office)
  */
  private static function highlight_buffer($buffer) {
    $accessKey = $GLOBALS['oho_dev_mode']['current_key'];

    if($GLOBALS['oho_dev_mode'][$accessKey]['highlight']){
      $buffer = '<div class="develop__preview" style="border: 1px dashed red; width: 100%;">' . $buffer . '</div>';
    }

    return $buffer;
  }


  /**
  *   Adds an inline script to the output buffer which set's the preview cookie
  */
  private static function set_preview_cookie() {
    echo '<script>Cookies.set("develop_biscuit_' . $GLOBALS['oho_dev_mode']['current_key'] . '", "1");</script>';
  }


}
