<?php
include "include/db.inc";

session_start();

$cmg = $_GET["cmg"];
$appu = $_GET["appu"];
$sort = $_GET["sort"];
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

function validate()
{
	var elem = document.getElementById('form1').elements;
	var desc = document.forms["form1"]["txtMatDesc"].value.trim();
	matEx = document.forms["form1"]["txtEx"].value.trim();
	var n = 0;
	var plantstr = "$";

	if (desc == "")
	{
	swal({   title: "Invalid description", text: "Please Enter a valid Description",  type: "error",  confirmButtonText: "OK" });
	return false;
	}

	for(var i = 0; i < elem.length; i++) {
			if (elem[i].type == 'checkbox') {
				if (elem[i].checked == true) {
					n++;
					plantstr = plantstr + elem[i].value + "$";
				}
			}
			}	

	if (n==0)
	{
	swal({   title: "No Plants Selected", text: "Please choose at least One Plant/Outstore",  type: "error",  confirmButtonText: "OK" });
	return false;
	}
	
	document.forms["form1"].action = "savematerial.php?head=Y&ref=" + document.forms["form1"]["txtRef"].value + "&ex=" + matEx + "&plant=" + plantstr;
	document.forms["form1"].submit();	

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
<a class="navbar-brand" href="../../Dashboard.php">
<div class="container-fluid">
</a>
	<div class="row">
	<img src="img/Refresco_logo_RGB_small.GIF" width="190" height="60" alt="Refresco Group">
		<div class="col-md-12">
		<img src="../include/img/waves.JPG" id="bg" alt="" style="width:100% ;position: fixed;background-size: 100%;"/>
			<div class="jumbotron">
				<h2>
					Hello, world!
				</h2>
				<p>
					This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.
				</p>
				<p>
					<a class="btn btn-primary btn-large" href="#">Learn more</a>
				</p>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
<br/>
</body>
</html>