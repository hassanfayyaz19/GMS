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


$counter=$_POST['serial'];
$invLoop=count($counter);

if(!isset($_POST['cmdType']))
{
	$Query="insert into tbl_stock (stock_no, client_id, location_id, stock_status, created_by, created_on, created_time) VALUES ('','$client_id','$location_id','1','".$session_login_id."',now(),now())";
		$insertion=$db->record_insert($Query);
		if($insertion){	
		$stockNo="STOCK".date("dmy")."-".$insertion;
		//to update stock no
		$stockUpdate="UPDATE tbl_stock SET stock_no='$stockNo' WHERE stock_id=$insertion";
		$db->query_execute($stockUpdate);
		
		for($VarinvLoop=0;$VarinvLoop<$invLoop;$VarinvLoop++)
		{
			/*------------------------------Getting Form Data-----------------------*/
			$itemcode="item_code".$VarinvLoop;
			$itemcode=$_POST[$itemcode];
			$itemname="itemname".$VarinvLoop;
			$itemname=$_POST[$itemname];
			$stock_pictures="stock_pictures".$VarinvLoop;
			$stockcolor="stockcolor".$VarinvLoop;
			$stockcolor=$_POST[$stockcolor];
			$uom="uom".$VarinvLoop;
			$uom=$_POST[$uom];
			$position="position".$VarinvLoop;
			$position=$_POST[$position];
			$firstquantityh="firstquantityh".$VarinvLoop;
			$firstquantityh=$_POST[$firstquantityh];
			$secondquantityh="secondquantityh".$VarinvLoop;
			$secondquantityh=$_POST[$secondquantityh];
			
			$firstquantity="firstquantity".$VarinvLoop;
			$firstquantity=$_POST[$firstquantity];
			$secondquantity="secondquantity".$VarinvLoop;
			$secondquantity=$_POST[$secondquantity];
			
			
		
			/*------------------ inserting record in stock Table ------------------*/
			if($_FILES[$stock_pictures]['name']!="")
			{
				$random_no=rand(1,1000)*2;
				$uploadImageName=$_FILES[$stock_pictures]['name'];
				$uploadPath = "plugins/images/stock/".$random_no."_".basename($uploadImageName);
				move_uploaded_file($_FILES[$stock_pictures]['tmp_name'], $uploadPath);
				$originalPicture = str_replace(" ","-",$uploadImageName);	
				$newPicture =($random_no."_".$originalPicture);
			}
			else
			{
				$newPicture = "";
			}
			
			
					
			if($uom!=4 && $uom!=7)
				$stock_quantity=$firstquantity;
			else
				$stock_quantity=$position;
				
				
			$Query="insert into tbl_stock_items (stock_id, item_id, stock_image, stock_color, stock_quantity, stock_orignal_quantity, total_yards, total_meters) VALUES ($insertion, $itemcode,'$newPicture','$stockcolor','$stock_quantity','$stock_quantity', '$firstquantityh', '$secondquantityh')";
			
			$iteminsertion=$db->record_insert($Query);
			if($iteminsertion){
			if($uom==4 || $uom==7)
			{
				for($nofroll=1;$nofroll<=$position;$nofroll++)
				{
					$roll="item".$VarinvLoop."roll".$nofroll;
					$roll=$_POST[$roll];
					$first="item".$VarinvLoop."roll".$nofroll."first".$nofroll;
					$first=$_POST[$first];
					$second="item".$VarinvLoop."roll".$nofroll."second".$nofroll;
					$second=$_POST[$second];
					//roll_id,item_code,stock_item_id,stock_id,firstvalue,secondvalue,status,created_on,created_by
					$Queryforrolls="insert into tbl_stock_item_rolls (stock_item_id, item_id, roll_no, yards, meters, is_used) VALUES ('$iteminsertion', $itemcode,'$roll','$first','$second',0)";
					$rollssertion=$db->record_insert($Queryforrolls);
				}
			}			
				
				
				
			}else{
			echo 0;
			}
			
		}
		
		?>
		<!--<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php /*echo $chkp;*/?>&m=<?php /*echo $m;*/?>" >-->
           <form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=381&m=124" >

				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Stock added successfully" /> 
			</form>
		  <script>
			  document.frmsuc.submit();
              window.location.replace("index_admin.php?chkp=381&m=124");
		  </script>
		<?php 
		exit;	
		
		}
}
else	// if Account edit
{
	/*$Query="UPDATE tbl_stock SET client_id='$client_id', location_id='$location_id' SET stock_id=";
	$insertion=$db->record_insert($Query);*/
	
	$sqlitemid="SELECT * FROM tbl_stock_items WHERE stock_item_id=$mid";
	$sqlitemidQ=$db->record_select($sqlitemid);
		
	if($_FILES['stock_pictures0']['name']!="")
	{
		$random_no=rand(1,1000)*2;
		$uploadImageName=$_FILES['stock_pictures0']['name'];
		$uploadPath = "plugins/images/stock/".$random_no."_".basename($uploadImageName);
		move_uploaded_file($_FILES['stock_pictures0']['tmp_name'], $uploadPath);
		$originalPicture = str_replace(" ","-",$uploadImageName);	
		$newPicture =($random_no."_".$originalPicture);
		
		// to delete old image
		$oldimg="plugins/images/stock/".$oldstock_image;
		@unlink($oldimg);
		$stockcolor0="";
		
	}
	else
	{
		if($stockcolor0!="")
		{
			$oldimg="plugins/images/stock/".$sqlitemidQ[0]['stock_image'];
			@unlink($oldimg);
			$newPicture="";
		}
		else
		{
			$newPicture = $oldstock_image;
		}
	}
	
	if($uom0!=4 && $uom0!=7)
	{
		$stock_quantity=$firstquantity0;
		$firstquantityh0="";
		$secondquantityh0="";
	}
	else
	{
		$stock_quantity=$position0;
	}

	$Query="UPDATE tbl_stock_items SET item_id=$item_name0, stock_image='$newPicture',  stock_color='$stockcolor0', stock_quantity='$stock_quantity', stock_orignal_quantity='$stock_quantity', total_yards='$firstquantityh0', total_meters='$secondquantityh0' WHERE stock_item_id=$mid";
	$db->query_execute($Query);
	
	
	// to delete old records
	$sqldel="DELETE FROM tbl_stock_item_rolls WHERE stock_item_id=$mid";
	$db->query_execute($sqldel);
	
	if($uom0==4 || $uom0==7)
	{
		for($nofroll=1;$nofroll<=$position0;$nofroll++)
		{
			$roll="item0roll".$nofroll;
			$roll=$_POST[$roll];
			$first="item0roll".$nofroll."first".$nofroll;
			$first=$_POST[$first];
			$second="item0roll".$nofroll."second".$nofroll;
			$second=$_POST[$second];
			//roll_id,item_code,stock_item_id,stock_id,firstvalue,secondvalue,status,created_on,created_by
			$Queryforrolls="insert into tbl_stock_item_rolls (stock_item_id, item_id, roll_no, yards, meters, is_used) VALUES ('$mid', '".$sqlitemidQ[0]['item_id']."','$roll','$first','$second',0)";
			$rollssertion=$db->query_execute($Queryforrolls);
		}
	}	
	//exit;
	?>
		<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>&mid=<?php echo $mid;?>&cmdType=edit" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Stock updated successfully" /> 
			</form>
		  <script>
			  document.frmsuc.submit();
		  </script>
		<?php 
		exit; 
	
	
}
//chanay akhroat meva badam  pista
?>