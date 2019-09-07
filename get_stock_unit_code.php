<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;

$sqlitem="SELECT * FROM tbl_items WHERE status='Enable' AND item_id=$item_code";
$sqlitemQ=$db->record_select($sqlitem);
$item_name=$sqlitemQ[0]['item_name'];

// to get old
$sqlold="SELECT * FROM tbl_stock_item_rolls WHERE stock_item_id=$stock_item_id";
$sqloldQ=$db->record_select($sqlold);
?>
<table id="demo-foo-pagination" class="table m-b-0 toggle-arrow-tiny" data-filter="#filter" data-filter-minimum="2" data-page-size="5">
    <thead>
        <tr>
        	<th data-hide="true" width="15%"> Sr. </th>
            <th data-toggle="phone">Roll Id</th>
            <th data-hide="phone"> Yard </th>
            <th data-hide="phone"> Meter </th>
        </tr>
    </thead>
    <tbody>
        <?php 
		for($i=1;$i<=$totalunit;$i++){
		$rollid=$item_name."-".$i;
		//if($$sqloldQ[i)
		
		?>
			<tr class="rowTextCenter">
            	<td><input class="form-control" value="<?php echo $i;?>" name="sr<?php echo $x;?>roll<?php echo $i;?>" placeholder="0" data-validate="required" readonly></td>
				<td><input class="form-control" id="tempitem<?php echo $x;?>roll<?php echo $i;?>" value="<?php echo $rollid;?>" name="tempitem<?php echo $x;?>roll<?php echo $i;?>" placeholder="0" data-validate="required"></td>
				<td><input class="form-control clsyards" type="number" id="tempitem<?php echo $x;?>roll<?php echo $i;?>first<?php echo $i;?>" relx="<?php echo $x;?>" reli="<?php echo $i;?>" data-validate="required"></td>
				<td><input class="form-control clsmeters" type="number" id="tempitem<?php echo $x;?>roll<?php echo $i;?>second<?php echo $i;?>" relx="<?php echo $x;?>" reli="<?php echo $i;?>"  data-validate="required"></td>
			</tr>
		<?php } ?>
    </tbody>
</table>
<div class="row">
    <div class="col-md-6"> 
        <div class="form-group">
            <button type="button" class="btn btn-success waves-effect waves-light m-r-10 btnunittotal" relx="<?php echo $x;?>" reli="<?php echo $i-1;?>">Submit</button>
            <button type="button" class="btn btn-inverse waves-effect waves-light btnCancel">Cancel</button>
         </div>
    </div>
 </div>



