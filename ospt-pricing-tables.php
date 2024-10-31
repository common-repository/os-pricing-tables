<?php
/*
Plugin Name: OS Pricing Tables
Plugin URI: http://offshorent.com/blog/extensions/os-pricing-tables
Description: Create a Beautiful, Responsive and Highly Converting Pricing or Comparison Table in WordPress using OS Pricing Tables.
Version: 1.2
Author: Offshorent Softwares Pvt. Ltd. | Jinesh.P.V
Author URI: http://offshorent.com/
License: GPL2
/*  Copyright 2015-2016  OS Pricing Tables - Offshorent Softwares Pvt Ltd  ( email: jinesh@offshorent.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'osPricingTables' ) ) :
    
    /**
    * Main osPricingTables Class
    *
    * @class osPricingTables
    * @version	1.2
    */

	    final class osPricingTables {
	    
		/**
		* @var string
		* @since	1.2
		*/
		 
		public $version = '1.2';
		
		/**
		* @var osPricingTables The single instance of the class
		* @since 1.2
		*/
		
		protected static $_instance = null;

		/**
		* Main osPricingTables Instance
		*
		* Ensures only one instance of osPricingTables is loaded or can be loaded.
		*
		* @since 1.2
		* @static
		* @see OSBX()
		* @return osPricingTables - Main instance
		*/
		 
		public static function init_instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
		}

		/**
		* Cloning is forbidden.
		*
		* @since 1.2
		*/

		public function __clone() {
            _doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '1.2' );
		}

		/**
		* Unserializing instances of this class is forbidden.
		*
		* @since 1.2
		*/
		 
		public function __wakeup() {
            _doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '1.2' );
		}
	        
		/**
		* Get the plugin url.
		*
		* @since 1.2
		*/

		public function plugin_url() {
            return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		* Get the plugin path.
		*
		* @since 1.2
		*/

		public function plugin_path() {
            return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

		/**
		* Get Ajax URL.
		*
		* @since 1.2
		*/

		public function ajax_url() {
            return admin_url( 'admin-ajax.php', 'relative' );
		}
	        
		/**
		* osPricingTables Constructor.
		* @access public
		* @return osPricingTables
		* @since 1.2
		*/
		 
		public function __construct() {
			
            register_activation_hook( __FILE__, array( &$this, 'ospt_install' ) );
			
            // Define constants
            self::ospt_constants();

            // Include required files
            self::ospt_admin_includes();

            // Action Hooks
            add_action( 'init', array( $this, 'ospt_init' ), 0 );
            add_action( 'admin_init', array( $this, 'ospt_admin_init' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'ospt_frontend_styles_scrips' ) );

            // Shortcode Hooks
            add_shortcode( 'ospt-pricing-table', array( $this, 'ospt_shortcode' ) );
		}
	        
		/**
		* Install osPricingTables
		* @since 1.2
		*/
		 
		public function ospt_install (){
			
            // Flush rules after install
            flush_rewrite_rules();

            // Redirect to welcome screen
            set_transient( '_ospt_activation_redirect', 1, 60 * 60 );
		}
	        
		/**
		* Define osPricingTables Constants
		* @since 1.2
		*/
		 
		private function ospt_constants() {
			
			define( 'OSPT_PLUGIN_FILE', __FILE__ );
			define( 'OSPT_PLUGIN_BASENAME', plugin_basename( dirname( __FILE__ ) ) );
			define( 'OSPT_PLUGIN_URL', plugins_url() . '/' . OSPT_PLUGIN_BASENAME );
			define( 'OSPT_VERSION', $this->version );
			define( 'OSPT_TEXT_DOMAIN', 'os-pricing-table' );		
		}
	        
		/**
		* includes admin defaults files
		*
		* @since 1.2
		*/
		 
		private function ospt_admin_includes() {
			
            include_once( 'includes/admin/ospt-about.php' );	            
            include_once( 'includes/admin/ospt-post-types.php' );
	        include_once( 'includes/ospt-colors.php' );
	        include_once( 'includes/ospt-process-payment.php' );
		}
	        
		/**
		* Init osPricingTables when WordPress Initialises.
		* @since 1.2
		*/
		 
		public function ospt_init() {
	            
            self::ospt_do_output_buffer();
		}
	        
		/**
		* Clean all output buffers
		*
		* @since  1.2
		*/
		 
		public function ospt_do_output_buffer() {
	            
            ob_start( array( &$this, "ospt_do_output_buffer_callback" ) );
		}

		/**
		* Callback function
		*
		* @since  1.2
		*/
		 
		public function ospt_do_output_buffer_callback( $buffer ){
            return $buffer;
		}
		
		/**
		* Clean all output buffers
		*
		* @since  1.2
		*/
		 
		public function ospt_flush_ob_end(){
            ob_end_flush();
		}
	        
		/**
		* Admin init osPricingTables when WordPress Initialises.
		* @since  1.2
		*/
		 
		public function ospt_admin_init() {
				
            self::ospt_admin_styles_scrips();
		}
	        
		/**
		* Admin side style and javascript hook for osPricingTables
		*
		* @since  1.2
		*/
		 
		public function ospt_admin_styles_scrips() {
			
			// Add the color picker css file       
        	wp_enqueue_style( 'wp-color-picker' );            
			wp_enqueue_style( 'ospt-admin-style', plugins_url( 'css/admin/style-min.css', __FILE__ ) );
			wp_enqueue_script( 'ospt-custom-min', plugins_url( 'js/admin/custom-min.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker' ), '1.2', true );
		}

		/**
		* Frontend style and javascript hook for osPricingTables
		*
		* @since  1.2
		*/
		 
		public function ospt_frontend_styles_scrips() {

			wp_enqueue_style( 'ospt-bootstrap', plugins_url( 'css/bootstrap.min.css', __FILE__ ) );
			wp_enqueue_style( 'ospt-colorbox', plugins_url( 'colorbox/colorbox.css', __FILE__ ) );
			wp_enqueue_style( 'ospt-style', plugins_url( 'css/style.min.css', __FILE__ ) );

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'ospt-bootstrap', plugins_url( 'js/bootstrap.min.js', __FILE__ ), array( 'jquery' ), '3.0.3', true );
			wp_enqueue_script( 'ospt-payment-min', plugins_url( 'js/jquery.payment.min.js', __FILE__ ), array( 'jquery' ), '1.24.0', true );
			wp_enqueue_script( 'ospt-validate-min', plugins_url( 'js/jquery.validate.min.js', __FILE__ ), array( 'jquery' ), '1.24.0', true );
			wp_enqueue_script( 'ospt-colorbox', plugins_url( 'colorbox/jquery.colorbox-min.js', __FILE__ ), array( 'jquery' ), '1.6.3', true );
			wp_enqueue_script( 'ospt-custom-min', plugins_url( 'js/custom-min.js', __FILE__ ), array( 'jquery' ), '1.2', true );
			wp_localize_script( 'ospt-custom-min', 'ospt_params', array(
																		'ajax_url' => self::ajax_url()
																		)
								);
		} 

		/**
		* Shortcode function for os-pricing-table
		*
		* @since  1.2
		*/
		 
		public function ospt_shortcode( $atts ) {

			ob_start();

			// Extract os-pricing-table shortcode

			$atts = shortcode_atts(
					array(
						'id' => '2',
						'design' => 'design-1'
					), $atts );
			$post_id = $atts['id'];
			$design = $atts['design'];
			
			if ( '' === locate_template( dirname( __FILE__ ) . '/includes/templates/ospt.' . $design . '.php', true, false ) )
				include( dirname( __FILE__ ) . '/includes/templates/ospt.' . $design . '.php' );

			return ob_get_clean();
		}			
	}   
endif;

/**
 * Returns the main instance of osPricingTables to prevent the need to use globals.
 *
 * @since  1.2
 * @return osPricingTables
 */
 
return new osPricingTables;