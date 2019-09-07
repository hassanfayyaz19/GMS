<?php
include "class/cls_db.php";
$db = new db();


// Array defining and vars

$mid = $_POST['mid'];

$name = $_POST['txtname'];

$des = $_POST['txtdes'];

$status=$_POST['status'];





if(isset($_POST['Submit'])){

    $result =  "UPDATE tblmodules set

		  											mod_name = '$name', 

													mod_des = '$des',

													mod_status = '$status'

													where mod_id = '$mid'";

    $qr =$db->query_execute($result);
    $massage=$name.' module has been updated.';
    header('Location: index_admin.php?chkp='.$_REQUEST['purl'].'&massage='.$massage);
    exit;
}else if(isset($_POST['Add'])){


    $qr =$db->record_insert("insert into tblmodules Values('', '$name', '$des', '0', 'A','A')");
    //$qr =  mysql_query("insert into tblmodules Values('', '$name', '$des', '0', 'A','A')") or die(mysql_error());
    $massage=$name. ' module has been added.';
    header('Location: index_admin.php?chkp='.$_REQUEST['purl'].'&massage='.$massage);
    exit;
}





?>