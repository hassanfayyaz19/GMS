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
        <h4 class="page-title"><?php echo $pagetitle;?> ITEM</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <?php
	if($_GET['cmdType']=="edit"){
	?>
    	<a href="index_admin.php?chkp=380&m=124" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ADD ITEM</a>
    <?php }?>
    	<a href="index_admin.php?chkp=379&m=124" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ALL ITEM</a>
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
<form action="conf_add_items.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" id="form1" method="post" enctype="multipart/form-data">
<?php echo $GeneralFunctions->alertmessages($_POST['msg_type'],$_POST['msg']);?>
<?php echo $GeneralFunctions->cmdType($_GET['cmdType'],$_GET['mid']);?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="white-box">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">Item Information</h3>
                            <hr>
                            <div class="row">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td>
                                        <table class="form-table" id="customFields" width="100%">
                                          <tr>
                                            <th width="40%"> &nbsp; Code</th>
                                            <th width="40%"> &nbsp; Name</th>
                                            <th width="15%"> &nbsp; UOM </th>
                                            <th width="5%"></th>
                                          </tr>
                                           <tr valign="top">
                                             <td>
                                             	<input type="text" class="form-control inputcode" id="item_code1" name="item_code[]" rel="1" value="" placeholder="Item Code" />
                                             	<span id="error_item_code1" class="text-danger"></span>
                                             </td>
                                             <td>
                                                	<input type="text" class="form-control inputcode" id="item_name1" name="item_name[]" rel="1" value="" placeholder="Item Name" />
                                                	<span id="error_item_name1" class="text-danger"></span>
                                              </td>
                                                <td>
                                                	<select name="uom_id[]" id="uom_id1" rel="1" class="form-control inputcode">
                                                		<option value="0">Select UOM</option><?php $sqlevents="SELECT * FROM tbl_uom WHERE uom_status='Enable' ORDER BY uom";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['uom_id'];?>"><?php echo $sqleventsD['uom'];?></option><?php }?></select>
                                                	<span id="error_uom_id1" class="text-danger"></span>

                                                </td>
                                                <td><a href="javascript:void(0);" id="addCF"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-right">
                                            <button type="submit" id="sbmt" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
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
<!--.row-->
<!-- ============================================================== -->
<!-- .right-sidebar -->

<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->
<script>

	$(document).ready(function(){





		$('#sbmt').click(function (e) {
          e.preventDefault();
        var error_item_code1 = '';
        var error_item_name1 = '';
        var error_uom_id1 = '';
        if($('#item_code1').val() == '')
        {
            error_item_code1 = 'Item Code is Required';
            $('#error_item_code1').text(error_item_code1);
            $('#item_code1').css('border-color', '#cc0000');
        }
        else
        {
            error_item_code1 = '';
            $('#error_item_code1').text(error_item_code1);
            $('#item_code1').css('border-color', '');
        }
        if($('#item_name1').val() == '')
        {
            error_item_name1 = 'Item Name is Required';
            $('#error_item_name1').text(error_item_name1);
            $('#item_name1').css('border-color', '#cc0000');
        }
        else
        {
            error_item_name1 = '';
            $('#error_item_name1').text(error_item_name1);
            $('#item_name1').css('border-color', '');
        }
        if($('#uom_id1').val() == '0')
        {
            error_uom_id1 = 'UOM is Required';
            $('#error_uom_id1').text(error_uom_id1);
            $('#uom_id1').css('border-color', '#cc0000');
        }
        else
        {
            error_uom_id1 = '';
            $('#error_uom_id1').text(error_uom_id1);
            $('#uom_id1').css('border-color', '');
        }
        
       if($('#item_code1').val()!='' && $('#item_name1').val()!='' && $('#uom_id1').val()!='')
       {
      $("#form1").submit();
       }
    });





	var i=<?php echo $sqlgetinvoicedetailTotal+2;?>;
	$("#addCF").click(function(){
		$("#customFields").append('<tr valign="top"><td><input type="text" class="form-control inputcode" id="item_code'+i+'" name="item_code[]" rel="'+i+'" value="" placeholder="Item Code" /></td><td><input type="text" class="form-control inputcode" id="item_name'+i+'" name="item_name[]" rel="'+i+'" value="" placeholder="Item Name" /></td><td><select name="uom_id[]" id="uom_id'+i+'" rel="'+i+'" class="form-control inputcode"><?php $sqlevents="SELECT * FROM tbl_uom  WHERE uom_status='Enable' ORDER BY uom";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['uom_id'];?>"><?php echo $sqleventsD['uom'];?></option><?php }?></select></td><td><a href="javascript:void(0);" class="inputcode" rel="0" id="remCF"><i class="fa fa-times"></i></a></td></tr>');
		
		i++;
	});
	
	$(document).on('click', "#remCF",function(){
			$(this).parent().parent().remove();
			
			
		var finalttlamount=0;
		var finalttlgst=0;
		var finalttlsubttl=0;
		for(var r=1;r<=i;r++)
		{
			var amountId="#amount"+r;
			var gstId="#gst"+r;
			var subtotalId="#subtotal"+r;
			
			if($(amountId).length)
				var subamt=$(amountId).val();
			else
				var subamt=0;
			
			if($(gstId).length)
				var subgst=$(gstId).val();
			else
				var subgst=0;
				
			if($(subtotalId).length)	
				var subttl=$(subtotalId).val();
			else
				var subttl=0;
			
			if(subamt=="")
				subamt=0;
			if(subgst=="")
				subgst=0;
			if(subttl=="")
				subttl=0;
		
			var subtax=parseFloat(subamt)*parseFloat(subgst)/100;
		
			finalttlamount=parseFloat(finalttlamount)+parseFloat(subamt);
			finalttlgst=parseFloat(finalttlgst)+parseFloat(subtax);
			finalttlsubttl=parseFloat(finalttlsubttl)+parseFloat(subttl);		
		}
		
		$("#ttlamount").val(finalttlamount);
		$("#ttlgst").val(finalttlgst);
		$("#ttsubtotal").val(finalttlsubttl.toFixed(2));
			
		});
	
	
	$(document).on("keyup click change",".inputcode",function(){
		var j=$(this).attr("rel");
		if(j!=0)
		{
			
			var amountId="#amount"+j;
			var gstId="#gst"+j;
			var subtotalId="#subtotal"+j;
			
			var qtyId="#qty"+j;
			var hoursId="#hours"+j;
			var dayId="#day"+j;
			
			var amountval=$(amountId).val();
				if(amountval=="")
					amountval=0;
			var gstval=$(gstId).val();
				if(gstval=="")
					gstval=0;
			var subtotalval=$(subtotalId).val();
				if(subtotalval=="")
					subtotalval=0;
			
			var qtyval=$(qtyId).val();
				if(qtyval=="")
					qtyval=1;
			var hoursval=$(hoursId).val();
				if(hoursval=="")
					hoursval=1;
			var dayval=$(dayId).val();
				if(dayval=="")
					dayval=1;		
					
			var mul_all_fields=qtyval*hoursval*dayval*amountval;
			
			
			var sttlper=parseFloat(mul_all_fields)*parseFloat(gstval)/100;
			var sttl=parseFloat(mul_all_fields)+parseFloat(sttlper);
			$(subtotalId).val(sttl.toFixed(2));
		}
		
		//var rowCount = ($('#customFields tr').length)-1;
		var finalttlamount=0;
		var finalttlgst=0;
		var finalttlsubttl=0;
		var finalttlqty=0;
		var finalttlhours=0;
		var finalttlday=0;
		for(var r=1;r<=i;r++)
		{
			var amountId="#amount"+r;
			var gstId="#gst"+r;
			var subtotalId="#subtotal"+r;
			var qtyId="#qty"+r;
			var hoursId="#hours"+r;
			var dayId="#day"+r;
			
			if($(amountId).length)
				var subamt=$(amountId).val();
			else
				var subamt=0;
			
			if($(gstId).length)
				var subgst=$(gstId).val();
			else
				var subgst=0;
				
			if($(subtotalId).length)	
				var subttl=$(subtotalId).val();
			else
				var subttl=0;
			
			if($(qtyId).length)	
				var qtyttl=$(qtyId).val();
			else
				var qtyttl=0;
				
			if($(hoursId).length)	
				var hoursttl=$(hoursId).val();
			else
				var hoursttl=0;
				
			if($(dayId).length)	
				var dayttl=$(dayId).val();
			else
				var dayttl=0;
			
			
			
			if(subamt=="")
				subamt=0;
			if(subgst=="")
				subgst=0;
			if(subttl=="")
				subttl=0;
			if(qtyttl=="")
				qtyttl=0;
			if(hoursttl=="")
				hoursttl=0;
			if(dayttl=="")
				dayttl=0;
				
				
				
			
			var mul_all_fields=qtyttl*hoursttl*dayttl*subamt;
			var subtax=parseFloat(mul_all_fields)*parseFloat(subgst)/100;
			
			
			finalttlqty=parseFloat(finalttlqty)+parseFloat(qtyttl);
			finalttlhours=parseFloat(finalttlhours)+parseFloat(hoursttl);
			finalttlday=parseFloat(finalttlday)+parseFloat(dayttl);
			
			finalttlamount=parseFloat(finalttlamount)+parseFloat(subamt);
			finalttlgst=parseFloat(finalttlgst)+parseFloat(subtax);
			finalttlsubttl=parseFloat(finalttlsubttl)+parseFloat(subttl);		
		}
		
		
		$("#ttlhours").val(finalttlhours);
		$("#ttlday").val(finalttlday);
		
		$("#ttlqty").val(finalttlqty);
		$("#ttlamount").val(finalttlamount);
		$("#ttlgst").val(finalttlgst.toFixed(2));
		$("#ttsubtotal").val(finalttlsubttl.toFixed(2));
		
	});
	
	
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