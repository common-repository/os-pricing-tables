<?php 
$pt = new osptPostTypes();
$ospt_custom_meta = $pt->ospt_return_slider_custom_meta( $post_id );
$packages = !empty( $ospt_custom_meta['package'] ) ? $ospt_custom_meta['package'] : '';
?>
<div id="ospt-settings-wrapper">
	<h3><?php _e( 'Font Size Settings', OSPT_TEXT_DOMAIN ); ?></h3>
	<div class="ospt-row-box">
        <label for="package-name-font"><?php _e( 'Package Name', OSPT_TEXT_DOMAIN ); ?></label>
        <input type="text" name="ospt[settings][package-name-font]" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'package-name-font', '' ); ?>" placeholder="eg: 24px" />
    </div>    
	<div class="ospt-row-box last">
        <label for="price-font"><?php _e( 'Price', OSPT_TEXT_DOMAIN ); ?></label>
        <input type="text" name="ospt[settings][price-font]" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'price-font', '' ); ?>" placeholder="eg: 20px" />
    </div>    
	<div class="ospt-row-box">
        <label for="features-font"><?php _e( 'Content', OSPT_TEXT_DOMAIN ); ?></label>
        <input type="text" name="ospt[settings][features-font]" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'features-font', '' ); ?>" placeholder="eg: 14px" />
    </div>    
	<div class="ospt-row-box last">
        <label for="button-font"><?php _e( 'Button', OSPT_TEXT_DOMAIN ); ?></label>
        <input type="text" name="ospt[settings][button-font]" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'button-font', '' ); ?>" placeholder="eg: 20px" />
    </div>    
    <div class="clear"></div>
    <h3><?php _e( 'Color Settings', OSPT_TEXT_DOMAIN ); ?></h3>
    <div class="ospt-row">
        <label for="button-color"><?php _e( 'Button Color', OSPT_TEXT_DOMAIN ); ?></label>
    	<input type="text" name="ospt[settings][button-color]" class="button-color" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'button-color', '' ); ?>" />
    </div>
    <div class="ospt-row">
        <label for="font-color"><?php _e( 'Button Font Color', OSPT_TEXT_DOMAIN ); ?></label>
    	<input type="text" name="ospt[settings][font-color]" class="button-color" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'font-color', '' ); ?>" />
    </div>
    <div class="ospt-row">
        <label for="hover-color"><?php _e( 'Button Hover Color', OSPT_TEXT_DOMAIN ); ?></label>
    	<input type="text" name="ospt[settings][hover-color]" class="button-color" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'hover-color', '' ); ?>" />
    </div>
    <div class="ospt-row">
        <label for="price-color"><?php _e( 'Price Color', OSPT_TEXT_DOMAIN ); ?></label>
    	<input type="text" name="ospt[settings][price-color]" class="button-color" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'price-color', '' ); ?>" />
    </div>
    <div class="ospt-row">
        <label for="featured-box-color"><?php _e( 'Featured Box Color', OSPT_TEXT_DOMAIN ); ?></label>
    	<input type="text" name="ospt[settings][featured-box-color]" class="button-color" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'featured-box-color', '' ); ?>" />
    </div>
    <?php 
	if( !empty( $packages ) ) {
		$k = 0;
		for( $i = 0; $i < count( $packages ) - 2; $i++ ) {
			$k++;
		?>
		<div class="ospt-row">
			<label for="box-color"><?php _e( 'Box Color ' . $k, OSPT_TEXT_DOMAIN ); ?></label>
			<input type="text" name="ospt[settings][box-color-<?php echo $k;?>]" class="button-color" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'box-color-' . $k, '' ); ?>" />
		</div>
		<?php 
		}
	}
	?>
    <div class="ospt-row">
        <label for="package-name-box-color"><?php _e( 'Package Name Font Color', OSPT_TEXT_DOMAIN ); ?></label>
    	<input type="text" name="ospt[settings][package-name-box-color]" class="button-color" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'package-name-box-color', '' ); ?>" />
    </div>
    <div class="ospt-row">
        <label for="featured-font-color"><?php _e( 'Content Font Color', OSPT_TEXT_DOMAIN ); ?></label>
    	<input type="text" name="ospt[settings][featured-font-color]" class="button-color" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'featured-font-color', '' ); ?>" />
    </div>
    <div class="ospt-row">
        <label for="featured-color"><?php _e( 'Featured Color', OSPT_TEXT_DOMAIN ); ?></label>
    	<input type="text" name="ospt[settings][featured-color]" class="button-color" value="<?php echo $pt->ospt_get_the_value( $post_id, 'settings', 'featured-color', '' ); ?>" />
    </div>
    <div class="clear"></div>
</div>                                                                                    
