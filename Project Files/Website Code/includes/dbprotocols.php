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


//getCNX:
//Assigns the database connection to $cnxhandle reference
function setCNXHandle(&$cnxhandle) {
  $cnxhandle = oci_connect('smi2479','smi2479', 'ORCL');
}

//execStatement:
//Takes in a $cnxhandle and a $command string
//Returns the database's returned values from the statement
function execStatement($cnxhandle,$command) {
  $statementdata = oci_parse($cnxhandle, $command);
  oci_execute($statementdata);

  return $statementdata;
}

//closeCNXHandle:
//Takes in a $cnxhandle and an optional $statementdata
//If $statementdata is provided, it frees the statement's data
//Closes the cnxhandle to the database
function closeCNXHandle($cnxhandle,$statementdata = null) {
  if ($statementdata !== null) {
    oci_free_statement($statementdata);
  }

  oci_close($cnxhandle);
}



?>
