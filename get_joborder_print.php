<?php
include "class/cls_db.php";
$db = new db();
include "includes/common.inc.php";

foreach($_POST as $name => $val )
$$name=$val;

$sqleventId="SELECT tbl_joborder.joborder_id, tbl_joborder.assignment_id, tbl_joborder.joborder_no, tbl_joborder.joborder_assign_date, tbl_joborder.joborder_complete_date, tbl_joborder.joborder_name, tbl_assignment.assignment_name, tbl_assignment.assignment_picture, tbl_joborder.joborder_status, tclient.user_first_name as client_name, tsuervisor.user_first_name as supervisor_name   FROM tbl_joborder, tbl_assignment, tbl_users as tclient, tbl_users as tsuervisor WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.client_id=tclient.log_id AND tbl_joborder.supervisor_id=tsuervisor.log_id AND tbl_joborder.joborder_id=$joborder_id";
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
?>
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
                            <th style="text-align:center;width:75%;"><b>Expected Meterial</b></th>
                            <th style="text-align:center;width:25%;"><b>Attribute</b></th>
                        </tr>
                        <tr>
                            <td valign="top">
                                <table width="100%" id="tblmeterialofsize0" class="panel panel-success table responsive" border="0" cellspacing="0" cellpadding="0">
                                    <thead style="background-color:#bdedbc;">
                                        <tr>
                                            <th style="text-align:left;width:19%;"><b>Code</b></th>
                                            <th style="text-align:left;width:19%;"><b>Name</b></th>
                                            <th style="text-align:left;width:15%;"><b>UOM</b></th>
                                            <th style="text-align:left;width:15%;"><b>Photo</b></th>
                                            <th style="text-align:left;width:15%;"><b>Color</b></th>
                                            <th style="text-align:left;width:15%;"><b>Quantity</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       $sqlMaterial="SELECT * FROM tbl_assignment_material WHERE assignment_size_id=".$sqlsizeD['assignment_size_id']."";
                                       $sqlMaterialQ=$db->record_select($sqlMaterial);
                                       foreach($sqlMaterialQ as $sqlMaterialD){
                                        // to get Item Id
                                        $sqlItem="SELECT * FROM tbl_items, tbl_uom WHERE tbl_items.item_id=".$sqlMaterialD['item_id']." AND tbl_items.uom_id=tbl_uom.uom_id";
                                        $sqlItemD=$db->record_select($sqlItem);
                                        
                                        // to get stock Item id color/picture
                                        $sqlstockItem="SELECT * FROM tbl_stock_items WHERE stock_item_id=".$sqlMaterialD['stock_item_id']."";
                                        $sqlstockItemD=$db->record_select($sqlstockItem);
                                        $stock_image_URL="";
                                        $stock_image_color="";
                                        
                                        if($sqlstockItemD[0]['stock_image']!="")
                                        {
                                            $stock_image_URL="<img src='plugins/images/stock/".$sqlstockItemD[0]['stock_image']."' width='40' />";
                                            $stock_image_color="";
                                        }
                                        else
                                        {
                                            $stock_image_URL="";
                                            $stock_image_color="<div id='print".$sqlMaterialD['item_id']."' style='background-color:".$sqlstockItemD[0]['stock_color'].";margin:0px 0px 0px 0px;padding: 16px;border-radius:50%;width:5%;' disabled></div>";
                                        }
                                        
                                       ?>   
                                        <style>
                                            @media print {
                                            #print<?php echo $sqlMaterialD['item_id'];?>{
                                                background-color: <?php echo $sqlstockItemD[0]['stock_color'];?> !important;
                                                -webkit-print-color-adjust: exact; 
                                            }
                                        }
                                        </style>      
                                        <tr class="rowTextCenter" id="row0ofsize0" style="position:fix;">
                                            <td>&nbsp;<?php echo $sqlItemD[0]['item_code'];?></td>
                                            <td><?php echo $sqlItemD[0]['item_name'];?></td>
                                            <td><?php echo $sqlItemD[0]['uom'];?></td>
                                            <td><?php echo $stock_image_URL;?></td>
                                            <td><?php echo $stock_image_color;?></td>
                                            <td><?php echo $sqlMaterialD['assignment_quantity'];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </td>
                            <td valign="top">
                                <table width="100%" id="tblattributeofsize0" class="panel panel-warning table responsive" border="0" cellspacing="0"cellpadding="0">
                                    <thead style="background-color:#ffefa4;">
                                        <tr>
                                            <th width="65%"><b>Attribute</b></th>
                                            <th width="35%"><b>Price</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       $sqlAttribute="SELECT * FROM tbl_assignment_attribute, tbl_attribute WHERE tbl_assignment_attribute.assignment_size_id=".$sqlsizeD['assignment_size_id']." AND tbl_assignment_attribute.attribute_id=tbl_attribute.attribute_id";
                                       $sqlAttributeQ=$db->record_select($sqlAttribute);
                                       foreach($sqlAttributeQ as $sqlAttributeD){
                                       ?> 
                                        <tr class="rowTextCenter">
                                            <td><?php echo $sqlAttributeD['attribute'];?></td>
                                            <td><?php echo $sqlAttributeD['attribute_price'];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
</div>
<?php $i++;}
?>
</div>
</div>