<div class="wrap">

	<h2><?php _e( 'New Creative', 'affiliate-wp' ); ?></h2>

	<form method="post" id="affwp_add_creative">

		<?php do_action( 'affwp_new_creative_top' ); ?>

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-2">

				<!-- Title area -->
				<div id="post-body-content" style="position: relative">

					<div id="titlediv">
						<div id="titlewrap">
							<label class id="title-prompt-text" for="name"><?php _e( 'Enter creative name - For your identification only', 'affiliate-wp' ); ?></label>
							<input type="text" name="name" size="30" id="title" />
						</div>
					</div>

				</div>
				<!-- End title area -->

				<!-- Sidebar -->
				<div id="postbox-container-1" class="postbox-container">

					<div id="side-sortables" class="meta-box-sortables">

						<div id="submitdiv" class="postbox">
							<h3 style="border-bottom:1px solid #eee"><?php _e( 'Publish', 'affiliate-wp' ); ?></h3>

							<div class="inside">
								<div class="submitbox">
									<div id="major-publishing-actions">
										<div id="publishing-action">
											<?php submit_button( __( 'Add Creative', 'affiliate-wp' ), 'primary', 'publish', false ); ?>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div>

						<div id="previewdiv" class="postbox">
							<h3 style="border-bottom:1px solid #eee"><?php _e( 'Preview Creative', 'affiliate-wp' ); ?></h3>

							<div class="inside">
								<div id="preview_creative"></div>
							</div>
						</div>

					</div>

				</div>
				<!-- End sidebar -->

				<!-- Main content area -->
				<div id="postbox-container-2" class="postbox-container">

					<div id="normal-sortables" class="meta-box-sortables">

						<div id="detailsdiv" class="postbox">
							<h3 style="border-bottom:1px solid #eee"><?php _e( 'Creative Details', 'affiliate-wp' ); ?></h3>

							<div class="inside">
								<div id="affwp-creative-description">
									<p><strong><label for="description"><?php _e( 'Description', 'affiliate-wp' ); ?></label></strong></p>
									<textarea name="description" id="description" class="large-text" rows="8"></textarea>
									<p class="description"><?php _e( 'An optional description for this creative. This is displayed below the creative for affiliates.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-status">
									<p><strong><label for="status"><?php _e( 'Status', 'affiliate-wp' ); ?></label></strong></p>
									<select name="status" id="status">
										<option value="active"><?php _e( 'Active', 'affiliate-wp' ); ?></option>
										<option value="inactive"><?php _e( 'Inactive', 'affiliate-wp' ); ?></option>
									</select>
									<span class="description">&nbsp;<?php _e( 'Select the status of the creative.', 'affiliate-wp' ); ?></span>
								</div>
							</div>
						</div>

						<div id="contentdiv" class="postbox">
							<h3 style="border-bottom:1px solid #eee"><?php _e( 'Creative Content', 'affiliate-wp' ); ?></h3>

							<div class="inside">
								<div id="affwp-creative-type">
									<p><strong><label for="type"><?php _e( 'Creative Type', 'affiliate-wp' ); ?></label></strong></p>
									<select name="type" id="type">
										<option value="image"><?php _e( 'Image', 'affiliate-wp' ); ?></option>
										<option value="swf"><?php _e( 'SWF/Flash', 'affiliate-wp' ); ?></option>
										<option value="html"><?php _e( 'HTML', 'affiliate-wp' ); ?></option>
									</select>
									<span class="description">&nbsp;<?php _e( 'Select the content type of the creative.', 'affiliate-wp' ); ?></span>
								</div>

								<div id="affwp-creative-image">
									<p><strong><label for="image"><?php _e( 'Image', 'affiliate-wp' ); ?></label></strong></p>
									<input id="image" name="image" type="text" class="upload_field regular-text" />
									<input class="upload_image_button button-secondary" type="button" value="Choose Image" />
									<p class="description"><?php _e( 'Select an image for this creative. You can also enter an image URL if your image is hosted elsewhere.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-text">
									<p><strong><label for="text"><?php _e( 'Text', 'affiliate-wp' ); ?></label></strong></p>
									<input type="text" name="text" id="text" class="regular-text" />
									<p class="description"><?php _e( 'Alt/Title text for this creative.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-url">
									<p><strong><label for="url"><?php _e( 'URL', 'affiliate-wp' ); ?></label></strong></p>
									<input type="text" name="url" id="url" class="regular-text" />
									<p class="description"><?php _e( 'Where the creative should link to. The affiliate\'s referral ID will be automatically appended.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-dimensions" style="display: none">
									<p><strong><label for="width"><?php _e( 'Dimensions', 'affiliate-wp' ); ?></label></strong></p>
									<input type="text" name="width" id="width" class="small-text" />
									<span><?php _e( '&nbsp;x&nbsp;', 'affiliate-wp' ); ?></span>
									<input type="text" name="height" id="height" class="small-text" />
									<span class="description">&nbsp;<?php _e( 'Enter the width and height of the creative in pixels.', 'affiliate-wp' ); ?></span>
								</div>

								<div id="affwp-creative-swf" style="display: none">
									<p><strong><label for="swf"><?php _e( 'SWF Source', 'affiliate-wp' ); ?></label></strong></p>
									<input id="swf" name="swf" type="text" class="upload_field regular-text" />
									<input class="upload_swf_button button-secondary" type="button" value="Choose SWF File" />
									<p class="description"><?php _e( 'Select an SWF file for this creative. You can also enter an SWF URL if your file is hosted elsewhere.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-html" style="display: none">
									<p><strong><label for="html"><?php _e( 'HTML', 'affiliate-wp' ); ?></label></strong></p>
									<textarea name="html" id="html" class="large-text" rows="8" style="width: 25em"></textarea>
									<p class="description"><?php _e( 'Enter the HTML embed code for this creative.', 'affiliate-wp' ); ?></p>
								</div>
							</div>
						</div>

					</div>

				</div>
				<!-- End main content area -->

			</div>

		</div>

		<?php do_action( 'affwp_new_creative_bottom' ); ?>

		<input type="hidden" name="affwp_action" value="add_creative" />

	</form>

</div>