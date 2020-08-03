<?php
  session_start();
  echo $_SESSION['LOGGED-IN'];
  if(!isset($_SESSION['LOGGED-IN']))
  {
    echo "<script>
      alert('You must sign in to access this page');
      window.location.href='./index.html?index=InvalidCreditials';
    </script>";
    exit();
  }
?>
