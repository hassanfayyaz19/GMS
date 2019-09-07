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

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and (uom like '%".$searchValue."%') ";
}

## Total number of records without filtering
$sel = "select * from tbl_uom";
$totalRecords=$db->record_total($sel);

## Total number of records with filtering
$sel = "select * from tbl_uom WHERE 1 ".$searchQuery;
$totalRecordwithFilter=$db->record_total($sel);

## Fetch records
$empQuery = "select * from tbl_uom WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = $db->record_select($empQuery);
$i=1;
foreach ($empRecords as $row) {
    $data[] = array(
			"uom"=>$row['uom'],
    		"status"=>$row['uom_status'],
    		"order"=>$row['uom_order'],
			"Edit"=>'<a type="button" class="btn btn-info btn-circle tooltip-info" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Royalty" href="index_admin.php?chkp='.$chkp.'&amp;cmdType=edit&amp;mid=1&amp;m=109"><i class="fa fa-pencil"></i> </a> <a rel="1" class="btn btn-googleplus btn-circle tooltip-dark-danger delete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Royalty" href="javascript:;"><i class="ti-trash"></i> </a>  
			<button data-toggle="modal" data-target="#myModal'.$row['uom_id'].'" data-original-title="Invoice Detail" title="Invoice Detail" data-placement="top" data-tooltip="tooltip" class="btn btn-warning btn-circle tooltip-warning" type="button"><i class="fa fa-file-text"></i> </button> 
			<div id="myModal'.$row['uom_id'].'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<h4 class="modal-title" id="myModalLabel">'.$row['uom_id'].'</h4> </div>
							<div class="modal-body">
								 <div class="row">
									<h3> &nbsp; &nbsp;Client Information</h3>
								 <div class="row">
									<div class="col-md-12">
										called here
									</div>
								 </div>
							</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
			'
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
