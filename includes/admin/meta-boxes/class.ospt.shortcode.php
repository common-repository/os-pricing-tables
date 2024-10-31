<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for slider type
 *
 * @class 		osptMetaboxShortcode
 * @version		1.2
 * @category    Class
 * @author 		Offshorent Softwares Pvt. Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'osptMetaboxShortcode' ) ) :

    class osptMetaboxShortcode { 

        /**
         * Constructor
         */

        public function __construct() { 

            add_action( 'add_meta_boxes_ospt-pricing-table', array( &$this, 'ospt_shortcode_meta_box' ), 10, 1 );
        }		

        /**
         * callback function for ospt_auto_meta_boxe.
         */

        public function ospt_shortcode_meta_box() {
            add_meta_box( 	
                            'display_ospt_shortcode_meta_box',
                            'Shortcode',
                            array( &$this, 'display_ospt_shortcode_meta_box' ),
                            'ospt-pricing-table',
                            'side', 
                            'high'
                        );
        }

        /**
         * display function for display_ospt_auto_meta_box.
         */

        public function display_ospt_shortcode_meta_box() {

            $post_id = get_the_ID();					

            wp_nonce_field( 'ospt', 'ospt' );
            include_once( 'views/ospt.shortcode.php' );
        }
    }
endif;

/**
 * Returns the main instance of osptMetaboxShortcode to prevent the need to use globals.
 *
 * @since  2.3
 * @return osptMetaboxShortcode
 */
 
return new osptMetaboxShortcode();
?>