<?php
$sqleventId="SELECT * FROM tbl_users WHERE log_id=$session_login_id";
$sqleventIdQ=$db->record_select($sqleventId);
foreach($sqleventIdQ[0] as $name => $val)
$$name=$val;

    $pagetitle='Add';
?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Update Profile</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    </div>
    <!-- /.col-lg-12 -->
</div>
<!--.row-->
<form action="conf_update_profile.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" method="post" id="form1" enctype="multipart/form-data">
<?php echo $GeneralFunctions->alertmessages($_POST['msg_type'],$_POST['msg']);?>
<?php echo $GeneralFunctions->cmdType($_GET['cmdType'],$_GET['mid']);?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="white-box">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">Profile Information</h3>
                            <hr>
                            <?php if($session_utype==1 || $session_utype==2){?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Name</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                            <input type="text" class="form-control" name="user_first_name" id="user_first_name" value="<?php echo $user_first_name;?>" placeholder="Name">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Address</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $address;?>" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Office Tel</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="icon-phone"></i></div>
                                            <input type="text" class="form-control" name="office_tel" id="office_tel" value="<?php echo $office_tel;?>" placeholder="Office Tel">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Post Code</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                            <input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo $postcode;?>" placeholder="Post Code">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Office Fax</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                            <input type="text" class="form-control" name="office_fax" id="office_fax" value="<?php echo $office_fax;?>" placeholder="Office Fax">
                                        </div>
                                        <span id="error_office_fax" class="text-danger"></span>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Email</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $user_email;?>" placeholder="Email">
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                             <?php } if($session_utype==4){?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Name</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                            <input type="text" class="form-control" name="user_first_name" id="user_first_name" value="<?php echo $user_first_name;?>" placeholder="Name">
                                        </div>
                                        <span id="error_user_first_name" class="text-danger"></span>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Address</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $address;?>" placeholder="Address">
                                        </div>
                                        <span id="error_address" class="text-danger"></span>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Office Tel</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="icon-phone"></i></div>
                                            <input type="text" class="form-control" name="office_tel" id="office_tel" value="<?php echo $office_tel;?>" placeholder="Office Tel">
                                        </div>
                                        <span id="error_office_tel" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Email</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $user_email;?>" placeholder="Email"
                                             >
                                        </div><div class="help-block with-errors"></div>
                                        <span id="error_user_email" class="text-danger"></span>
                                    </div>
                                </div> 
                                                               
                            </div>
                            
        
                            <?php } if($session_utype==3){?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Name</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-sitemap"></i></div>
                                            <input type="text" class="form-control" name="user_first_name" id="user_first_name" value="<?php echo $user_first_name;?>" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Assign Royalty</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-gavel"></i></div>
                                            <select class="form-control" name="royalty_id" id="royalty_id" disabled="disabled">
                                            	<?php
                                                $sqlroyalty="SELECT * FROM tbl_royalty WHERE royalty_status=1 ORDER BY royalty_order";
												$sqlroyaltyQ=$db->record_select($sqlroyalty);
												foreach($sqlroyaltyQ as $sqlroyaltyD)
												{
												?>
                                                	<option value="<?php echo $sqlroyaltyD['royalty_id'];?>" <?php if($sqlroyaltyD['royalty_id']==$royalty_id) echo "selected";?>><?php echo $sqlroyaltyD['royalty_tag'];?> (<?php echo $sqlroyaltyD['royalty_percent'];?>%)</option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Address</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $address;?>" placeholder="Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Post Code</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                            <input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo $postcode;?>" placeholder="Post Code">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">City</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-sitemap"></i></div>
                                            <input type="text" class="form-control" name="city" id="city" value="<?php echo $city;?>" placeholder="City">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Country</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-sitemap"></i></div>
                                            <input type="text" class="form-control" name="country" id="country" value="<?php echo $country;?>" placeholder="Country">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Office Tel</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="icon-phone"></i></div>
                                            <input type="text" class="form-control" name="office_tel" id="office_tel" value="<?php echo $office_tel;?>" placeholder="Office Tel">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Office Fax</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            <input type="text" class="form-control" name="office_fax" id="office_fax" value="<?php echo $office_fax;?>" placeholder="Office Fax">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Email</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $user_email;?>" placeholder="Email Address">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Person Incharge</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" class="form-control" name="person_incharge" id="person_incharge" value="<?php echo $person_incharge;?>" placeholder="Person Incharge">
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Contact No</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                            <input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $contact_no;?>" placeholder="Contact No">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">I.C / Roc. No</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" class="form-control" name="ic_no" id="ic_no" value="<?php echo $ic_no;?>" placeholder="I.C / Roc. No.">
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                            <div class="row">
                            	<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Acc Detail</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="text" class="form-control" name="acc_detail" id="acc_detail" value="<?php echo $acc_detail;?>" placeholder="Acc Detail">
                                        </div>
                                    </div>
                                </div>                             
                            </div>
                            <?php } if($session_utype==5){?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Select <?php echo $in_party_B_name;?></label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <select class="form-control select2" name="partyb_id">
												<?php
                                                $sqlpartyb="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.typ_id=3";
                                                $sqlpartybQ=$db->record_select($sqlpartyb);
                                                foreach($sqlpartybQ as $sqlpartybD)
                                                {
                                                ?> 
                                                <option value="<?php echo $sqlpartybD['log_id'];?>" <?php if($partyb_id==$sqlpartybD['log_id']) echo 'selected';?>><?php echo $sqlpartybD['log_name'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Name</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-sitemap"></i></div>
                                            <input type="text" class="form-control" name="user_first_name" id="user_first_name" value="<?php echo $user_first_name;?>" placeholder="Name">
                                        </div>
                                    </div>
                                </div>   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Address</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                            <input type="text" class="form-control" name="address" id="address" value="<?php echo $address;?>" placeholder="Address">
                                        </div>
                                    </div>
                                </div>                             
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">City</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-sitemap"></i></div>
                                            <input type="text" class="form-control" name="city" id="city" value="<?php echo $city;?>" placeholder="City">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Country</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-sitemap"></i></div>
                                            <input type="text" class="form-control" name="country" id="country" value="<?php echo $country;?>" placeholder="Country">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Post Code</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                            <input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo $postcode;?>" placeholder="Post Code">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Email</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="text" class="form-control" name="user_email" id="user_email" value="<?php echo $user_email;?>" placeholder="Email Address">
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Office Tel</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="icon-phone"></i></div>
                                            <input type="text" class="form-control" name="office_tel" id="office_tel" value="<?php echo $office_tel;?>" placeholder="Office Tel">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Office Fax</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="icon-printer"></i></div>
                                            <input type="text" class="form-control" name="office_fax" id="office_fax" value="<?php echo $office_fax;?>" placeholder="Office Fax">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Contact No</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                            <input type="text" class="form-control" name="contact_no" id="contact_no" value="<?php echo $contact_no;?>" placeholder="Contact No">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">I/C no</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" class="form-control" name="ic_no" id="ic_no" value="<?php echo $ic_no;?>" placeholder="I/C no">
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                            <?php }?>
                            <div class="row">
                                 <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-right">
                                            <button type="submit" id="sbmt" class="btn btn-success waves-effect waves-light m-r-10" onclick="ValidatePassword()">Submit</button>
                                            <a href="index_admin.php?chkp=348&m=115" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <!--/row-->
                        </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</form>
<!--.row-->
<!-- ============================================================== -->
<!-- .right-sidebar -->
<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body">
            <ul id="themecolors" class="m-t-20">
                <li><b>With Light sidebar</b></li>
                <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                <li><a href="javascript:void(0)" data-theme="gray" class="yellow-theme">3</a></li>
                <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                <li><b>With Dark sidebar</b></li>
                <br/>
                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                <li><a href="javascript:void(0)" data-theme="gray-dark" class="yellow-dark-theme">9</a></li>
                <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme working">10</a></li>
                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme">12</a></li>
            </ul>
            <ul class="m-t-20 all-demos">
                <li><b>Choose other demos</b></li>
            </ul>
            <ul class="m-t-20 chatonline">
                <li><b>Chat option</b></li>
                <li>
                    <a href="javascript:void(0)"><img src="plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                </li>
                <li>
                    <a href="javascript:void(0)"><img src="plugins/images/users/genu.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                </li>
                <li>
                    <a href="javascript:void(0)"><img src="plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                </li>
                <li>
                    <a href="javascript:void(0)"><img src="plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                </li>
                <li>
                    <a href="javascript:void(0)"><img src="plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                </li>
                <li>
                    <a href="javascript:void(0)"><img src="plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                </li>
                <li>
                    <a href="javascript:void(0)"><img src="plugins/images/users/john.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                </li>
                <li>
                    <a href="javascript:void(0)"><img src="plugins/images/users/pawandeep.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->
<script>


	//Warning Message
	$('.deleteImg').click(function(){
		var mid=$(this).attr("rel");
		swal({   
			title: "Are you sure?",   
			text: "to delete this record",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Yes, delete it!",   
			closeOnConfirm: false 
		}, function(){   
			//swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
			document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=deldownloadImg&mid="+mid;
		});
	});
	$('.deleteFile').click(function(){
		var mid=$(this).attr("rel");
		swal({   
			title: "Are you sure?",   
			text: "to delete this record",   
			type: "warning",   
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Yes, delete it!",   
			closeOnConfirm: false 
		}, function(){   
			//swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
			document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=deldownloadFile&mid="+mid;
		});
	});

	jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
	
	$(document).ready(function() {
        $('#sbmt').click(function (e) {
          e.preventDefault();
        var error_user_first_name = '';
        var error_user_email = '';
        var error_office_tel = '';
        var error_address = '';
        var error_log_name = '';
        var error_log_pwd = '';
        if($('#user_first_name').val() == '')
        {
            error_user_first_name = 'Client name is Required';
            $('#error_user_first_name').text(error_user_first_name);
            $('#user_first_name').css('border-color', '#cc0000');
        }
        else
        {
            error_user_first_name = '';
            $('#error_user_first_name').text(error_user_first_name);
            $('#user_first_name').css('border-color', '');
        }


        if($('#address').val() == '')
        {
            error_address = 'Address is Required';
            $('#error_address').text(error_address);
            $('#address').css('border-color', '#cc0000');
        }
        else
        {
            error_address = '';
            $('#error_address').text(error_address);
            $('#address').css('border-color', '');
        }
        


        
       if($('#user_first_name').val()!='' && $('#user_email').val()!='' && $('#office_tel').val()!='' && $('#address').val()!='' && $('#log_name').val()!='')
       {
      $("#form1").submit();
       }
    });

      $('#sbmt').click(function() {  
 
    $(".error").hide();
    var hasError = false;
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    var emailblockReg =
     /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)([\w-]+\.)+[\w-]{2,4})?$/;
 
    var emailaddressVal = $("#user_email").val();
    if(emailaddressVal == '') {
    ///  $("#error_user_email").after('<span class="error text-danger" >Please enter your email address.</span>');
      $('#error_user_email').text('Email Address is Required');
      $('#user_email').css('border-color', '#cc0000');
      hasError = true;
    }
 
    else if(!emailReg.test(emailaddressVal)) {
    //  $("#error_user_email").after('<span class="error text-danger">Enter a valid email address.</span>');
      $('#error_user_email').text('Enter a valid email address');
      hasError = true;
    }
 
    else{
     return true;
    } 
 
    if(hasError == true) { return false; }

    });



     // phone nubmer validation
    $('#sbmt').click(function() { 

  $(".error").hide();
    var hassError = false;
    var phoneReg = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/; 
    var phoneVal = $("#office_tel").val();
    if(phoneVal == '') {
    ///  $("#error_office_tel").after('<span class="error text-danger" >Please enter your email address.</span>');
      $('#error_office_tel').text('Phone number is Required');
      $('#office_tel').css('border-color', '#cc0000');
      hassError = true;
    }
    else if(!phoneReg.test(phoneVal)) {
    //  $("#error_office_tel").after('<span class="error text-danger">Enter a valid email address.</span>');
      $('#error_office_tel').text('Enter a valid Phone number');
      hassError = true;
    }
    else{
     return true;
    } 
 
    if(hassError == true) { return false; }
 
    });







        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });

	jQuery(document).ready(function() {
	
		$(document).on("keyup",".pagename",function(){
			var valu=$(this).val();
			var aliasvalu=valu.split(' ').join('-');
			var aliasvalu=aliasvalu.split(<?php echo $JQueryREforURL;?>).join('-');
			$("#page_alias").val(aliasvalu.toLowerCase());
		});
		
		$(document).on("blur",".pagename",function(){
			var valu=$(this).val();
			var aliasvalu=valu.split(' ').join('-');
			var aliasvalu=aliasvalu.split(<?php echo $JQueryREforURL;?>).join('-');
			$("#page_alias").val(aliasvalu.toLowerCase());
		});
	
	
	
		$('.summernote').summernote({
			height: 350, // set editor height
			minHeight: null, // set minimum height of editor
			maxHeight: null, // set maximum height of editor
			focus: false // set focus to editable area after initializing summernote
		});
		$('.inline-editor').summernote({
			airMode: true
		});
		
		
		// Switchery
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		$('.js-switch').each(function() {
			new Switchery($(this)[0], $(this).data());
		});
		
		
		$(".vertical-spin").TouchSpin({
			verticalbuttons: true,
			verticalupclass: 'ti-plus',
			verticaldownclass: 'ti-minus'
		});
		
		
	});
	window.edit = function() {
		$(".click2edit").summernote()
	}, window.save = function() {
		$(".click2edit").destroy()
	}
</script>