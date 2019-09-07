<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;

?>
<select class="form-control"  name="uom<?php echo $x;?>" id="uom<?php echo $x;?>" oninput="positionfreaze(0);">
    <?php 
    $uomQuery="select * from tbl_items,tbl_uom where tbl_items.uom_id=tbl_uom.uom_id AND tbl_uom.uom_status='Enable' AND tbl_items.item_id=$item_id";
    $uomQueryselected=$db->record_select($uomQuery);
    foreach($uomQueryselected as $uom){
    ?>
        <option value="<?php echo $uom['uom_id'];?>"><?php echo $uom['uom'];?></option>
    <?php } ?>
</select>



