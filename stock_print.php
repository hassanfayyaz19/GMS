<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");
include "class/cls_forms.php";

$type=addslashes(urlencode($_GET['t']));
$stock_item_id=addslashes(urlencode($_GET['s']));

$stockQuery = "SELECT * FROM tbl_stock_items, tbl_stock, tbl_location, tbl_users WHERE tbl_stock_items.stock_id=tbl_stock.stock_id AND tbl_stock.client_id=tbl_users.log_id AND tbl_stock.location_id=tbl_location.location_id AND tbl_stock_items.stock_item_id=$stock_item_id";
$stockQueryQ = $db->record_select($stockQuery);

$pagewidh="80%";
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
    <!--<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
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

<?php if($type==1){?>
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
            	<div class="col-md-12" style="padding:0px !important;">
                    <div class="pull-left">
                        <address>
                            <p><b>Stock No: </b><?php echo $stockQueryQ[0]['stock_no'];?>
                                <br> <b>Location: </b><?php echo $stockQueryQ[0]['location'];?>
                                <br> <b>Email: </b><?php echo $stockQueryQ[0]['user_email'];?>
                            </p>
                        </address>
                    </div>
                    <div class="pull-right text-right">
                        <address>
                            <p><b>Client : </b><?php echo $stockQueryQ[0]['user_first_name'];?>
                                <br /><b>Phone : </b><?php echo $stockQueryQ[0]['office_tel'];?>  
                                <br /><b>Stock Date :</b> <i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($stockQueryQ[0]['created_on']))?>
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
                <table class="form-table customFields" id="customFields" width="100%">
                  <tr>
                    <th width="20%"><b>Color/Photo</b></th>
                    <th width="20%"><b>Code</b></th>
                    <th width="20%"><b>Name</b></th>
                    <th width="20%"><b>UOM</b></th>
                    <th width="20%"><b>Quantity</b></th>
                    <th></th>
                  </tr>
                  <?php 
                  $sqlstock="SELECT * FROM tbl_stock_items, tbl_stock, tbl_items, tbl_uom WHERE tbl_stock_items.stock_id=tbl_stock.stock_id AND tbl_stock_items.item_id=tbl_items.item_id AND tbl_stock_items.stock_item_id=$stock_item_id AND tbl_items.uom_id=tbl_uom.uom_id";
                  $sqlstockQ = $db->record_select($sqlstock);
                  foreach($sqlstockQ as $sqlstockD)
                  {
                    if($sqlstockD['stock_image']!="")
                    {
                        $pic_color="<img src='plugins/images/stock/".$sqlstockD['stock_image']."' width='50' style='margin:0px 0px 0px 30px;' />";
                    }
                    else
                    {
                        $pic_color="
                        <div id='print".$sqlstockD['item_id']."' style='background-color:".$sqlstockD['stock_color'].";margin:0px 0px 0px 30px;padding: 20px;border-radius:50%;width:5%;' disabled></div>";
                    }
                  ?>
                  <style>
                        @media print {
                        #print<?php echo $sqlstockD['item_id'];?>{
                            background-color: <?php echo $sqlstockD['stock_color'];?> !important;
                            -webkit-print-color-adjust: exact; 
                        }
                    }
                    </style>
                  <tr valign="top">
                    <td><?php echo $pic_color;?></td>
                    <td><?php echo $sqlstockD['item_code'];?></td>
                    <td><?php echo $sqlstockD['item_name'];?></td>
                    <td><?php echo $sqlstockD['uom'];?></td>
                    <td><?php echo $sqlstockD['stock_quantity'];?></td>
                    <td></td>
                  </tr>
                  <?php if($sqlstockD['uom_id']==4 || $sqlstockD['uom_id']==7){?>
                  <tr>
                    <td colspan="6">
                        <table width="50%" border="0" cellspacing="0" cellpadding="0" align="right" style="border:1px solid #2CABE3;">
                          <tr>
                            <th> Roll Id</th>
                            <th>Meter</th>
                            <th>Yard</th>
                            <th>Status</th>
                          </tr>
                          <?php
                            $sqlrolls="SELECT * FROM tbl_stock_item_rolls WHERE stock_item_id=".$sqlstockD['stock_item_id']."";
                            $sqlrollsQ = $db->record_select($sqlrolls);
                            foreach($sqlrollsQ as $sqlrollsD)
                             {
                                // to check status
                                if($sqlrollsD['meters']==1)
                                    $sts="Used";
                                else
                                    $sts="Not Yet Used";
                          ?>
                          <tr>
                            <td> <?php echo $sqlrollsD['roll_no'];?></td>
                            <td><?php echo $sqlrollsD['meters'];?></td>
                            <td><?php echo $sqlrollsD['yards'];?></td>
                            <td><?php echo $sts;?></td>
                          </tr>
                          <?php }?>
                        </table>
                    </td>
                  </tr>
                  <?php 
                    }  
                  
                  }?>
                </table>
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>

<?php } elseif($type==2){?>
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
            	<div class="col-md-12" style="padding:0px !important;">
                    <div class="pull-left">
                        <address>
                            <p><b>Stock No: </b><?php echo $stockQueryQ[0]['stock_no'];?>
                                <br> <b>Location: </b><?php echo $stockQueryQ[0]['location'];?>
                                <br> <b>Email: </b><?php echo $stockQueryQ[0]['user_email'];?>
                            </p>
                        </address>
                    </div>
                    <div class="pull-right text-right">
                        <address>
                            <p><b>Client : </b><?php echo $stockQueryQ[0]['user_first_name'];?>
                                <br /><b>Phone : </b><?php echo $stockQueryQ[0]['office_tel'];?>  
                                <br /><b>Stock Date :</b> <i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($stockQueryQ[0]['created_on']))?>
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
    <td align="center" style="background-color:#FFFFFF;">
    	<table width="<?php echo $pagewidh;?>" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td>
                <table class="form-table customFields" id="customFields" width="100%">
                  <tr>
                    <th width="20%"><b>Color/Photo</b></th>
                    <th width="20%"><b>Code</b></th>
                    <th width="20%"><b>Name</b></th>
                    <th width="20%"><b>UOM</b></th>
                    <th width="20%"><b>Quantity</b></th>
                    <th></th>
                  </tr>
                  <?php 
                  $sqlstock="SELECT * FROM tbl_stock_items, tbl_stock, tbl_items, tbl_uom WHERE tbl_stock_items.stock_id=tbl_stock.stock_id AND tbl_stock_items.item_id=tbl_items.item_id AND tbl_stock_items.stock_id=".$stockQueryQ[0]['stock_id']." AND tbl_items.uom_id=tbl_uom.uom_id";
                  $sqlstockQ = $db->record_select($sqlstock);
                  foreach($sqlstockQ as $sqlstockD)
                  {
                    if($sqlstockD['stock_image']!="")
                    {
                        $pic_color="<img src='plugins/images/stock/".$sqlstockD['stock_image']."' width='50' style='margin:0px 0px 0px 30px;' />";
                    }
                    else
                    {
                        $pic_color="
                        <div id='print".$sqlstockD['item_id']."' style='background-color:".$sqlstockD['stock_color'].";margin:0px 0px 0px 30px;padding: 20px;border-radius:50%;width:5%;' disabled></div>";
                    }
                  ?>
                  <style>
                        @media print {
                        #print<?php echo $sqlstockD['item_id'];?>{
                            background-color: <?php echo $d['stock_color'];?> !important;
                            -webkit-print-color-adjust: exact; 
                        }
                    }
                    </style>
                  <tr valign="top">
                    <td><?php echo $pic_color;?></td>
                    <td><?php echo $sqlstockD['item_code'];?></td>
                    <td><?php echo $sqlstockD['item_name'];?></td>
                    <td><?php echo $sqlstockD['uom'];?></td>
                    <td><?php echo $sqlstockD['stock_quantity'];?></td>
                    <td></td>
                  </tr>
		  		  <?php if($sqlstockD['uom_id']==4 || $sqlstockD['uom_id']==7){?>
                      <tr>
                        <td colspan="6">
                            <table width="50%" border="0" cellspacing="0" cellpadding="0" align="right" style="border:1px solid #2CABE3;">
                              <tr>
                                <th> Roll Id</th>
                                <th>Meter</th>
                                <th>Yard</th>
                                <th>Status</th>
                              </tr>
                              <?php
                                $sqlrolls="SELECT * FROM tbl_stock_item_rolls WHERE stock_item_id=".$sqlstockD['stock_item_id']."";
                                $sqlrollsQ = $db->record_select($sqlrolls);
                                foreach($sqlrollsQ as $sqlrollsD)
                                 {
                                    // to check status
                                    if($sqlrollsD['meters']==1)
                                        $sts="Used";
                                    else
                                        $sts="Not Yet Used";
                              ?>
                              <tr>
                                <td> <?php echo $sqlrollsD['roll_no'];?></td>
                                <td><?php echo $sqlrollsD['meters'];?></td>
                                <td><?php echo $sqlrollsD['yards'];?></td>
                                <td><?php echo $sts;?></td>
                              </tr>
                              <?php }?>
                            </table>
                        </td>
                      </tr>
                      <?php 
                        } 
				  
				  }?>
                </table>
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>

<?php }?>
<script>
	window.print();
</script>

</body>
</html>
