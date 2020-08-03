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

  require "./dbprotocols.php";
  session_start();

  unset($_SESSION['LOGGED-IN']);
  unset($_SESSION['CURRENT-POSTER-ID']);
  unset($_SESSION['JUDGE-ID']);
  unset($_SESSION['JUDGE-ALIAS']);

  if(isset($_POST['submit']))
  {
    $judge_id_input = $_POST["judge-id-input"];
    $password_input = $_POST["password-input"];

    $judgesqlstatement = "select 1
      from judge
      where judge_id = '" . $judge_id_input . "'";

    setCNXHandle($cnx);
    $passresource = execStatement($cnx,$judgesqlstatement);
    $judgepassok = oci_fetch_array($passresource, OCI_BOTH)[1];
    closeCNXHandle($cnx,$passresource);



    if ($judgepassok == 1) { //check judge id
      $passwordsqlstatement = "select 1
        from variables
        where universal_password = '" . $password_input . "'";

      setCNXHandle($cnx);
      $passresource = execStatement($cnx,$passwordsqlstatement);
      $globalpassok = oci_fetch_array($passresource, OCI_BOTH)[1];
      closeCNXHandle($cnx,$passresource);

      if($globalpassok ==  1) //check global password
      {
        $_SESSION['JUDGE-ALIAS'] = $_POST["alias-input"];
        $_SESSION['LOGGED-IN'] = true;
        $_SESSION['JUDGE-ID'] = $judge_id_input;
        header("Location: ../idprompt.php");
        exit();
      }
    }

    echo "<script>
            alert('Wrong ID/Password');
            window.location.href='../index.html?index=InvalidCreditials';
          </script>";
    exit();

  } else { //user tried to access idprompt.php without permission
    header("Location: ../index.html");
    exit();
  }
?>
