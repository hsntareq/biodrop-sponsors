<h1><?php echo esc_html( 'Settings' ); ?></h1>
<p><?php echo esc_html( 'Settings page content' ); ?></p>
<!-- <hr class="mb-4"> -->

<div class="bs-form px-3">
	<?php $user = wp_get_current_user()->data; ?>
	<form method="POST" action="">
		<div class="row border-bottom p-3 bg-white bg-opacity-75 align-items-center shadow-sm">
			<label for="username" class="col-sm-7 col-form-label">
				<strong class="d-block">Username</strong>
				<small>You can login using this username.</small>
			</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="username" value="<?php echo esc_html( $user->user_nicename ); ?>" disabled>
			</div>
		</div>
		<div class="row border-bottom p-3 bg-white bg-opacity-75 align-items-center shadow-sm">
			<label for="password" class="col-sm-7 col-form-label">
				<strong class="d-block">Password</strong>
				<small>Set your password to login.</small>
			</label>
			<div class="col-sm-5">
				<input type="password" class="form-control" id="password">
			</div>
		</div>
		<div class="row border-bottom p-3 bg-white bg-opacity-75 align-items-center shadow-sm">
			<label for="user_email" class="col-sm-7 col-form-label">
				<strong class="d-block">Email Address</strong>
				<small>User this Email Address to login.</small>
			</label>
			<div class="col-sm-5">
				<input type="email" class="form-control" id="user_email" value="<?php echo esc_html( $user->user_email ); ?>">
			</div>
		</div>
		<div class="row border-bottom p-3 bg-white bg-opacity-75 align-items-center shadow-sm">
			<label for="phone_number" class="col-sm-7 col-form-label">
				<strong class="d-block">Phone Number</strong>
				<small>Add your phone number to your profile.</small>
			</label>
			<div class="col-sm-5">
				<input type="tel" class="form-control" id="phone_number">
			</div>
		</div>
		<div class="row border-bottom p-3 bg-white bg-opacity-75 align-items-center shadow-sm">
			<div class="col">
				<button type="submit" class="btn btn-success"><?php _e( 'Update Profile' ); ?></button>
			</div>
		</div>
	</form>
</div>