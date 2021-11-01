<div class="sp-wrap">
	<header class="bg-secondary bg-gradient shadow">
		<div class="sp-header d-flex justify-content-between align-items-center w-75">
			<div class="d-flex align-items-center h-100">
				<img class="p-3" height="100%" src="<?php echo sponsor()->assets . '/images/logo.png'; ?>" alt="logo">
				<h1 class="ms-2 fs-3 mb-0 text-white fw-bold"><?php esc_html_e( 'Administrative Portal', 'sponsor' ); ?>
				</h1>
			</div>
			<div>
				<?php if ( get_request( 'nav' ) == 'protocols' ) : ?>
				<button class="btn btn-success shadow border btn-lg" id="save_protocol">
					<i class="fas fa-save me-2"></i>
					<?php esc_html_e( 'Save Sponsor', 'sponsor' ); ?>
				</button>
				<?php endif; ?>
			</div>
		</div>
	</header>

	<div class="sp-main p-5 row">
		<div class="col-6">
			<div class="card p-0">
				<div class="card-header">
					<?php echo esc_html__( 'Entry Protocols Input Form', 'sponsor' ); ?>
				</div>
				<div class="card-body">
					<h5 class="card-title">Special title treatment</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					<a href="#" class="btn btn-primary">Go somewhere</a>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="card  p-0">
				<div class="card-header">
					Featured
				</div>
				<div class="card-body">
					<h5 class="card-title">Special title treatment</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					<a href="#" class="btn btn-primary">Go somewhere</a>
				</div>
			</div>
		</div>
	</div>
</div>
