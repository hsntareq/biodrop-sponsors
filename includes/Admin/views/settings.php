<div class="sp-heading d-flex justify-content-between align-items-end mb-5">
	<div>
		<h2 class="page-heading">Admin User Settings</h2>
	</div>
</div>

<div class="sp-body">
	<?php $user = wp_get_current_user()->data; ?>
	<form method="POST" action="">
		<div class="row mb-3">
			<label for="username" class="col-sm-3 col-form-label text-end">Username</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" id="username" value="<?php echo esc_html( $user->user_nicename ); ?>" disabled>
			</div>
		</div>
		<div class="row mb-3">
			<label for="password" class="col-sm-3 col-form-label text-end">Password</label>
			<div class="col-sm-5">
				<input type="password" class="form-control" id="password">
			</div>
		</div>
		<div class="row mb-3">
			<label for="user_email" class="col-sm-3 col-form-label text-end">Email Address</label>
			<div class="col-sm-5">
				<input type="email" class="form-control" id="user_email" value="<?php echo esc_html( $user->user_email ); ?>">
			</div>
		</div>
		<div class="row mb-3">
			<label for="phone_number" class="col-sm-3 col-form-label text-end">Phone Number</label>
			<div class="col-sm-5">
				<input type="tel" class="form-control" id="phone_number">
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-sm-5 offset-sm-3">
				<input type="submit" value="Save" class="btn btn-success" id="inputEmail3">
			</div>
		</div>
	</form>
</div>
