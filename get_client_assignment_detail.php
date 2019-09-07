<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;

$assignmentQuery="SELECT * FROM tbl_assignment WHERE assignment_id=$assignment_id";
$assignmentQueryQ=$db->record_select($assignmentQuery);


$resp['assignment_name'] = $assignmentQueryQ[0]['assignment_name'];
$resp['assignment_code'] = $assignmentQueryQ[0]['assignment_code'];
$resp['assignment_picture'] = "plugins/images/assignment/".$assignmentQueryQ[0]['assignment_picture'];
echo json_encode($resp);
?>



