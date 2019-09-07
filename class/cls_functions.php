<?php
include("./cls_db.php");
class sitefun{

	private $clsdb;

    public function __construct() {
        $this->clsdb =  new db();
        
    }
/*---------	Class Forms is created by Muhammad Basit Alim	------------------------
------------ 		Dated Nov 28, 2008		--------------------------------
Details for the function are commented above the function declaration

Usage of the class:

instance of the class;
$Page = new site_functions();
*/

//------------------------------Variable Section----------------------------------
var $nav;
//------------------------------ End Variable Section ----------------------------
// FUNCTION FOR MENU
function drawMenu(){
  $this->nav= '<table width="128" border="0" cellspacing="0" cellpadding="0" align="left">
';
$sqlMenu="SELECT * FROM tblmenu WHERE men_id <> 7 AND men_status='A' ORDER BY men_order";
$ressqlMenu=mysql_query($sqlMenu);
$i=1;
while($record=mysql_fetch_array($ressqlMenu))
{
$link="index.php?pid=".$record["men_id"]."";
	if(isset($_REQUEST["pid"]))                    //if pid is not set mean default selection
	{
		if($_REQUEST["pid"]==$record["men_id"])    // for menu Selection 
		{
			$this->nav.='<tr>
							 <td class="menu_txt_sel"><a href="'.$link.'" class="menu_txta" >'.$record["men_name"].'</a></td>
						</tr>';
		 }
		 else
		 {
				if($record["men_id"]==5)
				{
				$this->nav.='<tr><td align="left"><div id="wrapper" style="float:left; text-align:left;">
				<div id="leftcolumn">
				<dl class="dropdown">
				<dt id="one-ddheader" class="upperdd" onmouseover="ddMenu(\'one\',1)" onmouseout="ddMenu(\'one\',-1)">Collections</dt>
				<dd id="one-ddcontent" onmouseover="cancelHide(\'one\')" onmouseout="ddMenu(\'one\',-1)">
				<ul>';
				$SqlC="SELECT * FROM tblcategory ORDER BY cat_order";
				$SqlCQ=mysql_query($SqlC);
				while($SqlCD=mysql_fetch_array($SqlCQ))
				{
					$this->nav.='<li><a href="index.php?cid='.base64_encode(base64_encode($SqlCD["cat_id"])).'&pid=3" class="underline">'.$SqlCD["cat_name"].'</a></li>';
				}
				$this->nav.='</ul>
				</dd>
				</dl>
				<div><div></td></tr>
				';
				}
				else
				{
			$this->nav.='<tr>
							 <td class="menu_txt"><a href="'.$link.'" class="menu_txta" >'.$record["men_name"].'</a></td>
						</tr>
						';
				}		 }
	}
	else  // if menu is not selected or as defaule selection
	{ 
	      if($record["men_id"]==1)
		   {
			$this->nav.='<tr>
							 <td class="menu_txt_sel"><a href="'.$link.'" class="menu_txta" >'.$record["men_name"].'</a></td>
						</tr>
						';
		   }
		   else
		   {
				if($record["men_id"]==5)
				{
				$this->nav.='<tr><td><div id="wrapper"  style="float:left; text-align:left;">
				<div id="leftcolumn">
				<dl class="dropdown">
				<dt id="one-ddheader" class="upperdd" onmouseover="ddMenu(\'one\',1)" onmouseout="ddMenu(\'one\',-1)">Collections</dt>
				<dd id="one-ddcontent" onmouseover="cancelHide(\'one\')" onmouseout="ddMenu(\'one\',-1)">
				<ul>';
				$SqlC="SELECT * FROM tblcategory ORDER BY cat_order";
				$SqlCQ=mysql_query($SqlC);
				while($SqlCD=mysql_fetch_array($SqlCQ))
				{
					$this->nav.='<li><a href="index.php?cid='.base64_encode(base64_encode($SqlCD["cat_id"])).'&pid=3" class="underline">'.$SqlCD["cat_name"].'</a></li>';
				}
				$this->nav.='</ul>
				</dd>
				</dl>
				<div><div></td></tr>
				';
				}
				else
				{
			$this->nav.='<tr>
							 <td class="menu_txt"><a href="'.$link.'" class="menu_txta" >'.$record["men_name"].'</a></td>
						</tr>
						';
				}
		   }
	}
}
$this->nav.= '</table>';
return $this->nav;
}// FUNCTION MENU ENDS

 //File will be rewritten if already exists
   function write_file($filename,$newdata) {
          $f=fopen($filename,"w");
          fwrite($f,$newdata);
          fclose($f);  
   }

   function append_file($filename,$newdata) {
          $f=fopen($filename,"a");
          fwrite($f,$newdata);
          fclose($f);  
   }

   function read_file($filename) {
          $f=fopen($filename,"r");
          $data=fread($f,filesize($filename));
          fclose($f);  
          return $data;
   }
// to get order of any table
function getOrder($tableName, $fieldName,$defaultValue,$extra)
{
	if($defaultValue=="")
	{
		$sqlquery="SELECT MAX(".$fieldName.") as ".$fieldName." FROM ".$tableName." ".$extra."";
		$resultRecords=$this->clsdb->record_select($sqlquery);
		return $resultRecords[0][''.$fieldName.'']+1;
	}
	else
	{
		$returnValue=$defaultValue;
	}
	return $returnValue;
}
function getStatus($event_status_name, $event_status)
{
	if($event_status=='N' || $event_status=='D' || $event_status=='0')//$event_status=="" || 
		$returnHtml='<input name="'.$event_status_name.'" id="'.$event_status_name.'" type="checkbox" id="switch-modal" class="js-switch" data-color="#6164c1" />';
	else
		$returnHtml='<input name="'.$event_status_name.'" id="'.$event_status_name.'" type="checkbox" id="switch-modal" checked class="js-switch" data-color="#6164c1" />';
	return $returnHtml;
}
function alertmessages($msg_type, $msg)
{
	if($msg!="")
	{
		$returnHtml='
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="'.$msg_type.'">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button> '.$msg.'
					</div>
				</div>
			</div>
		';
		return $returnHtml;
	}
}
function cmdType($varcmdType,$varmid)
{
	if($varcmdType!="")
		$returnHtml='<input name="cmdType" id="cmdType" type="hidden" value="edit" /><input name="mid" id="mid" type="hidden" value="'.$varmid.'" />';
	else
		$returnHtml='';
	return $returnHtml;
}
function selectRecursionHTML($tblname,$menuName,$fieldValueId,$fieldValueName,$fieldValueOrder,$defaultValue,$selectedValue,$parent,$tabIcons,$extra)
{
	$returnHtml='<select class="form-control" name="'.$menuName.'" id="'.$menuName.'">';
	if($defaultValue!="")
		$returnHtml.='<option value="0">'.$defaultValue.'</option>';
	$returnHtml.=$this->selectRecursion($tblname,$fieldValueId,$fieldValueName,$fieldValueOrder,$defaultValue,$selectedValue,$parent,$tabIcons,$extra);
	$returnHtml.='</select>';
	return $returnHtml;
}

function selectRecursion($tblname,$fieldValueId,$fieldValueName,$fieldValueOrder,$defaultValue,$selectedValue,$parent,$tabIcons,$extra)
{
		
		$sqlmenuposition="SELECT * FROM ".$tblname." WHERE menu_master_id=$parent ".$extra." ORDER BY menu_id";
		$totalrecords=$this->clsdb->record_total($sqlmenuposition);
		if($totalrecords>0)
		{
			$sqlmenupositionQ=$this->clsdb->record_select($sqlmenuposition);
			foreach($sqlmenupositionQ as $sqlmenupositionD)
			{
				$selmsg="";
				if($selectedValue==$sqlmenupositionD[''.$fieldValueId.''])
					$selmsg="selected";
				$returnHtmlIcons=$this->selectRecursionIcons($sqlmenupositionD['menu_level'],$tabIcons);
				$returnHtml.='<option value="'.$sqlmenupositionD[''.$fieldValueId.''].'" '.$selmsg.'>'.$returnHtmlIcons.''.$sqlmenupositionD[''.$fieldValueName.''].'</option>';
				$returnHtml.=$this->selectRecursion($tblname,$fieldValueId,$fieldValueName,$fieldValueOrder,$defaultValue,$selectedValue,$sqlmenupositionD[''.$fieldValueId.''],$tabIcons);
			}
		}
	
	return $returnHtml;
}
function selectRecursionCategoryHTML($tblname,$menuName,$fieldValueId,$fieldValueName,$fieldValueOrder,$defaultValue,$selectedValue,$parent,$tabIcons,$extra,$css)
{
	$returnHtml='<select class="form-control '.$css.'" name="'.$menuName.'" id="'.$menuName.'">';
	if($defaultValue!="")
		$returnHtml.='<option value="0">'.$defaultValue.'</option>';
	$returnHtml.=$this->selectRecursionCategory($tblname,$fieldValueId,$fieldValueName,$fieldValueOrder,$defaultValue,$selectedValue,$parent,$tabIcons,$extra);
	$returnHtml.='</select>';
	return $returnHtml;
}

function selectRecursionCategory($tblname,$fieldValueId,$fieldValueName,$fieldValueOrder,$defaultValue,$selectedValue,$parent,$tabIcons,$extra)
{
		
		$sqlmenuposition="SELECT * FROM ".$tblname." WHERE parent_id=$parent ".$extra." ORDER BY category_id";
		$totalrecords=$this->clsdb->record_total($sqlmenuposition);
		if($totalrecords>0)
		{
			$sqlmenupositionQ=$this->clsdb->record_select($sqlmenuposition);
			foreach($sqlmenupositionQ as $sqlmenupositionD)
			{
				$selmsg="";
				if($selectedValue==$sqlmenupositionD[''.$fieldValueId.''])
					$selmsg="selected";
				$returnHtmlIcons=$this->selectRecursionIcons($sqlmenupositionD['category_level'],$tabIcons);
				$returnHtml.='<option value="'.$sqlmenupositionD[''.$fieldValueId.''].'" '.$selmsg.'>'.$returnHtmlIcons.''.$sqlmenupositionD[''.$fieldValueName.''].'</option>';
				$returnHtml.=$this->selectRecursionCategory($tblname,$fieldValueId,$fieldValueName,$fieldValueOrder,$defaultValue,$selectedValue,$sqlmenupositionD[''.$fieldValueId.''],$tabIcons);
			}
		}
	
	return $returnHtml;
}
function selectRecursionIcons($menulevel,$tabicon)
{
	if($menulevel>0)
	{
		for($i=1;$i<=$menulevel;$i++)
		{
			$returnHtmlMenuIcon.=$tabicon;
		}
	}
	return $returnHtmlMenuIcon;
}

function categoryBreadCrumb($tblname,$fieldValueId,$fieldValueName,$currentCatId,$tabIcons,$extra)
{
		
		$sqlmenuposition="SELECT * FROM ".$tblname." WHERE category_id=$currentCatId ".$extra." ORDER BY ".$fieldValueId."";
		$totalrecords=$this->clsdb->record_total($sqlmenuposition);
		if($totalrecords>0)
		{
			$sqlmenupositionQ=$this->clsdb->record_select($sqlmenuposition);
			foreach($sqlmenupositionQ as $sqlmenupositionD)
			{
				$returnHtml.=$this->categoryBreadCrumb($tblname,$fieldValueId,$fieldValueName,$sqlmenupositionD['parent_id'],$tabIcons,$extra);
				if($sqlmenupositionD['parent_id']!=0)
					$returnHtml.=$tabIcons.$sqlmenupositionD[''.$fieldValueName.''];
				else
					$returnHtml.=$sqlmenupositionD[''.$fieldValueName.''];
			}
		}
	
	return $returnHtml;
}
function topnav($currentMenu)
{
	$generalinfo=$this->generalInformation();
	$basewebpath=$generalinfo['general_website_path'];
	$sqlmenuposition="SELECT * FROM tbl_menu WHERE menu_positions_id=1 AND menu_master_id=0";
	$totalrecords=$this->clsdb->record_total($sqlmenuposition);
	if($totalrecords>0)
	{
		$sqlmenupositionQ=$this->clsdb->record_select($sqlmenuposition);
		$sitenavHTML='
		<nav>
			<ul class="sf-menu">';
				foreach($sqlmenupositionQ as $sqlmenupositionD){
				
					if($sqlmenupositionD['menu_icon']=="")
						$menuName=$sqlmenupositionD['menu_name'];
					else
						$menuName=$sqlmenupositionD['menu_icon'];
						
					if($sqlmenupositionD['file_name']=="")
					{
						$menuLink=$basewebpath.$sqlmenupositionD['menu_alias'].".html";
					}
					else
					{
						$menuLink=$basewebpath.$sqlmenupositionD['file_name'];
					}
					if($sqlmenupositionD['menu_id']==$currentMenu)
						$menuClass=' class="current colordefault home_class"';
					else
						$menuClass=' class="color2"';
					
						
				$sitenavHTML.='<li'.$menuClass.'><a href="'.$menuLink.'">'.$menuName.'</a>';
					$sitenavHTML.=$this->topnavinnerHtml($sqlmenupositionD['menu_id']);
				$sitenavHTML.='</li>';
				}
				
			$sitenavHTML.='</ul><!-- /menu -->
		</nav><!-- /nav -->
		';
		echo  $sitenavHTML;
	}
}
function topnavinnerHtml($menu_id)
{
	$generalinfo=$this->generalInformation();
	$basewebpath=$generalinfo['general_website_path'];
	
	$sqlmenupositioninner="SELECT * FROM tbl_menu WHERE menu_master_id=$menu_id";
	$totalrecordsinner=$this->clsdb->record_total($sqlmenupositioninner);
	if($totalrecordsinner>0)
	{
		$sqlmenupositioninnerQ=$this->clsdb->record_select($sqlmenupositioninner);
		$innerHTML.="<ul>";
			foreach($sqlmenupositioninnerQ as $sqlmenupositioninnerD){
			
				if($sqlmenupositioninnerD['file_name']=="")
				{
					$menuinnerLink=$basewebpath.$sqlmenupositioninnerD['menu_alias'].".html";
				}
				else
				{
					$menuinnerLink=$basewebpath.$sqlmenupositionD['file_name'];
				}	
				$innerHTML.='<li><a href="'.$menuinnerLink.'">'.$sqlmenupositioninnerD['menu_name'].'</a>';
				
				$innerHTML.=$this->topnavinnerHtml($sqlmenupositioninnerD['menu_id']);
				
				$innerHTML.='</li>';
			}
		$innerHTML.="</ul>";
	}
	
	return $innerHTML;
}
function topnews($totalnews, $order)
{
	if($order=="A")
		$orderquery=" ORDER BY page_id ASC";
	else
		$orderquery=" ORDER BY page_id DESC";
		
	$generalinfo=$this->generalInformation();
	$basewebpath=$generalinfo['general_website_path'];
	$sqlrecord="SELECT * FROM tbl_pages WHERE page_type_id=2 ".$orderquery." LIMIT ".$totalnews."";
	$totalrecords=$this->clsdb->record_total($sqlrecord);
	if($totalrecords>0)
	{
		$newsinner='<ul id="js-news" class="js-hidden">';
		$sqlrecordQ=$this->clsdb->record_select($sqlrecord);
		foreach($sqlrecordQ as $sqlrecordD)
		{
			$newsinner.='<li class="news-item"><a href="'.$basewebpath.'news/'.$sqlrecordD['page_id'].'/'.$sqlrecordD['page_alias'].'.html">'.$sqlrecordD['page_name'].'</a></li>';
		}
		$newsinner.='</ul><!-- /js news -->';
	}
	echo $newsinner;
}
function bottomnews($totalnews,$order)
{
	if($order=="A")
		$orderquery=" ORDER BY page_id ASC";
	else
		$orderquery=" ORDER BY page_id DESC";
	
	$generalinfo=$this->generalInformation();
	$basewebpath=$generalinfo['general_website_path'];
	$sqlrecord="SELECT * FROM tbl_pages WHERE page_type_id=2 ".$orderquery." LIMIT ".$totalnews."";
	$totalrecords=$this->clsdb->record_total($sqlrecord);
	if($totalrecords>0)
	{
		$sqlrecordQ=$this->clsdb->record_select($sqlrecord);
		foreach($sqlrecordQ as $sqlrecordD)
		{
			// to get image path
			$newspath=$basewebpath."images/news/thumb/".$sqlrecordD['page_image1'];
			$newsinner.='<li class="clearfix">
								<a class="s_thumb hover-shadow" href="'.$basewebpath.'news/'.$sqlrecordD['page_id'].'/'.$sqlrecordD['page_alias'].'.html"><img width="70" height="70" src="'.$newspath.'" alt="#"></a>
								<h3><a href="'.$basewebpath.'news/'.$sqlrecordD['page_id'].'/'.$sqlrecordD['page_alias'].'.html">'.$sqlrecordD['page_name'].'</a></h3>
							</li>';
		}
	}
	echo $newsinner;
}


function bottomevents($totalnews,$order)
{
	if($order=="A")
		$orderquery=" ORDER BY page_id ASC";
	else
		$orderquery=" ORDER BY page_id DESC";
	
	$generalinfo=$this->generalInformation();
	$basewebpath=$generalinfo['general_website_path'];
	$sqlrecord="SELECT * FROM tbl_pages WHERE page_type_id=5 ".$orderquery." LIMIT ".$totalnews."";
	$totalrecords=$this->clsdb->record_total($sqlrecord);
	if($totalrecords>0)
	{
		$sqlrecordQ=$this->clsdb->record_select($sqlrecord);
		foreach($sqlrecordQ as $sqlrecordD)
		{
			// to get image path
			$newspath=$basewebpath."images/events/thumb/".$sqlrecordD['page_image1'];
			$newsinner.='<li class="clearfix">
								<a class="s_thumb hover-shadow" href="'.$basewebpath.'events/'.$sqlrecordD['page_id'].'/'.$sqlrecordD['page_alias'].'.html"><img width="70" height="70" src="'.$newspath.'" alt="#"></a>
								<h3><a href="'.$basewebpath.'events/'.$sqlrecordD['page_id'].'/'.$sqlrecordD['page_alias'].'.html">'.$sqlrecordD['page_name'].'</a></h3>
							</li>';
		}
	}
	echo $newsinner;
}


function generalInformation()
{
	$sqlrecord="SELECT * FROM tbl_general WHERE general_id=1";
	$sqlrecordQ=$this->clsdb->record_select($sqlrecord);
	return $sqlrecordQ[0];
}
function themeInformation()
{
	$sqlrecord="SELECT * FROM tbl_theme WHERE theme_id=1";
	$sqlrecordQ=$this->clsdb->record_select($sqlrecord);
	return $sqlrecordQ[0];
}
function themepagedata($page_id)
{
	$sqlrecord="SELECT * FROM tbl_pages WHERE page_id=$page_id";
	$sqlrecordQ=$this->clsdb->record_select($sqlrecord);
	return $sqlrecordQ[0];
}
function themepagealiasdata($menu_alias)
{
	$sqlrecord="SELECT * FROM tbl_pages,tbl_menu WHERE tbl_menu.menu_id=tbl_pages.menu_id AND tbl_menu.menu_alias='$menu_alias'";
	$sqlrecordQ=$this->clsdb->record_select($sqlrecord);
	if($sqlrecordQ[0]=="")
	{
		$sqlrecord="SELECT * FROM tbl_pages WHERE page_alias='$menu_alias'";
		$sqlrecordQ=$this->clsdb->record_select($sqlrecord);
	}
	
	return $sqlrecordQ[0];
}
function getTimeByCountry($defaultcountry)
{
	date_default_timezone_set("".$defaultcountry."");
	$finaldate=date('h:i A');
	echo $finaldate;
}
function contactForm($val)
{
	$formHtml='
	<form method="post" id="contactForm" action="processForm.php">
		<div class="clearfix">
			<div class="grid_6 alpha fll"><input type="text" name="senderName" id="senderName" placeholder="Name *" class="requiredField"></div>
			<div class="grid_6 omega flr"><input type="text" name="senderEmail" id="senderEmail" placeholder="Email Address *" class="requiredField email"></div>
		</div>
		<div><textarea name="message" id="message" placeholder="Message *" class="requiredField" rows="8"></textarea></div>
		<input type="submit" id="sendMessage" name="sendMessage" value="Send Email">
		<span>  </span>
	</form>
	';
	echo $formHtml;
}
function getPageContent($pageHtml)
{
	$value = strstr($pageHtml, "[--"); //gets all text from needle on
	$value = strstr($value, "--]", true); //gets all text before needle
	$value2= str_replace("[--","",$value);
	$firstPartofFormcode="[--".$value2."--]";
	$lastPartofFormcode="[--/".$value2."--]";
	$leftpartofHtmlTemp=explode($firstPartofFormcode,$pageHtml);
	$rightpartofHtmlTemp=explode($lastPartofFormcode,$pageHtml);
	//$value2="$this->".$value2."('')";
	//$finalHtml=call_user_func($value2);
	
	$phpformcodeTemp=explode($lastPartofFormcode,$leftpartofHtmlTemp[1]);
	$phpformcode=explode("]",$phpformcodeTemp[0]);
	$totalforfields=count($phpformcode);
	if($totalforfields>1)
	{
	$formHtml.='<form method="post" id="contactForm" action="processForm.php">';
	foreach($phpformcode as $phpformcode2)
	{
		$temp=$phpformcode2;
		$gettype=$this->explodeandgetvalue('type="',$phpformcode2);
		$getname=$this->explodeandgetvalue('name="',$phpformcode2);
		$getplaceholder=$this->explodeandgetvalue('placeholder="',$phpformcode2);
		$getclass=$this->explodeandgetvalue('class="',$phpformcode2);
		$getwidth=$this->explodeandgetvalue('width="',$phpformcode2);
		
		if($gettype!="" && $getname!="")
		{
			if($gettype=="textarea")
			{
				$formHtml.='<div class="grid_12 alpha"><textarea name="'.$getname.'" id="'.$getname.'" placeholder="'.$getplaceholder.'" class="'.$getclass.'" rows="8"></textarea></div>';
			}
			else
			{
				if($getwidth!="")
				{
					$formHtml.='<div class="grid_'.$getwidth.' alpha"><input type="'.$gettype.'" name="'.$getname.'" id="'.$getname.'" placeholder="'.$getplaceholder.'" class="'.$getclass.'"></div>
					';
				}
				else
				{
					$formHtml.='<div class="grid_12 alpha"><input type="'.$gettype.'" name="'.$getname.'" id="'.$getname.'" placeholder="'.$getplaceholder.'" class="'.$getclass.'"></div>';
				}
			}
		}
	}
	$formHtml.='<input type="submit" id="sendMessage" name="sendMessage" value="Submit">
		<span>  </span>
	</form>';
	}
	
	/*$formHtml1='<form method="post" id="contactForm" action="processForm.php">
			<div class="grid_6 alpha fll"><input type="text" name="senderName" id="senderName" placeholder="Name *" class="requiredField"></div>
			<div class="grid_6 omega flr"><input type="text" name="senderEmail" id="senderEmail" placeholder="Email Address *" class="requiredField email"></div>
		<div><textarea name="message" id="message" placeholder="Message *" class="requiredField" rows="8"></textarea></div>
		</form>';*/
	
	
	$finalHtml=$leftpartofHtmlTemp[0].$formHtml.$rightpartofHtmlTemp[1];
	return $finalHtml;
}
function explodeandgetvalue($strilval,$data)
{
	$gettypeTemp=explode(''.$strilval.'',$data);
	$gettype=explode('"',$gettypeTemp[1]);
	return $gettype[0];
}
function secretariatView1($total,$Order)
{
	$generalinfo=$this->generalInformation();
	$basewebpath=$generalinfo['general_website_path'];
	if($Order=="A")
		$orderquery=" ORDER BY page_order ASC";
	else
		$orderquery=" ORDER BY page_order DESC";
		
	$innerHtml='
	<div class="widget">
		<div class="title"><h4>MalPak Official Positions</h4></div>
		<ul class="small_posts">';
		$sqlrecord="SELECT * FROM tbl_pages WHERE page_type_id=4 ".$orderquery." LIMIT ".$total."";
		$totalrecords=$this->clsdb->record_total($sqlrecord);
		if($totalrecords>0)
		{
			$sqlrecordQ=$this->clsdb->record_select($sqlrecord);
			foreach($sqlrecordQ as $sqlrecordD)
			{
				$imagePath=$basewebpath."images/secretariat/thumb/".$sqlrecordD['page_image1'];
				$postPath=$basewebpath."secretariat/".$sqlrecordD['page_id']."/".$sqlrecordD['page_alias'].".html";
				$innerHtml.='
				<li class="clearfix">
					<a href="'.$postPath.'" class="s_thumb hover-shadow"><img width="70" height="70" alt="#" src="'.$imagePath.'"></a>
					<h3><a href="'.$postPath.'">'.$sqlrecordD['page_name'].'</a></h3>
					<div class="meta mb"> <a title="Chairman" href="'.$postPath.'" class="cat color6">'.$sqlrecordD['page_attachment'].'</a></div>
				</li>';
			}
		}
		$innerHtml.='</ul>
		<a class="cat color7" href="'.$basewebpath.'secretariat.html">View All Positions</a>
	</div>
	';
	echo $innerHtml;
}
function HomeSlider($total,$Order)
{
	$generalinfo=$this->generalInformation();
	$basewebpath=$generalinfo['general_website_path'];
	if($Order=="A")
		$orderquery=" ORDER BY page_order ASC";
	else
		$orderquery=" ORDER BY page_order DESC";
		
	$sqlrecord="SELECT * FROM tbl_pages WHERE page_type_id=5 ".$orderquery." LIMIT ".$total."";
	$totalrecords=$this->clsdb->record_total($sqlrecord);
	$totalLoop=ceil($totalrecords/2);
	if($totalrecords>0)
	{
		$innerHtml='
		<div class="ipress_slider mbf">
			<div class="slider_a owl-carousel owl-theme">';
				for($i=0;$i<$totalLoop;$i++)
				{
					$pagesLimit=($i*2);
					$innerHtml.='
					<div class="item clearfix">';
						$sqlrecordInner="SELECT * FROM tbl_pages WHERE page_type_id=5 ".$orderquery." LIMIT $pagesLimit,2";
						$totalrecordsInner=$this->clsdb->record_total($sqlrecordInner);
						$sqlrecordInnerQ=$this->clsdb->record_select($sqlrecordInner);
						foreach($sqlrecordInnerQ as $sqlrecordInnerD)
						{
							$imagePath=$basewebpath."images/events/thumb/".$sqlrecordInnerD['page_image1'];
							$innerHtml.='<div class="half">
								<div class="slide_details">
									<h3><a href="#">'.$sqlrecordInnerD['page_name'].'</a></h3>
									<a class="cat color3" href="#" title="View all posts under Entertainment"><b>Date: </b>'.$sqlrecordInnerD['page_attachment'].'</a>
								</div>
								<a href="#"><img src="'.$imagePath.'" alt=""></a>
							</div><!-- /half -->';
							if($totalrecordsInner==1)
							{
								$sqlrecordSingle="SELECT * FROM tbl_pages WHERE page_type_id=5 ".$orderquery." LIMIT 1";
								$sqlrecordSingleQ=$this->clsdb->record_select($sqlrecordSingle);
								$imagePath=$basewebpath."images/events/thumb/".$sqlrecordSingleQ[0]['page_image1'];
								$innerHtml.='<div class="half">
									<div class="slide_details">
										<h3><a href="#">'.$sqlrecordSingleQ[0]['page_name'].'</a></h3>
										<a class="cat color3" href="#" title="View all posts under Entertainment"><b>Date: </b>'.$sqlrecordSingleQ[0]['page_attachment'].'</a>
									</div>
									<a href="#"><img src="'.$imagePath.'" alt=""></a>
								</div><!-- /half -->';
							}
						}
					$innerHtml.='</div><!-- /slide -->';
				}
			
		
			$innerHtml.='</div><!-- /slider -->
		</div>
		';
	}
	echo $innerHtml;
}
function invoice_balance_payment($invoice_id)
{
	$sqlinvoice="SELECT * FROM tbl_invoice WHERE invoice_id='$invoice_id'";
	$sqlinvoiceQ=$this->clsdb->record_select($sqlinvoice);
	$invoice_total=$sqlinvoiceQ[0]['invoice_total'];
	
	$sqlinvoice="SELECT sum(payment_amount) as payment_amount FROM tbl_receive_payment WHERE invoice_id='$invoice_id'";
	$sqlinvoiceQ=$this->clsdb->record_select($sqlinvoice);
	$payment_amount=$sqlinvoiceQ[0]['payment_amount'];
	
	$final_payable_amounnt=$invoice_total-$payment_amount;
	
	
	return $final_payable_amounnt;
}
function get_past_date_arrays($fromdate,$days,$plus_minus,$date_pattern)
{
	if($plus_minus=="-")
	{
		$startDate=date($date_pattern, strtotime('-'.$days.' days'));
		$finalArr[]=$startDate;
		for($i=1;$i<=$days;$i++)
		{
			
			$finalArr[]=date($date_pattern, strtotime('+'.$i.' days',strtotime($startDate)));
		}
	}
	elseif($plus_minus=="+")
	{
		$endDate=date($date_pattern, strtotime('+'.$days.' days'));
		$finalArr[]=$fromdate;
		for($i=1;$i<=$days;$i++)
		{
			
			$finalArr[]=date($date_pattern, strtotime('+'.$i.' days',strtotime($fromdate)));
		}
	}
	
	return $finalArr;
}
/*function number_to_word( $num = '' )
{
    $num    = ( string ) ( ( int ) $num );
   
    if( ( int ) ( $num ) && ctype_digit( $num ) )
    {
        $words  = array( );
       
        $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
       
        $list1  = array('','one','two','three','four','five','six','seven',
            'eight','nine','ten','eleven','twelve','thirteen','fourteen',
            'fifteen','sixteen','seventeen','eighteen','nineteen');
       
        $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
            'seventy','eighty','ninety','hundred');
       
        $list3  = array('','thousand','million','billion','trillion',
            'quadrillion','quintillion','sextillion','septillion',
            'octillion','nonillion','decillion','undecillion',
            'duodecillion','tredecillion','quattuordecillion',
            'quindecillion','sexdecillion','septendecillion',
            'octodecillion','novemdecillion','vigintillion');
       
        $num_length = strlen( $num );
        $levels = ( int ) ( ( $num_length + 2 ) / 3 );
        $max_length = $levels * 3;
        $num    = substr( '00'.$num , -$max_length );
        $num_levels = str_split( $num , 3 );
       
        foreach( $num_levels as $num_part )
        {
            $levels--;
            $hundreds   = ( int ) ( $num_part / 100 );
            $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
            $tens       = ( int ) ( $num_part % 100 );
            $singles    = '';
           
            if( $tens < 20 )
            {
                $tens   = ( $tens ? ' ' . $list1[$tens] . ' ' : '' );
            }
            else
            {
                $tens   = ( int ) ( $tens / 10 );
                $tens   = ' ' . $list2[$tens] . ' ';
                $singles    = ( int ) ( $num_part % 10 );
                $singles    = ' ' . $list1[$singles] . ' ';
            }
            $words[]    = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        }
       
        $commas = count( $words );
       
        if( $commas > 1 )
        {
            $commas = $commas - 1;
        }
       
        $words  = implode( ', ' , $words );
       
        //Some Finishing Touch
        //Replacing multiples of spaces with one space
        $words  = trim( str_replace( ' ,' , ',' , $this->trim_all( ucwords( $words ) ) ) , ', ' );
        if( $commas )
        {
            $words  = $this->str_replace_last( ',' , ' and' , $words );
        }
       
        return $words;
    }
    else if( ! ( ( int ) $num ) )
    {
        return 'Zero';
    }
    return '';
}*/
function number_to_word( $num )
{

	$list1  = array('','one','two','three','four','five','six','seven',
		'eight','nine','ten','eleven','twelve','thirteen','fourteen',
		'fifteen','sixteen','seventeen','eighteen','nineteen');
   
	$list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
		'seventy','eighty','ninety','hundred');
   
	$list3  = array('','thousand','million','billion','trillion',
		'quadrillion','quintillion','sextillion','septillion',
		'octillion','nonillion','decillion','undecillion',
		'duodecillion','tredecillion','quattuordecillion',
		'quindecillion','sexdecillion','septendecillion',
		'octodecillion','novemdecillion','vigintillion');
			
			
	//new code to split into 
	/*$numnew=explode(".",$num);
	if($numnew[1]=="00" || $numnew[1]=="")
	{
		$finaldecimal="";
	}
	else
	{
		$decimalVal=substr($numnew[1],0,2);
		$decimaltens   = ( int ) ( $decimalVal / 10 );
		$decimaltens   = ' ' . $list2[$decimaltens] . ' ';
		$decimalsingles_rem    = ( int ) ( $decimalVal % 10 );
		if($decimalsingles_rem=="" || $decimalsingles_rem==$decimalVal)
		{
			$decimalsingles = ' ' . $list2[$decimalsingles_rem] . ' ';
			$finaldecimal= " AND ".$decimalsingles." Cents";
		}
		else
		{
			$decimalsingles = ' ' . $list1[$decimalsingles_rem] . ' ';
			$finaldecimal= " AND ".$decimaltens." ".$decimalsingles." Cents";
		}
	}*/
	
	$numnew=explode(".",$num);
	if($numnew[1]=="00" || $numnew[1]=="")
	{
		$finaldecimal="";
	}
	else
	{
		$decimalVal= substr($numnew[1],0,2);
		
		$decimalVal1st=substr($decimalVal,0,1);
		$decimalVal2nd=substr($decimalVal,1,1);
		if($decimalVal1st==0)
		{
			$finalNum=$list1[$decimalVal2nd];
		}
		elseif($decimalVal2nd=="")
		{
			$finalNum=$list2[$decimalVal1st];
		}
		elseif($decimalVal<=19)
		{
			$finalNum=$list1[$decimalVal];
		}
		else
		{
			$decimaltens   = ( int ) ( $decimalVal / 10 );
			$decimalsingles_rem    = ( int ) ( $decimalVal % 10 );
			
			$finalNum1=$list2[$decimaltens];
			$finalNum2=$list1[$decimalsingles_rem];
			$finalNum=$finalNum1." ". $finalNum2;
		}
		$finaldecimal=" and ".$finalNum." cents";
	}
	
	// old code starts below
    $num    = ( string ) ( ( int ) $numnew[0] );
   
    if( ( int ) ( $num ) && ctype_digit( $num ) )
    {
        $words  = array( );
       
        $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );
       
        
       
        $num_length = strlen( $num );
        $levels = ( int ) ( ( $num_length + 2 ) / 3 );
        $max_length = $levels * 3;
        $num    = substr( '00'.$num , -$max_length );
        $num_levels = str_split( $num , 3 );
       
        foreach( $num_levels as $num_part )
        {
            $levels--;
            $hundreds   = ( int ) ( $num_part / 100 );
            $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );
            $tens       = ( int ) ( $num_part % 100 );
            $singles    = '';
           
            if( $tens < 20 )
            {
                $tens   = ( $tens ? ' ' . $list1[$tens] . ' ' : '' );
            }
            else
            {
                $tens   = ( int ) ( $tens / 10 );
                $tens   = ' ' . $list2[$tens] . ' ';
                $singles    = ( int ) ( $num_part % 10 );
                $singles    = ' ' . $list1[$singles] . ' ';
            }
            $words[]    = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        }
       
        $commas = count( $words );
       
        if( $commas > 1 )
        {
            $commas = $commas - 1;
        }
       
        $words  = implode( ', ' , $words );
       
        //Some Finishing Touch
        //Replacing multiples of spaces with one space
        $words  = trim( str_replace( ' ,' , ',' , $this->trim_all( ucwords( $words ) ) ) , ', ' );
        if( $commas )
        {
            $words  = $this->str_replace_last( ',' , ' and' , $words );
        }
       
        return $words.$finaldecimal;
    }
    else if( ! ( ( int ) $num ) )
    {
        return 'Zero';
    }
    return '';
}
function str_replace_last( $search , $replace , $str ) {
    if( ( $pos = strrpos( $str , $search ) ) !== false ) {
        $search_length  = strlen( $search );
        $str    = substr_replace( $str , $replace , $pos , $search_length );
    }
    return $str;
}
function trim_all( $str , $what = NULL , $with = ' ' )
{
    if( $what === NULL )
    {
        //  Character      Decimal      Use
        //  "\0"            0           Null Character
        //  "\t"            9           Tab
        //  "\n"           10           New line
        //  "\x0B"         11           Vertical Tab
        //  "\r"           13           New Line in Mac
        //  " "            32           Space
       
        $what   = "\\x00-\\x20";    //all white-spaces and control chars
    }
   
    return trim( preg_replace( "/[".$what."]+/" , $with , $str ) , $what );
}
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}


}//class ended
?>