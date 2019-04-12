<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */
require "config.php";
require "common.php";
$GLOBALS['state'] = 0;
$style = "";
?>
<script type="text/javascript">
  var mailVal = localStorage.getItem("email");
  if(mailVal){
      window.location.href = 'view.php';
  }
</script>
<?php
if (isset($_POST['submit'])) {
 try {
		$connection = new PDO($dsn, $username, $password, $options);

		$user = array(
			"email" => $_POST['mail'],
			"password"  => $_POST['pass'],
		);

		$sql = sprintf(
				"SELECT *
				FROM users
				WHERE email = :email AND password = :password");
    $statement = $connection->prepare($sql);
		$statement->bindParam(':email', $user["email"], PDO::PARAM_STR);
	  $statement->bindParam(':password', $user["password"], PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();
		$connection = null;
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
<?php
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) {?>
    <script type="text/javascript">
      var val = "<?php echo $user['email'] ?>";
      localStorage.setItem("email",val);
      window.location.href = 'view.php';
    </script>

		 <?php $style = "style='display:none;'";
     //header('Location: view.php');
		 //exit();
	}
	else{
			$style = "style='display:block;'";
	}
}
?>
<div id="error" <?php echo $style;?>>Email/Password is incorrect!</div>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input type="radio" name="tab" class="sign-up"><label class="tab"><a href="signup.php">Sign Up</a></label>
		<div class="login-form">
			<div class="sign-in-htm">
				<form method="post">
				<div class="group">
					<label for="mail" class="label">Email Address</label>
					<input id="mail" name="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="email" class="input">
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="pass" type="password" class="input" data-type="password">
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check">
					<label for="check"><span class="icon"></span> Keep me signed in</label>
				</div>
				<div class="group">
					<input type="submit" name="submit" class="button" value="submit">
				</div>
			</form>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="signup.php">Not a member yet? Sign up</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require "templates/footer.php"; ?>
