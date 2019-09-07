<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;

$i=0;
$sqlsize="SELECT * FROM tbl_assignment_size, tbl_size WHERE tbl_assignment_size.assignment_id=$assignment_id AND tbl_assignment_size.size_id=tbl_size.size_id";
$sqlsizeQ=$db->record_select($sqlsize);
foreach($sqlsizeQ as $sqlsizeD){
?>
<div class="col-md-12">
	<div id="sizer<?php echo $i?>">
			<div class="row">
				<div class="col-md-1">
					<input type="checkbox" checked="" class="chkboxsize" rel="<?php echo $i;?>" value="<?php echo $sqlsizeD['assignment_size_id'];?>" name="sizecheck[]" id="sizecheck<?php echo $i?>">
				</div>
                <div class="col-md-2" style="padding:0px;">
					&nbsp;<b><?php echo $sqlsizeD['size']." ( ".$sqlsizeD['size_short']." )";?></b>
				</div>
				<div class="col-md-6">
					
				</div>
                <div class="col-md-1" style="text-align:right; line-height:30px;">
					<b>Units:</b>
				</div>
                <div class="col-md-2" style="text-align:right; padding:0px;" id="DivUnits<?php echo $i?>">
					<input type="text" class="form-control" id="order_units<?php echo $i?>" name="order_units[]" placeholder="Enter Unit" value="" />
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
											$stock_image_color="<div id='print".$sqlMaterialD['item_id']."' style='background-color:".$sqlstockItemD[0]['stock_color'].";margin:0px 0px 0px 30px;padding: 16px;border-radius:50%;width:5%;' disabled></div>";
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
<?php $i++;}?>



