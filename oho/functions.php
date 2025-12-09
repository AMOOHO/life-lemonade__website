<?php

/**
 * Custom theme functions and wordpress hooks
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */

/* OHO DESIGN FRAMEWORK CORE**********************************************************************************************************************/

require_once(get_template_directory() . '/core/core.php');
get_framework_part((is_admin() ? 'backend' : 'prehtml'));


/* WORDPRESS BASE SETUP **********************************************************************************************************************/


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

add_filter('body_class', function ($classes) {

  // add custom body classes here

  // 	example:
  // if ( is_page_template( array('pt-example.php', 'pt-example2.php')) ) {
  // 	$classes[] = 'wuup-wuup';
  // }


  if (is_front_page() || is_page(1079) /* Contact */) {
    $classes[] = 'theme--lemon';
    $classes[] = 'bg--lemon';
  } elseif (is_page(1077) /* Portrait */) {
    $classes[] = 'theme--lemon';
    $classes[] = 'bg--lemon--light';
  } elseif (is_singular('angebot')) {
    $color = get_field('colorpicker');
    $allowed_colors = ['lemon', 'mint', 'grape', 'strawberry', 'berry'];
    if (in_array($color['slug'], $allowed_colors)) {
      $classes[] = 'theme--' . $color['slug'];
    } else {
      $classes[] = 'theme--default';
    }
    $classes[] = 'bg--offwhite';
  } elseif (is_singular('blog')) {
    $color = get_field('colorpicker');
    $allowed_colors = ['lemon', 'mint', 'grape', 'strawberry', 'berry'];
    if (in_array($color['slug'], $allowed_colors)) {
      $classes[] = 'theme--' . $color['slug'];
    } else {
      $classes[] = 'theme--default';
    }
    $classes[] = 'bg--offwhite--yellow';
  } elseif (is_post_type_archive('angebot')) {
    $classes[] = 'theme--strawberry';
    $classes[] = 'bg--strawberry';
  } elseif (is_post_type_archive('blog')) {
    $classes[] = 'theme--mint';
    $classes[] = 'bg--primary';
  } else {
    $classes[] = 'theme--default';
    $classes[] = 'bg--offwhite';
  }

  // if (is_page(1077) /* Portrait */) {
  //   $classes[] = 'bg--primary';
  // }

  if (is_page(1079) /* Contact */) {
    $classes[] = 'contact';
  }


  return $classes;
});


/*
* ADD CUSTOM IMAGE SIZES
*/
add_action('after_setup_theme', function () {
  add_image_size('size_300',  300);
  add_image_size('size_600',  600);
  add_image_size('size_1200', 1200);
  add_image_size('size_1800', 1800);
  add_image_size('size_2200', 2200);
});

/*
* ALT TAG FUNCTION
*/
/**
 *  Get alt tag by image id
 */
function get_alt_tag($imgId = 0) {
  $altTag     = '';
  $suffix     = get_bloginfo();
  $imgCaption = !empty($imgId) ? get_post_meta($imgId, '_wp_attachment_image_alt', true) : '';

  if (empty($imgCaption)) {
    // if attachement alt tag is empty -> use a default value
    $altTag = empty(get_the_title()) ? $suffix : $suffix . ', ' . get_the_title();
  } else {
    // alt tag is set -> use it and add a suffix
    $altTag = $imgCaption . ' | ' . $suffix;
  }

  return $altTag;
}

/***** CUSTOM WYSIWYG TOOLBAR */
add_filter('acf/fields/wysiwyg/toolbars', 'custom_tinymce_toolbars');
function custom_tinymce_toolbars($toolbars) {
  $toolbars['Format / Bold / Link / Unlink / Bullet List / Undo / Redo'][1] = array('formatselect', 'bold', 'link', 'unlink', 'bullist', 'undo', 'redo');
  // Edit the "Full" toolbar and remove 'code'
  // - delete from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
  if (($key = array_search('code', $toolbars['Full'][2])) !== false) {
    unset($toolbars['Full'][2][$key]);
  }
  // remove the 'Basic' toolbar completely
  unset($toolbars['Basic']);
  // return $toolbars - IMPORTANT!
  return $toolbars;
}

// limit wysiwyg format select dropdown
add_filter('tiny_mce_before_init', function ($settings) {
  $settings['block_formats'] = 'Titel=h2;Untertitel=h3;Normaler Text=p;';
  return $settings;
});


/* WORDPRESS BACKEND BASE **********************************************************************************************************************/

/***** REORDER AND RENAME BACKEND MENU */
function oho_custom_menu_order($menu_ord) {
  if (!$menu_ord) return true;

  return array(
    'index.php', // Dashboard
    'separator1', // First separator
    'edit.php', // Posts
    'hauptseite',
    'link-manager.php', // Links
    'edit-comments.php', // Comments
    'upload.php', // Media
    'edit.php?post_type=page', // Pages
    'startseite', // Startseite
    'portrait', // Portrait
    'edit.php?post_type=blog', // Blog
    'edit.php?post_type=angebot', // Angebot
    'kontakt', // Kontakt
    'separator2', // Second separator
    'themes.php', // Appearance
    'plugins.php', // Plugins
    'law-and-order', // Imprint + data privacy
    'users.php', // Users
    'tools.php', // Tools
    'options-general.php', // Settings
  );
}
add_filter('custom_menu_order', 'oho_custom_menu_order', 10, 1);
add_filter('menu_order', 'oho_custom_menu_order', 10, 1);


/***** RENAME DEFAULT POST TYPE */
function customize_post_admin_menu_labels() {
  global $menu;
  global $submenu;
  $menu[2][0] = 'Dashboard';
  $menu[5][0] = 'Posts';
  $menu[10][0] = 'Mediathek';
  unset($menu[99]); // remove ghost menu item
}
add_action('admin_menu', 'customize_post_admin_menu_labels');
add_action('admin_menu', 'oho_admin_menu_posts');
function oho_admin_menu_posts() {
  global $menu;
  foreach ($menu as $key => $val) {
    if ('Posts' == $val[0]) {
      $menu[$key][6] = 'dashicons-solid-custom-newspaper';
    }
  }
}

// remove default post type
function remove_default_post_type($args, $postType) {
  if ($postType === 'post') {
    $args['public']                = false;
    $args['show_ui']               = false;
    $args['show_in_menu']          = false;
    $args['show_in_admin_bar']     = false;
    $args['show_in_nav_menus']     = false;
    $args['can_export']            = false;
    $args['has_archive']           = false;
    $args['exclude_from_search']   = true;
    $args['publicly_queryable']    = false;
    $args['show_in_rest']          = false;
  }

  return $args;
}
add_filter('register_post_type_args', 'remove_default_post_type', 0, 2);

// hide dashboard widget
function remove_draft_widget() {
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
}
add_action('wp_dashboard_setup', 'remove_draft_widget', 999);


/***** AJAX LOAD MORE */
function ajax_load_more_posts() {

  // assign input vars
  $postsPerPage = intval($_POST['number']);
  $loadedPosts = array_map('intval', $_POST['loaded']);
  $postType = $_POST['type'];

  // validate input
  if (
    isset($postsPerPage) && !empty($postsPerPage)
    && is_array($loadedPosts)
    && isset($postType) && !empty($postType) && post_type_exists($postType)
  ) {

    // set up WP query
    $args = array(
      'posts_per_page' => $postsPerPage,
      'post__not_in' => $loadedPosts,
      'post_type' => $postType,
      'post_status' => 'publish',
    );
    $wp_query = new WP_Query($args);

    // start output buffer
    ob_start();

    while ($wp_query->have_posts()) {
      $wp_query->the_post();
      get_template_part('template-parts/snippets/snippet__posts');
    }

    // get output buffer
    $newPosts = ob_get_clean();

    if (!empty($newPosts)) {
      exit($newPosts);
    }
  }

  exit('false');
};
add_action('wp_ajax_nopriv_ajax_load_more_posts', 'ajax_load_more_posts');
add_action('wp_ajax_ajax_load_more_posts', 'ajax_load_more_posts');



/**
 * Get all terms which are actually used by posts
 * 
 * Wordperss does not provide a function for this by default
 * The param "hide_empty" only hides terms which are not used by any post
 * but if a term is used on a draft / private post, it will not be hidden
 * 
 * @param string $taxonomy taxonomy slug
 * @param array $queryArgs WP_Query arguments
 * @return array $terms array of term objects
 */

function get_used_terms($taxonomy, $queryArgs = []) {

  // Override arguments 
  $queryArgs['posts_per_page'] = -1;    // check all posts
  $queryArgs['fields']         = 'ids'; // only return post IDs (faster query)

  // Create a new WP_Query instance
  $query = new WP_Query($queryArgs);

  // Get the post IDs
  $post_ids = $query->posts;

  // Check if there are posts
  if (empty($post_ids)) {
    return [];
  }

  // Get terms associated with the post IDs
  $terms = wp_get_object_terms($post_ids, $taxonomy, ['fields' => 'all']);

  // Check for errors
  if (is_wp_error($terms)) {
    return [];
  }

  // Return the terms
  return $terms;
}




/* WORDPRESS MISC **********************************************************************************************************************/

/***** BREADCRUMB FUNCTION */

function nav_breadcrumb() {

  $delimiter = '&rsaquo;';
  $home = 'Home';
  $before = '<span class="current-page">';
  $after = '</span>';

  if (!is_home() && !is_front_page() || is_paged()) {

    echo '<nav class="breadcrumb s">';

    global $post;
    $homeLink = get_bloginfo('url');
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    if (is_category()) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo (get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . single_cat_title('', false) . $after;
    } elseif (is_day()) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
      echo $before . get_the_time('Y') . $after;
    } elseif (is_single() && !is_attachment()) {
      if (get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . mb_strimwidth(get_the_title(), 0, 50, '…') . $after;
      } else {
        $cat = get_the_category();
        $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . mb_strimwidth(get_the_title(), 0, 50, '…') . $after;
      }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID);
      $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . mb_strimwidth(get_the_title(), 0, 50, '…') . $after;
    } elseif (is_page() && !$post->post_parent) {
      echo $before . mb_strimwidth(get_the_title(), 0, 50, '…') . $after;
    } elseif (is_page() && $post->post_parent) {
      $parent_id = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . mb_strimwidth(get_the_title(), 0, 50, '…') . $after;
    } elseif (is_search()) {
      echo $before . 'Ergebnisse für Ihre Suche nach "' . get_search_query() . '"' . $after;
    } elseif (is_tag()) {
      echo $before . 'Beiträge mit dem Schlagwort "' . single_tag_title('', false) . '"' . $after;
    } elseif (is_404()) {
      echo $before . '404' . $after;
    }

    if (get_query_var('paged')) {
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ' (';
      echo ': ' . __('Seite') . ' ' . get_query_var('paged');
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo ')';
    }

    echo '</nav>';
  }
}

/***** STYLE WP PASSWORD FORM / ERROR MESSAGES */

/**
 * Add a message to the password form.
 *
 * @wp-hook the_password_form
 * @param   string $form
 * @return  string
 */
function custom_protected_post_password_msg($form) {
  // No cookie, the user has not sent anything until now.
  if (!isset($_COOKIE['wp-postpass_' . COOKIEHASH]))
    return $form;
  // Translate and escape.
  $msg = esc_html__('Falsches Passwort', 'your_text_domain');
  // We have a cookie, but it doesn’t match the password.
  $msg = "<span class='custom-password-message'>$msg</span>";
  return $msg . $form;
}
add_filter('the_password_form', 'custom_protected_post_password_msg');

/** SEARCHREPLACE TITLE ADON "Geschützt" */
function the_title_trim($title) {
  $title = esc_attr($title);
  $findthese = array(
    '#Geschützt: #'
  );
  $replacewith = array(
    '', // What to replace "Protected: " with
    '' // What to replace "Private: " with
  );
  $title = preg_replace($findthese, $replacewith, $title);
  return $title;
}
add_filter('the_title', 'the_title_trim');


/***** REST API */

// Register API endpoints
add_action('rest_api_init', function () {

  // Dynamic route to accept different post types
  register_rest_route('fma-load-more', '/(?P<post_type>[\w-]+)', [
    'methods'  => 'GET',
    'callback' => 'fma_load_more',
    'args' => [
      'post_type' => [
        'validate_callback' => function ($param, $request, $key) {
          return post_type_exists($param);
        },
        'sanitize_callback' => 'sanitize_text_field'
      ],
    ],
  ]);
});


/**
 * Disable the REST API for the public (calls are permitted only if a user is logged in)
 * @source https://developer.wordpress.org/rest-api/frequently-asked-questions/#can-i-disable-the-rest-api
 */
add_filter('rest_authentication_errors', function ($result) {
  if (true === $result || is_wp_error($result)) {
    return $result; // return if authentication was done previousely
  }

  // list of allowed route namespaces / endpoints
  $allowedEndpoints = [
    "/fma-load-more/blog",
  ];

  global $wp;
  if (!in_array(ltrim($wp->request, 'wp-json'), $allowedEndpoints) && !is_user_logged_in()) {
    return new WP_Error('rest_not_logged_in', __('You are not currently logged in.'), array('status' => 401));
  }
  return $result;
});

function fma_load_more(WP_REST_Request $request) {

  // default params
  $existing_ids = [];

  // check id params
  if (!empty($request->get_param('existing_ids'))) {
    $existing_ids = $request->get_param('existing_ids');

    // convert string to array
    $existing_ids = !is_array($existing_ids) ? explode(',', $existing_ids) : $existing_ids;
    $existing_ids = array_map('intval', $existing_ids);
  }

  // check category filter param
  if (!empty($request->get_param('terms') && is_array($request->get_param('terms')))) {
    $tax_filter = $request->get_param('terms');
    $tax_filter = array_map('esc_attr', $tax_filter);;
  }

  // get post type from request
  $post_type = $request->get_param('post_type');

  // set up WP query
  $args = [
    'post_type'        => $post_type,
    'posts_per_page'   => 6,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_status'      => 'publish',
    'has_password'     => false,
    'post__not_in'     => $existing_ids,
  ];

  // add taxonomy filter
  if (!empty($tax_filter)) {
    $args['tax_query'] = [
      [
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => $tax_filter,
      ],
    ];
  }

  // set default response
  $response = ['new_items' => []];

  // generate json output 
  $wp_query = new WP_Query($args);

  while ($wp_query->have_posts()) {
    $wp_query->the_post();
    $postData = include(get_template_directory() . "/template-parts/snippets/{$post_type}/snippet__grid-item--data.php");
    if ($postData) {
      $postData['html'] = load_template_part("template-parts/snippets/{$post_type}/snippet__grid-item--html", null, ['data' => $postData]);
      $response['new_items'][] = $postData;
    }
  }
  wp_reset_postdata();

  // add meta data to response
  $response['num_items']     = $wp_query->post_count;
  $response['num_remaining'] = $wp_query->found_posts - $wp_query->post_count;
  $response['locale']        = get_locale();

  // Return response as JSON
  return new WP_REST_Response($response, 200);
}


/*
 * LOAD TEMPLATE PART
 */
if (!function_exists('load_template_part')) {
  function load_template_part($template_name, $part_name = null, $args = []) {
    ob_start();
    get_template_part($template_name, $part_name, $args);
    return ob_get_clean();
  }
}


/***** RSS */
/**
 * Disable RSS Feed by default
 */
function itsme_disable_feed() {
  wp_die(__('No feed available, please visit the homepage.'));
}

add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);


// Remove default RSS meta infos from header
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);



/* ACF **********************************************************************************************************************/

/**
 * ACF HOOK TO PURGE LITESPEED CACHE RIGHT AFTER OPTION PAGE CHANGES
 */
add_action('acf/save_post', function ($post_id) {
  if (defined('LSCWP_V') && !is_int($post_id)) {
    // applies only for option pages as they do not have a numeric page id
    do_action('litespeed_purge_all');
  }
});

/* HAZZELFORMS AUTO-LOAD FORMS **********************************************************************************************************************/


function load_form_repository_and_forms() {
  // return if on admin page
  if (is_admin() && !wp_doing_ajax()) {
    return;
  }

  require_once(get_template_directory() . '/template-parts/forms/FormRepository.php');
  foreach (glob(get_template_directory() . '/template-parts/forms/form__*--config.php') as $file) {
    require_once($file);
  }
}
add_action('wp_loaded', 'load_form_repository_and_forms');



// For AJAX requests
function handle_ajax_form_request() {
  if (!empty($_POST)) {
    load_form_repository_and_forms();

    // check if form was submitted
    foreach (FormRepository::getInstance()->getAllForms() as $form) {
      if (isset($_POST[$form->getFormName()])) {
        require_once(get_template_directory() . "/template-parts/forms/form__{$form->getFormName()}--render.php");
        exit; // exit after first match because only one form can be submitted at a time
      }
    }
  }

  wp_send_json(['status' => 'error']);
  exit;
}
add_action('wp_ajax_form_submit',        'handle_ajax_form_request');
add_action('wp_ajax_nopriv_form_submit', 'handle_ajax_form_request');


// Initialize PHPMailer
function createMailer() {
  require_once(get_template_directory() . '/inc/PHPMailer/PHPMailer.php');
  require_once(get_template_directory() . '/inc/PHPMailer/Exception.php');
  require_once(get_template_directory() . '/inc/PHPMailer/SMTP.php');

  $smtpConfigFile = get_template_directory() . '/inc/smtp-config.php';
  if (file_exists($smtpConfigFile)) {
    require_once($smtpConfigFile);
  } else {
    // Fallback: leere Werte oder Dummy-Konstanten setzen
    if (!defined('SMTP_PASSWORD')) {
      define('SMTP_PASSWORD', '');
    }
    // Optional: Admin benachrichtigen, dass die Config fehlt
    mail(
      'wordpress@ohodesign.ch',
      'Mail Config Missing',
      'Die Datei smtp-config.php wurde nicht gefunden. SMTP_PASSWORD ist leer.'
    );
  }

  if (!class_exists('PHPMailer\PHPMailer\PHPMailer') || empty(SMTP_PASSWORD)) {
    // send error to admin
    mail(
      'wordpress@ohodesign.ch', // to
      'Mail Error',  // subject
      'PHPMailer or SMTP_PASSWORD is missing!' // msg
    );
    return null;
  }

  $mailer = new PHPMailer\PHPMailer\PHPMailer(true);

  //Server settings
  $mailer->isSMTP();
  $mailer->Host       = 'mail.cyon.ch';                     // Set the SMTP server to send through
  $mailer->Username   = '';                                 // SMTP username
  $mailer->Password   = SMTP_PASSWORD;                     // SMTP password
  $mailer->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
  $mailer->SMTPAuth   = true;                               // Enable SMTP authentication
  $mailer->Port       = 465;                                // TCP port to connect to

  return $mailer;
}




/* POLYLANG **********************************************************************************************************************/

/**
 * Alias for get_permalink() to return the permalink for a specific page
 * but with multilanguage support
 *
 * @param  int    id of post / page in any language
 * @return string permalink of the matching page in the current language
 */
function get_permalink_ml($id) {
  // find matching id in current language
  if (function_exists('pll_get_post')) {
    $id = pll_get_post($id);
  }
  return get_permalink($id);
}


/**
 * ACF Hook to show warning if on ACF-Edit-Page when single language selected
 */
add_action('admin_notices', function () {

  // guard clause: return if polylang is not active
  if (!function_exists('pll_current_language')) {
    return;
  }

  $screen = get_current_screen();

  // Check if we are on the ACF page
  if ($screen->id === 'edit-acf-field-group' || $screen->id === 'acf-field-group') {
    $current_language = pll_current_language();

    // Check if the current language is not 'all'
    if ($current_language !== false) {
      echo '<div class="notice notice-error">';
      _e('<h3 style="margin: 0;">ACHTUNG: Auf keinen Fall speichern!</h3><br>
     Du hast im Sprach-Switch eine einzelne Sprache ausgewählt. Wechsle zu <b>Alle Sprachen anzeigen</b>, um Fehler in der Felddarstellung zu vermeiden!<br>
      ', 'oho');
      echo '</div>';
    }
  }
});


/* LITESPEED CACHE **********************************************************************************************************************/

/**
 * Remove Litespeed Page Options for non-admin
 */
function remove_ols_metabox() {
  if (is_admin() && !current_user_can('administrator')) {
    $args = array(
      'public' => true,
    );

    $post_types = get_post_types($args);
    foreach ($post_types  as $post_type) {
      remove_meta_box('litespeed_meta_boxes', $post_type, 'side');
    }
  }
}
add_action('add_meta_boxes', 'remove_ols_metabox', 999);

/* YOAST SEO **********************************************************************************************************************/

/**
 * Remove YOAST Page Options for non-admin
 */
function remove_yoast_metabox() {
  if (is_admin() && !current_user_can('administrator')) {
    $args = array(
      'public' => true,
    );

    $post_types = get_post_types($args);
    foreach ($post_types  as $post_type) {
      remove_meta_box('wpseo_meta', $post_type, 'normal');
    }
  }
}
add_action('add_meta_boxes', 'remove_yoast_metabox', 999);


/* WPML **********************************************************************************************************************/

/**
 * FUNCTION TO GET CURRENT LANGUAGE
 */
function get_wpml_lang() {
  $current_lang = apply_filters('wpml_current_language', NULL);
  return $current_lang;
}

/**
 * Alias for wpml_lang_toggler() to return the permalink for a specific page
 * but with multilanguage support
 *
 * @param  int    id of post / page in any language
 * @return string permalink of the matching page in the current language
 */
function wpml_lang_toggler() {
  if (function_exists('icl_get_languages')) :
    $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
    if (!empty($languages)) :
      echo "\n<ul class=lang--toggler plain " . "\"languages\">\n";
      foreach ($languages as $lang) :
        echo '<li class="' . ($lang['active'] ? 'active' : '') . '"><a href=' . $lang['url'] . '>' . $lang['language_code'] . "</a></li>\n";
      endforeach;
      echo "</ul>\n";
    endif; // ( ! empty( $languages ) )
  endif; // ( function exists )
}


/**
 * Alias for get_permalink() to return the permalink for a specific page
 * but with multilanguage support
 *
 * @param  int    id of post / page in any language
 * @return string permalink of the matching page in the current language
 */
function get_permalink_wpml($id) {
  $currentLang = apply_filters('wpml_current_language', NULL);
  // find matching id in current language
  $id = apply_filters('wpml_object_id', $id, 'post', true, $currentLang);
  return get_permalink($id);
}


/**
 * Alias for is_page() to return the id for a specific page
 * but with multilanguage support
 *
 * @param  int    id of post / page in any language
 * @return true/false depending if current page is matching entered id
 */

function is_page_wpml($id) {
  $currentLang = apply_filters('wpml_current_language', NULL);
  // find matching id in current language
  $id = apply_filters('wpml_object_id', $id, 'post', true, $currentLang);
  return is_page($id);
}



/* GET PAGE TEMPLATE SLUG **********************************************************************************************************************/


/**
 * Get page template slug without prefix & suffix
 * @return string simplified template name or "single" which is the default template
 */

function getPageTemplateSlug() {
  $templateName = str_replace(['pt-', '.php'], '', get_page_template_slug());
  return empty($templateName) ? "single" : $templateName;
}
