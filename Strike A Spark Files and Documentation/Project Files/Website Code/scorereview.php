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

  if($_SESSION['LAST-PAGE'] === "idprompt_redirect")
    $_SESSION['LAST-PAGE'] = "scorereview";
  else {
    header("Location: http://students.calu.edu/calupa/mac7537/idprompt.php");
    exit();
  }

  $databasescores = $_SESSION['SCORERECORD'];

  function populateList($attributename,$max_score,$defaultvalue=null) {
    echo "<select name=\"" . $attributename . "\" id=\"" . $attributename . "\">";
    echo "<option value = \"\"></option>"; //empty option
    for ($i = 0;$i<=$max_score;$i++)
      if ($i == $defaultvalue)
        echo "<option value = \"" . $i . "\" selected>" . $i . "</option>"; //iteration options
      else
        echo "<option value = \"" . $i . "\">" . $i . "</option>"; //iteration options

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
      <p>You are currently reviewing poster # <?php echo $_SESSION['CURRENT-POSTER-ID']; ?></p>
    </div>
      <form action ="includes\updatescore.php" method="POST" onsubmit="return ValidateFields();">

      <div class="title">Poster Design:</div>
      <div class="category" name="design">
          <?php populateList("visual",4,$databasescores['VISUAL']); ?>
            <label>Visual Quality</label><br>
          <?php populateList("clarity",3,$databasescores['CLARITY']); ?>
            <label>Clarity</label><br>
          <?php populateList("thoroughness",4,$databasescores['THOROUGHNESS']); ?>
            <label>Thoroughness</label><br>
      </div>


      <div class="title">Research:</div>
      <div class="category" name="research">
          <?php populateList("breadth",3,$databasescores['BREADTH']); ?>
            <label>Breadth of Research</label><br>
          <?php populateList("depth",3,$databasescores['DEPTH']); ?>
            <label>Depth of Research</label><br>
          <?php populateList("quality",3,$databasescores['QUALITY']); ?>
            <label>Quality of Analysis</label><br>
          <?php populateList("discussion",5,$databasescores['DISCUSSION']); ?>
            <label>Discussion Quality</label><br>
      </div>


      <div class="title">Researcher:</div>
      <div class="category" name="researcher">
          <?php populateList("understanding",5,$databasescores['UNDERSTANDING']); ?>
            <label>Understanding of Research</label><br>
      </div>


      <div class="title">Overall Quality:</div>
      <div class="category" name="overallquality">
          <?php populateList("overall",10,$databasescores['OVERALL']); ?>
            <label>Overall Quality</label><br>
      </div>


      <div class="textboxtitle">Please type any encouraging or constructive
        comments you have for the presenter (150-character limit).
        Rubric scores will not be shared, but your written comments likely will be.
      </div>

      <div class="textboxtitle">Constructive Comments (150-character limit)</div>
      <div class="textboxtitle">Scores above will not be shown to the presenter, but your comments may</div>
      <div class="textbox">
        <textarea name = "comments" class="FormElement" name="comments" placeholder="Only the comments may be shown to presenter"
                      id="term" maxlength="150"cols="40" rows="4"></textarea>
        <?php echo "<script> document.getElementById('term').value= '"
            . $databasescores['COMMENTS']
            . "'</script>"; ?>
        <br>
        <button type = "submit" name = "submit">Submit</button>

        <a href="idprompt.php">
          <button type = "button">Cancel</button>
        </a>
      </div>

    </form>

    <button onclick="location.href='loggedout.php'" type="button">
    Logout</button>

  </center>
  <br>
  <br>
</body>


<script>
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
  		alert("Make sure that you have entered a value to each field.")
  	}
  	else
  	{
  		check = confirm("You cannot make any changes to this poster once you submit it. Press OK to confirm submission");
  	}

  return check;
  }
  </script>
</html>
