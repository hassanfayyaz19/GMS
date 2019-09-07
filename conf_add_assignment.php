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

	// to creat assignment code
	$sqlclient="SELECT * FROM tbl_users WHERE log_id=$client_id";
	$sqlclientD=$db->record_select($sqlclient);
	$company=$sqlclientD[0]['user_first_name'];
	
	$companyArr=explode(" ",$company);
	$companyArrTtl=count($companyArr);
	$todatdate=date("dmy");
	if($companyArrTtl>1)
	{
		$firstchar=substr($companyArr[0],0,1);
		$secondchar=substr($companyArr[1],0,1);
		$finalName=$firstchar.$secondchar.$todatdate;
	}
	else
	{
		$firstchar=substr($companyArr[0],0,1);
		$secondchar=substr($companyArr[0],-1,1);
		$finalName=$firstchar.$secondchar.$todatdate;
	}
	// to get MAX assignments
	$sqlclientAssignment="SELECT MAX(assignment_id) as assignment_id,assignment_code FROM tbl_assignment WHERE client_id=$client_id";
	$sqlclientAssignmentD=$db->record_select($sqlclientAssignment);
	$assignment_id=$sqlclientAssignmentD[0]['assignment_id'];
	
	$sqlclientAssignmentcode="SELECT assignment_code FROM tbl_assignment WHERE assignment_id=".$assignment_id."";
	$sqlclientAssignmentcodeD=$db->record_select($sqlclientAssignmentcode);
	$assignment_code=$sqlclientAssignmentcodeD[0]['assignment_code'];
	if($assignment_id!="")
	{
		$newIdTemp=explode("-",$assignment_code);
		$newId=$newIdTemp[1]+1;
		$assignment_code=$finalName."-".$newId;
	}
	else
	{
		$newId="-1";
		$assignment_code=$finalName.$newId;
	}

	if($_FILES['assignment_image']['name']!="")
	{
		$random_no=rand(1,1000)*2;
		$uploadImageName=$_FILES['assignment_image']['name'];
		$uploadPath = "plugins/images/assignment/".$random_no."_".basename($uploadImageName);
		move_uploaded_file($_FILES['assignment_image']['tmp_name'], $uploadPath);
		$originalPicture = str_replace(" ","-",$uploadImageName);	
		$newPicture =($random_no."_".$originalPicture);
	}
	else
	{
		$newPicture = "";
	}
	
	//echo $assignment_code;
	
	/*print "<pre>";
	$colorofsizeTemp="colorofsize".$i;
	$product_pictureofsizeTemp="product_pictureofsize".$i."";
	
	$attributepriceofsizeTemp="attributepriceofsize".$i;
	$itemnameofsizeTemp="itemnameofsize".$i;
	
	print_r($$colorofsizeTemp);
	print_r($$itemnameofsizeTemp);
	//print_r($$colorofsizeTemp);
	//print_r($$attributepriceofsizeTemp);*/
	
	$sqlassignment="INSERT INTO tbl_assignment (assignment_code, assignment_name, client_id, assignment_total_size, assignment_picture, assignment_status, assignment_created_on, assignment_created_by) VALUES ('$assignment_code', '$assignment_name', $client_id, $ttlsize, '$newPicture', 'Enable', NOW(), $session_login_id)";
	$assignment_id=$db->record_insert($sqlassignment);
	if($assignment_id)
	{
		for($i=0;$i<$ttlsize;$i++)
		{
			$itemnameofsizeTemp="itemnameofsize".$i;
			$attributeidofsizeTemp="attributeidofsize".$i;
			
			$totalnames=count($$itemnameofsizeTemp);
			/*$itemnameofsizeTemp="itemnameofsize".$i;
			$uomofsizeTemp="uomofsize".$i;
			$product_pictureofsizeTemp="product_pictureofsize".$i."";
			$colorofsizeTemp="colorofsize".$i;
			$firstquantityofsizeTemp="firstquantityofsize".$i;
			$attributepriceofsizeTemp="attributepriceofsize".$i;*/
			if($totalnames>0)
			{
				$sizeId="size".$i;
				$sqlas="INSERT INTO tbl_assignment_size (assignment_id, size_id) VALUES ($assignment_id,".$$sizeId.")";
				$size_id=$db->record_insert($sqlas);
				
				$newuomofsize="";
				$uomofsizeTemp="uomofsize".$i;
				foreach($$uomofsizeTemp as $key => $value)
					$newuomofsize[]=$value;
				
				$newproductpicture="";
				$product_pictureofsizeTemp="product_pictureofsize".$i."";
				foreach($$product_pictureofsizeTemp as $key => $value)
					$newproductpicture[]=$value;
					
				$newproductqty="";
				$firstquantityofsizeTemp="firstquantityofsize".$i;
				foreach($$firstquantityofsizeTemp as $key => $value)
					$newproductqty[]=$value;	
				
				//print_r($newproductqty);
				
				$newproductcolor="";
				$colorofsizeTemp="colorofsize".$i;	
				foreach($$colorofsizeTemp as $key => $value)
					$newproductcolor[]=$value;
				
				
				
				$p=0;
				foreach($$itemnameofsizeTemp as $itemnameofsize)
				{
					// to insert into material
					$item_id=$itemnameofsize;
					$uom_id=$newuomofsize[$p];
					$product_picture=$newproductpicture[$p];
					$product_color=$newproductcolor[$p];
					$assignment_quantity=$newproductqty[$p];
					
					if($product_picture!="")
					{
						$stock_item_id=$product_picture;
					}
					else
					{
						$stock_item_id=$product_color;
					}
					
					
				echo 	$sqlmaterial="INSERT INTO tbl_assignment_material (assignment_size_id, item_id, uom_id, stock_item_id, assignment_quantity, assignment_material_status) VALUES ($size_id, $item_id, $uom_id, $stock_item_id, $assignment_quantity, 'Enable')";
				exit();
					$assignment_material_id=$db->record_insert($sqlmaterial);
					
					$item_id="";
					$uom_id="";
					$product_picture="";
					$product_color="";
					$assignment_quantity="";
					
					$p++;	
				}
			
				// to enter record in attribute
				$newattributeprice="";
				$attributepriceofsizeTemp="attributepriceofsize".$i;
				foreach($$attributepriceofsizeTemp as $key => $value)
					$newattributeprice[]=$value;
					
				
				$q=0;
				foreach($$attributeidofsizeTemp as $attributeidofsize)
				{
					$attribute_price=$newattributeprice[$q];
					if($attribute_price!="")
					{
						$sqlattribute="INSERT INTO tbl_assignment_attribute (assignment_size_id, attribute_id, attribute_price) VALUES ($size_id, $attributeidofsize, $attribute_price)";
						$assignment_attribute_id=$db->record_insert($sqlattribute);
					}
					$attribute_price="";
				$q++;
				}
			}
			
			
		}
		
		
		?>
		<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Assignment created successfully" /> 
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

	if($_FILES['assignment_image']['name']!="")
	{
		$random_no=rand(1,1000)*2;
		$uploadImageName=$_FILES['assignment_image']['name'];
		$uploadPath = "plugins/images/assignment/".$random_no."_".basename($uploadImageName);
		move_uploaded_file($_FILES['assignment_image']['tmp_name'], $uploadPath);
		$originalPicture = str_replace(" ","-",$uploadImageName);	
		$newPicture =($random_no."_".$originalPicture);
		
		$uploadPathold = "plugins/images/assignment/".$old_assignment_picture;
		@unlink($uploadPathold);
	}
	else
	{
		$newPicture = $old_assignment_picture;
	}

	$sqlsizesold="SELECT * FROM tbl_assignment_size, tbl_size WHERE tbl_assignment_size.assignment_id=$mid AND tbl_assignment_size.size_id=tbl_size.size_id";

	$sqlsizesoldQ=$db->record_select($sqlsizesold);
	foreach($sqlsizesoldQ as $sqlsizesoldD)
	{
		$old_size_id=$sqlsizesoldD['assignment_size_id'];
		// to delete old record
		$sqldelmaterial="DELETE FROM tbl_assignment_material WHERE assignment_size_id=$old_size_id";
		if($db->query_execute($sqldelmaterial))
		{
			$sqldelattribute="DELETE FROM tbl_assignment_attribute WHERE assignment_size_id=$old_size_id";
			if($db->query_execute($sqldelattribute))
			{
				$sqlsize="DELETE FROM tbl_assignment_size WHERE assignment_size_id=$old_size_id";
				$db->query_execute($sqlsize);
			}
		}
	}
	
	
	
	$sqlassignment="UPDATE tbl_assignment set assignment_name='$assignment_name', client_id=$client_id, assignment_total_size=$ttlsize, assignment_picture='$newPicture' WHERE assignment_id=$mid";
	
	if($db->query_execute($sqlassignment))
	{
		for($i=0;$i<$ttlsize;$i++)
		{
			$itemnameofsizeTemp="itemnameofsize".$i;
			$attributeidofsizeTemp="attributeidofsize".$i;
			
			$totalnames=count($$itemnameofsizeTemp);
			if($totalnames>0)
			{
				$sizeId="size".$i;
				$sqlas="INSERT INTO tbl_assignment_size (assignment_id, size_id) VALUES ($mid,".$$sizeId.")";
				$size_id=$db->record_insert($sqlas);
				
				$newuomofsize="";
				$uomofsizeTemp="uomofsize".$i;
				foreach($$uomofsizeTemp as $key => $value)
					$newuomofsize[]=$value;
				
				$newproductpicture="";
				$product_pictureofsizeTemp="product_pictureofsize".$i."";
				foreach($$product_pictureofsizeTemp as $key => $value)
					$newproductpicture[]=$value;
					
				$newproductqty="";
				$firstquantityofsizeTemp="firstquantityofsize".$i;
				foreach($$firstquantityofsizeTemp as $key => $value)
					$newproductqty[]=$value;	
				
				//print_r($newproductqty);
				
				$newproductcolor="";
				$colorofsizeTemp="colorofsize".$i;	
				foreach($$colorofsizeTemp as $key => $value)
					$newproductcolor[]=$value;
				
				
				
				$p=0;
				foreach($$itemnameofsizeTemp as $itemnameofsize)
				{
					// to insert into material
					$item_id=$itemnameofsize;
					$uom_id=$newuomofsize[$p];
					$product_picture=$newproductpicture[$p];
					$product_color=$newproductcolor[$p];
					$assignment_quantity=$newproductqty[$p];
					
					if($product_picture!="")
					{
						$stock_item_id=$product_picture;
					}
					else
					{
						$stock_item_id=$product_color;
					}
					
					
					$sqlmaterial="INSERT INTO tbl_assignment_material (assignment_size_id, item_id, uom_id, stock_item_id, assignment_quantity, assignment_material_status) VALUES ($size_id, $item_id, $uom_id, $stock_item_id, $assignment_quantity, 'Enable')";
					$assignment_material_id=$db->record_insert($sqlmaterial);
					
					$item_id="";
					$uom_id="";
					$product_picture="";
					$product_color="";
					$assignment_quantity="";
					
					$p++;	
				}
			
				// to enter record in attribute
				$newattributeprice="";
				$attributepriceofsizeTemp="attributepriceofsize".$i;
				foreach($$attributepriceofsizeTemp as $key => $value)
					$newattributeprice[]=$value;
					
				
				$q=0;
				foreach($$attributeidofsizeTemp as $attributeidofsize)
				{
					$attribute_price=$newattributeprice[$q];
					if($attribute_price!="")
					{
						$sqlattribute="INSERT INTO tbl_assignment_attribute (assignment_size_id, attribute_id, attribute_price) VALUES ($size_id, $attributeidofsize, $attribute_price)";
						$assignment_attribute_id=$db->record_insert($sqlattribute);
					}
					$attribute_price="";
				$q++;
				}
			}
			
			
		}
		
		
		?>
		<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>&mid=<?php echo $mid;?>&cmdType=edit" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Assignment created successfully" /> 
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