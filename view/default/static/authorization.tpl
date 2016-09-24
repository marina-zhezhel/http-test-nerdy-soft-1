<?php
if ($error != "") {
	echo $error . "<br/>";
}
?>
<div class="container authorization-wrapper">
	<div class="row">
		<div class="col-sm-12 col-sm-4 col-sm-offset-4">
			<form action="./index.php?controller=static&page=authorization"
				method="post" class="form-horizontal">
				<div class="control-group">
					<label class="control-label" for="login">Login (email):</label>
					<div class="controls">
						<input type="text" name="login" id="login"
							value="<?php
							echo $login;
							?>"
							placeholder="my@example.com" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password">Password:</label>
					<div class="controls">
						<input type="password" name="password" id="password" value=""
							required>
					</div>
				</div>
				<div class="control-group">
					<input type="submit" name="submit" class="submit btn" value="Login">
					<a href="./index.php?controller=static&page=registration"><input
						type="button" class="reset btn" value="Register"></a>
				</div>

			</form>
		</div>
	</div>
</div>



