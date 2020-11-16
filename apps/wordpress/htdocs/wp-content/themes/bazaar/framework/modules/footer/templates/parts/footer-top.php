<div class="qodef-footer-top-holder">
	<div class="qodef-footer-top-inner <?php echo esc_attr($footer_top_grid_class); ?>">
		<div class="qodef-grid-row <?php echo esc_attr($footer_top_classes); ?>">
			<?php for($i = 1; $i <= $footer_top_columns; $i++) { ?>
				<div class="qodef-column-content qodef-grid-col-<?php echo esc_attr(12 / $footer_top_columns); ?>">
					<?php
						if(is_active_sidebar('footer_top_column_'.$i)) {
							dynamic_sidebar('footer_top_column_'.$i);
						}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>