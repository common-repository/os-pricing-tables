<?php 
$post_type = new osptPostTypes();
$ospt_custom_meta = $post_type->ospt_return_slider_custom_meta( $post_id );
$design = isset( $ospt_custom_meta['design'] ) ? $ospt_custom_meta['design'] : '';
$shortcode = '[ospt-pricing-table id="' . $post_id . '" design="' . $design . '"]';
$shortcode_function = '<?php echo do_shortcode( [ospt-pricing-table id="' . $post_id . '" design="' . $design . '"] );?>';
?>
<div id="ospt-shortcode-wrapper">
	<p><b>Shortcode: </b></p>
    <div class="option-box" style="margin: 15px 0 0 0; border-bottom: none;">
        <input type="text" readonly="readonly" id="shortcode_<?php echo $post_id;?>" class="shortcode" value="<?php echo esc_attr( $shortcode ); ?>">         
    </div>
    <em>Copy and paste this shortcode into your post, page or custom post types etc.</em>
	<p><b>Template Code: </b></p>
    <div class="option-box" style="margin: 15px 0 0 0; border-bottom: none;">
        <input type="text" readonly="readonly" id="shortcode_function_<?php echo $post_id;?>" class="shortcode" value="<?php echo esc_attr( $shortcode_function ); ?>">      
    </div>
    <em>Copy and paste this function into your page templates like header.php, front-page.php, etc.</em>    
    <div class="clear"></div>
</div>
<script type="text/javascript">
(function($) {
    $(document).on('click', '.shortcode', function(e) {
        $(this).select();
        $(this).onmouseup = function() {
            $(this).onmouseup = null;
            return false
        }
    });
})(jQuery);    
</script>                                                                                    