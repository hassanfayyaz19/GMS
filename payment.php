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
                    <!-- <div class="col-lg-2">
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
                    </div> -->
                    <div class="col-lg-2">
                        <div class="example">
                            <h5 class="box-title">JobOrder</h5>
                            <input type="text" class="form-control" id="joborder_name"
                                   name="joborder_name" placeholder="Joborder Name"
                                   value="<?php if (isset($_POST['joborder_name'])) echo $_POST['joborder_name']; ?>"/>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="example">
                            <h5 class="box-title">Attribute User</h5>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="attribute_user"
                                    id="attribute_user" data-placeholder="Choose">
                                <?php
                                $sqlpartyb = "SELECT * FROM tbllogin,tbl_users WHERE `tbllogin`.`log_id`=tbl_users.log_id AND tbllogin.typ_id=5 GROUP BY tbllogin.log_id";
                                $sqlpartybQ = $db->record_select($sqlpartyb);
                                foreach ($sqlpartybQ as $sqlpartybD) {
                                    ?>
                                    <!-- <option value="<?php /*echo $sqlpartybD['log_id'];*/
                                    ?>"><?php /*echo $sqlpartybD['log_name'];*/
                                    ?></option>-->
                                    <option value="<?php echo $sqlpartybD['log_id']; ?>"><?php echo $sqlpartybD['log_name']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="example">
                            <h5 class="box-title">Status</h5>
                            <select class="form-control" name="status" id="status">
                                <option disabled selected value="">Select Status</option>
                                <option value="1">Completed</option>
                                <option value="0">Pending</option>
                            </select></div>
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
                            <button id="print" class="btn btn-default btn-outline" type="button"><span><i
                                            class="fa fa-print"></i> Print</span></button>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="example">
                            <h5 class="box-title">&nbsp;</h5>
                            <button id="print" class="btn btn-success" type="button" onclick="insertSelected()">Pay
                                Selected
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-lg-12">
        <div class="white-box  printableArea">
            <style>
                #demo-foo-paginatio tfoot tr td {
                    border: 0px;
                    padding: 0px;
                }

                #demo-foo-paginatio tbody tr td {
                    padding: 8px 12px;
                }


            </style>
            <table id="demo-foo-paginatio" align="center" class="table m-b-0 toggle-arrow-tiny"
                   data-filter="#filter" data-filter-minimum="2">
                <thead>

                <tr>
                    <th>#<input type="checkbox" id="checkAll"></th>
                    <th>Date</th>
                    <th>Job No#</th>
                    <th>Job Order</th>
                    <th>Unit</th>
                    <th>Damage</th>
                    <th>Deduction</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <div class="row">
                    <?php
                    ob_start();
                    $sqljoborders = "SELECT * FROM tbl_joborder,`tbl_joborder_size_attribute`,tbl_users 
WHERE tbl_users.log_id=tbl_joborder_size_attribute.staff_id 
GROUP BY tbl_joborder.joborder_id";

                    /* echo $sqljoborders;*/
                    $sqljobordersQf = $db->record_select($sqljoborders);
                    /* exit();*/

                    foreach ($sqljobordersQf as $sqljobordersid) {
                        # code...
                        $a = $sqljobordersid['joborder_no'];
                        $joborder_n = $sqljobordersid['joborder_name'];
                        $complete = $sqljobordersid['complete'];
                        $tot_prize = $sqljobordersid['attribute_price_total'];
                        $unitPrize = $tot_prize / $complete;
                        $demage = $sqljobordersid['damage'];
                        $deducted_prize = $unitPrize * $demage;

                        ?>
                        <!--job details-->

                        <tbody>

                        <tr>
                            <td><input type="checkbox" class="aaaaaa" id="<?php echo $sqljobordersid['joborder_no']; ?>"
                                       name="idArr[]"
                                       value="<?php echo $sqljobordersid['joborder_no']; ?>"
                                       title="<?php echo $sqljobordersid['joborder_no'];; ?>"></td>

                            <td id="date">
                                <i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($sqljobordersid['joborder_assign_date'])) ?>
                            </td>
                            <td id="joborder_id"><?php echo $sqljobordersid['joborder_no']; ?></td>
                            <td id="joborder_name" class="joborder_name"
                                jorder="<?php echo $joborder_n; ?>"><?php echo $joborder_n; ?></td>
                            <td id="complete"><?php echo $sqljobordersid['complete']; ?></td>
                            <td id="damage"><?php echo $sqljobordersid['damage']; ?></td>
                            <td><input class="clschk" type="checkbox" deduct="<?php echo $deducted_prize; ?>"
                                       id="deduction" data-toggle="modal"
                                       data-target="#myModal"><?php echo $deducted_prize ?></td>
                            <td id="price"><?php echo $tot_prize ?></td>
                            <!--<td><input class="btn btn-success" type="submit" name="payment_submit" title="<?php /*echo $sqljobordersid['joborder_no'];  */ ?>"  id="payment_submit"></td>-->
                            <td>
                                <button class="btn btn-success" id="payment_submit"
                                        onclick="payment_submit('<?php echo $a; ?>')" title="<?php echo $a; ?>">Submit
                                </button>
                            </td>
                        </tr>

                        </tbody>
                        <tfoot>

                        </tfoot>


                    <?php }
                    $data = ob_get_clean();
                    if (!isset($_POST['filter'])) {
                        echo $data;
                    }
                    ?>


                </div>
                <script>

                    var joborder_name;
                    $(document).on('click', '.joborder_name', function () {
                         joborder_name = $(this).attr('jorder');

                    });


                    $(document).on('click', '.clschk', function () {

                        $(document).on('click', '.joborder_name', function ();
                        /*$(document).on('click','.joborder_name',function () {
                            var joborder_name = $(this).attr('jorder');
                            alert(joborder_name);
                        });*/
                        /*var joborder_name = $('#joborder_name').text();
                        alert(joborder_name);*/
                        alert(joborder_name);
                        var deduct = $(this).attr('deduct');
                        $('#deduct').html(deduct);

                    });
                </script>
                <div class="modal fade md" id="myModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">Are You Sure?</div>
                            <div class="modal-body">

                                <p>Detected Prize : <span id="deduct"></span></p>
                                <p>Total Prize : <?php echo $tot_prize; ?></p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
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


                            <strong><h1 style="color: #2cabe3;text-align: center;">Data Not Found</h1></strong>
                        </div>
                    </div>
                </div>
                <?php
                $error = ob_get_clean();
                ?>
                <?php

                if (isset($_POST['filter'])) {
                    $status = $_POST['status'];

                    $joborder_name = $_POST['joborder_name'];
                    $joborder_name_small = $joborder_name . strtolower();
                    $attribute_user = $_POST['attribute_user'];
                    $fromdate = $_POST['fromdate'];
                    $fromdate = str_replace('/', '-', $fromdate);
                    $fromDatenew = date("Y-m-d", strtotime($fromdate));
                    $toDate = $_POST['todate'];
                    $toDate = str_replace('/', '-', $toDate);
                    $toDatenew = date("Y-m-d", strtotime($toDate));


                    $sqljoborders = "SELECT * FROM tbl_joborder,`tbl_joborder_size_attribute`,tbl_users 
WHERE tbl_users.log_id=tbl_joborder_size_attribute.staff_id";

                    if ($status != '') {
                        $sqljoborders .= " AND tbl_joborder.is_complete=$status GROUP BY tbl_joborder.joborder_id";
                    }
                    if ($joborder_name != '') {
                        $sqljoborders .= " AND (tbl_joborder.joborder_name LIKE '%$joborder_name%' OR tbl_joborder.joborder_name LIKE '%$joborder_name_small%') GROUP BY tbl_joborder.joborder_id";
                    }
                    if ($attribute_user != '') {
                        $sqljoborders .= " AND (`tbl_joborder_size_attribute`.`staff_id` LIKE '$attribute_user') GROUP BY tbl_joborder.joborder_id";
                    }
                    /*  if ($fromdate != '') {
                          $sqljoborders .= " AND `tbl_joborder`.`joborder_assign_date` >='$fromDatenew%' GROUP BY tbl_joborder.joborder_no";
                      }
                      if ($fromdate != '' && $toDate != '') {
                          $sqljoborders .= " AND `tbl_joborder`.`joborder_assign_date` >='$fromDatenew%' AND `tbl_joborder`.`joborder_assign_date` <= '$toDatenew%' GROUP BY tbl_joborder.joborder_no";
                      }*/

                    /*echo($sqljoborders);
                    exit();*/

                    $sqljobordersQf = $db->record_select($sqljoborders);

                    foreach ($sqljobordersQf as $sqljobordersid) {

                        ?>
                        <!--job details-->
                        <tbody>
                        <tr>
                            <td><input type="checkbox" title="<?php echo $sqljobordersid['joborder_no']; ?>"></td>

                            <td id="date">
                                <i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($sqljobordersid['joborder_assign_date'])) ?>
                            </td>
                            <td id="joborder_id"><?php echo $sqljobordersid['joborder_no']; ?></td>
                            <td id="joborder_name"><?php echo $sqljobordersid['joborder_name']; ?></td>
                            <td id="complete"><?php echo $sqljobordersid['complete']; ?></td>
                            <td id="damage"><?php echo $sqljobordersid['damage']; ?></td>
                            <td><input type="checkbox" id="deduction" data-toggle="modal" data-target="#myModal"></td>
                            <td id="price"><?php echo $sqljobordersid['attribute_price_total']; ?></td>
                            <!--<td><input class="btn btn-success" type="submit" name="payment_submit" title="<?php /*echo $sqljobordersid['joborder_no'];  */ ?>"  id="payment_submit"></td>-->
                            <td>
                                <button class="btn btn-success" id="payment_submit"
                                        onclick="payment_submit('<?php echo $a; ?>')" title="<?php echo $a; ?>">Submit
                                </button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>

                        </tfoot>


                    <?php }
                } ?>
            </table>
            <?php
            if ($sqljobordersQf == '') {
                // echo "<script type='text/javascript'>alert('Data Not found');</script>";
                echo $error;
                exit();
            }
            ?>

            <!-- Modal -->
            <?php
            /*            ob_start();
                        */ ?>


            <script>
                $(".select2").select2();
                $("#checkAll").click(function () {
                    $('.aaaaaa').not(this).prop('checked', this.checked);

                    /*$('#deduction').prop('checked', false);*/
                });

                function payment_submit(id) {

                    var joborder_no = id;
                    /* console.log(joborder_no);*/
                    $.ajax({
                        url: 'payment_submit.php',
                        type: 'POST',
                        data: {
                            payment: true,
                            joborder_no: joborder_no
                        },
                        success: function (data) {

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
                    });
                }

                function insertSelected() {
                    var datai = new Array();
                    $('input:checkbox:checked').each(function () {
                        datai.push($(this).attr('id'));
                    });
                    $.ajax({
                        url: 'payment_submit.php',
                        type: 'POST',
                        data: {
                            multi_payment: true,
                            datai: datai
                        },
                        success: function (data) {
                            $.toast({
                                heading: 'Congractulations',
                                text: 'Record updated successfully',
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3500,
                                stack: 6
                            });
                            /*$.toast({
                                heading: 'Congractulations',
                                text: 'Record updated successfully',
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'success',
                                hideAfter: 3500,
                                stack: 6
                            });*/
                        }
                    });
                }

            </script>











