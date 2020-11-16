<?php bazaar_qodef_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="<?php echo esc_attr($holder_classes); ?>">
                <div class="qodef-footer-inner">
                    <?php
                        if($display_footer_top) {
                            bazaar_qodef_get_footer_top();
                        }
                        if($display_footer_bottom) {
                            bazaar_qodef_get_footer_bottom();
                        }
                    ?>
                </div>
			</footer>
		<?php } ?>
	</div> <!-- close div.qodef-wrapper-inner  -->
</div> <!-- close div.qodef-wrapper -->
<?php wp_footer(); ?>
</body>
</html>