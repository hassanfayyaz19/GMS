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


$random_no=rand(1,1000)*2;
$prodpic = strlen($_FILES['newsImage']['name']);
if($prodpic>0)
{
	$uploadImageName=$random_no."_".$_FILES['newsImage']['name'];
	$uploadPath = "plugins/images/general/".basename($uploadImageName);
	move_uploaded_file($_FILES['newsImage']['tmp_name'], $uploadPath);
	
	$delfile="plugins/images/general/".$old_general_logo;
	@unlink($delfile);
}
else
{
	$uploadImageName=$old_general_logo;
}


$prodpic2 = strlen($_FILES['newsImagefav']['name']);
if($prodpic2>0)
{
	$uploadImageName2=$random_no."_".$_FILES['newsImagefav']['name'];
	$uploadPath2 = "plugins/images/general/".basename($uploadImageName2);
	move_uploaded_file($_FILES['newsImagefav']['tmp_name'], $uploadPath2);
	
	$delfile2="plugins/images/general/".$old_general_favico;
	@unlink($delfile2);
}
else
{
	$uploadImageName2=$old_general_favico;
}


$sqlinsert="UPDATE tbl_general SET general_name='$general_name', general_web_title='$general_web_title', general_phone='$general_phone', general_email='$general_email',  general_logo='$uploadImageName', general_favico='$uploadImageName2', general_website_path='$general_website_path', general_currency='$general_currency' WHERE general_id=1";
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

//chanay akhroat meva badam  pista
?>