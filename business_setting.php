<?php
$sqlgeneral="SELECT * FROM tbl_general WHERE general_id=1";
$sqlgeneralQ=$db->record_select($sqlgeneral);
foreach($sqlgeneralQ[0] as $name => $val)
$$name=$val;

// to get old image
$old_general_logo="plugins/images/general/".$general_logo;
$old_general_favico="plugins/images/general/".$general_favico;
?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">General Setting</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    
    </div>
    <!-- /.col-lg-12 -->
</div>
<!--.row-->
<form action="conf_business_setting.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" method="post" enctype="multipart/form-data">
<?php echo $GeneralFunctions->alertmessages($_POST['msg_type'],$_POST['msg']);?>
<?php echo $GeneralFunctions->cmdType($_GET['cmdType'],$_GET['mid']);?>
<input type="hidden" name="old_general_logo" value="<?php echo $general_logo;?>" />
<input type="hidden" name="old_general_favico" value="<?php echo $general_favico;?>" />
<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="white-box">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Company Name</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-sitemap"></i></div>
                                            <input type="text" class="form-control" name="general_name" id="general_name" value="<?php echo $general_name;?>" placeholder="Company Name">
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Web Title</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                            <input type="text" class="form-control" name="general_web_title" id="general_web_title" value="<?php echo $general_web_title;?>" placeholder="Web Title">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Phone</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                            <input type="text" class="form-control" name="general_phone" id="general_phone" value="<?php echo $general_phone;?>" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Email</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                            <input type="text" class="form-control" name="general_email" id="general_email" value="<?php echo $general_email;?>" placeholder="Email">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Currency</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-chain"></i></div>
                                            <input type="text" class="form-control" name="general_currency" id="general_currency" value="<?php echo $general_currency;?>" placeholder="Currency">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputuname">Website URL</label>
                                        <div class="input-group">
                                        	<div class="input-group-addon"><i class="fa fa-chain"></i></div>
                                            <input type="text" class="form-control" name="general_website_path" id="general_website_path" value="<?php echo $general_website_path;?>" placeholder="Website URL">
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
    <div class="col-md-4 col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                        
                        <div class="form-group">
                            <label>Logo (240 x 50) <?php if($general_logo!=""){ echo ' &nbsp; <span class="image-popups"><a class="btn btn-info btn-circle tooltip-dark-danger" data-effect="mfp-zoom-out" href="'.$old_general_logo.'"><i class="fa fa-eye"></i> </a> </span> <!-- &nbsp; <a class="redtext btn btn-googleplus btn-circle tooltip-dark-danger deleteImg" href="javascript:;" rel="'.$general_id.'"><i class="ti-trash"></i></a>-->'; }?></label>
                             <input type="file" name="newsImage" id="input-file-now"  data-default-file="<?php echo $old_general_logo;?>" class="dropify" /> 
                        </div>
                        <div class="form-group">
                            <label>Company Favico (25 x 25) <?php if($general_logo!=""){ echo ' &nbsp; <span class="image-popups"><a class="btn btn-info btn-circle tooltip-dark-danger" data-effect="mfp-zoom-out" href="'.$old_general_favico.'"><i class="fa fa-eye"></i> </a> </span> <!-- &nbsp; <a class="redtext btn btn-googleplus btn-circle tooltip-dark-danger deleteImg" href="javascript:;" rel="'.$general_id.'"><i class="ti-trash"></i></a>-->'; }?></label>
                             <input type="file" name="newsImagefav" id="input-file-now"  data-default-file="<?php echo $old_general_favico;?>" class="dropify" /> 
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<style>
.dropify-wrapper{ height:100px !important;}
</style>
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
			document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=delnewsImg&mid="+mid;
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