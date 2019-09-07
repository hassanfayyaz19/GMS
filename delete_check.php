<?php
include "class/cls_db.php";
$db = new db();
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();

$mid=$_POST['mid'];
$type=$_POST['type'];

if($type=="delpayment")
{

	$sqlcheck="SELECT * FROM tbl_voucher WHERE payment_id=".$mid;
	$ttlrecord=$db->record_total($sqlcheck);
	//$sqlcheckQ=$db->record_select($sqlcheck);
	if($ttlrecord==0)
	{
		$isdel="1";
	}
	else
	{
		$isdel="0";
	}
}
elseif($type=="delinvoice")
{

	$sqlcheck="SELECT * FROM tbl_receive_payment WHERE invoice_id=".$mid;
	$ttlrecord=$db->record_total($sqlcheck);
	//$sqlcheckQ=$db->record_select($sqlcheck);
	if($ttlrecord==0)
	{
		$isdel="1";
	}
	else
	{
		$isdel="0";
	}
}
elseif($type=="delroyalty")
{

	$sqlcheck="SELECT * FROM tbl_users WHERE royalty_id=".$mid;
	$ttlrecord=$db->record_total($sqlcheck);
	//$sqlcheckQ=$db->record_select($sqlcheck);
	if($ttlrecord==0)
	{
		$isdel="1";
	}
	else
	{
		$isdel="0";
	}
}
elseif($type=="deltax")
{
	$sqlcheck="SELECT * FROM tbl_tax WHERE tax_id='".$mid."'";
	$sqlcheckQ=$db->record_select($sqlcheck);

	$sqlcheck="SELECT * FROM tbl_invoice_detail WHERE gst='".$sqlcheckQ[0]['tax_percent']."'";
	$ttlrecord=$db->record_total($sqlcheck);
	//$sqlcheckQ=$db->record_select($sqlcheck);
	if($ttlrecord==0)
	{
		$isdel="1";
	}
	else
	{
		$isdel="0";
	}
}
elseif($type=="delclient")
{
	$sqlcheck="SELECT * FROM tbl_invoice WHERE client_id='".$mid."'";
	$ttlrecord=$db->record_total($sqlcheck);
	//$sqlcheckQ=$db->record_select($sqlcheck);
	if($ttlrecord==0)
	{
		$isdel="1";
	}
	else
	{
		$isdel="0";
	}
}
elseif($type=="delstaff")
{
	$sqlcheck="SELECT * FROM tbl_invoice WHERE log_id='".$mid."'";
	$ttlrecord=$db->record_total($sqlcheck);
	
	
	$sqlcheckitem="SELECT * FROM tbl_item WHERE item_createdby='".$mid."'";
	$ttlrecorditem=$db->record_total($sqlcheckitem);
	
	//$sqlcheckQ=$db->record_select($sqlcheck);
	if($ttlrecord==0 && $ttlrecorditem==0)
	{
		$isdel="1";
	}
	else
	{
		$isdel="0";
	}
}
elseif($type=="delitem")
{
	$sqlcheck="SELECT * FROM tbl_invoice_detail WHERE item_id='".$mid."'";
	$ttlrecord=$db->record_total($sqlcheck);
	
	//$sqlcheckQ=$db->record_select($sqlcheck);
	if($ttlrecord==0)
	{
		$isdel="1";
	}
	else
	{
		$isdel="0";
	}
}
elseif($type=="delpartyb")
{
	$sqlcheck="SELECT * FROM tbl_invoice WHERE partyb_id='".$mid."'";
	$ttlrecordinvoice=$db->record_total($sqlcheck);
	
	$sqlcheck="SELECT * FROM tbl_quotation WHERE partyb_id='".$mid."'";
	$ttlrecordquot=$db->record_total($sqlcheck);
	
	$sqlcheck="SELECT * FROM tbl_invoice_setting WHERE partyb_id='".$mid."'";
	$ttlrecordsetting=$db->record_total($sqlcheck);
	
	$sqlcheck="SELECT * FROM tbl_users WHERE partyb_id='".$mid."'";
	$ttlrecordclients=$db->record_total($sqlcheck);
	
	//$sqlcheckQ=$db->record_select($sqlcheck);
	if($ttlrecordinvoice==0 && $ttlrecordquot==0 && $ttlrecordsetting==0 && $ttlrecordclients==0)
	{
		$isdel="1";
	}
	else
	{
		$isdel="0";
	}
}
$resp['rec']=1;
$resp['isdel']=$isdel;

echo json_encode($resp);

?>