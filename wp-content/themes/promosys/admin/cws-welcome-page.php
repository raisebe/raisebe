<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'promosys__welcome_page' ) ) {
	class promosys__welcome_page {
		
		/**
		 * Singleton class
		 */
		private static $instance;
		
		/**
		 * Get the instance of promosys__welcome_page
		 *
		 * @return self
		 */
		public static function getInstance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		/**
		 * Cloning disabled
		 */
		private function __clone() {
		}
		
		/**
		 * Serialization disabled
		 */
		public function __sleep() {
		}
		
		/**
		 * De-serialization disabled
		 */
		public function __wakeup() {
		}
		
		/**
		 * Constructor
		 */
		private function __construct() {
			
			// Theme activation hook
			add_action( 'after_switch_theme', array( $this, 'initActivationHook' ) );
			
			// Welcome page redirect on theme activation
			add_action( 'admin_init', array( $this, 'welcomePageRedirect' ) );
			
			// Add welcome page into theme options
			add_action( 'admin_menu', array( $this, 'addWelcomePage' ), 12 );
			
			//Enqueue theme welcome page scripts
			add_action( 'admin_init', array( $this, 'enqueueStyles' ) );
		}
		
		/**
		 * Init hooks on theme activation
		 */
		function initActivationHook() {
			
			if ( ! is_network_admin() ) {
				set_transient( '_promosys_welcome_page_redirect', 1, 30 );
			}
		}
		
		/**
		 * Redirect to welcome page on theme activation
		 */
		function welcomePageRedirect() {
			
			// If no activation redirect, bail
			if ( ! get_transient( '_promosys_welcome_page_redirect' ) ) {
				return;
			}
			
			// Delete the redirect transient
			delete_transient( '_promosys_welcome_page_redirect' );
			
			// If activating from network, or bulk, bail
			if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
				return;
			}
			
			// Redirect to welcome page
			wp_safe_redirect( add_query_arg( array( 'page' => 'promosys_welcome_page' ), esc_url( admin_url( 'themes.php' ) ) ) );
			exit;
		}
		
		/**
		 * Add welcome page
		 */
		function addWelcomePage() {
			
			add_theme_page(
				esc_html__( 'About', 'promosys' ),
				esc_html__( 'About', 'promosys' ),
				current_user_can( 'edit_theme_options' ),
				'promosys_welcome_page',
				array( $this, 'welcomePageContent' )
			);
			
			remove_submenu_page( 'themes.php', 'promosys_welcome_page' );
		}
		
		/**
		 * Print welcome page content
		 */
		function welcomePageContent() {
			$cws_theme              = wp_get_theme();
			$cws_theme_name         = esc_html( $cws_theme->get( 'Name' ) );
			$cws_theme_description  = esc_html( $cws_theme->get( 'Description' ) );
			$cws_theme_version      = $cws_theme->get( 'Version' );
			$cws_theme_screenshot   = file_exists( PROMOSYS__PATH . '/screenshot.png' ) ? PROMOSYS__URI . '/screenshot.png' : PROMOSYS__URI . '/screenshot.jpg';
			?>
			<div class="wrap about-wrap cws-welcome-page">
				<div class="cws-welcome-page-content">
					<h1 class="cws-welcome-page-title">
						<?php echo sprintf( esc_html__( 'Welcome to %s', 'promosys' ), $cws_theme_name ); ?>
						<small><?php echo esc_html( 'Version: ' . $cws_theme_version ) ?></small>
					</h1>
					<div class="about-text cws-welcome-page-text">
						<?php echo sprintf( esc_html__( 'Thank you for choosing %s - %s! We truly appreciate and really hope that you\'ll enjoy it!', 'promosys' ),
							$cws_theme_name,
							$cws_theme_description,
							$cws_theme_name
						); ?>
						<img src="<?php echo esc_url( $cws_theme_screenshot ); ?>" alt="<?php esc_attr_e( 'Theme Screenshot', 'promosys' ); ?>" />
						
						<h4><?php esc_html_e( 'Useful Links:', 'promosys' ); ?></h4>
						<ul class="cws-welcome-page-links">
							<li>
								<a href="<?php echo ('mailto: support@cwsthemes.com'); ?>"><?php esc_html_e( 'Support', 'promosys' ); ?></a>
							</li>
							<li>
								<a href="<?php echo esc_url('https://promotionssys.cwsthemes.com/manual/'); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'promosys' ); ?></a>
							</li>
							<li>
								<a href="<?php echo add_query_arg( array( 'page' => 'install-required-plugins&plugin_status=install' ), esc_url( admin_url( 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Install Required Plugins', 'promosys' ); ?></a>
							</li>
							<li>
								<a href="<?php echo esc_url('https://themeforest.net/user/creativews/portfolio/'); ?>" target="_blank"><?php esc_html_e( 'Browse All Themes', 'promosys' ); ?></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?php
		}
		
		/**
		 * Enqueue theme welcome page scripts
		 */
		function enqueueStyles() {
			wp_enqueue_style( 'cws-welcome-page-style', get_template_directory_uri() . '/admin/css/admin.css', array(), PROMOSYS__VERSION, 'all' );
		}
	}
}

promosys__welcome_page::getInstance();