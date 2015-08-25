<?php
class User {

    //member variables that represent the specific details of a user
    private $firstname;
    private $lastname;
    private $email;
    private $username;
    private $password;

    //setValue takes 2 parameters and sets a specified data member to a user-inputted value
    //$variable is a string that corresponds to the data member in the object with the same name
    //$value is the data we want to store in the data member
    public function setValue($variable, $value)
    {
        $this->$variable = $value;
    }

    //getValue takes 1 parameter and returns the value stored in the specified data member
    //$variable is a string that corresponds to the data member in the object with the same name
    public function getValue($variable)
    {
        return $this->$variable;
    }

    //ifCompleted checks each data member of the object an ensures all of them are true
    //if any of the data members in an object are null, the function returns false
    //if every data member has data stored inside, the function returns true
    public function isCompleted()
    {
        if ($this->firstname == null || $this->lastname == null || $this->email == null || $this->username == null || $this->password == null)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //save takes 1 parameter and either inputs a completed object into the specified database table 
    //or returns an error if the object is not complete.
    //$user is where the user specifies the object that they want to insert into the table
    //the error returns an error variable that lists each variable that has not been populated with data
    public function save($user)
    {
        //if the user has every field completed, connect to the database and insert the user into the table
        //otherwise, return an error message
        if ($user->isCompleted())
        {
            //include data to connect to server/database
            require_once('config.inc.php');

            //connect to database
            $conn = new mysqli($servername, $username, $password, $dbname);
            if($conn->connect_error)
            {
                die("Connection failed: " . $conn->connect_error);  
            }

            //insert the contact using the data members stored in the object
            $sql = "INSERT INTO `" . $tblname . "` (firstname, lastname, email, username, password, reg_date)
            VALUES ('" . $this->firstname . "', '" . $this->lastname . "', '" . $this->email . "', '" . $this->username . "', '" . $this->password . "', '" . date("m/d/Y h:i:sa") . "')";
            $conn->query($sql);

            //close connection
            $conn->close();
        }

        //error message is determined by which members are null
        //for every variable that is null, the $error variable is updated with the new data member name
        //the function returns a string with all of the empty variables if an error does occur and the user requests it
        else
        {
            $error = "";
            if ($this->firstname == null)
            {
                $err .= "firstname<br>";
            }
            if ($this->lastname == null)
            {
                $err .= "lastname<br>";
            }
            if ($this->email == null)
            {
                $err .= "email<br>";
            }
            if ($this->username == null)
            {
                $err .= "username<br>";
            }
            if ($this->password == null)
            {
                $err .= "password<br>";
            }
            $error = "User object is incomplete! The following fields are null: <br><b>" . $error . "<b>";
            return $error;
        }
    }

    //Get takes 1 parameter and pulls a user from the table 
    //and creates an object with the data members being set to the user data from the able
    //$uname represents the username of the user that the function is pulling down from the database
    public static function Get($uname)
    {
        //include data to connect to server/database
        require_once('config.inc.php');

        //connect to database
        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);  
        }

        //select a user with the same username specified by the user input ($uname variable)
        $sql = "SELECT * FROM `" . $tblname . "` WHERE `username` = '" . $uname . "'";
        $contact = $conn->query($sql);
        $row = $contact->fetch_assoc();

        //create a new User object and populate its data members with the data from the table
        $user = new User();
        $user->setValue("firstname", $row['firstName']);
        $user->setValue("lastname", $row['lastName']);
        $user->setValue("email", $row['email']);
        $user->setValue("username", $row['username']);
        $user->setValue("password", $row['password']);

        //return the user object
        return $user;
        
        //closes connection
        $conn->close();
    }
}