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

  require './dbprotocols.php';
  require './logincheck_security.php';
  if(!isset($_SESSION))
  {
    session_start();
  }

  //Make sure last page is a valid page
  if($_SESSION['LAST-PAGE'] === 'idprompt') {
    $_SESSION['LAST-PAGE'] = "idprompt_redirect";
  } else {
    header("Location: https://students.calu.edu/calupa/mac7537/idprompt.php");
    exit();
  }

  //default the current poster id
  unset($_SESSION['CURRENT-POSTER-ID']);

  function scoreButtonClicked($submittedflag,$selectedposterid) {
    if( empty($submittedflag) ) {
      //Record not yet created; redirect to score page to create a new one...
      $_SESSION['CURRENT-POSTER-ID'] = $selectedposterid; //set poster ID
      header("Location: ../scoreform.php");

    } elseif( $submittedflag === 'N' ) {
      //Record does exist; record is Not submitted
      echo "<script>
              alert('You have saved but not yet submitted a score for poster " . $selectedposterid . "; you must select *review* to change it');
              window.location.href='../idprompt.php';
            </script>";

    } elseif( $submittedflag === 'Y' ) {
      //Record does exist; record is Yes submitted
      echo "<script>
              alert('You have already submitted a score for poster " . $selectedposterid . ", and it cannot be altered');
              window.location.href='../idprompt.php';
            </script>";
    }
  }

  function reviewButtonClicked($submittedflag,$record,$selectedposterid) {
    if( empty($submittedflag) ) {
      //Record not yet created; cannot alter a non-existing record...
      echo "<script>
              alert('You cannot review a score that you have not yet begun; please click the \"Score Poster\" button');
              window.location.href='../idprompt.php';
            </script>";

    } elseif( $submittedflag === 'N' ) {
      //Record does exist; record is Not submitted
      $_SESSION['CURRENT-POSTER-ID'] = $selectedposterid; //set poster ID
      $_SESSION['SCORERECORD'] = $record;
      header("Location: ../scorereview.php");

    } elseif( $submittedflag === 'Y' ) {
      //Record does exist; record is Yes submitted
      echo "<script>
              alert('You have already submitted a score for poster " . $selectedposterid . "; you cannot resubmit or change it at this point');
              window.location.href='../idprompt.php';
            </script>";
    }
  }


  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    $selectedposterid = $_POST["IDNumber"];

    setCNXHandle($cnx);
    $recordobj = execStatement($cnx,'SELECT *
      FROM scores
      INNER JOIN judge ON scores.judge_ID = judge.judge_ID
      INNER JOIN poster ON scores.poster_ID = poster.poster_ID
      WHERE judge.judge_ID=\'' . $_SESSION['JUDGE-ID'] . '\' and poster.poster_ID=\'' . $selectedposterid . '\'');

    $record = oci_fetch_array($recordobj, OCI_BOTH);
    closeCNXHandle($cnx,$recordobj);


    if ( isset($selectedposterid) )
    {
      if( isset($_POST['score']) )
        scoreButtonClicked($record['SUBMITTED'],$selectedposterid);
      elseif( isset($_POST['review']) )
        reviewButtonClicked($record['SUBMITTED'],$record,$selectedposterid);
      else
        echo "Error; neither score not review set";
    }
    else
      echo "Error; poster id not input";
  }

  exit();
?>
