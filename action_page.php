<?php
	//Declare variables
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$dbname = "record";
	$tblname = "contacts";

	//Connect to server	
	$conn = new mysqli($servername, $username, $password);
	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);	
	}

	$conn->select_db($dbname);

	//Inserts information into table
	$sql = "INSERT INTO " . $tblname . "(firstname, lastname, email)
	VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "')";

	if($conn->query($sql) === TRUE)
	{
		$last_id = $conn->insert_id;
	}
	else
	{
		echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	}

	//end connection
	$conn->close();
	header( 'Location: thankyoupage.php?lastid=' . $last_id);
?>
