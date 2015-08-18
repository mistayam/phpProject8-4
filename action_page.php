<?php
	//Declare variables
	require_once('config.inc.php');
	
	//Connect to server	
	$conn = new mysqli($servername, $username, $password);
	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);	
	}

	$conn->select_db($dbname);

	//Inserts information into table
	$sql = "INSERT INTO " . $tblname . "(firstname, lastname, email, username, password, reg_date)
	VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $_POST['password'] . "', '" . date("m/d/Y h:i:sa") . "')";

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

	//redirect to a thank you page
	header( 'Location: thankyoupage.php?lastid=' . $last_id);
