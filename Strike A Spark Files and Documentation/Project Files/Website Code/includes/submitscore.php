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
  if($_SESSION['LAST-PAGE'] === 'scoresaved') {
    $_SESSION['LAST-PAGE'] = "submitscore";
  } else {
    header("Location: https://students.calu.edu/calupa/mac7537/idprompt.php");
    exit();
  }

  $updatestatement = "update SCORES set"
    . " submitted = 'Y'"
    . " where judge_ID = '" . $_SESSION['JUDGE-ID'] . "' and poster_ID = " . $_SESSION['CURRENT-POSTER-ID'];

  setCNXHandle($cnx);
  execStatement($cnx,$updatestatement);
  closeCNXHandle($cnx);

  header("Location: ../scoresubmitted.php");
  exit();
?>
