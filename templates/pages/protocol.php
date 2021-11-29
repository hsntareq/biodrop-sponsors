<?php
/**
 * Template: Protocol create or edit
 *
 * @package WordPress Plugin
 * @subpackage protocol
 * @since 1.0.0
 */

?>
<div class="mb-4 border-bottom">
	<h1><?php echo esc_html( 'Protocol Settings' ); ?></h1>
	<p><?php echo esc_html( 'Set entry protocol requirements and thresholds' ); ?></p>
</div>
<form id="protocol_form">

	<div class="bs-presets">
		<?php
		$user             = wp_get_current_user();
		$table_protocols  = $wpdb->prefix . 'bs_protocols';
		$table_tasks      = $wpdb->prefix . 'bs_tasks';
		$protocols        = get_fields_by_user( $table_protocols, $user->ID );
		$current_protocol = isset( $_GET['edit'] ) && null !== $_GET['edit'] ? esc_attr( $_GET['edit'] ) : 0;
		$field_label      = ! empty( get_edit_data( 'edit' ) ) ? 'Update Protocol' : 'Create Protocol';
		if ( ! empty( $protocols ) ) {

			foreach ( $protocols as $protocol ) {
				if ( isset( $_GET['edit'] ) && $protocol->id === $current_protocol ) {
					$this_protocol = $protocol;
				}
			}

			$task_data = isset( $this_protocol ) && ! empty( $this_protocol ) ? get_data_by_field( $this_protocol->id, 'protocol_id', $table_tasks ) : array();
			$task_data = isset( $this_protocol ) ? array_shift( $task_data ) : array();

			if ( isset( $task_data ) && is_object( $task_data ) ) {
				$task_code = json_decode( $task_data->task_code );
			}
			?>
			<div class="input-group mb-4">
				<label class="input-group-text" for="select_protocol">
					<?php echo esc_attr( 'Select an Existing Protocol:' ); ?>
				</label>
				<select class="form-select" id="select_protocol" name="select_protocol">
				<option value="0" selected> -- Choose a protocol -- </option>
					<?php
					foreach ( $protocols as $protocol ) {
						?>
					<option <?php echo isset( $_GET['edit'] ) && $_GET['edit'] == $protocol->id ? 'selected' : ''; ?> value="<?php echo esc_attr( $protocol->id ); ?>"><?php echo esc_attr( $protocol->title ); ?></option>
					<?php } ?>
				</select>
				<?php if ( ! empty( get_edit_data( 'edit' ) ) ) { ?>
					<label class="input-group-text">
									<?php echo esc_attr( 'OR' ); ?>
					</label>
					<a class="btn btn-success" href="<?php echo esc_url( get_nav_url( 'protocol' ) ); ?>"><?php echo esc_attr( '+ Create a New Protocol' ); ?></a>
				<?php } ?>
			</div>
			<?php
		}
		?>
		<div class="sp-block bg-secondary bg-opacity-75 p-3 rounded-3 mb-4 shadow-sm">
			<h5 class="text-white"><?php echo esc_html( 'Protocol Options' ); ?> <i class="far me-2 fa-info-circle" data-bs-toggle="tooltip" title="Chose any of the following presets to create your own over it."></i></h5>
				<div class="sp-preset">
					<div class="row">
						<div class="col">
							<input <?php echo isset( $task_code ) && in_array( 'smell', $task_code ) ? 'checked' : ''; ?> type="checkbox" class="btn-check" name="task_name[]" value="smell" id="preset1" autocomplete="off">
							<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline" for="preset1">
								<span class="d-inline-block bg-secondary">
									<img src="<?php echo sponsor()->assets; ?>/images/smell.png" alt="preset1"></span>
							</label>
						</div>
						<div class="col">
							<input <?php echo isset( $task_code ) && in_array( 'voice', $task_code ) ? 'checked' : ''; ?> type="checkbox" class="btn-check" name="task_name[]" value="voice" id="preset2" autocomplete="off">
							<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline" for="preset2">
								<span class="d-inline-block bg-secondary">
									<img src="<?php echo sponsor()->assets; ?>/images/voice.png" alt="preset2"></span>
							</label>
						</div>
						<div class="col">
							<input <?php echo isset( $task_code ) && in_array( 'symptom', $task_code ) ? 'checked' : ''; ?> type="checkbox" class="btn-check" name="task_name[]" value="symptom" id="preset3" autocomplete=c"off">
							<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline" for="preset3">
								<span class="d-inline-block bg-secondary">
									<img src="<?php echo sponsor()->assets; ?>/images/symptoms.png" alt="preset3"></span>
							</label>
						</div>
						<div class="col">
							<input <?php echo isset( $task_code ) && in_array( 'pcr_test', $task_code ) ? 'checked' : ''; ?> type="checkbox" class="btn-check" name="task_name[]" value="pcr_test" id="preset4" autocomplete="off">
							<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline" for="preset4">
								<span class="d-inline-block bg-secondary">
									<img src="<?php echo sponsor()->assets; ?>/images/pcr-test.png" alt="preset4"></span>
							</label>
						</div>
					</div>
				</div>

		</div>
	</div>

	<div class="bs-form px-4 bg-white shadow-sm">
		<div class="row border-bottom g-0 py-3 bg-white bg-opacity-75 align-items-center">
			<label for="protocol_name" class="col-sm-7 col-form-label pe-3">
				<strong class="d-block"><?php echo esc_attr( $field_label ); ?></strong>
				<small><?php echo esc_attr( 'Create a new protocol adding your protocol name here.' ); ?></small>
			</label>
			<div class="col-sm-5">
				<input type="text" name="protocol_name" class="form-control" id="protocol_name" placeholder="Write protocol name..." value="<?php echo isset( $this_protocol->title ) ? esc_attr( $this_protocol->title ) : ''; ?>">
			</div>
		</div>
		<div class="d-flex py-3 bg-white bg-opacity-75 align-items-center justify-content-between">
			<div class="action_buttons">
				<?php if ( 0 != $current_protocol ) { ?>
					<button form="protocol_form" id="update_protocol" name="update_protocol" type="submit" class="btn btn-secondary"><?php echo esc_html( 'Update Protocol' ); ?></button>
				<?php } else { ?>
					<button form="protocol_form" id="create_protocol" name="create_protocol" type="submit" class="btn btn-secondary"><?php echo esc_html( 'Create Protocol' ); ?></button>
				<?php } ?>
				<span class="spinner-border text-secondary visually-hidden align-middle" role="status" aria-hidden="true"></span>
			</div>
			<?php
			if ( isset( $_GET['edit'] ) && ! empty( $_GET['edit'] ) ) {
				?>
			<div class="delete_button">
				<button id="delete_protocol" type="submit" data-id="<?php echo esc_attr( $_GET['edit'] ); ?>" class="btn btn-danger"><?php echo esc_html( 'Delete' ); ?></button>
			</div>
			<?php } ?>
		</div>
	</div>
</form>


