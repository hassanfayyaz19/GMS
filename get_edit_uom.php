<?php
include "class/cls_db.php";
$db = new db();
include "class/cls_functions.php";
$GeneralFunctions = new sitefun();

foreach($_POST as $name => $val )
$$name=$val;

if($cmdType=="edit")
{
	$sqlQuery = "SELECT * FROM tbl_uom WHERE uom_id=$uom_id";
	$sqlQueryD = $db->record_select($sqlQuery);
	$uom=$sqlQueryD[0]['uom'];
}

?>
 <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <b>  UOM </b> 
			<input type="text" class="form-control" name="item_name" id="item_name" value="<?php echo $uom;?>" placeholder="UOM">
         </div>
    </div>
 </div>
  <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <b>  Status </b> 
			<?php echo $GeneralFunctions->getStatus("royalty_status", $royalty_status);?>
         </div>
    </div>
 </div>



