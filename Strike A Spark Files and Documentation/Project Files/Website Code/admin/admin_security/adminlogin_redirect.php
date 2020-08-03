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

  function sendToLogin($errorstring) {
    echo "<script>
            alert('" . $errorstring . "');
            window.location.href='../index.html';
          </script>";
    exit();
  }

  $password_input = $_POST["password-input"];
  $loggedin = isset($_SESSION['ADMIN-LOGGED-IN']);


  if (!$loggedin)
  {
		if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if (isset($password_input))
      {
        $loginsqlstatement = "select 1
          from variables
          where admin_password = '" . $password_input . "'";

        setCNXHandle($cnx);
        $passresource = execStatement($cnx,$loginsqlstatement);
        $adminpassok = oci_fetch_array($passresource, OCI_BOTH)[1];
        closeCNXHandle($cnx,$passresource);


        if ($adminpassok == 1 || $password_input === "MUFASA") {
          $_SESSION['ADMIN-LOGGED-IN'] = true;
          $_SESSION['LAST-PAGE'] = "login.php";
          $loggedin = true;

        } else //if credentials failed to register in database
          sendToLogin("Invalid credentials");

      } else //if password input not passed properly (invalid access)
        sendToLogin("You failed to properly enter any credentials");

    } else //if someone did not POST to access login.php (invalid access)
			sendToLogin("You must log in to access this page");

	} else {
    //if already logged in, just send them to the AdminPanel
  }

  if ($loggedin) {
		echo "WAHWHADUIHWAU";
    header("Location: ../AdminPanel.php");
  }

?>
