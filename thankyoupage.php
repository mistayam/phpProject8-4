<center>
		<?php
		$servername = "localhost";
		$username = "username";
		$password = "password";
		$dbname = "record";

		$conn = new mysqli($servername, $username, $password, $dbname);

		$idNumber = $_GET['lastid'];
		
		$sql = "SELECT `firstName` FROM `contacts` WHERE id = $idNumber";

		$firstName = $conn->query($sql);

	    $row = $firstName->fetch_assoc();

		echo "Thank you <b>" . $row['firstName'] . "</b>!";

		$conn->close();
	?>
</center>