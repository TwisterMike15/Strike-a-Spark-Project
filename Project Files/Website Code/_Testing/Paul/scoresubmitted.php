<?php
  require 'includes\logincheck_security.php';
?>
<meta name="viewport" content="width=device-width, initial-scale=0.9">
<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
<!DOCTYPE html>

<html>
  <head>
    <link rel="stylesheet" href="Style/style.css">
      <center>
        <h1 class="header">Strike a Spark Conference Judging App</h1></head>

        <p>You have successfully submitted your scores.</p>

        <button onclick="location.href='idprompt.php'" type="button">
        Score Another Poster</button>

        <button onclick="location.href='loggedout.php'" type="button">
        Logout</button>

      </center>
  </head>
</html>
