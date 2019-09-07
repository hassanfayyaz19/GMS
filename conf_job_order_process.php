<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");
include "class/cls_forms.php";

$chkp=$_GET['chkp'];
$m=$_GET['m'];



foreach($_POST as $name => $val)
$$name=$val;

if($ctype=="finish")
{
	$sqlupdate="UPDATE tbl_joborder SET is_complete=1 WHERE joborder_id=$joborder_id";
	if($db->query_execute($sqlupdate))
	{
		$resp['msg'] = "1";
		$resp['msghtml'] = "Finished";
	}
	else
	{
		$resp['msg'] = "0";
		$resp['msghtml'] = "Error";
	}

echo json_encode($resp);
exit;
}


$j=0;
foreach($assignment_size_id as $asid)
{
	$attributesTemp="attributes".$asid;
	foreach ($$attributesTemp as $attribute_id)
	{
		$staff_idTemp="staff_id".$asid.$attribute_id;
		$receiveTemp="receive".$asid.$attribute_id;
		$damageTemp="damage".$asid.$attribute_id;
		$completeTemp="complete".$asid.$attribute_id;
		$singlepriceTemp="singleprice".$asid.$attribute_id;
		$totalpriceTemp="totalprice".$asid.$attribute_id;
		
		$sqlupdate="UPDATE tbl_joborder_size_attribute SET staff_id='".$$staff_idTemp."' , receive='".$$receiveTemp."', damage='".$$damageTemp."', complete='".$$completeTemp."', attribute_price_total='".$$totalpriceTemp."' WHERE joborder_id=$joborder_id AND assignment_size_id=$asid AND attribute_id=$attribute_id";
		$db->query_execute($sqlupdate);
	}

	$j++;
}
//SELECT sum(`attribute_price_total`) FROM `tbl_joborder_size_attribute` group by `staff_id` 
$resp['msg'] = "1";
$resp['msghtml'] = "1";
echo json_encode($resp);
?>