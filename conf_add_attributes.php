<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");
include "class/cls_forms.php";

$chkp=$_GET['chkp'];
$m=$_GET['m'];

foreach($_POST as $name => $val)
$$name=$val;


if($attribute_status=="on")
	$attribute_status='Enable';
else
	$attribute_status='Disable';


if(!isset($_POST['cmdType']))
{
	$sqlinsert="INSERT INTO tbl_attribute (attribute, attribute_status) VALUES ('$attribute', '$attribute_status')";
	$attribute_id=$db->record_insert($sqlinsert);
	if($attribute_id>0)
	{
		
		?>
			<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $attribute_id;?>&m=<?php echo $m;?>" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Record Inserted successfully" /> 
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
}
else	// if Account edit
{

	$sqlinsert="UPDATE tbl_attribute SET attribute='$attribute', attribute_status='$attribute_status' WHERE attribute_id=$mid";
	if($db->query_execute($sqlinsert))
	{
		?>
			<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $mid;?>&m=<?php echo $m;?>" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Record updated successfully" /> 
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
            <form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $mid;?>&m=<?php echo $m;?>">
                <input type="hidden" name="msg_type" id="msg_type" value="alert alert-danger alert-dismissable" /> 
                <input type="hidden" name="msg" id="msg" value="Error try again" /> 
            </form>
          <script>
              document.frmsuc.submit();
          </script>
        <?php 
        exit;
	}
}
//chanay akhroat meva badam  pista
?>