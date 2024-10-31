<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for slider type
 *
 * @class 		osptCurrencies
 * @version		1.2
 * @category    Class
 * @author 		Offshorent Softwares Pvt. Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'osptCurrencies' ) ) :

    class osptCurrencies { 

        /**
         * Constructor
         */

        public function __construct() { 
        }		

        /**
         * get all currencies lists
         */

        public function ospt_currencies() {
            
			return array(
							'AED' => 'United Arab Emirates Dirham',
							'ARS' => 'Argentine Peso',
							'AUD' => 'Australian Dollars',
							'BDT' => 'Bangladeshi Taka',
							'BRL' => 'Brazilian Real',
							'BGN' => 'Bulgarian Lev',
							'CAD' => 'Canadian Dollars',
							'CLP' => 'Chilean Peso',
							'CNY' => 'Chinese Yuan',
							'COP' => 'Colombian Peso',
							'CZK' => 'Czech Koruna',
							'DKK' => 'Danish Krone',
							'DOP' => 'Dominican Peso',
							'EUR' => 'Euros',
							'HKD' => 'Hong Kong Dollar',
							'HRK' => 'Croatia kuna',
							'HUF' => 'Hungarian Forint',
							'ISK' => 'Icelandic krona',
							'IDR' => 'Indonesia Rupiah',
							'INR' => 'Indian Rupee',
							'NPR' => 'Nepali Rupee',
							'ILS' => 'Israeli Shekel',
							'JPY' => 'Japanese Yen',
							'KIP' => 'Lao Kip',
							'KRW' => 'South Korean Won',
							'MYR' => 'Malaysian Ringgits',
							'MXN' => 'Mexican Peso',
							'NGN' => 'Nigerian Naira',
							'NOK' => 'Norwegian Krone',
							'NZD' => 'New Zealand Dollar',
							'PYG' => 'Paraguayan Guaraní',
							'PHP' => 'Philippine Pesos',
							'PLN' => 'Polish Zloty',
							'GBP' => 'Pounds Sterling',
							'RON' => 'Romanian Leu',
							'RUB' => 'Russian Ruble',
							'SGD' => 'Singapore Dollar',
							'ZAR' => 'South African rand',
							'SEK' => 'Swedish Krona',
							'CHF' => 'Swiss Franc',
							'TWD' => 'Taiwan New Dollars',
							'THB' => 'Thai Baht',
							'TRY' => 'Turkish Lira',
							'UAH' => 'Ukrainian Hryvnia',
							'USD' => 'US Dollars',
							'VND' => 'Vietnamese Dong',
							'EGP' => 'Egyptian Pound'
						);
        }
		
		/**
         * get currency sysmbols
         */

        public function ospt_get_currency_symbol( $currency ) {
			
			switch ( $currency ) {
				case 'AED' :
					$currency_symbol = 'د.إ';
					break;
				case 'AUD' :
				case 'ARS' :
				case 'CAD' :
				case 'CLP' :
				case 'COP' :
				case 'HKD' :
				case 'MXN' :
				case 'NZD' :
				case 'SGD' :
				case 'USD' :
					$currency_symbol = '&#36;';
					break;
				case 'BDT':
					$currency_symbol = '&#2547;&nbsp;';
					break;
				case 'BGN' :
					$currency_symbol = '&#1083;&#1074;.';
					break;
				case 'BRL' :
					$currency_symbol = '&#82;&#36;';
					break;
				case 'CHF' :
					$currency_symbol = '&#67;&#72;&#70;';
					break;
				case 'CNY' :
				case 'JPY' :
				case 'RMB' :
					$currency_symbol = '&yen;';
					break;
				case 'CZK' :
					$currency_symbol = '&#75;&#269;';
					break;
				case 'DKK' :
					$currency_symbol = 'DKK';
					break;
				case 'DOP' :
					$currency_symbol = 'RD&#36;';
					break;
				case 'EGP' :
					$currency_symbol = 'EGP';
					break;
				case 'EUR' :
					$currency_symbol = '&euro;';
					break;
				case 'GBP' :
					$currency_symbol = '&pound;';
					break;
				case 'HRK' :
					$currency_symbol = 'Kn';
					break;
				case 'HUF' :
					$currency_symbol = '&#70;&#116;';
					break;
				case 'IDR' :
					$currency_symbol = 'Rp';
					break;
				case 'ILS' :
					$currency_symbol = '&#8362;';
					break;
				case 'INR' :
					$currency_symbol = 'Rs.';
					break;
				case 'ISK' :
					$currency_symbol = 'Kr.';
					break;
				case 'KIP' :
					$currency_symbol = '&#8365;';
					break;
				case 'KRW' :
					$currency_symbol = '&#8361;';
					break;
				case 'MYR' :
					$currency_symbol = '&#82;&#77;';
					break;
				case 'NGN' :
					$currency_symbol = '&#8358;';
					break;
				case 'NOK' :
					$currency_symbol = '&#107;&#114;';
					break;
				case 'NPR' :
					$currency_symbol = 'Rs.';
					break;
				case 'PHP' :
					$currency_symbol = '&#8369;';
					break;
				case 'PLN' :
					$currency_symbol = '&#122;&#322;';
					break;
				case 'PYG' :
					$currency_symbol = '&#8370;';
					break;
				case 'RON' :
					$currency_symbol = 'lei';
					break;
				case 'RUB' :
					$currency_symbol = '&#1088;&#1091;&#1073;.';
					break;
				case 'SEK' :
					$currency_symbol = '&#107;&#114;';
					break;
				case 'THB' :
					$currency_symbol = '&#3647;';
					break;
				case 'TRY' :
					$currency_symbol = '&#8378;';
					break;
				case 'TWD' :
					$currency_symbol = '&#78;&#84;&#36;';
					break;
				case 'UAH' :
					$currency_symbol = '&#8372;';
					break;
				case 'VND' :
					$currency_symbol = '&#8363;';
					break;
				case 'ZAR' :
					$currency_symbol = '&#82;';
					break;
				default :
					$currency_symbol = '';
					break;
			}
			
			return $currency_symbol;
    	}
	}
endif;

/**
 * Returns the main instance of osptCurrencies to prevent the need to use globals.
 *
 * @since  1.2
 * @return osptCurrencies
 */
 
return new osptCurrencies();
?>