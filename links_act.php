<?php
include "class/cls_db.php";
include "class/cls_forms.php";
include('class/cls_imageFile.php');
$db = new db();

$imp ='images/link_img/';
$thp ='images/thumb/';
$rsimg =true;
$thpr=true;
$ix=50;
$iy=50;
$lock='b';

$tx=190;
$ty=190;
$lockt='b';

$strlogo = '';

// Array defining and vars	
	$chkbx = array();
	$chkbxid = array();
	$slink = $_POST['select_link'];
	$name = $_POST['txtname'];
	$path = $_POST['txtpath'];
	$infile = $_POST['txtfile'];
	$sp = $_POST['show_p'];
	$catrank=$_POST['txtrank'];
	$attmod=$_POST['select_mod'];
	$link_font=$_POST['link_font'];
	
	if($sp!="Y")
		$sp="N";
	
	
	if(isset($_POST['Submit_x'])){
	

// links tbl insert query

		  //$qr =  mysqli_query("insert into tbllinks Values('', '$name', '$path')") or die(mysqli_error());
		  $prodpic = strlen($_FILES['Epic']['name']);
						//$prodpdf = strlen($_FILES['Ppic']['name']);
							if($prodpic==0 ){
							
							  $result =  $db->query_execute("UPDATE tbllinks set
		  											link_name = '$name', 
													link_path = '$path',
													link_file = '$infile',
													link_font='$link_font',
													link_s = '$sp'
													where link_id = '$slink'");

		
								}
							else if($prodpic>0 ){
							/*
							//Deleting Thumb
							$prodhpic = strlen($_POST['txthpic']);
								if ($prodhpic > 0) 
								{
									$uploadDir = 'images/link_img/';
									$ourFileName = $uploadDir.$_POST['txthpic'];
									unlink($ourFileName);
								}
								$prefix = 'L';
								$upphoto = uniqid($prefix);
								$name_r=str_replace(" ","_",$_FILES['Epic']['name']);
								$Picinfo=$upphoto."_".$name_r;
								$temp=$_FILES['Epic']['tmp_name'];
						
								$imFile->imageUpload($Picinfo, $temp,$ix, $iy, $lock, $strlogo, $imp);*/
						
									
						
								$result =  $db->query_execute("UPDATE tbllinks set
		  											link_name = '$name', 
													link_path = '$path',
													link_file = '$infile',
													link_font='$link_font',
													link_s = '$sp',
													link_img_path = '$Picinfo'
													where link_id = '$slink'");

								}
		
									////////rank
							$result = $db->query_execute("SELECT MAX(link_rank) as mrank FROM tbllinks");
							
							$nrows = $db->nrowobj($result);
			for ($x=0; $x < $nrows; $x++) 
			
			{
 				$row = $db->record_select($result);
				$Mrank = $row['mrank'];
			}
			
			
			if($catrank>$Mrank)
			
			{
				
			}
			
			else
			{
			    	$result = $db->record_select("SELECT * FROM tbllinks where link_id=$slink");
					$nrows = $db->nrowobj($result);
						for ($j=0; $j < $nrows; $j++)
						 {
 					$row = $db->record_select($result);
					$PID = $row['link_id'];
  					$Prank = $row['link_rank'];
						}
									
			if($catrank==$Prank)
			{
					
			}
			else if($catrank<$Prank)
			{
					$qr =  $db->query_execute("UPDATE tbllinks SET link_rank=link_rank+1 where link_rank >='$catrank' && link_rank < '$Prank'");
					$qr =  $db->query_execute("UPDATE tbllinks SET link_rank='$catrank' where link_id ='$PID'");
					
					
			
			}
			else
			{
					$qr =  $db->query_execute("UPDATE tbllinks SET link_rank=link_rank-1 where link_rank <='$catrank' && link_rank > '$Prank'");
					$qr =  $db->query_execute("UPDATE tbllinks SET link_rank='$catrank' where link_id ='$PID'");
					
					
			}
			}
						$massage=$name.' Link has been updated';
						header('Location: index_admin.php?chkp=3&massage='.$massage);
						exit;
		
}else if(isset($_POST['Add'])){

// links tbl insert query


		$result = "SELECT MAX(link_rank) + 1 AS link_rank FROM tbllinks LIMIT 1 ";
		$nResult = $db->record_select($result);
        $link_rank=$nResult[0]['link_rank'];

					
			

			$qr =  $db->record_insert("insert into tbllinks Values('', '$name', '$path', '$link_font', '$infile', '$sp',$link_rank,'$Picinfo')");
			
			
			

			$massage=$name. ' link has been added';
			header('Location: index_admin.php?chkp=2&massage='.$massage);
						}


?>