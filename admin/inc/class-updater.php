<?php
if( !defined( 'ABSPATH' ) ) exit;

$DS_CORE_UPDATER = DS_CORE_UPDATER::get_instance();


/*
██████  ███████      ██████  ██████  ██████  ███████     ██    ██ ██████  ██████   █████  ████████ ███████ ██████
██   ██ ██          ██      ██    ██ ██   ██ ██          ██    ██ ██   ██ ██   ██ ██   ██    ██    ██      ██   ██
██   ██ ███████     ██      ██    ██ ██████  █████       ██    ██ ██████  ██   ██ ███████    ██    █████   ██████
██   ██      ██     ██      ██    ██ ██   ██ ██          ██    ██ ██      ██   ██ ██   ██    ██    ██      ██   ██
██████  ███████      ██████  ██████  ██   ██ ███████      ██████  ██      ██████  ██   ██    ██    ███████ ██   ██
*/
class DS_CORE_UPDATER {
	/**
	 * Class instance.
	 *
	 * @access private
	 * @static
	 * @var DS_CORE_UPDATER
	 */
	private static $instance = NULL;

	/**
	 * Returns the instance of the class.
	 *
	 * @access public
	 * @static
	 * @return DS_CORE_UPDATER $instance
	 */
	public static function get_instance() {
		if ( NULL === self::$instance ){
			self::$instance = new DS_CORE_UPDATER();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @access private
	 */
	private function __construct() {
		// Define the alternative API for plugin updates.
		add_filter ( 'pre_set_site_transient_update_plugins', array( &$this, 'add_plugin_update_maybe' ), 10, 1 );

		// Define the alternative response for plugin information.
		add_filter( 'plugins_api', array( &$this, 'get_info' ), 10, 3 );
	}

	/**
	 * Display update notifications in the WP admin panel.
	 *
	 * @param object  $transient
	 * @uses string   DSC_VERSION
	 * @uses string   DSC_BASENAME
	 * @uses string   DIVSPOT_UPDATES_URL
	 * @return object $transient
	 */
	public function add_plugin_update_maybe( $transient ) {
		if ( empty( $transient->checked ) )
			return $transient;

		// Get the remote version.
		$remote_version = $this->get_remote_version();

		// If a newer version is available, add the update
		if ( version_compare( DSC_VERSION, $remote_version, '<' ) ) {
			list ( $plugin_folder, $plugin_file ) = explode( '/', DSC_BASENAME );
			$slug = str_replace( '.php', '', $plugin_file );
			$plugin_remote_args = '?plugin=' . $slug . '&action=download';

			$obj = new stdClass();
			$obj->slug = $slug;
			$obj->new_version = $remote_version;
			$obj->url = DIVSPOT_UPDATES_URL . $plugin_remote_args;
			$obj->package = DIVSPOT_UPDATES_URL . $plugin_remote_args;
			$transient->response[DSC_BASENAME] = $obj;
		}

		return $transient;
	}

	/**
	 * Add a description to the filter.
	 *
	 * @param boolean $false
	 * @param array $action
	 * @param object $arg
	 * @return bool|object
	 */
	public function get_info( $false, $action, $arg ) {
		if ( $arg->slug === $this->slug )
			return $this->get_remote_information();

		return false;
	}

	/**
	 * Fetch the latest remote version.
	 *
	 * @return bool|string $remote_version
	 */
	public function get_remote_version() {
		$request = wp_remote_get(
			DIVSPOT_UPDATES_URL,
			array(
				'body' => array(
					'plugin' => 'ds-core',
					'action' => 'version'
				)
			)
		);

		if ( !is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 )
			return json_decode( $request['body'] );

		return false;
	}

	/**
	 * Fetch information on the latest remote version.
	 *
	 * @return bool|object
	 */
	public function get_remote_information() {
		$request = wp_remote_get(
			DIVSPOT_UPDATES_URL,
			array(
				'body' => array(
					'plugin' => 'ds-core',
					'action' => 'info'
				)
			)
		);

		if ( !is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 )
			return json_decode( $request['body'] );

		return false;
	}
}
