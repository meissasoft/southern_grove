<div class="qodef-banner-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="qodef-banner-image">
		<div class="qodef-banner-overlay"  <?php echo bazaar_qodef_get_inline_style($overlay_styles); ?>></div>
        <?php echo wp_get_attachment_image($image, 'full'); ?>
    </div>
    <div class="qodef-banner-text-holder">
	    <div class="qodef-banner-text-outer">
		    <div class="qodef-banner-text-inner">
		    	<?php if(!empty($additional_image)) { ?>
			    	<div class="qodef-additional-image">
		    			<?php echo wp_get_attachment_image($additional_image, 'full'); ?>
			    	</div>
		    	<?php  } ?>
		        <?php if(!empty($subtitle)) { ?>
		            <<?php echo esc_attr($subtitle_tag); ?> class="qodef-banner-subtitle" <?php echo bazaar_qodef_get_inline_style($subtitle_styles); ?>>
			            <?php echo esc_html($subtitle); ?>
		            </<?php echo esc_attr($subtitle_tag); ?>>
		        <?php } ?>
		        <?php if(!empty($title)) { ?>
		            <<?php echo esc_attr($title_tag); ?> class="qodef-banner-title" <?php echo bazaar_qodef_get_inline_style($title_styles); ?>>
		                <?php echo wp_kses($title, array('span' => array('class' => true))); ?>
	                </<?php echo esc_attr($title_tag); ?>>
		        <?php } ?>
				<?php if(!empty($link) && !empty($link_text)) { ?>
		            <a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" class="qodef-banner-link-text" <?php echo bazaar_qodef_get_inline_style($link_styles); ?>>
			            <span class="qodef-banner-link-original">
				            <span class="qodef-banner-link-icon ion-arrow-right-c"></span>
			                <span class="qodef-banner-link-label"><?php echo esc_html($link_text); ?></span>
			            </span>
			            <span class="qodef-banner-link-hover">
				            <span class="qodef-banner-link-icon ion-arrow-right-c"></span>
			                <span class="qodef-banner-link-label"><?php echo esc_html($link_text); ?></span>
			            </span>
		            </a>
		        <?php } ?>
			</div>
		</div>
	</div>
	<?php if (!empty($link)) { ?>
        <a itemprop="url" class="qodef-banner-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>"></a>
    <?php } ?>
</div>