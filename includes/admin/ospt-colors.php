<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for slider type
 *
 * @class 		osptColors
 * @version		1.2
 * @category    Class
 * @author 		Jinesh.P.V, Team Leader Offshorent Softwares Pvt Ltd.
 */
 
if ( ! class_exists( 'osptColors' ) ) :

    class osptColors {
		
		var $color = NULL;   // RGB in hex
		var $opacity = NULL;   // RGB in hex
		var $rx;             // red in hex
		var $gx;             // green in hex
		var $bx;             // blue in hex
		var $tint;           // RGB tint in hex
		var $shade;          // RGB shade in hex
		var $tone;           // RGB tone in hex
	   
		/**
		* Constructor
		*/

        public function __construct( $color = '#FFFFFF', $opacity = 2 ) {
			
			$color = str_replace( '#', '', $color );
			$this->setColor( $color );
			$this->setTint();
			$this->setShade( $opacity );
			$this->setTone();
		}
	   
	   /**
		* setColor
		*/
		
		public function setColor( $color ) {
		   
			if( !preg_match( '/^[0-9a-f]{6,6}$/i', $color ) ) {
				user_error( "Colors::setColor(): invalid color '$color'", E_USER_WARNING );
				
				return false;
			}
			$this->color = $color;
			list( $this->rx, $this->gx, $this->bx ) = explode( ',', chunk_split( $color, 2, ',' ) );
			
			return false;
		}
		
	   /**
		* setTint
		*/
		
		public function setTint() {
			
			$this->tint = sprintf( '%02X%02X%02X', ( hexdec( $this->rx ) + 255) / 2, ( hexdec( $this->gx ) + 255 ) / 2, ( hexdec( $this->bx ) + 255 ) / 2 );
		}
		
	   /**
		* setShade
		*/
		
		function setShade( $opacity ) {
			
			$this->shade = sprintf( '%02X%02X%02X', hexdec( $this->rx ) / $opacity, hexdec( $this->gx ) / $opacity, hexdec( $this->bx ) / $opacity );
		}
		
	   /**
		* setTone
		*/
		
		function setTone() {
		
			$this->tone = sprintf( '%02X%02X%02X', ( hexdec( $this->rx ) + 127 ) / 2, ( hexdec( $this->gx ) + 127 ) / 2, ( hexdec( $this->bx ) + 127) / 2 );
		}
		
	    /**
		* hex2dec
		*/
		
		function hex2dec( $color ) {
			
			if( preg_match( '/^[0-9a-f]{6,6}$/i', $color ) ) {
				
				list( $r, $g, $b ) = explode(',', chunk_split($color,2,','));
				
				return sprintf( "%d,%d,%d", hexdec( $r ), hexdec( $g ), hexdec( $b ) );
			}
			user_error( "Colors::hex2dec(): Invalid color '$color'", E_USER_WARNING );
			
			return false;
		}
	   
	   /**
		* hex2pct
		*/
		
		function hex2pct( $color ) {
			
			if( preg_match( '/^[0-9a-f]{6,6}$/i', $color ) ) {
				
				list( $r, $g ,$b ) = explode( ',', chunk_split( $color,2, ',' ) );
				
				return sprintf( "%d%%,%d%%,%d%%", round( hexdec( $r )/2.55 ), round( hexdec( $g )/2.55 ), round( hexdec( $b )/2.55 ) );
			}
			user_error( "Colors::hex2dec(): Invalid color '$color'", E_USER_WARNING );
			
			return false;
		}
	}
endif;

/**
 * Returns the main instance of osptColors to prevent the need to use globals.
 *
 * @since  2.3
 * @return osptColors
 */
 
return new osptColors();
?>