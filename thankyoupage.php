<center>
		<?php
			$servername = "localhost";
			$username = "username";
			$password = "password";
			$dbname = "record";
			$tblname = "accounts";

			$conn = new mysqli($servername, $username, $password, $dbname);
			if($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);
			}

			$idNumber = $_GET['lastid'];
			$sql = "SELECT `firstName` FROM `" . $tblname . "` WHERE id = $idNumber";
			$firstName = $conn->query($sql);
		    $row = $firstName->fetch_assoc();

			echo "Thank you <b>" . $row['firstName'] . "</b>!";

			$conn->close();
		?>
</center>