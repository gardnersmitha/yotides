<?php include('header.php'); ?>

<header class="row">
	<h1>YoTides</h1>
	<h3>A simple tide and weather service using the Yo API.</h2>
</header>

<h3>AGS TODO</h3>
<ul>
	<li>fix API calls to accept zip codes (DONE)</li>
	<li>add back in the actual response to the user via Yo API</li>
	<li>create DB on remote server (or maybe try Firebase?)</li>
	<li>get config.php to be .gitignored so updating works fine?</li>
	<li>error handling</li>
</ul>

<section class="signup-form row">
	<form action="<?php echo BASE_URL;?>/user/create" method="POST" role="form" class="col-lg-6">
		<legend>Signup for YoTides</legend>
	
		<div class="form-group">
			<label for="username">Yo Username</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Enter your YO username" value="">
		</div>
		<div class="form-group">
			<label for="zip-code">Zip Code for Forecast</label>
			<select name="zip_code" id="input" class="form-control" required="required">
				<option value="02540">Falmouth</option>
				<option value="02543">Woods Hole</option>
				<option value="02532">Bourne</option>
				<option value="02568">Vineyard Haven</option>
				<option value="02554">Nantucket</option>
			</select>
		</div>
		<!--
		<div class="form-group">
			<label for="zip-code">Zip Code for Forecast</label>
			<input type="text" class="form-control" id="zip-code" name="zip_code" placeholder="Something like 02540">
		</div>
		-->

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>	
</section>

<?php include('footer.php'); ?>