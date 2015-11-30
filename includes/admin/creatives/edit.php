<?php
$creative = affwp_get_creative( absint( $_GET['creative_id'] ) );
?>
<div class="wrap">

	<h2><?php _e( 'Edit Creative', 'affiliate-wp' ); ?></h2>

	<form method="post" id="affwp_edit_creative">

		<?php do_action( 'affwp_edit_creative_top', $creative ); ?>

		<div id="poststuff">

			<div id="post-body" class="metabox-holder columns-2">

				<!-- Title area -->
				<div id="post-body-content" style="position: relative">

					<div id="titlediv">
						<div id="titlewrap">
							<label class="screen-reader-text" id="title-prompt-text" for="name"><?php _e( 'Enter creative name - For your identification only', 'affiliate-wp' ); ?></label>
							<input type="text" name="name" size="30" id="title" value="<?php echo esc_attr( stripslashes( $creative->name ) ); ?>" />
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
										<div id="delete-action">
											<a class="submitdelete deletion" href="<?php echo add_query_arg( 'action', 'delete' ); ?>"><?php _e( 'Delete Creative', 'affiliate-wp' ); ?></a>
										</div>
										<div id="publishing-action">
											<?php submit_button( __( 'Update Creative', 'affiliate-wp' ), 'primary', 'publish', false ); ?>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div>

						<div id="previewdiv" class="postbox">
							<h3 style="border-bottom:1px solid #eee"><?php _e( 'Preview Creative', 'affiliate-wp' ); ?></h3>

							<div class="inside">
								<div id="preview_creative">
									<?php if( ! empty( $creative->type ) && $creative->type == 'swf' ) { ?>
										<?php if( ! empty( $creative->swf ) ) { ?>
											<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="<?php echo ( is_numeric( $creative->width ) ? $creative->width : '' ); ?>" height="<?php echo ( is_numeric( $creative->height ) ? $creative->height : '' ); ?>">
												<param name="movie" value="<?php echo esc_url_raw( $creative->swf ); ?>" />
												<!--[if !IE]>-->
												<object type="application/x-shockwave-flash" data="<?php echo esc_url_raw( $creative->swf ); ?>" width="<?php echo ( is_numeric( $creative->width ) ? $creative->width : '' ); ?>" height="<?php echo ( is_numeric( $creative->height ) ? $creative->height : '' ); ?>"></object>
												<!--<![endif]-->
											</object>
										<?php } ?>
									<?php } elseif( ! empty( $creative->type ) && $creative->type == 'html' ) { ?>
										<?php if( ! empty( $creative->html ) ) { ?>
											<?php echo htmlspecialchars_decode( $creative->html ); ?>
										<?php } ?>
									<?php } else { ?>
										<?php if( ! empty( $creative->image ) ) { ?>
											<img src="<?php echo esc_url_raw( $creative->image ); ?>" />
										<?php } ?>
									<?php } ?>
								</div>
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
									<textarea name="description" id="description" class="large-text" rows="8"><?php echo esc_textarea( stripslashes( $creative->description ) ); ?></textarea>
									<p class="description"><?php _e( 'An optional description for this creative. This is displayed below the creative for affiliates.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-status">
									<p><strong><label for="status"><?php _e( 'Status', 'affiliate-wp' ); ?></label></strong></p>
									<select name="status" id="status">
										<option value="active"<?php selected( 'active', $creative->status ); ?>><?php _e( 'Active', 'affiliate-wp' ); ?></option>
										<option value="inactive"<?php selected( 'inactive',  $creative->status ); ?>><?php _e( 'Inactive', 'affiliate-wp' ); ?></option>
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
										<option value="image"<?php selected( 'image', $creative->type ); ?>><?php _e( 'Image', 'affiliate-wp' ); ?></option>
										<option value="swf"<?php selected( 'swf', $creative->type ); ?>><?php _e( 'SWF/Flash', 'affiliate-wp' ); ?></option>
										<option value="html"<?php selected( 'html', $creative->type ); ?>><?php _e( 'HTML', 'affiliate-wp' ); ?></option>
									</select>
									<span class="description">&nbsp;<?php _e( 'Select the content type of the creative.', 'affiliate-wp' ); ?></span>
								</div>

								<div id="affwp-creative-image"<?php echo ( $creative->type != 'image' ? ' style="display:none"' : '' ); ?>>
									<p><strong><label for="image"><?php _e( 'Image', 'affiliate-wp' ); ?></label></strong></p>
									<input id="image" name="image" type="text" class="upload_field regular-text" value="<?php echo esc_attr( $creative->image ); ?>" />
									<input class="upload_image_button button-secondary" type="button" value="Choose Image" />
									<p class="description"><?php _e( 'Select an image for this creative. You can also enter an image URL if your image is hosted elsewhere.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-text"<?php echo ( $creative->type != 'image' ? ' style="display:none"' : '' ); ?>>
									<p><strong><label for="text"><?php _e( 'Text', 'affiliate-wp' ); ?></label></strong></p>
									<input type="text" name="text" id="text" class="regular-text" value="<?php echo esc_attr( stripslashes( $creative->text ) ); ?>" />
									<p class="description"><?php _e( 'Alt/Title text for this creative.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-url"<?php echo ( $creative->type != 'image' ? ' style="display:none"' : '' ); ?>>
									<p><strong><label for="url"><?php _e( 'URL', 'affiliate-wp' ); ?></label></strong></p>
									<input type="text" name="url" id="url" class="regular-text" value="<?php echo esc_url( $creative->url ); ?>" />
									<p class="description"><?php _e( 'Where the creative should link to. The affiliate\'s referral ID will be automatically appended.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-dimensions"<?php echo ( $creative->type != 'swf' ? ' style="display:none"' : '' ); ?>>
									<p><strong><label for="width"><?php _e( 'Dimensions', 'affiliate-wp' ); ?></label></strong></p>
									<input type="text" name="width" id="width" class="small-text" value="<?php echo esc_attr( stripslashes( $creative->width ) ); ?>" />
									<span><?php _e( '&nbsp;x&nbsp;', 'affiliate-wp' ); ?></span>
									<input type="text" name="height" id="height" class="small-text" value="<?php echo esc_attr( stripslashes( $creative->height ) ); ?>" />
									<span class="description">&nbsp;<?php _e( 'Enter the width and height of the creative in pixels.', 'affiliate-wp' ); ?></span>
								</div>

								<div id="affwp-creative-swf"<?php echo ( $creative->type != 'swf' ? ' style="display:none"' : '' ); ?>>
									<p><strong><label for="swf"><?php _e( 'SWF Source', 'affiliate-wp' ); ?></label></strong></p>
									<input id="swf" name="swf" type="text" class="upload_field regular-text" value="<?php echo esc_attr( $creative->swf ); ?>" />
									<input class="upload_swf_button button-secondary" type="button" value="Choose SWF File" />
									<p class="description"><?php _e( 'Select an SWF file for this creative. You can also enter an SWF URL if your file is hosted elsewhere.', 'affiliate-wp' ); ?></p>
								</div>

								<div id="affwp-creative-html"<?php echo ( $creative->type != 'html' ? ' style="display:none"' : '' ); ?>>
									<p><strong><label for="html"><?php _e( 'HTML', 'affiliate-wp' ); ?></label></strong></p>
									<textarea name="html" id="html" class="large-text" rows="8" style="width: 25em"><?php echo htmlspecialchars_decode( $creative->html ); ?></textarea>
									<p class="description"><?php _e( 'Enter the HTML embed code for this creative.', 'affiliate-wp' ); ?></p>
								</div>
							</div>
						</div>

					</div>

				</div>
				<!-- End main content area -->

			</div>

		</div>

		<?php do_action( 'affwp_edit_creative_bottom', $creative ); ?>

		<input type="hidden" name="affwp_action" value="update_creative" />

	</form>

</div>