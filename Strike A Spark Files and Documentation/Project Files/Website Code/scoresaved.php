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

  require 'includes\logincheck_security.php';

  //Make sure last page is a valid page
  if( $_SESSION['LAST-PAGE'] === 'savescore') {
    $_SESSION['LAST-PAGE'] = "scoresaved";
  } else {
    header("Location: http://students.calu.edu/calupa/mac7537/idprompt.php");
    exit();
  }
?>

<meta name="viewport" content="width=device-width, initial-scale=0.9">
<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
<!DOCTYPE html>

<html>
  <head>
    <link rel="stylesheet" href="Style/style.css">
  </head>

  <body>
    <center>
      <h1 class="header">Strike a Spark Conference Judging App</h1>
      <p>Either submit your score
        for this poster now, or score another poster and come
        back to this one later.</p>
      <br>

      <button onclick="final();" type="button">
         Submit Score</button>

      <button onclick="location.href='idprompt.php'" type="button">
      	 Score another Poster</button>

         <button onclick="location.href='loggedout.php'" type="button">
         Logout</button>

    </center>
  </body>
  <script>
    function final() {
      var c = confirm("Scores submitted are final.");
      if (c == true) {
        check = true;
      }
      else {
        check = false;
      }
      if (check == true){
        location.href='./includes/submitscore.php';
      }
    }
  </script>
</html>
