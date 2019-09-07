<?php
if($_GET['cmdType']=="edit")
{
	$mid=$_GET['mid'];
	$sqleventId="SELECT * FROM tbl_joborder, tbl_assignment WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.joborder_id=$mid";
	$sqleventIdQ=$db->record_select($sqleventId);
	foreach($sqleventIdQ[0] as $name => $val)
	$$name=$val;
	
	$pagetitle='Edit';
	
	if($joborder_assign_date!="")
		$joborder_assign_date=date("d/m/Y",strtotime($joborder_assign_date));
		
	if($joborder_complete_date!="")
		$joborder_complete_date=date("d/m/Y",strtotime($joborder_complete_date));
	
	if($assignment_picture!="")
		$assignmentimg="plugins/images/assignment/".$assignment_picture."";
	else
		$assignmentimg="plugins/images/default.jpg";
		
	// to get selected sizes
	$sqlordersizes="SELECT * FROM tbl_joborder_size WHERE joborder_id=$joborder_id";
	$sqlordersizesQ=$db->record_select($sqlordersizes);
	foreach($sqlordersizesQ as $sqlordersizesD)
	{
		$selectedSizes[]=$sqlordersizesD['assignment_size_id'];
	}
	$JOAS = implode (", ", $selectedSizes);
}
else
{
	$pagetitle='Add';
}
?>


		
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo $pagetitle;?> JOB ORDER</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <?php
	if($_GET['cmdType']=="edit"){
	?>
    	<a href="index_admin.php?chkp=390&m=128" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ADD JOB ORDER</a>
    <?php }?>
    	<a href="index_admin.php?chkp=389&m=128" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ALL JOB ORDERS</a>
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
<form action="conf_add_job_orders.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" method="post" enctype="multipart/form-data">
<?php echo $GeneralFunctions->alertmessages($_POST['msg_type'],$_POST['msg']);?>
<?php echo $GeneralFunctions->cmdType($_GET['cmdType'],$_GET['mid']);?>
<input type="hidden" name="ttlsize" id="ttlsize" value="1" />
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="white-box">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">Job Order Information</h3>
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-10">
                            		<div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Job Order Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                                    <input type="text" class="form-control" id="joborder_name" name="joborder_name"  value="<?php echo $joborder_name;?>" placeholder="Job Order Name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assigning Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                    <input type="text" class="form-control datepicker-autoclose" name="assignment_date" placeholder="dd/mm/yyyy" value="<?php echo $joborder_assign_date;?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Completion Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                    <input type="text" class="form-control datepicker-autoclose" name="completion_date" placeholder="dd/mm/yyyy" value="<?php echo $joborder_complete_date;?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Select Client</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                    <select class="form-control select2" name="client_id" id="client_id">
                                                        <option value="">-Select Client-</option>
                                                        <?php $sqlevents="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_sts='A' AND tbllogin.typ_id=3 AND tbllogin.log_id=tbl_users.log_id";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['log_id'];?>" <?php if($client_id==$sqleventsD['log_id']) echo "selected";?>><?php echo $sqleventsD['user_first_name'];?></option><?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assignment</label>
                                                <div class="input-group" id="DivAssignment">
                                                    <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                                    <select class="form-control select2" name="assignment_id" id="assignment_id">
                                                        <option value="0">-Select Assignment-</option>
													   <?php
													   	$assignmentQuery="SELECT * FROM tbl_assignment WHERE client_id=$client_id AND assignment_status='Enable'";
														$assignmentQueryQ=$db->record_select($assignmentQuery);
                                                        foreach($assignmentQueryQ as $assignmentQueryD)
                                                        {
                                                        ?>
                                                            <option class="form-control" value="<?php echo $assignmentQueryD['assignment_id'];?>" <?php if($assignment_id==$assignmentQueryD['assignment_id']) echo "selected";?>><?php echo $assignmentQueryD['assignment_name'];?></option>
                                                    <?php 
                                                        } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Supervisor</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                    <select class="form-control select2" name="supervisor_id" id="supervisor_id">
                                                        <option value="">-Select Supervisor-</option>
                                                        <?php $sqlevents="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_sts='A' AND tbllogin.typ_id=4 AND tbllogin.log_id=tbl_users.log_id";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['log_id'];?>" <?php if($supervisor_id==$sqleventsD['log_id']) echo "selected";?>><?php echo $sqleventsD['user_first_name'];?></option><?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assignment Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-file"></i></div>
                                                    <input type="text" class="form-control" readonly="readonly" id="assignment_name" name="assignment_name" placeholder="Assignment Name" value="<?php echo $assignment_name;?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assignment Code</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-file"></i></div>
                                                    <input type="text" class="form-control" readonly="readonly" name="assignment_code" id="assignment_code" placeholder="Assignment Code" value="<?php echo $assignment_code;?>" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Status</label>
                                                <div class="input-group">
                                                    <?php echo $GeneralFunctions->getStatus("joborder_status", $joborder_status);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                            		<img id="AssignmentPic" src="<?php echo $assignmentimg;?>" width="125" />
                                </div>
                            </div>
                            
                        <div id="Mainsizer">
                            <?php
							$i=0;
							$sqlsize="SELECT * FROM tbl_assignment_size, tbl_size WHERE tbl_assignment_size.assignment_id=$assignment_id AND tbl_assignment_size.size_id=tbl_size.size_id";
							$sqlsizeQ=$db->record_select($sqlsize);
							foreach($sqlsizeQ as $sqlsizeD){
							
							// to get units
							$sqlgetunits="SELECT * FROM tbl_joborder_size WHERE joborder_id=$joborder_id AND assignment_size_id=".$sqlsizeD['assignment_size_id']."";
							$sqlgetunitsQ=$db->record_select($sqlgetunits);
							?>
							<div class="col-md-12">
								<div id="sizer<?php echo $i?>"  <?php if(!in_array($sqlsizeD['assignment_size_id'],$selectedSizes)) {echo ' style="opacity:0.2"';} else {echo ' style="opacity:1"';} ?>>
										<div class="row">
											<div class="col-md-1">
												<input type="checkbox" <?php if(in_array($sqlsizeD['assignment_size_id'],$selectedSizes)) echo 'checked=""'; ?> class="chkboxsize" rel="<?php echo $i;?>" value="<?php echo $sqlsizeD['assignment_size_id'];?>" name="sizecheck[]" id="sizecheck<?php echo $i?>">
											</div>
											<div class="col-md-2" style="padding:0px;">
												&nbsp;<b><?php echo $sqlsizeD['size']." ( ".$sqlsizeD['size_short']." )";?></b>
											</div>
											<div class="col-md-6">
												
											</div>
											<div class="col-md-1" style="text-align:right; line-height:30px;">
												<b>Units:</b>
											</div>
											<div class="col-md-2" style="text-align:right; padding:0px;" id="DivUnits<?php echo $i?>">
												<?php if(in_array($sqlsizeD['assignment_size_id'],$selectedSizes)){?>
                                                <input type="text" class="form-control" id="order_units<?php echo $i?>" name="order_units[]" placeholder="Enter Unit" value="<?php echo $sqlgetunitsQ[0]['joborder_units'];?>" />
												<?php }?>
                                            </div>
										</div>
										<div class="row">
											<table width="100%" id="customFields" class="form-table customFields" border="0" cellspacing="0" cellpadding="0"><!--table responsive-->
													<tr>
														<th style="text-align:center;width:75%;"><b>Expected Meterial</b></th>
														<th style="text-align:center;width:25%;"><b>Attribute</b></th>
													</tr>
													<tr>
														<td valign="top">
															<table width="100%" id="tblmeterialofsize0" class="panel panel-success table responsive" border="0" cellspacing="0" cellpadding="0">
																<thead style="background-color:#bdedbc;">
																	<tr>
																		<th style="text-align:left;width:19%;"><b>Code</b></th>
																		<th style="text-align:left;width:19%;"><b>Name</b></th>
																		<th style="text-align:left;width:15%;"><b>UOM</b></th>
																		<th style="text-align:left;width:15%;"><b>Photo</b></th>
																		<th style="text-align:left;width:15%;"><b>Color</b></th>
																		<th style="text-align:left;width:15%;"><b>Quantity</b></th>
																	</tr>
																</thead>
																<tbody>
																   <?php
																   $sqlMaterial="SELECT * FROM tbl_assignment_material WHERE assignment_size_id=".$sqlsizeD['assignment_size_id']."";
																   $sqlMaterialQ=$db->record_select($sqlMaterial);
																   foreach($sqlMaterialQ as $sqlMaterialD){
																	// to get Item Id
																	$sqlItem="SELECT * FROM tbl_items, tbl_uom WHERE tbl_items.item_id=".$sqlMaterialD['item_id']." AND tbl_items.uom_id=tbl_uom.uom_id";
																	$sqlItemD=$db->record_select($sqlItem);
																	
																	// to get stock Item id color/picture
																	$sqlstockItem="SELECT * FROM tbl_stock_items WHERE stock_item_id=".$sqlMaterialD['stock_item_id']."";
																	$sqlstockItemD=$db->record_select($sqlstockItem);
																	$stock_image_URL="";
																	$stock_image_color="";
																	
																	if($sqlstockItemD[0]['stock_image']!="")
																	{
																		$stock_image_URL="<img src='plugins/images/stock/".$sqlstockItemD[0]['stock_image']."' width='40' />";
																		$stock_image_color="";
																	}
																	else
																	{
																		$stock_image_URL="";
																		$stock_image_color="<div id='print".$sqlMaterialD['item_id']."' style='background-color:".$sqlstockItemD[0]['stock_color'].";margin:0px 0px 0px 30px;padding: 16px;border-radius:50%;width:5%;' disabled></div>";
																	}
																	
																   ?>   
																	<style>
																		@media print {
																		#print<?php echo $sqlMaterialD['item_id'];?>{
																			background-color: <?php echo $sqlstockItemD[0]['stock_color'];?> !important;
																			-webkit-print-color-adjust: exact; 
																		}
																	}
																	</style>      
																	<tr class="rowTextCenter" id="row0ofsize0" style="position:fix;">
																		<td>&nbsp;<?php echo $sqlItemD[0]['item_code'];?></td>
																		<td><?php echo $sqlItemD[0]['item_name'];?></td>
																		<td><?php echo $sqlItemD[0]['uom'];?></td>
																		<td><?php echo $stock_image_URL;?></td>
																		<td><?php echo $stock_image_color;?></td>
																		<td><?php echo $sqlMaterialD['assignment_quantity'];?></td>
																	</tr>
																	<?php }?>
																</tbody>
															</table>
														</td>
														<td valign="top">
															<table width="100%" id="tblattributeofsize0" class="panel panel-warning table responsive" border="0" cellspacing="0"cellpadding="0">
																<thead style="background-color:#ffefa4;">
																	<tr>
																		<th width="65%"><b>Attribute</b></th>
																		<th width="35%"><b>Price</b></th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																   $sqlAttribute="SELECT * FROM tbl_assignment_attribute, tbl_attribute WHERE tbl_assignment_attribute.assignment_size_id=".$sqlsizeD['assignment_size_id']." AND tbl_assignment_attribute.attribute_id=tbl_attribute.attribute_id";
																   $sqlAttributeQ=$db->record_select($sqlAttribute);
																   foreach($sqlAttributeQ as $sqlAttributeD){
																   ?> 
																	<tr class="rowTextCenter">
																		<td><?php echo $sqlAttributeD['attribute'];?></td>
																		<td><?php echo $sqlAttributeD['attribute_price'];?></td>
																	</tr>
																	<?php }?>
																</tbody>
															</table>
														</td>
													</tr>
											</table>
										</div>
									</div>
							</div>
							<?php $i++;}?>
                        </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                            <a href="index_admin.php?chkp=373&m=123" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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

<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form action="conf_send_email.php?chkp=<?php echo $_GET['chkp'];?>" method="post" id="FormEmail" enctype="multipart/form-data">
<input type="hidden" name="mid" value="<?php echo $_GET['mid'];?>" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabel">Unit</h4> </div>
                    <div class="modal-body">
                    	<div id="emailformmsg">
                        
                        </div>
                    	<div id="unitDiv">
                         
                        </div>
                        
                    </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
</div>

<!--.row-->
<!-- ============================================================== -->
<!-- .right-sidebar -->

<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->

<script>


jQuery('.datepicker-autoclose').datepicker({
	autoclose: true,
	format: 'dd/mm/yyyy',
	todayHighlight: true
});


$(document).on("change","#client_id", function(){
	var client_id=$(this).val();
	// code to filter and select item code
	$.ajax({
	url: 'get_client_assignments.php',
	type: 'POST',
	data: { client_id:client_id}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		$("#DivAssignment").html(data);
		$('#assignment_id').select2();
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});




$(document).on("change","#assignment_id", function(){
	var assignment_id=$(this).val();
	// code to filter and select item code
	$.ajax({
	url: 'get_client_assignment_detail.php',
	type: 'POST',
	data: { assignment_id:assignment_id}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		var resultArray = jQuery.parseJSON(data);
		var assignment_name=resultArray['assignment_name'];
		var assignment_code=resultArray['assignment_code'];
		var assignment_picture=resultArray['assignment_picture'];
		$("#assignment_name").val(assignment_name);
		$("#assignment_code").val(assignment_code);
		$("#AssignmentPic").attr("src",assignment_picture);
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
	
	
	// code to filter and select item code
	$.ajax({
	url: 'get_client_assignment_detail_html.php',
	type: 'POST',
	data: { assignment_id:assignment_id}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		$("#Mainsizer").html(data);
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
	
	
});



$(document).on("click",".chkboxsize",function(){
	var i = $(this).attr("rel");
	//alert($( "#sizecheck"+i ).prop( "checked", true ));	
	if($("#sizecheck"+i).prop('checked'))
	{
		document.getElementById("sizer"+i).style.opacity=1;
		//$("#order_units"+i).attr("disabled",false);
		$("#DivUnits"+i).html('<input type="text" class="form-control" id="order_units'+i+'" name="order_units[]" placeholder="Enter Unit" value="" />');
	}
	else
	{
		document.getElementById("sizer"+i).style.opacity=0.2;
		//$("#order_units"+i).attr("disabled",true);
		$("#DivUnits"+i).html('');
	}
});






$(document).ready(function() {
        // Basic
        $('.dropify').dropify(
			{
            messages: {
                default: 'Upload Assignment Image'
            }
        	}
		);
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

$(".select2").select2();
</script>
<style>
	.file-icon{ display:none !important;}
	.dropify-message p{ margin-top:1px !important;}
</style>