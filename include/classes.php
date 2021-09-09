<?php

include "db.inc";

class Cls_PPF_HEADER
{

var $ref;
var $intref;
var $type;
var $date;
var $pos;
var $fixedSum;
var $startdate;
var $finishdate;
var $status;
var $tier2;
var $customerGroup;
var $desc;
var $plant;
var $disctype;
var $originator;
var $dataentered;
var $currentauth;
var $approver;
var $uom;
var $exchangeRate;
var $promotionType;
var $brandType;

function Cls_PPF_HEADER($ref)
{
	$this->ref = $ref;
	$qrystr = "SELECT * from ppf_head where ppf_index = ". $ref ;
	$result = mysql_query($qrystr);
	while($row = mysql_fetch_assoc($result)) 
	{
	$this->type = $row['ppf_type'] ;
	$this->pricetype = $row['ppf_price_type'] ;
	$this->intref = $row['ppf_int_ref'] ;
	$this->date= $row['ppf_date'] ;
	$this->pos = $row['ppf_point_of_sale'] ;	
	$this->fixedSum = $row['ppf_fixed_sum'] ;	
	$this->startdate = $row['ppf_start_date'] ;
	$this->finishdate = $row['ppf_finish_date'] ;	
	$this->status = $row['ppf_status'] ;	
	$this->desc = $row['ppf_desc'] ;
	$this->plant = $row['ppf_plant'] ;
	$this->disctype = $row['ppf_discount_type'] ;
	$this->originator = $row['ppf_orig'] ;
	$this->dataentered = $row['ppf_data_entered_by'] ;
	$this->currentauth = $row['ppf_current_auth'] ;
	$this->approver = $row['ppf_approver'] ;
	$this->tier2 = $row['ppf_tier2'];
	$this->customerGroup = $row['customer_group_id'];
	$this->exchangeRate = $row['ppf_exchange_rate'] ;
	$this->disc = $row['ppf_disc'] ;
	$this->notes= $row['ppf_notes'] ;
	$this->promotionType= $row['ppf_promotion_type'];
	$this->brandType= $row['ppf_brand_type'];

	}
}
}

class Cls_CUST_DETAIL
{

var $id;
var $custid;
var $custname;
var $custisgroup;
var $plant;


function Cls_CUST_DETAIL($code,$desc)
{
	if (strlen($desc) > 0)
	$qrystr = "select * from customer where code = '$code' and name = '$desc'";
	else
	$qrystr = "select * from customer where code = '$code'";
	
	$result = mysql_query($qrystr);
	if ($num_rows = mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_assoc($result)) 
		{
		$this->id = $row['id'] ;
		$this->custid = $row['code'] ;
		$this->custname = $row['name'] ;	
		$this->custisgroup = $row['cust_is_group'] ;
		$this->plant = $row['plant'] ;
		}
	}
}



}


class Cls_USER_DETAIL
{

var $userid;
var $fullname;
var $initials;
var $email;
var $inUse;
var $vendorFilter;
var $locationFilter;
var $IsAdmin;

function Cls_USER_DETAIL($user_id)
{
	
	$qrystr = "SELECT * from users where user_id = '". $user_id . "'";
	$result = mysql_query($qrystr);

	if ($num_rows = mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_assoc($result)) 
		{
		$this->userid = $row['user_id'] ;
		$this->fullname = $row['user_name'] ;	
		$this->vendorFilter = $row['user_vendor_filter'] ;	
		$this->locationFilter = $row['user_warehouse_filter'] ;	
		$this->IsAdmin = $row['user_admin'] ;	
		}
	

	}
}

}


Class Cls_Check_User
{
var $isUser;

function Cls_Check_User($user_id,$password)
{
	
	$qrystr = "SELECT * from users where user_id = '". $user_id . "' and user_password = '". $password . "'";
	$result = mysql_query($qrystr);
	if ($num_rows = mysql_num_rows($result) > 0)
	{
		while($row = mysql_fetch_assoc($result)) 
		{
		$this->isUser = "Y";
		}
	}
}

}


Class Cls_Auth
{

var $myppf;
var $current_AppLevel;
var $Toplevel;
var $ToplevelDesc;
var $TotaValue;
var $ExchangeRate;
//$qrystr = "select * from ppf_head where ppf_index = '$ref' ";
//	$result = mysql_query($qrystr);
//	$maxAuth = getHighestAuth($ref);

function Cls_Auth($myppf)
{
		$this->myppf = $myppf;
		$this->GetPPFTotValue($myppf);		
		$this->getCurrentAuth($myppf);
		$this->ExchangeRate = $myppf->exchangeRate;
		
		if ($myppf->type == 1)	
		{
		$this->Toplevel = "1";
		$this->ToplevelDesc = "4";		
		}
		else
		$this->getHighesLevels($this->TotaValue);		
		
}

			function getCurrentAuth($myppf)
			{

			$qrystr = "select ppf_current_auth from ppf_head where ppf_index = " . $myppf->ref ;
			$result = mysql_query($qrystr);			
			
			while ($row = @ mysql_fetch_array($result))
				{
					$this->current_AppLevel = $row[0];
				}
					
			}


			function GetPPFTotValue($myppf)
			{
			
			$qrystr = "select * from ppf_items where ppf_items_ref = '" . $myppf->ref  . "'" ;
			$result = mysql_query($qrystr);
		
			$num_rows = mysql_num_rows($result);
			$value = 0;

				while ($row = @ mysql_fetch_array($result))
				{
					$overideUnit = $row['ppf_items_uom'];
					
					if ($myppf->disctype == "LUMP" || $myppf->disctype == "SERV"  )					
					  $value = $value + $row['ppf_items_discount'];
					  else if ($myppf->disctype == "OVER" && ($overideUnit == "%N" || $overideUnit == "%G") )
					  $value = $value + (($row['ppf_items_discount']/100) * $row['ppf_items_est_vol']);
					  else
					  $value = $value + ($row['ppf_items_discount'] * $row['ppf_items_est_vol']);
				}
				
			try {
			$this->TotaValue = ($value + $myppf->pos + $myppf->fixedSum) * (1 / $myppf->exchangeRate);
			} catch (Exception $e) {
			$this->TotaValue = 0;
			}
				
			
			//$this->TotaValue = "44";
			}
			
			function getHighesLevels($value)
				{
				$qrystr = "select min(ppf_auth_id), ppf_display_text  from ppf_auth_level where ppf_auth_limit > " . $value . " order by ppf_auth_limit asc ";				
				
				$result = mysql_query($qrystr);
				
				while ($row = @ mysql_fetch_array($result))
					{				
						$this->Toplevel = $row[0];	
						$this->ToplevelDesc	= $row[1]	;			
					}
				//	ECHO $this->Toplevel;
				}


			

}




?>