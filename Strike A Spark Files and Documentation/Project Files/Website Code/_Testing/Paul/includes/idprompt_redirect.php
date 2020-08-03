<?php

  //Set default session values once index page is hit
  session_start();

  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    if(isset($_POST['score']))
    {
      header("Location: ../scoreform.php");
      exit();
    }
    elseif(isset($_POST['review']))
    {
      header("Location: ../scorereview.php");
      exit();
    }
    else
    { echo "Error; neither score not review set";
    }
  }

?>
