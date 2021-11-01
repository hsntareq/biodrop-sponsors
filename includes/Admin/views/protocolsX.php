<div class="sp-heading d-flex justify-content-between align-items-end">
	<div>
		<h2 class="page-heading">Protocol Settings</h2>
		<p class="m-0">Set entry protocol requirements and thresholds</p>
	</div>
	<h6 class="m-0">Your Protocol: <span class="text-success fw-bold">UF 243.Arts&Science</span></h6>
</div>




<hr>

<div class="sp-block mb-4">
	<div class="d-flex justify-content-start align-items-center">
		<h4 class="m-0">Current Protocol:</h4>

		<div class="d-flex ms-3">
			<div class="input-group">
				<select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
					<?php echo $this->select_options( $this->options_within ); ?>
				</select>
				<button class="btn btn-success" type="button"><i class="fas fa-plus me-2"></i> New
					Protocol</button>
			</div>
		</div>
	</div>
</div>

<div class="sp-block bg-secondary p-3 rounded-3 mb-4 shadow-sm">
	<h5 class="text-white">Protocol Presets</h5>
	<div class="sp-preset">
		<div class="row">
			<div class="col">
				<span class="d-block preset-item active">
					<img src="<?php echo sponsor()->assets; ?>/images/protocol_incl_button_unchecked@2x.png"
						alt="preset1">
				</span>
			</div>
			<div class="col">
				<span class="d-block preset-item">
					<img src="<?php echo sponsor()->assets; ?>/images/protocol_mod_button_unchecked@2x.png"
						alt="preset1">
				</span>
			</div>
			<div class="col">
				<span class="d-block preset-item">
					<img src="<?php echo sponsor()->assets; ?>/images/protocol_vig_button_unchecked@2x.png"
						alt="preset1">
				</span>
			</div>
			<div class="col">
				<span class="d-block preset-item">
					<img src="<?php echo sponsor()->assets; ?>/images/protocol_cust_button_unchecked@2x.png"
						alt="preset1">
				</span>
			</div>
		</div>
	</div>
</div>

<div class="sp-blocks">
	<div class="sp-block-heading d-flex mb-4">
		<i class="fad fa-users me-3 fa-2x mt-1"></i>
		<div>
			<h5 class="mb-0 text-dark">Unvaccinated</h5>
			<p class="text-secondary"> </p>
		</div>
	</div>

	<div class="form-row ms-auto w-lg-75">
		<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
			<label class="form-toggle mr-1">
				<input type="hidden" name="radio_option[radio_key]" value="off">
				<input type="checkbox" name="radio_option[radio_key]" value="on" class="form-toggle-input" checked>
				<span class="form-toggle-control"></span>
				<span class="label-before text-nowrap ms-3">Voice Test</span>
			</label>
			<div class="d-flex align-items-center">
				<label class="mx-3">within</label>
				<select class="form-control">
				<?php echo $this->select_options( $this->options_within ); ?>
				</select>
			</div>
		</div>

		<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
			<label class="form-toggle mr-1">
				<input type="hidden" name="radio_option[radio_key]" value="off">
				<input type="checkbox" name="radio_option[radio_key]" value="on" class="form-toggle-input" checked>
				<span class="form-toggle-control"></span>
				<span class="label-before text-nowrap ms-3">Smell Test</span>
			</label>
			<div class="d-flex align-items-center">
				<label class="mx-3">within</label>
				<select class="form-control">
				<?php echo $this->select_options( $this->options_within ); ?>
				</select>
			</div>
		</div>

		<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
			<label class="form-toggle mr-1">
				<input type="hidden" name="radio_option[radio_key]" value="off">
				<input type="checkbox" name="radio_option[radio_key]" value="on" class="form-toggle-input" checked>
				<span class="form-toggle-control"></span>
				<span class="label-before text-nowrap ms-3">Symptom Track</span>
			</label>
			<div class="d-flex align-items-center">
				<label class="mx-3">within</label>
				<select class="form-control">
				<?php echo $this->select_options( $this->options_within ); ?>
				</select>
			</div>
		</div>

		<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
			<label class="form-toggle mr-1">
				<input type="hidden" name="radio_option[radio_key]" value="off">
				<input type="checkbox" name="radio_option[radio_key]" value="on" class="form-toggle-input" checked>
				<span class="form-toggle-control"></span>
				<span class="label-before text-nowrap ms-3">Saliva Direct</span>
			</label>
			<div class="d-flex align-items-center">
				<label class="mx-3">within</label>
				<select class="form-control">
				<?php echo $this->select_options( $this->options_within ); ?>
				</select>
			</div>
		</div>

		<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
			<label class="form-toggle mr-1">
				<input type="hidden" name="radio_option[radio_key]" value="off">
				<input type="checkbox" name="radio_option[radio_key]" value="on" class="form-toggle-input" checked>
				<span class="form-toggle-control"></span>
				<span class="label-before text-nowrap ms-3">Do not admit</span>
			</label>
			<div class="d-flex align-items-center">

			</div>
		</div>
	</div>

	<hr>



	<div class="sp-block">
		<div class="sp-block-heading d-flex">
			<i class="fad fa-users me-3 fa-2x mt-1"></i>
			<div>
				<h5 class="mb-0 text-dark">Recovered from COVID-19</h5>
				<p class="text-secondary">Negative PCR test result after positive PCR test result</p>
			</div>
		</div>

		<div class="form-row ms-auto w-lg-75">
			<div class="d-flex justify-content-between align-items-center mb-4">
				<div><strong>Recovered:</strong></div>

				<div class="d-flex">
					<div class="input-group">
						<select class="form-select" id="inputGroupSelect04"
							aria-label="Example select with button addon">
							<option selected>within 0 – 10 months</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Voice Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>4 hours</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Smell Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Symptom Track</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Saliva Direct</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<div><strong>Recovered:</strong></div>

				<div class="d-flex">
					<div class="input-group">
						<select class="form-select">
						<?php echo $this->select_options( $this->options_result ); ?>
						</select>
					</div>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Voice Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Smell Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Symptom Track</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Saliva Direct</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<button class="btn btn-success"><i class="fas fa-plus-circle me-2"></i> Add Time
					Period</button>
			</div>
		</div>

	</div><!-- sp-block -->

	<hr>



	<div class="sp-block">
		<div class="sp-block-heading d-flex">
			<i class="fad fa-users me-3 fa-2x mt-1"></i>
			<div>
				<h5 class="mb-0 text-dark">mRNA Vaccinated</h5>
				<p class="text-secondary">Negative PCR test result after positive PCR test result</p>
			</div>
		</div>

		<div class="form-row ms-auto w-lg-75">
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<div><strong>Fully Vaccinated</strong></div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Voice Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Smell Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Symptom Track</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Saliva Direct</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<div><strong>8+ Months Since Vaccination</strong></div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Voice Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Smell Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Symptom Track</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Saliva Direct</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<?php echo $this->select_options( $this->options_result ); ?>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<button class="btn btn-success"><i class="fas fa-plus-circle me-2"></i> Add Time
					Period</button>
			</div>
		</div>

	</div><!-- sp-block -->

	<hr>


	<div class="sp-block">
		<div class="sp-block-heading d-flex">
			<i class="fad fa-users me-3 fa-2x mt-1"></i>
			<div>
				<h5 class="mb-0 text-dark">Single Dose Vaccination</h5>
				<p class="text-secondary">21+ days since vaccination or booster</p>
			</div>
		</div>

		<div class="form-row ms-auto w-lg-75">
		<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<div><strong>Fully Vaccinated</strong></div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Voice Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>4 hours</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Smell Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Symptom Track</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Saliva Direct</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<div><strong>8+ Months Since Vaccination</strong></div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Voice Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>4 hours</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Smell Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Symptom Track</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Saliva Direct</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<button class="btn btn-success"><i class="fas fa-plus-circle me-2"></i> Add Time
					Period</button>
			</div>
		</div>

	</div><!-- sp-block -->

	<hr>


	<div class="sp-block">
		<div class="sp-block-heading d-flex">
			<i class="fad fa-users me-3 fa-2x mt-1"></i>
			<div>
				<h5 class="mb-0 text-dark">Neg. PCR Test</h5>
				<p class="text-secondary"></p>
			</div>
		</div>

		<div class="form-row ms-auto w-lg-75">
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1"></label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>36 hours</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input" checked>
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Voice Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Smell Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Symptom Track</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Saliva Direct</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
		</div>

	</div><!-- sp-block -->

	<hr>

	<div class="sp-block">
		<div class="sp-block-heading d-flex">
			<i class="fad fa-users me-3 fa-2x mt-1"></i>
			<div>
				<h5 class="mb-0 text-dark">Neg. Antigen Test</h5>
				<p class="text-secondary"></p>
			</div>
		</div>

		<div class="form-row ms-auto w-lg-75">
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1"></label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>24 hours</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input" checked>
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Voice Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Smell Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Symptom Track</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Saliva Direct</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
		</div>

	</div><!-- sp-block -->

	<hr>

	<div class="sp-block">
		<div class="sp-block-heading d-flex">
			<i class="fad fa-users me-3 fa-2x mt-1"></i>
			<div>
				<h5 class="mb-0 text-dark">Rapid Home Test</h5>
				<p class="text-secondary"></p>
			</div>
		</div>

		<div class="form-row ms-auto w-lg-75">
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
			<label class="form-toggle mr-1"></label>

			<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>24 hours</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input" checked>
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Voice Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Smell Test</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Symptom Track</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
			<div class="sp-row d-flex align-items-center justify-content-between mb-4">
				<label class="form-toggle mr-1">
					<input type="hidden" name="radio_option[radio_key]" value="off">
					<input type="checkbox" class="form-toggle-input" name="radio_option[radio_key]" value="on" class="form-toggle-input">
					<span class="form-toggle-control"></span>
					<span class="label-before text-nowrap ms-3">Saliva Direct</span>
				</label>
				<div class="d-flex align-items-center">
					<label class="mx-3">within</label>
					<select class="form-control">
						<option>Select</option>
						<option>Option value</option>
						<option>Option value one</option>
						<option>Option value two</option>
						<option>Option value three</option>
					</select>
				</div>
			</div>
		</div>

	</div><!-- sp-block -->

	<hr>


</div>
