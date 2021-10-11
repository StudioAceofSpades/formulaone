<?php
/**
 * Class that handles utility functionality.
 *
 * @link    https://wpmudev.com
 * @since   4.11.4
 * @author  Joel James <joel@incsub.com>
 * @package WPMUDEV_Dashboard_Utils
 */

// If this file is called directly, abort.
defined( 'WPINC' ) || die;

/**
 * Class WPMUDEV_Dashboard_Utils
 */
class WPMUDEV_Dashboard_Utils {

	/**
	 * Holds update check data for cache.
	 *
	 * @since 4.11.4
	 * @var null|array
	 */
	private $updates_cache = array();

	/**
	 * WPMUDEV_Dashboard_Utils constructor.
	 *
	 * @since 4.11.4
	 */
	public function __construct() {
		// Load Dash plugin first whenever possible.
		add_filter( 'pre_update_option_active_plugins', array( $this, 'set_plugin_priority' ), 9999 );
		add_filter( 'pre_update_site_option_active_sitewide_plugins', array( $this, 'set_plugin_priority' ), 9999 );
	}

	/**
	 * Set Dash plugin to load first by updating its position.
	 *
	 * This is the safest method than creating a MU plugin to get
	 * priority in plugin initialization order. Some plugins may change
	 * it, but that's okay.
	 *
	 * @param array $plugins Plugin list.
	 *
	 * @since 4.11.4
	 * @return array
	 */
	public function set_plugin_priority( $plugins ) {
		// Move to top.
		if ( isset( $plugins[ WPMUDEV_Dashboard::$basename ] ) ) {
			// Remove dash plugin.
			unset( $plugins[ WPMUDEV_Dashboard::$basename ] );

			// Set to first.
			return array_merge(
				array( WPMUDEV_Dashboard::$basename => time() ),
				$plugins
			);
		}

		return $plugins;
	}

	/**
	 * Simulate current environment as WP Admin environment.
	 *
	 * DO NOT call this for regular requests. This is required
	 * only for hub-sync and update actions.
	 * Many premium plugins and themes initialize their update
	 * checks only on wp admin side. So we need to simulate the
	 * admin side to make the hooks feels like they are on admin
	 * side of WP.
	 *
	 * @since 4.11.4
	 *
	 * @return void
	 */
	public function simulate_admin() {
		// Simulate the current page global.
		$GLOBALS['pagenow'] = 'update-core.php'; // phpcs:ignore

		// Simulate PHP's request headers.
		$_SERVER['PHP_SELF'] = '/wp-admin/update-core.php';
		if ( defined( 'FORCE_SSL_ADMIN' ) && FORCE_SSL_ADMIN ) {
			$_SERVER['HTTPS']       = 'on';
			$_SERVER['SERVER_PORT'] = '443';
		}

		// Define constants to simulate admin checks.
		if ( ! defined( 'WP_ADMIN' ) ) {
			define( 'WP_ADMIN', true );
		}
		if ( ! defined( 'WP_NETWORK_ADMIN' ) ) {
			// For multisite, do it as network admin.
			is_multisite() ? define( 'WP_NETWORK_ADMIN', true ) : define( 'WP_NETWORK_ADMIN', false );
		}
		if ( ! defined( 'WP_USER_ADMIN' ) ) {
			define( 'WP_USER_ADMIN', false );
		}
		if ( ! defined( 'WP_BLOG_ADMIN' ) ) {
			define( 'WP_BLOG_ADMIN', true );
		}

		// Simulate actions required for updates.
		// Do not change the priority.
		add_action( 'wp_loaded', array( $this, 'simulate_admin_actions' ), 9998 );

		// Don't make any redirects now.
		add_filter( 'wp_redirect', '__return_false' );

		// Stop cron actions.
		remove_action( 'init', 'wp_cron' );
	}

	/**
	 * Run admin loaded actions for updates.
	 *
	 * Make sure the required admin hooks are executed to get
	 * the updates' info for plugins and themes.
	 *
	 * @since 4.11.4
	 * @return void
	 */
	public function simulate_admin_actions() {
		// Reuse update check https response to avoid multiple http requests.
		add_filter( 'http_response', array( $this, 'http_response_handler' ), 999, 3 );
		add_filter( 'pre_http_request', array( $this, 'pre_http_response_handler' ), 999, 3 );

		require_once ABSPATH . 'wp-admin/includes/admin.php';

		// Simulate admin int hook.
		if ( ! did_action( 'admin_init' ) ) {
			do_action( 'admin_init' );
		}

		// Set the current hook as load-update-core.php to run update check.
		global $wp_current_filter;
		$wp_current_filter[] = 'load-update-core.php'; // phpcs:ignore

		// Clear updates cache.
		if ( function_exists( 'wp_clean_update_cache' ) ) {
			wp_clean_update_cache();
		}

		// Run update checks.
		wp_update_plugins();
		wp_update_themes();

		// Remove current filter.
		array_pop( $wp_current_filter );

		// Set current screen as update core page.
		set_current_screen( 'load-update-core.php' );

		// Simulate update core action hook.
		do_action( 'load-update-core.php' ); // phpcs:ignore
	}

	/**
	 * Store the updates check HTTP response in cache.
	 *
	 * We may make multiple http requests to get plugin and themes
	 * updates check. Store them in so that we can reuse them instead
	 * of making multiple requests.
	 *
	 * @param mixed  $response HTTP response.
	 * @param array  $args     HTTP request arguments.
	 * @param string $url      The request URL.
	 *
	 * @since 4.11.4
	 * @return mixed
	 */
	public function http_response_handler( $response, $args, $url ) {
		// Only themes and plugins checks.
		$urls = array(
			'https://api.wordpress.org/plugins/update-check/1.1/',
			'https://api.wordpress.org/themes/update-check/1.1/',
		);

		// If required, save data for updates check.
		if ( in_array( $url, $urls, true ) ) {
			$this->updates_cache[ $url ] = array(
				'body'     => $args['body'],
				'response' => $response,
			);
		}

		return $response;
	}

	/**
	 * Return the update check http response from cache.
	 *
	 * If there are duplicate http requests for update check, see if we can
	 * return response from cache instead of another http request.
	 *
	 * @param mixed  $response A preemptive return value of an HTTP request. Default false.
	 * @param array  $args     HTTP request arguments.
	 * @param string $url      The request URL.
	 *
	 * @since 4.11.4
	 * @return mixed
	 */
	public function pre_http_response_handler( $response, $args, $url ) {
		// If the url the same request is found in cache.
		if ( isset( $this->updates_cache[ $url ]['body'], $this->updates_cache[ $url ]['response'] ) ) {
			if ( $this->updates_cache[ $url ]['body'] === $args['body'] ) {
				$response = $this->updates_cache[ $url ]['response'];
			}
		}

		return $response;
	}

	/**
	 * Retrieve cron hooks ready to be run.
	 *
	 * Returns the results of _get_cron_array() limited to hooks ready to be run,
	 * ie, with a timestamp in the past.
	 *
	 * @since 4.11.4
	 * @uses  _get_cron_array
	 *
	 * @return array Cron jobs ready to be run.
	 */
	public function get_ready_cron_hooks() {
		// Make sure the required function exists.
		if ( ! function_exists( '_get_cron_array' ) ) {
			return array();
		}

		// Get cron events.
		$crons = _get_cron_array();

		// No need to continue if no events found.
		if ( empty( $crons ) ) {
			return array();
		}

		// Current time.
		$gmt_time = microtime( true );

		$cron_hooks = array();

		foreach ( $crons as $timestamp => $hooks ) {
			// Exclude future events.
			if ( empty( $hooks ) || $timestamp > $gmt_time ) {
				break;
			}

			// Get the hook names only.
			$cron_hooks = array_merge( $cron_hooks, array_keys( $hooks ) );
		}

		return $cron_hooks;
	}
}