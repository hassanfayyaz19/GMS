<?php
include "class/cls_db.php";
$db = new db('');

$chkp=$_GET['chkp'];
$m=$_GET['m'];
$mid=$_GET['mid'];


foreach($_POST as $name => $val)
$$name=$val;
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
	
	if($h_total_single>=$newqty_single)
		$assigned_qty=$newqty_single;
	else
		$assigned_qty=$h_total_single;
	
	$sqlinsert="INSERT INTO tbl_joborder_stock (joborder_id, assignment_id, assignment_meterial_id, stock_item_id, assignment_size_id, size_id, required_qty, assigned_qty, cdate) VALUES ($joborder_id, $assignment_id, $assignment_meterial_id_single, $stock_item_id_single, $assignment_size_id_single, $size_id_single, $newqty_single, '$assigned_qty', NOW())";
	$assigned_qty="";
	$job_order_stock_id=$db->record_insert($sqlinsert);
	if($uom_id_single==4 || $uom_id_single==7)
	{
		$tempstocks="stocks".$i;
		/*print("<pre>");
		print_r($$tempstocks);*/
		foreach($$tempstocks as $tempstock)
		{
			//echo $tempstock."<br />";
			// code to get roll value
			$sqlvalue="SELECT * FROM tbl_stock_item_rolls WHERE stock_item_roll_id=$tempstock";
			$sqlvalueQ=$db->record_select($sqlvalue);
			$total_yards_roll=$sqlvalueQ[0]['yards'];
			$total_meters_roll=$sqlvalueQ[0]['meters'];
		
			/*if($uom_id_single==4)
			{
				$meterValue="";
				$yardValue=0;
			}
			elseif($uom_id_single==7)
			{
				$meterValue=0;
				$yardValue="";
			}*/
			
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
			$sqlstockItems="SELECT * FROM tbl_stock_items WHERE tbl_stock_items.stock_item_id=".$stock_item_id."";
			$sqlstockItemsQ=$db->record_select($sqlstockItems);
			$stock_quantity=$sqlstockItemsQ[0]['stock_quantity'];
			
			$remaining_stock_quantity=$h_total_single-$newqty_single;
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