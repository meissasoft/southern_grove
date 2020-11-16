<div class="qodef-crossfade-images">
	<?php if ( $link != '' ) { ?>
        <a class="qodef-cfi-link" href="<?php echo esc_url( $link ) ?>" target="<?php echo esc_attr( $link_target ) ?>"></a>
	<?php } ?>
    <div class="qodef-cfi-img-holder" style=" background-color: <?php echo esc_attr( $background_color ) ?>;">
        <div class="qodef-cfi-img-holder-inner">
            <img src="<?php echo wp_get_attachment_url( $initial_image, 'full' ); ?>" alt="<?php esc_attr__( 'initial image', 'select-core' ); ?>"/>
            <div class="qodef-cfi-image-hover" style="background-image: url(<?php echo wp_get_attachment_url( $hover_image, 'full' ); ?>);"></div>
        </div>
    </div>
	<?php if ( $title != '' ) { ?>
        <div class="qodef-cfi-title-holder">
            <h3 class="qodef-cfi-title"><?php echo esc_attr( $title ) ?></h3>
        </div>
	<?php } ?>
</div>