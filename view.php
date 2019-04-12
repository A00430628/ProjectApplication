<?php
	try {
		require "config.php";
		require "common.php";
  $GLOBALS['state'] = 1;
	$connection = new PDO($dsn, $username, $password, $options);

	$sql = "SELECT *
					FROM users";
  $statement = $connection->prepare($sql);
	$statement->execute();

	$result = $statement->fetchAll();
	$connection = null;
	} catch(PDOException $error) {
		echo $error->getMessage();
	}
?>
<?php include "templates/header.php"; ?>
<div class="userList">
<h1>Users/Accounts</h2>
	<?php
		if ($result && $statement->rowCount() > 0) { ?>
			<table class="users">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email Address</th>
						<th>Phone No.</th>
					</tr>
				</thead>
				<tbody>
		<?php foreach ($result as $row) { ?>
				<tr>
					<td><?php echo escape($row["id"]); ?></td>
					<td><?php echo escape($row["username"]); ?></td>
					<td><?php echo escape($row["email"]); ?></td>
					<td><?php echo escape($row["phone"]); ?></td>
				</tr>
				<div class="tilesView">
					<p class="tiles">ID: <?php echo escape($row["id"]); ?></p>
					<p class="tiles">NAME: <?php echo escape($row["username"]); ?></p>
					<p class="tiles">EMAIL: <?php echo escape($row["email"]); ?></p>
					<p class="tiles">PHONE: <?php echo escape($row["phone"]); ?></p>
				</div>
			<?php } ?>
				</tbody>
		</table>
		<?php } else { ?>
			<blockquote>No results found.</blockquote>
		<?php }
	 ?>
</div>
<?php include "templates/footer.php"; ?>
