<?php
    //Declare variables
    require_once('config.inc.php');
    
    //Connect to server 
    $conn = new mysqli($servername, $username, $password);
    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);  
    }

    //Select desired database
    $conn->select_db($dbname);

    //makes sure the username and e-mail doesn't already exist
    //sets count variables to the number of rows in table with same email and username (initially)
    $userCount = 0;
    $emailCount = 0;

    //existing-username check with prepared statement
    if ($stmt = $conn->prepare("SELECT `username` FROM `" . $tblname . "` WHERE username = ?"))
    {  
        //$user is the username input at the previous page
        $user = $_POST['username'];

        //binds email input to the prepared statement and execute it
        $stmt->bind_param("s", $user);
        $stmt->bind_result($userBind);
        $stmt->execute();

        //binds the result of the statement to a variable and fetch in a loop. 
        

        //fetch returns true if data was fetched. 
        //the while loop will increment $emailCount until there are no more data.
        while($stmt->fetch())
        {
            $userCount++;
        }

        $stmt->close();
    }

    //existing-email check with prepared statement
    if ($stmt = $conn->prepare("SELECT `email` FROM `" . $tblname . "` WHERE email = ?"))
    {  
        //$email is the email input at the previous page
        $email = $_POST['email'];

        //binds email input to the prepared statement and execute it 
        $stmt->bind_param("s", $email);
        $stmt->execute();

        //binds the result of the statement to a variable and fetch in a loop. 
        $stmt->bind_result($emailBind);

        //fetch returns true if data was fetched. 
        //the while loop will increment $emailCount until there are no more data.
        while($stmt->fetch())
        {
            $emailCount++;
        }

        $stmt->close();
    }

    //if there are no matches for either email or username, add to table
    if ($userCount == 0 && $emailCount == 0)
    {
        //prepares a statement to inserts information into table
        $stmt = $conn->prepare("INSERT INTO `" . $tblname . "` (firstname, lastname, email, username, password, reg_date) VALUES (?,?,?,?,?,?)");

        //declares variables for each input from the form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $date = date("m/d/Y h:i:sa");

        //binds each variable to the prepared statement
        $stmt->bind_param("ssssss", $firstname, $lastname, $email, $username, $password, $date);

        //if the statement executes successfully, log the id that was last inputted. otherwise return an error.
        if($stmt->execute() === TRUE)
        {
            $last_id = $conn->insert_id;
        }
        else
        {
            $err = "Error: " . $sql . "<br>" . $conn->error . "<br>";
            return $err;
        }

        $stmt->close();

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