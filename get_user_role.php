<?php
include "class/cls_db.php";
$db = new db();

$user_role_id=$_GET['user_role_id'];

$rolehml='
<!--<input type="hidden" name="user_role_id" value="'.$user_role_id.'" />-->
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" style="margin:0px auto; padding:0px;">
<tr>
	<td align="left" width="30%"><b>Module Name</b></td>
	<td align="left">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>';
			$j=1;
			$listoptionsh="SELECT * FROM tbl_options WHERE option_status='A'";
			$listoptionshQ=$db->record_select($listoptionsh);
			foreach($listoptionshQ as $listoptionshD)
			{
		$rolehml.='<td align="center" height="25" width="13%" style="background-color: #'.$listoptionshD['option_color'].'; font-size:13px; color:#FFFFFF;">'.$listoptionshD['option_name'].'</td>';
			$j++;}
		$rolehml.='</tr>
		</table> 
	</td>
  </tr>
';
	$i=1;
	$listmodules="SELECT * FROM tblmodules WHERE mod_status='A'";
	$listmodulesQ=$db->record_select($listmodules);
	foreach($listmodulesQ as $listmodulesD)
	{
	  $rolehml.='<tr class="modulecls">
		<td align="left" width="30%">'.$listmodulesD['mod_name'].'</td>
		<td align="left"></td>
	  </tr>';
	
			
			$listmodulepages="SELECT * FROM tblmodulespages, tbllinks WHERE tblmodulespages.link_id=tbllinks.link_id AND tbllinks.link_s='Y' AND tblmodulespages.mod_id=".$listmodulesD['mod_id']."";
			$listmodulepagesQ=$db->record_select($listmodulepages);
			foreach($listmodulepagesQ as $listmodulepagesD)
			{
			  $rolehml.='<tr>
				<td align="left" width="30%" style="padding-left:40px;">'.$listmodulepagesD['link_name'].'</td>
				<td align="left">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>';
						$j=1;
						
						$listoptions="SELECT * FROM tbl_options WHERE option_status='A'";
						$listoptionsQ=$db->record_select($listoptions);
						foreach($listoptionsQ as $listoptionsD)
						{
						
							$listmodulepages="SELECT * FROM tbl_user_role_options WHERE mod_id=".$listmodulesD['mod_id']." AND link_id=".$listmodulepagesD['link_id']." AND option_id=".$listoptionsD['options_id']." AND typ_id=".$user_role_id."";
							$listmodulepagesQ=$db->record_select($listmodulepages);
							$user_role_option_status=$listmodulepagesQ[0]['user_role_option_status'];
							if($user_role_option_status==1)
								{
									$selcheck=' checked';
								}
							else
								{
									$selcheck='';
								}
							
						$rolehml.='<style>
							.smart-form .rating input:checked ~ label.'.$listoptionsD['option_name'].'{ color: #'.$listoptionsD['option_color'].'; font-size:20px;}
						</style>
						<td align="center" width="13%">
							
							<div class="checkbox checkbox-info checkbox-circle">
								<input type="checkbox" '.$executecls.' '.$innerexecutecls.' '.$selcheck.' name="asterisks-rating-'.$listmodulepagesD['link_id'].'-'.$listoptionsD['options_id'].'" id="asterisks-rating-'.$i.'-'.$j.'" />
								<label for="checkbox8"> &nbsp; </label>
							</div>
							
						</td>';
						$j++;}
					  $rolehml.='</tr>
					</table>  
				</td>
			  </tr>';
			$i++;}
		}
	 $rolehml.='<tr>
		<td colspan="2" align="right" height="10"></td>
	 </tr>
	 <tr>
		<td colspan="2" align="right"><input type="submit" class="btn btn-primary btn-lg" value="Submit"></td>
	 </tr>
	</table>';
	echo $rolehml;

?>



