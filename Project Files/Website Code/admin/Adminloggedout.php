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

	session_start();
	session_destroy();
?>

<meta name="viewport" content="width=device-width, initial-scale=0.9">
<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
<!DOCTYPE html>

<html>
  <head>
    <link rel="stylesheet" href="../Style/style.css">
  </head>
	<body>
		<center>
		  <h1 class="thinredborder header">Strike a Spark Conference Judging App</h1>
		  <p style="font-size:30px"><font color = "white">You have successfully logged out.</font>
		  <br></p>
			<button onclick="location.href='index.html'" type="button">
		  Return to admin login page</button>
		</center>
	</body>
</html>
