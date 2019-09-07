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


/*if($columnName=='assignment_created_on')
{
    $columnName = $_POST['columns'][$columnIndex]['data'];
   // $columnName['data']= DATE_FORMAT($columnName['data'], "%Y-%m-%d");
    $columnName['data'] = date("%Y-%m-%d",strtotime($columnName['data']));
}*/


## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and ((tbl_users.user_first_name like '%".$searchValue."%') OR (tbl_assignment.assignment_code like '%".$searchValue."%') OR (tbl_assignment.assignment_name like '%".$searchValue."%'))";
}

## Total number of records without filtering
$sel = "SELECT * FROM tbl_assignment, tbl_users WHERE tbl_assignment.client_id=tbl_users.log_id ORDER BY `tbl_assignment`.`assignment_id` DESC";
$totalRecords=$db->record_total($sel);

## Total number of records with filtering
$sel = "SELECT * FROM tbl_assignment, tbl_users WHERE tbl_assignment.client_id=tbl_users.log_id ".$searchQuery;
$totalRecordwithFilter=$db->record_total($sel);


## Fetch records
$empQuery = "SELECT * FROM tbl_assignment, tbl_users WHERE tbl_assignment.client_id=tbl_users.log_id ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = $db->record_select($empQuery);
$i=1;
foreach ($empRecords as $row) {

	
	if($RoleArray['Edit']==1)
	{
		//$actionhtmledit='<a type="button" class="btn btn-info btn-circle tooltip-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Royalty" href="index_admin.php?chkp=380&amp;cmdType=edit&mid='.$row['uom_id'].'&m=124"><i class="fa fa-pencil"></i> </a> &nbsp;';
		$actionhtmledit="";
		// to get either assignment has job order or not.
		$sqlchkorder="SELECT * FROM tbl_joborder WHERE assignment_id=".$row['assignment_id']."";
		$totaljoborders = $db->record_total($sqlchkorder);
		if($totaljoborders==0)
		{
			$actionhtmledit='<a href="index_admin.php?chkp=386&m=127&cmdType=edit&mid='.$row['assignment_id'].'" class="btn btn-info btn-circle tooltip-warning btnEdit" type="button"><i class="fa fa-pencil"></i> </a> &nbsp;';
		}
		else
		{
			$actionhtmledit='<button type="button" class="btn btn-info btn-circle tooltip-warning cannotEdit" type="button"><i class="fa fa-pencil"></i> </button> &nbsp;';
		}
	}
	else
	{
		$actionhtmledit="";
	}
	
	if($RoleArray['Delete']==1)
	{
		// to get either assignment has job order or not.
		$sqlchkorder="SELECT * FROM tbl_joborder WHERE assignment_id=".$row['assignment_id']."";
		$totaljoborders = $db->record_total($sqlchkorder);
		if($totaljoborders==0)
		{
			$actionhtmldel='<a rel="'.$row['assignment_id'].'" class="btn btn-googleplus btn-circle tooltip-dark-danger delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Royalty" href="javascript:;"><i class="ti-trash"></i> </a> &nbsp;';
		}
		else
		{
			$actionhtmldel='<button type="button" class="btn btn-googleplus btn-circle tooltip-dark-danger cannotDelete" type="button"><i class="ti-trash"></i>  </button> &nbsp;';
		}
	}
	else
	{
		$actionhtmldel='';
	}
	
	if($RoleArray['Print']==1)
	{
		$actionhtmlprint='<button type="button" data-toggle="modal" data-target="#myModal" rel="'.$row['assignment_id'].'" class="btn btn-warning btn-circle tooltip-dark-danger clsPrint" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print"><i class="fa fa-print"></i> </button> &nbsp;';
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


	if($row['uom_status']=='Enable')
		$Sts='<span class="btn btn-info waves-effect waves-light"><span>Enable</span></span>';
	elseif($row['uom_status']=='Disable')
		$Sts='<span class="btn btn-danger waves-effect waves-light"><span>Disable</span></span>';
		else
			$Sts='';

    $data[] = array(
			"assignment_code"=>$row['assignment_code'],
			"assignment_name"=>$row['assignment_name'],
			"user_first_name"=>$row['user_first_name'],
			"assignment_picture"=>$stockimg,
			"assignment_status"=>$row['assignment_status'],
			"cdate"=>$cdate,
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
