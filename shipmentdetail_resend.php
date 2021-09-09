<?php
include "include/db.inc";
include "include/functions.php";


session_start();

$ref = $_GET["ref"];

?>

<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Refresco Material Creation Portal</title><link rel="shortcut icon" href="img/favicon-rf.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="x-ua-compatible" content="IE=edge">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="jsquery/jquery-ui.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link rel="stylesheet" href="include/mat_creation_refresco.css" type="text/css"/>
<script src="include/alert/dist/sweetalert.min.js"></script> 
<link rel="stylesheet" type="text/css" href="include/alert/dist/sweetalert.css">

<script language="JavaScript" type="text/JavaScript" >


 $( function() {
    $( "#dateDesp" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy' }).val();
  } );
    $( function() {
    $( "#dateArrive" ).datepicker({ changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy' }).val();
  } );


function goPage(scr)
{
	window.location.href = scr;
}

function validate()
{
	var port1 = document.forms["form1"]["cmbPortDesp"].value;
	var port2 = document.forms["form1"]["cmbPortArrive"].value;
	var haulier = document.forms["form1"]["cmbHaulier"].value;
	var datedesp = document.forms["form1"]["dateDesp"].value;
	var dateArrive = document.forms["form1"]["dateArrive"].value;
	var txttrailer = document.forms["form1"]["txttrailer"].value;
	
	var acc = document.forms["form1"]["cmbLoad"].value;
	var full = document.forms["form1"]["cmbFull"].value;
		var imo = document.forms["form1"]["txtdecnum"].value;
	
	var exp = document.forms["form1"]["txtExp"].value;
	
		
	if (exp != "EXP")
	{
	acc = "N/A"  ;
    full = "N/A" ;
    imo = "N/A"  ;
	}
		
	

  if (port1 = "" || port2 == "" || haulier == "" || datedesp == "" || dateArrive == "" || txttrailer == ""  || acc == "" || full == "" || imo == "")
  {
  
  document.forms["form1"].action = "saveimex.php?ref=" + document.forms["form1"]["txtRef"].value ;
					document.forms["form1"].submit();
	
	}
	else
	{
	swal({
			title: "Submit To Customs Agent?",
			text: "Minimum Information has been entered. Do you want to submit file to Customs Agent?",
			type: "warning",
			confirmButtonText: "Yes, Send it.",
			cancelButtonText: "No, not yet.",
			confirmButtonColor: "#009933",
			showCancelButton: true
		  },
		  function(isConfirm) {
			debugger;
			setTimeout(function() {
			  if (isConfirm) {
			  
					document.forms["form1"].action = "saveimex.php?action=send&ref=" + document.forms["form1"]["txtRef"].value ;
					document.forms["form1"].submit();	

			  } else {
					document.forms["form1"].action = "saveimex.php?ref=" + document.forms["form1"]["txtRef"].value ;
					document.forms["form1"].submit();	
			  }
			}, 400)
		  }
		);
	}
	

		


}

function Login_Main()
{
var errCode = document.forms["form1"]["txtERROR"].value;

switch(errCode) {
    case "USERNOTFOUND":
        swal({   title: "Login failed", text: "Please check your Username and Password",  type: "error",  confirmButtonText: "OK" });
        break;
		case "PASSWORDCHANGED":
        swal({   title: "Password Reset", text: "You will recieve a new Password by email.",  type: "success",  confirmButtonText: "OK" });
        break;
		}
}


 


</script>
</head>
<body style="font-family:Quicksand">
<img src="../include/img/waves.JPG" id="bg" alt="" style="width:100% ;position: fixed;background-size: 100%;"/>
<nav class="navbar navbar-toggleable-md align-items-end sticky-top  navbar <?php if ($darkMode == "Y") { echo "bg-inverse"; } ?>" style="background-color:#ffffff;border-bottom:5px solid #F49611;" >
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <a class="navbar-brand" href="../../Dashboard.php">
	<img src="img/Refresco_logo_RGB_small.GIF" width="190" height="85" alt="Refresco Group">
  </a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">    
    <ul class="navbar-nav mr-auto">
	<li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="dashboard.php?fil=EXP">Exports</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="dashboard.php?fil=IMP">Imports</a>
      </li>
	  <li class="nav-item">
	     <a class="nav-link" href="dashboard.php?fil=<?php echo $fil ?>&live=N">Completed</a>
      </li>	  

   <!--   <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Settings
        </a>
          <a class="dropdown-item" href="" onClick="toggleDarkMode()">Toggle Dark Mode <?php if ($darkMode == "Y") { echo "Off"; }else { echo "On"; }?></a>
        </div>
      </li>   -->
    </ul>
	  <ul class="navbar-nav ml-auto">
   
      <a class="nav-link" href="#"><?php echo $_SESSION["USERNAME"] ?></a>
      <a class="btn btn-outline-danger my-2 my-xl-0" type="link" href='../../login.php?action=end' >Logout</a>
    </form>
	 </ul>
  </div>
</nav>
<form name="form1" id="form1" method="post">
<br/>
<div id="sectionTableDisplay" align="center" style="width:95%;margin: auto;" >
	<div id="breachedMilestones" class="card mx-auto " style="border-color: #333;" width="90%">
	
	<br>
	


	
	
	<?php
	
	$qrystr = "SELECT * FROM decloration_header where dh_primary_id = '$ref'";
	//echo $qrystr;
	$result = mysql_query($qrystr); 
		while ($row = @ mysql_fetch_array($result))
		{
		
		$status = GetStatus($row[dh_status],'');
		$status_code = $row[dh_status];
		$statusclass = GetClass($row[dh_status]);
		$combined = $row[dh_header_child];
		
	 if ($row[dh_import_export] == "EXP")
		$ast = "*";
		else
		$ast = "";
	
	?>
	
				<table class="table table-bordered table-sm" style="width:95%" align="center" width="90%">
					<thead>
					  <tr>
						<th style="width:15%;vertical-align:middle" >Unique Reference</th>
						<td style="width:15%">
							 <input style="font-size:25px; text-align:center;" class="p-2 mb-1 bg-info text-dark" type="text" id="txtRefformat" name="txtRefformat" align="center" readonly value="<?php echo str_pad($row[dh_primary_id], 5, '0', STR_PAD_LEFT);  ?>">
							 <input style="font-size:25px; text-align:center;" class="p-2 mb-1 bg-info text-dark" type="hidden" id="txtRef" name="txtRef" align="center" readonly value="<?php echo $row[dh_primary_id] ?>">
						     <input style="font-size:25px; text-align:center;" class="p-2 mb-1 bg-info text-dark" type="hidden" id="txtExp" name="txtExp" align="center" readonly value="<?php echo $row[dh_import_export] ?>">
						
 							
						</td>
						<td style="width:20%" rowspan="3"></td>
						<td style="width:20%" rowspan="2"><textarea style="resize: none;font-size:35px; text-align:center;" class="<?php echo $statusclass; ?>" type="text" id="txtStatus" rows="2" name="txtStatus" readonly ><?php echo $status; ?></textarea></td></tr>
						<tr><th style="vertical-align:middle" >Importer</th>
						<td style="width:15%">
							<div class="select-empty">
							  <select name="cmbImporter" id="cmbImporter">
								<option selected disabled>Choose an option</option>
								
								<?php echo GetOptionsforListbox("partners","where partner_type = 'EXP'", $row[dh_importer] ) ?>
							  </select>
							</div>
					
						</tr>
						<tr><th style="vertical-align:middle" >Exporter</th>
											<td style="width:15%">
							<div class="select-empty">
							  <select name="cmbExporter" id="cmbExporter">
								<option selected disabled>Choose an option</option>
								
								<?php echo GetOptionsforListbox("partners","where partner_type = 'EXP'", $row[dh_exporter] ) ?>
							  </select>
							</div>
					
						</td><td></td>
					  </tr>
					  <tr>
						<td colspan="6" rowspan="2">
						
<br></br>
				
	<div id="Manual" class="card mx-auto " style="border-color: #333;" width="90%">					
					
		<br>		

	<?php
	
			$qrystr2 = "SELECT * FROM decloration_additional where da_primary_id = '$ref'";
			$result_item = mysql_query($qrystr2); 
				while ($row_item = @ mysql_fetch_array($result_item))
				{
				
				$despport = $row_item[da_despatch_port];
				$arrport = $row_item[da_arrival_port];
				$haulier = $row_item[da_haulier];
				$dateArrival = $row_item[da_arrival_date];
				$dateDesp = $row_item[da_despatch_date];
				
				$driver= $row_item[da_driver_name];
				$driverCont = $row_item[da_driver_contact];
				$trailer= $row_item[da_trailer_reg];
				$container = $row_item[da_container_id];
				$seal = $row_item[da_seal_number];
				$decloration = $row_item[da_decloration_number];
				$vehical = $row_item[da_vehicle_reg];
				
				$load = $row_item[da_accompanied];
				$full = $row_item[da_full_part_load];
				$imo = $row_item[da_imo];
				
				
				
				}
				
				
				?>		
						
		<table class="table table-bordered table-sm" style="width:99%" align="center">
					<thead>
					  <tr>
						<th style="width:15%;vertical-align:middle"   >Port of Despatch<font style="font-size:25px" color="RED">*</font></th>
						<td>
						
						 <select id="cmbPortDesp" name="cmbPortDesp">
								<option value="" selected disabled>Choose an option</option>
								
								<?php echo GetOptionsforListbox("ports","",$despport) ?>
						</select>
						
						</td>
						<th style="width:15%;vertical-align:middle" >Haulier<font style="font-size:25px" color="RED">*</font></th>
						<td>
						
						 <select id="cmbHaulier" name="cmbHaulier">
								<option value="" selected disabled>Choose an option</option>
								
								<?php echo GetOptionsforListbox("partners","where partner_type = '3PL'",$haulier) ?>
						</select>
						
						</td></tr>
						
						  <tr>
						<th style="width:15%;vertical-align:middle" >Date of Despatch<br>(from Port)<font style="font-size:25px" color="RED">*</font></th>
						<td>
							<input class="form-control" readonly type="text" placeholder="Choose Date" name="dateDesp" id="dateDesp" value="<?php echo ukdate($dateDesp) ?>">
						</td>
						<th style="width:15%;vertical-align:middle" >Trailer Reg<font style="font-size:25px" color="RED">*</font></th>
						<td>
						<input type="text" id="txttrailer" name="txttrailer"  value="<?php echo $trailer  ?>"></td></tr>
						
						
							  <tr>
						<th style="width:15%;vertical-align:middle" >Port of Arrival<font style="font-size:25px" color="RED">*</font></th>
						<td>
						 <select id="cmbPortArrive" name="cmbPortArrive">
								<option value="" selected disabled>Choose an option</option>
								
								<?php echo GetOptionsforListbox("Ports","",$arrport) ?>
						</select>
						</td>
						<th style="width:15%;vertical-align:middle" >Container ID</th>
						<td>
						<input type="text" id="txtcontain" name="txtcontain"  value="<?php echo $container  ?>"></td></tr>
						
						
						<tr>
						<th style="width:15%;vertical-align:middle" >Date of Arrival<br>(to Port)<font style="font-size:25px" color="RED">*</font></th>
						<td>
						<input class="form-control" type="text" readonly placeholder="Choose Date" name="dateArrive" id="dateArrive" value="<?php echo ukdate($dateArrival) ?>">
						</td>
						<th style="width:15%;vertical-align:middle" >Seal Number</th>
						<td>
						 <input type="text" id="txtseal" name="txtseal"  value="<?php echo $seal  ?>">
						 
						 </td></tr>
						
						
							  <tr>
						<th style="width:15%;vertical-align:middle" >Shipment Type<font style="font-size:25px" color="RED"><?php echo $ast; ?></font></th>
						<td>
						 <select id="cmbLoad" name="cmbLoad">
								<option value="" selected disabled>Choose an option</option>
						<?php
						 GetOptionsforListbox("imex_load","", $load ) 
						 ?>
						 </select>
						 </td>
						<th style="width:15%;vertical-align:middle" >IMO Number<font style="font-size:25px" color="RED"><?php echo $ast; ?></font></th>
						<td> <input type="text" id="txtdecnum" name="txtdecnum"  value="<?php echo $decloration  ?>">
						</td></tr>
						
							  <tr>
						<th style="width:15%;vertical-align:middle" >Full or Grouped<font style="font-size:25px" color="RED"><?php echo $ast; ?></font></th>
						<td>
						<select id="cmbFull" name="cmbFull">
								<option value="" selected disabled>Choose an option</option>
						<?php
						 GetOptionsforListbox("imex_load_type","", $full ) 
						 ?>
						 </select>
						 </td>
						<th style="width:15%;vertical-align:middle" ></th>
						<td> 
						</td></tr>
						
						
						
						</table>
			<div align="center">
			
			
			
			 <button type="Button" class="btn btn-primary mb-2" onclick="validate()" >Save</button>
			 
			
			 </div>
		</div>				
						
						</td>
					  </tr>
					  <tr>
					  </tr>
					</thead>
					</table>
					
					
				<br>	
						<table class="table table-striped table-sm" style="width:95%" align="center" width="90%">
								<thead>
								  <tr>
									
									<th>Product Code</th>
									<th>Description</th>
									<th>Tariff Code</th>
									<th>Quantity</th>
									<th>UOM</th>
									<th>Net Wgt</th>
									<th>Gross Wgt</th>
								  </tr>
								</thead>
								<tbody>
								
			<?php
			}
			
			
			
			if ($combined == "H")
					{
					$var = " in (" ;
					$qrystr_main = "select * from combine_departure where departure_parent = '$ref'";

							$result_main = mysql_query($qrystr_main);
							
							while ($row_main = @ mysql_fetch_array($result_main))
							{
							 $var = $var .  "'" . $row_main['departure_child']  . "',";
							}
							$var = rtrim($var, ", ");
							$var = $var . ")";
					//echo $var;	
					}
				else
					$var = " = '" . $ref . "'";
			
			$qrystr2 = "SELECT * FROM decloration_items where di_primary_id $var";
		//	echo $qrystr2;
			$result_item = mysql_query($qrystr2); 
				while ($row_item = @ mysql_fetch_array($result_item))
				{
				?>
	
								  <tr>
									<td style="font-size:22px;"><?php echo $row_item[di_product_code] ?></td>
									<td style="font-size:22px;"><?php echo $row_item[di_product_desc] ?></td>
									<td style="font-size:22px;"><?php echo $row_item[di_tariff_code] ?></td>
									<td style="font-size:22px;"><?php echo $row_item[di_order_qty] ?></td>
									<td style="font-size:22px;"><?php echo $row_item[di_uom] ?></td>
									<td style="font-size:22px;"><?php echo $row_item[di_net_weight] ?></td>
									<td style="font-size:22px;"><?php echo $row_item[di_gross_weight] ?></td>
								  </tr>
								  
								  
						<?php } ?>				  
								</tbody>
					</table>
		

				
			</table>     
</form> 
	</div>
</div>
<br/>
</body>
</html>