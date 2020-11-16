<div <?php bazaar_qodef_class_attribute($holder_classes); ?>>
    <div class="qodef-cards-gallery">
        <?php
        $i = 1;
        foreach($images as $image) { ?>
            <div class="card" <?php bazaar_qodef_inline_style($background_color); ?>>
                <div class="qodef-bundle-item" data-bundle-move-top="<?php echo esc_attr($i*300); ?>">
                    <?php if($image['image_link'] !== ''){ ?>
                    <a href="<?php echo esc_url($image['image_link']) ?>" target="<?php echo esc_attr($image['image_target']) ?>">
                        <?php } ?>
                        <img  src="<?php echo esc_url($image['url']);?>" alt="#" />
                    <?php if($image['image_link'] !== ''){ ?>
                    </a>
                    <?php }
                    $i++;
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="fake_card">
        <img src="<?php echo esc_url(end($images)['url']);?>" alt="">
    </div>
</div>