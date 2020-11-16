<div class="qodef-fullscreen-search-holder">
	<a class="qodef-fullscreen-search-close" href="javascript:void(0)">
		<?php echo bazaar_qodef_icon_collections()->renderIcon( 'icon_close', 'font_elegant' ); ?>
	</a>
	<div class="qodef-fullscreen-search-table">
		<div class="qodef-fullscreen-search-cell">
			<div class="qodef-fullscreen-search-inner">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-fullscreen-search-form" method="get">
					<div class="qodef-form-holder">
						<div class="qodef-form-holder-inner">
							<div class="qodef-field-holder">
								<input type="text" placeholder="<?php esc_html_e( 'Search for...', 'bazaar' ); ?>" name="s" class="qodef-search-field" autocomplete="off"/>
							</div>
							<button type="submit" class="qodef-search-submit"><?php echo bazaar_qodef_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?></button>
							<div class="qodef-line"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>