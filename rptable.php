<?php

if (isset($_POST['formfilter'])) {
    /*$fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];*/
    $fromdate = date("Y-m-d", strtotime($_POST['fromdate']));
    $todate = date("Y-m-d", strtotime($_POST['todate']));
    $fromdateC = $_POST['fromdate'];
    $todateC = $_POST['todate'];


    $client_id = $_POST['client_id'];
    $partyb_id = $session_login_id;
    if ($partyb_id != "") {
        $partyBsql = ' AND partyb_id=' . $partyb_id . '';
        $voucherpartyBsql = ' AND tbl_voucher.partyb_id=' . $partyb_id . '';
        $paymentpartyBsql = ' AND tbl_receive_payment.partyb_id=' . $partyb_id . '';
    }

    if ($client_id != "") {
        $Clientsql = '  AND client_id=' . $client_id . '';
        $voucherClientsql = ' AND tbl_voucher.client_id=' . $client_id . '';
        $paymentClientsql = ' AND tbl_receive_payment.client_id=' . $client_id . '';
    }
} else {
    $partyb_id = $session_login_id;
    if ($partyb_id != "") {
        $partyBsql = ' AND partyb_id=' . $partyb_id . '';
        $voucherpartyBsql = ' AND tbl_voucher.partyb_id=' . $partyb_id . '';
        $paymentpartyBsql = ' AND tbl_receive_payment.partyb_id=' . $partyb_id . '';
    }
    /*$fromdate=date("m/01/Y");
    $todate=date("m/d/Y");*/
    $fromdate = date("Y-01-01");//$fromdate=date("Y-m-01"); $fromdate=date("Y-m-d",strtotime("-1 year"));
    $todate = date("Y-m-d");
    $fromdateC = date("01/01/Y");
    $todateC = date("m/d/Y");
}
?>
<form method="post">
    <input type="hidden" name="formfilter" value="1"/>
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="example">
                            <h5 class="box-title">From Date</h5>
                            <input type="text" class="form-control datepicker-autoclose" name="fromdate"
                                   placeholder="mm/dd/yyyy"/></div>
                    </div>
                    <div class="col-lg-2">
                        <div class="example">
                            <h5 class="box-title">To Date</h5>
                            <input type="text" class="form-control datepicker-autoclose" name="todate"
                                   placeholder="mm/dd/yyyy"/></div>
                    </div>
                    <div class="col-lg-2">
                        <div class="example">
                            <h5 class="box-title">Job order Name</h5>
                            <input type="text" class="form-control" onkeyup="myFunction()"  id="joborder_name" name="joborder_name" placeholder="Joborder Name" value="<?php if(isset($_POST['joborder_name'])) echo $_POST['joborder_name'];?>"/>
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="example">
                            <h5 class="box-title">Clients</h5>
                            <select class="form-control select2" name="client_id" id="client_id">
                                <option value="" disabled selected>Select Clients</option>
                                <?php
                                $sqlpartyb = "SELECT * FROM `tbl_users`,tbl_joborder WHERE tbl_users.log_id=tbl_joborder.client_id GROUP BY tbl_users.log_id";
                               
                                
                                $sqlpartybQ = $db->record_select($sqlpartyb);
                                foreach ($sqlpartybQ as $sqlpartybD) {
                                    $sql_client[] = $sqlpartybD['user_first_name'];
                                    ?>

                                    <option value="<?php echo $sqlpartybD['log_id']; ?>" <?php if ($client_id == $sqlpartybD['log_id']) echo 'selected'; ?>><?php echo $sqlpartybD['user_first_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="example">
                            <h5 class="box-title">&nbsp;</h5>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" name="filter">
                                Filter Results
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="example">
                            <h5 class="box-title">&nbsp;</h5>
                            <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="conf_pay_client.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" method="post">
<div class="row">
	<div class="col-lg-12">
                        <div class="white-box  printableArea">
                            <style>
								#demo-foo-paginatio tfoot tr td{ border:0px; padding:0px;}
								#demo-foo-paginatio tbody tr td{  padding:8px 12px;}
								.clsheading{ background-color:#FFFF00; color:#FF0000; padding:7px 11px;}
							</style>
                            <table id="demo-foo-paginatio" align="center" class="table m-b-0 toggle-arrow-tiny" data-filter="#filter" data-filter-minimum="2" >
                                <thead>
                                	<tr>
                                    	<th colspan="4"><b class="clsheading">SST Report</b></th>
                                        <th colspan="3" align="right" style="text-align:right;"><b>From Date:</b> <?php echo $printDateFrom;?> &nbsp; &nbsp; &nbsp; <b>To Date:</b> <?php echo $printDateTo;?></th>
                                    </tr>

                                    <tr>
                                    	<th>Job Order No</th>
                                        <th>Job Order Name</th>
                                        <th>Job Order Status</th>
                                        <th>Assign Date</th>
                                        <th colspan="2">Complete Date</th>
                                        <th>Attribute Price Total</th>
                                        
                                    </tr>
                                </thead>
                            




<div class="row">
    <?php
    ob_start();
    $sqljoborders = "SELECT * FROM tbl_joborder, tbl_assignment, tbl_users as tclient, tbl_users as tsuervisor,`tbl_joborder_size_attribute` WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.client_id=tclient.log_id AND tbl_joborder.supervisor_id=tsuervisor.log_id GROUP BY tbl_joborder.joborder_no";

  /* echo $sqljoborders;*/
    $sqljobordersQf = $db->record_select($sqljoborders);
 /* exit();*/
        
        foreach ($sqljobordersQf as $sqljobordersid) {
        	# code...
        
        ?>
        <!--job details-->
        
        <tbody>

        <tr>
                                    	<td><?php echo $sqljobordersid['joborder_no'];?></td>
                                        <td><?php echo $sqljobordersid['joborder_name'];?></td>
                                        <td><?php echo $sqljobordersid['is_complete'];?></td>
                                        <td> <i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($sqljobordersid['joborder_assign_date']))?></td>
                                        <td colspan="2"><i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($sqljobordersid['joborder_complete_date']))?> </td>
                                        <td><?php echo $sqljobordersid['attribute_price_total'];?></td>
                                    </tr>
                                   
                                </tbody>
                                <tfoot>
                                
                                </tfoot>
                        
    <?php   }
      $data = ob_get_clean();
    if (!isset($_POST['filter'])) {
        echo $data;
    }
    ?>


</div>

<!--.row-->

<script>

    //get_stock_print
    $(document).ready(function () {
        $(document).on("click", ".clsDetail", function () {
            var joborder_id = $(this).attr("rel");
            $.ajax({
                url: 'get_joborder_print.php',
                type: 'POST',
                data: {joborder_id: joborder_id, vType: 'D'}, // it will serialize the form data
                dataType: 'html'
            })
                .done(function (data) {
                    $("#loadPrint").html(data);
                })

        });

        jQuery('.datepicker-autoclose').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            todayHighlight: true
        });


        $(document).on("click", ".clsProcess", function () {
            var joborder_id = $(this).attr("rel");
            $.ajax({
                url: 'get_joborder_process.php',
                type: 'POST',
                data: {joborder_id: joborder_id}, // it will serialize the form data
                dataType: 'html'
            })
                .done(function (data) {
                    $("#loadPrint-process").html(data);
                    $(".select2").select2();
                })
        });

        $(document).on("click", ".clsStock", function () {
            var joborder_id = $(this).attr("rel");
            $.ajax({
                url: 'get_joborder_stock.php',
                type: 'POST',
                data: {joborder_id: joborder_id}, // it will serialize the form data
                dataType: 'html'
            })
                .done(function (data) {
                    $("#loadPrint-stock").html(data);
                    $(".select2").select2();
                })
        });


        $('#FormProcess').submit(function (e) {
            e.preventDefault(); // Prevent Default Submission
            $.ajax({
                url: 'conf_job_order_process.php',
                type: 'POST',
                data: $(this).serialize(), // it will serialize the form data
                dataType: 'html'
            })
                .done(function (data) {
                    //alert(data);
                    var resultArray = jQuery.parseJSON(data);
                    var chkid = resultArray['msg'];
                    var chkuname = resultArray['msghtml'];

                    if (chkid == 1) {
                        //$("#DivMsgUpdate").html("<div class='alert alert-success alert-dismissable'><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>�</button> Record updated successfully </div>");

                        $.toast({
                            heading: 'Congractulations',
                            text: 'Record updated successfully',
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500,
                            stack: 6
                        });
                    }

                })
                .fail(function () {
                    alert('Ajax Submit Failed ...');
                });
        });

        $(document).on("click", ".clsfinish", function () {
            var joborder_id = $(this).attr("rel");
            $.ajax({
                url: 'conf_job_order_process.php',
                type: 'POST',
                data: {joborder_id: joborder_id, ctype: 'finish'}, // it will serialize the form data
                dataType: 'html'
            })
                .done(function (data) {
                    var resultArray = jQuery.parseJSON(data);
                    var chkid = resultArray['msg'];
                    var chkuname = resultArray['msghtml'];
                    if (chkid == 1) {
                        $.ajax({
                            url: 'get_joborder_process.php',
                            type: 'POST',
                            data: {joborder_id: joborder_id}, // it will serialize the form data
                            dataType: 'html'
                        })
                            .done(function (data) {
                                $("#loadPrint-process").html(data);
                                $(".select2").select2();
                            })
                    } else {
                        $.toast({
                            heading: 'Oops!',
                            text: 'There is some error please contact admin.',
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3500,
                            stack: 6
                        });
                    }
                })
        });

        $(document).on("keyup", ".clsdamage", function () {
            var i = $(this).attr("rel");
            var assignment_size_id = $(this).attr("arel");
            var thisrecTemp = "#receive" + assignment_size_id + "" + i;
            var thisdamTemp = "#damage" + assignment_size_id + "" + i;
            var thiscomTemp = "#complete" + assignment_size_id + "" + i;
            var thisspTemp = "#singleprice" + assignment_size_id + "" + i;
            var thistpTemp = "#totalprice" + assignment_size_id + "" + i;
            var thisdam = "";
            var thisrec = "";
            var thissp = "";
            var thisComplete = 0;
            var thisTotalCost = 0;

            thisspTemp = parseInt($(thisspTemp).val());
            if (!(isNaN(thisspTemp)))
                thissp = thisspTemp;
            else
                thissp = 0;


            thisrecTemp = parseInt($(thisrecTemp).val());
            if (!(isNaN(thisrecTemp)))
                thisrec = thisrecTemp;
            else
                thisrec = 0;

            thisdamTemp = parseInt($(thisdamTemp).val());
            if (!(isNaN(thisdamTemp)))
                thisdam = thisdamTemp;
            else
                thisdam = 0;

            thisComplete = thisrec - thisdam;
            $(thiscomTemp).val(thisComplete);
            thisTotalCost = thisComplete * thissp;
            $(thistpTemp).val(thisTotalCost);

        });


        $('[data-tooltip="tooltip"]').tooltip();

    });
</script>

<?php 
ob_start();
?>
<div class="row">
	<div class="col-lg-12">
                        <div class="white-box  printableArea">

        
          <strong>  <h1 style="color: #2cabe3;text-align: center;" >Data Not Found</h1></strong>
        </div></div></div>
<?php
$error=ob_get_clean();
?>
<?php

if (isset($_POST['filter'])) {
    $status = $_POST['status'];
    $client_id = $_POST['client_id'];
    $joborder_name = $_POST['joborder_name'];
    $joborder_name_small = $joborder_name . strtolower();
 $fromdate = $_POST['fromdate'];
    $fromdate = str_replace('/', '-', $fromdate);
   $fromDatenew = date("Y-m-d", strtotime($fromdate));
   $toDate=$_POST['todate'];
    $toDate = str_replace('/', '-', $toDate);
    $toDatenew = date("Y-m-d", strtotime($toDate));

    $sqljoborders = "SELECT * FROM tbl_joborder, tbl_assignment, tbl_users as tclient, tbl_users as tsuervisor,`tbl_joborder_size_attribute` WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.client_id=tclient.log_id AND tbl_joborder.supervisor_id=tsuervisor.log_id";
 
    if ($client_id != '') {
        $sqljoborders .= " AND tbl_joborder.client_id=$client_id GROUP BY tbl_joborder.joborder_no";
    }
    if ($joborder_name != '') {
        $sqljoborders .= " AND (tbl_joborder.joborder_name LIKE '%$joborder_name%' OR tbl_joborder.joborder_name LIKE '%$joborder_name_small%') GROUP BY tbl_joborder.joborder_no";
    }
    if($fromdate != '')
    {
        $sqljoborders .= " AND `tbl_joborder`.`joborder_assign_date` >='$fromDatenew%' GROUP BY tbl_joborder.joborder_no";
    }
    if ($fromdate != '' && $toDate !='') {
        $sqljoborders .= " AND `tbl_joborder`.`joborder_assign_date` >='$fromDatenew%' AND `tbl_joborder`.`joborder_assign_date` <= '$toDatenew%' GROUP BY tbl_joborder.joborder_no";
    }

   /* echo($sqljoborders);
    exit();*/
 $sqljobordersQf = $db->record_select($sqljoborders);


    foreach ($sqljobordersQf as $sqljobordersid) {
        
        ?>
        <!--job details--> <tbody>
        	<tr>
                                    	<td><?php echo $sqljobordersid['joborder_no'];?></td>
                                        <td><?php echo $sqljobordersid['joborder_name'];?></td>
                                        <td><?php echo $sqljobordersid['is_complete'];?></td>
                                        <td> <i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($sqljobordersid['joborder_assign_date']))?></td>
                                        <td colspan="2"><i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($sqljobordersid['joborder_complete_date']))?> </td>
                                        <td><?php echo $sqljobordersid['attribute_price_total'];?></td>
                                    </tr>
                                   
                                </tbody>
                                <tfoot>
                                
                                </tfoot>
                            
                            
    <?php }
} ?>
</table>
<?php 
 if($sqljobordersQf==''){
    // echo "<script type='text/javascript'>alert('Data Not found');</script>";
     echo $error;
     exit();
   }
?>

</form>





