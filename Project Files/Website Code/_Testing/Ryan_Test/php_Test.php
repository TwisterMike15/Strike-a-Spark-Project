<?php

//$file = fopen("contacts.csv","r");

$file = fopen("contacts.csv","r");
// read first line

echo implode(" ",fgetcsv($file));

//fgets($file);
// move back to beginning of file

echo implode(" ",fgetcsv($file));

fseek($file,-4,SEEK_END);

echo implode(" ",fgetcsv($file));

fclose($file);

?>
