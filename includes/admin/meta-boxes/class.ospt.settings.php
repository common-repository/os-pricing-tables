<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for slider type
 *
 * @class 		osptMetaboxSettings
 * @version		1.2
 * @category    Class
 * @author 		Offshorent Softwares Pvt. Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'osptMetaboxSettings' ) ) :

    class osptMetaboxSettings { 

        /**
         * Constructor
         */

        public function __construct() { 

            add_action( 'add_meta_boxes_ospt-pricing-table', array( &$this, 'ospt_settings_meta_box' ), 10, 1 );
        }		

        /**
         * callback function for ospt_auto_meta_boxe.
         */

        public function ospt_settings_meta_box() {
            add_meta_box( 	
                            'display_ospt_settings_meta_box',
                            'Settings',
                            array( &$this, 'display_ospt_settings_meta_box' ),
                            'ospt-pricing-table',
                            'side', 
                            'low'
                        );
        }

        /**
         * display function for display_ospt_auto_meta_box.
         */

        public function display_ospt_settings_meta_box() {

            $post_id = get_the_ID();					

            wp_nonce_field( 'ospt', 'ospt' );
            include_once( 'views/ospt.settings.php' );
        }
    }
endif;

/**
 * Returns the main instance of osptMetaboxSettings to prevent the need to use globals.
 *
 * @since  2.3
 * @return osptMetaboxSettings
 */
 
return new osptMetaboxSettings();
?>