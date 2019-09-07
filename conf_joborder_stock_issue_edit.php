<?php
include "class/cls_db.php";
$db = new db('');

$chkp=$_GET['chkp'];
$m=$_GET['m'];
$mid=$_GET['mid'];

foreach($_POST as $name => $val)
$$name=$val;

// code to revert old record
$sqlstock="SELECT * FROM tbl_joborder_stock,tbl_stock_items WHERE tbl_joborder_stock.stock_item_id=tbl_stock_items.stock_item_id AND tbl_joborder_stock.joborder_id=$joborder_id AND assignment_id=$assignment_id";
$sqlstockQ=$db->record_select($sqlstock);
foreach($sqlstockQ as $sqlstockD)
{
	$job_order_stock_id=$sqlstockD['job_order_stock_id'];
	// to get item information
	$sqlitem="SELECT * FROM tbl_items WHERE item_id=".$sqlstockD['item_id']."";
	$sqlitemQ=$db->record_select($sqlitem);
	$old_uom_id=$sqlitemQ[0]['uom_id'];
	if($old_uom_id==4 || $old_uom_id==7)
	{
		$sqlrollId="SELECT * FROM tbl_joborder_stock_roll WHERE job_order_stock_id=".$job_order_stock_id."";
		$sqlstockQ=$db->record_select($sqlrollId);
		foreach($sqlstockQ as $sqlstockD)
		{
			$sqlupdaterolls="UPDATE tbl_stock_item_rolls SET is_used=0, is_full_used=0 WHERE stock_item_roll_id=".$sqlstockD['stock_item_roll_id']."";
			$db->query_execute($sqlupdaterolls);
		}
	}
	else
	{
		$stock_qty=$sqlstockD['stock_quantity'];
		$assigned_qty=$sqlstockD['assigned_qty'];
		$new_stock_qty=$stock_qty+$assigned_qty;
		$sqlupdatestock="UPDATE tbl_stock_items SET stock_quantity=$new_stock_qty WHERE stock_item_id=".$sqlstockD['stock_item_id']."";
		$db->query_execute($sqlupdatestock);
	}
	//echo "<br />";
	 $sqldel="DELETE FROM tbl_joborder_stock WHERE job_order_stock_id=".$job_order_stock_id."";
	$db->query_execute($sqldel);
	
	$sqldel="DELETE FROM tbl_joborder_stock_roll WHERE job_order_stock_id=".$sqlstockD['job_order_stock_id']."";
	$db->query_execute($sqldel);
}
//exit;

foreach($stock_item_id as $stock_item_id_temp)
{
	$stock_item_id_new[]=$stock_item_id_temp;
}
$i=0;
foreach($assignment_meterial_id as $assignment_meterial_id_single)
{
	$assignment_size_id_single=$assignment_size_id[$i];
	$stock_item_id_single=$stock_item_id_new[$i];
	
	$size_id_single=$size_id[$i];
	$newqty_single=$newqty[$i];
	$h_total_single=$h_total[$i];
	$uom_id_single=$uom_id[$i];
	$item_id_single=$item_id[$i];
	
	/*if($h_total_single>=$newqty_single)
		$assigned_qty=$newqty_single;
	else
		$assigned_qty=$h_total_single;*/
	
	$sqlinsert="INSERT INTO tbl_joborder_stock (joborder_id, assignment_id, assignment_meterial_id, stock_item_id, assignment_size_id, size_id, required_qty, assigned_qty, cdate) VALUES ($joborder_id, $assignment_id, $assignment_meterial_id_single, $stock_item_id_single, $assignment_size_id_single, $size_id_single, $newqty_single, '$h_total_single', NOW())";
	$assigned_qty="";
	$job_order_stock_id=$db->record_insert($sqlinsert);
	if($uom_id_single==4 || $uom_id_single==7)
	{
		$tempstocks="stocks".$i;
		foreach($$tempstocks as $tempstock)
		{
			$sqlvalue="SELECT * FROM tbl_stock_item_rolls WHERE stock_item_roll_id=$tempstock";
			$sqlvalueQ=$db->record_select($sqlvalue);
			$total_yards_roll=$sqlvalueQ[0]['yards'];
			$total_meters_roll=$sqlvalueQ[0]['meters'];

			
			$sqlinner="INSERT INTO tbl_joborder_stock_roll (job_order_stock_id, stock_item_roll_id, stock_item_id, item_id, used_yards, used_meters) VALUES ($job_order_stock_id, $tempstock, $stock_item_id_single, $item_id_single, '$total_yards_roll', '$total_meters_roll')";
			$job_order_stock_roll_id=$db->query_execute($sqlinner);
			if($job_order_stock_roll_id)
			{
				$sqlupdatevalue="UPDATE tbl_stock_item_rolls SET is_used=1, is_full_used=1 WHERE stock_item_roll_id=$tempstock";
				$sqlupdatevalueQ=$db->record_select($sqlupdatevalue);
			}
		}
		$tempstock="";
		
	}
	else
	{
		$tempstocks="stocks".$i;
		//$stock_item_id=$$tempstocks;
		
		foreach($$tempstocks as $stock_item_id)
		{
			$stock_item_id_temp=explode("-",$stock_item_id);
			if(count($stock_item_id_temp)>1)
			$stock_item_id=$stock_item_id_temp[2];
			else
			$stock_item_id=$stock_item_id_temp[0];
			
			$sqlstockItems="SELECT * FROM tbl_stock_items WHERE tbl_stock_items.stock_item_id=".$stock_item_id."";
			$sqlstockItemsQ=$db->record_select($sqlstockItems);
			$stock_quantity=$sqlstockItemsQ[0]['stock_quantity'];
			
			$remaining_stock_quantity=$stock_quantity-$h_total_single;
			if($remaining_stock_quantity<0)
			{
				$remaining_stock_quantity=0;
			}
			
			// to update
			$sqlupdate="UPDATE tbl_stock_items SET stock_quantity=$remaining_stock_quantity WHERE stock_item_id=".$stock_item_id."";
			$db->query_execute($sqlupdate);
		}	
	}
	
	
$i++;
}
?>
<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $mid;?>&m=<?php echo $m;?>" >
    <input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
    <input type="hidden" name="msg" id="msg" value="Record Inserted successfully" /> 
</form>
<script>
  document.frmsuc.submit();
</script>
<?php 
exit;
?>