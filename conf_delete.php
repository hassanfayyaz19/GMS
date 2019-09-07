<?php
include "class/cls_db.php";
$db = new db("");
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");

//print_r($_REQUEST);
foreach($_POST as $name => $val )
$$name=$val;

$rid=$_GET["rid"];
$t=$_GET["t"];
$pk=$_GET["pk"];

if($_POST["cmdType"]=="deluomSinle")   //Delete UOM Record
{
	$chkp=$_GET['chkp'];
	$m=$_GET['m'];
	$uom_id=$_POST['uom_id'];
	

	$sqluom="SELECT * FROM tbl_assignment_material WHERE uom_id=$uom_id";
	$sqluomD=$db->record_total($sqluom);

	if($sqluomD==0)
	{
	    /*echo $sqluomD;
	    exit();*/
        $sqldelete="DELETE FROM tbl_uom WHERE uom_id=$uom_id";
        if($db->query_execute($sqldelete))
        {
            $resp['uom'] = $sqluomD[0]['uom'];
            $resp['msg'] = "1";
            echo json_encode($resp);
            //exit;
        }
        else
        {
            $resp['uom'] = $sqldelete;
            $resp['msg'] = "0";
            echo json_encode($resp);
            //exit;
        }
    }else
        {
            $resp['msg'] = "2";
            echo json_encode($resp);
            /*exit();*/
        }
	


}
elseif($_POST["cmdType"]=="dellocationSinle")   //Delete UOM Record
{
	$chkp=$_GET['chkp'];
	$m=$_GET['m'];
	$location_id=$_POST['location_id'];
	
	// to get old UOM
	$sqluom="SELECT * FROM tbl_location WHERE location_id=$location_id";
	$sqluomD=$db->record_select($sqluom);
	
	$sqldelete="DELETE FROM tbl_location WHERE location_id=$location_id";
	if($db->query_execute($sqldelete))
	{
		$resp['location'] = $sqluomD[0]['location'];
		$resp['msg'] = "1";
		echo json_encode($resp);
		//exit;
	}
	else
	{
		$resp['location'] = $sqldelete;
		$resp['msg'] = "0";
		echo json_encode($resp);
		//exit;
	}

}
elseif($_POST["cmdType"]=="delattributeSinle")   //Delete Attribute Record
{
	$chkp=$_GET['chkp'];
	$m=$_GET['m'];
	$location_id=$_POST['attribute_id'];
	
	// to get old UOM
	$sqluom="SELECT * FROM tbl_attribute WHERE attribute_id=$attribute_id";
	$sqluomD=$db->record_select($sqluom);
	
	$sqldelete="DELETE FROM tbl_attribute WHERE attribute_id=$attribute_id";
	if($db->query_execute($sqldelete))
	{
		$resp['attribute'] = $sqluomD[0]['attribute'];
		$resp['msg'] = "1";
		echo json_encode($resp);
		//exit;
	}
	else
	{
		$resp['attribute'] = $sqluomD[0]['attribute'];
		$resp['msg'] = "0";
		echo json_encode($resp);
		//exit;
	}

}
elseif($_POST["cmdType"]=="delsizeSingle")   //Delete Size Record
{
	$chkp=$_GET['chkp'];
	$m=$_GET['m'];
	$size_id=$_POST['size_id'];
	
	// to get old UOM
	$sqluom="SELECT * FROM tbl_size WHERE size_id=$size_id";
	$sqluomD=$db->record_select($sqluom);
	
	$sqldelete="DELETE FROM tbl_size WHERE size_id=$size_id";
	if($db->query_execute($sqldelete))
	{
		$resp['size'] = $sqluomD[0]['size'];
		$resp['msg'] = "1";
		echo json_encode($resp);
		//exit;
	}
	else
	{
		$resp['size'] = $sqluomD[0]['size'];
		$resp['msg'] = "0";
		echo json_encode($resp);
		//exit;
	}

}
elseif($_POST["cmdType"]=="delattrstaffSingle")   //Delete Attribute Staff Record
{
	$chkp=$_GET['chkp'];
	$m=$_GET['m'];
	$log_id=$_POST['log_id'];
	
	// to get old UOM
	$sqluser="SELECT * FROM tbl_users WHERE log_id=$log_id";
	$sqluserD=$db->record_select($sqluser);
	
	$sqldelete="DELETE FROM tbl_users_attributes WHERE log_id=$log_id";
	if($db->query_execute($sqldelete))
	{
		$sqldelete="DELETE FROM tbl_users WHERE log_id=$log_id";
		if($db->query_execute($sqldelete))
		{
			$sqldelete="DELETE FROM tbllogin WHERE log_id=$log_id";
			$db->query_execute($sqldelete);
			
			$resp['user_first_name'] = $sqluserD[0]['user_first_name'];
			$resp['msg'] = "1";
			echo json_encode($resp);
			//exit;
		}
		else
		{
			$resp['user_first_name'] = $sqluserD[0]['user_first_name'];
			$resp['msg'] = "0";
			echo json_encode($resp);
			//exit;
		}
	}
	else
	{
		$resp['user_first_name'] = $sqluserD[0]['user_first_name'];
		$resp['msg'] = "0";
		echo json_encode($resp);
	}
}

elseif($_POST["cmdType"]=="deljoborderSingle")   //Delete Job Order Record
{
	$chkp=$_GET['chkp'];
	$m=$_GET['m'];
	$joborder_id=$_POST['joborder_id'];
	
	// to get old UOM
	$sqluom="SELECT * FROM tbl_joborder WHERE joborder_id=$joborder_id";
	$sqluomD=$db->record_select($sqluom);
	
	$sqldelete="DELETE FROM tbl_joborder WHERE joborder_id=$joborder_id";
	if($db->query_execute($sqldelete))
	{
		// to delete job order size
		$sqldelsize="DELETE FROM tbl_joborder_size WHERE joborder_id=$joborder_id";
		$db->query_execute($sqldelsize);
		
		
		$resp['joborder_name'] = $sqluomD[0]['joborder_name'];
		$resp['msg'] = "1";
		echo json_encode($resp);
		//exit;
	}
	else
	{
		$resp['joborder_name'] = $sqluomD[0]['joborder_name'];
		$resp['msg'] = "0";
		echo json_encode($resp);
		//exit;
	}

}

elseif($_POST["cmdType"]=="delclientSingle")   //Delete client
{
	$chkp=$_GET['chkp'];
	$m=$_GET['m'];
	$log_id=$_POST['log_id'];
	
	// to check client have any joborder or not
	$sqluom="SELECT * FROM `tbl_joborder` WHERE supervisor_id=$log_id";
	$sqluomD=$db->record_total($sqluom);
	if($sqluomD==0)
	{
        /*echo json_encode($sqluomD);
        exit();*/
        $sqldelete="DELETE FROM tbl_users WHERE log_id=$log_id";
        if($db->query_execute($sqldelete))
        {
            $sqldelete="Delete FROM tbllogin WHERE log_id=$log_id";
            $db->query_execute($sqldelete);

            $resp['user_first_name'] = $log_id;
            $resp['msg'] = "1";
            echo json_encode($resp);
            /*exit;*/
        }
        else
        {
            $resp['user_first_name'] = $log_id;
            $resp['msg'] = "0";
            echo json_encode($resp);
            /*exit;*/
        }

    }else
        {

            $resp['msg'] = "2";
            echo json_encode($resp);
            /*exit();*/
        }
	


}
elseif($_POST["cmdType"]=="delassignmentSingle")   //Delete Assignment Record
{
	$chkp=$_GET['chkp'];
	$m=$_GET['m'];
	$assignment_id=$_POST['assignment_id'];
	
	$sqleventassignment="SELECT * FROM tbl_assignment WHERE assignment_id=$assignment_id";
	$sqleventassignmentQ=$db->record_select($sqleventassignment);
	
	$sqldelassignment="SELECT * FROM tbl_assignment_size WHERE assignment_id=$assignment_id";
	$sqldelassignmentD=$db->record_select($sqldelassignment);
	foreach($sqldelassignmentD as $sqldelassignmentQ)
	{
		$sqldelMaterial="DELETE FROM tbl_assignment_material WHERE assignment_size_id=".$sqldelassignmentQ['assignment_size_id']."";
		$db->query_execute($sqldelMaterial);
		
		$sqldelAttribute="DELETE FROM tbl_assignment_attribute WHERE assignment_size_id=".$sqldelassignmentQ['assignment_size_id']."";
		$db->query_execute($sqldelAttribute);
		
		$sqldelSize="DELETE FROM tbl_assignment_size WHERE assignment_size_id=".$sqldelassignmentQ['assignment_size_id']."";
		$db->query_execute($sqldelSize);
	}

	
	$sqldelete="DELETE FROM tbl_assignment WHERE assignment_id=$assignment_id";
	if($db->query_execute($sqldelete))
	{
		$uploadPathold = "plugins/images/assignment/".$sqleventassignmentQ[0]['assignment_picture'];
		@unlink($uploadPathold);
		
		$resp['assignment'] = $sqleventassignmentQ[0]['assignment_name'];
		$resp['msg'] = "1";
		echo json_encode($resp);
		//exit;
	}
	else
	{
		$resp['assignment'] = $sqleventassignmentQ[0]['assignment_name'];
		$resp['msg'] = "0";
		echo json_encode($resp);
		//exit;
	}

}
?>