<?php
session_start();
include "include/db.inc";
include "include/functions.php";
$cust = $_GET["cust"];





?>
 <?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Refresco Promotions and Pricing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo GetStyleSheet()?>"  rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript" >

function goPage(scr)
{

window.location.href = scr;
}
function filter()
{
//alert(document.1.cmbsite.value);
document.form1.action = "overview.php?swap=Y&control=" + document.form1.cmbsite.value
document.form1.submit();
//window.location.href = scr;
}

function AddRule(ref)
{
	var errCode = document.forms["form1"]["txtQty"].value;
	
	
	if (errCode == "")
	{
	alert ("Add a Minimum Quantity");	
	}
	else
	{
	document.forms["form1"].action = "savematerial.php?ref=" + ref ;
	document.forms["form1"].submit();	
	}

}


</script>



</head>

<body rightmargin="30" >

<table cellpadding="0" cellspacing="0" align="center" width="99%" bgcolor="#4682B4" border="0">

  <tr>
    <td><table width="100%" border="0" align="left" cellpadding="5" cellspacing="1">
      <tr>
        <td colspan="1" height="31" class="header1">Refresco North EDI Orders</td>
		<td colspan="6" width='24%' align='right' class="header1"><?php echo $_SESSION["Name"] ?><br><font size="2" color="white"><a href='login.php?action=end'> Logout</a></font></td>
      </tr>

      <tr>
          <td colspan="7" class="main"><form enctype="multipart/form-data" name="form1" id="form1" method="post" >
              <br></br>
			 
			 
			 <table width="20%" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#4682B4">
			
			<tr>
			<td align="center" width="8%" class="header2" colspan="2">Add rule</td></tr> 
			<tr><td align="center" width="8%" class="header2" >Day</td><td class="mainlarge"><?php DayCombo() ?></td></tr> 
		    <tr><td align="center" width="8%" class="header2" >Period</td><td class="mainlarge"><?php PeriodCombo() ?></td></tr> 
	        <tr><td align="center" width="8%" class="header2" >Minimum Qty</td ><td class="mainlarge"><input type="text" id="txtQty" name="txtQty"></td></tr> 
			<td align="center" width="8%" class="header2" colspan="2"><input name="Login" type="button" onclick="AddRule(<?php echo $cust ?>)" class="greenbutton" value="Add Rule" style="height:50px; width:180px" /></td></tr> 
			
			</tr> 
			</table>
			 
			  <br>
			<table width="30%" border="0" align="Center" cellpadding="5" cellspacing="1" bgcolor="#4682B4">
			
			<tr>
			<td align="center" width="8%" class="header1" >Day</td>
			<td align="center" width="8%" class="header1" >Period</td>
		    <td align="center" width="8%" class="header1" >Expected Minimum Qty</td>
			<td align="center" width="8%" class="header1" >Remove</td>
	     
			</tr> 
	
	<?php
	$qrystr = "select * from edi_rules where rule_customer_id = '" . $cust . "'";	
	$result = mysql_query($qrystr); 
	
	$class = "mainlarge";
	  while ($row = @ mysql_fetch_array($result))
		{
		 echo "<tr><td class='$class' align='center'>" . returnDay($row['rule_day']) . "</td>" .
					 "<td class='$class' align='center'>" . $row['rule_period'] . "</td>" .
					 "<td class='$class' align='center'>" . $row['rule_qty'] . "</td>" .
					 "<td class='$class' align='center'><a href='#' id='" . $row['ppf_cust_id'] . "' class='delete'><img src='img/x.png' alt='delete'/></a></td><tr>";
		}
	
		
			?>
	</table>
					 			 
            	
                </form>
			</table>
		</td> 
      </tr>
	  
	

    </table>      
</td>
  </tr>
</table>
</body>
</html>
