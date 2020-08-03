<?php
  require 'includes\logincheck_security.php';

  function populate($max_score,$databaseval = "") {
    echo "<option value = \"\"></option>";
    for ($i = 0;$i<=$max_score;$i++)
      echo "<option value = \"" . $i . "\">" . $i . "</option>";

    echo "<option selected = \"" . $databaseval . "\">" . $databaseval . "</option>";
  }
?>

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
  document.getElementById("VisualList").value = visualin;
  document.getElementById("ClarityList").value = clarityin;
  document.getElementById("ThoroughnessList").value = thoroughnessin;
  document.getElementById("BreadthList").value = breadthin;
  document.getElementById("DepthList").value = depthin;
  document.getElementById("QualityList").value = qualityin;
  document.getElementById("DiscussionList").value = discussionin;
  document.getElementById("UnderstandingList").value = understandingin;
  document.getElementById("OverallList").value = overallin;
}
</script>


<meta name="viewport" content="width=device-width, initial-scale=0.9">
<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>


  <body>
    <center>
      <h1 class="header">Strike a Spark Conference Judging App</h1>
      <h2>Please enter a grade for each category. You may save this form and return to it later.</h2>

      <form action ="./includes/savescores.php" method="POST" onsubmit="return ValidateFields();">

      <div class="title">Poster Design:</div>
      <div class="category">
          <select id = "VisualList">
            <?php populate(4); ?>
          </select>
          <label>Visual Quality</label><br>

          <select id = "ClarityList">
            <?php populate(3); ?>
          </select>
          <label>Clarity</label><br>

          <select id = "ThoroughnessList">
            <?php populate(4); ?>
          </select>
          <label>Thoroughness</label><br>
      </div>


      <div class="title">Research:</div>
      <div class="category">
          <select id = "BreadthList">
            <?php populate(3); ?>
          </select>
          <label>Breadth of Research</label><br>

          <select id = "DepthList">
            <?php populate(3); ?>
          </select>
          <label>Depth of Research</label><br>

          <select id = "QualityList">
            <?php populate(3); ?>
         	</select>
          <label>Quality of Analysis</label><br>

          <select id = "DiscussionList">
            <?php populate(5); ?>
          </select>
          <label>Discussion Quality</label><br>
      </div>


      <div class="title">Researcher:</div>
      <div class="category">
          <select id = "UnderstandingList">
            <?php populate(5); ?>
          </select>
          <label>Understanding of Research</label><br>
      </div>


      <div class="title">Overall Quality:</div>
      <div class="category">
        <select id = "OverallList">
          <?php populate(10); ?>
        </select>
        <label>Overall Quality</label><br>
      </div>


      <div class="textboxtitle">Please type any encouraging or constructive
        comments you have for the presenter (150-character limit).
        Rubric scores will not be shared, but your written comments likely will be.
      </div>


      <div class="textbox">
        <textarea class="FormElement" name="comments" id="term" maxlength="150"cols="40" rows="4"></textarea>
        <br>
        <button type = "submit" name = "submit">Save for Review</button>

        <a href="idprompt.php">
          <button type = "button">Cancel</button>
        </a>
      </div>
    </form>

    <script> PassIn() </script>
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
    document.getElementById("VisualList").value = visualin;
    document.getElementById("ClarityList").value = clarityin;
    document.getElementById("ThoroughnessList").value = thoroughnessin;
    document.getElementById("BreadthList").value = breadthin;
    document.getElementById("DepthList").value = depthin;
    document.getElementById("QualityList").value = qualityin;
    document.getElementById("DiscussionList").value = discussionin;
    document.getElementById("UnderstandingList").value = understandingin;
    document.getElementById("OverallList").value = overallin;
  }

  function ValidateFields()
  {
  	var check = false;
  	var visual=document.getElementById("VisualList").value;
  	var clarity=document.getElementById("ClarityList").value;
  	var thoroughness=document.getElementById("ThoroughnessList").value;
  	var breadth=document.getElementById("BreadthList").value;
  	var depth=document.getElementById("DepthList").value;
  	var quality=document.getElementById("QualityList").value;
  	var discussion=document.getElementById("DiscussionList").value;
  	var understanding=document.getElementById("UnderstandingList").value;
  	var overall=document.getElementById("OverallList").value;

  	if(visual == "" || clarity == "" || thoroughness == "" || breadth == "" || depth == "" || quality == "" || discussion == "" || understanding == "" || overall == "")
  	{
  		alert("Make sure that you have entered a value to each field.")
  	}
  	else
  	{
  		check = true;
  	}

  return check;
  }
  </script>
</html>
