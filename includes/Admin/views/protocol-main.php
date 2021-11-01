<div class="sp-wrap">
	<header class="bg-secondary bg-gradient shadow">
		<div class="sp-header d-flex justify-content-between align-items-center">
			<div class="d-flex align-items-center h-100">
				<img class="p-3" height="100%" src="<?php echo sponsor()->assets . '/images/logo.png'; ?>" alt="logo">
				<h1 class="ms-2 fs-3 mb-0 text-white fw-bold"><?php esc_html_e( 'Administrative Portal', 'sponsor' ); ?>
				</h1>
			</div>
			<div>
				<?php if ( get_request( 'nav' ) == 'protocol' ) : ?>
				<button class="btn btn-success bg-gradient shadow border btn-lg" id="update_protocol">
					<i class="fad fa-edit me-2"></i>
					<?php esc_html_e( 'Update Protocol', 'sponsor' ); ?>
				</button>
				<?php endif; ?>
				<?php if ( get_request( 'nav' ) == 'protocol-new' ) : ?>
				<button class="btn btn-success bg-gradient shadow border btn-lg" id="save_protocol">
				<i class="fad fa-save me-2"></i>
					<?php esc_html_e( 'Save Protocol', 'sponsor' ); ?>
				</button>
				<?php endif; ?>
			</div>
		</div>
	</header>

	<div class="sp-main p-5 row g-0">
		<div class="sp-nav col-3 shadow">
			<div class="list-group list-group-flush">
				<a href="<?php echo esc_url( get_url( 'protocol' ) ); ?>"
					class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'protocol' ) ); ?>">
					<i class="far fa-shield-check"></i>
					<?php echo esc_html( 'Protocol' ); ?>
				</a>
				<a href="<?php echo esc_url( get_url( 'settings' ) ); ?>"
					class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'settings' ) ); ?>">
					<i class="far fa-cog"></i>
					<?php echo esc_html( 'Settings' ); ?>
				</a>
				<a href="<?php echo esc_url( wp_logout_url( esc_url( get_current_url() ) ) ); ?>"
					class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'logout' ) ); ?>">
					<i class="fas fa-sign-out-alt"></i>
					<?php echo esc_html( 'Logout' ); ?>
				</a>
			</div>
		</div>
		<div class="sp-body col-9 ps-4 pt-3">
			<?php
			switch ( get_request( 'nav' ) ) {
				case null:
					include __DIR__ . '/welcome.php';
					break;
				case 'protocol-new':
					include __DIR__ . '/protocol/new.php';
					break;
				case 'protocol':
					include __DIR__ . '/protocol/edit.php';
					break;
				case 'settings':
					include __DIR__ . '/settings.php';
					break;
				default:
					include __DIR__ . '/404.php';
					break;
			}
			?>
		</div>
	</div>

	<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
		<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header bg-success text-white bg-opacity-75 border-0">
			<i class="far fa-tint me-2"></i>
			<strong class="me-auto">Success!</strong>
			<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body bg-success text-dark bg-opacity-25">
			Hello, world! This is a toast message.
			</div>
		</div>
	</div>

</div>
