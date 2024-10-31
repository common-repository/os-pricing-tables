<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * Creating metabox for slider type
 *
 * @class 		osptPaymentProcess
 * @version		1.2
 * @category    Class
 * @author 		Offshorent Softwares Pvt. Ltd. | Jinesh.P.V
 */
 
if ( ! class_exists( 'osptPaymentProcess' ) ) :

    class osptPaymentProcess {
	   
		/**
		* Constructor
		*/

        public function __construct() {

            add_action( 'wp_ajax_ospt_process_payment', array( $this, 'ospt_process_payment' ) );
			add_action( 'wp_ajax_nopriv_ospt_process_payment', array( $this, 'ospt_process_payment' ) );
		}
	   
		/**
		* Ajax function for ospt_process_payment
		*
		* @since  1.2
		*/
		 
		public function ospt_process_payment () {

			$pt = new osptPostTypes();
			$data = isset( $_POST['data'] ) ? $_POST['data'] : ''; 
			parse_str( $data, $return_array );

			$post_id = $return_array['post_id'];
			$x_currency_code = $return_array['x_currency_code'];
			$x_invoice_num = $return_array['x_invoice_num'];
			$x_description = $return_array['x_description'];
			$x_amount = $return_array['x_amount'];
			$ospt_card_number = $return_array['ospt_card_number'];
			$ospt_card_expiry = $return_array['ospt_card_expiry'];
			$ospt_card_cvc = $return_array['ospt_card_cvc'];

			$credit_card = ( !empty( $ospt_card_number ) ) ? strip_tags( str_replace( "'", "`", strip_tags( $ospt_card_number ) ) ) : '';
			$x_card_num = preg_replace( '/(?<=\d)\s+(?=\d)/', '', trim( $credit_card ) );
			$ccexp_expiry = ( !empty( $ospt_card_expiry ) ) ? strip_tags( str_replace( "'", "`", strip_tags( $ospt_card_expiry ) ) ) : '';
			$x_exp_date = str_replace( ' / ', '', $ccexp_expiry );
			$x_card_code = ( !empty( $ospt_card_cvc ) ) ? strip_tags( str_replace( "'", "`", strip_tags( $ospt_card_cvc ) ) ) : '';

			if ( !$this->is_valid_credit_card( $x_card_num ) ) {
				echo 'Please enter a valid credit card number.';
				wp_die();
			}

			if ( !$this->is_valid_expire_date( $x_exp_date ) ) {
				echo 'Please enter a valid expiry date.';
				wp_die();
			}

			if ( !$this->is_empty_ccv_nmber( $x_card_code ) ) {
				echo 'Please enter a CCV Number.';
				wp_die();
			}

			$payment_method = $pt->ospt_get_the_value( $post_id, 'general', 'payment-method', '' );

			if( 'authorizenet-aim' == $payment_method ) {

				$sandbox = $pt->ospt_get_the_value( $post_id, 'general', 'authorize-sandbox', '' );
				$x_login = $pt->ospt_get_the_value( $post_id, 'general', 'login-id', '' );
				$x_tran_key = $pt->ospt_get_the_value( $post_id, 'general', 'transaction-key', '' );
				$success_message = $pt->ospt_get_the_value( $post_id, 'general', 'txn-success-message', '' );
				$failed_message = $pt->ospt_get_the_value( $post_id, 'general', 'txn-failed-message', '' );

				if( 1 == $sandbox )
					$process_url = 'https://test.authorize.net/gateway/transact.dll';
				else
					$process_url = 'https://secure.authorize.net/gateway/transact.dll';

				$authorizeaim_args = array(
											'x_login'                  => $x_login,
											'x_tran_key'               => $x_tran_key,
											'x_version'                => '3.1',
											'x_delim_data'             => 'TRUE',
											'x_delim_char'             => '|',
											'x_relay_response'         => 'FALSE',
											'x_type'                   => 'AUTH_CAPTURE',
											'x_method'                 => 'CC',
											'x_card_num'               => $x_card_num,
											'x_exp_date'               => $x_exp_date,
											'x_card_code'              => $x_card_code,
											'x_invoice_num'            => $x_invoice_num,
											'x_description'            => $x_description,
											'x_amount'                 => $x_amount
				
				);

				$post_string = "";
				foreach( $authorizeaim_args as $key => $value ){ 
					$post_string .= "$key=" . urlencode( $value ) . "&"; 
				}
				$post_string = rtrim( $post_string, "& " ); 
				
				$request = curl_init( $process_url ); // initiate curl object
				curl_setopt( $request, CURLOPT_HEADER, 0 ); // set to 0 to eliminate header info from response
				curl_setopt( $request, CURLOPT_RETURNTRANSFER, 1 ); // Returns response data instead of TRUE(1)
				curl_setopt( $request, CURLOPT_POSTFIELDS, $post_string ); // use HTTP POST to send form data
				curl_setopt( $request, CURLOPT_SSL_VERIFYPEER, FALSE ); // uncomment this line if you get no gateway response.
				$post_response = curl_exec( $request ); // execute curl post and store results in $post_response
				curl_close ( $request );
				
				$response_array = explode( '|', $post_response );
				
				if ( count( $response_array ) > 1 ) {
				
					if( '1' == $response_array[1] ) {
							
						echo $success_message . $response_array[3] . 'Transaction ID: '. $response_array[6] . 'c0d@' . $response_array[1];
					} else {
					
						echo '(Transaction Error):- ' . $response_array[3] . 'c0d@' . $response_array[1];
					}
				} else {
				
					echo '(Transaction Error):- Error processing payment.' . 'c0d@' . $response_array[1]; 
				}
			} else { 

				require( dirname( __FILE__ ) . '/' . 'ospt-first-data-class.php' );
				$sandbox = $pt->ospt_get_the_value( $post_id, 'general', 'first-data-sandbox', '' );
				$gateway_id = $pt->ospt_get_the_value( $post_id, 'general', 'gateway-id', '' );
				$terminal_password = $pt->ospt_get_the_value( $post_id, 'general', 'terminal-password', '' );
				$hmac_key = $pt->ospt_get_the_value( $post_id, 'general', 'hmac-key', '' );
				$key_id = $pt->ospt_get_the_value( $post_id, 'general', 'key-id', '' );
				$success_message = $pt->ospt_get_the_value( $post_id, 'general', 'txn-success-message', '' );
				$failed_message = $pt->ospt_get_the_value( $post_id, 'general', 'txn-failed-message', '' );

				if( 1 == $sandbox )
					$process_url = 'https://api.demo.globalgatewaye4.firstdata.com/transaction/v12';
				else
					$process_url = 'https://api.globalgatewaye4.firstdata.com/transaction/v12';

				define( 'OSWC_API_URL', $process_url );
				define( 'OSWC_GATEWAY_ID', $gateway_id );
				define( 'OSWC_TERMINAL_PASSWORD', $terminal_password );
				define( 'OSWC_HMAC_KEY', $hmac_key );
				define( 'OSWC_KEY_ID', $key_id );
				define( 'OSWC_DEBUG', false ); 
				
				$request = array(
									'transaction_type' => "00",
									'amount' => $x_amount,
									'cc_expiry' => $x_exp_date,
									'cc_number' => $x_card_num,
									'cardholder_name' => $x_description,
									'currency_code' => $x_currency_code,
									'reference_no' => ''
								);
				
	            $firstdata = new FirstData(); 

				if( $firstdata->request( $request ) ) {
				
					if( '1' == $firstdata->response->transaction_approved ) {
							
						echo $success_message . 'Transaction ID: '. $firstdata->response->authorization_num . 'c0d@' . $firstdata->response->transaction_approved;
					} else {
					
						echo '(Transaction Error):- ' . $firstdata->response->exact_resp_code . 'c0d@' . $firstdata->response->transaction_error;
					}
				} else {
				
					echo '(Transaction Error):- Error processing payment.' . 'c0d@' . $firstdata->response->transaction_error; 
				}
			}

			wp_die();
		}	

		/*
		* Check whether the card number number is valid
		*/

		private function is_valid_credit_card( $credit_card ) {		   
			
			$number = preg_replace( '/[^0-9]+/', '', $credit_card );
			$strlen = strlen( $number );
			$sum    = 0;
			
			if ( $strlen < 13 )
				return false; 
			
			for ( $i=0; $i < $strlen; $i++ ) {
				$digit = substr( $number, $strlen - $i - 1, 1 );
				
				if( $i % 2 == 1 ) {
					
					$sub_total = $digit * 2;
					
					if( $sub_total > 9 ) {
						$sub_total = 1 + ( $sub_total - 10 );
					}
				} else {
					$sub_total = $digit;
				}
				$sum += $sub_total;
			}
			
			if ( $sum > 0 AND $sum % 10 == 0 )
				return true; 
			
			return false; 
		}

		/*
		* Check expiry date is valid
		*/
		
		private function is_valid_expire_date( $ccexp_expiry ) {
			
			$month = $year = '';
			$month = substr( $ccexp_expiry , 0, 2 );
			$year = substr( $ccexp_expiry , 5, 7 );
			$year = '20'. $year;
			
			if( $month > 12 ) {
				return false;
			} 
			
			if ( date( "Y-m-d", strtotime( $year . "-" . $month . "-01" ) ) > date( "Y-m-d" ) ) {
				return true;
			}

			return false;
		}
		
		/*
		* Check whether the ccv number is empty
		*/
		
		private function is_empty_ccv_nmber( $ccv_number ) {
			
			$length = strlen( $ccv_number );
			
			return is_numeric( $ccv_number ) AND $length > 2 AND $length < 5;
		}   
	}
endif;

/**
 * Returns the main instance of osptPaymentProcess to prevent the need to use globals.
 *
 * @since  2.3
 * @return osptPaymentProcess
 */
 
return new osptPaymentProcess();
?>