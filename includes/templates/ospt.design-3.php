<?php 
$pt = new osptPostTypes();
$cny = new osptCurrencies();

$ospt = $pt->ospt_return_slider_custom_meta( $post_id );
$packages = !empty( $ospt['package'] ) ? $ospt['package'] : '';
$column = 12 / absint( count( $packages ) - 1 );
$currency = !empty( $ospt['general']['currency'] ) ? $ospt['general']['currency'] : '';
$email_address = !empty( $ospt['general']['email-address'] ) ? $ospt['general']['email-address'] : '';
$payment_method = !empty( $ospt['general']['payment-method'] ) ? $ospt['general']['payment-method'] : '';
$featured_box_color = !empty( $ospt['settings']['featured-box-color'] ) ? $ospt['settings']['featured-box-color'] : '';
$package_name_font = !empty( $ospt['settings']['package-name-font'] ) ? $ospt['settings']['package-name-font'] : '';
$package_name_box_color = !empty( $ospt['settings']['package-name-box-color'] ) ? $ospt['settings']['package-name-box-color'] : '';
$features_font = !empty( $ospt['settings']['features-font'] ) ? $ospt['settings']['features-font'] : '';
$featured_font_color = !empty( $ospt['settings']['featured-font-color'] ) ? $ospt['settings']['featured-font-color'] : '';
$price_font = !empty( $ospt['settings']['price-font'] ) ? $ospt['settings']['price-font'] : '';
$button_font = !empty( $ospt['settings']['button-font'] ) ? $ospt['settings']['button-font'] : '';
$button_color = !empty( $ospt['settings']['button-color'] ) ? $ospt['settings']['button-color'] : '';
$font_color = !empty( $ospt['settings']['font-color'] ) ? $ospt['settings']['font-color'] : '';
$hover_color = !empty( $ospt['settings']['hover-color'] ) ? $ospt['settings']['hover-color'] : '';
$featured_color = !empty( $ospt['settings']['featured-color'] ) ? $ospt['settings']['featured-color'] : '';
$price_color = !empty( $ospt['settings']['price-color'] ) ? $ospt['settings']['price-color'] : '';

if( 'paypal' == $payment_method ) {
	
	$sandbox = !empty( $ospt['general']['paypal-sandbox'] ) ? $ospt['general']['paypal-sandbox'] : '';
	$paypal_email = !empty( $ospt['general']['paypal-email'] ) ? $ospt['general']['paypal-email'] : '';
	$return_url = $pt->ospt_get_the_value( $post_id, 'general', 'paypal-return-url', '' );
	$cancel_url = $pt->ospt_get_the_value( $post_id, 'general', 'paypal-cancel-url', '' );

	if( 1 == $sandbox )
		$payment_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	else
		$payment_url = 'https://www.paypal.com/cgi-bin/webscr';
}
?>
<style type="text/css">
<?php
if( !empty( $packages ) ) {
	$k = 0;
	for( $j = 0; $j < count( $packages ) - 2; $j++ ) {
		$k++;
		$box_color = !empty( $ospt['settings']['box-color-' . $k] ) ? $ospt['settings']['box-color-' . $k] : '';
		?>
		#ospt-design-wrapper.design-3 .ospt-box<?php echo '.box-color-' . $k;?> {
			background: <?php echo $featured_box_color;?>;
			border-top: 8px solid <?php echo $button_color;?>;
		}
	<?php 
	}
}
?>
#ospt-design-wrapper.design-3 .ospt-box.featured{
	background: <?php echo $featured_box_color;?>;
	border-top: 8px solid <?php echo $button_color;?>;
}
#ospt-design-wrapper.design-3 .ospt-box h3 {
	font-size: <?php echo $package_name_font;?>;
	color: <?php echo $package_name_box_color;?>;
}
#ospt-design-wrapper.design-3 .ospt-box ul li {
	font-size: <?php echo $features_font;?>;
	color: <?php echo $featured_font_color;?>;
	border-bottom: 1px solid <?php echo $featured_font_color;?>;
}
#ospt-design-wrapper.design-3 .ospt-box .price_wrap {
	background-color: <?php echo $featured_color;?>;
	font-style: italic;
}
#ospt-design-wrapper.design-3 .ospt-box .price_wrap span {
	font-size:<?php echo $price_font;?>;
	color: <?php echo $price_color;?>;
}
#ospt-design-wrapper.design-3 .ospt-box .hvr-overline-from-center, .ospt_payment_box input.hvr-overline-from-center {
	background-color: <?php echo $button_color;?>;
	color: <?php echo $font_color;?>;
	font-size:<?php echo $button_font;?>;
}
#ospt-design-wrapper.design-3 .ospt-box .hvr-overline-from-center:before, .ospt_payment_box input.hvr-overline-from-center:before {
	background-color: <?php echo $hover_color;?>;
}
.ospt_payment_box {
    background-color: <?php echo $featured_box_color;?>;
    color: <?php echo $font_color;?>;
}
</style>
<div id="ospt-design-wrapper" class="design-3">
    <div class="row">
	<?php
    if( !empty( $packages ) ) {
        $i = $x = 0;
        foreach ( $packages as $packageObj ) {
            if( count( $packages ) - 1 > $i ) {
				
                $i++;
				$package_name = !empty( $packageObj['name'] ) ? $packageObj['name'] : '';
				$price = !empty( $packageObj['price'] ) ? $packageObj['price'] : '';
				$amount = preg_replace( '/[^0-9]+/', '', $price );
				$featured = !empty( $packageObj['featured'] ) ? $packageObj['featured'] : '';
				$title = !empty( $packageObj['title'] ) ? $packageObj['title'] : '';
				$button_text = !empty( $packageObj['button-text'] ) ? $packageObj['button-text'] : '';
				$link_type = !empty( $packageObj['link-type'] ) ? $packageObj['link-type'] : '';
				$features = !empty( $packageObj['features'] ) ? $packageObj['features'] : '';
				
				if( $featured ){
					$class = 'featured';
				} else {
					$x++;
					$class = 'box-color-' . $x;
				}
				
				if( !empty( $link_type ) )
					$button_url = !empty( $packageObj['button-url'] ) ? $packageObj['button-url'] : '';
                ?>
                <div class="col-xs-12 col-sm-6 col-md-<?php echo esc_attr( $column );?> col-lg-<?php echo esc_attr( $column );?> ospt-box <?php echo $class;?>">
                    <div class="top_wrap">
                   		<div class="price_wrap">
                            <small><?php echo $cny->ospt_get_currency_symbol( $currency );?></small>
                            <span><?php echo esc_attr( $price );?></span>
                        </div>
                        <h3><?php echo esc_attr( $package_name );?></h3>
                    </div>
                    <div class="content_wrap">
                        <ul>
                            <?php 
							if( !empty( $features ) ) {
                            	foreach( $features as $featureObj ) { ?>
                                <li><?php echo esc_attr( $featureObj );?></li>
                                <?php 
                                }
                            }
                            ?>
                        </ul>
                        <div class="button_wrap">
                            <?php if ( 'url' == $link_type ) {?>
                            <a class="hvr-overline-from-center" href="<?php echo esc_attr( $button_url );?>"><?php echo esc_attr( $button_text );?></a>
                            <?php 
	                    	} else { 
	                        	if( 'paypal' == $payment_method ) {
	                    		?>
		                        <form action="<?php echo esc_attr( $payment_url );?>" method="post" id="ospt_payment_form">
		                            <input type="hidden" name="cmd" value="_xclick">
		                            <input type="hidden" name="business" value="<?php echo esc_attr( $paypal_email );?>">
		                            <input type="hidden" name="item_name" value="<?php echo esc_attr( $package_name );?>">
		                            <input type="hidden" name="item_number" value="<?php echo esc_attr( time() );?>">
		                            <input type="hidden" name="amount" value="<?php echo esc_attr( $amount );?>">
		                            <input type="hidden" name="quantity" value="1">
		                            <input type="hidden" name="no_note" value="1">
		                            <input type="hidden" name="return" value="<?php echo esc_attr( $return_url );?>">
		                            <input type="hidden" name="cancel_return" value="<?php echo esc_attr( $cancel_url );?>">
		                            <input type="hidden" name="currency_code" value="<?php echo esc_attr( $currency );?>">
		                            <a class="hvr-overline-from-center" onclick="document.getElementById( 'ospt_payment_form' ).submit();"><?php echo esc_attr( $button_text );?></a>
		                        </form>
	                        	<?php 
	                        	} elseif( 'authorizenet-aim' == $payment_method || 'first-data' == $payment_method ) {
	                        	?>
	                    		<a class="hvr-overline-from-center ospt-colorbox" href="#ospt-payment-gateway-popup"><?php echo esc_attr( $button_text );?></a>
	                    		<div class="ospt-hide">
		                    		<div id="ospt-payment-gateway-popup">
										<div class="ospt_payment_box">
											<div class="alert ospt_alert" role="alert"></div>
											<form name="ospt_payment_form" id="ospt_payment_form" method="post">
												<input type="hidden" name="post_id" value="<?php echo esc_attr( $post_id );?>">
												<input type="hidden" name="x_currency_code" value="<?php echo esc_attr( $currency );?>">
												<input type="hidden" name="x_invoice_num" value="<?php echo esc_attr( time() );?>">
												<input type="hidden" name="x_description" value="<?php echo esc_attr( $package_name );?>">
					                            <input type="hidden" name="x_amount" value="<?php echo esc_attr( $amount );?>">
												<fieldset id="ospt_authorizeaim-cc-form">
													<p class="form-row form-row-wide">
														<label for="ospt_card_number">Card Number <span class="required">*</span></label>
														<input type="tel" name="ospt_card_number" placeholder="•••• •••• •••• ••••" autocomplete="off" pattern="\d*" maxlength="19" id="ospt_card_number">
													</p>
													<p class="form-row form-row-first">
														<label for="ospt_card_expiry">Expiry (MM/YY) <span class="required">*</span></label>
														<input type="tel" maxlength="7" name="ospt_card_expiry" placeholder="MM / YY" autocomplete="off" id="ospt_card_expiry" maxlength="5">
													</p>
													<p class="form-row form-row-last">
														<label for="ospt_card_cvc">Card Code <span class="required">*</span></label>
														<input type="tel" name="ospt_card_cvc" placeholder="CVC" autocomplete="off" id="ospt_card_cvc" maxlength="4">
													</p>
													<input type="submit"  value="Submit" id="ospt_submit" name="ospt_submit" class="hvr-overline-from-center ospt_card_payment">						
													<div class="clear"></div>
												</fieldset>
											</form>
											<div class="ospt_ajax_loader"></div>
										</div>
									</div>
								</div>
	                        	<?php
	                        	}	
	                    	}
	                    	?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    ?>
    </div>
</div>                                                                                    