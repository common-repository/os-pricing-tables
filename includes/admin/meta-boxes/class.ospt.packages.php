<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for slides
 *
 * @class 		osptMetaboxPackages
 * @version		1.2
 * @category    Class
 * @author 		Offshorent Softwares Pvt. Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'osptMetaboxPackages' ) ) :

    class osptMetaboxPackages { 

        /**
         * Constructor
         */

        public function __construct() { 

            add_action( 'add_meta_boxes_ospt-pricing-table', array( &$this, 'ospt_package_meta_box' ), 10, 1 );
        }		

        /**
         * callback function for ospt_package_meta_boxe.
         */

        public function ospt_package_meta_box() {
            add_meta_box( 	
                            'display_ospt_package_meta_box',
                            'Packages',
                            array( &$this, 'display_ospt_package_meta_box' ),
                            'ospt-pricing-table',
                            'normal', 
                            'high'
                        );
        }

        /**
         * display function for display_ospt_package_meta_box.
         */

        public function display_ospt_package_meta_box() {

            $post_id = get_the_ID();					

            wp_nonce_field( 'ospt-pricing-table', 'ospt-pricing-table' );
            include_once( 'views/ospt.packages.php' );
        }
    }
endif;

/**
 * Returns the main instance of osptMetaboxPackages to prevent the need to use globals.
 *
 * @since  1.2
 * @return osptMetaboxPackages
 */
 
return new osptMetaboxPackages();
?>