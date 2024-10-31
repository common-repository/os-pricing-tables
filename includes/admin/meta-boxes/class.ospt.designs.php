<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for slider type
 *
 * @class 		osptMetaboxTypes
 * @version		1.2
 * @category    Class
 * @author 		Offshorent Softwares Pvt. Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'osptMetaboxTypes' ) ) :

    class osptMetaboxTypes { 

        /**
         * Constructor
         */

        public function __construct() { 

            add_action( 'add_meta_boxes_ospt-pricing-table', array( &$this, 'ospt_type_meta_box' ), 10, 1 );
        }		

        /**
         * callback function for ospt_type_meta_boxe.
         */

        public function ospt_type_meta_box() {
            add_meta_box( 	
                            'display_ospt_type_meta_box',
                            'Designs',
                            array( &$this, 'display_ospt_type_meta_box' ),
                            'ospt-pricing-table',
                            'normal', 
                            'high'
                        );
        }

        /**
         * display function for display_ospt_type_meta_box.
         */

        public function display_ospt_type_meta_box() {

            $post_id = get_the_ID();					

            wp_nonce_field( 'ospt-pricing-table', 'ospt-pricing-table' );
            include_once( 'views/ospt.designs.php' );
        }
    }
endif;

/**
 * Returns the main instance of osptMetaboxTypes to prevent the need to use globals.
 *
 * @since  1.2
 * @return osptMetaboxTypes
 */
 
return new osptMetaboxTypes();
?>