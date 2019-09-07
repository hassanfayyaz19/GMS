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
	$searchQuery = " and ((tbl_users.user_first_name like '%".$searchValue."%') OR (tbl_users.office_tel like '%".$searchValue."%') OR (tbl_users.user_email like '%".$searchValue."%'))";
}

## Total number of records without filtering
$sel = "select * from tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.typ_id=3";
$totalRecords=$db->record_total($sel);

## Total number of records with filtering
$sel = "select * from tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.typ_id=3 ".$searchQuery;
$totalRecordwithFilter=$db->record_total($sel);

## Fetch records
$empQuery = "select * from tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.typ_id=3 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = $db->record_select($empQuery);
$i=1;
foreach ($empRecords as $row) {

	
	if($RoleArray['Edit']==1)
	{
		$actionhtmledit='<a type="button" class="btn btn-info btn-circle tooltip-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Royalty" href="index_admin.php?chkp=388&amp;cmdType=edit&mid='.$row['log_id'].'&m=123"><i class="fa fa-pencil"></i> </a> &nbsp;';
		//$actionhtmledit='<button data-toggle="modal" data-target="#myModal" data-original-title="Payment Detail" title="" data-placement="top" data-tooltip="tooltip" class="btn btn-info btn-circle tooltip-warning btnEdit" type="button" rel="'.$row['uom_id'].'" relname="'.$row['uom'].'"><i class="fa fa-pencil"></i> </button> &nbsp;';
	}
	else
	{
		$actionhtmledit="";
	}
	
	if($RoleArray['Delete']==1)
	{
		$actionhtmldel='<a rel="'.$row['log_id'].'" class="btn btn-googleplus btn-circle tooltip-dark-danger delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Royalty" href="javascript:;"><i class="ti-trash"></i> </a> &nbsp;';
	}
	else
	{
		$actionhtmldel='';
	}


	if($row['log_sts']=='A')
		$Sts='<span class="btn btn-info waves-effect waves-light"><span>Enable</span></span>';
	elseif($row['log_sts']=='D')
		$Sts='<span class="btn btn-danger waves-effect waves-light"><span>Disable</span></span>';
		else
			$Sts='';

	$queryJoborder="SELECT * FROM tbl_joborder,`tbl_joborder_size_attribute` WHERE tbl_joborder.joborder_id=tbl_joborder_size_attribute.joborder_id AND tbl_joborder.client_id=".$row['log_id']." GROUP BY tbl_joborder.client_id";
    $totalJoborder=$db->record_total($queryJoborder);

    if($RoleArray['Print']==1)
	{
		$actionhtmlprint='<button type="button" data-toggle="modal" data-target="#myModal" rel="'.$row['log_id'].'" class="btn btn-success center tooltip-dark-danger clsJoborder col-sm-5" data-toggle="tooltip" data-placement="top" title="" data-original-title="joborder"><i class=""></i>
		'.$totalJoborder.'</button> &nbsp;';
	}
	else
	{
		$actionhtmlprint='';
	}

    $data[] = array(
			"user_first_name"=>$row['user_first_name'],
			"office_tel"=>"".$row['office_tel']."",
			"user_email"=>"".$row['user_email']."",
			"joborder"=>''.$actionhtmlprint.'',
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
