
<?php
if($_GET['cmdType']=="edit")
{
	$mid=$_GET['mid'];
	$sqleventId="SELECT * FROM tbl_bank WHERE bank_id=$mid";
	$sqleventIdQ=$db->record_select($sqleventId);
	foreach($sqleventIdQ[0] as $name => $val)
	$$name=$val;
}
?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Change Password</h4> </div>
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
<form action="conf_change_password.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" method="post" enctype="multipart/form-data" id="form1" name="form1" data-toggle="validator">
<?php echo $GeneralFunctions->alertmessages($_POST['msg_type'],$_POST['msg']);?>
<?php echo $GeneralFunctions->cmdType($_GET['cmdType'],$_GET['mid']);?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="white-box">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">New Password Information</h3>
                            <hr>
                            
 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Old Password</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-key"></i></div>

                                            <input type="password" class="form-control" name="reset_old_password" id="reset_old_password" value="<?php echo $bank_name;?>" data-error="Must Enter Valid Data " required placeholder="Enter Old Password">
                                        </div><div class="help-block with-errors"></div>
                                        <span id="error_reset_old_password" style="color: #a94442"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputuname">New Password</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-key"></i></div>
                                            <input type="password" class="form-control" name="reset_new_password" id="reset_new_password" value="<?php echo $bank_name;?>" data-error="Must Enter New Password" required placeholder="Enter New Password" />
                                        </div><div class="help-block with-errors"></div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Re-Type New Password</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-key"></i></div>
                                            <input type="password" class="form-control" name="reset_new_retype_password" id="reset_new_retype_password" value="<?php echo $bank_name;?>" data-error="Re-Type New password" required placeholder="Re-Type New Password" />
                                        </div><div class="help-block with-errors"></div>
                                        <span id="error_reset_new_retype_password" class="text-danger"></span>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-right">
                                            <button type="submit" id="sbmt" class="btn btn-success waves-effect waves-light m-r-10" onClick="validatePassword();">Submit</button>
                                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
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

<script type="text/javascript" src="js/jquery.validate.js"></script>
<script>
    /*function validatePassword() {
        var validator = $("#form1").validate({
            rules: {
                reset_old_password: "required",
                reset_new_password: "required",
                reset_new_retype_password: {
                    equalTo: "#reset_new_password"
                }
            },
            messages: {
                reset_old_password: "This field is Required",
                reset_new_password: " Enter Your New Password",
                reset_new_retype_password: " Enter Confirm Password Same as Password"
            }
        });
        if (validator.form()) {
            alert('Sucess');
        }
    }*/
    



    $('#sbmt').click(function() { 

  $(".error").hide();
    var hassError = false;
    var pasVal1 = $("#reset_new_password").val();
    var pasVal2 = $("#reset_new_retype_password").val();

    if(pasVal1 != pasVal2) {
    ///  $("#error_office_tel").after('<span class="error text-danger" >Please enter your email address.</span>');
      $('#error_reset_new_retype_password').text(' Enter Confirm Password Same as Password');
      $('#reset_new_retype_password').css('border-color', '#cc0000');
      hassError = true;
    }
    else{
     return true;
    } 
 
        if(hassError == true) { return false; }
 
    });

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