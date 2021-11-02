<div class="sp-heading d-flex justify-content-between align-items-end">
	<div>
		<h2 class="page-heading"><?php _e( 'Protocol ', 'sponsor' ); ?> </h2>
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

	<div class="sp-block bg-secondary bg-opacity-75 p-3 rounded-3 mb-4 shadow-sm">
		<h5 class="text-white">Protocol Presets <i class="far me-2 fa-info-circle" data-bs-toggle="tooltip" title="Chose any of the following presets to create your own over it."></i></h5>
		<div class="sp-preset">
			<div class="row">
				<div class="col">
					<input type="checkbox" class="btn-check" id="preset1" autocomplete="off">
					<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline m-2" for="preset1">
						<span class="d-inline-block bg-secondary"><img src="<?php echo sponsor()->assets; ?>/images/smell.png" alt="preset1"></span>
					</label>
				</div>
				<div class="col">
					<input type="checkbox" class="btn-check" id="preset2" autocomplete="off">
					<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline m-2" for="preset2">
						<span class="d-inline-block bg-secondary"><img src="<?php echo sponsor()->assets; ?>/images/voice.png" alt="preset2"></span>
					</label>
				</div>
				<div class="col">
					<input type="checkbox" class="btn-check" id="preset3" autocomplete="off">
					<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline m-2" for="preset3">
						<span class="d-inline-block bg-secondary"><img src="<?php echo sponsor()->assets; ?>/images/symptoms.png" alt="preset3"></span>
					</label>
				</div>
				<div class="col">
					<input type="checkbox" class="btn-check" id="preset4" autocomplete="off">
					<label class="btn btn-outline-light p-2 border-0 shadow-none remove-outline m-2" for="preset4">
						<span class="d-inline-block bg-secondary"><img src="<?php echo sponsor()->assets; ?>/images/pcr-test.png" alt="preset4"></span>
					</label>
				</div>
			</div>
		</div>
	</div>
</form>
