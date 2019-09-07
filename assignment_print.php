<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");
include "class/cls_forms.php";

$assignment_id=addslashes(urlencode($_GET['s']));
$assignmentQuery = "SELECT * FROM tbl_assignment, tbl_users WHERE tbl_assignment.client_id=tbl_users.log_id AND tbl_assignment.assignment_id=$assignment_id";
$assignmentQueryD = $db->record_select($assignmentQuery);
//echo $stock_item_id;
$assignment_picture="plugins/images/assignment/".$assignmentQueryD[0]['assignment_picture'];
$pagewidh="95%";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $admin_favico_path;?>">
    <title><?php echo $inc_general_name;?></title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">

</head>

<body class="fix-header">


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td style="background-color:#FFFFFF;">
    	<table width="<?php echo $pagewidh;?>" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>
            	<?php echo $generalHeader;?>
            </td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
  	<td style="background-color:#FFFFFF;">
    	<table width="<?php echo $pagewidh;?>" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>
            	<div class="col-md-12" style="padding:0px 3px;">
                    <div class="pull-left">
                        <address>
                            <p>
                            	<br />
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
            </td>
          </tr>
        </table>
    </td>
  </tr>
  <tr>
    <td style="background-color:#FFFFFF;">
    	<table width="<?php echo $pagewidh;?>" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>
            	<?php
				$sqlsize="SELECT * FROM tbl_assignment_size, tbl_size WHERE tbl_assignment_size.assignment_id=$assignment_id AND tbl_assignment_size.size_id=tbl_size.size_id";
				$sqlsizeQ=$db->record_select($sqlsize);
				foreach($sqlsizeQ as $sqlsizeD){
				?>
				<div class="col-md-12">
					<div id="sizer">
							<div class="row">
								<div class="col-md-3" style="padding:0px;">
									&nbsp;<b><?php echo $sqlsizeD['size']." ( ".$sqlsizeD['size_short']." )";?></b>
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
				<?php }?>
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>


<script>
	window.print();
</script>

</body>
</html>
