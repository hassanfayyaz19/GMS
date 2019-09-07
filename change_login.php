<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");
include "class/cls_forms.php";
include "class/cls_login.php";
$Form = new forms();

foreach($_POST as $name => $val)
$$name=$val;


$sqlLogin="SELECT * FROM tbllogin WHERE log_name='$userlogin' AND log_sts='A'";
$ttlLogin=$db->record_total($sqlLogin);
if($ttlLogin>0)
{
	$sqlLoginQ=$db->record_select($sqlLogin);
	$_SESSION['utype']=$sqlLoginQ[0]['typ_id'];
	$_SESSION['uname']=$sqlLoginQ[0]['log_name'];
	$_SESSION['login_id']=$sqlLoginQ[0]['log_id'];

?>
      <script>
          document.location="index_admin.php?chkp=1";
      </script>
    <?php 
    exit;	
}
else
{
?>
        <form name="frmsuc" id="frmsuc" method="post" action="<?php echo $current_url;?>" >
        </form>
      <script>
	  	  alert("invlaid Usernme");
          document.frmsuc.submit();
      </script>
    <?php 
    exit;
}
?>

