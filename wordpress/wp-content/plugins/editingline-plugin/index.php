<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Editingline-plugin
 * Plugin URI:        https://editingline.com/
 * Description:       Plugin per le funzioni custom del sito
 * Version:           2.1.2
 * Author:            Loemme
 * Author URI:        https://editingline.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       editingline
 * Domain Path:       /languages
 *
 * @link              editingline.com
 * @package           Editingline_Plugin
 * 
 * 
 */

require_once 'inc/config.php';
require_once 'inc/taxonomies-brand.php';
require_once 'inc/functions.php';

require_once 'inc/cpt-pre-printing.php';
require_once 'inc/cpt-digital-print.php';
require_once 'inc/cpt-post-printing.php';
require_once 'inc/cpt-consumables.php';


require_once 'templates/pre-printing-template.php';
require_once 'templates/digital-print-template.php';
require_once 'templates/post-printing-template.php';
require_once 'templates/consumables-template.php';


function my_plugin_admin_styles() {
    wp_enqueue_style( 'my-plugin-admin-styles', plugin_dir_url( __FILE__ ) . 'css/admin-styles.css' );
}
add_action( 'admin_enqueue_scripts', 'my_plugin_admin_styles' );