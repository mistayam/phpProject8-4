<!DOCTYPE html>
<head>
<title>Login to ONTRAPORT</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<?php
//checks link of page to make sure there was no error
//if there is a get variable, there was an error so proceed with error message
$get = isset($_GET['failed']);
if ($get == true)
{
  $failed = $_GET['failed'];
  if ($failed == true)
  {
    echo "<center><img src = 'CautionIcon.gif'> We didn't recognize the username or password you entered. Please try again.</center><br>";
  }
}
?>

<html>
  <center>                  
    <div class = "login">
      <form action="login_action.php" method = "post">
        <table>
          <img src = "ontraport-signin.png">
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
            <td align = "left"><input type="submit" name="login" value="Login" ><td>
          </tr>
        </table>
        <a href='register.php'>New member? Create an account here!</a>
      </form>
    </div>
  </center>
</html>