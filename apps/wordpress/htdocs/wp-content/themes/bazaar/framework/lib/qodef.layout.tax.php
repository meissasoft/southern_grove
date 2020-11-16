<?php

/*
   Class: BazaarQodefTaxonomyField
   A class that initializes BazaarQodef Taxonomy Field
*/

class BazaarQodefTaxonomyField implements iBazaarQodefRender {
	private $type;
	private $name;
	private $label;
	private $description;
	private $options = array();
	private $args = array();

	function __construct( $type, $name, $label = "", $description = "", $options = array(), $args = array() ) {
		$this->type        = $type;
		$this->name        = $name;
		$this->label       = $label;
		$this->description = $description;
		$this->options     = $options;
		$this->args        = $args;
		add_filter( 'bazaar_qodef_taxonomy_fields', array( $this, 'addFieldForEditSave' ) );
	}

	public function addFieldForEditSave( $names ) {
		$names[] = $this->name;

		return $names;
	}

	public function render( $factory ) {
		$factory->render( $this->type, $this->name, $this->label, $this->description, $this->options, $this->args );
	}
}

abstract class BazaarQodefTaxonomyFieldType {
	abstract public function render( $name, $label = "", $description = "", $options = array(), $args = array() );
}

class BazaarQodefTaxonomyFieldText extends BazaarQodefTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {
		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
            <div class="form-field">
                <label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
                <input type="text" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="">
                <p class="description"><?php echo esc_html( $description ); ?></p>
            </div>
			<?php
		} else {
			$value = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label></th>
                <td>
                    <input type="text" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="<?php echo ! empty( $value ) ? esc_attr( $value ) : ''; ?>">
                    <p class="description"><?php echo esc_html( $description ); ?></p>
                </td>
            </tr>
			<?php
		}
	}
}

class BazaarQodefTaxonomyFieldImage extends BazaarQodefTaxonomyFieldType {
	public function render( $name, $label = "", $description = "", $options = array(), $args = array() ) {
		if ( ! isset( $_GET['tag_ID'] ) ) { ?>
            <div class="form-field">
                <label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
                <div class="qodef-tax-image-wrapper"></div>
                <p>
                    <input type="button" class="button button-secondary qodef-tax-media-add" name="qodef-tax-media-add" value="<?php esc_html_e( 'Add Image', 'bazaar' ); ?>"/>
                    <input type="button" class="button button-secondary qodef-tax-media-remove" name="qodef-tax-media-remove" value="<?php esc_html_e( 'Remove Image', 'bazaar' ); ?>"/>
                </p>
	            <input type="hidden" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" class="qodef-tax-custom-media-url" value="">
	            <?php wp_nonce_field( 'qodef_tax_del_image_nonce', 'qodef_tax_del_image_nonce' ); ?>
            </div>
			<?php
		} else {
			global $taxonomy;
			$image_id = get_term_meta( $_GET['tag_ID'], $name, true );
			?>
            <tr class="form-field">
                <th scope="row">
                    <label for="<?php echo esc_html( $name ); ?>"><?php echo esc_html( $label ); ?></label>
                </th>
                <td>
					<?php ?>
                    <div class="qodef-tax-image-wrapper">
						<?php if ( $image_id ) { ?>
							<?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
						<?php } ?>
                    </div>
                    <p>
                        <input type="button" class="button button-secondary qodef-tax-media-add" name="qodef-tax-media-add" value="<?php esc_html_e( 'Add Image', 'bazaar' ); ?>"/>
                        <input data-termid="<?php echo esc_html( $_GET['tag_ID'] ); ?>" data-taxonomy="<?php echo esc_html( $taxonomy ); ?>" type="button" class="button button-secondary qodef-tax-media-remove" name="qodef-tax-media-remove" value="<?php esc_html_e( 'Remove Image', 'bazaar' ); ?>"/>
                    </p>
	                <input type="hidden" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $image_id ); ?>" class="qodef-tax-custom-media-url">
	                <?php wp_nonce_field( 'qodef_tax_del_image_nonce', 'qodef_tax_del_image_nonce' ); ?>
                </td>
            </tr>
			<?php
		}
	}
}

class BazaarQodefTaxonomyFieldFactory {

	public function render( $field_type, $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		switch ( strtolower( $field_type ) ) {

			case 'text':
				$field = new BazaarQodefTaxonomyFieldText();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;

			case 'image':
				$field = new BazaarQodefTaxonomyFieldImage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			default:
				break;

		}
	}
}
