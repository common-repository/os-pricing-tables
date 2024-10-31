<?php 
$post_type = new osptPostTypes();
$ospt_custom_meta = $post_type->ospt_return_slider_custom_meta( $post_id );
$ospt_design = isset( $ospt_custom_meta['design'] ) ? $ospt_custom_meta['design'] : '';
?>
<div id="ospt-design-wrapper">
	<ul>
        <li<?php echo ( $ospt_design == 'design-1' ) ? ' class="active"' : '';?>><a href="javascript:;" class="ospt_design" id="design-1" title="Design 1"></a></li>
        <li<?php echo ( $ospt_design == 'design-2' ) ? ' class="active"' : '';?>><a href="javascript:;" class="ospt_design" id="design-2" title="Design 2"></a></li>
        <li<?php echo ( $ospt_design == 'design-3' ) ? ' class="active"' : '';?>><a href="javascript:;" class="ospt_design" id="design-3" title="Design 3"></a></li>
        <li<?php echo ( $ospt_design == 'design-4' ) ? ' class="active"' : '';?>><a href="javascript:;" class="ospt_design" id="design-4" title="Design 4" ></a></li>
        <li<?php echo ( $ospt_design == 'design-5' ) ? ' class="active"' : '';?>><a href="javascript:;" class="ospt_design" id="design-5" title="Design 5" ></a></li>
        <li<?php echo ( $ospt_design == 'design-6' ) ? ' class="active"' : '';?>><a href="javascript:;" class="ospt_design" id="design-6" title="Design 6" ></a></li>
    </ul>
    <input type="hidden" name="ospt[design]" id="ospt_design" value="<?php echo $ospt_design;?>" />
    <div class="clear"></div>
</div>                                                                                    