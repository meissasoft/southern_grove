<?php
$product = bazaar_qodef_return_woocommerce_global_variable();

if (get_post_meta(get_the_ID(), 'qodef_single_product_new_meta', true) === 'yes'){ ?>
    <span class="qodef-<?php echo esc_attr($class_name); ?>-new-product"><?php esc_html_e('NEW', 'bazaar'); ?></span>
<?php } ?>

<?php if ($product->is_on_sale()) { ?>
	<span class="qodef-<?php echo esc_attr($class_name); ?>-onsale"><?php esc_html_e('SALE', 'bazaar'); ?></span>
<?php } ?>

<?php if (!$product->is_in_stock()) { ?>
	<span class="qodef-<?php echo esc_attr($class_name); ?>-out-of-stock"><?php esc_html_e('OUT OF STOCK', 'bazaar'); ?></span>
<?php }


if(isset($type) && $type == 'standard') {
	$product_image_size = 'shop_catalog';
}
else {
	$product_image_size = 'full';
}

if($image_size === 'full') {
	$product_image_size = 'full';
} else if ($image_size === 'square' || $image_size === 'qodef-default') {
	$product_image_size = 'bazaar_qodef_square';
} else if ($image_size === 'landscape' || $image_size === 'qodef-large-width') {
	$product_image_size = 'bazaar_qodef_landscape';
} else if ($image_size === 'portrait' || $image_size === 'qodef-large-height') {
	$product_image_size = 'bazaar_qodef_portrait';
} else if ($image_size === 'medium') {
	$product_image_size = 'medium';
} else if ($image_size === 'large') {
	$product_image_size = 'large';
} else if ($image_size === 'shop_thumbnail') {
	$product_image_size = 'shop_thumbnail';
} else if($image_size === 'qodef-large-width-height'){
	$product_image_size = 'bazaar_qodef_huge';
}


if(has_post_thumbnail()) {
	the_post_thumbnail(apply_filters( 'bazaar_qodef_product_list_image_size', $product_image_size));
}