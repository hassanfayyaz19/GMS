<?php

include "class/cls_db.php";
$db = new db();

// Array defining and vars	
	$modid = $_POST['select_module'];
	$attlink=$_POST['select_link'];
	if(isset($_POST['Add'])){
			$qd="delete from tblmodulespages where mod_id=$modid";
			$qdd =$db->record_select($qd);
			foreach($attlink as $val){
				
				$qr =  $db->record_insert("insert into tblmodulespages Values('', '$modid', '$val')");
				
			}
						$massage='Page/Pages has been added.';
						header('Location: index_admin.php?chkp='.$_REQUEST['purl'].'&massage='.$massage);
						exit;
}


?>