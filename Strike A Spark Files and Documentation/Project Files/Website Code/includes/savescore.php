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

  require './logincheck_security.php';
  require './dbprotocols.php';
  //Assume session is started

  //Make sure last page is a valid page
  if($_SESSION['LAST-PAGE'] === 'scoreform') {
    $_SESSION['LAST-PAGE'] = "savescore";
  } else {
    header("Location: https://students.calu.edu/calupa/mac7537/idprompt.php");
    exit();
  }

  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']))
  {
    $visual = $_POST["visual"];
    $clarity = $_POST["clarity"];
    $thoroughness = $_POST["thoroughness"];
    $breadth = $_POST["breadth"];
    $depth = $_POST["depth"];
    $quality = $_POST["quality"];
    $discussion = $_POST["discussion"];
    $understanding = $_POST["understanding"];
    $overall = $_POST["overall"];
    $comment = $_POST["comments"];

    if (empty($comment)) {
      $comment = "[No Comment]";
    }

    //not sure if this works. I accidentally did this so thought I'd throw it here
    $bigfancystatement = "insert into SCORES values ("
      . $visual
      . "," . $clarity
      . "," . $thoroughness
      . "," . $breadth
      . "," . $depth
      . "," . $quality
      . "," . $discussion
      . "," . $understanding
      . "," . $overall
      . ",'" . $comment . "'"
      . "," . $_SESSION['CURRENT-POSTER-ID']
      . ",'" . $_SESSION['JUDGE-ID'] . "'"
      . ",'N'"
      . ",'" . $_SESSION['JUDGE-ALIAS'] . "')";

      setCNXHandle($cnx);
      execStatement($cnx,$bigfancystatement);
      closeCNXHandle($cnx);

      header("Location: ../scoresaved.php");
  exit();
}
else { //user tried to access idprompt.php without permission
  header("Location: ../index.html");
  exit();
}
?>
