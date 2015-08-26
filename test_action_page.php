<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "record";
$tblname = "contacts";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully!<br>";
    
//Create database if it doesn't already exist
$db = "CREATE DATABASE IF NOT EXISTS record";
if ($conn->query($db) == TRUE)
{
    echo "Database created successfully!<br>";
}
else
{
    echo "Error creating database: " . $conn->error . "<br>";
}

//Create table if it doesn't already exist
$tbl = "CREATE TABLE IF NOT EXISTS contacts 
(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(30) NOT NULL,
    lastName VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP
)";
if ($conn->query($tbl) === TRUE)
{
    echo "Table created successfully!<br>";
}
else
{
    echo "Error creating table: " . $conn->error . "<br>";
}

echo "Setup completed successfully!<br>";

$sql = "INSERT INTO contacts (firstname, lastname, email) 
VALUES ( '" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "')";

if($conn->query($sql) === TRUE)
{
    echo "New contact created successfully!";
}
else
{
    echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
}

$conn->close();
?>
