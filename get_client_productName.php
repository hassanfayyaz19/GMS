<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
    $$name=$val;
$assignmentQuery="SELECT * FROM tbl_items,tbl_stock,tbl_stock_items WHERE tbl_items.item_id=tbl_stock_items.item_id AND tbl_stock.stock_id=tbl_stock_items.stock_id AND tbl_stock.client_id=$client_id  AND status='Enable' GROUP BY tbl_stock_items.item_id";
$assignmentQueryQ=$db->record_select($assignmentQuery);
?>
<select class="form-control select2 itemName"
        name="itemnameofsize0[]" id="itemname0ofsize0"
        rel="0" reli="0">
    <script type="text/javascript">
        $('#loading').html("").hide();
    </script>
    <option value="0">Select Product Code</option>
    <?php
    foreach($assignmentQueryQ as $assignmentQueryD)
    {
        ?>
        <option class="form-control" value="<?php echo $assignmentQueryD['item_id']; ?>"><?php echo $assignmentQueryD['item_name'];?></option>
        <?php
    }
    ?>
</select>



