<?php

/*Strike A Spark Web Application

Group Members with emails:
Michael Gorse- gor9632@calu.edu
Anthony Carrola- car3766@calu.edu
Paul MacLean- mac7537@calu.edu
Brittany Marietta- mar0274@calu.edu
Ryan Merow- mer3942@calu.edu
Zachary Smith- smi2479@calu.edu
*/

	require "./admin_security/adminlogincheck.php";
	require "../includes/dbprotocols.php";
?>


<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
<link rel="icon" href="https://i.imgur.com/XciPCw8.png">

<meta name="viewport" content="width=device-width, initial-scale=0.9">
<!DOCTYPE html>

<html>
	<head>
		<title> Change Judge Password </title>
		<link rel="stylesheet" href="../Style/style.css">
	</head>

	<body class="background">
		<center>
			<h1 class="header thinredborder">Strike a Spark Admin Panel</h1>
			<div class="subhead">
	          <h2> Change Judge Password </h2>
			</div>

			<form action ="./admin_security/changepass_redirect.php" method="POST" onsubmit="return true;">
				<p>Enter current judge password. </p>
				<input id="Oldpassword" placeholder="Old Password" type="text" size="30" name="Old-Judge-Pass" required><br>
				<p> Enter new judge password. </p>
				<input id="Newpassword"  placeholder="New Password" type="text" size="30" name="New-Judge-Pass" required><br>
				<br>

				<button type = "submit"  name = "submit">Confirm</button>
			</form>

			<button onclick="location.href='AdminPanel.php'" type="button">Go Back</button>

		</center>
	</body>
	<script>
	function ValidateFields()
	{
		var check = false;
		check = confirm("Judge Password change is final. Press OK to confirm submission");
		return check;
}
  </script>
</html>
