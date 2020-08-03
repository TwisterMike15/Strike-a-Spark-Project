<?php
	session_start();
	if(isset($_SESSION['LOGGED-IN'])) {
		$_SESSION["LOGGED-IN"] = null;
    unset($_SESSION["LOGGED-IN"]);
  }
?>

<meta name="viewport" content="width=device-width, initial-scale=0.9">
<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
<!DOCTYPE html>

<html>
  <head>
    <link rel="stylesheet" href="style.css">
  </head>
    <body>
    <center>
      <h1 class="header">Strike a Spark Conference Judging App</h1>
      <p style="font-size:30px"><font color = "white">You have successfully logged out.</font>
      <br></p>
    </center>
  </body>
</html>
