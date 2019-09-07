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


$listmodules="SELECT * FROM tblmodules";
$listmodulesQ=$db->record_select($listmodules);
foreach($listmodulesQ as $listmodulesD)
{
	$listmodulepages="SELECT * FROM tblmodulespages, tbllinks WHERE tblmodulespages.link_id=tbllinks.link_id AND tbllinks.link_s='Y' AND tblmodulespages.mod_id=".$listmodulesD['mod_id']."";
	$listmodulepagesQ=$db->record_select($listmodulepages);
	foreach($listmodulepagesQ as $listmodulepagesD)
	{
		$listoptions="SELECT * FROM tbl_options WHERE option_status='A'";
		$listoptionsQ=$db->record_select($listoptions);
		foreach($listoptionsQ as $listoptionsD)
		{
			
			$optionTemp="asterisks-rating-".$listmodulepagesD['link_id']."-".$listoptionsD['options_id'];
			$optionVal=$$optionTemp;
			if($optionVal=="on")
				$user_role_option_status=1;
			else
				$user_role_option_status=0;
			
			
			$listroleoptions="SELECT * FROM tbl_user_role_options WHERE mod_id=".$listmodulesD['mod_id']." AND link_id=".$listmodulepagesD['link_id']." AND option_id=".$listoptionsD['options_id']." AND typ_id=".$user_role_id."";
			$totalroles=$db->record_total($listroleoptions);
			
			if($totalroles==0)
			{
				$sqlinsertoptions="insert into tbl_user_role_options (mod_id, link_id, option_id, typ_id, user_role_option_status) VALUES (".$listmodulesD['mod_id'].", ".$listmodulepagesD['link_id'].", ".$listoptionsD['options_id'].", ".$user_role_id.", $user_role_option_status)";
				
				$user_role_option_id=$db->record_insert($sqlinsertoptions);
			}
			else
			{
				$selroles=$db->record_select("SELECT * FROM tbl_user_role_options WHERE mod_id=".$listmodulesD['mod_id']." AND link_id=".$listmodulepagesD['link_id']." AND option_id=".$listoptionsD['options_id']." AND typ_id=".$user_role_id."");
				$user_role_option_id=$selroles[0]['user_role_option_id'];
				
				$sqlupdate="UPDATE tbl_user_role_options SET mod_id=".$listmodulesD['mod_id'].", link_id=".$listmodulepagesD['link_id'].", option_id=".$listoptionsD['options_id'].", user_role_option_status=$user_role_option_status WHERE user_role_option_id=$user_role_option_id";
				$db->query_execute($sqlupdate); //user_role_id=$user_role_id, 
			}
			
		}
		
	}

}

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
//chanay akhroat meva badam  pista
?>