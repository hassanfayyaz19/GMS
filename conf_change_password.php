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

$log_pwd=base64_encode(base64_encode($reset_old_password));

$sqlforgotpass="SELECT * FROM tbllogin WHERE log_id='$session_login_id' AND log_pwd='$log_pwd'";
$result=$db->record_total($sqlforgotpass);
if($result>0)
{
	if($reset_new_password==$reset_new_retype_password)
	{
		$new_log_pwd=base64_encode(base64_encode($reset_new_password));
		$sqlupdate="UPDATE tbllogin SET log_pwd='$new_log_pwd' WHERE log_id='$session_login_id'";
		$result=$db->query_execute($sqlupdate);
		if($result!=0)
		{
		?>
			<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $account_id;?>&m=<?php echo $m;?>" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Password Updated successfully" /> 
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
                <input type="hidden" name="msg" id="msg" value="Updation error please contact Administrator." /> 
            </form>
          <script>
              document.frmsuc.submit();
          </script>
        <?php 
        exit;
		}
	}
	else
	{
	?>
    <form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>" >
        <input type="hidden" name="msg_type" id="msg_type" value="alert alert-danger alert-dismissable" /> 
        <input type="hidden" name="msg" id="msg" value="New password and Retype passwords not same." /> 
    </form>
    <script>
      document.frmsuc.submit();
    </script>
    <?php 
    exit;
	}
}
else
{

?>
<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>" >
    <input type="hidden" name="msg_type" id="msg_type" value="alert alert-danger alert-dismissable" /> 
    <input type="hidden" name="msg" id="msg" value="Old password in not correct." /> 
</form>
<script>
  document.frmsuc.submit();
</script>
<?php 
exit;
}	
?>