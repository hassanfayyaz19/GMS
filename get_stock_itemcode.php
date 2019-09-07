<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;

?>
<select class="form-control select2 itemCode" name="item_code<?php echo $x;?>" id="item_code<?php echo $x;?>" rel="<?php echo $x;?>">
	<?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['item_id'];?>" <?php if($sqleventsD['item_id']==$item_id) echo "selected";?>><?php echo $sqleventsD['item_code'];?></option><?php }?>
</select>



