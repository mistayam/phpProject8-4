<?php
    //declare variables
    require_once('config.inc.php');

    //establish connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    //check the password entered against password stored for user
    $user = $_POST['username'];
    $pass = $_POST['password'];

    //creates prepared statement
    $stmt = $conn->prepare("SELECT `password` FROM `" . $tblname . "` WHERE username = ?");

    //binds $user variable to prepared statement and executes
    //binds result of execute command to $pw and fetches it
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->bind_result($pw);
    $stmt->fetch();

    //close prepared statement
    $stmt->close();

    //if the passwords don't match, send to a failure page, otherwise send user to success page
    if ($pass != $pw)
    {
        header( 'Location: login.php?failed=true');
    }
    else
    {
        //creates prepared statement with $user as a parameter for the query
        //executes statement and binds result to $id 
        //fetch that result and store it in the success page URL as a $_GET variable 
        $stmt = $conn->prepare("SELECT `id` FROM `" . $tblname . "` WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();

        //close prepared statement
        $stmt->close();

        header( 'Location: login_success.php?id=' . $id);
    }
    
    //close connection
    $conn->close();