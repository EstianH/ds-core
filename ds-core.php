<?php
/*
Plugin Name: DS Core
Plugin URI:  https://www.divspot.co.za/
Description: Adds the divSpot core to your website.
Version:     1.0
Author:      divSpot
Author URI:  https://www.divspot.co.za
License:     GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/

if( !defined( 'ABSPATH' ) ) exit;


/*
██████  ███████ ███████ ██ ███    ██ ██ ████████ ██  ██████  ███    ██ ███████
██   ██ ██      ██      ██ ████   ██ ██    ██    ██ ██    ██ ████   ██ ██
██   ██ █████   █████   ██ ██ ██  ██ ██    ██    ██ ██    ██ ██ ██  ██ ███████
██   ██ ██      ██      ██ ██  ██ ██ ██    ██    ██ ██    ██ ██  ██ ██      ██
██████  ███████ ██      ██ ██   ████ ██    ██    ██  ██████  ██   ████ ███████
*/
if( !defined( 'DIVSPOT_URL' ) )
	define( 'DIVSPOT_URL', 'https://www.divspot.co.za' );

define( 'DSC_BASENAME', plugin_basename( __FILE__ ) );
define( 'DSC_URL',      plugins_url( '', DSC_BASENAME) . '/' );
define( 'DSC_ROOT',     __DIR__ . '/' );
define( 'DSC_ASSETS',   DSC_URL . 'assets/' );
define( 'DSC_TITLE',    'DS Core' );
define( 'DSC_VERSION',  '1.0' );


/*
██████  ███████      ██████  ██████  ██████  ███████
██   ██ ██          ██      ██    ██ ██   ██ ██
██   ██ ███████     ██      ██    ██ ██████  █████
██   ██      ██     ██      ██    ██ ██   ██ ██
██████  ███████      ██████  ██████  ██   ██ ███████
*/
class DS_CORE {
	/**
	 * DS_CORE instance.
	 *
	 * @access private
	 * @static
	 * @var DS_CORE
	 */
	private static $instance = NULL;

	/**
	 * The DS Core object is created from within the class itself only if DS_CORE has no instance.
	 *
	 * @access public
	 * @static
	 * @return DS_CORE $instance
	 */
	public static function get_instance() {
		if ( NULL === self::$instance ){
			self::$instance = new DS_CORE();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @access private
	 */
	private function __construct() {
		if ( is_admin() )
			require_once DSC_ROOT . 'admin/inc/class-admin.php';
		else {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets_maybe' ) );
		}
	}

	/**
	 * Maybe Enqueue DS Core assets.
	 *
	 * @access public
	 */
	public function enqueue_assets_maybe() {
		$dsc_settings = get_option( 'dsc_settings' );

		if ( !empty( $dsc_settings['frontend']['include'] ) ) {
			wp_enqueue_style (  'dsc-style',  DSC_ASSETS . 'css/style.css', array(), DSC_VERSION );
			wp_enqueue_script ( 'dsc-script', DSC_ASSETS . 'js/script.js',	array(), DSC_VERSION );
		}

		if ( !empty( $dsc_settings['avada']['include'] ) )
			wp_enqueue_style (  'dsc-avada-column-overrides',  DSC_ASSETS . 'css/avada-column-overrides.css', array(), DSC_VERSION );
	}
}

$dsc_core = DS_CORE::get_instance();
