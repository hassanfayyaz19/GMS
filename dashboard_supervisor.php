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
<!-- /.row -->
<!-- ============================================================== -->
<!-- Different data widgets -->
<!-- ============================================================== -->
<!--<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row row-in">
            asd
            </div>
        </div>
    </div>
</div>  -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:85% !important;">
        <form action="conf_add_items.php?chkp=<?php echo $_GET['chkp']; ?>&m=<?php echo $_GET['m']; ?>" id="FormEdit"
              method="post" enctype="multipart/form-data">
            <input type="hidden" name="item_id" id="item_id" value=""/>
            <input type="hidden" name="cmdType" id="cmdType" value="1"/>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">Order Detail</h4></div>
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

<form method="post" id="FormProcess" name="frmjobprocess" action="#"><!-- action="conf_job_order_process.php"-->
    <div id="myModalprocess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelprocess"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width:65% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabelP">Order Processing</h4></div>
                <div class="modal-body" id="modal-body-process">
                    <div>
                        <div class="row" id="loadPrint-process">

                        </div>
                    </div>

                </div>
                <!--<div class="modal-footer">
                	<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                </div>-->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

<form method="post" id="FormProcess" name="frmjobprocess" action="#"><!-- action="conf_job_order_process.php"-->
    <div id="myModalstock" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabelprocess"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width:75% !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabelS">Issued Stock</h4></div>
                <div class="modal-body" id="modal-body-process">
                    <div>
                        <div class="row" id="loadPrint-stock">

                        </div>
                    </div>

                </div>
                <!--<div class="modal-footer">
                	<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                </div>-->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>

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
                            <input type="text" class="form-control" name="joborder_name" placeholder="Joborder Name" value="<?php if(isset($_POST['joborder_name'])) echo $_POST['joborder_name'];?>"/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="example">
                            <h5 class="box-title">Status</h5>
                            <select class="form-control" name="status" id="status" value="" >
                                <option disabled selected value="<?php if(isset($_POST['status'])) echo $_POST['status'];?>">Select Status</option>
                                <option value="1">Completed</option>
                                <option value="0">Pending</option>
                            </select></div>
                    </div>
                    <div class="col-lg-2">
                        <div class="example">
                            <h5 class="box-title">Clients</h5>
                            <select class="form-control select2" name="client_id" id="client_id">
                                <option value="" disabled selected>Select Clients</option>
                                <?php
                                $sqlpartyb = "SELECT * FROM `tbl_users`,tbl_joborder WHERE tbl_users.log_id=tbl_joborder.client_id AND tbl_joborder.supervisor_id=$session_login_id";
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
                </div>
            </div>
        </div>
    </div>
</form>


<!--row -->
<div class="row">
    <?php
    ob_start();
    $sqljoborders = "SELECT tbl_joborder.joborder_id, tbl_joborder.joborder_no, tbl_joborder.joborder_complete_date, tbl_joborder.joborder_name, tbl_assignment.assignment_name, tbl_joborder.joborder_status, tclient.user_first_name as client_name, tsuervisor.user_first_name as supervisor_name,tbl_assignment.assignment_picture FROM tbl_joborder, tbl_assignment, tbl_users as tclient, tbl_users as tsuervisor WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.client_id=tclient.log_id AND tbl_joborder.supervisor_id=tsuervisor.log_id AND tbl_joborder.supervisor_id=$session_login_id";
    $sqljobordersQ = $db->record_select($sqljoborders);
    foreach ($sqljobordersQ as $sqljobordersD) {
        if ($sqljobordersD['assignment_picture'] != "") {
            $stockimg = "<img src='plugins/images/assignment/" . $sqljobordersD['assignment_picture'] . "' width='100%' height='75' />";
        } else {
            $stockimg = "<img src='plugins/images/default.jpg' width='100%' />";
        }
        ?>
        <!--job details-->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="panel panel-default"><!-- style="background-color:#ffdfd7;"-->
                <div class="panel-heading"> <?php echo $sqljobordersD['joborder_name']; ?> </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="tab-content m-t-0">
                            <div role="tabpanel" class="tab-pane fade active in" id="home1">
                                <div class="col-md-5">
                                    <?php echo $stockimg; ?>
                                </div>
                                <div class="col-md-7 pull-right" style="padding:0px;">
                                    <b>Order Code:</b> <?php echo $sqljobordersD['joborder_no']; ?><br/>
                                    <b>Complete
                                        Date:</b> <?php echo date($dateformat, strtotime($sqljobordersD['joborder_complete_date'])); ?>
                                    <br/>
                                    <div class="col-lg-4 clsDetail" style="padding:2px; margin-top:5px;"
                                         data-toggle="modal" data-target="#myModal"
                                         rel="<?php echo $sqljobordersD['joborder_id']; ?>">
                                        <button class="btn btn-block btn-primary" data-original-title="Order Detail"
                                                title="" data-placement="top" data-toggle="tooltip"
                                                style="padding:2px 2px !important;">Detail
                                        </button>
                                    </div>
                                    <div class="col-lg-4 clsProcess" style="padding:2px; margin-top:5px;"
                                         data-toggle="modal" data-target="#myModalprocess"
                                         rel="<?php echo $sqljobordersD['joborder_id']; ?>">
                                        <button class="btn btn-block btn-info" data-original-title="Order Processing"
                                                title="" data-placement="top" data-toggle="tooltip"
                                                style="padding:2px 2px !important;">Process
                                        </button>
                                    </div>
                                    <div class="col-lg-4 clsStock" style="padding:2px; margin-top:5px;"
                                         data-toggle="modal" data-target="#myModalstock"
                                         rel="<?php echo $sqljobordersD['joborder_id']; ?>">
                                        <button class="btn btn-block btn-success" data-original-title="Issued Stock"
                                                title="" data-placement="top" data-toggle="tooltip"
                                                style="padding:2px 2px !important;">Stock
                                        </button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    $data = ob_get_clean();
    if (!isset($_POST['filter'])) {
        echo $data;
    }
    ?>

</div>

<!-- /.row -->

<!-- ============================================================== -->
<!-- end right sidebar -->
<!-- ============================================================== -->
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

    })
</script>

<!-- <script src="js/dashboard1.js"></script> -->

<?php
ob_start();
?>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
          <strong>  <h1 style="color: #2cabe3;text-align: center;" >Data Not Found</h1></strong>
        </div>
    </div>
</div>
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

    $sqljoborders = "SELECT tbl_joborder.joborder_id, tbl_joborder.joborder_no, tbl_joborder.joborder_complete_date,
 tbl_joborder.joborder_name, tbl_assignment.assignment_name, tbl_joborder.joborder_status, tclient.user_first_name as client_name,
 tsuervisor.user_first_name as supervisor_name,tbl_assignment.assignment_picture 
 FROM tbl_joborder, tbl_assignment, tbl_users as tclient, tbl_users as tsuervisor 
 WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id 
 AND tbl_joborder.client_id=tclient.log_id AND tbl_joborder.supervisor_id=tsuervisor.log_id 
 AND tbl_joborder.supervisor_id=$session_login_id";
    if ($status != '') {
        $sqljoborders .= " AND tbl_joborder.is_complete=$status";
    }
    if ($client_id != '') {
        $sqljoborders .= " AND tbl_joborder.client_id=$client_id";
    }
    if ($joborder_name != '') {
        $sqljoborders .= " AND (tbl_joborder.joborder_name LIKE '$joborder_name%' OR tbl_joborder.joborder_name LIKE '$joborder_name_small%')";
    }
    if($fromdate != '')
    {
        $sqljoborders .= " AND `tbl_joborder`.`joborder_assign_date` >='$fromDatenew'";
    }
    if ($fromdate != '' && $toDate !='') {
        $sqljoborders .= " AND `tbl_joborder`.`joborder_assign_date` >='$fromDatenew' AND `tbl_joborder`.`joborder_assign_date` <= '$toDatenew'";
    }

   /* echo($sqljoborders);
    exit();*/
 $sqljobordersQ = $db->record_select($sqljoborders);
 if($sqljobordersQ==''){
    // echo "<script type='text/javascript'>alert('Data Not found');</script>";
     echo $error;
     exit();
   }

    foreach ($sqljobordersQ as $sqljobordersD) {
        if ($sqljobordersD['assignment_picture'] != "") {
            $stockimg = "<img src='plugins/images/assignment/" . $sqljobordersD['assignment_picture'] . "' width='100%' height='75' />";
        } else {
            $stockimg = "<img src='plugins/images/default.jpg' width='100%' />";
        }
        ?>
        <!--job details-->
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="panel panel-default"><!-- style="background-color:#ffdfd7;"-->
                <div class="panel-heading"> <?php echo $sqljobordersD['joborder_name']; ?> </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="tab-content m-t-0">
                            <div role="tabpanel" class="tab-pane fade active in" id="home1">
                                <div class="col-md-5">
                                    <?php echo $stockimg; ?>
                                </div>
                                <div class="col-md-7 pull-right" style="padding:0px;">
                                    <b>Order Code:</b> <?php echo $sqljobordersD['joborder_no']; ?><br/>
                                    <b>Complete
                                        Date:</b> <?php echo date($dateformat, strtotime($sqljobordersD['joborder_complete_date'])); ?>
                                    <br/>
                                    <div class="col-lg-4 clsDetail" style="padding:2px; margin-top:5px;"
                                         data-toggle="modal" data-target="#myModal"
                                         rel="<?php echo $sqljobordersD['joborder_id']; ?>">
                                        <button class="btn btn-block btn-primary" data-original-title="Order Detail"
                                                title="" data-placement="top" data-toggle="tooltip"
                                                style="padding:2px 2px !important;">Detail
                                        </button>
                                    </div>
                                    <div class="col-lg-4 clsProcess" style="padding:2px; margin-top:5px;"
                                         data-toggle="modal" data-target="#myModalprocess"
                                         rel="<?php echo $sqljobordersD['joborder_id']; ?>">
                                        <button class="btn btn-block btn-info" data-original-title="Order Processing"
                                                title="" data-placement="top" data-toggle="tooltip"
                                                style="padding:2px 2px !important;">Process
                                        </button>
                                    </div>
                                    <div class="col-lg-4 clsStock" style="padding:2px; margin-top:5px;"
                                         data-toggle="modal" data-target="#myModalstock"
                                         rel="<?php echo $sqljobordersD['joborder_id']; ?>">
                                        <button class="btn btn-block btn-success" data-original-title="Issued Stock"
                                                title="" data-placement="top" data-toggle="tooltip"
                                                style="padding:2px 2px !important;">Stock
                                        </button>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>

