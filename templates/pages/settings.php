<div class="mb-4 border-bottom">
	<h1><?php echo esc_html( 'Settings' ); ?></h1>
	<p><?php echo esc_html( 'Settings page content' ); ?></p>
</div>
<!-- <hr class="mb-4"> -->
<?php
$user = wp_get_current_user();
$cc_data = get_credit_cards( $user->ID );

// $user = wp_get_current_user()->data;
// pr( $user );
if ( isset( $_POST ) ) {
	$useremail    = isset( $_POST['user_email'] ) ? sanitize_text_field( $_POST['user_email'] ) : '';
	$first_name   = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
	$last_name    = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
	$organization = isset( $_POST['organization'] ) ? sanitize_text_field( $_POST['organization'] ) : '';
	$phone_number = isset( $_POST['phone_number'] ) ? sanitize_text_field( $_POST['phone_number'] ) : '';

	$user_data['ID']         = $user->ID;
	if(isset( $_POST['user_email'] ) && !empty($_POST['user_email'])){
		$user_data['user_email'] = sanitize_text_field( $_POST['user_email'] ) ;
	}
	if(isset( $_POST['user_pass'] ) && !empty($_POST['user_pass'])){
		$user_data['user_pass'] = wp_hash_password( $_POST['user_pass'] ) ;
	}

	wp_update_user( $user_data );

	if ( ! empty( $first_name ) ) {
		update_user_meta( $user->ID, 'first_name', $first_name );
	}
	if ( ! empty( $last_name ) ) {
		update_user_meta( $user->ID, 'last_name', $last_name );
	}
	if ( ! empty( $organization ) ) {
		update_user_meta( $user->ID, 'organization', $organization );
	}
	if ( ! empty( $phone_number ) ) {
		update_user_meta( $user->ID, 'phone_number', $phone_number );
	}
}
$user_meta = get_user_meta( $user->ID );
// pr( $user_meta );
$first_name   = isset( $user_meta['first_name'] ) ? $user_meta['first_name'][0] : '';
$last_name    = isset( $user_meta['last_name'] ) ? $user_meta['last_name'][0] : '';
$organization = isset( $user_meta['organization'] ) ? $user_meta['organization'][0] : '';
$phone_number = isset( $user_meta['phone_number'] ) ? $user_meta['phone_number'][0] : '';
?>
	<h5 class="mb-3"><i class="fad fa-users-cog me-2"></i> Admin User Settings</h5>
	<form method="POST" action="" id="form_user_data">
		<input type="hidden" name="action" value="user_data_action">
		<div class="bs-form px-4 bg-white shadow-sm mb-3">
			<div class="row border-bottom g-0 py-3 bg-white bg-opacity-75 align-items-center">
				<label for="username" class="col-sm-7 col-form-label">
					<strong class="d-block">Username</strong>
					<small>You can login using this username.</small>
				</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="username" value="<?php echo esc_html( $user->user_nicename ); ?>" disabled>
				</div>
			</div>
			<div class="row border-bottom g-0 py-3 bg-white bg-opacity-75 align-items-center">
				<label for="username" class="col-sm-7 col-form-label">
					<strong class="d-block">First Name</strong>
					<small>Update user's first name.</small>
				</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo esc_html( $first_name ); ?>">
				</div>
			</div>
			<div class="row border-bottom g-0 py-3 bg-white bg-opacity-75 align-items-center">
				<label for="username" class="col-sm-7 col-form-label">
					<strong class="d-block">Last Name</strong>
					<small>Update user's last name.</small>
				</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo esc_html( $last_name ); ?>">
				</div>
			</div>

			<div class="row border-bottom g-0 py-3 bg-white bg-opacity-75 align-items-center">
				<label for="password" class="col-sm-7 col-form-label">
					<strong class="d-block">Password</strong>
					<small>Set your password to login.</small>
				</label>
				<div class="col-sm-5">
					<input type="password" class="form-control" name="user_pass" id="password">
				</div>
			</div>

			<div class="row border-bottom g-0 py-3 bg-white bg-opacity-75 align-items-center">
				<label for="user_email" class="col-sm-7 col-form-label">
					<strong class="d-block">Email Address</strong>
					<small>User this Email Address to login.</small>
				</label>
				<div class="col-sm-5">
					<input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo esc_html( $user->user_email ); ?>">
				</div>
			</div>
			<div class="row	 g-0 py-3 bg-white bg-opacity-75 align-items-center">
				<label for="phone_number" class="col-sm-7 col-form-label">
					<strong class="d-block">Organization</strong>
					<small>Add your organization to your profile.</small>
				</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" name="organization" id="organization" value="<?php echo esc_html( $organization ); ?>">
				</div>
			</div>
			<div class="row	 g-0 py-3 bg-white bg-opacity-75 align-items-center">
				<label for="phone_number" class="col-sm-7 col-form-label">
					<strong class="d-block">Phone Number</strong>
					<small>Add your phone number to your profile.</small>
				</label>
				<div class="col-sm-5">
					<input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo esc_html( $phone_number ); ?>">
				</div>
			</div>
		</div>

		<div class="bs-form px-4 bg-white shadow-sm mb-5">
			<div class="row  g-0 py-3 bg-white bg-opacity-75 align-items-center">
				<div class="col">
					<button type="submit" class="btn btn-success"><?php _e( 'Update Profile' ); ?></button>
				</div>
			</div>
		</div>
	</form>
	<div class="mb-3 d-flex align-items-center justify-content-between">
		<h5 class="mb-0"><i class="fad fa-credit-card me-2"></i> Payment Info</h5>
		<button class="btn btn-success" id="new_card_button" type="button" disable>
			<i class="fad fa-plus"></i>
			<span>New Card</span>
			<span class="spinner-grow spinner-grow-sm visually-hidden" role="status" aria-hidden="true"></span>
		</button>
	</div>
	<div class="bs-form p-4 bg-white shadow-sm mb-4">
		<div class="mb-5  visually-hidden" id="add_credit_card">
			<form method="POST" action="" id="credit_card_form">
				<?php wp_nonce_field( 'add_credit_card', 'card_nonce' ); ?>

				<div class="row mb-4">
					<div class="col">
						<label for="card_number" class="form-label">Card Number</label>
						<input type="text" name="card_number" class="form-control" id="card_number">
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label for="expiration_date" class="form-label">Expiration date</label>
						<input type="text" name="expiration_date" class="form-control" id="expiration_date">
					</div>
					<div class="col">
						<label for="card_cvv" class="form-label">CVV</label>
						<input type="text" name="card_cvv" class="form-control" id="card_cvv">
					</div>
					<div class="col">
						<label for="card_cvv" class="form-label">Payment Type</label>
						<select class="form-select" name="payment_type">
							<option value="fab fa-cc-mastercard">Mastercard</option>
							<option value="fab fa-cc-visa">Visa</option>
							<option value="fab fa-cc-amex">Amex</option>
						</select>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<label for="name_on_card" class="form-label">Name on Card</label>
						<input type="text" name="name_on_card" class="form-control" id="name_on_card">
					</div>
				</div>
				<div class="row mb-3">
					<div class="col">
						<button class="btn btn-success" type="submit" disable id="card_submit_btn">
							<i class="fad fa-save"></i>
							<span class="mx-2">Save Card</span>
							<span class="spinner-grow spinner-grow-sm visually-hidden" role="status" aria-hidden="true"></span>
						</button>
					</div>
				</div>
			</form>
		</div>

		<table class="table table-hover- table-striped border">
			<thead>
			<tr>
			<th scope="col" class="text-center">#</th>
			<th scope="col">Card </th>
			<th scope="col">Name on Card</th>
			<th scope="col">Card Number</th>
			<th scope="col">Expiration</th>
			<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i=0;
		foreach($cc_data as $cc) {
			$exp_month = $cc->card_expiration_month;
			$exp_year = $cc->card_expiration_year;
			?>
			<tr class="align-middle">
				<th scope="row" class="text-center"><?php echo esc_attr( $i+=1 );?></th>
				<td>
					<i class="fab fa-2x fa-cc-mastercard"></i>
				</td>
				<td><?php echo esc_attr( $cc->name );?></td>
				<td><?php echo esc_attr( $cc->card_number );?></td>
				<td><?php echo esc_attr( $exp_month );?>/<?php echo esc_attr( $exp_year );?></td>
				<td>
				<div class="btn-group" role="group" aria-label="Basic outlined example">
					<button type="button" class="btn btn-sm btn-outline-primary" data-id="<?php echo esc_attr( $cc->id );?>">
						<i class="far fa-edit"></i>
					</button>
					<button type="button" class="btn btn-sm btn-outline-danger" data-id="<?php echo esc_attr( $cc->id );?>">
						<i class="far fa-trash-alt"></i>
					</button>
				</div>
				</td>
			</tr>
		<?php } ?>

		</tbody>

		</table>
	</div>

