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
	$searchQuery = " and ((location like '%".$searchValue."%') OR (location_status like '%".$searchValue."%'))";
}

## Total number of records without filtering
$sel = "select * from tbl_location";
$totalRecords=$db->record_total($sel);

## Total number of records with filtering
$sel = "select * from tbl_location WHERE 1 ".$searchQuery;
$totalRecordwithFilter=$db->record_total($sel);

## Fetch records
$empQuery = "select * from tbl_location WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = $db->record_select($empQuery);
$i=1;
foreach ($empRecords as $row) {

	
	if($RoleArray['Edit']==1)
	{
		$actionhtmledit='<a type="button" class="btn btn-info btn-circle tooltip-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Royalty" href="index_admin.php?chkp=377&amp;cmdType=edit&mid='.$row['location_id'].'&m=123"><i class="fa fa-pencil"></i> </a> &nbsp;';
		//$actionhtmledit='<button data-toggle="modal" data-target="#myModal" data-original-title="Payment Detail" title="" data-placement="top" data-tooltip="tooltip" class="btn btn-info btn-circle tooltip-warning btnEdit" type="button" rel="'.$row['location_id'].'" relname="'.$row['location'].'"><i class="fa fa-pencil"></i> </button> &nbsp;';
	}
	else
	{
		$actionhtmledit="";
	}
	
	if($RoleArray['Delete']==1)
	{
		$actionhtmldel='<a rel="'.$row['location_id'].'" class="btn btn-googleplus btn-circle tooltip-dark-danger delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Royalty" href="javascript:;"><i class="ti-trash"></i> </a> &nbsp;';
	}
	else
	{
		$actionhtmldel='';
	}


	if($row['location_status']=='Enable')
		$Sts='<span class="btn btn-info waves-effect waves-light"><span>Enable</span></span>';
	elseif($row['location_status']=='Disable')
		$Sts='<span class="btn btn-danger waves-effect waves-light"><span>Disable</span></span>';
		else
			$Sts='';

    $data[] = array(
			"location"=>$row['location'],
    		"status"=>$Sts,
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
