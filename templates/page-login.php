<?php sp_header(); ?>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">

			<?php
			if ( isset( $_SESSION['authlog'] ) && ! empty( $_SESSION['authlog'] ) ) {
				echo '<div class="alert alert-warning mt-5 alert-dismissible fade show" role="alert">' . $_SESSION['authlog'] . '
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				$_SESSION['authlog'] = '';
			}
			?>

				<div class="sp-login mt-5 p-5 text-center text-white shadow bg-opacity-75 bg-dark">
					<img class="app-logo" src="<?php echo sponsor()->url . 'assets/images/logo-app.png'; ?>" alt="logo-app">
					<h4 class="mb-4 text-shadow">Login to <br> Sponsor's Portal</h4>
					<form name="loginform" id="loginform" action="<?php // echo wp_login_url(); ?>" method="post">
						<input type="hidden" name="redirect_to" value="<?php echo site_url( 'bs-admin' ); ?>">
						<input type="hidden" name="testcookie" value="1">
						<div class="mb-4">
							<input type="text" name="log" id="user_login" class="border-0 rounded shadow form-control" size="20" autocapitalize="off" placeholder="Username or Email Address">
						</div>
						<div class="mb-4">
							<input type="password" name="pwd" id="user_pass" class="border-0 rounded shadow form-control password-input" placeholder="Password" size="20">
						</div>
						<div class="mb-2">
							<button type="submit" name="wp-submit" id="wp-submit" class="btn btn-primary bg-primary shadow">
								Log in
							</button>
						</div>
						<div class="text-center mb-2">Or</div>
						<div class="mb-2">
							<a href="<?php echo site_url( 'bs-register' ); ?>" class="btn btn-primary shadow">
								Register
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php sp_footer(); ?>
