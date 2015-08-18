<center>
	<?php
		//declares variables
		include('config.inc.php');

		//establishes connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		if($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}

		//checks for last id inserted and stores the firstname
		$idNumber = $_GET['lastid'];
		$sql = "SELECT `firstName` FROM `" . $tblname . "` WHERE id = $idNumber";
		$firstName = $conn->query($sql);
	    $row = $firstName->fetch_assoc();

	    //echo out success messages
		echo "Thank you <b>" . $row['firstName'] . "</b>!<br>";
		echo "Your account has been created successfully.<br>";
		echo "<a href = 'login.php'>Click here to login</a>";

		//closes connection
		$conn->close();
	?>
</center>