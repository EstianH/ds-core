<?php
if( !defined( 'ABSPATH' ) ) exit;


/*
██████  ███████      ██████  ██████  ██████  ███████      █████  ██████  ███    ███ ██ ███    ██
██   ██ ██          ██      ██    ██ ██   ██ ██          ██   ██ ██   ██ ████  ████ ██ ████   ██
██   ██ ███████     ██      ██    ██ ██████  █████       ███████ ██   ██ ██ ████ ██ ██ ██ ██  ██
██   ██      ██     ██      ██    ██ ██   ██ ██          ██   ██ ██   ██ ██  ██  ██ ██ ██  ██ ██
██████  ███████      ██████  ██████  ██   ██ ███████     ██   ██ ██████  ██      ██ ██ ██   ████
*/
class DS_CORE_ADMIN {
	/**
	 * Class instance.
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
	 * Returns the instance of the class.
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
	 * Constructor.
	 *
	 * @access private
	 */
	private function __construct() {
		$this->capability = 'edit_plugins';
		$this->slug       = 'ds-core';

		// Register the admin setting pages.
		add_action( 'admin_menu', array( $this, 'render_admin_menu' ) );

		// Enqueue assets.
		add_action( 'admin_enqueue_scripts', function() {
			wp_enqueue_style (  'dsc-style',  DSC_ASSETS . 'css/style.css', array(), DSC_VERSION );
			wp_enqueue_script ( 'dsc-script', DSC_ASSETS . 'js/script.js',	array(), DSC_VERSION );
		} );

		// Filters
		add_filter( 'plugin_action_links_' . DSC_BASENAME, array( $this, 'register_plugin_action_links' ), 10, 1 ); // Add plugin list settings link.

		// Register settings.
		register_setting( 'dsc_settings', 'dsc_settings' );

		// Register notifications.
		add_action( 'admin_notices', array( $this, 'add_notices' ) );
	}

	/**
	 * Create/render the DS Core admin menu items.
	 *
	 * @access public
	 * @uses $GLOBALS
	 */
	public function render_admin_menu() {
		if( !isset( $GLOBALS['admin_page_hooks'][$this->slug] ) ) {
			add_menu_page(
				'divSpot',
				'divSpot',
				$this->capability,
				$this->slug,
				array( $this, 'load_template_settings_core' ),
				DSC_ASSETS . 'images/icon-xs.png',
				79
			);

			add_submenu_page(
				$this->slug,
				DSC_TITLE,
				DSC_TITLE,
				$this->capability,
				$this->slug,
				array( $this, 'load_template_settings_core' )
			);

			do_action( 'dsc_render_admin_menu_sub_items' );
		}
	}

	/**
	 * Handle plugin activation.
	 *
	 * @access public
	 */
	public function activate() {
		update_option( 'dsc_version', DSC_VERSION );
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
	 */
	public function update_settings() {
		if( version_compare( get_option( 'dsc_version' ), DSC_VERSION, '<' ) )
			$this->activate();
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
	 * Display admin notifications.
	 *
	 * @access public
	 */
	public function add_notices() {
		$screen = get_current_screen();

		if( $screen->id === 'toplevel_page_ds-core' ) {
			if( isset( $_GET['settings-updated'] ) ) { ?>
				<div class="notice notice-success is-dismissible mt-2 mr-0 mb-2 ml-0">
					<p><?php _e( 'Settings saved.', 'ds-core' ); ?></p>
				</div>
			<?php }
		}
	}

	/**
	 * Render the DS Core settings page.
	 *
	 * @access public
	 */
	public function load_template_settings_core() {
		load_template( DSC_ROOT . 'admin/templates/settings-core.php' );
	}
}

$ds_core_admin = DS_CORE_ADMIN::get_instance();


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
