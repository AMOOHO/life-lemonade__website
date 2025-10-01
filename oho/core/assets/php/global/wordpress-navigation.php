<?php defined( 'ABSPATH' ) || exit;

/* OHO Design Navigation Setting ***************************************/

// Add Navigation to Menu
add_action('admin_menu', 'oho_navigationmenu_admin');
add_action('admin_menu', 'oho_navigationmenu_adminremove');

function oho_navigationmenu_admin() {
  global $menu;
  $menu[99] = array('', 'read', 'separator', '', 'menu-top menu-nav');
  if(CHANGE_NAVIGATION_TO_WORDPRESS_FUNCTION === true) {
    add_menu_page(__('Navigation', 'mav-menus'), __('Navigation', 'nav-menus'), 'edit_themes', 'nav-menus.php', '','dashicons-menu');
  }
}
function oho_navigationmenu_adminremove() {
  global $submenu;
  unset($submenu['themes.php'][10]); // Removes Menu
}

//Add Navigationmenu
add_action( 'init', 'oho_navigationmenu_menu' );
function oho_navigationmenu_menu() {
  register_nav_menus(array('navigationmenu' => __( 'Navigationsmenü' )));
}

//Limit Navigationmenu depth to 0
//Hide unused Items
add_action( 'admin_enqueue_scripts', 'oho_navigationmenu_limitdepth' );
function oho_navigationmenu_limitdepth( $hook ) {
  if ( $hook != 'nav-menus.php' ) return;
  wp_add_inline_script(
    'nav-menu', 'wpNavMenu.options.globalMaxDepth = 0;', 'after'
  );
  wp_add_inline_style(
  'nav-menus', '#screen-options-link-wrap,
                .page-title-action,
                .manage-menus,
                .nav-tab-wrapper,
                #nav-menu-header,
                .menu-settings,
                .delete-action,
                #add-post_tag,
                #add-category,
                .field-move
                { display:none!important; }'
  );
}

// Function to get an array of the Navigation
function wp_get_menu_array($current_menu) {
  $locations = get_nav_menu_locations();
  $array_menu = wp_get_nav_menu_items($locations[$current_menu]);
  $menu = array();
  $submenu = array();
  foreach ($array_menu as $m) {
    if (empty($m->menu_item_parent)) {
      $menu[$m->ID] = array();
      $menu[$m->ID]['ID']           =   $m->ID;
      $menu[$m->ID]['title']        =   $m->title;
      $menu[$m->ID]['url']          =   $m->url;
      $menu[$m->ID]['children']     =   array();
      $menu[$m->ID]['actual']       =   get_post_field('post_name',$m->object_id);
    }
  }
  foreach ($array_menu as $m) {
    if ($m->menu_item_parent) {
      $submenu[$m->ID] = array();
      $submenu[$m->ID]['ID']        =   $m->ID;
      $submenu[$m->ID]['title']     =   $m->title;
      $submenu[$m->ID]['url']       =   $m->url;
      $submenu[$m->ID]['actual']    =   get_post_field('post_name',$m->object_id);
      $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
    }
  }
  return $menu;
}
