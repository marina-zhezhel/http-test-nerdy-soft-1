<?php echo ($error != "") ? $error : ""; ?>
<div class="container registration-wrapper">
	<div class="row">
		<div class="col-sm-12 col-sm-4 col-sm-offset-4">
			<form action="./index.php?controller=static&page=registration"
				method="post" class="form-horizontal">
				<div class="control-group">
					<label class="control-label" for="login">Login (email):</label>
					<div class="controls">
						<input type="text" id="login" name="login" class="login"
							data-toggle="tooltip" data-placement="bottom"
							value="<?php
							echo $login;
							?>"
							placeholder="my@example.com" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password">Password:</label>
					<div class="controls">
						<input type="password" name="password" id="password" value="" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="first-name">First Name:</label>
					<div class="controls">
						<input type="text" name="first-name" id="first-name"
							value="">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="last-name">Last Name:</label>
					<div class="controls">
						<input type="text" name="last-name" id="last-name" value="">
					</div>
				</div>
				<div class="control-group">
					<input type="submit" name="submit" class="submit btn"
						value="Register"> <input type="reset" class="reset btn"
						value="Reset">
				</div>
			</form>
		</div>
	</div>
</div>