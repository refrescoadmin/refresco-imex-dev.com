<?php
include "include/db.inc";
include "include/functions.php";

session_start();

$ref = $_GET["ref"];
//$var = $_POST['txtsearch'];

//echo "post -" . $_POST['txtsearch'];

if ($fil == "EXP")
{
$header = "EXPORTS";
$colspan = "11";
}
else
{
$header = "IMPORTS";
$colspan = "12";
}


if (isset($_POST['adddelv']) && !empty($_POST['adddelv']) )
{
echo date("h:i:sa");
header( "Location: dashboard.php" ); 

$qrystr = "insert into combine_departure values('" . $_POST['add'] . "',' " . $_POST['add'] ."')";
$result = mysql_query($qrystr);
echo $qrystr;

}

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
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link rel="stylesheet" href="include/mat_creation_refresco.css" type="text/css"/>
<script src="include/alert/dist/sweetalert.min.js"></script> 
<link rel="stylesheet" type="text/css" href="include/alert/dist/sweetalert.css">

<style>

</style>

<script language="JavaScript" type="text/JavaScript" >
function goPage(scr)
{
	window.location.href = scr;
}

function goSearch()
{
var _search = document.forms["form1"]["txtsearch"].value;
var _fil = document.forms["form1"]["txtFil"].value;



	document.forms["form1"].action = "dashboard.php?fil=" + _fil + "&var=" + _search;
	document.forms["form1"].submit();	
}

function linkDel($var)
{


//alert($var);

	document.forms["form1"].action = "combinedelvtodb.php?ref=" + $var
	document.forms["form1"].submit();	
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
	<img src="img/Refresco_logo_RGB_small.GIF" width="190" height="95" alt="Refresco Group">
  </a>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">    
    <ul class="navbar-nav mr-auto">
	<li class="nav-item">
        <a class="nav-link" href="dashboard.php?fil=EXP">Dashboard</a>
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
       <form  class="form-inline my-2 my-sm-0">
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
	
	


	<?php
	
	
	
	?>
	<div align="right">   <input type="text" id="txtsearch" name="txtsearch" style="width: 250px;" placeholder="Search"  ></input> <button style="width: 50px;" type="Button" class="btn btn-outline-info my-3 my-xl-0" onclick="goSearch()" >Go</button> </div>
				 <input style="font-size:25px; text-align:center;" class="p-2 mb-1 bg-info text-dark" type="hidden" id="ref_parent" name="ref_parent" align="center" readonly value="<?php echo $ref?>">
				
				
				
					<table class="table table-striped" style="width:95%" align="center" width="90%">
					<thead>
				<tr><td colspan="<?php echo $colspan ?>"  align='center' style="background-color:#f49611"><font style="font-size:35px" color="White"><?php echo "Combined Departure" ?></font></td></tr>
				
					  <tr style="background-color:#01b25c">
				
					  <td><font style="font-size:20px" color="White">ID</td>
						<td><font style="font-size:20px" color="White">BU</td>
						
						<?php if ($fil == "IMP") { ?>
						<td><font style="font-size:20px" color="White">PO Number</td>		
						<td><font style="font-size:20px" color="White">Duedate</td>		
						<?php }else{ ?>
						<td><font style="font-size:20px" color="White">Shipment/ Departure</td>	
						<?php } ?>
						<td><font style="font-size:20px" color="White">Customer</td>				
						<td><font style="font-size:20px" color="White">Plant/Warehouse</td>
						
						<td><font style="font-size:20px" color="White">Country</td>
						<td align='center'><font style="font-size:20px" color="White"> Inco term</td>
						<td align='center'><font style="font-size:20px" color="White">Product Code(s)</td>
						<td align='center'><font style="font-size:15px" color="White">Total Net<br>(KG)</td>
						<td align='center'><font style="font-size:15px" color="White">Total Gross<br>(KG)</td>
						<td align='center' style="align:center" ><font style="font-size:20px" color="White">Link</td>
						</font>
					  </tr>
					  </thead>
					  <tbody>
					
								<?php
				
			$qrystr_main = "SELECT * from combine_departure where departure_parent = '$ref'";
			
				$result_main = mysql_query($qrystr_main); 
					while ($row_main = @ mysql_fetch_array($result_main))
					{
	
							$qrystr = "SELECT dh_primary_id,dh_bu,dh_country,dh_inco_term,dh_business_link_id,dh_status,dh_partner_name,dh_despatch_point,dh_imex_duedate FROM decloration_header where dh_status <> 'COMP' " .
							 "and dh_primary_id = '" . $row_main[departure_child] .  "'" ;
				
					
				
				$result = mysql_query($qrystr); 
					while ($row = @ mysql_fetch_array($result))
					{
				
					
			
				?>
					
					  <tr >
						<td align='center' class='page-header text-center' onclick="goPage('shipmentdetail.php?ref=<?php echo $row[dh_primary_id] ?>')" onMouseOver="this.className='hover page-header text-center'" onMouseOut="this.className='page-header text-center'"><?php echo $row[0] ?></td>
						<td ><?php echo $row[1] ?></td>
						<td ><?php echo ltrim($row[4] , '0')?></td>
						
							<?php if ($fil == "IMP") { ?>
						<td><?php echo ukdate($row[8]) ?> </td>		
					
						<?php }?>
						
					
						<td ><?php echo $row[6] ?></td>
						<td ><?php echo $row[7] ?></td>
						<td ><?php echo $row[2] ?></td>
						<td align='center'><?php echo $row[3] ?></td>
						<td ><?php echo GetProductCodes($row[dh_primary_id],'C') ?></td>
						<td align='center'><?php echo GetWeights($row[dh_primary_id],di_net_weight,'C','EXP') ?></td>
						<td align='center'><?php echo GetWeights($row[dh_primary_id],di_gross_weight,'C','EXP') ?></td>
						<td align='center'></td>	
						
					  </tr>
								  
								  
						<?php } 
						}?>				  
								</tbody>
					</table>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
									
				<table class="table table-striped" style="width:95%" align="center" width="90%">
					<thead>
				<tr><td colspan="<?php echo $colspan ?>"  align='center' style="background-color:#f49611"><font style="font-size:35px" color="White">Departure List</font></td></tr>
				
					  <tr style="background-color:#01b25c">
				
					  <td><font style="font-size:20px" color="White">ID</td>
						<td><font style="font-size:20px" color="White">BU</td>
						
						<?php if ($fil == "IMP") { ?>
						<td><font style="font-size:20px" color="White">PO Number</td>		
						<td><font style="font-size:20px" color="White">Duedate</td>		
						<?php }else{ ?>
						<td><font style="font-size:20px" color="White">Shipment/ Departure</td>	
						<?php } ?>
						<td><font style="font-size:20px" color="White">Customer</td>				
						<td><font style="font-size:20px" color="White">Plant/Warehouse</td>
						
						<td><font style="font-size:20px" color="White">Country</td>
						<td align='center'><font style="font-size:20px" color="White"> Inco term</td>
						<td align='center'><font style="font-size:20px" color="White">Product Code(s)</td>
						<td align='center'><font style="font-size:15px" color="White">Total Net<br>(KG)</td>
						<td align='center'><font style="font-size:15px" color="White">Total Gross<br>(KG)</td>
						<td align='center' style="align:center" ><font style="font-size:20px" color="White">Link</td>
						</font>
					  </tr>
					  </thead>
					  <tbody>
					<br></br>
								
									<?php
					
				
				
				$qrystr = "SELECT dh_primary_id,dh_bu,dh_country,dh_inco_term,dh_business_link_id,dh_status,dh_partner_name,dh_despatch_point,dh_imex_duedate FROM decloration_header where (dh_status = 'NEW' OR dh_status = 'UPDATE') " .
							 "and dh_despatch_point = 'WH 05' and dh_header_child = '' ";
				
				$qrystr2 = "SELECT dh_primary_id,dh_bu,dh_country,dh_inco_term,dh_business_link_id,dh_status,dh_partner_name,dh_despatch_point,dh_imex_duedate FROM decloration_header where (dh_status = 'NEW' OR dh_status = 'UPDATE') " .
							 GetSelectionFilter($_SESSION["VEND"],$_SESSION["LOCATION"] ) . " and dh_header_child = '' ";
				
					//echo $qrystr;
				
				$result = mysql_query($qrystr2); 
					while ($row = @ mysql_fetch_array($result))
					{
				
					
			
				?>
					
					  <tr >
						<td align='center' class='page-header text-center' onclick="goPage('shipmentdetail.php?ref=<?php echo $row[dh_primary_id] ?>')" onMouseOver="this.className='hover page-header text-center'" onMouseOut="this.className='page-header text-center'"><?php echo $row[0] ?></td>
						<td ><?php echo $row[1] ?></td>
						<td ><?php echo ltrim($row[4] , '0')?></td>
						
							<?php if ($fil == "IMP") { ?>
						<td><?php echo ukdate($row[8]) ?> </td>		
					
						<?php }?>
						
					
						<td ><?php echo $row[6] ?></td>
						<td ><?php echo $row[7] ?></td>
						<td ><?php echo $row[2] ?></td>
						<td align='center'><?php echo $row[3] ?></td>
						<td ><?php echo GetProductCodes($row[dh_primary_id],'C') ?></td>
						<td align='center'><?php echo GetWeights($row[dh_primary_id],di_net_weight,'C','EXP') ?></td>
						<td align='center'><?php echo GetWeights($row[dh_primary_id],di_gross_weight,'C','EXP') ?></td>
						<td align='center'><img src="img/link.gif" alt="Link" onclick="linkDel('<?php echo $row[dh_primary_id]?>')"> </td>	
						
					  </tr>
								  
								  
						<?php }
								?>				  
								</tbody>
					</table>
						
						
						
						
						</td>
					  </tr>
					  <tr>
					  </tr>
					</thead>
					</table>
					
					
				<br>	
				
	
			</table>    
</form>  
	</div>
</div>
<br/>
</body>
</html>