<?php
/**
 * Template for sponsor registration.
 */

// get_header();


if ( $_POST ) {
	$reg_data     = array(
		'user_pass'  => wp_hash_password( get_request( 'password' ) ),   // (string) The plain-text user password.
		'user_login' => get_request( 'username' ),   // (string) The user's login username.
		'user_email' => get_request( 'email' ),   // (string) The user email address.
		'first_name' => get_request( 'first_name' ),   // (string) The user's first name.
		'last_name'  => get_request( 'last_name' ),   // (string) The user's last name.
	);
	$reg_metadata = array(
		'organization'  => sanitize_text_field( get_request( 'organization' ) ),
		'address'       => sanitize_textarea_field( get_request( 'address' ) ),
		'address_2'     => sanitize_textarea_field( get_request( 'address_2' ) ),
		'sponsor_city'  => sanitize_text_field( get_request( 'city' ) ),
		'sponsor_state' => sanitize_text_field( get_request( 'state' ) ),
		'sponsor_zip'   => sanitize_text_field( get_request( 'zip' ) ),

	);
	$user_id = wp_insert_user( $reg_data );

	// On success.
	if ( ! is_wp_error( $user_id ) ) {
		echo 'User created : ' . $user_id;
		wp_update_user(
			array(
				'ID'   => $user_id,
				'role' => 'sponsor',
			)
		);

		$user = get_userdata( 1 );

		pr( $user );
	}
	$sponsor_role = get_role( 'sponsor' );

}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<div class="container mt-5">
	<div class="w-75 mx-auto">
	<h3>Sponsor Registration</h3>
	<p>Please register your organization account submitting this form.</p>
	<hr class="mb-5">
<form action="" method="POST" class="row g-3">
  <div class="col-md-8">
	<label for="organization" class="form-label">Organization</label>
	<input type="text" class="form-control" name="organization" id="organization" placeholder="Type your organization" autocomplete="off">
  </div>
  <div class="col-md-4">
	<label for="username" class="form-label">Username</label>
	<input type="text" class="form-control" name="username" id="username" placeholder="Type your username" autocomplete="off">
  </div>
  <div class="col-md-6">
	<label for="first_name" class="form-label">First Name</label>
	<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Type your first_name" autocomplete="off">
  </div>
  <div class="col-md-6">
	<label for="last_name" class="form-label">Last Name</label>
	<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Type your last_name" autocomplete="off">
  </div>
  <div class="col-md-6">
	<label for="email" class="form-label">Email</label>
	<input type="email" class="form-control" name="email" id="email" placeholder="Type your email" autocomplete="off">
  </div>
  <div class="col-md-6">
	<label for="password" class="form-label">Password</label>
	<input type="password" class="form-control" name="password" id="password" placeholder="Type your password" autocomplete="off">
  </div>
  <div class="col-6">
	<label for="address" class="form-label">Address</label>
	<input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" autocomplete="off">
  </div>
  <div class="col-6">
	<label for="address_2" class="form-label">Address 2</label>
	<input type="text" class="form-control" name="address_2" id="address_2" placeholder="Apartment, studio, or floor" autocomplete="off">
  </div>
  <div class="col-md-4">
	<label for="city" class="form-label">City</label>
	<input type="text" class="form-control" name="city" id="city" placeholder="Type your city" autocomplete="off">
  </div>
  <div class="col-md-4">
	<label for="state" class="form-label">State</label>
	<input type="text" class="form-control" list="states" name="state" id="state" placeholder="Type your state" autocomplete="off">
	<?php echo $this->state_list( 'states' ); ?>

  </div>
  <div class="col-md-4">
	<label for="zip" class="form-label">Zip</label>
	<input type="text" class="form-control" name="zip" id="zip" placeholder="Type your zip" autocomplete="off">
  </div>
  <div class="col-12 mt-5">
	<button type="submit" class="btn btn-primary btn-lg">Register Sponsor</button>
  </div>
</form>
	</div>
</div>
<?php
// get_footer();
die();
?>
