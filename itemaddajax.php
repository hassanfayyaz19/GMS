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
$sel = "select * from tbl_items, tbl_uom WHERE tbl_items.uom_id=tbl_uom.uom_id";
$totalRecords=$db->record_total($sel);

## Total number of records with filtering
$sel = "select * from tbl_items, tbl_uom WHERE tbl_items.uom_id=tbl_uom.uom_id ".$searchQuery;
$totalRecordwithFilter=$db->record_total($sel);

## Fetch records
$empQuery = "select * from tbl_items, tbl_uom WHERE tbl_items.uom_id=tbl_uom.uom_id ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = $db->record_select($empQuery);
$i=1;
foreach ($empRecords as $row) {

	
	if($RoleArray['Edit']==1)
	{
		//$actionhtmledit='<a type="button" class="btn btn-info btn-circle tooltip-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Royalty" href="index_admin.php?chkp=380&amp;cmdType=edit&mid='.$row['uom_id'].'&m=124"><i class="fa fa-pencil"></i> </a> &nbsp;';
		$actionhtmledit='<button data-toggle="modal" data-target="#myModal" data-original-title="Payment Detail" title="" data-placement="top" data-tooltip="tooltip" class="btn btn-info btn-circle tooltip-warning btnEdit" type="button" rel="'.$row['item_id'].'" relname="'.$row['item_name'].'" relcode="'.$row['item_code'].'" reluom="'.$row['uom_id'].'" relsts="'.$row['status'].'"><i class="fa fa-pencil"></i> </button> &nbsp;';
	}
	else
	{
		$actionhtmledit="";
	}
	
	if($RoleArray['Delete']==1)
	{
		$actionhtmldel='<a rel="'.$row['uom_id'].'" class="btn btn-googleplus btn-circle tooltip-dark-danger delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Royalty" href="javascript:;"><i class="ti-trash"></i> </a> &nbsp;';
	}
	else
	{
		$actionhtmldel='';
	}


	if($row['uom_status']=='Enable')
		$Sts='<span class="btn btn-info waves-effect waves-light"><span>Enable</span></span>';
	elseif($row['uom_status']=='Disable')
		$Sts='<span class="btn btn-danger waves-effect waves-light"><span>Disable</span></span>';
		else
			$Sts='';

    $data[] = array(
			"item_code"=>$row['item_code'],
			"item_name"=>$row['item_name'],
			"uom"=>$row['uom'],
			"Edit"=>''.$actionhtmledit.''.$actionhtmldel.''
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

