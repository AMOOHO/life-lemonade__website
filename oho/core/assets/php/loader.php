<?php defined('ABSPATH') || exit;

/**
 * This file includes all functions which are provided by the framework
 * without a respective option in the config.php
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */


// GLOBAL functions

require_once(get_template_directory() . '/core/assets/php/global/theme-setup.php');

require_once(get_template_directory() . '/core/assets/php/global/php8-polyfills.php');
require_once(get_template_directory() . '/core/assets/php/global/helper-functions.php');
require_once(get_template_directory() . '/core/assets/php/global/class-DEVELOP.php');
require_once(get_template_directory() . '/core/assets/php/global/disable-wp-emojis.php');
require_once(get_template_directory() . '/core/assets/php/global/disable-archives.php');
require_once(get_template_directory() . '/core/assets/php/global/image-upload-hooks.php');
require_once(get_template_directory() . '/core/assets/php/global/wordpress-navigation.php');

if (class_exists('WooCommerce')) {
  require_once(get_template_directory() . '/inc/woocommerce.php');
}



// FRONTEND functions

require_once(get_template_directory() . '/core/assets/php/frontend/customize-body-classes.php');
require_once(get_template_directory() . '/core/assets/php/frontend/template-tags.php');
require_once(get_template_directory() . '/core/assets/php/frontend/append-file-version.php');
require_once(get_template_directory() . '/core/assets/php/frontend/mail-link-encryption.php');
require_once(get_template_directory() . '/core/assets/php/frontend/image-orientation.php');
require_once(get_template_directory() . '/core/assets/php/frontend/short-title.php');
require_once(get_template_directory() . '/core/assets/php/frontend/navigation-active-state.php');
require_once(get_template_directory() . '/core/assets/php/frontend/load-template-part.php');
require_once(get_template_directory() . '/core/assets/php/frontend/phone-link-formatter.php');



// ADMIN functions

require_once(get_template_directory() . '/core/assets/php/admin/register-admin-styles.php');
