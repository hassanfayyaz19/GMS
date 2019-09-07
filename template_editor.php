<?php
if(isset($_GET['t']))
{
	$t=$_GET['t'];
	$sqltheme="SELECT ".$t." as fieldName FROM tbl_theme WHERE theme_id=1";
	$sqlthemeQ=$db->record_select($sqltheme);
	foreach($sqlthemeQ[0] as $name => $val)
	$$name=$val;
}
else
{
	$t="header";
	$sqltheme="SELECT header as fieldName FROM tbl_theme WHERE theme_id=1";
	$sqlthemeQ=$db->record_select($sqltheme);
	foreach($sqlthemeQ[0] as $name => $val)
	$$name=$val;
}
?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12"><h4 class="page-title">Edit Themes</h4></div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"></div>
    <!-- /.col-lg-12 -->
</div>
<!--.row-->
<form action="conf_template_editor.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" method="post" enctype="multipart/form-data">
<?php echo $GeneralFunctions->alertmessages($_POST['msg_type'],$_POST['msg']);?>
<input type="hidden" name="field_name" value="<?php echo $t;?>" />
<input type="hidden" name="theme_id" value="1" />
<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="white-box">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <div class="form-body">
                            <!--/row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="control-label">Theme <?php echo ucwords(str_replace("_"," ",$t));?></label>
                                        <textarea id="field_description" name="field_description" class="textarea_theme"><?php echo $fieldName;?></textarea>
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
            <h3 class="box-title m-b-0">Template</h3>
            <p class="text-muted m-b-30 font-13">  </p>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                        
                        <div class="form-group">
                             <div class="form-group">
                                <a href="index_admin.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&t=header"><b class="colortext">Theme Header</b><br />&nbsp; header.php</a>
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="form-group">
                                <a href="index_admin.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&t=footer"><b class="colortext">Theme Footer</b><br />&nbsp; footer.php</a>
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="form-group">
                                <a href="index_admin.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&t=header_scripts"><b class="colortext">Header Scripts</b><br />&nbsp; scripts.php</a>
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="form-group">
                                <a href="index_admin.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&t=footer_scripts"><b class="colortext">Footer Scripts</b><br />&nbsp; footer_scripts.php</a>
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="form-group">
                                <a href="index_admin.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&t=left_side"><b class="colortext">Left Side</b><br />&nbsp; left_side.php</a>
                             </div>
                        </div>
                        <div class="form-group">
                             <div class="form-group">
                                <a href="index_admin.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&t=right_side"><b class="colortext">Right Side</b><br />&nbsp; right_side.php</a>
                             </div>
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
			document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=delcategoryImg&mid="+mid;
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