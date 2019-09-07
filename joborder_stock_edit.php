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
        <h4 class="page-title">Issue stock for ( <?php echo $joborder_name;?> )</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">&nbsp;
    </div>
    <!-- /.col-lg-12 -->
</div>
<!--.row-->
<form action="conf_joborder_stock_issue_edit.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&mid=<?php echo $_GET['mid'];?>" method="post" enctype="multipart/form-data">
<?php echo $GeneralFunctions->alertmessages($_POST['msg_type'],$_POST['msg']);?>
<?php echo $GeneralFunctions->cmdType($_GET['cmdType'],$_GET['mid']);?>
<input type="hidden" name="ttlsize" id="ttlsize" value="1" />
<input type="hidden" name="joborder_id" value="<?php echo $mid;?>" />
<input type="hidden" name="assignment_id" value="<?php echo $assignment_id;?>" />
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
                                                    <?php echo $joborder_name;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assigning Date</label>
                                                <div class="input-group">
                                                    <?php echo $joborder_assign_date;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Completion Date</label>
                                                <div class="input-group">
                                                    <?php echo $joborder_complete_date;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Select Client</label>
                                                <div class="input-group">
                                                        <?php 
														$sqlevents="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_sts='A' AND tbllogin.typ_id=3 AND tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=$client_id";
														$sqleventsQ=$db->record_select($sqlevents);?>
														<?php echo $sqleventsQ[0]['user_first_name'];?>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assignment</label>
                                                <div class="input-group" id="DivAssignment">
													   <?php
													   	$assignmentQuery="SELECT * FROM tbl_assignment WHERE client_id=$client_id AND assignment_id=$assignment_id AND assignment_status='Enable'";
														$assignmentQueryQ=$db->record_select($assignmentQuery);
                                                        ?>
                                                        <?php echo $assignmentQueryQ[0]['assignment_name'];?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Supervisor</label>
                                                <div class="input-group">
                                                        <?php 
														$sqlevents="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_sts='A' AND tbllogin.typ_id=4 AND tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=$supervisor_id";
														$sqleventsQ=$db->record_select($sqlevents);?>
                                                                                                            
                                                    <?php echo $sqleventsQ[0]['user_first_name'];?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assignment Code</label>
                                                <div class="input-group">
                                                    <?php echo $assignment_code;?>
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
							$j=0;
							$k=0;
							$sqlsize="SELECT * FROM tbl_assignment_size, tbl_size WHERE tbl_assignment_size.assignment_id=$assignment_id AND tbl_assignment_size.size_id=tbl_size.size_id";
							$sqlsizeQ=$db->record_select($sqlsize);
							foreach($sqlsizeQ as $sqlsizeD){
							
							// to get units
							$sqlgetunits="SELECT * FROM tbl_joborder_size WHERE joborder_id=$joborder_id AND assignment_size_id=".$sqlsizeD['assignment_size_id']."";
							$sqlgetunitsQ=$db->record_select($sqlgetunits);
							?>
                            
							<div class="col-md-12">
								<div id="sizer<?php echo $j?>"  <?php if(!in_array($sqlsizeD['assignment_size_id'],$selectedSizes)) {echo ' style="opacity:0.2"';} else {echo ' style="opacity:1"';} ?>>
										<div class="row">
											<div class="col-md-3" style="padding:0px;">
												&nbsp;<b><?php echo $sqlsizeD['size']." ( ".$sqlsizeD['size_short']." )";?></b>
											</div>
											<div class="col-md-6">
												
											</div>
											<div class="col-md-1" style="text-align:right; line-height:30px;">
												
											</div>
											<div class="col-md-2" style="text-align:right; padding:0px;" id="DivUnits<?php echo $j?>">
												<b>Units: </b><?php echo $sqlgetunitsQ[0]['joborder_units'];?> &nbsp; &nbsp; 
                                            </div>
										</div>
										<div class="row">
											<table width="100%" id="customFields" class="form-table customFields" border="0" cellspacing="0" cellpadding="0"><!--table responsive-->
													<tr>
														<td valign="top">
															<table width="100%" id="tblmeterialofsize0" class="panel panel-success table responsive" border="0" cellspacing="0" cellpadding="0">
																<thead style="background-color:#bdedbc;">
																	<tr>
																		<th style="text-align:left;width:20%;"><b>Code</b></th>
																		<th style="text-align:left;width:20%;"><b>Name</b></th>
																		<th style="text-align:left;width:10%;"><b>Photo/Color</b></th>
																		<th style="text-align:left;width:10%;"><b>Quantity</b></th>
                                                                        <th style="text-align:left;width:20%;"><b>Select Stock</b></th>
                                                                        <th style="text-align:left;width:10%;"><b>Total</b></th>
                                                                        <th style="text-align:left;width:10%;"><b>Remaining</b></th>
																	</tr>
																</thead>
																<tbody>
																   <?php
																   $i=0;
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
																	}
																	else
																	{
																		$stock_image_URL="<div id='print".$sqlMaterialD['item_id']."' style='background-color:".$sqlstockItemD[0]['stock_color'].";margin:0px 0px 0px 0px;padding: 16px;border-radius:50%;width:5%;' disabled></div>";
																	}
																	
																	$newQty=$sqlMaterialD['assignment_quantity']*$sqlgetunitsQ[0]['joborder_units'];
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
																		<td><?php echo $stock_image_URL;?></td>																								
                                                                        <td><?php echo $newQty;?> <?php echo $sqlItemD[0]['uom'];?></td>
                                                                        <td>
								<input type="hidden" name="assignment_size_id[]" value="<?php echo $sqlsizeD['assignment_size_id'];?>" />
                            	<input type="hidden" name="size_id[]" value="<?php echo $sqlsizeD['size_id'];?>" />
								<input type="hidden" name="newqty[]" value="<?php echo $newQty;?>" />
                                <input type="hidden" name="uom_id[]" value="<?php echo $sqlItemD[0]['uom_id'];?>" />
                                <input type="hidden" name="item_id[]" value="<?php echo $sqlMaterialD['item_id'];?>" />
                                <input type="hidden" name="stock_item_id[]" value="<?php echo $sqlMaterialD['stock_item_id'];?>" />
                                <input type="hidden" name="assignment_meterial_id[]" value="<?php echo $sqlMaterialD['assignment_material_id'];?>" />
                                
                                <select relqty="<?php echo $newQty;?>" reluom="<?php echo $sqlItemD[0]['uom_id'];?>" relasid="<?php echo $sqlsizeD['assignment_size_id'];?>" reli="<?php echo $i;?>" class="select2 m-b-10 select2-multiple selectedstock" name="stocks<?php echo $k;?>[]" multiple="multiple" data-placeholder="Choose">
                                    <?php
									$remaining=0;
									$totalold=0;
									if($sqlItemD[0]['uom_id']==4 || $sqlItemD[0]['uom_id']==7)
									{
										$sqlstockItems="SELECT * FROM tbl_stock_items,tbl_stock_item_rolls WHERE tbl_stock_items.stock_item_id=tbl_stock_item_rolls.stock_item_id AND tbl_stock_items.stock_item_id=".$sqlMaterialD['stock_item_id']." AND tbl_stock_item_rolls.is_used=0";
										$sqlstockItemsQ=$db->record_select($sqlstockItems);
										foreach($sqlstockItemsQ as $sqlstockItemsD)
										{
											if($sqlItemD[0]['uom_id']==4)
												$sefield="meters";
											elseif($sqlItemD[0]['uom_id']==7)
												$sefield="yards";
										?>
											<option value="<?php echo $sqlstockItemsD['stock_item_roll_id'];?>"><?php echo $sqlstockItemsD['roll_no']." ( ".$sqlstockItemsD[''.$sefield.'']." ".$sefield." )";?></option>
									<?php }
									
										// to get old selected stocks rolls
										//$sqlstockItems="SELECT * FROM tbl_joborder_stock, tbl_joborder_stock_roll,tbl_stock_item_rolls WHERE tbl_joborder_stock_roll.stock_item_roll_id=tbl_stock_item_rolls.stock_item_roll_id AND tbl_joborder_stock.job_order_stock_id=tbl_joborder_stock_roll.job_order_stock_id AND tbl_joborder_stock.joborder_id=".$mid." AND tbl_stock_item_rolls.is_used=1";
										
										$sqlstockItems="SELECT * FROM tbl_joborder_stock, tbl_joborder_stock_roll,tbl_stock_item_rolls WHERE tbl_joborder_stock_roll.stock_item_roll_id=tbl_stock_item_rolls.stock_item_roll_id AND tbl_joborder_stock.job_order_stock_id=tbl_joborder_stock_roll.job_order_stock_id AND tbl_joborder_stock.joborder_id=".$mid." AND tbl_stock_item_rolls.is_used=1 AND tbl_joborder_stock.stock_item_id=".$sqlMaterialD['stock_item_id']."";
										
										$sqlstockItemsQ=$db->record_select($sqlstockItems);
										foreach($sqlstockItemsQ as $sqlstockItemsD)
										{
											if($sqlItemD[0]['uom_id']==4)
												$sefield="meters";
											elseif($sqlItemD[0]['uom_id']==7)
												$sefield="yards";
											
											$totalold=$totalold+$sqlstockItemsD[''.$sefield.''];
											
										?>
											<option selected value="<?php echo $sqlstockItemsD['stock_item_roll_id'];?>"><?php echo $sqlstockItemsD['roll_no']." ( ".$sqlstockItemsD[''.$sefield.'']." ".$sefield." )";?></option>
										<?php }
									
										$remaining=$totalold-$newQty;
									}
									else
									{
										$sqlstockItems="SELECT * FROM tbl_joborder_stock WHERE stock_item_id=".$sqlMaterialD['stock_item_id']."";
										$sqlstockItemsQ=$db->record_select($sqlstockItems);
										foreach($sqlstockItemsQ as $sqlstockItemsD)
										{
										?>
											<option selected value="<?php echo $sqlstockItemsD['job_order_stock_id'];?>-o-<?php echo $sqlstockItemsD['stock_item_id'];?>"><?php echo $sqlstockItemsD['assigned_qty']." ( ".$sqlItemD[0]['uom']." )";?></option>
									<?php 
											$totalold=$totalold+$sqlstockItemsD['assigned_qty'];
										}
									
										$sqlstockItems="SELECT * FROM tbl_stock_items WHERE stock_item_id=".$sqlMaterialD['stock_item_id']." AND stock_quantity<>0";
										$sqlstockItemsQ=$db->record_select($sqlstockItems);
										foreach($sqlstockItemsQ as $sqlstockItemsD)
										{
										?>
											<option value="<?php echo $sqlstockItemsD['stock_item_id'];?>"><?php echo $sqlstockItemsD['stock_quantity']." ( ".$sqlItemD[0]['uom']." )";?></option>
									<?php }
									
									
										
										$remaining=$totalold-$newQty;
                                    }
									
									
									?>
                                </select>
                                                                        </td>
                                                                        <td>
                                                                        <input type="hidden" value="<?php echo $totalold;?>" name="h_total[]" id="h_total_<?php echo $sqlsizeD['assignment_size_id'];?>_<?php echo $i;?>" />
                                                                        <input class="form-control" id="total_<?php echo $sqlsizeD['assignment_size_id'];?>_<?php echo $i;?><?php //echo $sqlsizeD['assignment_size_id'];?>" name="total[]" value="<?php echo $totalold;?>" readonly /></td>
                                                                        <td>
                                                                        <input type="hidden" name="h_remaining[]" id="h_remaining_<?php echo $sqlsizeD['assignment_size_id'];?>_<?php echo $i;?>" />
                                                                        <input class="form-control" id="remaining_<?php echo $sqlsizeD['assignment_size_id'];?>_<?php echo $i;?><?php //echo $sqlsizeD['assignment_size_id'];?>" name="remaining[]" value="<?php echo $remaining;?>" readonly /></td>
																	</tr>
																	<?php $i++; $k++;}?>
																</tbody>
															</table>
														</td>
													</tr>
											</table>
										</div>
									</div>
							</div>
							<?php $j++;}?>
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


		$(document).on("change",".selectedstock",function(){
			var thisval=$(this).val();
			var i=$(this).attr("reli");
			var asid=$(this).attr("relasid");
			var qty=$(this).attr("relqty");
			var reluom=$(this).attr("reluom");
			var totalDiv="#total_"+asid+"_"+i;
			var remainDiv="#remaining_"+asid+"_"+i;
			var htotalDiv="#h_total_"+asid+"_"+i;
			var hremainDiv="#h_remaining_"+asid+"_"+i;
			//alert(thisval);
			$.ajax({
			url: 'get_total_selected_stock_edit.php',
			type: 'POST',
			data: { asid:asid, stock_item_roll_id_temp:''+thisval+'', qty:qty, uom:reluom}, // it will serialize the form data
				dataType: 'html'
			})
			.done(function(data){
				var resultArray = jQuery.parseJSON(data);
				var totalAmount=resultArray['totalAmount'];
				var remainingQty=resultArray['remainingQty'];
				var totalAmount=resultArray['totalAmount'];
				var remainingQty=resultArray['remainingQty'];
				//alert(thisval);
				if(thisval===null)
				{
					$(totalDiv).val("");
					$(remainDiv).val("");
					$(htotalDiv).val("");
					$(hremainDiv).val("");
				}
				else
				{
					$(totalDiv).val(totalAmount);
					$(remainDiv).val(remainingQty);
					$(htotalDiv).val(totalAmount);
					$(hremainDiv).val(remainingQty);
				}
				//alert(data);
			})
			.fail(function(){
				alert('Ajax Submit Failed ...');	
			});
			
		});


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