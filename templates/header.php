<?php
if($GLOBALS['state'] == 0){
	$styleloggedOut = "style='display:block;'";
	$styleloggedIn = "style='display:none;'";
}else{
	$styleloggedOut = "style='display:none;'";
	$styleloggedIn = "style='display:block;'";
}
 ?>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>MCDA5540-Assignment2</title>

	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript">
	 function clearStorage(){
		 localStorage.clear();
	  }
	</script>
</head>

<body>
	<div class="topnav">
			<a href="index.php" <?php echo $styleloggedOut; ?>><strong>Home</strong></a>
	  <div class="topnav-right">
	    <a href="signup.php" <?php echo $styleloggedOut; ?>><strong>Sign Up</strong></a>
	    <a href="login.php" <?php echo $styleloggedOut; ?>><strong>Login</strong></a>
			<a href="index.php" onclick="clearStorage();" <?php echo $styleloggedIn; ?>><strong>Logout</strong></a>
	  </div>
	</div>
