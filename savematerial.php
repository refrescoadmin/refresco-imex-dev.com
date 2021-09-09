<?php


include "include/db.inc";

$ref= $_GET["ref"];
$qty = $_POST["txtQty"];
$day = $_POST["cmbday"];
$period = $_POST["cmbperiod"];

$qrystr = "insert into edi_rules values(null,'$ref','$day','$period','$qty','')";
echo $qrystr;
$result = mysql_query( $qrystr);	



	header( "Location: addrule.php?cust=" .  $ref); 


//header( "Location: new_entry_cpm1.php?ref=" .  $ref); 


?>