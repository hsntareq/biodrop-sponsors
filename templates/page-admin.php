<?php sp_header(); ?>
	<main class="bs-main vh-100 overflow-hidden">
		<header class="bg-dark bg-opacity-75 py-3 shadow">
			<div class="container">
				<div class="d-flex align-items-center text-white">
					<a href="<?php echo home_url( 'bs-admin' ); ?>">
						<img class="app-logo me-5" src="<?php echo sponsor()->url . 'assets/images/logo.png'; ?>" alt="logo">
					</a>
					<h3 class="text-shadow mb-0">Administrative Portal</h3>
				</div>
			</div>
		</header>

		<div class="flex-grow-1 main-content pb-5 overflow-scroll">
			<div class="container">
				<div class="row g-5">
					<div class="col-sm-4 col-md-3">
						<div class="bs-nav shadow-sm">
							<div class="list-group list-group-flush">
								<a href="<?php echo esc_url( get_nav_url( 'entry' ) ); ?>"
									class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'entry' ) ); ?>">
									<i class="far fa-door-open"></i>
									<?php echo esc_html( 'Entry Status' ); ?>
								</a>
								<a href="<?php echo esc_url( get_nav_url( 'users' ) ); ?>"
									class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'users' ) ); ?>">
									<i class="far fa-users"></i>
									<?php echo esc_html( 'Users' ); ?>
								</a>
								<a href="<?php echo esc_url( get_nav_url( 'protocol' ) ); ?>"
									class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'protocol' ) ); ?>">
									<i class="far fa-shield-check"></i>
									<?php echo esc_html( 'Protocol' ); ?>
								</a>
								<a href="<?php echo esc_url( get_nav_url( 'settings' ) ); ?>"
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
					</div>
					<div class="col-sm-8 col-md-9">

						<div class="content-area">

						<?php
						switch ( get_request( 'page' ) ) {
							case null:
								include __DIR__ . '/pages/welcome.php';
								break;

							case 'entry':
								include __DIR__ . '/pages/entry.php';
								break;

							case 'users':
								include __DIR__ . '/pages/users.php';
								break;
							case 'protocol':
								include __DIR__ . '/pages/protocol.php';
								break;
							case 'settings':
								include __DIR__ . '/pages/settings.php';
								break;
							default:
								include __DIR__ . '/pages/404.php';
								break;
						}
						?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer class="text-center bg-dark bg-opacity-75 text-white">
			<p class="fw-lighter fs-6 mb-0 py-1">Copyright &copy; <?php echo date( 'Y' ); ?> Biodrop Backoffice</p>
		</footer>
		<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
			<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-header">
					<strong class="me-auto">Success</strong>
					<!-- <small>11 mins ago</small> -->
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div class="toast-body">

				</div>
			</div>
		</div>
	</main>
<?php sp_footer(); ?>
