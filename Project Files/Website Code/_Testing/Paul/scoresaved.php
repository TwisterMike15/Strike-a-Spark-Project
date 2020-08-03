<style>
  body
  {
    background-color: #5E5E5E;
  }
  h1
  {
    font-style: normal;
    font-size: 68px;
    font-family: Anton;
  }
</style>


<?php
  require 'includes\logincheck_security.php';
?>

<meta name="viewport" content="width=device-width, initial-scale=0.9">
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <!DOCTYPE html>
      <html>
        <head>

            <center>
              <h1><font color = "white">Strike a Spark Conference Judging App</font></h1>
        </head>
              <body>

                <p style="font-size:30px"><font color = "white">Either submit your score for this poster now, or score another poster and come back to this one later.</font>
                <br>
                </p>

                <button onclick="location.href='scoresubmitted.php'" type="button">
                         Submit Score</button>

                <button onclick="location.href='idprompt.php'" type="button">
                	 Score another Poster</button>

              </body>
            </center>
      </html>
