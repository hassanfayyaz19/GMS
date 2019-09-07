<?php
include "class/cls_db.php";
$db = new db();


## Read value
$draw = $_POST['draw'];
$chkp = $_GET['chkp'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

include "includes/common.inc.php";
include "includes/role.inc.php";

$actionhtml='';



## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and ((tbl_uom.uom like '%".$searchValue."%') OR (tbl_items.item_code like '%".$searchValue."%') OR (tbl_items.item_name like '%".$searchValue."%'))";
}

## Total number of records without filtering
$sel = "select tbl_stock.stock_no, tbl_items.item_code, tbl_items.item_name, tbl_stock_items.stock_item_id, tbl_uom.uom, tbl_stock.created_on, tbl_users.user_first_name, tbl_stock_items.stock_image, tbl_stock_items.stock_color, tbl_location.location, tbl_stock_items.stock_quantity from tbl_stock, tbl_items, tbl_stock_items,tbl_uom, tbl_users, tbl_location WHERE tbl_items.item_id=tbl_stock_items.item_id AND tbl_items.uom_id=tbl_uom.uom_id AND tbl_stock.stock_id=tbl_stock_items.stock_id AND tbl_stock.client_id=tbl_users.log_id AND tbl_stock.location_id=tbl_location.location_id";
$totalRecords=$db->record_total($sel);

## Total number of records with filtering
$sel = "select tbl_stock.stock_no, tbl_items.item_code, tbl_items.item_name, tbl_stock_items.stock_item_id, tbl_uom.uom, tbl_stock.created_on, tbl_users.user_first_name, tbl_stock_items.stock_image, tbl_stock_items.stock_color, tbl_location.location, tbl_stock_items.stock_quantity from tbl_stock, tbl_items, tbl_stock_items,tbl_uom, tbl_users, tbl_location WHERE tbl_items.item_id=tbl_stock_items.item_id AND tbl_items.uom_id=tbl_uom.uom_id AND tbl_stock.stock_id=tbl_stock_items.stock_id AND tbl_stock.client_id=tbl_users.log_id AND tbl_stock.location_id=tbl_location.location_id ".$searchQuery;
$totalRecordwithFilter=$db->record_total($sel);

## Fetch records
$empQuery = "select tbl_stock.stock_no, tbl_items.item_code, tbl_items.item_name, tbl_stock_items.stock_item_id, tbl_uom.uom, tbl_stock.created_on, tbl_users.user_first_name, tbl_stock_items.stock_image, tbl_stock_items.stock_color, tbl_location.location, tbl_stock_items.stock_quantity from tbl_stock, tbl_items, tbl_stock_items,tbl_uom, tbl_users, tbl_location WHERE tbl_items.item_id=tbl_stock_items.item_id AND tbl_items.uom_id=tbl_uom.uom_id AND tbl_stock.stock_id=tbl_stock_items.stock_id AND tbl_stock.client_id=tbl_users.log_id AND tbl_stock.location_id=tbl_location.location_id ".$searchQuery." order by created_on DESC ,".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = $db->record_select($empQuery);
$i=1;
foreach ($empRecords as $row) {

	
	if($RoleArray['Edit']==1)
	{
		//$actionhtmledit='<a type="button" class="btn btn-info btn-circle tooltip-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Royalty" href="index_admin.php?chkp=380&amp;cmdType=edit&mid='.$row['uom_id'].'&m=124"><i class="fa fa-pencil"></i> </a> &nbsp;';
		$actionhtmledit='<a href="index_admin.php?chkp=383&m=126&cmdType=edit&mid='.$row['stock_item_id'].'" class="btn btn-info btn-circle tooltip-warning btnEdit" type="button"><i class="fa fa-pencil"></i> </a> &nbsp;';
	}
	else
	{
		$actionhtmledit="";
	}
	
	if($RoleArray['Delete']==1)
	{
		$actionhtmldel='<a rel="'.$row['stock_item_id'].'" class="btn btn-googleplus btn-circle tooltip-dark-danger delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Royalty" href="javascript:;"><i class="ti-trash"></i> </a> &nbsp;';
	}
	else
	{
		$actionhtmldel='';
	}
	
	if($RoleArray['Print']==1)
	{
		$actionhtmlprint='<button type="button" data-toggle="modal" data-target="#myModal" rel="'.$row['stock_item_id'].'" class="btn btn-warning btn-circle tooltip-dark-danger clsPrint" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print"><i class="fa fa-print"></i> </button> &nbsp;';
	}
	else
	{
		$actionhtmlprint='';
	}
	
	$cdate=date($dateformat,strtotime($row['created_on']));
	if($row['stock_image']!="")
	{
		$stockimg="<img src='plugins/images/stock/".$row['stock_image']."' width='40' />";
	}
	else
	{
		$stockimg="<div style='width:60%; height:30px; background-color:".$row['stock_color']."'></div>";
	}


	if($row['uom_status']=='Enable')
		$Sts='<span class="btn btn-info waves-effect waves-light"><span>Enable</span></span>';
	elseif($row['uom_status']=='Disable')
		$Sts='<span class="btn btn-danger waves-effect waves-light"><span>Disable</span></span>';
		else
			$Sts='';

    $data[] = array(
			"stock_no"=>$row['stock_no'],
			"item_code"=>$row['item_code'],
			"item_name"=>$row['item_name'],
			"user_first_name"=>$row['user_first_name'],
			"location"=>$row['location'],
			"color_pic"=>$stockimg,
			"cdate"=>$cdate,
			"uom"=>$row['uom']." (".$row['stock_quantity'].")",
			"Edit"=>''.$actionhtmledit.''.$actionhtmlprint.''.$actionhtmldel.''
    	);
		$i++;
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);

