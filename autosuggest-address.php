<?php
include("includes/common.class.php");
include("includes/common.inc.php");
$query = $_GET['q'];
$type = $_GET['t'];


$resp[]="abc";
$resp[]="bce";
$resp[]="bcw";
$resp[]="bcr";
//$resp[] = $query . " " . str_shuffle($query);

echo json_encode($resp);