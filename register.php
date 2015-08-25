<!DOCTYPE html>
<head>
<title>Register for ONTRAPORT</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<?php
//checks link of page to make sure there was no error
//if there is a get variable, there was an error so proceed with error message
$get = isset($_GET['inuse']);

//error message is dependent on what the get variable was set to
if ($get == true)
{
  $used = $_GET['inuse'];
  if ($used == 'username')
  {
    echo "<center><img src = 'CautionIcon.gif'> Username in use. Please try another one.</center><br>";
  }
  else if ($used == 'email')
  {
    echo "<center><img src = 'CautionIcon.gif'> Email in use. Please try try another one.</center><br>";
  }
}
?>

<html>
  <center>
   <div class = "register">
    <form action="action_page.php" method = "post">
        <table>
          <img src = "ontraport-signup.png">
          <tr>
            <td><b>First Name:</b></td>
            <td><input type="text" name="firstname" value="" required></td>
          </tr>
          <tr>
            <td><b>Last Name:</b></td>
            <td><input type="text" name="lastname" value="" required></td>
          </tr>
          <tr>
            <td><b>Email:</b></td>
            <td><input type="email" name="email" value="" required></td>
          </tr>
          <tr>
            <td><b>Username:</b></td>
            <td><input type="text" name="username" value="" required></td>
          </tr>
          <tr>
            <td><b>Password:</b></td>
            <td><input type="password" name="password" value="" required></td>
          </tr>
          <tr>
            <td></td>
            <td align = "left"><input type="submit" name="register" value="Register"><td>
          </tr>
        </table>
        <a href = 'login.php'>Existing user? Click here to login!</a>
      </form>
    </div>
  </center>
</html>