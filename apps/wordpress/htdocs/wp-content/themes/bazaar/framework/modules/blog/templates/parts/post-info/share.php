<?php
$share_type = isset( $share_type ) ? $share_type : 'list';
?>
<?php if ( bazaar_qodef_core_plugin_installed() && bazaar_qodef_options()->getOptionValue( 'enable_social_share' ) === 'yes' && bazaar_qodef_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
    <div class="qodef-blog-share">
		<?php echo bazaar_qodef_get_social_share_html( array( 'type' => $share_type ) ); ?>
    </div>
<?php } ?>