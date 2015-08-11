<?php
echo "<fieldset>";
	echo "<center>";
		echo "<b>First Name:</b> ";
		echo htmlspecialchars($_POST['firstname']);
		echo "<br>";
		echo "<b>Last Name:</b> ";
		echo htmlspecialchars($_POST['lastname']);
		echo "<br>";
		echo "<b>Email:</b> ";
		echo htmlspecialchars($_POST['email']);
	echo "</center>";
echo "</fieldset>";

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "record";
$tblname = "contacts";

//Creates database if it does not exist
$dbCreate = new mysqli($servername, $username, $password);
if($dbCreate->connect_error)
{
	die("Connection failed: " . $dbCreate->connect_error);	
}
echo "Connected successfully! <br>";

$db = "CREATE DATABASE IF NOT EXISTS " . $dbname;
if($dbCreate->query($db) == TRUE)
{
	echo "Database '" . $dbname . "' created successfully.<br>";
}
else
{
	echo "Error creating database: " . $dbCreate->error . "<br>";
}
$dbCreate->close();


$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error)
{
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully! <br>";

$tbl = "CREATE TABLE IF NOT EXISTS " .$tblname .
"(
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(20) NOT NULL,
	lastName VARCHAR(20) NOT NULL,
	email VARCHAR(40) NOT NULL,
	reg_date TIMESTAMP
	)";

if($conn->query($tbl) === TRUE)
{
	echo "Table '" . $tblname . "'' created successfuly!<br>";
}
else
{
	echo "Error creating table: " . $conn->error . "<br>";
}

echo "Setup completed successfully!<br>";

$sql = "INSERT INTO " . $tblname . "(firstname, lastname, email)
VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "')";

if($conn->query($sql) === TRUE)
{
	echo "New contact added successfully!<br>";
}
else
{
	echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
}

$conn->close();
?>