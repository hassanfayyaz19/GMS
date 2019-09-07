<?php
if($_GET['cmdType']=="edit")
{
	$mid=$_GET['mid'];
	$sqleventId="SELECT * FROM tbl_category WHERE category_id=$mid";
	$sqleventIdQ=$db->record_select($sqleventId);
	foreach($sqleventIdQ[0] as $name => $val)
	$$name=$val;
	
	// to get old image
	$old_category_image="../images/category/thumb/".$category_image;
}
?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">User Role</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <!--<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Form Layout</li>
        </ol>-->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!--.row-->
<form action="conf_assign_user_role.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="white-box">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">Category Information</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputuname">User Role</label>
                                        <div class="input-group">
                                        	<?php
											$sqluserrole="SELECT * FROM tblusertype WHERE typ_status='A'";
                                            $htmlrole='
											<span class="input-group-addon"><i class="fa fa-user fa-lg fa-fw"></i></span>
											<select name="user_role_id" id="user_role_id" class="form-control input-lg">
												<option value="" selected="selected">Select Role</option>';
												$sqluserroleQ=$db->record_select($sqluserrole);
												foreach($sqluserroleQ as $sqluserroleD)
												{
													if($typ_id==$sqluserroleD['typ_id'])
														$selected=' selected';
													else
														$selected='';
												$htmlrole.='<option value="'.$sqluserroleD['typ_id'].'" '.$selected.'>'.$sqluserroleD['typ_name'].'</option>';
												}
											$htmlrole.='</select>';
											echo $htmlrole;
											?>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12" id="DivUserRole">
<?php
$user_role_id=$session_utype;
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
	$listmodules="SELECT * FROM tblmodules WHERE  mod_status ='A'";
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
				<td align="left" width="30%" style="padding-left:40px; border-bottom:1px solid #EEEEEE;">'.$listmodulepagesD['link_name'].'</td>
				<td align="left" style="border-bottom:1px solid #EEEEEE;">
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
                                </div>
                           </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</form>
<!--.row-->
<script>
$(document).ready(function() {
	$(document).on("change","#user_role_id",function(){
		var user_role_id=$(this).val();
		$("#DivUserRole").load('get_user_role.php?user_role_id='+user_role_id);
		
	});
});


</script>