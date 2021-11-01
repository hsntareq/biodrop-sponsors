<div class="sp-heading d-flex justify-content-between align-items-end">
	<div>
		<h2 class="page-heading"><?php echo _e( 'New Protocol', 'sponsor' ); ?> </h2>
		<p class="m-0"><?php echo _e( 'Add entry protocol requirements and thresholds', 'sponsor' ); ?></p>
	</div>
</div>

<?php
$protocols = $this->get_protocols();
?>
<hr>
<form id="protocol_form">
	<input type="hidden" name="type" value="user">
	<div class="sp-block mb-4">
		<div class="d-flex justify-content-between align-items-center">
			<h5 class="m-0 text-nowrap me-3"><?php echo esc_html( 'Protocol Name:' ); ?></h5>
			<input class="form-control" placeholder="type your protocol name" name="name">
		</div>
	</div>

	<div class="sp-block bg-secondary p-3 rounded-3 mb-4 shadow-sm">
		<h5 class="text-white">Protocol Presets <i class="far me-2 fa-info-circle" data-bs-toggle="tooltip" title="Chose any of the following presets to create your own over it."></i></h5>
		<div class="sp-preset">
			<div class="row">
				<div class="col">
					<span class="d-block preset-item active" data-preset="inclusive">
						<img src="<?php echo sponsor()->assets; ?>/images/protocol_incl_button_unchecked@2x.png"
							alt="preset1">
					</span>
				</div>
				<div class="col">
					<span class="d-block preset-item" data-preset="moderate">
						<img src="<?php echo sponsor()->assets; ?>/images/protocol_mod_button_unchecked@2x.png"
							alt="preset1">
					</span>
				</div>
				<div class="col">
					<span class="d-block preset-item" data-preset="vigilant">
						<img src="<?php echo sponsor()->assets; ?>/images/protocol_vig_button_unchecked@2x.png"
							alt="preset1">
					</span>
				</div>
				<div class="col">
					<span class="d-block preset-item" data-preset="custom">
						<img src="<?php echo sponsor()->assets; ?>/images/protocol_cust_button_unchecked@2x.png"
							alt="preset1">
					</span>
				</div>
			</div>
		</div>
	</div>

	<div class="sp-blocks">
		<?php
		$protocol_options = $this->protocol_options();
		foreach ( $protocol_options as $option_key => $options ) :
			?>
			<div class="sp-block" id="option_ <?php echo esc_attr( $option_key ); ?>">
				<div class="sp-block-heading d-flex mt-4 align-items-center">
					<i class="fad fa-users me-3 fa-2x"></i>
					<div>
						<h5 class="mb-0 text-dark"><?php echo esc_html( get_result( $options['label'] ) ); ?></h5>
						<p class="text-secondary mb-0"><?php echo esc_html( get_result( $options['desc'] ) ); ?></p>
					</div>
				</div>

				<div class="form-data-row">
					<?php

					if ( isset( $options['blocks'] ) ) :
						foreach ( $options['blocks'] as $block_key => $block ) :
							?>
							<div class="card p-0 mw-100">
							<div class="card-header">
								<h5 class="m-0"><?php echo esc_html( $block['heading'] ); ?></h5>
							</div>
							<div class="card-body">

							<?php
							if ( isset( $block['fields'] ) ) :
								foreach ( $block['fields'] as $field_key => $field ) :
									// pr( $field );
									?>
									<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
										<!-- <label class="form-toggle mr-1">
											<input type="hidden" value="off">
											<input type="checkbox" value="on" class="form-toggle-input" <?php // echo ( 'off' === $field['switch'] ) ? '' : 'checked'; ?>>
											<span class="form-toggle-control"></span>
											<span class="label-before text-nowrap ms-3"><?php // echo esc_attr( get_result( $field['label'] ) ); ?></span>
										</label> -->
										<?php // if ( false !== $field['value'] ) : ?>
										<label><?php echo esc_attr( get_result( $field['label'] ) ); ?></label>
										<div class="d-flex align-items-center justify-content-end">
										<i class="far me-2 fa-info-circle" data-bs-toggle="tooltip" title="<?php echo esc_attr( get_result( $field['label'] ) ); ?>"></i>
										<?php if ( $field['type'] == 'group' ) { ?>
											<div class="input-group">
												<input type="number" class="form-control border change-field input-mw" name="<?php echo esc_attr( get_result( $block_key ) ) . '_' . esc_attr( get_result( $field_key ) ); ?>" value="<?php echo $field['default']; ?>">
												<span class="input-group-text"> Within Hour</span>
											</div>
											<?php
										} else {
											?>
										<input type="number" class="form-control input-mw change-field text-right" placeholder="<?php echo esc_attr( 'input...' ); ?>" name="<?php echo esc_attr( get_result( $block_key ) ) . '_' . esc_attr( get_result( $field_key ) ); ?>" value="<?php echo esc_attr( get_result( $field['default'] ) ); ?>">
										<?php } ?>

										</div>
										<?php // endif; ?>
									</div>
									<?php
								endforeach;

							endif;
							echo '</div>';
							echo '</div>';
						endforeach;
					endif;

					?>

			</div>
		<?php endforeach; ?>
	</div>
</form>
