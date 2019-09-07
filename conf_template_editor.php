<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");

$chkp=$_GET['chkp'];
$m=$_GET['m'];

foreach($_POST as $name => $val)
$$name=$val;

$field_description=addslashes($field_description);
$sqlinsert="UPDATE tbl_theme SET ".$field_name."='$field_description' WHERE theme_id=$theme_id";
$query_id=$db->query_execute($sqlinsert);
if($query_id)
{	
	?>
		<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&t=<?php echo $field_name;?>&m=<?php echo $m;?>" >
			<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
			<input type="hidden" name="msg" id="msg" value="Record Updated successfully" /> 
		</form>
	  <script>
		  document.frmsuc.submit();
	  </script>
	<?php 
	exit;
}
else
{
	?>
		<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>" >
			<input type="hidden" name="msg_type" id="msg_type" value="alert alert-danger alert-dismissable" /> 
			<input type="hidden" name="msg" id="msg" value="Error try again" /> 
		</form>
	  <script>
		  document.frmsuc.submit();
	  </script>
	<?php 
	exit;
}
?>