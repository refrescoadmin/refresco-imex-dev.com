<?php
session_start();

   



function GetUserName($user_id)
{
$qrystr = "select user_name from users where user_id = '$user_id' ";
$result = mysql_query($qrystr);
while ($row = @ mysql_fetch_array($result))
	$name = $row[0];
return $name;

}
function GetStatus($id,$ref)
{
	$qrystr = "select status_desc from status where status_id = '$id' ";
	$result = mysql_query($qrystr);
	while ($row = @ mysql_fetch_array($result))
		$name = $row[0];
	
	if ($id == "FTPSENT")
	{

	$qrystr = "select dh_agent from decloration_header where dh_primary_id = '$ref' ";
	$result = mysql_query($qrystr);
	while ($row = @ mysql_fetch_array($result))
		$name = $name . ": " . $row[0];

	}	
	
	if ($id == "COMP")
	{

	$qrystr = "select dh_mrn_ref from decloration_header where dh_primary_id = '$ref' ";
	$result = mysql_query($qrystr);
	while ($row = @ mysql_fetch_array($result))
		$name = $name . "<br>" . $row[0];

	}	
		
	return $name;

}

function GetISOCountry($id)
{
$name = "XXX";
$qrystr = "select code_iso from country_code where code_legacy = '$id' ";
$result = mysql_query($qrystr);
while ($row = @ mysql_fetch_array($result))
	$name = $row[0];
return $name;

}


function GetSelectionFilter( $vendor, $location)
{
$retstr = "";

if ($vendor != "%")
$retstr = " and dh_partner_code = '$vendor' ";

if ($location != "%")
$retstr = $retstr . " and dh_despatch_point in $location ";


return $retstr;

}





function GetClass($id)
{

switch($id)
{
case "FTP":
$retval =  "p-3 mb-2 bg-primary text-white";
break;
case "FTPSENT":
$retval =  "p-3 mb-2 bg-success text-dark";
break;
case "UPDATE":
$retval =  "p-3 mb-2 bg-warning text-dark";
break;
case "NEW":
$retval =  "p-3 mb-2 bg-primary text-white";
break;
}

return $retval;
}






function GetOptionsforListbox($table,$sel,$value)
{
$qrystr = "select * from $table $sel";
$result = mysql_query($qrystr);
while ($row = @ mysql_fetch_array($result))
	{
	
		if ($row[0] == $value)
		$sel = " selected ";
		else
		$sel = "";
		echo '<option value="' . $row[0]. '" ' . $sel . '>' . $row[1] . '</option>';
	}
return $name;

}


function toMysqldate($str)
{
	if (strlen($str) > 1)
	return substr($str ,6,4) . "-" . substr($str ,3,2) . "-" . substr($str ,0,2);
	else
	return "";
}


function GetProductCodes($str,$combined)
{

	if ($combined == "H")
	{
	$var = " in (" ;
	$qrystr_main = "select * from combine_departure where departure_parent = '$str'";

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
	$var = " = '" . $str . "'";
	
	
				$qrystr = "select di_product_code from decloration_items where di_primary_id $var group by di_product_code";
			//	echo $qrystr;
				$result = mysql_query($qrystr);
				$i=0;
				while ($row = @ mysql_fetch_array($result))
				{

				if ($i==0)
					{		
						$ret = $row['di_product_code'];
						$i++;
					}
					else
					{
						$i++;
					}

				}
				if ($i > 1)
				{
				$i--;
				$ret = $ret . "<br>+ " . $i . " more";
				}
			



	return $ret;
	
}

function GetOrderNumbers($str,$combined,$bu)
{

		if ($combined == "H")
	{
	$var = " in (" ;
	$qrystr_main = "select * from combine_departure where departure_parent = '$str'";

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
	$var = " = '" . $str . "'";
	
	
				$qrystr = "select di_order_number,di_imex_order_ref from decloration_items where di_primary_id $var group by di_order_number";
			//	echo $qrystr;
				$result = mysql_query($qrystr);
				$i=0;
				while ($row = @ mysql_fetch_array($result))
				{

			//	if ($i==0)
				//	{		
						if ($bu == "BEV")
						$ret = $ret . $row['di_order_number'] . "<br>" ;
						else
						$ret = $ret . $row['di_imex_order_ref'] . "<br>" ;
						
						$i++;
				//	}
				//	else
				//	{
				//		$i++;
				//	}

				}
				if ($i > 1)
				{
				$i--;
			//	$ret = $ret . "<br>+ " . $i . " more";
				}
			



	return $ret;
	
}

function GetTariffCodes($str)
{
	$qrystr = "select di_tariff_code from decloration_items where di_primary_id = '$str' group by di_tariff_code";
	$result = mysql_query($qrystr);
	$i=0;
	while ($row = @ mysql_fetch_array($result))
	{

	if ($i==0)
		{
		
		$ret = $row['di_tariff_code'];
		$i++;
		}
		else
		{
		$i++;
		}

	}
	if ($i > 1)
	{
	$i--;
	$ret = $ret . "<br>+ " . $i . " more";
	}

	return $ret;
}


function GetWeights($str,$field,$combined,$type)
{



if ($combined == "H")
	{
	$var = " in (" ;
	$qrystr_main = "select * from combine_departure where departure_parent = '$str'";

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
	$var = " = '" . $str . "'";

	$qrystr = "select $field,di_order_qty  from decloration_items where di_primary_id $var ";

	$result = mysql_query($qrystr);
	$ret = 0;
	while ($row = @ mysql_fetch_array($result))
	{
		if (strpos($type, "IMP") === 0) // imports
		$ret = $ret + ($row[0]);
		else
		$ret = $ret + ($row[0] * $row['di_order_qty']);
	

	}
	

	return (int) $ret;
}

function GetPartner($code)
{
	$qrystr = "select *  from partners where partner_id = '$code' ";

	$result = mysql_query($qrystr);
	
	while ($row = @ mysql_fetch_array($result))
	{
		
		$ret = $row[1];
	

	}
	

	return $ret;
}


function GetBusinessCodes($str,$combined)
{
	
	if ($combined == 'H')
	$qrystr = "SELECT * FROM combine_departure,decloration_header where dh_primary_id = departure_child and departure_parent = '$str'";
	else
	$qrystr = "SELECT dh_business_link_id FROM decloration_header where dh_primary_id = '$str'";
		
		
		
	$result = mysql_query($qrystr);
	
	while ($row = @ mysql_fetch_array($result))
	{
		
		$ret = $ret . $row['dh_business_link_id'] . "<br>";
	

	}
	

	return $ret;
}


function RemoveQuote($str)
{
if (strlen($str) > 0)
return trim(str_replace("'","`",$str));
else
return "";
}

function RemoveComma($str)
{
if (strlen($str) > 0)
return trim(str_replace(","," ",$str));
else
return "";
}

function RemoveQuoteA($str)
{
if (strlen($str) > 0)
return trim(str_replace("Â","",$str));
else
return "";
}

function GetSysKeyVal($type)
{
$qrystr = "select sys_val from sys where sys_key = '$key' ";
$result = mysql_query($qrystr);
while ($row = @ mysql_fetch_array($result))
	$name = $row[0];
return $name;


}


function Usercombo($var)
{  
		$qrystr = "select * from users order by user_name";
		$result = mysql_query($qrystr);
        echo "<select name='cmbuser' style='width: 150px;' onChange='form1.submit();'>";
		while ($row = @ mysql_fetch_array($result))
		{	
			echo "<option value='" . $row['user_id'] ."' ";
			
			if ($row['user_id'] == $var)
			echo " selected ";		
			
			echo ">" . $row['user_name'] . " </option>";
		}
        echo "</select>";
		//echo $qrystr;
}




function WeeksDays($from, $to) {
    if ($from == $to)
	return "1 Day";
	$day   = 24 * 3600;
    $from  = strtotime($from);
    $to    = strtotime($to) + $day;
    $diff  = abs($to - $from);
    $weeks = floor($diff / $day / 7);
    $days  = round(($diff / $day - $weeks * 7) - 1); // orig $days  = $diff / $day - $weeks * 7;
    $out   = array();
    if ($weeks) $out[] = "$weeks Week" . ($weeks > 1 ? 's' : '');
    if ($days)  $out[] = "$days Day" . ($days > 1 ? 's' : '');
    return implode(', ', $out);
	
}


function PeriodCombo()
{
echo "<select name='cmbperiod'>
<option value='1' selected>1: 00:00 - 09:59</option>
<option value='2' >2: 10:00 - 13:59</option>
<option value='3' >3: 14:00 - 23:59</option>
</select>";
}





function GetNextRef()
{
 $qrystr = "select max(ppf_index) from ppf_head";
		$result = mysql_query($qrystr);
		while ($row = @ mysql_fetch_array($result))
		{
		return $row[0] + 1;
		}

}


function PrintStatus($str)
{

	switch($str)
	{
		case "NEW":
			$retval = "New<br>Not Processed" ;
		break;		
	}
		
	return $retval;
}



function SapInputDate($str)
{
if (strlen($str) > 1)
return substr($str ,6,4) . "-" . substr($str ,3,2) . "-" . substr($str ,0,2);
else
return "";
}




function ukdate($str)
{
	if ($str == "0000-00-00" || $str == "")
	return "";
	else
	{	
		return substr($str,8,2) . "/" . substr($str,5,2) . "/" . substr($str,0,4) ;
	}
}


function ukdateDots($str)
{
	if ($str == "0000-00-00" || $str == "")
	return "";
	else
	{	
		return substr($str,8,2) . "." . substr($str,5,2) . "." . substr($str,0,4) ;
	}
}


function uktime($str)
{
	if ($str == "0000-00-00" || $str == "")
	return "";
	else
	{	
		return substr($str,11,2) . ":" . substr($str,14,2) ;
	}
}

function GetStyleSheet()
{

return "include/ppf.css";
}





?>