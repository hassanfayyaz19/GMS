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
	$searchQuery = " and ((tclient.user_first_name like '%".$searchValue."%') OR (tsuervisor.user_first_name like '%".$searchValue."%') OR (tbl_joborder.joborder_no like '%".$searchValue."%') OR (tbl_joborder.joborder_name like '%".$searchValue."%') OR (tbl_joborder.joborder_status like '%".$searchValue."%') OR (tbl_assignment.assignment_name like '%".$searchValue."%'))";
}

## Total number of records without filtering
$sel = "SELECT tbl_joborder.joborder_id, tbl_joborder.joborder_no, tbl_joborder.joborder_name, tbl_assignment.assignment_name, tbl_joborder.joborder_status, tclient.user_first_name as client_name, tsuervisor.user_first_name as supervisor_name   FROM tbl_joborder, tbl_assignment, tbl_users as tclient, tbl_users as tsuervisor WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.client_id=tclient.log_id AND tbl_joborder.supervisor_id=tsuervisor.log_id";
$totalRecords=$db->record_total($sel);

## Total number of records with filtering
$sel = "SELECT tbl_joborder.joborder_id, tbl_joborder.joborder_no, tbl_joborder.joborder_name, tbl_assignment.assignment_name, tbl_joborder.joborder_status, tclient.user_first_name as client_name, tsuervisor.user_first_name as supervisor_name   FROM tbl_joborder, tbl_assignment, tbl_users as tclient, tbl_users as tsuervisor WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.client_id=tclient.log_id AND tbl_joborder.supervisor_id=tsuervisor.log_id ".$searchQuery;
$totalRecordwithFilter=$db->record_total($sel);

## Fetch records
$empQuery = "SELECT tbl_joborder.joborder_id, tbl_joborder.joborder_no, tbl_joborder.joborder_name, tbl_assignment.assignment_name, tbl_joborder.joborder_status, tclient.user_first_name as client_name, tsuervisor.user_first_name as supervisor_name   FROM tbl_joborder, tbl_assignment, tbl_users as tclient, tbl_users as tsuervisor WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.client_id=tclient.log_id AND tbl_joborder.supervisor_id=tsuervisor.log_id ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = $db->record_select($empQuery);
$i=1;
foreach ($empRecords as $row) {

	
	if($RoleArray['Edit']==1)
	{
		//$actionhtmledit='<a type="button" class="btn btn-info btn-circle tooltip-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Royalty" href="index_admin.php?chkp=380&amp;cmdType=edit&mid='.$row['uom_id'].'&m=124"><i class="fa fa-pencil"></i> </a> &nbsp;';
		$actionhtmledit='<a href="index_admin.php?chkp=393&m=128&cmdType=edit&mid='.$row['joborder_id'].'" class="btn btn-info btn-circle tooltip-warning btnEdit" type="button"><i class="fa fa-pencil"></i> </a> &nbsp;';
	}
	else
	{
		$actionhtmledit="";
	}
	
	if($RoleArray['Delete']==1)
	{
		$actionhtmldel='<a rel="'.$row['joborder_id'].'" class="btn btn-googleplus btn-circle tooltip-dark-danger delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Royalty" href="javascript:;"><i class="ti-trash"></i> </a> &nbsp;';
	}
	else
	{
		$actionhtmldel='';
	}
	
	if($RoleArray['Print']==1)
	{
		$actionhtmlprint='<button type="button" data-toggle="modal" data-target="#myModal" rel="'.$row['joborder_id'].'" class="btn btn-warning btn-circle tooltip-dark-danger clsPrint" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print"><i class="fa fa-print"></i> </button> &nbsp;';
	}
	else
	{
		$actionhtmlprint='';
	}
	
	$cdate=date($dateformat,strtotime($row['assignment_created_on']));
	if($row['assignment_picture']!="")
	{
		$stockimg="<img src='plugins/images/assignment/".$row['assignment_picture']."' width='40' />";
	}
	else
	{
		$stockimg="";
	}
	
	// to check stock is already added or not
	$sqlstockchk="SELECT * FROM tbl_joborder_stock WHERE joborder_id=".$row['joborder_id']."";
	$sqlstockchkQ = $db->record_total($sqlstockchk);
	if($sqlstockchkQ==0)
	{
		$actionhtmlstock='<a class="btn btn-primary btn-circle tooltip-dark-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Issue Stock" href="index_admin.php?chkp=399&m=128&cmdType=edit&mid='.$row['joborder_id'].'" target="_blank"><i class="fa fa-shopping-basket"></i> </a> &nbsp;';
	}
	else
	{
		$actionhtmlstock='<a class="btn btn-primary btn-circle tooltip-dark-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Issue Stock" href="index_admin.php?chkp=400&m=128&cmdType=edit&mid='.$row['joborder_id'].'" target="_blank"><i class="fa fa-shopping-basket"></i> </a> &nbsp;';
	}


	if($row['joborder_status']=='Enable')
		$Sts='<span class="btn btn-info waves-effect waves-light"><span>Enable</span></span>';
	elseif($row['joborder_status']=='Disable')
		$Sts='<span class="btn btn-danger waves-effect waves-light"><span>Disable</span></span>';
		else
			$Sts='';
	//
	$sqlclient="SELECT * FROM tbl_users WHERE log_id=".$row['client_id']."";
	$sqlclientD = $db->record_select($sqlclient);
	//
	$sqlcsupervisor="SELECT * FROM tbl_users WHERE log_id=".$row['supervisor_id']."";
	$sqlcsupervisorD = $db->record_select($sqlcsupervisor);
	
    $data[] = array(
			"joborder_no"=>"".$row['joborder_no']."",
			"joborder_name"=>"".$row['joborder_name']."",
			"client"=>"".$row['client_name']."",
			"assignment"=>"".$row['assignment_name']."",
			"supervisor"=>"".$row['supervisor_name']."",
			"status"=>"".$Sts."",
			"Edit"=>''.$actionhtmledit.''.$actionhtmlstock.''.$actionhtmlprint.''.$actionhtmldel.''
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
