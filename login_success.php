<center>
	<?php
		//declare variables
		require_once('config.inc.php');

		//establishes connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		if($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}

		//checks for last id inserted and stores the firstname
		$id = $_GET['id'];
		$sql = "SELECT `username` FROM `" . $tblname . "` WHERE id = " . $id;
		$username = $conn->query($sql);
	    $row = $username->fetch_assoc();

		echo "You have been successfully logged in!<br>";
		echo "Welcome back <b>" . $row['username'] . "<b>.";

		//closes connection
		$conn->close();
	?>
</center>