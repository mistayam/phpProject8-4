<center>
    <?php
        //declares variables
        require_once('config.inc.php');

        //establishes connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }

        //checks for last id inserted and stores the firstname
        $idNumber = $_GET['lastid'];

        //creates prepared statement
        $stmt = $conn->prepare("SELECT `firstName` FROM `" . $tblname . "` WHERE id = ?");

        //binds $idNumber to prepared statement and executes
        //binds the result to $fName and fetches it
        $stmt->bind_param("i", $idNumber);
        $stmt->execute();
        $stmt->bind_result($fName);
        $stmt->fetch();

        //echo out success messages with the fetched value for $fName
        echo "Thank you <b>" . $fName . "</b>!<br>";
        echo "Your account has been created successfully.<br>";
        echo "<a href = 'login.php'>Click here to login</a>";

        //close prepared statement
        $stmt->close();

        //closes connection
        $conn->close();
    ?>
</center>