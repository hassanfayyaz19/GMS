<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">List of Item</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    	<?php if($RoleArray['New']==1){?>
    	<a href="index_admin.php?chkp=380&m=124" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ADD ITEM</a>
        <?php }?>
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
<form action="#" method="post">
<div class="row">
	<div class="col-lg-12">
        <div class="white-box">
            <table id='demo-foo-pagination' class='display dataTable'>
                <thead>
                    <tr>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>UOM</th>
                        <th width="100">Extra</th>
                    </tr>
                </thead>    
            </table>
        </div>
    </div>
</div>
</form>
<!--.row-->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    	<form action="conf_add_items.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" id="FormEdit" method="post" enctype="multipart/form-data">
            <input type="hidden" name="item_id" id="item_id" value="" />
            <input type="hidden" name="cmdType" id="cmdType" value="1" />
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">Loading...</h4> </div>
                        <div class="modal-body" id="modal-body">   
                        	 <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="EditMsg">
                                        
                                     </div>
                                </div>
                             </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <b>  Item Name </b> 
                                        <input type="text" class="form-control" name="edit_item_name" id="edit_item_name" value="" placeholder="Item Name">
                                     </div>
                                </div>
                             </div>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>  Item Code </b> 
                                        <input type="text" class="form-control" name="edit_item_code" id="edit_item_code" value="" placeholder="Item Code">
                                     </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>  UOM </b> 
                                        <select name="edit_uom_id" id="edit_uom_id" rel="1" class="form-control inputcode">
                                            <?php 
                                                $sqlevents="SELECT * FROM tbl_uom WHERE uom_status='Enable' ORDER BY uom";
                                                $sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD)
                                                {
                                            ?>
                                                <option value="<?php echo $sqleventsD['uom_id'];?>"><?php echo $sqleventsD['uom'];?></option>
                                            <?php }?>
                                        </select>
                                     </div>
                                </div>
                              </div>
                              
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <b>  Status </b>
                                        <select name="item_sts" id="item_sts" class="form-control inputcode">
                                            <option value="Enable">Enable</option>
                                            <option value="Disable">Disable</option>
                                        </select>
                                     </div>
                                </div>
                             </div>
                        </div>
                <div class="modal-footer">
                	<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
$(document).ready(function() {


	$('#FormEdit').submit(function(e){
		e.preventDefault(); // Prevent Default Submission
		$.ajax({
		url: 'conf_add_items.php',
		type: 'POST',
		data: $(this).serialize(), // it will serialize the form data
			dataType: 'html'
		})
		.done(function(data){
			var resultArray 	= jQuery.parseJSON(data);
			var chkid=resultArray[0];
			var chkuname=resultArray[1];
				var oTable = $('#demo-foo-pagination').DataTable( );
				oTable.ajax.reload();// to reload
			
				 $("#EditMsg").html(chkuname);
			
	
		})
		.fail(function(){
		alert('Ajax Submit Failed ...');	
		});
	});

		

	
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		$('.js-switch').each(function() {
			new Switchery($(this)[0], $(this).data());
		});
	
	$(document).on("click",".btnEdit", function(){
		var item_id=$(this).attr('rel');
		var item_name=$(this).attr('relname');
		var item_code=$(this).attr('relcode');
		var uom_id=$(this).attr('reluom');
		var item_sts=$(this).attr('relsts');
		$("#myModalLabel").html("Edit "+item_name);
		$("#edit_item_name").val(item_name);
		$("#edit_item_code").val(item_code);
		$("#edit_uom_id").val(uom_id);
		$("#item_sts").val(item_sts);
		$("#item_id").val(item_id);
		//$( "#item_sts" ).prop( "checked", true );
		$("#EditMsg").html('');
		
		
	});
			
	$('#demo-foo-pagination').DataTable({
		'processing': false,
		'serverSide': true,
		'serverMethod': 'post',
		'ajax': {
			'url':'itemaddajax.php?chkp=<?php echo $_GET['chkp'];?>'
		},
		'columns': [
			{ data: 'item_code' },
			{ data: 'item_name' },
			{ data: 'uom' },
			{ data: 'Edit' },
		]
	});
 
	
	$(document).on("click",".delete",function(){
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
			
				$.ajax({
				url: 'conf_delete.php',
				type: 'POST',
				data: { uom_id:mid, cmdType:"deluomSinle"}, // it will serialize the form data
					dataType: 'html'
				})
				.done(function(data){
					 var resultArray = jQuery.parseJSON(data);
					 var msg=resultArray['msg'];
					 var uom=resultArray['uom'];
					 //alert(data);
					 if(msg==1)
					 {
					 	swal("congratulations!", "'"+uom+"' Removed Successfully.", "success"); 
						var oTable = $('#demo-foo-pagination').DataTable( );
						oTable.ajax.reload();// to reload
					 }
					 else
					 {
					 	swal("Oops!", "Error While removing '"+uom+"', Please try later.", "error"); 
					 }
				})
			
			//document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=deltax&mid="+mid;
		});
	}) ; 
});

//Warning Message



</script>