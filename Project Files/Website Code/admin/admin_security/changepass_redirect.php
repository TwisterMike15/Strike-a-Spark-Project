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

	require "./adminlogincheck.php";
	require "../../includes/dbprotocols.php";

	if($_SERVER['REQUEST_METHOD'] !== 'POST') {
		echo "<script>
						alert('You must log in to access this page');
						window.location.href='../index.html';
					</script>";
		exit();
	}

	function validateOldPass($passcolumn,$old_pass) {
		$loginsqlstatement = "select 1
	    from variables
	    where " . $passcolumn . " = '" . $old_pass . "'";

		setCNXHandle($cnx);
	  $passresource = execStatement($cnx,$loginsqlstatement);
	  $oldpassmatches = oci_fetch_array($passresource, OCI_BOTH)[1];
	  closeCNXHandle($cnx,$passresource);

		return $oldpassmatches;
	}

	function setNewPass($passcolumn,$new_pass) {
		$loginsqlstatement = "update variables
		  set " . $passcolumn . " = '" . $new_pass . "'";

		setCNXHandle($cnx);
	  execStatement($cnx,$loginsqlstatement);
	  closeCNXHandle($cnx);

		echo "<script>
					alert('Password successfully changed! Hope you remembered that!');
					window.location.href='../AdminPanel.php';
				</script>";
	}

  if (isset($_POST["Old-Judge-Pass"]) && isset($_POST["New-Judge-Pass"])) {
		$old_pass = $_POST["Old-Judge-Pass"];
	  $new_pass = $_POST["New-Judge-Pass"];
		echo $old_pass;
		if (validateOldPass("universal_password",$old_pass))
			setNewPass("universal_password",$new_pass);
		else {
			echo "<script>
				alert('The old password you entered was invalid. Please try again.');
				window.location.href='http://students.calu.edu/calupa/mac7537/admin/ChangeJudge.php';
			</script>";
			exit();
		}


	}	else if (isset($_POST["Old-Admin-Pass"]) && isset($_POST["New-Admin-Pass"])) {
		$old_pass = $_POST["Old-Admin-Pass"];
		$new_pass = $_POST["New-Admin-Pass"];
		if (validateOldPass("admin_password",$old_pass))
			setNewPass("admin_password",$new_pass);
		else {
			echo "<script>
				alert('The old password you entered was invalid. Please try again.');
				window.location.href='http://students.calu.edu/calupa/mac7537/admin/ChangeAdmin.php';
			</script>";
			exit();
		}

	} else {
		echo "<script>
						alert('Something went wrong when loading this page. Let's try that again.');
						window.location.href='../ChangeAdmin.php';
					</script>";
		exit();
	}
 ?>
