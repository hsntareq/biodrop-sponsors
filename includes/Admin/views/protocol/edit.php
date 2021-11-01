<?php
/**
 * File name: Sponsor Edit form
 *
 * @package template
 */

$edit_id        = get_request( 'edit' );
$protocols      = $this->get_protocols();
$user_protocols = $this->get_protocol_by_current_user();

if ( ! empty( $user_protocols ) ) {
	$protocol_edit = ! isset( $_GET['edit'] ) ? $user_protocols[ array_key_first( $user_protocols ) ] : ( ! empty( $edit_id ) ? $this->get_edit_protocol( $edit_id ) : array() );
}
if ( isset( $protocol_edit ) && null !== $protocol_edit ) :
	?>
<div class="sp-heading d-flex justify-content-between align-items-end">
	<div>
		<h2 class="page-heading">Protocol Settings</h2>
		<p class="m-0">Set entry protocol requirements and thresholds</p>
	</div>
	<h6 class="m-0">Your Protocol: <span class="text-success fw-bold">
	<?php echo $protocol_edit->name; ?>
	</span></h6>
</div>

<hr>

<div class="sp-block mb-4">
	<div class="d-flex justify-content-between align-items-center">
		<div class="input-group">
			<span class="input-group-text">Select Protocol</span>
			<select style="max-width: 150px;" class="form-select" id="select_protocol"  data-bs-toggle="tooltip" title="Select a protocol">
				<?php foreach ( $user_protocols as $key => $protocol ) { ?>
					<option <?php echo $protocol->id == $edit_id ? 'selected' : null; ?> value="<?php echo $protocol->id; ?>"><?php echo $protocol->name; ?></option>
				<?php } ?>
			</select>
			<button class="btn btn-danger btn-sm me-5" id="delete_protocol" data-bs-toggle="tooltip" title="Delete this protocol" data-id=<?php echo $protocol_edit->id; ?>>
				<i class="fad fa-trash-alt"></i>
			</button>
		</div>

		<a href="<?php echo esc_url( get_url( 'protocol-new' ) ); ?>"
			class="btn btn-success text-nowrap" data-bs-toggle="tooltip" title="Click here to create a new protocol">
			<i class="fa fa-plus me-2"></i>
			<?php echo esc_html( 'New Protocol' ); ?>
		</a>


	</div>
</div>

<div class="sp-blocks">
	<form id="protocol_form">
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
									  $field_key = $block_key . '_' . $field_key;
									?>
									<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
										<!-- <label class="form-toggle mr-1">
											<input type="hidden" value="off">
											<input type="checkbox" value="on" class="form-toggle-input" <?php // echo ( 'off' === $field['switch'] ) ? '' : 'checked'; ?>>
											<span class="form-toggle-control"></span>
											<span class="label-before text-nowrap ms-3"><?php // echo esc_attr( get_result( $field['label'] ) ); ?></span>
										</label> -->

										<label><?php echo esc_attr( get_result( $field['label'] ) ); ?></label>										<div class="d-flex align-items-center justify-content-end">
										<i class="far me-2 fa-info-circle" data-bs-toggle="tooltip" title="<?php echo esc_attr( get_result( $field['label'] ) ); ?>"></i>
										<?php if ( $field['type'] == 'group' ) { ?>
											<div class="input-group">
												<input type="number" class="form-control border change-field input-mw" name="<?php echo esc_attr( get_result( $field_key ) ); ?>" value="<?php echo $field['default']; ?>">
												<span class="input-group-text"> Within Hour</span>
											</div>
											<?php
										} else {
											?>
										<input type="number" class="form-control input-mw change-field text-right" placeholder="<?php echo esc_attr( 'input...' ); ?>" name="<?php echo esc_attr( get_result( $field_key ) ); ?>" value="<?php echo esc_attr( $protocol_edit->$field_key ); ?>">
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
	</form>
</div>
<?php elseif ( null == $edit_id ) : ?>
		<div class="input-group">
			<span class="input-group-text"><?php echo __( 'Click here to create new protocol:', 'textdomain' ); ?></span>
			<a href="<?php echo esc_url( get_url( 'protocol-new' ) ); ?>"
				class="btn btn-success text-nowrap" data-bs-toggle="tooltip" title="Click here to create a new protocol">
				<i class="fa fa-plus me-2"></i>
				<?php echo esc_html( 'New Protocol' ); ?>
			</a>
		</div>
<?php else : ?>

<div class="sp-heading d-flex justify-content-between align-items-end">
	<div>
		<h2 class="page-heading">Protocol not found</h2>
		<p class="m-0">Sorry NO protocol found with the id "<?php echo $_GET['edit']; ?>"</p>
	</div>
</div>
<?php endif; ?>
