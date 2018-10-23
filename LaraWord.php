<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       LaraWord
 * Plugin URI:        http://example.com/LaraWord/
 * Description:       Laravel framework on frontend your Wordpress site.
 * Version:           1.0.0
 * Author:            Roman Shipelov
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       LaraWord
 * Domain Path:       /languages
 */

namespace LaraWord;

if ( ! defined( 'WPINC' ) ) {
  die;
}

define( 'LARAWORD_PLUGIN_NAME', 'LaraWord');
define( 'LARAWORD_VERSION','1.0.0');
define( 'LARAWORD_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

(new LaraWord())->run();