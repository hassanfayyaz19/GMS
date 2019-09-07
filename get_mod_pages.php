<?php
include "class/cls_db.php";
$db = new db();
// Identify as XML
	header('Content-type: text/xml');

/* You should implement error checking, but for simplicity, we avoid it here */
	$lid=$_GET['id'];
$ob_action=$_GET['action'];

if($ob_action == 'get_links'){

	


$result = ("SELECT * FROM tblmodulespages where mod_id='$lid'");
					$nResult = mysqli_query($result);
					

//--------------------------------------------------------------	
	$strXML="<?xml version=\"1.0\"?>\r\n";
		$strXML.="<xmlresponse>\r\n";
		$strXMLChild ="<subList>\r\n";
	while($rstRow = mysqli_fetch_array($nResult))
	{
	
		$strXMLChild.="<subcat  linkid=\"".$rstRow['link_id']."\" >\r\n";
		$strXMLChild.="</subcat>\r\n";
}


	$strXMLChild.="</subList>\r\n";
	
	
	
	$strXML.= $strXMLChild."\r\n";
	$strXML.="</xmlresponse>";
	
	echo $strXML;
}

?>


