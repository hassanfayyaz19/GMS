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


if($log_sts=="on")
	$log_sts='A';
else
	$log_sts='D';


if(!isset($_POST['cmdType']))
{
	$log_name=explode(" ",$user_first_name);
	$sqlinsert="INSERT INTO tbllogin (log_name, log_pwd, typ_id, log_sts, log_e_status, log_token, log_cdate) VALUES ('".$log_name[0]."', 'TVE9PQ==', '3','A', 'F', '', NOW())";
	$log_id=$db->record_insert($sqlinsert);
	if($log_id>0)
	{
		$sqluser="INSERT INTO tbl_users (log_id, user_first_name, office_tel, user_email) VALUES ($log_id, '$user_first_name', '$office_tel', '$user_email')";
		$user_id=$db->record_insert($sqluser);
		?>
			<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $size_id;?>&m=<?php echo $m;?>" >
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

	$sqlinsert="UPDATE tbl_users SET user_first_name='$user_first_name', office_tel='$office_tel', user_email='$user_email' WHERE log_id=$mid";
	if($db->query_execute($sqlinsert))
	{
		$sqlinsert="UPDATE tbllogin SET log_sts='$log_sts' WHERE log_id=$mid";
		$db->query_execute($sqlinsert);
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