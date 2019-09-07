<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;


$itemQuery="SELECT * FROM tbl_items, tbl_stock_items, tbl_stock WHERE tbl_stock_items.item_id=tbl_items.item_id AND tbl_stock_items.stock_id=tbl_stock.stock_id AND tbl_items.status='Enable' AND tbl_items.item_id='".$item_id."'";
$itemQueryselected=$db->record_select($itemQuery);
?>
<select class="form-control" name="color<?php //echo $i;?>ofsize<?php echo $l;?>[]" id="color<?php echo $i;?>ofsize<?php echo $l;?>">
    <option value="0">-Select Color-</option>
   <?php
    foreach($itemQueryselected as $costoum)
    {
        if($costoum['stock_image']==""){
    ?>
    <option class="form-control" value="<?php echo $costoum['stock_item_id']; ?>" style="background:<?php echo $costoum['stock_color'];?>"><?php echo $costoum['stock_color'];?></option>
<?php }
    } 
    ?>
</select>



