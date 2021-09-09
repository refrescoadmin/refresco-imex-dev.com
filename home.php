<?php
session_start();
include "include/db.inc";
include "include/functions.php";

//echo date("w");
//echo idate('w', $timestamp);

?>
 <?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>IMEX</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo GetStyleSheet()?>"  rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/JavaScript" >

function goPage(scr)
{

window.location.href = scr;
}
function filter()
{
//alert(document.form1.cmbsite.value);
document.form1.action = "overview.php?swap=Y&control=" + document.form1.cmbsite.value
document.form1.submit();
//window.location.href = scr;
}



</script>



</head>

<body rightmargin="30" >

<table cellpadding="0" cellspacing="0" align="center" width="99%" bgcolor="#4682B4" border="0">

  <tr>
    <td><table width="100%" border="0" align="left" cellpadding="5" cellspacing="1">
      <tr>
        <td colspan="1" height="31" class="header1">IMEX Imports and Exports</td>
		<td colspan="6" width='24%' align='right' class="header1"><?php echo $_SESSION["Name"] ?><br><font size="2" color="white"><a href='login.php?action=end'> Logout</a></font></td>
      </tr>
	 
      <tr>
          <td colspan="7" class="main"><form enctype="multipart/form-data" name="form1" id="form1" method="post" >
              <br></br>
			 
			 <table border="1">
					<thead>
					  <tr>
						<th colspan="2" rowspan="3"></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					  </tr>
					  <tr>
						<td colspan="6" rowspan="2"></td>
					  </tr>
					  <tr>
					  </tr>
					</thead>
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
