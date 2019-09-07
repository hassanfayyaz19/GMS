<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;

?>
<select class="form-control select2 itemName" name="itemname<?php //echo $i;?>ofsize<?php echo $l;?>[]" id="itemname<?php echo $i;?>ofsize<?php echo $l;?>" rel="<?php echo $l;?>" reli="<?php echo $i;?>">
	<?php $sqlevents="SELECT * FROM tbl_items,tbl_stock,tbl_stock_items WHERE tbl_items.item_id=tbl_stock_items.item_id AND tbl_stock.stock_id=tbl_stock_items.stock_id AND tbl_stock.client_id=$client_id  AND status='Enable' GROUP BY tbl_stock_items.item_id";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['item_id'];?>" <?php if($sqleventsD['item_id']==$item_id) echo "selected";?>><?php echo $sqleventsD['item_name'];?></option><?php }?>
</select>



