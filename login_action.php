<center>
		<!-- 		
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
		-->
<!-- 
	connect to database
	look for username and password in table
	if credentials do not match any field redirect to login page
	else go to success page (perhaps with "logged in as $firstname/$username")
 -->

</center>