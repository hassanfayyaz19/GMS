<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;

?>
<select class="form-control select2 itemName" name="item_name<?php echo $x;?>" id="item_name<?php echo $x;?>" rel="<?php echo $x;?>">
	<?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['item_id'];?>" <?php if($sqleventsD['item_id']==$item_id) echo "selected";?>><?php echo $sqleventsD['item_name'];?></option><?php }?>
</select>



