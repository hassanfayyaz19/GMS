<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">List of Job Orders</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    	<?php if($RoleArray['New']==1){?>
    	<a href="index_admin.php?chkp=390&m=128" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ADD JOB ORDER</a>
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
                        <th>Job Code</th>
                        <th>Job Name</th>
                        <th>Client</th>
                        <th>Assignment</th>
                        <th>Supervisor</th>
                        <th width="100">Status</th>
                        <th width="130">Extra</th>
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
		var joborder_id=$(this).attr("rel");
		$.ajax({
		url: 'get_joborder_print.php',
		type: 'POST',
		data: { joborder_id:joborder_id, vType:'P'}, // it will serialize the form data
			dataType: 'html'
		})
		.done(function(data){
			 $("#loadPrint").html(data);
		})
	});

	$('[data-tooltip="tooltip"]').tooltip();

	
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		$('.js-switch').each(function() {
			new Switchery($(this)[0], $(this).data());
		});
	
	$(document).on("click",".btnEdit", function(){
		var location=$(this).attr('relname');
		var location_id=$(this).attr('rel');
		$("#myModalLabel").html("Edit "+location);
		$.ajax({
			url: 'get_edit_location.php',
			type: 'POST',
			data: { location_id:location_id, cmdType:"edit"}, // it will serialize the form data
				dataType: 'html'
			})
			.done(function(data){
				$("#modal-body").html(data);
			})
		
	});
			
	$('#demo-foo-pagination').DataTable({
		'processing': false,
		'serverSide': true,
		'serverMethod': 'post',
		'ajax': {
			'url':'joborderaddajax.php?chkp=<?php echo $_GET['chkp'];?>'
		},
		'columns': [
			{ data: 'joborder_no' },
			{ data: 'joborder_name' },
			{ data: 'client' },
			{ data: 'assignment' },
			{ data: 'supervisor' },
			{ data: 'status' },
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
				data: { joborder_id:mid, cmdType:"deljoborderSingle"}, // it will serialize the form data
					dataType: 'html'
				})
				.done(function(data){
					 var resultArray = jQuery.parseJSON(data);
					 var msg=resultArray['msg'];
					 var joborder_name=resultArray['joborder_name'];
					 //alert(data);
					 if(msg==1)
					 {
					 	swal("congratulations!", "'"+joborder_name+"' Removed Successfully.", "success"); 
						var oTable = $('#demo-foo-pagination').DataTable( );
						oTable.ajax.reload();// to reload
					 }
					 else
					 {
					 	swal("Oops!", "Error While removing '"+joborder_name+"', Please try later.", "error"); 
					 }
				})
			
			//document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=deltax&mid="+mid;
		});
	}) ; 
});

//Warning Message



</script>