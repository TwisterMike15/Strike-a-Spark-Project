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

  session_start();


  if(!isset($_SESSION['LOGGED-IN']))
  {
    echo "<script>
      alert('You must sign in to access this page');
      window.location.href='./index.html?index=InvalidCreditials';
    </script>";
    exit(); //cease loading the calling page
  }
?>
