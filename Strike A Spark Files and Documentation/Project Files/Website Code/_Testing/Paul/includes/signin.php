<?php
session_start();

$pwdConst = "123Password";
//$_SESSION['LAST-PAGE'] = basename($_SERVER['PHP_SELF']);


unset($_SESSION['LOGGED-IN']);
unset($_SESSION['CURRENT-POSTER-ID']);

if(isset($_POST['submit']))
{
  $judge_id_input = $_POST["judge-id-input"];
  $password_input = $_POST["password-input"];

  if($password_input === $pwdConst)
  {
    //if(database says ok(judge_id_input)) {
    $_SESSION['LOGGED-IN'] = true;

    header("Location: ../idprompt.php");
    exit();
  }
  else
  {
    echo "<script>
            alert('Wrong ID/Password');
            window.location.href='../index.html?index=InvalidCreditials';
          </script>";
    exit();
  }
} else { //user tried to access idprompt.php without permission
  header("Location: ../index.html");
  exit();
}

?>
