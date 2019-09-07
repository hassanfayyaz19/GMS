<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");
include "class/cls_forms.php";


// Array defining and vars	

	$chkbx = array();

	$chkbxid = array();

	$smod = $_POST['select_module'];

	$tloop = $_POST['tloop'];

	

	

if(isset($_POST['Add'])){


			$sqldelete="delete from tblgroup where mod_id=$smod";
			$db->query_execute($sqldelete);
			//$qd=mysql_query()or die(mysql_error());

			

			for($i=0; $i < $tloop; $i++){

			if($_POST['chk'.$i]==''){

			

				$chkbx[$i]='N';

			

			}else{

			

				$chkbx[$i]=$_POST['chk'.$i];

			 

			}// Condition ended

			$chkbxid[$i]=$_POST['chkid'.$i];

			//echo $smod."__".$chkbx[$i]." id = ".$chkbxid[$i]."<br>";

			//$qi=mysql_query("insert into tblgroup values ('', '$smod', '$chkbxid[$i]', '$chkbx[$i]')")or die(mysql_error());
			$sqlinsert="insert into tblgroup values ('', '$smod', '$chkbxid[$i]', '$chkbx[$i]')";
			$db->record_insert($sqlinsert);

			}
			
			$sqlsel="select mod_name from tblmodules where mod_id=$smod";
			$sqlselQ=$db->record_select($sqlsel);
			foreach($sqlselQ as $rstRow)
			{
				$name=$rstRow[0];
			}
						

			$massage='Permissions for '.$name.' has been updated.';

			header('Location: index_admin.php?chkp='.$_REQUEST['purl'].'&massage='.$massage);

			exit;

}





?>