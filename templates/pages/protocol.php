<h1><?php echo esc_html( 'Protocol Settings' ); ?></h1>
<p><?php echo esc_html( 'Set entry protocol requirements and thresholds' ); ?></p>
<form id="protocol_form">
	<div class="bs-presets">
		<?php if ( $_GET['edit'] ) { ?>
		<div class="input-group mb-4">
			<label class="input-group-text" for="select_protocol">
				<?php echo esc_attr( 'Select an Existing Protocol from here:' ); ?>
			</label>
			<select class="form-select" id="select_protocol">
				<option selected> -- Choose a protocol -- </option>
				<option value="1">One</option>
				<option value="2">Two</option>
				<option value="3">Three</option>
			</select>
		</div>
		<?php } ?>
		<div class="sp-block bg-secondary bg-opacity-75 p-3 rounded-3 mb-4 shadow-sm">
			<h5 class="text-white"><?php echo esc_html( 'Protocol Options' ); ?> <i class="far me-2 fa-info-circle" data-bs-toggle="tooltip" title="Chose any of the following presets to create your own over it."></i></h5>
			<div class="sp-preset">
				<div class="row">
					<div class="col">
						<input type="checkbox" class="btn-check" name="task_name[]" value="smell" id="preset1" autocomplete="off">
						<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline" for="preset1">
							<span class="d-inline-block bg-secondary">
								<img src="<?php echo sponsor()->assets; ?>/images/smell.png" alt="preset1"></span>
						</label>
					</div>
					<div class="col">
						<input type="checkbox" class="btn-check" name="task_name[]" value="voice" id="preset2" autocomplete="off">
						<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline" for="preset2">
							<span class="d-inline-block bg-secondary">
								<img src="<?php echo sponsor()->assets; ?>/images/voice.png" alt="preset2"></span>
						</label>
					</div>
					<div class="col">
						<input type="checkbox" class="btn-check" name="task_name[]" value="symptom" id="preset3" autocomplete=c"off">
						<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline" for="preset3">
							<span class="d-inline-block bg-secondary">
								<img src="<?php echo sponsor()->assets; ?>/images/symptoms.png" alt="preset3"></span>
						</label>
					</div>
					<div class="col">
						<input type="checkbox" class="btn-check" name="task_name[]" value="pcr_test" id="preset4" autocomplete="off">
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
				<strong class="d-block"><?php echo esc_attr( 'New Protocol Name' ); ?></strong>
				<small><?php echo esc_attr( 'Create a new protocol adding your protocol name here.' ); ?></small>
			</label>
			<div class="col-sm-5">
				<input type="text" name="protocol_name" class="form-control" id="protocol_name" placeholder="Write protocol name...">
			</div>
		</div>
		<div class="row  g-0 py-3 bg-white bg-opacity-75 align-items-center">
			<div class="col">
				<button type="submit" class="btn btn-secondary"><?php echo esc_html( 'Create Protocol' ); ?></button>
				<span class="spinner-border text-secondary visually-hidden align-middle" role="status" aria-hidden="true"></span>
			</div>
		</div>
	</div>


</form>
