<?php
  /*
  Strike A Spark Web Application

  Group Members with emails:
  Michael Gorse- gor9632@calu.edu
  Anthony Carrola- car3766@calu.edu
  Paul MacLean- mac7537@calu.edu
  Brittany Marietta- mar0274@calu.edu
  Ryan Merow- mer3942@calu.edu
  Zachary Smith- smi2479@calu.edu


  //This page formats database information into a large nested hierarchical dictionary.
  //Using the nested dictionary, the


  //The dictionary ends up looking like this (Use outputDict() to get the live contents in the format seen below)

  Degree Level: Undergraduate = {
   Area of Study: EHS = {
     Category: Class = {
       Poster Id: 3 = { //==========THIS IS A "POSTER DATA"
         Score array. Max Score=2 //=========THIS IS A "SCORE DATA"
         Score array. Max Score=1
       }
     }
     Category: Individual = {
       Poster Id: 7 = {
         Score array. Max Score=5
       }
       Poster Id: 1 = {
         Score array. Max Score=1
         Score array. Max Score=7
       }
     }
   }
  }

  PosterData contains:
      - "id"         => The poster's ID
      - "creators"   => The poster's makers
      - "prestime"   => The poster's presentation time (AM/PM)
      - "finalscore" => The poster's calculated score (Calculated from getTotalScores())
      - "scores"     => An array of all scores belonging to this poster

  ScoreData contrains:
      - "judgeid","judgealias","submitted","visual","clarity","thoroughness",
      - "breadth","depth","quality","discussion","understanding","overall",
      - "comments","sum"



  */
  require "./admin_security/adminlogincheck.php";
  require "../includes/dbprotocols.php";


?>


<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
<link rel="icon" href="https://i.imgur.com/XciPCw8.png">

<meta name="viewport" content="width=device-width, initial-scale=0.9">

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../Style/style.css">
    <style>
      table, th, td {
        empty-cells: hide;
        border: 0px solid black;
        border-collapse: collapse;
      }
      th, td {
        padding: 5px;
        text-align: left;
      }
    </style>

  </head>

  <body>
    <center>
    <h1 class="header">Results</h1>
    <br><br>

    <?php
      $AllPosters = array();


      //Creates/follows a tier of associative arrays, down to the level of a poster's unique location
      function initializePosterDest(&$AllPosters,$deg,$study,$category) {
        //Create an associative array to hold all areas of study within Grad/Undergrad
        if (!isset($AllPosters[$deg])) {
          $AllPosters[$deg] = array();
        }

        //Create an associative array to hold all categories within a given area of study & degree level
        if(!isset($AllPosters[$deg][$study])) {
          $AllPosters[$deg][$study] = array();
        }

        //Create a numeric array to hold each poster entry
        if (!isset($AllPosters[$deg][$study][$category])) {
          $AllPosters[$deg][$study][$category] = array();
        }
      }

      function formatIntoHierarchy(&$AllPosters,&$postermassdata) {
        $deg          = $postermassdata["DEGREE_LEVEL"];
        $study        = $postermassdata["AREA_OF_STUDY"];
        $category     = $postermassdata["CATEGORY"];
        $posterid     = $postermassdata["POSTER_ID"];
        $maker        = $postermassdata["NAME"];
        $prestime     = $postermassdata["PRESENT_TIME"];

        initializePosterDest($AllPosters,$deg,$study,$category);
        $PosterCategory = &$AllPosters[$deg][$study][$category];

        $NewScoreData = array( //A new ScoreData
          "judgeid"        => $postermassdata['JUDGE_ID'],
          "judgealias"     => $postermassdata['ALIAS'],
          "submitted"      => $postermassdata['SUBMITTED'],
          "visual"         => $postermassdata['VISUAL'],
          "clarity"        => $postermassdata['CLARITY'],
          "thoroughness"   => $postermassdata['THOROUGHNESS'],
          "breadth"        => $postermassdata['BREADTH'],
          "depth"          => $postermassdata['DEPTH'],
          "quality"        => $postermassdata['QUALITY'],
          "discussion"     => $postermassdata['DISCUSSION'],
          "understanding"  => $postermassdata['UNDERSTANDING'],
          "overall"        => $postermassdata['OVERALL'],
          "comments"       => $postermassdata['COMMENTS'],
          "sum"            => $postermassdata['SUMZERO']
        );

        //See if the (score sent into this function)'s poster ID is already defined in a category
        $posterindex = -1; //assume false
        foreach ($PosterCategory as $Posteri => $PosterData) {
          if ($PosterData["id"] == $posterid) {
            $posterindex = $Posteri;
            break;
          }
        }

        //If the poster ID isn't already placed in a category, create an entry
        if ($posterindex == -1) {
          $posterindex = sizeof($PosterCategory); //The poster index will be the # of elements in a category, before we put in a new one

          //Push the poster's data into the category
          array_push($PosterCategory,array( //This is the poster's data. It also holds an array of scores.
            "id"         => $posterid,
            "creators"   => $maker,
            "prestime"   => $prestime,
            "finalscore" => 0,
            "scores"     => array(),
          ));
        }

        array_push($PosterCategory[$posterindex]["scores"],$NewScoreData); //Push poster data into
      }


      function getTotalScores(&$AllPosters) {
        foreach($AllPosters as $DegreeName => &$DegreeLevels){ //Each degree level of all presenters
          foreach($DegreeLevels as $StudyName => &$AreasofStudy){ //Each area of study within a degree level
            foreach($AreasofStudy as $CategoryName => &$Categories) { //Each category within a degree level

              foreach($Categories as $Posteri => &$PosterData) { //Each poster within a category
                $PosterScores = &$PosterData["scores"];
                $FinalPosterScore = 0;
                $NumSubmitted = 0;

                foreach($PosterScores as $Scorei => $PosterScore) { //Each score belonging to a poster
                  if (strtolower($PosterScore['submitted']) === 'y') {
                    $FinalPosterScore = $FinalPosterScore + $PosterScore['sum'];
                    $NumSubmitted++;
                  }
                }

                usort($PosterScores,  function ($a, $b) {
                    return ($a["sum"] < $b["sum"]) ? 1 : -1;
                });

                if($NumSubmitted == 2) {
                  $FinalPosterScore = $FinalPosterScore + $FinalPosterScore/2;
                }

                $PosterData["finalscore"] = $FinalPosterScore;
              }

              //Sort all posters within category
              usort($Categories,  function ($a, $b) {
                  return ($a["finalscore"] < $b["finalscore"]) ? 1 : -1;
              });

            }
          }
        }
      }

      function displayPosterResults(&$PosterScores) {
        $HeaderColor = '#93A5AF';

        echo '<tr>
                <th bgcolor="#8BA3E8" colspan="2"></th>
                <th bgcolor="#93A55B" colspan="2" style="border-top: 4px solid #000;border-left: 4px solid #000;">
                  Poster #' . $PosterScores["id"] . '
                </th>
                <th bgcolor="#93A55B" colspan="2" style="border-top: 4px solid #000;">Total score: ' . $PosterScores["finalscore"] . '</th>
                <th bgcolor="#93A55B" colspan="12" style="border-top: 4px solid #000;"></th>
              </tr>
              <tr>
                <th bgcolor="#8BA3E8" colspan="2"></th>
                <th bgcolor="' . $HeaderColor . '" style="border-left: 4px solid #000;>Scores:</th>
                <th bgcolor="' . $HeaderColor . '">Judge Id</th>
                <th bgcolor="' . $HeaderColor . '">Judge Alias</th>
                <th bgcolor="' . $HeaderColor . '">Submitted</th>
                <th bgcolor="' . $HeaderColor . '">Session</th>
                <th bgcolor="' . $HeaderColor . '">Visual</th>
                <th bgcolor="' . $HeaderColor . '">Clarity</th>
                <th bgcolor="' . $HeaderColor . '">Thoroughness</th>
                <th bgcolor="' . $HeaderColor . '">Breadth</th>
                <th bgcolor="' . $HeaderColor . '">Depth</th>
                <th bgcolor="' . $HeaderColor . '">Quality</th>
                <th bgcolor="' . $HeaderColor . '">Discussion</th>
                <th bgcolor="' . $HeaderColor . '">Understanding</th>
                <th bgcolor="' . $HeaderColor . '">Overall</th>
                <th bgcolor="' . $HeaderColor . '">Sum</th>
                <th bgcolor="' . $HeaderColor . '">Comments</th>
            </tr>';

        foreach($PosterScores['scores'] as $Posteri => $PosterScore) { //Each poster within a category
          if (strtolower($PosterScore['submitted']) === 'y') {
            $rowcolor = 'D5DAE8';
          } else
            $rowcolor = 'D36B5B';

          echo '<tr>
                  <td bgcolor="#8BA3E8" width="10%" colspan="2"></td>
                  <td bgcolor="#' . $rowcolor . '" width="10%" colspan="1" style="border-left: 4px solid #000;></td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['judgeid'] . '</th>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['judgealias'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['submitted'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScores['prestime'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' .  $PosterScore['visual'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['clarity'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['thoroughness'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['breadth'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['depth'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['quality'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['discussion'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['understanding'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['overall'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['sum'] . '</td>
                  <td bgcolor="#' . $rowcolor . '" width="10%">' . $PosterScore['comments'] . '</td>
                </tr>';
          }
        }

      function outputAllScores(&$AllPosters) {
        foreach($AllPosters as $DegreeName => $DegreeLevels){ //Each degree level of all presenters
          echo '<p>' . $DegreeName . '</p>
                <table>';

          foreach($DegreeLevels as $StudyName => $AreasofStudy){ //Each area of study within a degree level
            echo '<tr>
                    <th bgcolor="#5D7B9D" width="20%">' . $StudyName . '</th>
                    <th bgcolor="#5D7B9D" colspan="16">
                    <th bgcolor="#5D7B9D"></th>
                  </tr>';

            foreach($AreasofStudy as $CategoryName => $Categories) { //Each category within a degree level
              echo '<tr>
                      <th bgcolor="#8BA3E8" colspan="2" style="text-align:right;border-top: 4px solid #000;">' . $CategoryName . ' Projects </th>
                      <th bgcolor="#8BA3E8" colspan="3" style="border-top: 4px solid #000;"></th>
                    </tr>';

              foreach($Categories as $PosterId => $PosterScores) { //Each poster within a category
                displayPosterResults($PosterScores);
              }
            }
          }

          echo '</table>';
        }
      }

      function outputDict(&$AllPosters) {
        echo '<div style = "text-align:left">';
        foreach($AllPosters as $DegreeName => $DegreeLevels){ //Each degree level of all presenters
          echo "Degree Level: " . $DegreeName  . " = {<br>";
          foreach($DegreeLevels as $StudyName => $AreasofStudy){ //Each area of study within a degree level
            echo "&emsp;Area of Study: " . $StudyName  . " = {<br>";
            foreach($AreasofStudy as $CategoryName => $Categories) { //Each category within a degree level
              echo "&emsp;&emsp;&emsp;Category: " . $CategoryName  . " = {<br>";

              foreach($Categories as $Posteri => $PosterData) { //Each poster within a category
                  echo "&emsp;&emsp;&emsp;&emsp;&emsp;Poster Id: " . $PosterData["id"]  . " = {<br>";

                  foreach($PosterData["scores"] as $Scorei => $ScoreData) {
                    echo "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Score array. Max Score=" . $ScoreData["sum"] . " <br>";
                  }
                  echo "&emsp;&emsp;&emsp;&emsp;&emsp;} <br>";
              }
              echo "&emsp;&emsp;&emsp;} <br>";
            }
            echo "&emsp;} <br>";
          }
          echo "} <br>";
        }
        echo '</div>';//*/
      }




      setCNXHandle($cnx);
      $results = execStatement($cnx,'select
        poster.poster_id, poster.present_time, presenter.name, presenter.degree_level, presenter.area_of_study, presenter.category,
        scores.judge_id,alias,
        visual,clarity,thoroughness,breadth,depth,quality,discussion,understanding,overall,comments,submitted,
        (visual + clarity + thoroughness + breadth + depth + quality + discussion + understanding + overall) as sumZero
        from scores
          INNER JOIN judge ON judge.judge_id = scores.judge_ID
          INNER JOIN poster ON poster.poster_ID = scores.poster_ID
          INNER JOIN owns ON poster.poster_ID = owns.poster_ID
          INNER JOIN presenter ON presenter.presenter_ID = owns.presenter_ID
        order by presenter.degree_level, presenter.area_of_study, presenter.category');

      while( ($posterscoredata = oci_fetch_array($results, OCI_BOTH)) != false) {
        formatIntoHierarchy($AllPosters,$posterscoredata); //Put each row of poster score & poster data into a big dictionary
      }

      closeCNXHandle($cnx,$results);

      getTotalScores($AllPosters);

      outputAllScores($AllPosters);
      outputDict($AllPosters);
    ?>

  </center>
  </body>
</html>
