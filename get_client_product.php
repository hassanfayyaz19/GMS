<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
    $$name=$val;

/*session_start();
$_SESSION['clientID']=$client_id;*/
$assignmentQuery="SELECT * FROM tbl_items,tbl_stock,tbl_stock_items WHERE tbl_items.item_id=tbl_stock_items.item_id AND tbl_stock.stock_id=tbl_stock_items.stock_id AND tbl_stock.client_id=$client_id  AND status='Enable' GROUP BY tbl_stock_items.item_id";
$assignmentQueryQ=$db->record_select($assignmentQuery);
?>

<select class="form-control select2 itemCode" name="itemnameofsize0[]" id="itemname0ofsize0" rel="0" reli="0">
    <script type="text/javascript">
        $(".select2").select2();
        $('#loading').html("").hide();
    </script>
    <option value="0">Select Product</option>
    <?php
    foreach($assignmentQueryQ as $assignmentQueryD)
    {
        ?>
        <option class="form-control" value="<?php echo $assignmentQueryD['item_id']; ?>"><?php echo $assignmentQueryD['item_code'].$_SESSION['clientID'];?></option>
        <?php
    }
    ?>
</select>
