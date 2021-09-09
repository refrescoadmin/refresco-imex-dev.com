<?php


include "include/db.inc";

$ref= $_GET["ref"];
$ref_parent = $_POST["ref_parent"];

if ($ref_parent == "")
{
$qrystr = "insert into combine_departure values('$ref','$ref')";
$result = mysql_query($qrystr);
$qrystr = "update decloration_header set dh_header_child = 'H' where dh_primary_id = '$ref'" ;
$result = mysql_query($qrystr);
$ref_parent = $ref;
}
else
{
$qrystr = "insert into combine_departure values('$ref_parent','$ref')";
$result = mysql_query($qrystr);
$qrystr = "update decloration_header set dh_header_child = 'C' where dh_primary_id = '$ref'" ;
$result = mysql_query($qrystr);
}






	header( "Location: combinedeparture.php?ref=" .  $ref_parent); 


//header( "Location: new_entry_cpm1.php?ref=" .  $ref); 


?>