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
		<link rel="stylesheet" href="../Style/style.css">
		<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	</head>

	<body>
		<center>
			<h1 class="thinredborder header">Strike a Spark Admin Panel</h1>
			<img class="logo" src="https://pbs.twimg.com/profile_images/979358006663139328/0ShklWot_400x400.jpg" alt="Strike a spark">
			<br><br><br>

			<form action ="ChangeJudge.php" method="POST" onsubmit="return true;">
				<button type = "submit"  name = "submit">Change Judge Password</button>
			</form>

			<form action ="ChangeAdmin.php" method="POST" onsubmit="return confirmAdminPath();">
				<button type = "submit"  name = "submit">Change Admin Password</button>
			</form>

			<br><br>

			<form action ="AdminTable.php" method="POST" onsubmit="return CheckLogin();">
				<button type = "submit"  name = "submit">Get Results</button>
			</form>

			<button onclick="location.href='Adminloggedout.php'" type="button">
			Logout</button>

		</center>
	</body>
</html>

<script>
	function confirmAdminPath()
	{
		return confirm("You are going to a page that changes the password access to this admin panel. Are you sure?");
	}
</script>
