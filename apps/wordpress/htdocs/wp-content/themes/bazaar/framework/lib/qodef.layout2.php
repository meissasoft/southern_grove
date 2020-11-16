<?php

class BazaarQodefFieldPortfolioFollow extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if ( isset( $args["dependence"] ) ) {
			$dependence = true;
		}

		$dependence_hide_on_yes = "";
		if ( isset( $args["dependence_hide_on_yes"] ) ) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}

		$dependence_show_on_yes = "";
		if ( isset( $args["dependence_show_on_yes"] ) ) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr( $dependence_hide_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_show_on_yes ); ?>"
                                        class="cb-enable<?php if ( bazaar_qodef_option_get_value( $name ) == "portfolio_single_follow" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Yes', 'bazaar' ) ?></span></label>
                                <label data-hide="<?php echo esc_attr( $dependence_show_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_hide_on_yes ); ?>"
                                        class="cb-disable<?php if ( bazaar_qodef_option_get_value( $name ) == "portfolio_single_no_follow" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'No', 'bazaar' ) ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                        name="<?php echo esc_attr( $name ); ?>_portfoliofollow" value="portfolio_single_follow"<?php if ( bazaar_qodef_option_get_value( $name ) == "portfolio_single_follow" ) {
									echo " selected";
								} ?>/>
                                <input type="hidden" class="checkboxhidden_portfoliofollow" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldZeroOne extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if ( isset( $args["dependence"] ) ) {
			$dependence = true;
		}

		$dependence_hide_on_yes = "";
		if ( isset( $args["dependence_hide_on_yes"] ) ) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}

		$dependence_show_on_yes = "";
		if ( isset( $args["dependence_show_on_yes"] ) ) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr( $dependence_hide_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_show_on_yes ); ?>"
                                        class="cb-enable<?php if ( bazaar_qodef_option_get_value( $name ) == "1" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Yes', 'bazaar' ) ?></span></label>
                                <label data-hide="<?php echo esc_attr( $dependence_show_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_hide_on_yes ); ?>"
                                        class="cb-disable<?php if ( bazaar_qodef_option_get_value( $name ) == "0" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'No', 'bazaar' ) ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                        name="<?php echo esc_attr( $name ); ?>_zeroone" value="1"<?php if ( bazaar_qodef_option_get_value( $name ) == "1" ) {
									echo " selected";
								} ?>/>
                                <input type="hidden" class="checkboxhidden_zeroone" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldImageVideo extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if ( isset( $args["dependence"] ) ) {
			$dependence = true;
		}

		$dependence_hide_on_yes = "";
		if ( isset( $args["dependence_hide_on_yes"] ) ) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}

		$dependence_show_on_yes = "";
		if ( isset( $args["dependence_show_on_yes"] ) ) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch switch-type">
                                <label data-hide="<?php echo esc_attr( $dependence_hide_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_show_on_yes ); ?>"
                                        class="cb-enable<?php if ( bazaar_qodef_option_get_value( $name ) == "image" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Image', 'bazaar' ) ?></span></label>
                                <label data-hide="<?php echo esc_attr( $dependence_show_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_hide_on_yes ); ?>"
                                        class="cb-disable<?php if ( bazaar_qodef_option_get_value( $name ) == "video" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Video', 'bazaar' ) ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                        name="<?php echo esc_attr( $name ); ?>_imagevideo" value="image"<?php if ( bazaar_qodef_option_get_value( $name ) == "image" ) {
									echo " selected";
								} ?>/>
                                <input type="hidden" class="checkboxhidden_imagevideo" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldYesEmpty extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if ( isset( $args["dependence"] ) ) {
			$dependence = true;
		}

		$dependence_hide_on_yes = "";
		if ( isset( $args["dependence_hide_on_yes"] ) ) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}

		$dependence_show_on_yes = "";
		if ( isset( $args["dependence_show_on_yes"] ) ) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr( $dependence_hide_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_show_on_yes ); ?>"
                                        class="cb-enable<?php if ( bazaar_qodef_option_get_value( $name ) == "yes" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Yes', 'bazaar' ) ?></span></label>
                                <label data-hide="<?php echo esc_attr( $dependence_show_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_hide_on_yes ); ?>"
                                        class="cb-disable<?php if ( bazaar_qodef_option_get_value( $name ) == "" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'No', 'bazaar' ) ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                        name="<?php echo esc_attr( $name ); ?>_yesempty" value="yes"<?php if ( bazaar_qodef_option_get_value( $name ) == "yes" ) {
									echo " selected";
								} ?>/>
                                <input type="hidden" class="checkboxhidden_yesempty" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldFlagPage extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if ( isset( $args["dependence"] ) ) {
			$dependence = true;
		}

		$dependence_hide_on_yes = "";
		if ( isset( $args["dependence_hide_on_yes"] ) ) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}

		$dependence_show_on_yes = "";
		if ( isset( $args["dependence_show_on_yes"] ) ) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr( $dependence_hide_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_show_on_yes ); ?>"
                                        class="cb-enable<?php if ( bazaar_qodef_option_get_value( $name ) == "page" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Yes', 'bazaar' ) ?></span></label>
                                <label data-hide="<?php echo esc_attr( $dependence_show_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_hide_on_yes ); ?>"
                                        class="cb-disable<?php if ( bazaar_qodef_option_get_value( $name ) == "" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'No', 'bazaar' ) ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                        name="<?php echo esc_attr( $name ); ?>_flagpage" value="page"<?php if ( bazaar_qodef_option_get_value( $name ) == "page" ) {
									echo " selected";
								} ?>/>
                                <input type="hidden" class="checkboxhidden_flagpage" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldFlagPost extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if ( isset( $args["dependence"] ) ) {
			$dependence = true;
		}

		$dependence_hide_on_yes = "";
		if ( isset( $args["dependence_hide_on_yes"] ) ) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}

		$dependence_show_on_yes = "";
		if ( isset( $args["dependence_show_on_yes"] ) ) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr( $dependence_hide_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_show_on_yes ); ?>"
                                        class="cb-enable<?php if ( bazaar_qodef_option_get_value( $name ) == "post" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Yes', 'bazaar' ) ?></span></label>
                                <label data-hide="<?php echo esc_attr( $dependence_show_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_hide_on_yes ); ?>"
                                        class="cb-disable<?php if ( bazaar_qodef_option_get_value( $name ) == "" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'No', 'bazaar' ) ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                        name="<?php echo esc_attr( $name ); ?>_flagpost" value="post"<?php if ( bazaar_qodef_option_get_value( $name ) == "post" ) {
									echo " selected";
								} ?>/>
                                <input type="hidden" class="checkboxhidden_flagpost" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldFlagMedia extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if ( isset( $args["dependence"] ) ) {
			$dependence = true;
		}

		$dependence_hide_on_yes = "";
		if ( isset( $args["dependence_hide_on_yes"] ) ) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}

		$dependence_show_on_yes = "";
		if ( isset( $args["dependence_show_on_yes"] ) ) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr( $dependence_hide_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_show_on_yes ); ?>"
                                        class="cb-enable<?php if ( bazaar_qodef_option_get_value( $name ) == "attachment" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Yes', 'bazaar' ) ?></span></label>
                                <label data-hide="<?php echo esc_attr( $dependence_show_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_hide_on_yes ); ?>"
                                        class="cb-disable<?php if ( bazaar_qodef_option_get_value( $name ) == "" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'No', 'bazaar' ) ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                        name="<?php echo esc_attr( $name ); ?>_flagmedia" value="attachment"<?php if ( bazaar_qodef_option_get_value( $name ) == "attachment" ) {
									echo " selected";
								} ?>/>
                                <input type="hidden" class="checkboxhidden_flagmedia" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldFlagPortfolio extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if ( isset( $args["dependence"] ) ) {
			$dependence = true;
		}

		$dependence_hide_on_yes = "";
		if ( isset( $args["dependence_hide_on_yes"] ) ) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}

		$dependence_show_on_yes = "";
		if ( isset( $args["dependence_show_on_yes"] ) ) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr( $dependence_hide_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_show_on_yes ); ?>"
                                        class="cb-enable<?php if ( bazaar_qodef_option_get_value( $name ) == "portfolio_page" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Yes', 'bazaar' ) ?></span></label>
                                <label data-hide="<?php echo esc_attr( $dependence_show_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_hide_on_yes ); ?>"
                                        class="cb-disable<?php if ( bazaar_qodef_option_get_value( $name ) == "" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'No', 'bazaar' ) ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                        name="<?php echo esc_attr( $name ); ?>_flagportfolio" value="portfolio_page"<?php if ( bazaar_qodef_option_get_value( $name ) == "portfolio_page" ) {
									echo " selected";
								} ?>/>
                                <input type="hidden" class="checkboxhidden_flagportfolio" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldFlagProduct extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$dependence = false;
		if ( isset( $args["dependence"] ) ) {
			$dependence = true;
		}

		$dependence_hide_on_yes = "";
		if ( isset( $args["dependence_hide_on_yes"] ) ) {
			$dependence_hide_on_yes = $args["dependence_hide_on_yes"];
		}

		$dependence_show_on_yes = "";
		if ( isset( $args["dependence_show_on_yes"] ) ) {
			$dependence_show_on_yes = $args["dependence_show_on_yes"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="field switch">
                                <label data-hide="<?php echo esc_attr( $dependence_hide_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_show_on_yes ); ?>"
                                        class="cb-enable<?php if ( bazaar_qodef_option_get_value( $name ) == "product" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'Yes', 'bazaar' ) ?></span></label>
                                <label data-hide="<?php echo esc_attr( $dependence_show_on_yes ); ?>" data-show="<?php echo esc_attr( $dependence_hide_on_yes ); ?>"
                                        class="cb-disable<?php if ( bazaar_qodef_option_get_value( $name ) == "" ) {
											echo " selected";
										} ?><?php if ( $dependence ) {
											echo " dependence";
										} ?>"><span><?php esc_html_e( 'No', 'bazaar' ) ?></span></label>
                                <input type="checkbox" id="checkbox" class="checkbox"
                                        name="<?php echo esc_attr( $name ); ?>_flagproduct" value="product"<?php if ( bazaar_qodef_option_get_value( $name ) == "product" ) {
									echo " selected";
								} ?>/>
                                <input type="hidden" class="checkboxhidden_flagproduct" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldRange extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {
		$range_min      = 0;
		$range_max      = 1;
		$range_step     = 0.01;
		$range_decimals = 2;
		if ( isset( $args["range_min"] ) ) {
			$range_min = $args["range_min"];
		}

		if ( isset( $args["range_max"] ) ) {
			$range_max = $args["range_max"];
		}

		if ( isset( $args["range_step"] ) ) {
			$range_step = $args["range_step"];
		}

		if ( isset( $args["range_decimals"] ) ) {
			$range_decimals = $args["range_decimals"];
		}
		?>

        <div class="qodef-page-form-section">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="qodef-slider-range-wrapper">
                                <div class="form-inline">
                                    <input type="text" class="form-control qodef-form-element qodef-form-element-xsmall pull-left qodef-slider-range-value" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                                    <div class="qodef-slider-range small" data-step="<?php echo esc_attr( $range_step ); ?>" data-min="<?php echo esc_attr( $range_min ); ?>" data-max="<?php echo esc_attr( $range_max ); ?>" data-decimals="<?php echo esc_attr( $range_decimals ); ?>" data-start="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldRangeSimple extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) { ?>

        <div class="col-lg-3" id="qodef_<?php echo esc_attr( $name ); ?>"<?php if ( $hidden ) { ?> style="display: none"<?php } ?>>
            <div class="qodef-slider-range-wrapper">
                <div class="form-inline">
                    <em class="qodef-field-description"><?php echo esc_html( $label ); ?></em>
                    <input type="text" class="form-control qodef-form-element qodef-form-element-xxsmall pull-left qodef-slider-range-value" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                    <div class="qodef-slider-range xsmall" data-step="0.01" data-max="1" data-start="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"></div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldRadio extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$checked     = $value = "";
		$value_saved = bazaar_qodef_option_has_value( $name );
		if ( $value_saved ) {
			$value   = bazaar_qodef_option_get_value( $name );
			$checked = $value == 'yes' ? "checked" : "";
		}

		$html = '<input type="radio" name="' . $name . '" value="' . $value . '" ' . $checked . ' /> ' . $label . '<br />';
		echo wp_kses( $html, array(
			'input' => array(
				'type'    => true,
				'name'    => true,
				'value'   => true,
				'checked' => true
			),
			'br'    => true
		) );
	}
}

class BazaarQodefFieldRadioGroup extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {
		$dependence = isset( $args["dependence"] ) && $args["dependence"] ? true : false;
		$show       = ! empty( $args["show"] ) ? $args["show"] : array();
		$hide       = ! empty( $args["hide"] ) ? $args["hide"] : array();

		$use_images    = isset( $args["use_images"] ) && $args["use_images"] ? true : false;
		$hide_labels   = isset( $args["hide_labels"] ) && $args["hide_labels"] ? true : false;
		$hide_radios   = $use_images ? 'display: none' : '';
		$checked_value = bazaar_qodef_option_get_value( $name );
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>" <?php if ( $hidden ) { ?> style="display: none"<?php } ?>>
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
							<?php if ( is_array( $options ) && count( $options ) ) { ?>
                                <div class="qodef-radio-group-holder <?php if ( $use_images ) {
									echo "with-images";
								} ?>">
									<?php foreach ( $options as $key => $atts ) {
										$selected = false;
										if ( $checked_value == $key ) {
											$selected = true;
										}

										$show_val = "";
										$hide_val = "";
										if ( $dependence ) {
											if ( array_key_exists( $key, $show ) ) {
												$show_val = $show[ $key ];
											}

											if ( array_key_exists( $key, $hide ) ) {
												$hide_val = $hide[ $key ];
											}
										}
										?>
                                        <label class="radio-inline">
                                            <input <?php echo bazaar_qodef_get_inline_attr( $show_val, 'data-show' ); ?> <?php echo bazaar_qodef_get_inline_attr( $hide_val, 'data-hide' ); ?>
												<?php if ( $selected ) {
													echo "checked";
												} ?> <?php bazaar_qodef_inline_style( $hide_radios ); ?>
                                                    type="radio" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $key ); ?>"
												<?php if ( $dependence ) {
													bazaar_qodef_class_attribute( "dependence" );
												} ?>> <?php if ( ! empty( $atts["label"] ) && ! $hide_labels ) {
												echo esc_attr( $atts["label"] );
											} ?>

											<?php if ( $use_images ) { ?>
                                                <img title="<?php if ( ! empty( $atts["label"] ) ) {
													echo esc_attr( $atts["label"] );
												} ?>" src="<?php echo esc_url( $atts['image'] ); ?>" alt="<?php echo esc_attr( "$key image" ) ?>"/>
											<?php } ?>
                                        </label>
									<?php } ?>
                                </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldCheckBoxGroup extends BazaarQodefFieldType {

	public function render( $name, $label = '', $description = '', $options = array(), $args = array(), $hidden = false ) {
		if ( ! ( is_array( $options ) && count( $options ) ) ) {
			return;
		}

		$dependence = isset( $args["dependence"] ) && $args["dependence"] ? true : false;
		$show       = ! empty( $args["show"] ) ? $args["show"] : array();

		$saved_value = bazaar_qodef_option_get_value( $name );

		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>"<?php if ( $hidden ) { ?> style="display: none"<?php } ?>>
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="qodef-checkbox-group-holder">
                                <div class="checkbox-inline" style="display: none">
                                    <label>
                                        <input checked type="checkbox" value="" name="<?php echo esc_attr( $name . '[]' ); ?>">
                                    </label>
                                </div>
								<?php foreach ( $options as $option_key => $option_label ) : ?>
									<?php
									if ( $option_label !== '' ) {
										$i            = 1;
										$checked      = is_array( $saved_value ) && in_array( $option_key, $saved_value );
										$checked_attr = $checked ? 'checked' : '';

										$show_val = "";
										if ( $dependence ) {
											if ( array_key_exists( $option_key, $show ) ) {
												$show_val = $show[ $option_key ];
											}
										}
										?>
                                        <div class="checkbox-inline">
                                            <label>
                                                <input <?php echo bazaar_qodef_get_inline_attr( $show_val, 'data-show' ); ?>
													<?php echo esc_attr( $checked_attr ); ?> type="checkbox"
                                                        id="<?php echo esc_attr( $option_key ) . '-' . $i; ?>"
                                                        value="<?php echo esc_attr( $option_key ); ?>" name="<?php echo esc_attr( $name . '[]' ); ?>"
													<?php if ( $dependence ) {
														bazaar_qodef_class_attribute( "dependence multiselect" );
													} ?>>
                                                <label for="<?php echo esc_attr( $option_key ) . '-' . $i; ?>"><?php echo esc_html( $option_label ); ?></label>
                                            </label>
                                        </div>
										<?php
										$i ++;
									}
								endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldCheckBox extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {

		$checked = "";

		if ( '1' === bazaar_qodef_option_get_value( $name ) ) {
			$checked = "checked";
		}

		$html = '<div class ="qodef-page-form-section">';
		$html .= '<div class="qodef-section-content">';
		$html .= '<div class="container-fluid">';
		$html .= '<div class="row">';
		$html .= '<div class="col-lg-3">';
		$html .= '<input id="' . esc_attr( $name ) . '" class="qodef-single-checkbox-field" type="checkbox" name="' . esc_attr( $name ) . '" value="1" ' . $checked . ' />';
		$html .= '<label for="' . esc_attr( $name ) . '"> ' . esc_html( $label ) . '</label><br />';
		$html .= '<input class="qodef-checkbox-single-hidden" type="hidden" name="' . esc_attr( $name ) . '" value="0"/>';
		$html .= '</div>'; //close col-lg-3
		$html .= '</div>'; //close row
		$html .= '</div>'; //close container-fluid
		$html .= '</div>'; //close qodef-section-content
		$html .= '</div>'; //close qodef-page-form-section

		echo wp_kses( $html, array(
			'input' => array(
				'type'     => true,
				'id'       => true,
				'name'     => true,
				'value'    => true,
				'checked'  => true,
				'class'    => true,
				'disabled' => true
			),
			'div'   => array(
				'class' => true
			),
			'br'    => true,
			'label' => array(
				'for' => true
			)
		) );
	}
}

class BazaarQodefFieldDate extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {
		$col_width = 2;
		if ( isset( $args["col_width"] ) ) {
			$col_width = $args["col_width"];
		}
		?>

        <div class="qodef-page-form-section" id="qodef_<?php echo esc_attr( $name ); ?>"<?php if ( $hidden ) { ?> style="display: none"<?php } ?>>
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr( $col_width ); ?>">
                            <input type="text" id="portfolio_date" class="datepicker form-control qodef-input qodef-form-element" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( bazaar_qodef_option_get_value( $name ) ); ?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

class BazaarQodefFieldFile extends BazaarQodefFieldType {

	public function render( $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false ) {
		$value     = bazaar_qodef_option_get_value( $name );
		$has_value = bazaar_qodef_option_has_value( $name );
		?>

        <div class="qodef-page-form-section">


            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $label ); ?></h4>

                <p><?php echo esc_html( $description ); ?></p>
            </div>
            <!-- close div.qodef-field-desc -->

            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="qodef-media-uploader">
                                <div<?php if ( ! $has_value ) { ?> style="display: none"<?php } ?>
                                        class="qodef-media-image-holder">
                                    <img src="<?php if ( $has_value ) {
										echo esc_url( bazaar_qodef_option_get_uploaded_file_icon( $value ) );
									} ?>" alt="<?php esc_attr_e( 'Image thumbnail', 'bazaar' ); ?>"
                                            class="qodef-media-image img-thumbnail"/>
									<?php if ( $has_value ) { ?>
                                        <h4 class="qodef-media-title"><?php echo bazaar_qodef_option_get_uploaded_file_title( $value ) ?></h4> <?php } ?>
                                </div>
                                <div style="display: none"
                                        class="qodef-media-meta-fields">
                                    <input type="hidden" class="qodef-media-upload-url"
                                            name="<?php echo esc_attr( $name ); ?>"
                                            value="<?php echo esc_attr( $value ); ?>"/>
                                </div>
                                <a class="qodef-media-upload-btn btn btn-sm btn-primary"
                                        href="javascript:void(0)"
                                        data-frame-title="<?php esc_html_e( 'Select File', 'bazaar' ); ?>"
                                        data-frame-button-text="<?php esc_html_e( 'Select File', 'bazaar' ); ?>"><?php esc_html_e( 'Upload', 'bazaar' ); ?></a>
                                <a style="display: none;" href="javascript: void(0)"
                                        class="qodef-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'bazaar' ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- close div.qodef-section-content -->

        </div>
		<?php

	}

}

class BazaarQodefFieldFactory {

	public function render( $field_type, $name, $label = "", $description = "", $options = array(), $args = array(), $hidden = false, $repeat = array() ) {

		switch ( strtolower( $field_type ) ) {

			case 'text':
				$field = new BazaarQodefFieldText();
				$field->render( $name, $label, $description, $options, $args, $hidden, $repeat );
				break;
			case 'textsimple':
				$field = new BazaarQodefFieldTextSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'textarea':
				$field = new BazaarQodefFieldTextArea();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'textareasimple':
				$field = new BazaarQodefFieldTextAreaSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'color':
				$field = new BazaarQodefFieldColor();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'colorsimple':
				$field = new BazaarQodefFieldColorSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'image':
				$field = new BazaarQodefFieldImage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'imagesimple':
				$field = new BazaarQodefFieldImageSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'font':
				$field = new BazaarQodefFieldFont();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'fontsimple':
				$field = new BazaarQodefFieldFontSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'select':
				$field = new BazaarQodefFieldSelect();
				$field->render( $name, $label, $description, $options, $args, $hidden, $repeat );
				break;
			case 'selectblank':
				$field = new BazaarQodefFieldSelectBlank();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'selectsimple':
				$field = new BazaarQodefFieldSelectSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'selectblanksimple':
				$field = new BazaarQodefFieldSelectBlankSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'yesno':
				$field = new BazaarQodefFieldYesNo();
				$field->render( $name, $label, $description, $options, $args, $hidden, $repeat );
				break;
			case 'yesnosimple':
				$field = new BazaarQodefFieldYesNoSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'onoff':
				$field = new BazaarQodefFieldOnOff();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'portfoliofollow':
				$field = new BazaarQodefFieldPortfolioFollow();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'zeroone':
				$field = new BazaarQodefFieldZeroOne();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'imagevideo':
				$field = new BazaarQodefFieldImageVideo();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'yesempty':
				$field = new BazaarQodefFieldYesEmpty();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'file':
				$field = new BazaarQodefFieldFile();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'flagpost':
				$field = new BazaarQodefFieldFlagPost();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'flagpage':
				$field = new BazaarQodefFieldFlagPage();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'flagmedia':
				$field = new BazaarQodefFieldFlagMedia();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'flagportfolio':
				$field = new BazaarQodefFieldFlagPortfolio();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'flagproduct':
				$field = new BazaarQodefFieldFlagProduct();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'range':
				$field = new BazaarQodefFieldRange();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'rangesimple':
				$field = new BazaarQodefFieldRangeSimple();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'radio':
				$field = new BazaarQodefFieldRadio();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'checkbox':
				$field = new BazaarQodefFieldCheckBox();
				$field->render( $name, $label, $description, $options, $args, $hidden, $repeat );
				break;
			case 'date':
				$field = new BazaarQodefFieldDate();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'radiogroup':
				$field = new BazaarQodefFieldRadioGroup();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			case 'checkboxgroup':
				$field = new BazaarQodefFieldCheckBoxGroup();
				$field->render( $name, $label, $description, $options, $args, $hidden );
				break;
			default:
				break;
		}
	}
}