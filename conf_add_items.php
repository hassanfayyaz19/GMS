<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");
include "class/cls_forms.php";

$chkp=$_GET['chkp'];
$m=$_GET['m'];

foreach($_POST as $name => $val)
$$name=$val;

if(!isset($_POST['cmdType']))
{
	$i=0;
	$totalcode=count($item_code);
	foreach($item_code as $item_codeNew)
	{
		$item_nameNew=$item_name[$i];
		$uom_idNew=$uom_id[$i];
		
		if($item_codeNew!="")
		{
			$sqlindetail="INSERT INTO tbl_items (uom_id, item_code, item_name, status, created_by, created_on) VALUES ($uom_idNew, '$item_codeNew', '$item_nameNew', 'Enable', $session_login_id, NOW())";
			$invoice_detail_id=$db->record_insert($sqlindetail);
			$i++;
		}
		
		$item_nameNew="";
		$uom_idNew="";
		
	}

	if($i==$totalcode)
	{
		
		?>
			<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="All Items Added successfully" /> 
			</form>
		  <script>
			  document.frmsuc.submit();
		  </script>
		<?php 
		exit;
	}
	else
	{
		?>
            <form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>" >
                <input type="hidden" name="msg_type" id="msg_type" value="alert alert-danger alert-dismissable" /> 
                <input type="hidden" name="msg" id="msg" value="Few Items added" /> 
            </form>
          <script>
              document.frmsuc.submit();
          </script>
        <?php 
        exit;
	}
}
else	// if Account edit
{

	$sqlinsert="UPDATE tbl_items SET uom_id='$edit_uom_id', item_code='$edit_item_code', item_name='$edit_item_name', status='$item_sts' WHERE item_id=$item_id";
	if($db->query_execute($sqlinsert))
	{
		$arrayerror=array("1", '<div class="alert alert-success"> Record Updated Successfully. </div>');

	}
	else
	{
		$arrayerror=array("0", '<div class="alert alert-danger"> Error try again </div>');
	}
	echo json_encode($arrayerror);
}
//chanay akhroat meva badam  pista
?>