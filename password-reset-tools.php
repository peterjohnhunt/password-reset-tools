<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Password Reset Tools
 * Plugin URI:        http://github.com/peterjohnhunt/password-reset-tools
 * Description:       Password Reset Options and Tools
 * Version:           1.0.0
 * Author:            PeterJohn Hunt
 * Author URI:        http://peterjohnhunt.com
 * Text Domain:       password-reset-tools-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

namespace PRT;
	  use PRT\Includes;

if ( ! defined( 'WPINC' ) ) {
	die;
}

include_once plugin_dir_path( __FILE__ ) . 'libraries/autoloader.php';

function run_password_reset_tools() {
	$prt = new Includes\Password_Reset_Tools();
	$prt->run();
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\\run_password_reset_tools' );