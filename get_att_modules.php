<?php
include "class/cls_db.php";
$db = new db();

// Identify as XML
	header('Content-type: text/xml');

/* You should implement error checking, but for simplicity, we avoid it here */
$mid=$_GET['id'];	
$ob_action=$_GET['action'];

if($ob_action == 'get_mods'){

	

if($_SESSION['utype']==1)
$result = ("SELECT * FROM tblgroup where mod_id='$mid' ORDER BY grp_id");
else
$result = ("SELECT * FROM tblgroup where mod_id='$mid' ORDER BY grp_id");
					$nResult = mysqli_query($result);
					

//--------------------------------------------------------------	
	$strXML="<?xml version=\"1.0\"?>\r\n";
		$strXML.="<xmlresponse>\r\n";
		$strXMLChild ="<subList>\r\n";
	while($rstRow = mysqli_fetch_array($nResult))
	{
	
		$strXMLChild.="<subcat  grp_p=\"".$rstRow['grp_permission']."\" grp_uid=\"".$rstRow['typ_id']."\">\r\n";
		$strXMLChild.="</subcat>\r\n";
}


	$strXMLChild.="</subList>\r\n";
	
	
	$strXML.= $strXMLChild."\r\n";
	$strXML.="</xmlresponse>";
	
	echo $strXML;
}

?>


