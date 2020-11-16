<?php
if($show_header_top) {
	do_action('bazaar_qodef_before_header_top');
	?>
	
	<?php if($show_header_top_background_div){ ?>
		<div class="qodef-top-bar-background"></div>
	<?php } ?>
	
	<div class="qodef-top-bar">
		<?php do_action( 'bazaar_qodef_after_header_top_html_open' ); ?>
		
		<?php if($top_bar_in_grid) : ?>
			<div class="qodef-grid">
		<?php endif; ?>
				
			<div class="qodef-vertical-align-containers">
				<div class="qodef-position-left">
					<div class="qodef-position-left-inner">
						<?php if(is_active_sidebar('qodef-top-bar-left')) : ?>
							<?php dynamic_sidebar('qodef-top-bar-left'); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="qodef-position-right">
					<div class="qodef-position-right-inner">
						<?php if(is_active_sidebar('qodef-top-bar-right')) : ?>
							<?php dynamic_sidebar('qodef-top-bar-right'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
				
		<?php if($top_bar_in_grid) : ?>
			</div>
		<?php endif; ?>
		
		<?php do_action( 'bazaar_qodef_before_header_top_html_close' ); ?>
	</div>
	
	<?php do_action('bazaar_qodef_after_header_top');
}