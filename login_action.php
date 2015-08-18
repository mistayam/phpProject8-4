<?php
	//declare variables
	include('config.inc.php');

	//establish connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	//check the password entered against password stored for user
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sql = "SELECT `password` FROM `" . $tblname . "` WHERE username = '" . $username . "'";
	$pw = $conn->query($sql);
    $row = $pw->fetch_assoc();

    //if the passwords don't match, send to a failure page, otherwise send user to success page
    if ($password != $row['password'])
    {
		header( 'Location: login.php?failed=true');
    }
    else
    {
    	header( 'Location: login_success.php');
    }
    
    //close connection
	$conn->close();
?>