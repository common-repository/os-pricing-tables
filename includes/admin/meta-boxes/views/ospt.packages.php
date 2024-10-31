<?php 
$post_type = new osptPostTypes();
$link_types = array(
						'url'		=>	'URL',
						'gateway'	=>	'Payment Gateway'
					);
$ospt_custom_meta = $post_type->ospt_return_slider_custom_meta( $post_id );
$packages = !empty( $ospt_custom_meta['package'] ) ? $ospt_custom_meta['package'] : ''; 
?>
<div id="ospt-slider-wrapper">
<?php 
if( !empty( $packages ) ) {
    $i = 0;
    foreach ( $packages as $packageObj ) {
        if( count( $packages ) - 1 > $i ) {
            $i++;
            $package_name = !empty( $packageObj['name'] ) ? $packageObj['name'] : '';
            $price = !empty( $packageObj['price'] ) ? $packageObj['price'] : '';
            $featured = !empty( $packageObj['featured'] ) ? $packageObj['featured'] : '';
            $title = !empty( $packageObj['title'] ) ? $packageObj['title'] : '';
            $button_text = !empty( $packageObj['button-text'] ) ? $packageObj['button-text'] : '';
            $link_type = !empty( $packageObj['link-type'] ) ? $packageObj['link-type'] : '';
			$features = !empty( $packageObj['features'] ) ? $packageObj['features'] : '';
			
			if( !empty( $link_type ) )
           		$button_url = !empty( $packageObj['button-url'] ) ? $packageObj['button-url'] : '';
            ?>            
            <div class="ospt-box">
                <div class="ospt-header<?php echo !empty( $featured ) ? ' featured' : '';?>">
                    <div class="ospt-caption">
                        <?php echo esc_attr( $package_name ); ?>
                    </div>
                    <div class="ospt-controls">
                        <span class="toggle up"></span>
                        <span class="delete"></span>                                        
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="ospt-body" style="display: block;">
                    <div class="ospt-row">
                        <div class="ospt-row-box"> 
                            <label for="package-name"><?php _e( 'Package Name', OSPT_TEXT_DOMAIN ); ?></label>
                            <input type="text" name="ospt[package][<?php echo $i;?>][name]" placeholder="eg: Small Business" value="<?php echo esc_attr( $package_name ); ?>" />
                        </div>
                        <div class="ospt-row-box last"> 
                            <label for="package-price"><?php _e( 'Price', OSPT_TEXT_DOMAIN ); ?></label>
                            <input type="text" name="ospt[package][<?php echo $i;?>][price]" placeholder="eg: $49/mo" value="<?php echo esc_attr( $price ); ?>" />
                        </div>
                    </div>
                    <div class="ospt-row">
                        <div class="ospt-row-box"> 
                            <label for="featured"><?php _e( 'Featured', OSPT_TEXT_DOMAIN ); ?></label>
                            <input type="checkbox" value="1" name="ospt[package][<?php echo $i;?>][featured]" <?php checked( $featured, 1 ); ?> />Enable Featured box
                        </div>
                        <div class="ospt-row-box last"> 
                            <label for="title"><?php _e( 'Featured Title', OSPT_TEXT_DOMAIN ); ?></label>
                            <input type="text" name="ospt[package][<?php echo $i;?>][title]" value="<?php echo esc_attr( $title ); ?>" placeholder="eg: Featured" />
                        </div>
                    </div>
                    <div class="ospt-row">
                        <div class="ospt-row-box"> 
                            <label for="button-text"><?php _e( 'Button Text', OSPT_TEXT_DOMAIN ); ?></label>
                            <input type="text" name="ospt[package][<?php echo $i;?>][button-text]" placeholder="eg: Start A Free Trial" value="<?php echo esc_attr( $button_text ); ?>" />
                        </div>
                        <div class="ospt-row-box last"> 
                            <label for="link-type"><?php _e( 'Link Type', OSPT_TEXT_DOMAIN ); ?></label>
                            <select name="ospt[package][<?php echo $i;?>][link-type]" class="link-type">
                                <option value="">Select Link Type</option>
                                <?php foreach( $link_types as $code => $name ){ ?>
                                <option value="<?php echo esc_attr( $code ); ?>" <?php selected( $code, $link_type ); ?>><?php echo esc_attr( $name ); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="ospt-row" id="button-url" <?php echo ( 'url' == $link_type ) ? 'style="display: block;"' : 'style="display: none;"';?>>
                        <label for="button-url"><?php _e( 'Button URL', OSPT_TEXT_DOMAIN ); ?></label>
                        <input type="text" name="ospt[package][<?php echo $i;?>][button-url]" placeholder="eg: http://example.com/buy" value="<?php echo esc_attr( $button_url ); ?>" />
                    </div>
            		<div class="ospt-row"> 
                    	<h3><?php _e( 'Features', OSPT_TEXT_DOMAIN ); ?></h3>
                        <input type="button" class="button button-primary add-feature" value="Add Feature" id="<?php echo $i;?>" />
                        <div class="features">
                            <?php 
							$x = 0;
							if( !empty( $features ) ) {  
								foreach( $features as $featureObj ) { 
								$x++;
								?>
                                <div class="ospt-row-box features-box"> 
                                    <label for="features">Feature <?php echo esc_attr( $x );?></label>
                                    <input type="text" value="<?php echo esc_attr( $featureObj );?>" name="ospt[package][<?php echo $i;?>][features][]">
                                    <input type="button" value="-" class="button delete-feature">
                                </div>
                                <?php 
                                }
							}
							?>
                        </div>                      
                    </div>
                    <div class="clear"></div>
                </div>    
            </div>           
        <?php
        }
    }
}
?>
</div>                                                                                    
<input type="button" class="button button-primary" value="Add Package" id="add-package" />
<div class="ospt-box-wrap hide">
    <div class="ospt-box">
        <div class="ospt-header">
            <div class="ospt-caption">
                <?php _e( 'Package', OSPT_TEXT_DOMAIN );?>
            </div>
            <div class="ospt-controls">
                <span class="toggle up"></span>
                <span class="delete"></span>                                        
            </div>
            <div class="clear"></div>
        </div>
        <div class="ospt-body" style="display: block;">
            <div class="ospt-row">
            	<div class="ospt-row-box"> 
                    <label for="package-name"><?php _e( 'Package Name', OSPT_TEXT_DOMAIN ); ?></label>
                    <input type="text" name="ospt[package][{id}][name]" placeholder="eg: Small Business" />
                </div>
                <div class="ospt-row-box last"> 
                    <label for="package-price"><?php _e( 'Price', OSPT_TEXT_DOMAIN ); ?></label>
                    <input type="text" name="ospt[package][{id}][price]" placeholder="eg: $49/mo" />
                </div>
            </div>
            <div class="ospt-row">
            	<div class="ospt-row-box"> 
                    <label for="featured"><?php _e( 'Featured', OSPT_TEXT_DOMAIN ); ?></label>
                    <input type="checkbox" value="1" name="ospt[package][{id}][featured]" />Enable Featured box
                </div>
                <div class="ospt-row-box last"> 
                    <label for="title"><?php _e( 'Featured Title', OSPT_TEXT_DOMAIN ); ?></label>
                    <input type="text" name="ospt[package][{id}][title]" placeholder="eg: Featured" />
                </div>
            </div>
            <div class="ospt-row">
            	<div class="ospt-row-box"> 
                    <label for="button-text"><?php _e( 'Button Text', OSPT_TEXT_DOMAIN ); ?></label>
                    <input type="text" name="ospt[package][{id}][button-text]" placeholder="eg: Start A Free Trial" />
                </div>
                <div class="ospt-row-box last"> 
                    <label for="link-type"><?php _e( 'Link Type', OSPT_TEXT_DOMAIN ); ?></label>
                    <select name="ospt[package][{id}][link-type]" class="link-type">
                        <option value="">Select Link Type</option>
                        <?php foreach( $link_types as $code => $name ){ ?>
                        <option value="<?php echo esc_attr( $code ); ?>"><?php echo esc_attr( $name ); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="ospt-row" id="button-url" style="display: none;">
                <label for="button-url"><?php _e( 'Button URL', OSPT_TEXT_DOMAIN ); ?></label>
                <input type="text" name="ospt[package][{id}][button-url]" placeholder="eg: http://example.com/buy" />
            </div>
            <div class="ospt-row"> 
                <h3><?php _e( 'Features', OSPT_TEXT_DOMAIN ); ?></h3>
                <input type="button" class="button button-primary add-feature" value="Add Feature" id="<?php echo $i;?>" />
                <div class="features"></div>                      
            </div>
            <div class="clear"></div>
        </div>    
    </div>
</div>
<div class="ospt-feature-wrap hide">
	<div class="ospt-row-box features-box"> 
        <label for="features"><?php _e( 'Feature', OSPT_TEXT_DOMAIN ); ?></label>
        <input type="text" name="ospt[package][{id}][features][]" placeholder="eg: Small Business" />
        <input type="button" class="button delete-feature" value="-" />
    </div>
</div>