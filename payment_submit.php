<?php
include "class/cls_db.php";
$db = new db();
include "includes/common.inc.php";
$session_login_id;
if (isset($_POST['payment'])) {
    $joborder = $_POST['joborder_no'];
    $sqlQuery = "SELECT tbl_joborder.joborder_id,staff_id,log_id,attribute_price_total FROM tbl_joborder,`tbl_joborder_size_attribute`,tbl_users 
WHERE tbl_users.log_id=tbl_joborder_size_attribute.staff_id AND tbl_joborder.joborder_no='$joborder'
GROUP BY tbl_joborder.joborder_id";

    $sqlexe = $db->record_select($sqlQuery);
    foreach ($sqlexe as $row) {
        $joborder_num = $row['joborder_id'];
        $attribute_staff_id = $row['staff_id'];
        $log_id = $row['log_id'];
        $attribute_price_total = $row['attribute_price_total'];

    }
    $sqlinsert = "INSERT INTO `tbl_payment`(`joborder_id`, `attribute_staff_id`, `log_id`, `attribute_total_prize`) VALUES('$joborder_num','$attribute_staff_id','$session_login_id','$attribute_price_total')";

    $sqlinsertExe = $db->query_execute($sqlinsert);
    if ($sqlinsertExe) {
        echo "Data inserted";
    }

}

if (isset($_POST['multi_payment'])) {
    $dataArray = $_POST['datai'];
    $q2 = "INSERT INTO `tbl_payment`(`joborder_id`, `attribute_staff_id`, `log_id`, `attribute_total_prize`) VALUES ";
    $i = 0;

    foreach ($dataArray as $rowData) {
        $q1 = "SELECT tbl_joborder.joborder_id,joborder_name,staff_id,attribute_price_total FROM tbl_joborder,`tbl_joborder_size_attribute`,tbl_users 
WHERE tbl_users.log_id=tbl_joborder_size_attribute.staff_id AND tbl_joborder.joborder_no='$rowData'
GROUP BY tbl_joborder.joborder_id";
        $r1 = $db->record_select($q1);
        foreach ($r1 as $rowD) {
            $joborderNo = $rowD['joborder_id'];
            $joborder_name = $rowD['joborder_name'];
            $staff = $rowD['staff_id'];
            $price_total = $rowD['attribute_price_total'];
            ++$i;
            if ($i > 1) $q2 .= ", ";
            $q2 .= "('$joborderNo','$staff','$session_login_id','$price_total')";


        }
    }
    /*echo $q2;
    exit();*/
    $r2 = $db->query_execute($q2);
    if ($r2) {
        echo "Data Inserted";
    } else {
        echo "Data Insertion Failed";
    }
}
?>