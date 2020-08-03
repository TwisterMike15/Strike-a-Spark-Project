<?php
  require "./includes/logincheck_security.php";
  require "./includes/dbprotocols.php";
?>

<meta name="viewport" content="width=device-width, initial-scale=0.9">

<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
<!DOCTYPE html>
<html>
  <head>
    <style>
      body {
      	background-color: #5E5E5E;
      }
      h1 {
      	font-style: normal;
      	font-size: 68px;
      	font-family: Anton;
      	color: white;
      	}
      	.logo {
      		width: 120px;
      		border-width: 10px;
      		border-color: #000000;
      		border-style: solid;
      		border-radius: 50%;
      	}
    </style>
  </head>


  <body>
    <center>
      <h1>Strike a Spark Conference Judging App</h1>
      <img class="logo" src="https://pbs.twimg.com/profile_images/979358006663139328/0ShklWot_400x400.jpg" alt="Strike a spark">

      <p style="font-size:30px"><font color = "white">Enter the poster ID number for the poster you will score:</font></p>
      <br>
      <form action ="includes\idprompt_redirect.php" method="POST" onsubmit="return CheckID();">
        <select id="IDNum" name="IDNumber" required>
          <option selected = "selected" value = "0"></option>
          <?php
            setCNXHandle($cnx);
            $results = execStatement($cnx,'select * from poster');

            while( ($row = oci_fetch_array($results, OCI_BOTH)) != false) {
              echo "<option value=\"" . $row['POSTER_ID'] . "\">" . $row['TITLE'] . "</option>\n";
            }

            closeCNXHandle($cnx,$results);
          ?>
        </select>
        <script> SelectElement("IDNum", 0)</script>

        <br><br>
        <button type = "submit" name = "score">Score Poster</button>
        <button type = "submit" name = "review">Review Poster</button>
      </form>
    </center>
  </body>



  <script>
    function CheckID()
    {
    	var check = false;
      var poster = document.getElementById("IDNum").value;
    	if(poster == "")
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
