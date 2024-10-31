<?php 
$countries = new osptCountries();
$currencies = new osptCurrencies();
$pt = new osptPostTypes();
$payment_methods = array(
							'paypal'			=>	'PayPal',
							'authorizenet-aim'	=>	'Authorize.net AIM',
							'first-data'		=>	'First Data'
						);
						
$ospt_custom_meta = $pt->ospt_return_slider_custom_meta( $post_id );
$country = $pt->ospt_get_the_value( $post_id, 'general', 'country', 'US' );
$currency = $pt->ospt_get_the_value( $post_id, 'general', 'currency', 'USD' );
$email_address = $pt->ospt_get_the_value( $post_id, 'general', 'email-address', '' );
$payment_method = $pt->ospt_get_the_value( $post_id, 'general', 'payment-method', '' );

if( 'paypal' == $payment_method ) {
	$paypal_sandbox = $pt->ospt_get_the_value( $post_id, 'general', 'paypal-sandbox', '' );
	$paypal_email = $pt->ospt_get_the_value( $post_id, 'general', 'paypal-email', '' );
	$return_url = $pt->ospt_get_the_value( $post_id, 'general', 'paypal-return-url', '' );
	$cancel_url = $pt->ospt_get_the_value( $post_id, 'general', 'paypal-cancel-url', '' );
} else if( 'authorizenet-aim' == $payment_method ) {
	$authorize_sandbox = $pt->ospt_get_the_value( $post_id, 'general', 'authorize-sandbox', '' );
	$login_id = $pt->ospt_get_the_value( $post_id, 'general', 'login-id', '' );
	$transaction_key = $pt->ospt_get_the_value( $post_id, 'general', 'transaction-key', '' );
} else {
	$first_data_sandbox = $pt->ospt_get_the_value( $post_id, 'general', 'first-data-sandbox', '' );
	$gateway_id = $pt->ospt_get_the_value( $post_id, 'general', 'gateway-id', '' );
	$terminal_password = $pt->ospt_get_the_value( $post_id, 'general', 'terminal-password', '' );
	$hmac_key = $pt->ospt_get_the_value( $post_id, 'general', 'hmac-key', '' );
	$key_id = $pt->ospt_get_the_value( $post_id, 'general', 'key-id', '' );
}

$success_message = $pt->ospt_get_the_value( $post_id, 'general', 'success-message', 'Your payment has been procssed successfully.' );
$failed_message = $pt->ospt_get_the_value( $post_id, 'general', 'failed-message', 'Your transaction has been declined.' );
?>
<div id="ospt-general-wrapper">
    <div class="ospt-row">
        <div class="ospt-row-box"> 
            <label for="country"><?php _e( 'Base Location', OSPT_TEXT_DOMAIN ); ?></label>
            <select name="ospt[general][country]">
            	<option value="">Select Base Location</option>
                <?php foreach( $countries->ospt_countries() as $ctry_code => $ctry_name ){ ?>
            	<option value="<?php echo esc_attr( $ctry_code ); ?>" <?php selected( $ctry_code, $country ); ?>><?php echo esc_attr( $ctry_name ); ?></option>
                <?php } ?>
            </select>
            <em>This is location used for payment.</em>
        </div>
        <div class="ospt-row-box last"> 
            <label for="currency"><?php _e( 'Currency', OSPT_TEXT_DOMAIN ); ?></label>
            <select name="ospt[general][currency]">
            	<option value="">Select Currency</option>
                <?php foreach( $currencies->ospt_currencies() as $cny_code => $cny_name ){ ?>
            	<option value="<?php echo esc_attr( $cny_code ); ?>" <?php selected( $cny_code, $currency ); ?>><?php echo esc_attr( $cny_name ); ?></option>
                <?php } ?>
            </select>
            <em>This is currency used for payment.</em>
        </div>
    </div>
    <div class="ospt-row">
        <div class="ospt-row-box"> 
            <label for="email-address"><?php _e( 'Email Address', OSPT_TEXT_DOMAIN ); ?></label>
            <input type="text" name="ospt[general][email-address]" value="<?php echo esc_attr( $email_address ); ?>" placeholder="eg: demo@example.com" />
            <em>This address is used for mail purposes, like new payment notification.</em>
        </div>
        <div class="ospt-row-box last"> 
            <label for="payment-method"><?php _e( 'Payment Method', OSPT_TEXT_DOMAIN ); ?></label>
            <select name="ospt[general][payment-method]">
            	<option value="">Select Payment Method</option>
                <?php foreach( $payment_methods as $ptype => $pname ){ ?>
            	<option value="<?php echo esc_attr( $ptype ); ?>" <?php selected( $ptype, $payment_method ); ?>><?php echo esc_attr( $pname ); ?></option>
                <?php } ?>
            </select>
            <em>Payment method used for payment.</em>
        </div>
    </div>
    <div class="ospt-row">
    	<div id="paypal" <?php echo ( 'paypal' == $payment_method ) ? 'style="display: block;"' : 'style="display: none;"';?>>
        	<h3><?php _e( 'PayPal Settings', OSPT_TEXT_DOMAIN ); ?></h3>
            <div class="ospt-row-box"> 
                <label for="payPal-sandbox"><?php _e( 'PayPal Sandbox', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="checkbox" value="1" name="ospt[general][paypal-sandbox]" <?php checked( $paypal_sandbox, 1 ); ?> />Enable PayPal sandbox
                <em>PayPal sandbox can be used to test payments. Sign up for a developer account <a href="https://developer.paypal.com/" target="_blank">here</a>.</em>
            </div>
            <div class="ospt-row-box last"> 
                <label for="paypal-email"><?php _e( 'PayPal Email', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[general][paypal-email]" value="<?php echo esc_attr( $paypal_email ); ?>" placeholder="eg: demo@example.com" />
                <em>This is PayPal Email Address.</em>
            </div>
            <div class="ospt-row-box"> 
                <label for="paypal-return-url"><?php _e( 'PayPal Return URL', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[general][paypal-return-url]" value="<?php echo esc_attr( $return_url ); ?>" placeholder="eg: demo@example.com/success" />
                <em>This is PayPal Return URL.</em>
            </div>
            <div class="ospt-row-box last"> 
                <label for="paypal-cancel-url"><?php _e( 'PayPal Cancel URL', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[general][paypal-cancel-url]" value="<?php echo esc_attr( $cancel_url ); ?>" placeholder="eg: demo@example.com/cancel" />
                <em>This is PayPal Cancel URL.</em>
            </div>
        </div>
    	<div id="authorizenet-aim" <?php echo ( 'authorizenet-aim' == $payment_method ) ? 'style="display: block;"' : 'style="display: none;"';?>>
        	<h3><?php _e( 'Authorize.net Settings', OSPT_TEXT_DOMAIN ); ?></h3>
            <div class="ospt-row"> 
                <label for="authorize-sandbox"><?php _e( 'Authorize.net Sandbox', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="checkbox" value="1" name="ospt[general][authorize-sandbox]" <?php checked( $authorize_sandbox, 1 ); ?> />Enable Authorize.net sandbox
                <br/><em>Authorize.net sandbox can be used to test payments.</em>
            </div>
            <div class="ospt-row-box"> 
                <label for="login-id"><?php _e( 'Login ID', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[general][login-id]" value="<?php echo esc_attr( $login_id ); ?>" />
                <em>This is API Login ID.</em>
            </div>
            <div class="ospt-row-box last"> 
                <label for="transaction-key"><?php _e( 'Transaction Key', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[general][transaction-key]" value="<?php echo esc_attr( $transaction_key ); ?>" />
                <em>This is API Transaction Key.</em>
            </div>
        </div>
    	<div id="first-data" <?php echo ( 'first-data' == $payment_method ) ? 'style="display: block;"' : 'style="display: none;"';?>>
        	<h3><?php _e( 'First Data Settings', OSPT_TEXT_DOMAIN ); ?></h3>
            <div class="ospt-row"> 
                <label for="first-data-sandbox"><?php _e( 'First Data Sandbox', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="checkbox" value="1" name="ospt[general][first-data-sandbox]" <?php checked( $first_data_sandbox, 1 ); ?> />Enable First Data sandbox
                <br/><em>First Data sandbox can be used to test payments.</em>
            </div>
            <div class="ospt-row-box"> 
                <label for="gateway-id"><?php _e( 'Gateway ID', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[general][gateway-id]" value="<?php echo esc_attr( $gateway_id ); ?>" />
                <em>This is API Gateway ID.</em>
            </div>
            <div class="ospt-row-box last"> 
                <label for="terminal-password"><?php _e( 'Terminal Password', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[general][terminal-password]" value="<?php echo esc_attr( $terminal_password ); ?>" />
                <em>This is API Terminal Password.</em>
            </div>
            <div class="ospt-row-box"> 
                <label for="hmac-key"><?php _e( 'HMAC Key', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[general][hmac-key]" value="<?php echo esc_attr( $hmac_key ); ?>" />
                <em>This is API HMAC Key.</em>
            </div>
            <div class="ospt-row-box last"> 
                <label for="key-id"><?php _e( 'Key ID', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[general][key-id]" value="<?php echo esc_attr( $key_id ); ?>" />
                <em>This is API Key ID.</em>
            </div>
        </div>
    </div>
    <div class="ospt-row">
        <div class="ospt-row-box"> 
            <label for="txn-success-message"><?php _e( 'Transaction Success Message', OSPT_TEXT_DOMAIN ); ?></label>
            <input type="text" name="ospt[general][txn-success-message]" value="<?php echo esc_attr( $success_message ); ?>" placeholder="eg: demo@example.com"  />
            <em>Message to be displayed on successful transaction.</em>
        </div>
        <div class="ospt-row-box last"> 
            <label for="txn-failed-message"><?php _e( 'Transaction Failed Message', OSPT_TEXT_DOMAIN ); ?></label>
            <input type="text" name="ospt[general][txn-failed-message]" value="<?php echo esc_attr( $failed_message ); ?>" placeholder="eg: demo@example.com"  />
            <em>Message to be displayed on failed transaction.</em>
        </div>
    </div>
    <div class="clear"></div>
</div>                                                                                    