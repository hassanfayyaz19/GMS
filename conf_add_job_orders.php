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


if($joborder_status=="on")
	$joborder_status='Enable';
else
	$joborder_status='Disable';


$uomofsizeTemp="order_units";
foreach($$uomofsizeTemp as $key => $value)
$order_units_temp[]=$value;
$assignment_date=str_replace("/","-",$assignment_date);
$completion_date=str_replace("/","-",$completion_date);

$joborder_assign_date=date("Y-m-d",strtotime($assignment_date));
$joborder_complete_date=date("Y-m-d",strtotime($completion_date));

/*print_r($sizecheck);
print_r($order_units);
exit;*/

if(!isset($_POST['cmdType']))
{
	$todatdate=date("dmy");
	// to getlast maxId
	$sqlclientJobOrder="SELECT MAX(joborder_id) as joborder_id FROM tbl_joborder";
	$sqlclientJobOrderD=$db->record_select($sqlclientJobOrder);
	$joborder_new_no=($sqlclientJobOrderD[0]['joborder_id'])+1;
	$joborder_no="J".$todatdate."-".$joborder_new_no;
	
	
	$sqlinsert="INSERT INTO tbl_joborder (joborder_no, joborder_name, client_id, assignment_id, supervisor_id, joborder_assign_date, joborder_complete_date, joborder_status, joborder_created_by, joborder_created_on) VALUES ('$joborder_no', '$joborder_name', '$client_id','$assignment_id', '$supervisor_id', '$joborder_assign_date','$joborder_complete_date' , 'Enable', $session_login_id, NOW())";
	$joborder_id=$db->record_insert($sqlinsert);
	if($joborder_id>0)
	{
		$k=0;
		foreach($sizecheck as $assignment_size_id)
		{
			$order_units_new=$order_units_temp[$k];
			if($order_units_new!="")
			{
				$sqluser="INSERT INTO tbl_joborder_size (joborder_id, assignment_size_id, joborder_units) VALUES ($joborder_id, $assignment_size_id, $order_units_new)";
				$joborder_size_id=$db->record_insert($sqluser);
				
				// to get attribute values from assigment
				$sqlassignmentattr="SELECT * FROM tbl_assignment_attribute WHERE assignment_size_id=$assignment_size_id";
				$sqlassignmentattrQ=$db->record_select($sqlassignmentattr);
				foreach($sqlassignmentattrQ as $sqlassignmentattrD)
				{
					$sqlinsertJobOrderAttr="INSERT INTO tbl_joborder_size_attribute (joborder_id, assignment_size_id, attribute_id, attribute_price, staff_id, receive, damage, complete, attribute_price_total) VALUES ($joborder_id, $assignment_size_id, ".$sqlassignmentattrD['attribute_id'].", '".$sqlassignmentattrD['attribute_price']."', '','','','','')";
					$db->record_insert($sqlinsertJobOrderAttr);
				}
				
			}
			$k++;
			$order_units_new="";
		}
		?>
			<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=393&cmdType=edit&mid=<?php echo $joborder_id;?>&m=<?php echo $m;?>" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Record Inserted successfully" /> 
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
				<input type="hidden" name="msg" id="msg" value="Error try again" /> 
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

	$sqlinsert="UPDATE tbl_joborder SET  joborder_name='$joborder_name', client_id='$client_id', assignment_id='$assignment_id', supervisor_id='$supervisor_id', joborder_assign_date='$joborder_assign_date', joborder_complete_date='$joborder_complete_date', joborder_status='$joborder_status' WHERE joborder_id=$mid";
	$joborder_id=$db->query_execute($sqlinsert);
	if($joborder_id>0)
	{
		// to remove old record
		$sqldel="DELETE FROM tbl_joborder_size WHERE joborder_id=$mid";
		$db->query_execute($sqldel);
		
		// to remove old record
		$sqldel="DELETE FROM tbl_joborder_size_attribute WHERE joborder_id=$mid";
		$db->query_execute($sqldel);
		
		$k=0;
		foreach($sizecheck as $assignment_size_id)
		{
			$order_units_new=$order_units_temp[$k];
			if($order_units_new!="")
			{
				$sqluser="INSERT INTO tbl_joborder_size (joborder_id, assignment_size_id, joborder_units) VALUES ($mid, $assignment_size_id, $order_units_new)";
				$joborder_size_id=$db->record_insert($sqluser);
				
				// to get attribute values from assigment
				$sqlassignmentattr="SELECT * FROM tbl_assignment_attribute WHERE assignment_size_id=$assignment_size_id";
				$sqlassignmentattrQ=$db->record_select($sqlassignmentattr);
				foreach($sqlassignmentattrQ as $sqlassignmentattrD)
				{
					$sqlinsertJobOrderAttr="INSERT INTO tbl_joborder_size_attribute (joborder_id, assignment_size_id, attribute_id, attribute_price, staff_id, receive, damage, complete, attribute_price_total) VALUES ($joborder_id, $assignment_size_id, ".$sqlassignmentattrD['attribute_id'].", '".$sqlassignmentattrD['attribute_price']."', '','','','','')";
					$db->record_insert($sqlinsertJobOrderAttr);
				}
			}
			$k++;
			$order_units_new="";
		}
		?>
			<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $mid;?>&m=<?php echo $m;?>" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Record Inserted successfully" /> 
			</form>
		  <script>
			  document.frmsuc.submit();
		  </script>
		<?php 
		exit;
	}
}
//chanay akhroat meva badam  pista
?>