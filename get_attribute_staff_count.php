<?php
include "class/cls_db.php";
$db = new db();
include "includes/common.inc.php";

foreach($_POST as $name => $val )
$$name=$val;

if($tab1==1)
{
?>

<div class="col-md-12">
    <div class="sttabs tabs-style-bar">
        <nav>
            <ul>
                <li class=" printTabBg"><a href="#" rel="<?php echo $log_id;?>" class="sticon fa fa-cube clscompleted"><span>Completed</span></a></li>
                <li><a href="#" class="sticon fa fa-cubes clsnotcompleted" rel="<?php echo $log_id;?>"><span>Pending</span></a></li>
                <li></li>
            </ul>
        </nav>

<?php
$stockQuery = "SELECT * FROM tbl_joborder,`tbl_joborder_size_attribute` WHERE tbl_joborder.joborder_id=tbl_joborder_size_attribute.joborder_id AND tbl_joborder_size_attribute.staff_id=$log_id AND tbl_joborder.is_complete=1 GROUP BY tbl_joborder_size_attribute.staff_id";
 $stockQueryQ = $db->record_select($stockQuery);

if($stockQueryQ=='')
{
    $sss='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
          <strong>  <h1 style="color: #2cabe3;text-align: center;" >Data Not Found</h1></strong>
        </div>
    </div>
</div>';
echo $sss;
exit();
}
?>
<div class="panel panel-default">
        </div>

                  <div>
                    
                
                            <table class="form-table customFields col-md-12 "  style="text-align:center"  id="customFields" width="100%">
                                      <tr>
                                        <th style="text-align:center">Job Order No</th>
                                        <th style="text-align:center">Job Order Name</th>
                                        <th style="text-align:center">Job Order Status</th>
                                        <th style="text-align:center">Assign Date</th>
                                        <th style="text-align:center">Complete Date</th>
                                        <th style="text-align:center">Attribute Price Total</th>
                                      </tr>
                                      <tr>
                                        <td><?php echo $stockQueryQ[0]['joborder_no'];?></td>
                                        <td><?php echo $stockQueryQ[0]['joborder_name'];?></td>
                                        <td><?php echo $stockQueryQ[0]['is_complete'];?></td>
                                        <td> <i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($stockQueryQ[0]['joborder_assign_date']))?></td>
                                        <td><i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($stockQueryQ[0]['joborder_complete_date']))?> </td>
                                        <td><?php echo $stockQueryQ[0]['attribute_price_total'];?></td>
                                      </tr>
                                     
                                    </table>
                                </div>       	
<?php 
}

elseif($tab1==2){
?>


<div class="col-md-12">
    <div class="sttabs tabs-style-bar">
        <nav>
            <ul>
                <li><a href="#" rel="<?php echo $log_id;?>" class="sticon fa fa-cube clscompleted"><span>Completed</span></a></li>
                <li class=" printTabBg"><a href="#" class="sticon fa fa-cubes clsnotcompleted" rel="<?php echo $log_id;?>"><span>Pending</span></a></li>
                <li></li>
            </ul>
        </nav>

    <?php
$stockQuery1 = "SELECT * FROM tbl_joborder,`tbl_joborder_size_attribute` WHERE tbl_joborder.joborder_id=tbl_joborder_size_attribute.joborder_id AND tbl_joborder_size_attribute.staff_id=$log_id AND tbl_joborder.is_complete=0 GROUP BY tbl_joborder_size_attribute.staff_id";
 $stockQueryQQ = $db->record_select($stockQuery1);
 if($stockQueryQQ=='')
{
    $sss='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
          <strong>  <h1 style="color: #2cabe3;text-align: center;" >Data Not Found</h1></strong>
        </div>
    </div>
</div>';
echo $sss;
exit();
}
    ?>


<div class="col-md-12">
                    <div class="panel panel-default">
        <div class="panel-body">
               
                            <table class="form-table customFields" style="text-align:center" id="customFields" width="100%">
                                      <tr>
                                        <th style="text-align:center">Job Order No</th>
                                        <th style="text-align:center">Job Order Name</th>
                                        <th style="text-align:center">Job Order Status</th>
                                        <th style="text-align:center">Assign Date</th>
                                        <th style="text-align:center">Created On</th>
                                        <th style="text-align:center">Attribute Price Total</th>
                                      </tr>
                                      <tr>
                                        <td><?php echo $stockQueryQQ[0]['joborder_no'];?></td>
                                        <td><?php echo $stockQueryQQ[0]['joborder_name'];?></td>
                                        <td><?php echo $stockQueryQQ[0]['is_complete'];?></td>
                                        <td> <i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($stockQueryQQ[0]['joborder_assign_date']))?></td>
                                        <td><i class="fa fa-calendar"></i> <?php echo date($dateformat, strtotime($stockQueryQQ[0]['joborder_created_on']))?> </td>
                                        <td><?php echo $stockQueryQQ[0]['attribute_price_total'];?></td>
                                      </tr>
                                     
                                    </table>
                                
                                
                     </div>
                 </div>
             </div>


<?php }?>