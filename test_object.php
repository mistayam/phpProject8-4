<?php
class User {

	//member variables that represent the specific details of a user
	private $firstname;
	private $lastname;
	private $email;
	private $username;
	private $password;

	public function setValue($variable, $value)
	{
		$this->$variable = $value;
	}

	public function getValue($variable)
	{
		return $this->$variable;
	}

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

	public function save($user)
	{
		//if the user has every field completed, connect to the database and insert the user into the table
		//otherwise, return an error message
		if ($user->isCompleted())
		{
			require_once('config.inc.php');

			$conn = new mysqli($servername, $username, $password, $dbname);
			if($conn->connect_error)
			{
				die("Connection failed: " . $conn->connect_error);	
			}

			$sql = "INSERT INTO `" . $tblname . "` (firstname, lastname, email, username, password, reg_date)
			VALUES ('" . $this->firstname . "', '" . $this->lastname . "', '" . $this->email . "', '" . $this->username . "', '" . $this->password . "', '" . date("m/d/Y h:i:sa") . "')";
			$conn->query($sql);

			$conn->close();
		}
		else
		{
			$error = "";
			if ($this->firstname == null)
			{
				$error .= "firstname<br>";
			}
			if ($this->lastname == null)
			{
				$error .= "lastname<br>";
			}
			if ($this->email == null)
			{
				$error .= "email<br>";
			}
			if ($this->username == null)
			{
				$error .= "username<br>";
			}
			if ($this->password == null)
			{
				$error .= "password<br>";
			}
			echo "User object is incomplete! The following fields are null: <br><b>" . $error . "<b>";
		}
	}

	public static function Get($uname)
	{
		require_once('config.inc.php');

		$conn = new mysqli($servername, $username, $password, $dbname);
		if($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);	
		}

		$sql = "SELECT * FROM `" . $tblname . "` WHERE `username` = '" . $uname . "'";
		$contact = $conn->query($sql);

	    $row = $contact->fetch_assoc();

	    $user = new User();
	    $user->setValue("firstname", $row['firstName']);
	    $user->setValue("lastname", $row['lastName']);
	    $user->setValue("email", $row['email']);
	    $user->setValue("username", $row['username']);
	    $user->setValue("password", $row['password']);

		return $user;
	    
		//closes connection
		$conn->close();
	}
}

// $user = new User();
// $user->setValue("firstname", "test");
// $user->setValue("lastname", "test2");
// $user->setValue("email", "test");
// $user->setValue("username", "test2");
// $user->setValue("password", "test2");
// $user->save($user);

// echo $user->getValue("firstname"); //Should output "test"
// echo $user->getValue("lastname"); //Should output "test2"

// var_dump(User::Get("test2")); //Should return a User object with the data populated for that user and var_dump the object