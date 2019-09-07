<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;

if($uom==4)
	$uomselect="meters";
elseif($uom==7)
	$uomselect="yards";

if($uom==4 || $uom==7)
{
	$stock_item_roll_id_all=explode(",",$stock_item_roll_id_temp);
	$totalAmount=0;
	foreach($stock_item_roll_id_all as $stock_item_roll_id)
	{
		$sqlstockItems="SELECT * FROM tbl_stock_item_rolls WHERE stock_item_roll_id=".$stock_item_roll_id."";
		$sqlstockItemsQ=$db->record_select($sqlstockItems);
		$totalAmount=$totalAmount+$sqlstockItemsQ[0][''.$uomselect.''];
	}
}
else
{
	$stock_item_roll_id_all=explode(",",$stock_item_roll_id_temp);
	$totalAmount=0;
	foreach($stock_item_roll_id_all as $stock_item_roll_id)
	{
		$sqlstockItems="SELECT * FROM tbl_stock_items WHERE stock_item_id=".$stock_item_roll_id."";
		$sqlstockItemsQ=$db->record_select($sqlstockItems);
		$totalAmount=$totalAmount+$sqlstockItemsQ[0]['stock_quantity'];
	}
}
$remainingQty=$totalAmount-$qty;
$resp['totalAmount'] = $totalAmount;
$resp['remainingQty'] = $remainingQty;
echo json_encode($resp);
?>



