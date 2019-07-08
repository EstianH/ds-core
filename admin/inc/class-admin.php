<?php
if( !defined( 'ABSPATH' ) ) exit;

$ds_core_admin = DS_CORE_ADMIN::get_instance();


/*
██████  ███████      ██████  ██████  ██████  ███████      █████  ██████  ███    ███ ██ ███    ██
██   ██ ██          ██      ██    ██ ██   ██ ██          ██   ██ ██   ██ ████  ████ ██ ████   ██
██   ██ ███████     ██      ██    ██ ██████  █████       ███████ ██   ██ ██ ████ ██ ██ ██ ██  ██
██   ██      ██     ██      ██    ██ ██   ██ ██          ██   ██ ██   ██ ██  ██  ██ ██ ██  ██ ██
██████  ███████      ██████  ██████  ██   ██ ███████     ██   ██ ██████  ██      ██ ██ ██   ████
*/
class DS_CORE_ADMIN {
	/**
	 * DS_CORE_ADMIN instance.
	 *
	 * @access private
	 * @static
	 * @var DS_CORE_ADMIN
	 */
	private static $instance = NULL;

	/**
	 * Plugin permission capability.
	 *
	 * @access private
	 * @var string
	 */
	private $capability;

	/**
	 * Plugin menu item slug.
	 *
	 * @access private
	 * @var string
	 */
	private $slug;

	/**
	 * The DS Core object is created from within the class itself only if DS_CORE_ADMIN has no instance.
	 *
	 * @access public
	 * @static
	 * @return DS_CORE_ADMIN $instance
	 */
	public static function get_instance() {
		if ( NULL === self::$instance ){
			self::$instance = new DS_CORE_ADMIN();
		}

		return self::$instance;
	}

	/**
	 * DS Core Admin constructor.
	 *
	 * @access public
	 * @uses definition DSC_BASENAME The plugin basename.
	 */
	public function __construct() {
		$this->capability = 'edit_plugins';
		$this->slug       = 'ds-general';

		$this->render_admin_menu();

		// Actions
		add_action( 'admin_enqueue_scripts', array( $this, 'load_assets' ) );

		// Filters
		add_filter( "plugin_action_links_" . DSC_BASENAME, array( $this, 'register_plugin_action_links' ), 10, 1 ); // Add plugin list settings link.

		// Require plugin updater.
		require_once DSC_ROOT . 'admin/inc/class-updater.php';
	}

	/**
	 * Create/render the DS Core admin menu items.
	 *
	 * @access public
	 * @uses $GLOBALS
	 * @uses definition DSC_ASSETS The DS Core assets folder path.
	 */
	public function render_admin_menu() {
		add_action( 'admin_menu', function() {
			if( !isset( $GLOBALS['admin_page_hooks'][$this->slug] ) ) {
				add_menu_page(
					'divSpot',
					'divSpot',
					$this->capability,
					$this->slug,
					array( $this, 'load_template_general' ),
					DSC_ASSETS . 'images/icon-xs.png',
					79
				);

				add_submenu_page(
					$this->slug,
					'General',
					'General',
					$this->capability,
					$this->slug,
					array( $this, 'load_template_general' )
				);
			}
		});
	}

	/**
	 * Handle plugin activation.
	 *
	 * @access public
	 *
	 * @uses definition DSC_VERSION The DS Core version.
	 */
	public function activate() {
		update_option( 'dsc-version', DSC_VERSION );
	}

	/**
	 * Handle plugin deactivation.
	 *
	 * @access public
	 */
	public function deactivate() {

	}

	/**
	 * Update Database settings if versions differ.
	 *
	 * @access public
	 * @uses definition DSC_VERSION The DS Core version.
	 */
	public function update_settings() {
		if( version_compare( get_option( 'dsc-version' ), DSC_VERSION, '<' ) )
			$this->activate();
	}

	/**
	 * Register/Enqueue DS Core assets.
	 *
	 * @access public
	 * @uses   definition DSC_ASSETS  The DS Core assets folder path.
	 * @uses   definition DSC_VERSION The DS Core version.
	 */
	public function load_assets() {
		wp_enqueue_style (  'dsc-style',  DSC_ASSETS . 'css/style.css', array(), DSC_VERSION );
		wp_enqueue_script ( 'dsc-script', DSC_ASSETS . 'js/script.js',	array(), DSC_VERSION );
	}

	/**
	 * Register/Enqueue DS Core assets.
	 *
	 * @access public
	 * @param array  $links Array of plugin links.
	 * @return array $links An updated array of plugin links.
	 */
	public function register_plugin_action_links( $links ) {
		$settings_link = '<a href="' . esc_url( admin_url( '/admin.php' ) ) . '?page=' . $this->slug . '">' . __( 'Settings', 'ds-core' ) . '</a>';
		array_push( $links, $settings_link );

		return $links;
	}

	/**
	 * Render the general page.
	 *
	 * @access public
	 * @uses   definition DSC_ROOT The DS Core root folder path.
	 */
	public function load_template_general() {
		load_template( DSC_ROOT . 'admin/templates/general.php' );
	}
}

/*
 █████   ██████ ████████ ██ ██    ██  █████  ████████ ███████     ██ ██████  ███████  █████   ██████ ████████ ██ ██    ██  █████  ████████ ███████
██   ██ ██         ██    ██ ██    ██ ██   ██    ██    ██         ██  ██   ██ ██      ██   ██ ██         ██    ██ ██    ██ ██   ██    ██    ██
███████ ██         ██    ██ ██    ██ ███████    ██    █████     ██   ██   ██ █████   ███████ ██         ██    ██ ██    ██ ███████    ██    █████
██   ██ ██         ██    ██  ██  ██  ██   ██    ██    ██       ██    ██   ██ ██      ██   ██ ██         ██    ██  ██  ██  ██   ██    ██    ██
██   ██  ██████    ██    ██   ████   ██   ██    ██    ███████ ██     ██████  ███████ ██   ██  ██████    ██    ██   ████   ██   ██    ██    ███████
*/
/**
 * Register the plugin activation hook.
 */
register_activation_hook( __FILE__, array( $ds_core_admin, 'activate' ) );

/**
 * Register the plugin deactivation hook.
 */
register_deactivation_hook( __FILE__, array( $ds_core_admin, 'deactivate' ) );

/**
 * Update plugin settings.
 */
add_action( 'plugins_loaded', array( $ds_core_admin, 'update_settings' ) );
