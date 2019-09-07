<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">List of Assignment</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    	<?php if($RoleArray['New']==1){?>
    	<a href="index_admin.php?chkp=385&m=127" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ADD ASSIGNMENT</a>
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
                        <th>Assignment Code</th>
                        <th>Assignment Name</th>
                        <th>Client</th>
                        <th>Picture</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th width="95">Extra</th>
                    </tr>
                </thead>    
            </table>
        </div>
    </div>
</div>
</form>
<!--.row-->

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:85% !important;">
    	<form action="conf_add_items.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" id="FormEdit" method="post" enctype="multipart/form-data">
            <input type="hidden" name="item_id" id="item_id" value="" />
            <input type="hidden" name="cmdType" id="cmdType" value="1" />
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">Print Preview</h4> </div>
                        <div class="modal-body" id="modal-body">
                             <div>
                             	<div class="row" id="loadPrint">
                                	
                                </div>
                             </div>
                              
                        </div>
                <!--<div class="modal-footer">
                	<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                </div>-->
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
$(document).ready(function() {
	
	//get_stock_print
	$(document).on("click", ".clsPrint", function(){
		var assignment_id=$(this).attr("rel");
		$.ajax({
		url: 'get_assignment_print.php',
		type: 'POST',
		data: { assignment_id:assignment_id}, // it will serialize the form data
			dataType: 'html'
		})
		.done(function(data){
			 $("#loadPrint").html(data);
		})
	});
	
	
	
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
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		'ajax': {
			'url':'assignmentaddajax.php?chkp=<?php echo $_GET['chkp'];?>'
		},
		'columns': [
			{ data: 'assignment_code' },
			{ data: 'assignment_name' },
			{ data: 'user_first_name' },
			{ data: 'assignment_picture' },
			{ data: 'assignment_status' },
			{ data: 'cdate' },
			{ data: 'Edit' },
		],
        "language":{
            "zeroRecords": "Nothing found - sorry"
        }
	});
 	
	$(document).on("click",".cannotEdit",function(){
		swal("Oops!", "You cannot edit this Assignment, Because it has Job Orders", "error"); 
	});
	
	$(document).on("click",".cannotDelete",function(){
		swal("Oops!", "You cannot delete this Assignment, Because it has Job Orders", "error"); 
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
				data: { assignment_id:mid, cmdType:"delassignmentSingle"}, // it will serialize the form data
					dataType: 'html'
				})
				.done(function(data){
					 var resultArray = jQuery.parseJSON(data);
					 var msg=resultArray['msg'];
					 var assignment=resultArray['assignment'];
					 
					 if(msg==1)
					 {
					 	swal("congratulations!", "'"+assignment+"' Removed Successfully.", "success"); 
						var oTable = $('#demo-foo-pagination').DataTable( );
						oTable.ajax.reload();// to reload
					 }
					 else
					 {
					 	swal("Oops!", "Error While removing '"+assignment+"', Please try later.", "error"); 
					 }
				})
			
			//document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=deltax&mid="+mid;
		});
	}) ; 
});

//Warning Message



</script>