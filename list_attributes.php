<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">List of Attributes</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    	<?php if($RoleArray['New']==1){?>
    	<a href="index_admin.php?chkp=396&m=131" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ADD ATTRIBUTES</a>
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
                        <th>Attribute</th>
                        <th width="100">Status</th>
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
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabel">Loading...</h4> </div>
                    <div class="modal-body" id="modal-body">
                    	<?php echo $GeneralFunctions->getStatus("royalty_status", $royalty_status);?>
                         <!--<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b><?php echo $in_party_B_name;?>: </b> <?php echo $sqlpartyBQ[0]['log_name'];?>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b>Client: </b> <?php echo $sqlcleintQ[0]['user_first_name'];?>
                                 </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b>Invoice #: </b> <?php echo $sqleventsD['invoice_no'];?>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b>Amount: </b> <?php echo $Form->numberFormat($sqleventsD['invoice_total']);?>
                                 </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b>Payment #: </b> <?php echo $sqleventsD['payment_number'];?>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b> Receive By : </b> <?php echo $sqleventsD['log_name'];?>
                                 </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b> Cheque Date : </b> <?php echo date($dateformat,strtotime($sqleventsD['cheque_date']));?>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b>  Bank name : </b> <?php echo $sqleventsD['bank_name'];?>
                                 </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b>  Cheque Number  : </b> <?php echo $sqleventsD['cheque_no'];?>
                                 </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b>   Amount  : </b> <?php echo $Form->numberFormat($sqleventsD['payment_amount']);?>
                                 </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <b>  Payment Creation Date  : </b> <?php echo $paymentcdate." ".$paymentctime;?>
                                 </div>
                            </div>
                         </div>-->
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
$(document).ready(function() {
	
	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		$('.js-switch').each(function() {
			new Switchery($(this)[0], $(this).data());
		});
	
	$(document).on("click",".btnEdit", function(){
		var attribute=$(this).attr('relname');
		var attribute_id=$(this).attr('rel');
		$("#myModalLabel").html("Edit "+attribute);
		$.ajax({
			url: 'get_edit_attribute.php',
			type: 'POST',
			data: { attribute_id:attribute_id, cmdType:"edit"}, // it will serialize the form data
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
			'url':'attributesajax.php?chkp=<?php echo $_GET['chkp'];?>'
		},
		'columns': [
			{ data: 'attribute' },
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
				data: { attribute_id:mid, cmdType:"delattributeSinle"}, // it will serialize the form data
					dataType: 'html'
				})
				.done(function(data){
					 var resultArray = jQuery.parseJSON(data);
					 var msg=resultArray['msg'];
					 var attribute=resultArray['attribute'];
					 //alert(data);
					 if(msg==1)
					 {
					 	swal("congratulations!", "'"+attribute+"' Removed Successfully.", "success"); 
						var oTable = $('#demo-foo-pagination').DataTable( );
						oTable.ajax.reload();// to reload
					 }
					 else
					 {
					 	swal("Oops!", "Error While removing '"+attribute+"', Please try later.", "error"); 
					 }
				})
			
			//document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=deltax&mid="+mid;
		});
	}) ; 
});

//Warning Message



</script>