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

    //makes sure the username and e-mail doesn't already exist
    //sets count variables to the number of rows in table with same email and database
    $userCheck = "SELECT `username` FROM `" . $tblname . "` WHERE username = '" . $_POST['username'] . "'";
    $userResult = $conn->query($userCheck);
    $userCount = $userResult->num_rows;

    $emailCheck = "SELECT `email` FROM `" . $tblname . "` WHERE email = '" . $_POST['email'] . "'";
    $emailResult = $conn->query($emailCheck);
    $emailCount = $emailResult->num_rows;

    //if there are no matches for either email or username, add to table
    if ($userCount == 0 && $emailCount == 0)
    {
        //Inserts information into table
        $sql = "INSERT INTO `" . $tblname . "` (firstname, lastname, email, username, password, reg_date)
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
    }
    //otherwise, redirect to register page with error message depending on which one matched
    else
    {
        //set error based on which field matches value in table
        if ($userCount > 0)
        {
            $used = "username";
        }
        else if ($emailCount > 0)
        {
            $used = "email";
        }

        //close connection
        $conn->close();

        //redirect to register page with error
        header( 'Location: register.php?inuse=' . $used);
    }

//TODO
//add password encrypting when adding password to database
// and password decrypting when comparing passwords inputted and on record