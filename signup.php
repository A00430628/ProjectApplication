<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */
require "config.php";
require "common.php";
$style = "";
$emptyStyle= "";
$GLOBALS['state'] = 0; ?>
<script type="text/javascript">
  var mailVal = localStorage.getItem("email");
  if(mailVal){
      window.location.href = 'view.php';
  }
</script>
<?php
if (isset($_POST['submit'])) {
	if($_POST['user'] != "" && $_POST['mail'] != "" && $_POST['mob'] != "" && $_POST['pass'] != "" ){
		$emptyStyle=  "style='display:none;'";
  try {
		$connection = new PDO($dsn, $username, $password, $options);

		$new_user = array(
			"username" => $_POST['user'],
			"email"     => $_POST['mail'],
			"phone"       => $_POST['mob'],
			"password"  => $_POST['pass']
		);
		$sql = sprintf(
				"SELECT *
				FROM users
				WHERE email = :email");
		$statement = $connection->prepare($sql);
		$statement->bindParam(':email', $new_user["email"], PDO::PARAM_STR);
		$statement->execute();
		echo $statement->rowCount();
    if( $statement->rowCount() == 0){
		$style = "style='display:none;'";
		$sql1 = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"users",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
		);

		$statement = $connection->prepare($sql1);
		$statement->execute($new_user);
		$connection = null;
		if ($statement->rowCount() > 0) {
	     header('Location: view.php');
			 exit();
		}
	}
	else{
		$style = "style='display:block;'";
	}
	} catch(PDOException $error) {
	       echo $error->getMessage();
				 die();
	}
}
else{
$emptyStyle=  "style='display:block;'";
}
}
?>

<?php require "templates/header.php"; ?>

<div id="error" <?php echo $style;?>>Username/Email already exists!</div>
<div id="error" <?php echo $emptyStyle;?>>No field can be left empty!</div>
<div class="signup-wrap">
	<div class="login-html">
		<input type="radio" name="tab" class="sign-up"><label class="tab"><a href="login.php">Sign In</a></label>
		<input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-up-htm">
				<form method="post">
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user" name="user" type="text" class="input">
				</div>
				<div class="group">
					<label for="mail" class="label">Email Address</label>
					<input id="mail" name="mail" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="input">
				</div>
				<div class="group">
					<label for="mob" class="label">Mobile No.</label>
					<input id="mob" name="mob" type="tel" pattern="^\d{10}$" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" pattern=".{6,}" title="Six or more characters" class="input">
				</div>
				<div class="group">
					<input type="submit" name="submit" class="button" value="submit">
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

<?php require "templates/footer.php"; ?>
