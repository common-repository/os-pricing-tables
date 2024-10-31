<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Registers post types and taxonomies
 *
 * @class       osptPostTypes
 * @version     1.2
 * @category    Class
 * @author      Offshorent Softwares Pvt. Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'osptPostTypes' ) ) :
    
    class osptPostTypes { 
        
        /**
         * Constructor
         */

        public function __construct() { 

            add_action( 'init', array( &$this, 'register_ospt_post_types' ) );
            add_filter( 'manage_edit-ospt-pricing-table_columns', array( &$this, 'ospt_edit_columns' ), 10, 2 );
            add_action( 'manage_ospt-pricing-table_posts_custom_column', array( &$this, 'ospt_custom_column' ), 10, 2 );
            add_action( 'save_post', array( &$this, 'ospt_save_slider_values' ) );
        }

        /**
         * Register ospt post types.
         */

        public static function register_ospt_post_types() {
            
            self::ospt_includes();

            if ( post_type_exists( 'ospt-pricing-table' ) )
                return;

            $label              =   'Pricing Table';
            $labels = array(
                'name'                  =>  _x( $label, 'post type general name' ),
                'singular_name'        =>   _x( $label, 'post type singular name' ),
                'add_new'               =>  _x( 'Add New', OSPT_TEXT_DOMAIN ),
                'add_new_item'          =>  __( 'Add New Pricing Table', OSPT_TEXT_DOMAIN ),
                'edit_item'             =>  __( 'Edit Pricing Table', OSPT_TEXT_DOMAIN),
                'new_item'              =>  __( 'New Pricing Table' , OSPT_TEXT_DOMAIN ),
                'view_item'             =>  __( 'View Pricing Table', OSPT_TEXT_DOMAIN ),
                'search_items'          =>  __( 'Search ' . $label ),
                'not_found'             =>  __( 'Nothing found' ),
                'not_found_in_trash'    =>  __( 'Nothing found in Trash' ),
                'parent_item_colon'     =>  ''
            );

            register_post_type( 'ospt-pricing-table', 
                apply_filters( 'ospt_register_post_types',
                    array(
                            'labels'                 => $labels,
                            'public'                 => true,
                            'publicly_queryable'     => true,
                            'show_ui'                => true,
                            'exclude_from_search'    => true,
                            'query_var'              => true,
                            'has_archive'            => false,
                            'hierarchical'           => true,
                            'menu_position'          => 20,
                            'show_in_nav_menus'      => true,
                            'supports'               => array( 'title' ),
							'menu_icon'				 => 'dashicons-clipboard'
                        )
                )
            );                              
        }
        
        /**
         * Includes the metabox classes and views
         */
        
        public static function ospt_includes() {
            
            include_once( 'meta-boxes/class.ospt.packages.php' );
            include_once( 'meta-boxes/class.ospt.designs.php' );
            include_once( 'meta-boxes/class.ospt.general.php' );
            include_once( 'meta-boxes/class.ospt.shortcode.php' );
            include_once( 'meta-boxes/class.ospt.countries.php' );
            include_once( 'meta-boxes/class.ospt.currencies.php' );
            include_once( 'meta-boxes/class.ospt.settings.php' );
        }
        
        /**
         * ospt slider edit columns.
         */

        public function ospt_edit_columns() {

            $columns = array(
                'cb'                          =>    '<input type="checkbox" />',
                'title'                       =>    'Title',
                'ospt-shortcode'        	  =>    'Shortcode',
                'ospt-design'           	  =>    'Design',
                'ospt-currency'           	  =>    'Currency',
                'date'                        =>    'Date'
            );

            return $columns;
        }

        /**
         * display ospt slider custom columns.
         */

        public function ospt_custom_column( $column, $post_id ) {
			
			$cny = new osptCurrencies();
            $ospt_custom_meta = self::ospt_return_slider_custom_meta( $post_id );
            $design = isset( $ospt_custom_meta['design'] ) ? $ospt_custom_meta['design'] : '';
            $currency = isset( $ospt_custom_meta['general']['currency'] ) ? $ospt_custom_meta['general']['currency'] : '';

            switch ( $column ) {
                case 'ospt-shortcode':
                    if ( !empty( $design ) )
                        echo self::ospt_shortcode_creator( $post_id, $design );
                    break;
                case 'ospt-design':
                    echo $design;
                    break;
                case 'ospt-currency':
                    echo $cny->ospt_get_currency_symbol( $currency );
                    break;
            }
        }
        
        /**
        * storing meta fields function for ospt_save_slider_values.
        */

        public function ospt_save_slider_values( $post_id ) {

            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
                return;

            if ( ! empty( $_POST['post_type'] ) && 'ospt-pricing-table' == $_POST['post_type'] ) {
                if ( ! current_user_can( 'edit_page', $post_id ) )
                    return;
            } else {
                if ( ! current_user_can( 'edit_post', $post_id ) )
                return;
            }

            if ( ! empty( $_POST['ospt'] ) ) {           
                update_post_meta( $post_id, 'ospt_custom_meta', $_POST['ospt'] );
            }
        }
       
       /**
        * return slider custom meta values.
        */

        public function ospt_return_slider_custom_meta( $post_id ) {

            return $ospt = get_post_meta( $post_id, 'ospt_custom_meta', true );
        }
		
       /**
        * return slider custom meta values.
        */

        public function ospt_get_the_value( $post_id, $type, $field, $default ) {

            $ospt = get_post_meta( $post_id, 'ospt_custom_meta', true );
			$ospt_values = $ospt[$type];
			
			return $return = !empty( $ospt_values[$field] ) ? $ospt_values[$field] : $default;
        }

       /**
        * ospt shortcode creation
        */

        public function ospt_shortcode_creator( $post_id, $design ) {
			
            $shortcode = '[ospt-pricing-table id="' . $post_id . '" design="' . $design . '"]';
			
            return '<input type="text" readonly="readonly" id="shortcode_' . $post_id . '" class="shortcode" value="' . esc_attr( $shortcode ) . 
            '">';
        }
    }
endif;

/**
 * Returns the main instance of osptPostTypes to prevent the need to use globals.
 *
 * @since  1.2
 * @return osptPostTypes
 */
 
return new osptPostTypes();
?>