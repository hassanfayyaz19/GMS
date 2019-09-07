<?php
if($_GET['cmdType']=="edit")
{
	$mid=$_GET['mid'];
	$sqleventId="SELECT * FROM tbl_uom WHERE uom_id=$mid";
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
<form action="conf_add_job_orders.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" id="form1" method="post" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control" id="joborder_name" name="joborder_name"  value="" placeholder="Job Order Name" />

                                                </div>
                                                <span id="error_joborder_name" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assigning Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                    <input type="text" id="assignment_date" class="form-control datepicker-autoclose" name="assignment_date" placeholder="dd/mm/yyyy" value="<?php echo $fromdate;?>" />
                                                </div>
                                                <span id="error_assignment_date" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Completion Date</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                    <input type="text" id="completion_date" class="form-control datepicker-autoclose" name="completion_date" placeholder="dd/mm/yyyy" value="<?php echo $fromdate;?>" />
                                                    
                                                </div>
                                                <span id="error_completion_date" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Select Client</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                    <select class="form-control select2" name="client_id" id="client_id">
                                                        <option value="">-Select Client-</option>
                                                        <?php $sqlevents="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_sts='A' AND tbllogin.typ_id=3 AND tbllogin.log_id=tbl_users.log_id";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?>
                                                            <option value="<?php echo $sqleventsD['log_id'];?>">
                                                            <?php echo $sqleventsD['user_first_name'];?></option><?php }?>
                                                        
                                                    </select>
                                                </div>
                                                <span id="error_client_id" class="text-danger"></span>
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
                                                        <option value="">-Select Assignment-</option>
                                                    </select>
                                                </div>
                                                <span id="error_assignment_id" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Supervisor</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                    <select class="form-control select2" name="supervisor_id" id="supervisor_id">
                                                        <option value="">-Select Supervisor-</option>
                                                        <?php $sqlevents="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_sts='A' AND tbllogin.typ_id=4 AND tbllogin.log_id=tbl_users.log_id";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['log_id'];?>"><?php echo $sqleventsD['user_first_name'];?></option><?php }?>
                                                    </select>
                                                </div>
                                                <span id="error_supervisor_id" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assignment Name</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-file"></i></div>
                                                    <input type="text" class="form-control" readonly="readonly" id="assignment_name" name="assignment_name" placeholder="Assignment Name" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputuname">Assignment Code</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="fa fa-file"></i></div>
                                                    <input type="text" class="form-control" readonly="readonly" name="assignment_code" id="assignment_code" placeholder="Assignment Code" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                            		<img id="AssignmentPic" src="plugins/images/default.jpg" width="125" />
                                </div>
                            </div>
                            
                        <div id="Mainsizer">
                            
                        </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-right">
                                            <button type="submit" id="sbmt" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                            <a href="index_admin.php?chkp=389&m=128" class="btn btn-inverse waves-effect waves-light">Cancel</a>
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






var l=1;
$(document).on("click","#addMoreSize", function(){
 var ttlsize=parseInt($("#ttlsize").val());
 $("#ttlsize").val(ttlsize+1);
var i=0;
$("#sizer").append('<div id="container'+l+'">'+
		'<hr>'+
		'<div class="row">'+
			'<div class="col-md-3" style="padding:0px;">'+
			'<input type="hidden" name="sizecounter[]" id="sizecounter[]">'+
				'<select class="form-control" name="size'+l+'" style="background-color:#f0f0f0;">'+
				'	<option value="0">-Select Size-</option>'+
				'	<?php
					$sizeQuery="select * from tbl_size where size_status='Enable'";
					$sizeQueryselected=$db->record_select($sizeQuery);
					foreach($sizeQueryselected as $size){
					?>'+
				'	<option value="<?php echo $size['size_id'];?>"><?php echo $size['size_short'];?></option>'+
				'	<?php } ?>'+
				'</select>'+
			  '</div>'+
			  '<div class="col-md-8">'+
			  '</div>'+
			  '<div class="col-md-1" style="text-align:right;">'+
				 '<a href="javascript:;" class="clsmaindel" rel="'+l+'"><i class="fa fa-times colorRed font19"></i></a>'+
			  '</div>'+
		'</div>'+
		'	<div class="row" id="size'+l+'">'+
		'		<table width="100%" id="customFields" class="form-table customFields" border="0" cellspacing="0" cellpadding="0">'+
		'				<thead style="background-color:#c5e8f7;">'+
		'					<tr>'+
		'						<th style="text-align:center;width:75%;"><b>Expected Meterial</b></th>'+
		'						<th style="text-align:center;width:25%;"><b>Attribute</b></th>'+
		'					</tr>'+
		'				</thead>'+
		'				<tbody>'+
		'					<tr>'+
		'						<td valign="top">'+
		'							<table width="100%" id="tblmeterialofsize'+l+'" class="panel panel-success table responsive" border="0" cellspacing="0" cellpadding="0">'+
		'								<thead style="background-color:#bdedbc;">'+
		'									<tr>'+
		'										<th style="text-align:center;width:16%;"><b>Code</b></th>'+
		'										<th style="text-align:center;width:16%;"><b>Name</b></th>'+
		'										<th style="text-align:center;width:15%;"><b>UOM</b></th>'+
		'										<th style="text-align:center;width:18%;"><b>Photo</b></th>'+
		'										<th style="text-align:center;width:18%;"><b>Color</b></th>'+
		'										<th style="text-align:center;width:15%;"><b>Quantity</b></th>'+
		'										<th style="text-align:center;width:2%;">&nbsp </th>'+
		'									</tr>'+
		'								</thead>'+
		'								<tbody><input name="itemincrementerforsize'+l+'" id="itemincrementerforsize'+l+'" value="1" hidden />'+
		'									<tr class="rowTextCenter" id="row0ofsize'+l+'">'+
		'										<td>'+
		'										<input name="itemcounterforsize'+l+'[]" hidden />'+
		'										<div id="Divitemcode'+i+'ofsize'+l+'">'+
		'										<select class="form-control select2 itemCode" name="itemcodeofsize'+l+'[]" id="itemcode'+i+'ofsize'+l+'" rel="'+l+'" reli="'+i+'">'+
													'<option value="">Select Product</option>'+
													'<?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";
													$sqleventsQ=$db->record_select($sqlevents);
													foreach($sqleventsQ as $sqleventsD){?>'+
														'<option value="<?php echo $sqleventsD['item_id'];?>"><?php echo $sqleventsD['item_code'];?></option>'+
													'<?php }?>'+
												'</select>'+
												'</div>'+
		'										</td>'+
		'									<td>'+
		'										<div id="Divitemname'+i+'ofsize'+l+'">'+
		'										<select class="form-control select2 itemName" name="itemnameofsize'+l+'[]" id="itemname'+i+'ofsize'+l+'" rel="'+l+'" reli="'+i+'">'+
													'<option value="">Select Product</option>'+
													'<?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";
													$sqleventsQ=$db->record_select($sqlevents);
													foreach($sqleventsQ as $sqleventsD){?>'+
		'												<option value="<?php echo $sqleventsD['item_id'];?>"><?php echo $sqleventsD['item_name'];?></option>'+
													'<?php }?>'+
		'										</select>'+
												'</div>'+
		'									</td>'+
		'										<td id="Divuom'+i+'ofsize'+l+'">'+
		'											<select class="form-control"  name="uomofsize'+l+'[]" id="uom'+i+'ofsize'+l+'">'+
		'												<option value="0">-Select UOM-</option>'+
		'												<?php 
														$uomQuery="select * from uom where status='1'";
														$uomQueryselected=$db->record_select($uomQuery);
														foreach($uomQueryselected as $uom){
														?>'+
		'												<option value="<?php echo $uom['uom_group'];?>"><?php echo $uom['uom_name'];?></option>'+
		'												<?php } ?>'+
		'											</select>'+
		'										</td>'+
		'										<td>'+
													'<input type="hidden" name="product_pictureofsize'+l+'[]" id="product_picture'+i+'ofsize'+l+'" />'+
		'											<div id="Divproduct_picture'+i+'ofsize'+l+'">'+           	
		'												<ul class="nav navbar-top-links navbar-left">'+
		'													<li class="dropdown">'+
		'														<div class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" style="padding:10px 0px 0px 30px;" id="sproduct_picture'+i+'ofsize'+l+'">'+
		'															Select Picture'+
		'														</div>'+
		'													</li>'+
		'												</ul>'+
        '                                           </div>'+
'												</td>'+
		'										<td id="Divcolor'+i+'ofsize'+l+'">'+
		'											<select class="form-control">'+
		'												<option value="0">-Select Color-</option>'+
		'											</select>'+
		'										</td>'+
		'										<td><input class="form-control" id="firstquantity'+i+'ofsize'+l+'" name="firstquantityofsize'+l+'[]" data-validate="required" placeholder=""></td>'+
		'										<td style="text-align:center"><a href="javascript:void(0);" class="addCF" rel="'+l+'" reli="'+i+'" id="addmeterial"><i class="fa fa-plus" style="color:green;"></i></a></td>'+
		'									</tr>'+
		'								</tbody>'+
		'							</table>'+
		'						</td>'+
		'						<td valign="top">'+
		'							<table width="100%" id="tblattributeofsize'+l+'" class="panel panel-warning table responsive" border="0" cellspacing="0" cellpadding="0">'+
	'									<tr>'+
	'										<!--<th><b>Code</b></th>-->'+
	'										<th width="65%"><b>Attribute</b></th>'+
	'										<th width="35%"><b>Price</b></th>'+
	'										<th style="text-align:center;width:2%;">&nbsp</th>'+
	'									</tr>'+
	'									<tr class="rowTextCenter">'+
	'										<!--<td><input class="form-control" id="itemcode0" name="itemcode0" onchange="itemnamer(0)" data-validate="required" placeholder="Search Item name"></td>-->'+
	'										<td><input id="attributeincrementerforsize'+l+'" name="attributeincrementerforsize'+l+'" value="1" hidden/>'+
	'											<input name="attributecounterforsize'+l+'[]" hidden />'+
	'											<select class="form-control" id="attributeid'+i+'ofsize'+l+'" name="attributeidofsize'+l+'[]">'+
	'												<?php 
													$attribute="select * from tbl_attribute where attribute_status='Enable'";
													$attribute=$db->record_select($attribute);
													foreach($attribute as $attribute){
													?>'+
	'													<option value="<?php echo $attribute['attribute_id'];?>"><?php echo $attribute['attribute'];?></option>'+
	'												<?php } ?>'+
	'											</select>'+
	'										</td>'+
	'										<td><input class="form-control" id="attributeprice'+i+'ofsize'+l+'" name="attributepriceofsize'+l+'[]" data-validate="required" placeholder="Price"></td>'+
	'										<td style="text-align:center"><a href="javascript:void(0);" class="addattribute" reli="'+i+'" rel="'+l+'"><i class="fa fa-plus" style="color:green;"></i></a></td>'+
	'									</tr>'+
		'							</table>'+
		'						</td>'+
		'					</tr>'+
		'				</tbody>'+
		'			</table>'+
		'	</div>'+
		'</div>');
		$('#itemname'+i+'ofsize'+l+'').select2();
		$('#itemcode'+i+'ofsize'+l+'').select2();
		l++;
	return false;
});


$(document).on("click",".clsmaindel",function(){
	var loopid=$(this).attr("rel");
	var loopdiv="#container"+loopid;
	$(loopdiv).remove();
});


$(document).on('click', ".remInv",function(){
	//alert("called");
	$(this).parent().parent().remove();
});


/*old code start here*/
var i=1;
$(document).on("click",".addCF", function(){
		var l=$(this).attr("rel");
		//alert(size);
		$("#tblmeterialofsize"+l).append('<tr class="rowTextCenter" id="row0ofsize'+i+'">'+
		'<td>'+
		'<input name="itemcounterforsize'+i+'[]" hidden />'+
		'<div id="Divitemcode'+i+'ofsize'+l+'">'+
		'<select class="form-control select2 itemCode" name="itemcodeofsize'+l+'[]" id="itemcode'+i+'ofsize'+l+'" reli="'+i+'" rel="'+l+'">'+
			'<option value="">Select Product</option>'+
			'<?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";
			$sqleventsQ=$db->record_select($sqlevents);
			foreach($sqleventsQ as $sqleventsD){?>'+
				'<option value="<?php echo $sqleventsD['item_id'];?>"><?php echo $sqleventsD['item_code'];?></option>'+
			'<?php }?>'+
		'</select>'+
		'</div>'+
		'</td>'+
		'<td>'+
		'<div id="Divitemname'+i+'ofsize'+l+'">'+
		'<select class="form-control select2 itemName" name="itemnameofsize'+l+'[]" id="itemname'+i+'ofsize'+l+'" reli="'+i+'" rel="'+l+'">'+
			'<option value="">Select Product</option>'+
			'<?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";
			$sqleventsQ=$db->record_select($sqlevents);
			foreach($sqleventsQ as $sqleventsD){?>'+
		'		<option value="<?php echo $sqleventsD['item_id'];?>"><?php echo $sqleventsD['item_name'];?></option>'+
			'<?php }?>'+
		'</select>'+
		'</div>'+
		'</td>'+
		'<td id="Divuom'+i+'ofsize'+l+'">'+
		'	<select class="form-control"  name="uomofsize'+l+'[]" id="uom'+i+'ofsize'+l+'">'+
		'		<option value="0">-Select UOM-</option>'+
		'		<?php 
				$uomQuery="select * from uom where status='1'";
				$uomQueryselected=$db->record_select($uomQuery);
				foreach($uomQueryselected as $uom){
				?>'+
		'		<option value="<?php echo $uom['uom_group'];?>"><?php echo $uom['uom_name'];?></option>'+
		'		<?php } ?>'+
		'	</select>'+
		'</td>'+
		'<td>'+
			'<input type="hidden" name="product_pictureofsize'+l+'[]" id="product_picture'+i+'ofsize'+l+'" />'+
		'		<div id="Divproduct_picture'+i+'ofsize'+l+'">'+           	
		'			<ul class="nav navbar-top-links navbar-left">'+
		'				<li class="dropdown">'+
		'					<div class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" style="padding:10px 0px 0px 30px;" id="sproduct_picture'+i+'ofsize'+l+'">'+
		'						Select Picture'+
		'					</div>'+
		'				</li>'+
		'			</ul>'+
		'       </div>'+
		'</td>'+
		'<td id="Divcolor'+i+'ofsize'+l+'">'+
		'	<select class="form-control">'+
		'		<option value="0">-Select Color-</option>'+
		'	</select>'+
		'</td>'+
		'<td><input class="form-control" id="firstquantity0ofsize'+l+'" name="firstquantityofsize'+l+'[]" data-validate="required" placeholder=""></td>'+
		'<td style="text-align:center"><a href="javascript:void(0);" class="inputcode remCF" rel="'+i+'" id="remCF"><i class="fa fa-times"></i></a></td>'+
		'</tr>');
		$('#itemname'+i+'ofsize'+l+'').select2();
		$('#itemcode'+i+'ofsize'+l+'').select2();
		i++;
		//document.getElementById("maxrecord").value=i;
	
	
});

var j=1;
$(document).on("click",".addattribute", function(){
		var size=$(this).attr("rel");
		$("#tblattributeofsize"+size).append('<tr class="rowTextCenter">'+
			'<td>'+
			'<input name="attributecounterforsize'+size+'[]" hidden />'+
			'<select class="form-control" id="attributeid'+j+'ofsize'+size+'" name="attributeidofsize'+size+'[]">'+
				'<?php 
				$attribute="select * from tbl_attribute where attribute_status='Enable'";
				$attribute=$db->record_select($attribute);
				foreach($attribute as $attribute){
				?>'+
				'<option value="<?php echo $attribute['attribute_id'];?>"><?php echo $attribute['attribute'];?></option>'+
				'<?php } ?>'+
			'</select></td>'+
			'<td><input class="form-control" id="attributeprice'+j+'ofsize'+size+'" name="attributepriceofsize'+size+'[]" data-validate="required" placeholder="Price"></td>'+
			'<td style="text-align:center"><a href="javascript:void(0);" class="inputcode remInv" rel="'+j+'"><i class="fa fa-times gridRemove" style="color:red;"></i></a></td></tr>');
			document.getElementById("attributeincrementerforsize"+size).value=eval(j)+eval(1);
			j++;
});

$(document).on("click",".btnCancel", function(){
	$('#myModal1').modal('hide');
});

$(document).on("click",".clsproimages", function(){
	var i=$(this).attr("reli");
	var l=$(this).attr("rel");
	var imgPath=$(this).attr("relimg");
	var stock_item_id=$(this).attr("relid");
	$("#sproduct_picture"+i+"ofsize"+l+"").html("<img src='"+imgPath+"' width='40' />");
	$("#product_picture"+i+"ofsize"+l+"").val(stock_item_id);
	//product_picture0ofsize0
});

$(document).on("click",".btnunittotal", function(){
	var x=$(this).attr("relx");
	var i=$(this).attr("reli");
	var firtvaltemp;
	var secondvaltemp;
	var firtval=0;
	var secondval=0;
	
	for(var j=1;j<=<?php echo $MaxRolDel;?>;j++)
	{
		var removeField='#item'+x+'roll'+j+'';
		var removeFieldf='#item'+x+'roll'+j+'first'+j+'';
		var removeFields='#item'+x+'roll'+j+'second'+j+'';
		$(removeField).remove();
		$(removeFieldf).remove();
		$(removeFields).remove();
	}
	
	for(var j=1;j<=i;j++)
	{
		rollIdtemp="#tempitem"+x+"roll"+j;
		firtvaltemp="#tempitem"+x+"roll"+j+"first"+j;
		secondvaltemp="#tempitem"+x+"roll"+j+"second"+j;
		firtval=firtval+parseFloat(($(firtvaltemp).val()));
		secondval=secondval+parseFloat(($(secondvaltemp).val()));
		
		$("#roller").append(
			'<input value="'+($(rollIdtemp).val())+'" id="item'+x+'roll'+j+'" name="item'+x+'roll'+j+'" data-validate="required" type="hidden" />'+
			'<input value="'+($(firtvaltemp).val())+'" id="item'+x+'roll'+j+'first'+j+'"  name="item'+x+'roll'+j+'first'+j+'" data-validate="required" type="hidden" />'+
			'<input value="'+($(secondvaltemp).val())+'" id="item'+x+'roll'+j+'second'+j+'" name="item'+x+'roll'+j+'second'+j+'" data-validate="required" type="hidden" />');
		
	}
	//alert(firtval+"-"+secondval);
	$("#firstquantity"+x).val(firtval.toFixed(<?php echo $RoundUpTo;?>));
	$("#secondquantity"+x).val(secondval.toFixed(<?php echo $RoundUpTo;?>));
	
	$("#firstquantityh"+x).val(firtval.toFixed(<?php echo $RoundUpTo;?>));
	$("#secondquantityh"+x).val(secondval.toFixed(<?php echo $RoundUpTo;?>));
	$('#myModal1').modal('hide');
	$("#eye"+x).show();
	//document.getElementById("eye"+x).style.display="block";
	
});

$(document).on("change",".clsunit",function(){
	$('#myModal1').modal({show:true});
	//var totalunit=$(this).val();
	//var x=$(this).attr("rel");
	var x=$(this).attr("rel");
	var totalunit=$("#position"+x).val();
	var item_code_temp="#item_code"+x;
	var item_code_val=$(item_code_temp).val();
	
	
	
	// code to filter and select item code
	$.ajax({
	url: 'get_stock_unit_code.php',
	type: 'POST',
	data: { totalunit:totalunit, x:x, item_code:item_code_val}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		//var resultArray = jQuery.parseJSON(data);
		//alert(data);
		$("#unitDiv").html(data);
		var rollIdtemp,firtvaltemp,secondvaltemp,lastrollId,lastRollFirstVal,lastRollSecondVl;
		for(var j=1;j<=totalunit;j++)
		{
			// to get last hidden fields
			lastrollId='#item'+x+'roll'+j+'';
			lastRollFirstVal='#item'+x+'roll'+j+'first'+j+'';
			lastRollSecondVl='#item'+x+'roll'+j+'second'+j+'';
			
			// to store data
			rollIdtemp="#tempitem"+x+"roll"+j;
			firtvaltemp="#tempitem"+x+"roll"+j+"first"+j;
			secondvaltemp="#tempitem"+x+"roll"+j+"second"+j;
			
			
			if($(lastrollId).val())
			$(rollIdtemp).val($(lastrollId).val());
			
			if($(lastRollFirstVal).val()!="")
			$(firtvaltemp).val($(lastRollFirstVal).val());
			
			if($(lastRollSecondVl).val()!="")
			$(secondvaltemp).val($(lastRollSecondVl).val());
		}
		

	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});	});
$(document).on("click",".clseye",function(){
	$('#myModal1').modal({show:true});
	//var totalunit=$(this).val();
	//var x=$(this).attr("rel");
	var x=$(this).attr("rel");
	var totalunit=$("#position"+x).val();
	var item_code_temp="#item_code"+x;
	var item_code_val=$(item_code_temp).val();
	
	
	
	// code to filter and select item code
	$.ajax({
	url: 'get_stock_unit_code.php',
	type: 'POST',
	data: { totalunit:totalunit, x:x, item_code:item_code_val}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		//var resultArray = jQuery.parseJSON(data);
		//alert(data);
		$("#unitDiv").html(data);
		var rollIdtemp,firtvaltemp,secondvaltemp,lastrollId,lastRollFirstVal,lastRollSecondVl;
		for(var j=1;j<=totalunit;j++)
		{
			// to get last hidden fields
			lastrollId='#item'+x+'roll'+j+'';
			lastRollFirstVal='#item'+x+'roll'+j+'first'+j+'';
			lastRollSecondVl='#item'+x+'roll'+j+'second'+j+'';
			
			// to store data
			rollIdtemp="#tempitem"+x+"roll"+j;
			firtvaltemp="#tempitem"+x+"roll"+j+"first"+j;
			secondvaltemp="#tempitem"+x+"roll"+j+"second"+j;
			
			
			if($(lastrollId).val())
			$(rollIdtemp).val($(lastrollId).val());
			
			if($(lastRollFirstVal).val()!="")
			$(firtvaltemp).val($(lastRollFirstVal).val());
			
			if($(lastRollSecondVl).val()!="")
			$(secondvaltemp).val($(lastRollSecondVl).val());
		}
		

	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});	});

$(document).on("keyup",".clsyards", function(){
	var x=$(this).attr("relx");
	var i=$(this).attr("reli");
	var firstval=$(this).val();
	var secondval=(firstval/<?php echo $ratio;?>).toFixed(<?php echo $RoundUpTo;?>);
	var secondvaltemp="#tempitem"+x+"roll"+i+"second"+i;
	$(secondvaltemp).val(secondval);
});

$(document).on("keyup",".clsmeters", function(){
	var x=$(this).attr("relx");
	var i=$(this).attr("reli");
	var secondtval=$(this).val();
	var firstval=(secondtval*<?php echo $ratio;?>).toFixed(<?php echo $RoundUpTo;?>);
	var firtvaltemp="#tempitem"+x+"roll"+i+"first"+i;
	$(firtvaltemp).val(firstval);
});

$(document).on("change",".itemName",function(){
	var item_name=$(this).val();
	var l=$(this).attr("rel");
	var i=$(this).attr("reli");
	var item_name_temp='#itemcode'+i+'ofsize'+l+'';
	var itemnameseltemp='#Divitemcode'+i+'ofsize'+l+'';
	var itemuomtemp="#Divuom"+i+"ofsize"+l+"";
	var itempicturetemp="#Divproduct_picture"+i+"ofsize"+l+"";
	var itemcolortemp="#Divcolor"+i+"ofsize"+l+"";
	// code to filter and select item code
	$.ajax({
	url: 'get_assignment_itemcode.php',
	type: 'POST',
	data: { item_id:item_name, l:l, i:i}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		//var resultArray = jQuery.parseJSON(data);
		//alert(data);
		$(itemnameseltemp).html(data); 
		$(item_name_temp).select2();

	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
	
	// to filter and select UOM against that item
	$.ajax({
	url: 'get_assignment_uom.php',
	type: 'POST',
	data: { item_id:item_name, l:l, i:i}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		//var resultArray = jQuery.parseJSON(data);
		//alert(data);
		$(itemuomtemp).html(data); 

	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
	
	// to filter images of that product
	$.ajax({
	url: 'get_assignment_images.php',
	type: 'POST',
	data: { item_id:item_name, l:l, i:i}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		$(itempicturetemp).html(data); 

	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
	//alert('called');
	// to filter color of this product
	$.ajax({
	url: 'get_assignment_color.php',
	type: 'POST',
	data: { item_id:item_name, l:l, i:i}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		$(itemcolortemp).html(data); 
		//alert(itemcolortemp);
	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
	
});
//icc
$(document).on("change",".itemCode",function(){
	var item_name=$(this).val();
	var l=$(this).attr("rel");
	var i=$(this).attr("reli");
	var item_name_temp='#itemname'+i+'ofsize'+l+'';
	var itemnameseltemp='#Divitemname'+i+'ofsize'+l+'';
	var itemuomtemp="#Divuom"+i+"ofsize"+l+"";
	var itempicturetemp="#Divproduct_picture"+i+"ofsize"+l+"";
	var itemcolortemp="#Divcolor"+i+"ofsize"+l+"";
	
	
	// code to filter and select item code
	$.ajax({
	url: 'get_assignment_itemname.php',
	type: 'POST',
	data: { item_id:item_name, l:l, i:i}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		//var resultArray = jQuery.parseJSON(data);
		//alert(data);
		$(itemnameseltemp).html(data); 
		$(item_name_temp).select2();

	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
	
	// to filter and select UOM against that item
	$.ajax({
	url: 'get_assignment_uom.php',
	type: 'POST',
	data: { item_id:item_name, l:l, i:i}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		//var resultArray = jQuery.parseJSON(data);
		//alert(data);
		$(itemuomtemp).html(data); 

	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
	
	// to filter images of that product
	$.ajax({
	url: 'get_assignment_images.php',
	type: 'POST',
	data: { item_id:item_name, l:l, i:i}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		$(itempicturetemp).html(data); 

	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
	
	// to filter color of this product
	$.ajax({
	url: 'get_assignment_color.php',
	type: 'POST',
	data: { item_id:item_name, l:l, i:i}, // it will serialize the form data
		dataType: 'html'
	})
	.done(function(data){
		$(itemcolortemp).html(data); 

	})
	.fail(function(){
		alert('Ajax Submit Failed ...');	
	});
});

$(document).on("change",".clsstockpicview",function(){
	var x=$(this).attr("rel");
	if(document.getElementById("stock_pictures"+x).value!=""){
		document.getElementById("stockcolor"+x).disabled = true;
		//toastr.success("","Photo Selected for the record "+(x+1),top);
		document.getElementById("view"+x).innerHTML = '<div class="col-md-6">'+
													  '	<img src="" id="stock_image'+x+'" width="40px" height="20px" style="border-radius:50%;">'+
													  '</div>';
		document.getElementById("cross"+x).innerHTML ='<div class="col-md-6"><i class="fa fa-times imgdel" rel="'+x+'"></i></div>';
		var reader = new FileReader();
			reader.onload = function (event){
			$('#stock_image'+x).attr('src', event.target.result);
			};
			var stockpick=document.getElementById("stock_pictures"+x);
			reader.readAsDataURL(stockpick.files[0]);
	}else{
		document.getElementById("stockcolor"+x).disabled = false;
	}});

$(document).on('click', ".imgdel",function(){
	var x=$(this).attr("rel");
	document.getElementById("stockcolor"+x).disabled = false;
	$("#stock_pictures"+x).val();
	$("#view"+x).html('<i class="entypo-picture"></i> &nbsp;Upload Picture ');
	$("#cross"+x).html('');});

$(document).on('click', ".remCF",function(){
	var x=$(this).attr("rel");
	var position=$("#position"+x).val();
	
	for(var j=1;j<=position;j++)
	{
		var rollIdtemp="#item"+x+"roll"+j;
		var firtvaltemp="#item"+x+"roll"+j+"first"+j;
		var secondvaltemp="#item"+x+"roll"+j+"second"+j;
		
		$("#firstquantityh"+x).val(0);
		$("#secondquantityh"+x).val(0);
		
		$(rollIdtemp).remove();
		$(firtvaltemp).remove();
		$(secondvaltemp).remove();
	}
	$(this).parent().parent().remove();
	
	

	
});

$(document).on('change', ".colorpiker",function(){
	var thisval=$(this).val();
	var thisid=$(this).attr("rel");
	document.getElementById("stockcolorname"+thisid).value = thisval;});

$(document).on('change', ".colorpikercode",function(){
	var thisval=$(this).val();
	var thisid=$(this).attr("rel");
	document.getElementById("stockcolor"+thisid).value = thisval;});
		
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
	});});
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
        var error_joborder_name = '';
        var error_assignment_date = '';
        var error_completion_date = '';
        var error_client_id = '';
        var error_assignment_id = '';
        var error_supervisor_id = '';
        if($('#joborder_name').val() == '')
        {
            error_joborder_name = 'Job order name is required';
            $('#error_joborder_name').text(error_joborder_name);
            $('#joborder_name').css('border-color', '#cc0000');
        }
        else
        {
            error_joborder_name = '';
            $('#error_joborder_name').text(error_joborder_name);
            $('#joborder_name').css('border-color', '');
        }
        if($('#assignment_date').val() == '')
        {
            error_assignment_date = 'Assignment date is required';
            $('#error_assignment_date').text(error_assignment_date);
            $('#assignment_date').css('border-color', '#cc0000');
        }
        else
        {
            error_assignment_date = '';
            $('#error_assignment_date').text(error_assignment_date);
            $('#assignment_date').css('border-color', '');
        }
        if($('#completion_date').val() == '')
        {
            error_completion_date = 'Completion date is required';
            $('#error_completion_date').text(error_completion_date);
            $('#completion_date').css('border-color', '#cc0000');
        }
        else
        {
            error_completion_date = '';
            $('#error_completion_date').text(error_completion_date);
            $('#completion_date').css('border-color', '');
        }
        if($('#client_id').val() == '')
        {
            error_client_id = 'Client id is required';
            $('#error_client_id').text(error_client_id);
            $('#client_id').css('border-color', '#cc0000');
        }
        else
        {
            error_client_id = '';
            $('#error_client_id').text(error_client_id);
            $('#client_id').css('border-color', '');
        }
        if($('#assignment_id').val() == '')
        {
            error_assignment_id = 'Assignment id is required';
            $('#error_assignment_id').text(error_assignment_id);
            $('#assignment_id').css('border-color', '#cc0000');
        }
        else
        {
            error_assignment_id = '';
            $('#error_assignment_id').text(error_assignment_id);
            $('#assignment_id').css('border-color', '');
        }
        if($('#supervisor_id').val() == '')
        {
            error_supervisor_id = 'Supervisor id is required';
            $('#error_supervisor_id').text(error_supervisor_id);
            $('#supervisor_id').css('border-color', '#cc0000');
        }
        else
        {
            error_supervisor_id = '';
            $('#error_supervisor_id').text(error_supervisor_id);
            $('#supervisor_id').css('border-color', '');
        }
        
       if($('#joborder_name').val()!='' && $('#assignment_date').val()!='' && $('#completion_date').val()!='' && $('#client_id').val()!='' && $('#assignment_id').val()!='' && $('#supervisor_id').val()!='')
       {
      $("#form1").submit();
       }
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
                default: 'Glissez-d�posez un fichier ici ou cliquez',
                replace: 'Glissez-d�posez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'D�sol�, le fichier trop volumineux'
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

$("#joborder_name").blur(function () {
    var joborder_name = $('#joborder_name').val();

    $.ajax({
        url: 'get_joborder_name.php',
        type: 'POST',
        data: {joborder_name: joborder_name}
    })
        .done(function (data) {
            if (data != 'not found') {
                $('#error_joborder_name').html(data);
                $("#sbmt").attr("disabled", true);
            } else {
                $('#error_joborder_name').html('');
                $("#sbmt").attr("disabled", false);
            }
        })
        .fail(function () {
            alert('Ajax Submit Failed ...');
        });

});
</script>
<style>
	.file-icon{ display:none !important;}
	.dropify-message p{ margin-top:1px !important;}
</style>