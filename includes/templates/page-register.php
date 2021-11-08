<?php sp_header(); ?>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="sp-login mt-5 p-5 text-white">
					<div class="text-center mb-5">
						<img class="app-logo" src="<?php echo sponsor()->url . 'assets/images/logo.png'; ?>" alt="logo-app">
						<h3 class="mb-3">Register to Sponsor's Portal</h3>
					</div>
					<form action="" method="POST" class="row g-3">
						<div class="col-md-8">
							<label for="organization" class="form-label">Organization</label>
							<input type="text" class="form-control rounded shadow-sm border-0" name="organization" id="organization" placeholder="Type your organization" autocomplete="off">
						</div>
						<div class="col-md-4">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control rounded shadow-sm border-0" name="username" id="username" placeholder="Type your username" autocomplete="off">
						</div>
						<div class="col-md-6">
							<label for="first_name" class="form-label">First Name</label>
							<input type="text" class="form-control rounded shadow-sm border-0" name="first_name" id="first_name" placeholder="Type your first_name" autocomplete="off">
						</div>
						<div class="col-md-6">
							<label for="last_name" class="form-label">Last Name</label>
							<input type="text" class="form-control rounded shadow-sm border-0" name="last_name" id="last_name" placeholder="Type your last_name" autocomplete="off">
						</div>
						<div class="col-md-6">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control rounded shadow-sm border-0" name="email" id="email" placeholder="Type your email" autocomplete="off">
						</div>
						<div class="col-md-6">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control rounded shadow-sm border-0" name="password" id="password" placeholder="Type your password" autocomplete="off">
						</div>
						<div class="col-6">
							<label for="address" class="form-label">Address</label>
							<input type="text" class="form-control rounded shadow-sm border-0" name="address" id="address" placeholder="1234 Main St" autocomplete="off">
						</div>
						<div class="col-6">
							<label for="address_2" class="form-label">Address 2</label>
							<input type="text" class="form-control rounded shadow-sm border-0" name="address_2" id="address_2" placeholder="Apartment, studio, or floor" autocomplete="off">
						</div>
						<div class="col-md-4">
							<label for="city" class="form-label">City</label>
							<input type="text" class="form-control rounded shadow-sm border-0" name="city" id="city" placeholder="Type your city" autocomplete="off">
						</div>
						<div class="col-md-4">
							<label for="state" class="form-label">State</label>
							<input type="text" class="form-control rounded shadow-sm border-0" list="states" name="state" id="state" placeholder="Type your state" autocomplete="off">
							<?php // echo $this->state_list( 'states' ); ?>

						</div>
						<div class="col-md-4">
							<label for="zip" class="form-label">Zip</label>
							<input type="text" class="form-control rounded shadow-sm border-0" name="zip" id="zip" placeholder="Type your zip" autocomplete="off">
						</div>
						<div class="col-12 mt-5">
							<button type="submit" class="btn btn-primary bg-primary shadow">Register Sponsor</button>
							<a href="<?php echo site_url( 'bs-login' ); ?>" class="btn btn-primary bg-primary shadow">
								Log in
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php sp_footer(); ?>
