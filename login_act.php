<?php
include "class/cls_db.php";
$db = new db('');
//include("class/cls_functions.php");
//$GeneralFunctions= new sitefun();
//include("includes/common.inc.php");
//include "class/cls_forms.php";
//include "class/cls_login.php";
//$Form = new forms($db);

foreach($_POST as $name => $val)
$$name=$val;


$captch_return_inputs='
<input type="hidden" name="username" id="username" value="'.$username.'" />
<input type="hidden" name="pwd" id="pwd" value="'.$pwd.'" />
';



$p =base64_encode($pwd);
$p = base64_encode($p);

//"Select log_id from tbllogin where log_name='$username' and log_pwd='$p'";
$res = $db->record_total("Select log_id from tbllogin where log_name='$username' and log_pwd='$p'");
//echo "Loading";

if($res>0)
{

	$Qresult = $db->record_select("Select * from tbllogin where log_name='$username' and log_pwd='$p'");
	if($Qresult[0]['log_sts']=='A')
	{
		$_SESSION['login_id'] =  $Qresult[0]['log_id'];
		$_SESSION['utype'] = $Qresult[0]['typ_id'];
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
        <form name="frmsuc" id="frmsuc" method="post" action="index.php" >
            <input type="hidden" name="msg_type" id="msg_type" value="alert-danger" />
            <input type="hidden" name="msg" id="msg" value="You are not authorised to login, please contact administrator." /> 
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
	<form name="frmsuc" id="frmsuc" method="post" action="index.php" >
		<input type="hidden" name="msg_type" id="msg_type" value="alert-danger" />
		<input type="hidden" name="msg" id="msg" value="Invalid Username or Password" /> 
	</form>
	<script>
	  document.frmsuc.submit();
	</script>
	<?php 
    exit;
}
exit;
$_SESSION['login_id'] =  $rstRow['log_id'];
// to check user has survey rights or not
if($logintypeid==2)
{
	$sqluserlink="SELECT * FROM tbl_user_assign_modules_pages WHERE log_id=".$rstRow['log_id']." AND link_id=291";
	$sqluserlinkQ=mysqli_query($sqluserlink);
	$Nrreclink=mysqli_num_rows($sqluserlinkQ);
	if($Nrreclink==0)
	{
		echo "Loading...";
		?>
		<form name="frmsuc" id="frmsuc" method="post" action="index.php" >
			<input type="hidden" name="msg_type" id="msg_type" value="alert-danger" />
			<input type="hidden" name="msg" id="msg" value="Sorry you have no permission to survey" /> 
		</form>
		<script>
		  document.frmsuc.submit();
		</script>
		<?php
	}
	else
	{
		?>
		<script>
		  document.location="survey.php";
		</script>
		<?php
		exit;
	}
}






exit;
/*$login= new login($_POST['username'], $_POST['pwd'], 'my_app_loged',$login_type_id);
//echo $db->svar;
echo $login->errorMessage; 
print_r($_SESSION);*/
		


?>

