<?php
include "class/cls_db.php";
$db = new db();
include "includes/common.inc.php";

foreach($_POST as $name => $val )
$$name=$val;


$sqleventId="SELECT * FROM tbl_joborder, tbl_assignment WHERE tbl_joborder.assignment_id=tbl_assignment.assignment_id AND tbl_joborder.joborder_id=$joborder_id";
$sqleventIdQ=$db->record_select($sqleventId);
foreach($sqleventIdQ[0] as $name => $val)
$$name=$val;

// to get selected sizes
$sqlordersizes="SELECT * FROM tbl_joborder_size WHERE joborder_id=$joborder_id";
$sqlordersizesQ=$db->record_select($sqlordersizes);
foreach($sqlordersizesQ as $sqlordersizesD)
{
	$selectedSizes[]=$sqlordersizesD['assignment_size_id'];
}
$JOAS = implode (", ", $selectedSizes);
?>
<!--<div id="Mainsizer">-->
<div class="col-md-12">
	<?php
    $j=0;
    $k=0;
    $sqlsize="SELECT * FROM tbl_assignment_size, tbl_size WHERE tbl_assignment_size.assignment_id=$assignment_id AND tbl_assignment_size.size_id=tbl_size.size_id";
    $sqlsizeQ=$db->record_select($sqlsize);
    foreach($sqlsizeQ as $sqlsizeD){
    
    // to get units
    $sqlgetunits="SELECT * FROM tbl_joborder_size WHERE joborder_id=$joborder_id AND assignment_size_id=".$sqlsizeD['assignment_size_id']."";
    $sqlgetunitsQ=$db->record_select($sqlgetunits);
    ?>
    
    <div class="col-md-12">
        <div id="sizer<?php echo $j?>"  <?php if(!in_array($sqlsizeD['assignment_size_id'],$selectedSizes)) {echo ' style="opacity:0.2"';} else {echo ' style="opacity:1"';} ?>>
                <div class="row">
                    <table width="100%" id="customFields" class="form-table customFields" border="0" cellspacing="0" cellpadding="0"><!--table responsive-->
                            <tr>
                                <td valign="top">
                                    <table width="100%" id="tblmeterialofsize0" class="panel panel-success table responsive" border="0" cellspacing="0" cellpadding="0">
                                        <thead style="background-color:#bdedbc;">
                                            <tr>
                                                <th style="text-align:left;width:17%;"><b>Code</b></th>
                                                <th style="text-align:left;width:17%;"><b>Name</b></th>
                                                <th style="text-align:left;width:10%;"><b>Photo/Color</b></th>
                                                <th style="text-align:left;width:16%;"><b>Required / Issued</b></th>
                                                <th style="text-align:left;width:40%;"><b>Stock</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           $i=0;
                                           $sqlMaterial="SELECT * FROM tbl_assignment_material WHERE assignment_size_id=".$sqlsizeD['assignment_size_id']."";
                                           $sqlMaterialQ=$db->record_select($sqlMaterial);
                                           foreach($sqlMaterialQ as $sqlMaterialD){
										   	$assignment_material_id=$sqlMaterialD['assignment_material_id'];
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
                                            }
                                            else
                                            {
                                                $stock_image_URL="<div id='print".$sqlMaterialD['item_id']."' style='background-color:".$sqlstockItemD[0]['stock_color'].";margin:0px 0px 0px 0px;padding: 16px;border-radius:50%;width:5%;' disabled></div>";
                                            }
                                            
                                            $newQty=$sqlMaterialD['assignment_quantity']*$sqlgetunitsQ[0]['joborder_units'];
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
                                                <td><?php echo $stock_image_URL;?></td>
                                                <td>
                                                	<?php
                                                    $sqlstock="SELECT required_qty, assigned_qty FROM tbl_joborder_stock WHERE joborder_id=$joborder_id AND assignment_id=$assignment_id AND assignment_meterial_id=".$assignment_material_id."";
													$sqlstockQ=$db->record_select($sqlstock);
													echo $sqlstockQ[0]['required_qty']." / ".round($sqlstockQ[0]['assigned_qty'],2);
													?>
                                                </td>
                                                <td>
                                                	<?php
                                                    $sqlstock="SELECT * FROM tbl_joborder_stock WHERE joborder_id=$joborder_id AND assignment_id=$assignment_id AND assignment_meterial_id=".$assignment_material_id."";
													$sqlstockQ=$db->record_select($sqlstock);
													foreach($sqlstockQ as $sqlstockD)
													{
														if($sqlItemD[0]['uom_id']==4 || $sqlItemD[0]['uom_id']==7)
														{
															$sqlstockItems="SELECT * FROM tbl_stock_item_rolls,tbl_joborder_stock_roll WHERE tbl_stock_item_rolls.stock_item_roll_id=tbl_joborder_stock_roll.stock_item_roll_id AND tbl_joborder_stock_roll.job_order_stock_id=".$sqlstockD['job_order_stock_id']."";
															$sqlstockItemsQ=$db->record_select($sqlstockItems);
															foreach($sqlstockItemsQ as $sqlstockItemsD)
															{
																if($sqlItemD[0]['uom_id']==4)
																	$sefield="meters";
																elseif($sqlItemD[0]['uom_id']==7)
																	$sefield="yards";
																	
																 echo $sqlstockItemsD['roll_no']." ( ".$sqlstockItemsD[''.$sefield.'']." ".$sefield." )";
															}
														}
														else
														{
															/*$sqlstockItems="SELECT * FROM tbl_stock_items WHERE tbl_stock_items.stock_item_id=".$sqlstockD['stock_item_id']."";
															$sqlstockItemsQ=$db->record_select($sqlstockItems);
															echo $sqlstockItemsQ[0]['stock_quantity']." ( ".$sqlItemD[0]['uom']." )";*/
															echo $sqlstockD['assigned_qty']." ( ".$sqlItemD[0]['uom']." )";
														}
													}
													?>
                                                </td>
                                            </tr>
                                            <?php $i++; $k++;}?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
    </div>
    <?php $j++;}?>
</div>