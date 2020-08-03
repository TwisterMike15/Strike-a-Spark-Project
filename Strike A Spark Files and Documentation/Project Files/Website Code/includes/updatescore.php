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
  if($_SESSION['LAST-PAGE'] === 'scorereview') {
    $_SESSION['LAST-PAGE'] = "updatescore";
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

    $bigfancyupdatestatement = "update SCORES set"
      . "  visual = ". $visual
      . ", clarity = " . $clarity
      . ", thoroughness = " . $thoroughness
      . ", breadth = " . $breadth
      . ", depth = " . $depth
      . ", quality = " . $quality
      . ", discussion = " . $discussion
      . ", understanding = " . $understanding
      . ", overall = " . $overall
      . ", comments = '" . $comment . "'"
      . ", submitted = 'Y'"
      . ", alias = '" . $_SESSION['JUDGE-ALIAS'] . "'"
      . " where judge_ID = '" . $_SESSION['JUDGE-ID'] . "' and poster_ID = " . $_SESSION['CURRENT-POSTER-ID'];

    setCNXHandle($cnx);
    execStatement($cnx,$bigfancyupdatestatement);
    closeCNXHandle($cnx);
  }

  header("Location: ../scoresubmitted.php");
  exit();
?>
