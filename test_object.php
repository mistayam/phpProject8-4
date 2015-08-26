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
            //prepares a statement to inserts information into table
            $stmt = $conn->prepare("INSERT INTO `" . $tblname . "` (firstname, lastname, email, username, password, reg_date) VALUES (?,?,?,?,?,?)");

            //declares variables for each input from the form
            $fn = $this->firstname;
            $ln = $this->lastname;
            $em = $this->email;
            $un = $this->username;
            $pw = $this->password;
            $date = date("m/d/Y h:i:sa");

            //binds each variable to the prepared statement
            $stmt->bind_param("ssssss", $fn, $ln, $em, $un, $pw, $date);

            //execute the statement
            $stmt->execute();

            //close prepared statement
            $stmt->close();

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

        //creates a prepared statement
        $stmt = $conn->prepare("SELECT * FROM `" . $tblname . "` WHERE `username` = ?");

        //binds the $uname variable to the prepared statement and executes the statement
        //bind the returned results to the variables corresponding to the id, first name, last name, email, username, password, and date of the user respetively
        //fetch that result
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt->bind_result($id, $fn, $ln, $em, $un, $pw, $date);
        $stmt->fetch();

        //create a new User object and populate its data members with the data from the fetch 
        $user = new User();
        $user->setValue("firstname", $fn);
        $user->setValue("lastname", $ln);
        $user->setValue("email", $em);
        $user->setValue("username", $un);
        $user->setValue("password", $pw);

        //closes prepared statement
        $stmt->close();

        //closes connection
        $conn->close();

        //return the user object
        return $user;        
    }
}