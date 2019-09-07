<?php
include "class/cls_db.php";
$db = new db();
include "includes/common.inc.php";

foreach($_POST as $name => $val )
$$name=$val;

$sqleventId="SELECT tbl_joborder.joborder_id,tbl_joborder.is_complete, tbl_joborder.assignment_id, tbl_joborder.joborder_no, tbl_joborder.joborder_assign_date, tbl_joborder.joborder_complete_date, tbl_joborder.joborder_name, tbl_assignment.assignment_name, tbl_assignment.assignment_picture, tbl_joborder.joborder_status, tclient.user_first_name as client_name, tsuervisor.user_first_name as supervisor_name   FROM tbl_joborder, tbl_assignment, tbl_users as tclient, tbl_users as tsuervisor WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.client_id=tclient.log_id AND tbl_joborder.supervisor_id=tsuervisor.log_id AND tbl_joborder.joborder_id=$joborder_id";
$sqleventIdQ=$db->record_select($sqleventId);
foreach($sqleventIdQ[0] as $name => $val)
$$name=$val;

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

if($is_complete==0)
{
?>

<input type="hidden" name="joborder_id" value="<?php echo $joborder_id;?>" />
<input type="hidden" name="actionType" id="actionType" />
<div class="col-md-12">
	<div class="col-md-12">
        <div class="pull-left">
            <address>
                <p>
                    <b>Job Order Name: </b><?php echo $joborder_name;?>
                    <br> <b>Job Order Code: </b><?php echo $joborder_no;?>
                    <br> <b>Assigning Date: </b><?php echo date($dateformat,strtotime($joborder_assign_date));?>
                    <br> <b>Completion Date: </b><?php echo date($dateformat,strtotime($joborder_complete_date));?>
                    <br> <b>Client: </b><?php echo $client_name;?>
                    <br> <b>Supervisor: </b><?php echo $supervisor_name;?>
                </p>
            </address>
        </div>
        <div class="pull-right text-right">
            <address>
            	<?php if($vType=='P'){?>
            	<a href="joborder_print.php?t=1&s=<?php echo $joborder_id;?>" target="_blank" style="float:left;"><i class="fa fa-print  fa-2x btn bg"></i></a> &nbsp; <a href="javascript:;" style="float:left;"><i class="fa fa-envelope  fa-2x btn bg"></i></a>
                <?php }?>
                <p>
                    <img style="border:1px solid #2CABE3; padding:3px;" src="<?php echo $assignmentimg;?>" width="125" />
                </p>
            </address>
        </div>
    </div>
<div id="Mainsizer">
<?php
$i=0;
$sqlsize="SELECT * FROM tbl_joborder_size, tbl_assignment_size, tbl_size WHERE tbl_joborder_size.joborder_id=$joborder_id AND tbl_assignment_size.size_id=tbl_size.size_id AND tbl_joborder_size.assignment_size_id=tbl_assignment_size.assignment_size_id";
$sqlsizeQ=$db->record_select($sqlsize);
foreach($sqlsizeQ as $sqlsizeD){
?>
<input type="hidden" name="assignment_size_id[]" value="<?php echo $sqlsizeD['assignment_size_id'];?>" />
<div class="col-md-12">
    <div id="sizer<?php echo $i?>">
            <div class="row">
                <div class="col-md-3" style="padding:0px;">
                    &nbsp; <b>Size:</b> &nbsp;<?php echo $sqlsizeD['size']." ( ".$sqlsizeD['size_short']." )";?>
                </div>
                <div class="col-md-6">
                    
                </div>
                <div class="col-md-3" style="text-align:right; line-height:30px;">
                    <b>Units:</b> <?php echo $sqlsizeD['joborder_units'];?>
                </div>
            </div>
            <div class="row">
                <table width="100%" id="customFields" class="form-table customFields" border="0" cellspacing="0" cellpadding="0"><!--table responsive-->
                        <tr>
                            <td valign="top">
                                <table width="100%" id="tblattributeofsize0" class="panel panel-warning table responsive" border="0" cellspacing="0"cellpadding="0">
                                    <thead style="background-color:#ffefa4;">
                                        <tr>
                                            <th width="26%"><b>Attribute</b></th>
                                            <th width="15%"><b>Assign to Staff</b></th>
                                            <th width="13%">Receive</th>
                                            <th width="13%">Damage</th>
                                            <th width="13%">Complete</th>
                                            <th width="10%"><b>Price</b></th>
                                            <th width="10%"><b>Total</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$ttlstaff=0;
										$j=0;
                                       //$sqlAttribute="SELECT * FROM tbl_assignment_attribute, tbl_attribute WHERE tbl_assignment_attribute.assignment_size_id=".$sqlsizeD['assignment_size_id']." AND tbl_assignment_attribute.attribute_id=tbl_attribute.attribute_id";
									   $sqlAttribute="SELECT * FROM tbl_joborder_size_attribute, tbl_attribute WHERE tbl_joborder_size_attribute.assignment_size_id=".$sqlsizeD['assignment_size_id']." AND tbl_joborder_size_attribute.joborder_id=$joborder_id AND tbl_joborder_size_attribute.attribute_id=tbl_attribute.attribute_id";
                                       $sqlAttributeQ=$db->record_select($sqlAttribute);
                                       foreach($sqlAttributeQ as $sqlAttributeD){
									   
									   if($sqlAttributeD['staff_id']==0)
									   	$ttlstaff++;
									   
									   
                                       ?> 
                                       	<input type="hidden" name="attributes<?php echo $sqlsizeD['assignment_size_id'];?>[]" id="attributes<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $j;?>" value="<?php echo $sqlAttributeD['attribute_id'];?>" />
                                        <tr class="rowTextCenter">
                                            <td><?php echo $sqlAttributeD['attribute'];?></td>
                                            <td>
                                            	<select class="form-control select2" name="staff_id<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $sqlAttributeD['attribute_id'];?>" id="staff_id<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $j;?>">
                                                    <option value="">-Select Staff-</option>
                                                    <?php 
													$sqlevents="SELECT * FROM tbllogin, tbl_users, tbl_users_attributes WHERE tbllogin.log_sts='A' AND tbllogin.typ_id=5 AND tbllogin.log_id=tbl_users.log_id AND tbl_users.log_id=tbl_users_attributes.log_id AND tbl_users_attributes.attribute_id=".$sqlAttributeD['attribute_id']." AND tbl_users_attributes.users_attribute_sts='A'";
													$sqleventsQ=$db->record_select($sqlevents);
													foreach($sqleventsQ as $sqleventsD){?>
                                                    	<option value="<?php echo $sqleventsD['log_id'];?>" <?php if($sqlAttributeD['staff_id']==$sqleventsD['log_id']) {echo "selected";}?>><?php echo $sqleventsD['user_first_name'];?></option>
													<?php }?>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control" name="receive<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $sqlAttributeD['attribute_id'];?>" id="receive<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $j;?>" value="<?php if($j==0 && $sqlAttributeD['receive']==0){echo $sqlsizeD['joborder_units'];} else {echo $sqlAttributeD['receive'];}?>" /></td>
                                            <td><input type="text" class="form-control clsdamage" rel="<?php echo $j;?>" arel="<?php echo $sqlsizeD['assignment_size_id'];?>" atrel="<?php echo $sqlAttributeD['attribute_id'];?>" name="damage<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $sqlAttributeD['attribute_id'];?>" id="damage<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $j;?>" value="<?php echo $sqlAttributeD['damage'];?>" /></td>
                                            <td><input type="text" class="form-control" name="complete<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $sqlAttributeD['attribute_id'];?>" id="complete<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $j;?>" value="<?php echo $sqlAttributeD['complete'];?>" /></td>
                                            <td><input type="text" readonly class="form-control" name="singleprice<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $sqlAttributeD['attribute_id'];?>" id="singleprice<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $j;?>" value="<?php echo $sqlAttributeD['attribute_price'];?>" /></td>
                                            <td><input type="text" readonly class="form-control" name="totalprice<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $sqlAttributeD['attribute_id'];?>" id="totalprice<?php echo $sqlsizeD['assignment_size_id'];?><?php echo $j;?>" value="<?php echo $sqlAttributeD['attribute_price_total'];?>" /><?php //echo $sqlAttributeD['attribute_price']*$sqlsizeD['joborder_units'];?></td>
                                        </tr>
                                        <?php  $j++;}?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
</div>
<?php $i++;}
//echo $ttlstaff;
?>
</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-info waves-effect">Save</button><!-- data-dismiss="modal"-->
    <?php if($ttlstaff==0){?>
    <button type="button" class="btn btn-success waves-effect clsfinish" rel="<?php echo $joborder_id;?>">Finish</button>
    <?php }?>
</div>
<?php } 
else 
{?>
<div class="col-md-12">
	<div class="col-md-12">
        <div class="pull-left">
            <address>
                <p>
                    <b>Job Order Name: </b><?php echo $joborder_name;?>
                    <br> <b>Job Order Code: </b><?php echo $joborder_no;?>
                    <br> <b>Assigning Date: </b><?php echo date($dateformat,strtotime($joborder_assign_date));?>
                    <br> <b>Completion Date: </b><?php echo date($dateformat,strtotime($joborder_complete_date));?>
                    <br> <b>Client: </b><?php echo $client_name;?>
                    <br> <b>Supervisor: </b><?php echo $supervisor_name;?>
                </p>
            </address>
        </div>
        <div class="pull-right text-right">
            <address>
            	<?php if($vType=='P'){?>
            	<a href="joborder_print.php?t=1&s=<?php echo $joborder_id;?>" target="_blank" style="float:left;"><i class="fa fa-print  fa-2x btn bg"></i></a> &nbsp; <a href="javascript:;" style="float:left;"><i class="fa fa-envelope  fa-2x btn bg"></i></a>
                <?php }?>
                <p>
                    <img style="border:1px solid #2CABE3; padding:3px;" src="<?php echo $assignmentimg;?>" width="125" />
                </p>
            </address>
        </div>
    </div>
    <div id="Mainsizer">
    	<div class="col-md-12">
            <div id="sizer">
                <div class="row">
                    <table width="100%" id="customFields" class="form-table customFields" border="0" cellspacing="0" cellpadding="0"><!--table responsive-->
                            <tr>
                                <td valign="top">
                                    <table width="100%" id="tblattributeofsize0" class="panel panel-warning table responsive" border="0" cellspacing="0"cellpadding="0">
                                        <thead style="background-color:#ffefa4;">
                                            <tr>
                                                <th width="5%" style="padding-left:5px;"><b>Sr.</b></th>
                                                <th width="35%"><b>Staff</b></th>
                                                <th width="15%">Receive</th>
                                                <th width="15%">Damage</th>
                                                <th width="15%">Complete</th>
                                                <th width="15%"><b>Total</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											$i=1;
                                           $sqlselect="SELECT SUM(tbl_joborder_size_attribute.attribute_price_total) AS attribute_price_total, tbl_users.user_first_name, SUM(tbl_joborder_size_attribute.receive) as receive, SUM(tbl_joborder_size_attribute.complete) as complete, SUM(tbl_joborder_size_attribute.damage) as damage FROM tbl_joborder_size_attribute, tbl_users WHERE tbl_joborder_size_attribute.staff_id=tbl_users.log_id GROUP BY tbl_joborder_size_attribute.staff_id";
										   $sqlselectQ=$db->record_select($sqlselect);
                                           foreach($sqlselectQ as $sqlselectD){
                                           ?> 
                                            <tr class="rowTextCenter">
                                                <td style="padding-left:5px;"><b><?php echo $i;?>.</b></td>
                                                <td><?php echo $sqlselectD['user_first_name'];?></td>
                                                <td><?php echo $sqlselectD['receive'];?></td>
                                                <td><?php echo $sqlselectD['damage'];?></td>
                                                <td><?php echo $sqlselectD['complete'];?></td>
                                                <td><?php echo $sqlselectD['attribute_price_total'];?></td>
                                            </tr>
                                            <?php  $i++;}?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                    </table>
                </div>
        	</div>
        </div>
    </div>
</div>
<?php }?>