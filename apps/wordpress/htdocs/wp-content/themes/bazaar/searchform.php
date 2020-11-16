<form role="search" method="get" class="searchform" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'bazaar' ); ?></label>
	<div class="input-holder clearfix">
		<input type="search" class="search-field" placeholder="<?php esc_html_e( 'Search...', 'bazaar' ); ?>" value="" name="s" title="<?php esc_html_e( 'Search for:', 'bazaar' ); ?>"/>
		<button type="submit" class="qodef-search-submit"><?php echo bazaar_qodef_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?></button>
	</div>
</form>