<center>
    <?php
        //declare variables
        require_once('config.inc.php');

        //establishes connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        //checks for last id inserted and stores the firstname
        $id = $_GET['id'];
        
        //creates prepared statement
        $stmt = $conn->prepare("SELECT `username` FROM `" . $tblname . "` WHERE id = ?");

        //binds $id to prepared statement and executes
        //binds the result to $uname and fetches it
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($uname);
        $stmt->fetch();

        //echo out success messages with the fetched value for $fName
        echo "You have been successfully logged in!<br>";
        echo "Welcome back <b>" . $uname . "<b>.";

        //closes prepared statement
        $stmt->close();

        //closes connection
        $conn->close();
    ?>
</center>