<?php
echo "<fieldset>";
	echo "<center>";
		echo "<b>First Name:</b> ";
		echo htmlspecialchars($_POST['firstname']);
		echo "<br>";
		echo "<b>Last Name:</b> ";
		echo htmlspecialchars($_POST['lastname']);
		echo "<br>";
		echo "<b>Email:</b> ";
		echo htmlspecialchars($_POST['email']);
	echo "</center>";
echo "</fieldset>";