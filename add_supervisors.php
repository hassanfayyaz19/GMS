<?php
if($_GET['cmdType']=="edit")
{
	$mid=$_GET['mid'];
	$sqleventId="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=$mid";
	$sqleventIdQ=$db->record_select($sqleventId);
	foreach($sqleventIdQ[0] as $name => $val)
	$$name=$val;
	
	$pagetitle='Edit';
}
else
{
	$pagetitle='Add';
}
?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo $pagetitle;?> Supervisor</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <?php
	if($_GET['cmdType']=="edit"){
	?>
    	<a href="index_admin.php?chkp=392&m=129" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ADD SUPERVISOR</a>
    <?php }?>
    	<a href="index_admin.php?chkp=391&m=129" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ALL SUPERVISOR</a>
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
<form action="conf_add_supervisors.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" id="form1" method="post" enctype="multipart/form-data">
<?php echo $GeneralFunctions->alertmessages($_POST['msg_type'],$_POST['msg']);?>
<?php echo $GeneralFunctions->cmdType($_GET['cmdType'],$_GET['mid']);?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="white-box">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">Supervisor Information</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Supervisor Name</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-pencil-square-o"></i></div>
                                            <input type="text" class="form-control" name="user_first_name" id="user_first_name" value="<?php echo $user_first_name;?>" placeholder="Supervisor Name">
                                            
                                        </div>
                                        <span id="error_user_first_name" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Email</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $user_email;?>" placeholder="Supervisor Email">
                                            
                                        </div>
                                        <span id="error_user_email" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Phone</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                            <input type="text" class="form-control" name="office_tel" id="office_tel" value="<?php echo $office_tel;?>" placeholder="Supervisor Phone">
                                            
                                        </div>
                                        <span id="error_office_tel" class="text-danger"></span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Fax</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                            <input type="text" class="form-control" name="office_tel" id="office_tel" value="<?php echo $office_tel;?>" placeholder="Supervisor Phone">
                                            
                                        </div>
                                        <span id="error_office_tel" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
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
                            <h3 class="box-title">Login Information</h3>
                            <hr>
                            <div class="row">
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Username</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input type="text" id="log_name" class="form-control" <?php echo $usernamereadonly;?> name="log_name" value="<?php echo $log_name;?>" placeholder="Username" />
                                            
                                        </div>
                                        <span id="error_log_name" class="text-danger"></span>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Password</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-key"></i></div>
                                            <input type="password" id="log_pwd" class="form-control" name="log_pwd" value="<?php echo base64_decode(base64_decode($log_pwd));?>" placeholder="Password" />
                                            
                                        </div>
                                        <span id="error_log_pwd" class="text-danger"></span>
                                    </div>
                                </div>                              
                            </div>
                            <div class="row">
                            	<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Status</label>
                                        <div class="input-group">
                                            <?php echo $GeneralFunctions->getStatus("log_sts", $log_sts);?>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="text-right">
                                            <button type="submit" id="sbmt" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                            <a href="index_admin.php?chkp=341&m=112" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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
        if($('#log_name').val() == '')
        {
            error_log_name = 'Username is Required';
            $('#error_log_name').text(error_log_name);
            $('#log_name').css('border-color', '#cc0000');
        }
        else
        {
            error_log_name = '';
            $('#error_log_name').text(error_log_name);
            $('#log_name').css('border-color', '');
        }
        if($('#log_pwd').val() == '')
        {
            error_log_pwd = 'Password is Required';
            $('#error_log_pwd').text(error_log_pwd);
            $('#log_pwd').css('border-color', '#cc0000');
        }
        else
        {
            error_log_pwd = '';
            $('#error_log_pwd').text(error_log_pwd);
            $('#log_pwd').css('border-color', '');
        }
        
       if($('#user_first_name').val()!='' && $('#user_email').val()!='' && $('#office_tel').val()!='' && $('#address').val()!='' && $('#log_name').val()!='' && $('#log_pwd').val()!='')
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
