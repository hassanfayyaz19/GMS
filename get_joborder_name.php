<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
    $$name=$val;

$sqlQ="SELECT * FROM `tbl_joborder` where joborder_name='$joborder_name'";
$sqlE=$db->record_total($sqlQ);
if($sqlE)
{
    echo "$joborder_name is already created";
}else
{
    echo 'not found';
}