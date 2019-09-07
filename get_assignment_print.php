<?php
include "class/cls_db.php";
$db = new db();
include "includes/common.inc.php";

foreach($_POST as $name => $val )
$$name=$val;

$assignmentQuery = "SELECT * FROM tbl_assignment, tbl_users WHERE tbl_assignment.client_id=tbl_users.log_id AND tbl_assignment.assignment_id=$assignment_id";
$assignmentQueryD = $db->record_select($assignmentQuery);
//echo $stock_item_id;
$assignment_picture="plugins/images/assignment/".$assignmentQueryD[0]['assignment_picture'];
?>

<div class="col-md-12">
    <div class="sttabs tabs-style-bar">
        <div>
        	
            <div class="col-md-12">
                <div class="pull-left">
                    <address>
                        <p>                          
                            <a href="assignment_print.php?t=1&s=<?php echo $assignment_id;?>" target="_blank" style="float:left;"><i class="fa fa-print  fa-2x btn bg"></i></a> &nbsp; <a href="javascript:;" style="float:left;"><i class="fa fa-envelope  fa-2x btn bg"></i></a>
                            <br><br />
                        	<b>Code: </b><?php echo $assignmentQueryD[0]['assignment_code'];?>
                            <br> <b>Name: </b><?php echo $assignmentQueryD[0]['assignment_name'];?>
                            <br> <b>Client: </b><?php echo $assignmentQueryD[0]['user_first_name'];?>
                        </p>
                    </address>
                </div>
                <div class="pull-right text-right">
                    <address>
                        <p>
                        	<img style="border:1px solid #2CABE3; padding:3px;" src="<?php echo $assignment_picture;?>" width="100" />
                        </p>
                    </address>
                </div>
            </div>
            
            <?php
            $sqlsize="SELECT * FROM tbl_assignment_size, tbl_size WHERE tbl_assignment_size.assignment_id=$assignment_id AND tbl_assignment_size.size_id=tbl_size.size_id";
			$sqlsizeQ=$db->record_select($sqlsize);
			foreach($sqlsizeQ as $sqlsizeD){
			?>
            <div class="col-md-12">
            	<div id="sizer">
                        <div class="row">
                            <div class="col-md-3" style="padding:0px;">
                                <?php echo $sqlsizeD['size']." ( ".$sqlsizeD['size_short']." )";?>
                            </div>
                            <div class="col-md-8">
                            
                            </div>
                            <div class="col-md-1" style="text-align:right;">
                                
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
                                                        <th style="text-align:left;width:16%;"><b>Code</b></th>
                                                        <th style="text-align:left;width:16%;"><b>Name</b></th>
                                                        <th style="text-align:left;width:15%;"><b>UOM</b></th>
                                                        <th style="text-align:left;width:18%;"><b>Photo</b></th>
                                                        <th style="text-align:left;width:18%;"><b>Color</b></th>
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
														$stock_image_color="<div style='width:30px; border-radius:50%; height:30px; background-color:".$sqlstockItemD[0]['stock_color']."'></div>";
													}
													
												   ?>         
                                                    <tr class="rowTextCenter" id="row0ofsize0" style="position:fix;">
                                                        <td><?php echo $sqlItemD[0]['item_code'];?></td>
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
        	<?php }?>
        </div>
        <!-- /content -->
    </div>
</div>