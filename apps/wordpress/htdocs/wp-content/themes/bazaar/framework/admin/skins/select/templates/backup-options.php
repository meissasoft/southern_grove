<div class="qodef-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="import">
			<div class="qodef-tab-content">
				<h2 class="qodef-page-title"><?php esc_html_e('Backup Options', 'bazaar'); ?></h2>
				<form method="post" class="qodef_ajax_form qodef-backup-options-page-holder">
					<div class="qodef-page-form">
						<div class="qodef-page-form-section-holder">
							<h3 class="qodef-page-section-title"><?php esc_html_e('Export/Import Options', 'bazaar'); ?></h3>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<h4><?php esc_html_e('Export', 'bazaar'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'bazaar'); ?></p>
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control qodef-form-element" rows="10" readonly><?php echo qodef_core_export_options(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<h4><?php esc_html_e('Import', 'bazaar'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'bazaar'); ?></p>
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_theme_options" id="import_theme_options" class="form-control qodef-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="qodef-import-theme-options-btn"><?php esc_html_e('Import', 'bazaar'); ?></button>
									<?php wp_nonce_field('qodef_import_theme_options_secret_value', 'qodef_import_theme_options_secret', false); ?>
									<span class="qodef-bckp-message"></span>
								</div>
							</div>
							<div class="qodef-page-form-section qodef-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'bazaar') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will overide all your existing options.', 'bazaar'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="qodef-page-form-section-holder">
							<h3 class="qodef-page-section-title"><?php esc_html_e('Export/Import Custom Sidebars', 'bazaar'); ?></h3>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<h4><?php esc_html_e('Export', 'bazaar'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'bazaar'); ?></p>
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control qodef-form-element" rows="10" readonly><?php echo qodef_core_export_custom_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<h4><?php esc_html_e('Import', 'bazaar'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'bazaar'); ?></p>
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_custom_sidebars" id="import_custom_sidebars" class="form-control qodef-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="qodef-import-custom-sidebars-btn"><?php esc_html_e('Import', 'bazaar'); ?></button>
									<?php wp_nonce_field('qodef_import_custom_sidebars_secret_value', 'qodef_import_custom_sidebars_secret', false); ?>
									<span class="qodef-bckp-message"></span>
								</div>
							</div>
							<div class="qodef-page-form-section qodef-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'bazaar') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing custom sidebars.', 'bazaar'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="qodef-page-form-section-holder">
							<h3 class="qodef-page-section-title"><?php esc_html_e('Export/Import Widgets', 'bazaar'); ?></h3>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<h4><?php esc_html_e('Export', 'bazaar'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'bazaar'); ?></p>
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_widgets" id="export_widgets" class="form-control qodef-form-element" rows="10" readonly><?php echo qodef_core_export_widgets_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<h4><?php esc_html_e('Import', 'bazaar'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'bazaar'); ?></p>
								</div>
								<div class="qodef-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_widgets" id="import_widgets" class="form-control qodef-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="qodef-page-form-section">
								<div class="qodef-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="qodef-import-widgets-btn"><?php esc_html_e('Import', 'bazaar'); ?></button>
									<?php wp_nonce_field('qodef_import_widgets_secret_value', 'qodef_import_widgets_secret', false); ?>
									<span class="qodef-bckp-message"></span>
								</div>
							</div>
							<div class="qodef-page-form-section qodef-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'bazaar') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing widgets.', 'bazaar'); ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>