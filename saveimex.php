
<?php
session_start();

include "include/db.inc";
include "include/functions.php";

echo $_POST['cmbPortDesp'];

$ref = $_GET["ref"];
$action = $_GET["action"];
$head = $_GET["head"];
$plants = $_GET["plant"];
$hold = $_GET["hold"];

if ($action == "send")
$status = "FTP";
else
$status = "UPDATE";

if ($hold == "Y")
$status = "HOLD";

$qrystr = "UPDATE decloration_additional SET " .  
"da_despatch_port = '" . $_POST['cmbPortDesp'] . "'," .
"da_despatch_date = '" . toMysqldate($_POST['dateDesp']) . "'," .
"da_arrival_port = '" . $_POST['cmbPortArrive'] . "'," .
"da_arrival_date = '" . toMysqldate($_POST['dateArrive']) . "'," .
"da_vehicle_reg = '" . $_POST['txtReg'] . "'," .
"da_haulier = '" . $_POST['cmbHaulier'] . "'," .
"da_driver_name = '" . $_POST['txtdriver'] . "'," .
"da_driver_contact = '" . $_POST['txtdriverdet'] . "'," .
"da_seal_number = '" . $_POST['txtseal'] . "'," .
"da_decloration_number = '" . $_POST['txtdecnum'] . "'," .
"da_container_id = '" . $_POST['txtcontain'] . "'," .
"da_full_part_load = '" . $_POST['cmbFull'] . "'," .
"da_accompanied = '" . $_POST['cmbLoad'] . "'," .
"da_imo = '" . $_POST['txtdecnum'] . "'," .
"da_trailer_reg = '" . $_POST['txttrailer'] . "'" .
" WHERE da_primary_id = '" . $ref . "'";
$result = mysql_query($qrystr);

echo $qrystr;

$qrystr =  "UPDATE decloration_header SET " .
"dh_status = '" .  $status . "'," .
"dh_exporter = '" .  $_POST['cmbExporter'] . "'," .
"dh_importer = '" .  $_POST['cmbImporter'] . "'" .
"WHERE dh_primary_id =  '" . $ref . "'";
$result = mysql_query($qrystr);





//header( "Location: shipmentdetail.php?ref=" .  $ref); 



?>