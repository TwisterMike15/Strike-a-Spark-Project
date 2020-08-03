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

  require "./includes/logincheck_security.php";
  require "./includes/dbprotocols.php";

  $_SESSION['LAST-PAGE'] = "idprompt";
  unset($_SESSION['CURRENT-POSTER-ID']);
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
      <img class="logo" src="https://pbs.twimg.com/profile_images/979358006663139328/0ShklWot_400x400.jpg" alt="Strike a spark">
      <br>
      <br>
      <br>
      <br>
      <div class="ptitle">
      Enter the poster ID number for the poster you will score:
    </div>
      <div class="pinput">
        <br>
        <form action ="includes\idprompt_redirect.php" method="POST" onsubmit="return CheckID();">
          <select id="IDNum" class="dropdown" name="IDNumber" required>
            <option selected = "selected" value = "empty"></option>
            <?php

              setCNXHandle($cnx);

              $results = execStatement($cnx,'select * from poster order by poster.poster_id');
              while( ($row = oci_fetch_array($results,OCI_BOTH)) != false) {
            	   echo "<option value=\"" . $row['POSTER_ID'] . "\">" . $row['POSTER_ID'] . ": " . $row['TITLE'] . "</option>\n";
              }

              /*usort($posterdata,  function ($a, $b) {
                  return $a['POSTER_ID'] <=> $b['POSTER_ID'];
              }); //<--I think it's in order now. Don't know cause it won't print Don't worry, have back up saved*/

              //echo print_r ($posterdata);
              closeCNXHandle($cnx);
            ?>
          </select>
      </div>
      <br>
      <button type = "submit" name = "score">Score Poster</button>
      <button type = "submit" name = "review">Review Poster</button>
      </form>
      <button onclick="location.href='loggedout.php'" type="button">
      Logout</button>
    </center>
  </body>



  <script>
    function CheckID()
    {
    	var check = false;
      var poster = document.getElementById("IDNum").value;

    	if(poster == "empty")
    	{
    		alert("You must enter the poster ID you would like to score/review");
    	}
    	else
    	{
    		check = true;
    		//send posterid to php
    	}
    	return check;
    }
  </script>

</html>
