<?php

include "include/db.inc";
include "include/functions.php";
include "include/classes.php";

session_start();
$action=  $_GET["action"];

if ($action == 'end')
{
	$errcode = "Logout successful"; 	
	session_unset(); 
	session_destroy(); 
}

if ($action == 'chk')
{
	$checkuser = new Cls_Check_User($_POST['txtUserID'],$_POST['txtPass']);
	if ($checkuser->isUser != "Y")
	   $_SESSION['ERRCODE'] = "USERNOTFOUND";
	else
	{
	$userDetails = new Cls_USER_DETAIL($_POST['txtUserID']);	
	$_SESSION["UserID"] = $userDetails->userid;
	$_SESSION["USER"] = $userDetails->userid;
	$_SESSION["USERNAME"] = $userDetails->fullname;
	$_SESSION["VEND"] = $userDetails->vendorFilter;
	$_SESSION["LOCATION"] = $userDetails->locationFilter;
	$_SESSION["ADMIN"] = $userDetails->IsAdmin;
	//echo $userDetails->authlevel;
	header( "Location: dashboard.php?fil=IMP" ); 
	}

}
?>

<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Refresco IMEX Login</title>
<link rel="shortcut icon" href="include/img/favicon-rf.ico">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="x-ua-compatible" content="IE=edge">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="<?php echo GetStyleSheet()?>" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="include/alert/dist/sweetalert.min.js"></script> 
<link rel="stylesheet" type="text/css" href="include/alert/dist/sweetalert.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<style>
@font-face {
  font-family: 'Quicksand';
  font-style: light;
  font-weight: light;
  src: url(https://fonts.googleapis.com/css?family=Quicksand');
}
a {
	font-family: 'Quicksand';
}
.main {
	font-family: 'Quicksand';
}
</style>
<script language="JavaScript" type="text/JavaScript" >
$("#txtPass").keyup(function(event){
    if(event.keyCode == 13){
        $("#Login").click();
    }
});

function goPage(scr)
{
	window.location.href = scr;
}

function forgottenPass()
{
swal({
  title: "Forgotten Password?",
  text: "Please Submit Your Username",
  type: "input",
  input: 'textarea',
  showCancelButton: true,
  closeOnConfirm: false,
  confirmButtonColor: "##0B8211",
  imageUrl: 'include/img/Help-icon.png',  
  inputPlaceholder: "Username"
},
		function(inputValue)
		{
		if (inputValue === false) return false;
		 $.get('include/resetPass.php', {input: inputValue},	
		 function(){
		  swal({
		  title: "Password Reset Attempted",
		  text: "An Email has been sent with your new password. If you do not receive this please contact IT Helpdesk.",
		  type: "warning",
		  confirmButtonColor: "#0B8211",
		  closeOnConfirm: true		
		});	
	});
	});
 }

function validate()
{
var usr = document.forms["form1"]["txtUserID"].value ;
var pwd = document.forms["form1"]["txtPass"].value ;
document.forms["form1"].action = "login.php?action=chk";
document.form1.submit();
}
</script>
</head>
<body rightmargin="30" style="font-family:Quicksand">
<table align='center' cellpadding="0" cellspacing="0" width="95%" border="0">
<form name="form1" id="form1" method="post" action="login.php?action=chk">
<img src="img/waves.JPG" id="bg" alt="" style="width:100% ;position: fixed;background-size: 100%"/>
  <tr>
    <td>
	<table class="table"  align="left" cellpadding="0" cellspacing="1">
      <tr>
    <!--    <td height="31" class="header1" colspan='2'>Cott Material Setup</td> -->
		<input class="mainlarge" type="hidden" name="txtERROR" id="txtERROR" value="<?php echo $_SESSION['ERRCODE'] ?>">
      </tr>
	  <tr>
   </tr>
      <tr>
          <td class="main" colspan='3' style="">
				<br>               
				<div class="col-xs-6 panel panel-default col-md-offset-3 clearfix" style="border-color:black;background-color: rgba(255,255,255, 1);float:none;">
					<table align='center' width="40" border="0" cellspacing="1" >
					<tr height='30'>
					<td align='center' colspan='2' class="main">
					<br/>
					<image type='image' src='img/Refresco_logo_RGB_small.GIF' style="width:230px;height:105px;" />				
					<br/><br/><br/>
                  <tr height='35' align='center'>                    
                    <td align='center' height="35" width="220"><input style="font-family:Quicksand;" name="txtUserID" type="text" class="col-4 col-form-label form-control" id="usr"  placeholder='Username' /></td>
                  </tr>
				   <tr height='5' >      
				    </tr>
                  <tr height='35' >         
                    <td align='center' height="35"><input align='center' height="35" id="txtPass" name="txtPass" class="col-4 col-form-label form-control" type="password" placeholder='Password' style="font-family:Quicksand;"    /></td>
                  </tr>
                 </table> 
				 <br/>
			   <p align='center'>
                   <input name="Login" type="submit" onclick="validate()" class="btn btn-primary" value="Login" style="height:50px; width:150px;background-color:#07820D;font-family:Quicksand;" />
				    <br/><br/><br/>
					<a type="button" style="cursor: pointer;" onclick='forgottenPass()' style="font-family:Quicksand;">Forgotten Password</a>
				   <br/><br/>
				  <font color="red"> <?php echo $errcode ?></font>				  
                </form>		
		 </td>		 
      </tr>
</div>
    </table>      
</td>
  </tr>
        <tr>
          <td class="main" colspan='3' style="">
				<br>               
				<div class="col-xs-6 panel panel-default col-md-offset-3 clearfix " style="border-color:black;background-color: rgba(255,255,255, 1);float:none;height:200px;font-family:Quicksand;">	
				<div style="height: 195px;overflow-y:auto;width:102%;">
						<h5 align="center"><b>Announcements</b></h5>
						
					<hr style='width:100%'/>
			</div>
			</td>
	</tr>
</table>
</body>
</html>