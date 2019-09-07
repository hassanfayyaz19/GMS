<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;


$assignmentQuery="SELECT * FROM tbl_assignment WHERE client_id=$client_id AND assignment_status='Enable'";
$assignmentQueryQ=$db->record_select($assignmentQuery);
?>
<div class="input-group-addon"><i class="fa fa-file-text"></i></div>
<select class="form-control" name="assignment_id" id="assignment_id">
	<script type="text/javascript">
		$('#loading').html("").hide();
	</script>
    <option value="0">-Select Assignment-</option>
   <?php
    foreach($assignmentQueryQ as $assignmentQueryD)
    {
    ?>
    	<option class="form-control" value="<?php echo $assignmentQueryD['assignment_id']; ?>"><?php echo $assignmentQueryD['assignment_name'];?></option>
<?php 
    } 
    ?>
</select>



