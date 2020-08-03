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

require "../../includes/dbprotocols.php";
session_start();
unset($_SESSION['ADMIN-LOGGED-IN']);      //logging us out of previous session

if (!isset($_SESSION['ADMIN-LOGGED-IN'])) {

		//I had to use dumb logic for this. Please for the love of god simplify this into a couple different header files next time
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			echo "<script>
							alert('You must log in to access this page');
							window.location.href='../index.html';
						</script>";
			exit();
		}

  $old_password = $_POST["Old-Pass"];
  $new_password = $_POST["New-Pass"];

  if (!isset($old_password)) {
			echo "<script>
							alert('Invalid password');
							window.location.href='../ChangeJudge.php';
						</script>";
			exit();
		}

    $loginsqlstatement = "select 1
    from variables
    where universal_password = '" . $old_password . "'";

  setCNXHandle($cnx);
  $passresource = execStatement($cnx,$loginsqlstatement);
  $globalpassok = oci_fetch_array($passresource, OCI_BOTH)[1];
  closeCNXHandle($cnx,$passresource);

  if($globalpassok != 1)
  {
    echo "<script>
          alert('Invalid password!');
          window.location.href='../ChangeJudge.php';
        </script>";
  exit();
  }
  else {
          //change password here
          echo "<script>
                alert('Judge Password changed!');
                window.location.href='../index.html';
              </script>";

    }
  }




 ?>
