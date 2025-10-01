<?php defined('ABSPATH') || exit;

/**
 * Framework config
 *
 * @package    TacoCat Boilerplate
 * @copyright  © 2025 OHO Design GmbH (https://ohodesign.ch)
 * Do not use this software or replicate without permission of the owner.
 */



/* CONFIG ********************************************************************* */


/* DEFAULTS */

const INCLUDE_OHO_ASCII_ART           =   true;       //  true or false
const USE_FORMAL_LANGUAGE             =   true;       //  true or false   (if false, informal language is used e.g. for HazzelForms, cookie banner, 404 page etc.)

/* DEVELOPMENT (DANGER ZONE!) */

const ENABLE_DEVELOPER_MODE                    =   true;      //  true or false   (If false, all development settigs won't have effect)
/*    ├─   */
const ALLOW_PUBLIC_ACCESS       =   false;     //  true or false   (Public access will be restriced. Only available if logged in)
/*    ├─   */
const ENABLE_PREVIEW_BACKDOOR   =   true;      //  true or false   (Restricted public access available with preview link:
/*    ├─   */
const SHOW_PHP_ERRORS           =   true;      //  true or false   (Will show all php errors on page)


/* FRONTEND */

/*** services */

const ENABLE_BODY_CLASS_FILTER        =   true;     //  true or false   (filters default wordpress classes from the body tag)

/*** banners */

const INCLUDE_NOSCRIPT_BANNER         =   true;    //  true or false


/* NAVIGATION */

const CHANGE_NAVIGATION_TO_WORDPRESS_FUNCTION  =  false;    //  true or false