<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for slider type
 *
 * @class 		osptMetaboxGeneral
 * @version		1.2
 * @category    Class
 * @author 		Offshorent Softwares Pvt. Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'osptMetaboxGeneral' ) ) :

    class osptMetaboxGeneral { 

        /**
         * Constructor
         */

        public function __construct() { 

            add_action( 'add_meta_boxes_ospt-pricing-table', array( &$this, 'ospt_general_meta_box' ), 10, 1 );            
        }		

        /**
         * callback function for ospt_general_meta_boxe.
         */

        public function ospt_general_meta_box() {
            add_meta_box( 	
                            'display_ospt_general_meta_box',
                            'General Settings',
                            array( &$this, 'display_ospt_general_meta_box' ),
                            'ospt-pricing-table',
                            'normal', 
                            'low'
                        );
        }

        /**
         * display function for display_ospt_general_meta_box.
         */

        public function display_ospt_general_meta_box() {

            $post_id = get_the_ID();					

            wp_nonce_field( 'ospt-pricing-table', 'ospt-pricing-table' );
            include_once( 'views/ospt.general.php' );
        }
    }
endif;

/**
 * Returns the main instance of osptMetaboxGeneral to prevent the need to use globals.
 *
 * @since  2.3
 * @return osptMetaboxGeneral
 */
 
return new osptMetaboxGeneral();
?>