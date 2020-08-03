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

  if ($_SESSION['LAST-PAGE'] === "idprompt_redirect")
    $_SESSION['LAST-PAGE'] = "scoreform";
  else {
    header("Location: https://students.calu.edu/calupa/mac7537/idprompt.php");
    exit();
  }

  function populateList($attributename,$max_score) {
    echo "<select name=\"" . $attributename . "\" id=\"" . $attributename . "\">";
    echo "<option value = \"\"></option>";
    for ($i = 0;$i<=$max_score;$i++)
      echo "<option value = \"" . $i . "\">" . $i . "</option>";

    echo "</select>";
  }
?>

<style>
textarea {
  min-width: 50%;
  min-height: 10%;
  max-width: 70%;
  max-height: 25%;
}
</style>

<script>
//Solely for testing purposes to quickly navigate
function PassIn() {
  var visualin = "1";
  var clarityin = "2";
  var thoroughnessin = "3";
  var breadthin = "1";
  var depthin = "2";
  var qualityin = "3";
  var discussionin = "4";
  var understandingin = "5";
  var overallin = "6";
  document.getElementById("visual").value = visualin;
  document.getElementById("clarity").value = clarityin;
  document.getElementById("thoroughness").value = thoroughnessin;
  document.getElementById("breadth").value = breadthin;
  document.getElementById("depth").value = depthin;
  document.getElementById("quality").value = qualityin;
  document.getElementById("discussion").value = discussionin;
  document.getElementById("understanding").value = understandingin;
  document.getElementById("overall").value = overallin;
}
</script>


<meta name="viewport" content="width=device-width, initial-scale=0.9">
<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link rel="stylesheet" href="Style/style.css">
  </head>


  <body>
    <center>
      <h1 class="thinredborder header">Strike a Spark Conference Judging App</h1>
      <div class="subhead">
      <h2>Please enter a grade for each category. You may save this form and return to it later.</h2>
      <p>You are currently scoring poster # <?php echo $_SESSION['CURRENT-POSTER-ID']; ?></p>
    </div>
      <form action ="./includes/savescore.php" method="POST" onsubmit="return ValidateFields();">

      <div class="title">Poster Design:</div>
      <div class="category">
        <?php populateList("visual",4); ?>
          <label>Visual Quality</label><br>
        <?php populateList("clarity",3); ?>
          <label>Clarity</label><br>
        <?php populateList("thoroughness",4); ?>
          <label>Thoroughness</label><br>
      </div>


      <div class="title">Research:</div>
      <div class="category">
        <?php populateList("breadth",3); ?>
          <label>Breadth of Research</label><br>
        <?php populateList("depth",3); ?>
          <label>Depth of Research</label><br>
        <?php populateList("quality",3); ?>
          <label>Quality of Analysis</label><br>
        <?php populateList("discussion",5); ?>
          <label>Discussion Quality</label><br>
      </div>


      <div class="title">Researcher:</div>
      <div class="category">
        <?php populateList("understanding",5); ?>
          <label>Understanding of Research</label><br>
      </div>


      <div class="title">Overall Quality:</div>
      <div class="category">
          <?php populateList("overall",10); ?>
            <label>Overall Quality</label><br>
      </div>


      <div class="textboxtitle">Constructive Comments (150-character limit)</div>
      <div class="textboxtitle">Scores above will not be shown to the presenter, but your comments may</div>
      <div class="textbox">
        <textarea name = "comments" class="FormElement" name="comments" placeholder="Only the comments may be shown to presenter"
                      id="term" maxlength="150"cols="50" rows="10"></textarea>
        <br>
        <button type = "submit" name = "submit">Save for Review</button>

        <a href="idprompt.php">
          <button type = "button">Cancel</button>
        </a>
      </div>
    </form>

    <button onclick="location.href='loggedout.php'" type="button">
    Logout</button>

    <script> //PassIn() </script>
  </center>
  <br>
  <br>
</body>


<script>
  function PassIn()
  {
    var visualin = "1";
    var clarityin = "2";
    var thoroughnessin = "3";
    var breadthin = "1";
    var depthin = "2";
    var qualityin = "3";
    var discussionin = "4";
    var understandingin = "5";
    var overallin = "6";
    document.getElementById("visual").value = visualin;
    document.getElementById("clarity").value = clarityin;
    document.getElementById("thoroughness").value = thoroughnessin;
    document.getElementById("breadth").value = breadthin;
    document.getElementById("depth").value = depthin;
    document.getElementById("quality").value = qualityin;
    document.getElementById("discussion").value = discussionin;
    document.getElementById("understanding").value = understandingin;
    document.getElementById("overall").value = overallin;
  }

  function ValidateFields()
  {
  	var check = false;
    var visual=document.getElementById("visual").value;
  	var clarity=document.getElementById("clarity").value;
  	var thoroughness=document.getElementById("thoroughness").value;
  	var breadth=document.getElementById("breadth").value;
  	var depth=document.getElementById("depth").value;
  	var quality=document.getElementById("quality").value;
  	var discussion=document.getElementById("discussion").value;
  	var understanding=document.getElementById("understanding").value;
  	var overall=document.getElementById("overall").value;

  	if(visual == "" || clarity == "" || thoroughness == "" || breadth == "" || depth == "" || quality == "" || discussion == "" || understanding == "" || overall == "")
  	{
  		alert("Make sure that you have entered a value to each field.");
  	}
  	else
  	{
      check = true;
  	}

  return check;
  }
  </script>
</html>
