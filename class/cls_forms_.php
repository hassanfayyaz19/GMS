<?php

class forms{

	public function __construct( $db )
	{
		$this->cdb = $db;
	}

/*---------	Class Forms is created by Saqib Ahmad	------------------------
------------ 		Dated Feb 06, 2007		--------------------------------
Details for the function are commented above the function declaration

Usage of the class:

instance of the class;
$Page = new forms();
*/

//------------------------------Variable Section----------------------------------

var $img_bt;//Image Btton
var $sub_bt;//Submit Btton
var $inpBox;//inputBox
var $txtArea;//textArea
var $sList;//Slect List
var $sList_gra;//Slect List
var $imgOver;//Image Roll Overs
var $panel;//For Panels
var $panel2;//For Panels
var $mType;// For tables
var $mDes;// For Description
var $emailD;// For Description
var $addD;
var $eGrid;// For making grid;
var $nav;// For Menu Output;
var $footerMenu;// For footer Menu Output;
var $contact;// For contact;
var $banner;// for flash banner
var $cs;   //For Customer Speak
var $login;
var $eGrid2;
var $email;
var $fprod;
var $udate;
var $alertmessages;

//----------------------Buttons Declaration Started------------------------------------------------

function image_bt($name,$src){

	$this->img_bt="<input name=\"$name\" id=\"$name\" type=\"image\" src=\"$src\">";
	return $this->img_bt;
}

function image_bt_d($name,$src,$d){

	$this->img_bt="<input name=\"$name\" id=\"$name\" type=\"image\" src=\"$src\" $d />";
	return $this->img_bt;
}

function image_bt_jfun($name,$src, $ext){

	$this->img_bt="<input name=\"$name\" id=\"$name\" type=\"image\" src=\"$src\" $ext />";
	return $this->img_bt;
}

function submit_bt($type, $name, $val){

	$this->sub_bt="<input type=\"$type\" name=\"$name\" id=\"$name\" value=\"$val\">";
	return $this->sub_bt;
}

//-------------------------Buttons Declaration Ended------------------------------------------------

//----------------------		Input Box Function 		-----------------------------------------
function input($type, $name, $val, $inpClass, $ext){

	$this->inBox= "<input type=\"$type\" name=\"$name\" id=\"$name\" value='$val' class=\"$inpClass\" $ext  />";
	return $this->inBox;

}
function inputslashes($type, $name, $val, $inpClass, $ext){

	$this->inBox= "<input type=\"$type\" name=\"$name\" id=\"$name\"  class=\"$inpClass\" ".stripslashes($ext)."  />";
	return $this->inBox;

}

//----------------------		TextArea Function 		-----------------------------------------
function textArea($name, $val, $inpClass, $ext){

	$this->txtArea= "<textarea name=\"$name\" id=\"$name\" class=\"$inpClass\" $ext >$val</textarea>";
	return $this->txtArea;

}//----------------------	TextArea FunctionEnded		-----------------------------------------




//----------------------		SelectList Function 		-----------------------------------------
function selectList($selName, $selFun, $selTable, $selWf, $selWv, $selPre, $selSel, $selSize, $selClass,$selcap,$int_cap, $AscDesc){

$name=$selcap;
$id=$selPre;

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" id=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" id=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}

		if($selWv==''){
				$result = mysqli_query("SELECT * FROM $selTable order by ".$selPre." ".$AscDesc) or die(mysqli_error());

			}else{

				$result = mysqli_query("SELECT * FROM $selTable where $selWv order by ".$selcap." ".$AscDesc) or die(mysqli_error());
		}
	if($int_cap<>""){
	$this->sList .= "<option value=\"0\" selected>".$int_cap."</option>";
	}
	 while($code = mysqli_fetch_object($result)) {
	 
	 if($selSel==$code->$id){
	 $this->sList .= "<option value=\"".$code->$id."\" selected>".ucwords(strtolower($code->$name))."</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$code->$id."\" >".ucwords(strtolower($code->$name))."</option>";
	 
	 }
	 
	 }
	 
	$this->sList .="</select>"; 
	return $this->sList;

}//Select List Ended

//----------------------		SelectList Function 		-----------------------------------------
function selectListd($selName, $selFun, $selTable, $selWf, $selWv, $selPre, $selSel, $selSize, $selClass,$selcap,$int_cap,$d){

$name=$selcap;
$id=$selPre;

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" id=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" $d >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" id=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" size=\"$selSize\" multiple $d >";
	
	}

		if($selWv==''){
				$result = mysqli_query("SELECT * FROM $selTable order by ".$selPre) or die(mysqli_error());

			}else{

				$result = mysqli_query("SELECT * FROM $selTable where $selWv order by ".$selcap) or die(mysqli_error());
		}
	if($int_cap<>""){
	$this->sList .= "<option value=\"0\" selected>".$int_cap."</option>";
	}
	 while($code = mysqli_fetch_object($result)) {
	 
	 if($selSel==$code->$id){
	 $this->sList .= "<option value=\"".$code->$id."\" selected>".ucwords(strtolower($code->$name))."</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$code->$id."\" >".ucwords(strtolower($code->$name))."</option>";
	 
	 }
	 
	 }
	 
	$this->sList .="</select>"; 
	return $this->sList;

}//Select List Ended


//********************** 9th April 2008 Real Estate

//----------------------		SelectList Function 		-----------------------------------------
function selectList_sec($selName, $selFun, $selTable, $selWf, $selWv, $selPre, $selSel, $selSize, $selClass,$selcap,$int_cap, $value){

$name=$selcap;
$id=$selPre;

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" id=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" id=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}

		if($selWv==''){
				$result = mysqli_query("SELECT * FROM $selTable order by ".$selPre) or die(mysqli_error());

			}else{

				$result = mysqli_query("SELECT * FROM $selTable where $selWv order by ".$selcap) or die(mysqli_error());
		}
	if($int_cap<>""){
	$this->sList .= "<option value=\"".$value."0\" selected>".$int_cap."</option>";
	}
	 while($code = mysqli_fetch_object($result)) {
	 
	 if($selSel==$code->$id){
	 $this->sList .= "<option value=\"".$value.$code->$id."\" selected>".ucwords(strtolower($code->$name))."</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$value.$code->$id."\" >".ucwords(strtolower($code->$name))."</option>";
	 
	 }
	 
	 }
	 
	$this->sList .="</select>"; 
	return $this->sList;

}//Select List Ended



//----------------------		SelectList Function Links		-----------------------------------------
function selectListLink($selName, $selFun, $selTable, $selWf, $selWv, $selPre, $selSel, $selSize, $selClass,$selcap){

$name=$selcap;
$id=$selPre;

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" class=\"textfield1\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}

		if($selWv==''){
				$result = mysqli_query("SELECT * FROM $selTable order by link_rank ") or die(mysqli_error());

			}else{
				$result = mysqli_query("SELECT * FROM $selTable where $selWf='$selWv' order by link_rank ") or die(mysqli_error());
		}
	
	
	 while($code = mysqli_fetch_object($result)) {
	 
	 if($selSel==$code->$id){
	 $this->sList .= "<option value=\"".$code->$id."\" selected>".ucwords(strtolower($code->$name))."</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$code->$id."\" >".ucwords(strtolower($code->$name))."</option>";
	 
	 }
	 
	 }
	 
	$this->sList .="</select>"; 
	return $this->sList;

}//Select List Ended


//----------------------		SelectList Function Sizes		-----------------------------------------
function selectSList($selName, $selFun, $selTable, $selW, $selPre, $selSel, $selSize, $selClass,$selcap){

$name=$selcap;
$id=$selPre;

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" class=\"textfield1\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}

		if($selW==''){
				$result = mysqli_query("SELECT * FROM $selTable order by ".$selPre) or die(mysqli_error());

			}else{
				$result = mysqli_query("SELECT * FROM $selTable where $selW order by ".$selPre) or die(mysqli_error());
		}
	
	
	 while($code = mysqli_fetch_object($result)) {
	 
	 if($selSel==$code->$id){
	 $this->sList .= "<option value=\"".$code->$id."\" selected>".$code->$name."</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$code->$id."\" >".$code->$name."</option>";
	 
	 }
	 
	 }
	 
	$this->sList .="</select>"; 
	return $this->sList;

}//Select List Ended


//---------------------------------Select List Graphics-----------------------------/////////
function selectgraphics($selName, $selFun, $selSize, $selClass, $selSel, $qry){

	if($selSize==''){
	
	$this->sList_gra="<select name=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList_gra="<select name=\"".$selName."\" class=\"textfield1\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}



	
	$this->sList_gra .= "<option value=\"0^0\" selected>No Graphics</option>";
	 while($code = mysqli_fetch_array($qry)) {
	 $w=$code[1];
	 $h=$code[2];
	 $p=$code[3];
	 $price=($w*$h)*$p;
	 if($selSel==$code[0]){
	 $this->sList_gra .= "<option value=\"".$code[4]."^".$price."\" selected>".$code[0]." Add [$".$price."]</option>";
	 }else{
	 
	 $this->sList_gra .= "<option value=\"".$code[4]."^".$price."\" >".$code[0]." Add [$".$price."]</option>";
	 
	 }
	 
	 }
	 
	$this->sList_gra .="</select>"; 
	return $this->sList_gra;

}
//---------------------------------Select List Graphics-----------------------------/////////


//---------------------------------Select List Color-----------------------------/////////
function selectcolor($selName, $selFun, $selSize, $selClass, $selSel, $qry){

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" class=\"textfield1\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}



	
	 while($code = mysqli_fetch_array($qry)) {
	 $id=$code[0];
	 $title=$code[1];
	 if($selSel==$code[0]){
	 $this->sList .= "<option value=\"".$id."\" selected>".$title."</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$id."\" >".$title."</option>";
	 
	 }
	 
	 }
	 
	$this->sList .="</select>"; 
	return $this->sList;

}
//---------------------------------Select List color-----------------------------/////////


//---------------------------------Select List Accessories-----------------------------/////////
function selectAcc($selName, $selFun, $selSize, $selClass, $selSel, $qry,$catName){

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" class=\"textfield1\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}



	$this->sList .= "<option value=\"0^0^0\">No $catName</option>";
	
	 while($code = mysqli_fetch_array($qry)) {
	 $title=$code[0];
	 $p=$code[1];
	 for($i=1; $i<=$code[3]; $i++){
	 if($selSel==$code[2]){
	 $this->sList .= "<option value=\"".$code[2]."^".$i."^".$p."\" selected>".$i." - ".$code[0]." [ Add $".($p*$i)." ]</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$code[2]."^".$i."^".$p."\" >".$i." - ".$code[0]." [ Add $".($p*$i)." ]</option>";
	 
	 }
	 }
	 }
	 
	$this->sList .="</select>"; 
	return $this->sList;

}
//---------------------------------Select List Accessories-----------------------------/////////

function RadioButtons($strLabel, $arrButtons, $strName, $nSelIndex = -1 ,$jFun="", $nJFunId="")
	{
				
		for($i=0; $i<sizeof($arrButtons); $i++)
			if($i == $nSelIndex)
			{				
				if($jFun !="" && $nJFunId == $i)
				{
					echo "<input type=radio value=$i name=$strName checked $jFun>" . $arrButtons[$i] . "<br>";											
				}
				else
				{
					echo "<input type=radio value=$i name=$strName checked>" . $arrButtons[$i] . "<br>";											
				}	
			}	
			else
			{	
				if($jFun !="" && $nJFunId == $i)
				{						
					echo "<input type=radio value=$i name=$strName $jFun>" . $arrButtons[$i] . "<br>";					
				}
				else
				{
					echo "<input type=radio value=$i name=$strName>" . $arrButtons[$i] . "<br>";					
				}	
			}	

		echo "	</td>";
		echo "</tr>";
	}

function selectyear($selName, $selFun, $selTable, $selWf, $selWv, $selPre, $selSel, $selSize, $selClass,$selcap){

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" class=\"textfield1\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}
    $curyr = date('Y');


	$this->sList .= "<option value=\"0\">---</option>";
	
	 
	 for($i=1; $i<=30; $i++){
	 if($selSel==$curyr){
	 $this->sList .= "<option value=\"".$curyr."\" selected>".$curyr."</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$curyr."\" >".$curyr."</option>";
	 
	 }
	 $curyr = $curyr+1;
	 }
	
	 
	$this->sList .="</select>"; 
	return $this->sList;

}
function selectmonth($selName, $selFun, $selTable, $selWf, $selWv, $selPre, $selSel, $selSize, $selClass,$selcap){

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" class=\"textfield1\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}
    


	$this->sList .= "<option value=\"0\">---</option>";
	$curmonth = 1;
	 
	 for($i=1; $i<=12; $i++){
	 if($selSel==$curmonth){
	 $this->sList .= "<option value=\"".$curmonth."\" selected>".$curmonth."</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$curmonth."\" >".$curmonth."</option>";
	 
	 }
	 $curmonth = $curmonth+1;
	 }
	
	 
	$this->sList .="</select>"; 
	return $this->sList;

}
//----------------------		SelectList Function 		-----------------------------------------
function selectListShip($selName, $selFun, $selTable, $selWf, $selWv, $selPre, $selSel, $selSize, $selClass,$selcap){

$name=$selcap;
$id=$selPre;

	if($selSize==''){
	
	$this->sList="<select name=\"".$selName."\" class=\"$selClass\" onChange=\"".$selFun."\" >";
	
	}else{
	
	$this->sList="<select name=\"".$selName."\" class=\"textfield1\" onChange=\"".$selFun."\" size=\"$selSize\" multiple >";
	
	}

		if($selWv==''){
				$result = mysqli_query("SELECT ".$id.",".$name."  addr FROM $selTable where reg_sts = 'A' order by ".$selPre) or die(mysqli_error());

			}else{
				$result = mysqli_query("SELECT  ".$id.",".$name." addr FROM $selTable where $selWf='$selWv' and reg_sts = 'A' order by ".$selPre) or die(mysqli_error());
		}
	
	$name1 = "addr";
	$this->sList .=  "<option value=\"0\" selected>Select Address</option>";
	 while($code = mysqli_fetch_object($result)) {
	 
	 if($selSel==$code->$id){
	 $this->sList .= "<option value=\"".$code->$id."\" selected>".$code->$name1."</option>";
	 }else{
	 
	 $this->sList .= "<option value=\"".$code->$id."\" >".$code->$name1."</option>";
	 
	 }
	 
	 }
	 
	$this->sList .="</select>"; 
	return $this->sList;

}

//**************Image Control Added on 30th March, 2008

function imgControl($p, $h, $b){
$this->imgOver = "<img src=\"$p\"  border=\"0\" title=\"header=[".$h."] body=[".$b."] delay=[50] fade=[on] fadespeed=[0.08] offsetx=[20]\" />";
return $this->imgOver;
}//ic Ended

//**************For Panels
function pannelControl($w, $col, $hCss, $h, $g, $wh, $link){


	$this->panel="<table width=\"".$w."\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td>
	
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"9\"><img src=\"images/".$col."_left.gif\" width=\"9\" height=\"30\" /></td>
        <td class=\"".$col."_left ".$hCss."\" width = \"".$wh."\">".$h."</td>
        <td width=\"24\"><img src=\"images/".$col."_m.gif\" width=\"24\" height=\"30\" /></td>
        <td class=\"".$col."_bg red_text_r\" >".$link."</td>
        <td width=\"9\"><img src=\"images/".$col."_right.gif\" width=\"9\" height=\"30\" /></td>
      </tr>
    </table>
	
	</td>
  </tr>
  <tr>
    <td class=\"".$g."\">";
		
	return $this->panel;
}
//** Panels ended

//**************For Panels
function pannelControl_e($w, $g){
$bw= $w-18;

	$this->panel2 ="</td>
  </tr>
  <tr>
    <td class=\"".$g."\">	
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td width=\"9\" height=\"9\"><img src=\"images/".$g."_left_c.gif\" /></td>
        <td class=\"dgH\" width=\"".$bw."\" ></td>
        <td width=\"9\" height=\"9\" align=\"right\"><img src=\"images/".$g."_right_c.gif\" /></td>
      </tr>
    </table>
	
	</td>
  </tr>
</table>
";
	return $this->panel2;
}
//** Panels ended

//*************method for Getting name

function mtype($id, $t , $f){
$this->mType ="";
$result = mysqli_query("SELECT * FROM $t where $f = '".$id."'") or die(mysqli_error());
while($rstRow = mysqli_fetch_array($result))
	{
$this->mType=$rstRow['1'];
}
return $this->mType;
}

function mdes($id, $t , $f,$desccol){
$result = mysqli_query("SELECT * FROM $t where $f = '".$id."'") or die(mysqli_error());
while($rstRow = mysqli_fetch_array($result))
	{
$this->mDes=$rstRow[$desccol];
}
return $this->mDes;
}



function demail(){
$result = mysqli_query("SELECT * FROM tblconfig  where id=1") or die(mysqli_error());
while($rstRow = mysqli_fetch_array($result))
	{
$this->emailD=$rstRow['1'];
}
return $this->emailD;
}

function dAdd(){
$result = mysqli_query("SELECT * FROM tblconfig  where id=1") or die(mysqli_error());
while($rstRow = mysqli_fetch_array($result))
	{
$this->addD=$rstRow['2'];
}
return $this->addD;
}
//***************************** E-Grid*************************

function e_grid($hCss, $lCss, $aW, $tN, $tF, $iF, $oB, $aD,$aU,$oF){


	$this->eGrid="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\" padding-left:20px; padding-right:20px;\">
  <tr>
    <td class=\"".$hCss."\" width=\"30\">S No.</td>
	<td class=\"".$hCss."\" width=\"".$aW."\">Action</td>
	<td class=\"".$hCss."\">Title</td></tr>";
//	$ordBy = ($oB == 'I') ? $tF : $iF;	
$ordBy = ($oB == 'T') ? $iF : $oB;	
	$result = "SELECT * from ".$tN."  order by ".$ordBy;
					$nResult = mysqli_query($result);
					$nrows=mysqli_num_rows($nResult);
$i=1;
while($rstRow = mysqli_fetch_array($nResult))
	{
	$cont=explode(",",$aD);
	$contU=explode(",",$aU);
	$elink="";
	for($x=0;$x<count($cont);$x++){
	if($contU[$x]=='self'){
	$link="index_admin.php?chkp=".$_REQUEST['chkp']."&cmdType=edit&mid=".base64_encode($rstRow[$iF]);
	}elseif($contU[$x]=='p1'){
	$link="index_admin.php?chkp=".($_REQUEST['chkp']+1)."&mid=".base64_encode($rstRow[$iF]);
	}else{
	$link=$contU[$x]."?chkp=".$_REQUEST['chkp']."&mid=".base64_encode($rstRow[$iF]);
	}
		if($cont[$x]=='e'){
		
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/edit_small.jpg",$rstRow[$tF],"Click icon to edit.")."</a>";
		}elseif($cont[$x]=='d'){
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/delete_small.jpg",$rstRow[$tF],"Click icon to delete.")."</a>";
		}elseif($cont[$x]=='up'){
			if($i <= 1){
			$elink .= "<img src=\"images/down_order.jpg\" />";
			}else{
			$elink .= "<a href=\"".$link."&ifl=".base64_encode("men_id")."&of=".base64_encode("men_order")."&t=".base64_encode($tN)."&act=up&rank=".$rstRow[$oF]."\">".$this->imgControl("images/up_order.jpg",$rstRow[$tF],"Click icon to Move up.")."</a>";
			
			}

		}elseif($cont[$x]=='dn'){
			if($i >= $nrows){
			$elink.="<img src=\"images/up_order.jpg\" />";
			}else{
			$elink .= "<a href=\"".$link."&ifl=".base64_encode("men_id")."&of=".base64_encode("men_order")."&t=".base64_encode($tN)."&act=dn&rank=".$rstRow[$oF]."\">".$this->imgControl("images/down_order.jpg",$rstRow[$tF],"Click icon to Move up.")."</a>";
			
			}		
		}elseif($cont[$x]=='m'){
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/more_img.jpg",$rstRow[$tF],"Click icon to add more images.")."</a>";
		}elseif($cont[$x]=='s'){
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/add_sub_cat.jpg",$rstRow[$tF],"Click icon to add child.")."</a>";
		}
	}
	
	$this->eGrid .= "<tr>
    <td class=\"".$lCss."\" width=\"30\">".$i."</td>
	<td class=\"".$lCss."\" width=\"".$aW."\">".$elink."</td>
	<td class=\"".$lCss."\"><a href=\"index_admin.php?chkp=".$_REQUEST['chkp']."&cmdType=edit&mid=".base64_encode($rstRow[$iF])."\">".$rstRow[$tF]."</a></td></tr>";

$i++;
}//loop ended
$this->eGrid .= "</table>";
	
	return $this->eGrid;
	}///eGrid Ended
//////////////////////////////////////////////////////////////////////////


function e_grid1($hCss, $lCss, $aW, $tN, $tF, $iF, $oB, $aD,$aU,$oF){


	$this->eGrid="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\" padding-left:20px; padding-right:20px;\">
  <tr>
    <td class=\"".$hCss."\" width=\"30\">S No.</td>
	<td class=\"".$hCss."\" width=\"".$aW."\">Action</td>
	<td class=\"".$hCss."\">Title</td></tr>";
//	$ordBy = ($oB == 'I') ? $tF : $iF;	
$ordBy = ($oB == 'T') ? $iF : $oB;	
	$result = "SELECT * from ".$tN."  order by ".$ordBy;
					$nResult = mysqli_query($result);
					$nrows=mysqli_num_rows($nResult);
$i=1;
while($rstRow = mysqli_fetch_array($nResult))
	{
	$cont=explode(",",$aD);
	$contU=explode(",",$aU);
	$elink="";
	for($x=0;$x<count($cont);$x++){
	if($contU[$x]=='self'){
	$link="index_admin.php?chkp=".$_REQUEST['chkp']."&cmdType=edit&mid=".base64_encode($rstRow[$iF]);
	}elseif($contU[$x]=='p1'){
	$link="index_admin.php?chkp=".($_REQUEST['chkp']+1)."&mid=".base64_encode($rstRow[$iF]);
	}else{
	$link=$contU[$x]."?chkp=".$_REQUEST['chkp']."&cmdType=delcat&mid=".base64_encode($rstRow[$iF]);
	}
		if($cont[$x]=='e'){
		
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/edit_small.jpg",$rstRow[$tF],"Click icon to edit.")."</a>";
		}elseif($cont[$x]=='d'){
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/delete_small.jpg",$rstRow[$tF],"Click icon to delete.")."</a>";
		}elseif($cont[$x]=='up'){
			if($i <= 1){
			$elink .= "<img src=\"images/down_order.jpg\" />";
			}else{
			$elink .= "<a href=\"".$link."&ifl=".base64_encode("cat_id")."&of=".base64_encode("men_order")."&t=".base64_encode($tN)."&act=up&rank=".$rstRow[$oF]."\">".$this->imgControl("images/up_order.jpg",$rstRow[$tF],"Click icon to Move up.")."</a>";
			
			}

		}elseif($cont[$x]=='dn'){
			if($i >= $nrows){
			$elink.="<img src=\"images/up_order.jpg\" />";
			}else{
			$elink .= "<a href=\"".$link."&ifl=".base64_encode("cat_id")."&of=".base64_encode("men_order")."&t=".base64_encode($tN)."&act=dn&rank=".$rstRow[$oF]."\">".$this->imgControl("images/down_order.jpg",$rstRow[$tF],"Click icon to Move up.")."</a>";
			
			}		
		}elseif($cont[$x]=='m'){
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/more_img.jpg",$rstRow[$tF],"Click icon to add more images.")."</a>";
		}elseif($cont[$x]=='s'){
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/add_sub_cat.jpg",$rstRow[$tF],"Click icon to add child.")."</a>";
		}
	}
	
	$this->eGrid .= "<tr>
    <td class=\"".$lCss."\" width=\"30\">".$i."</td>
	<td class=\"".$lCss."\" width=\"".$aW."\">".$elink."</td>
	<td class=\"".$lCss."\"><a href=\"index_admin.php?chkp=".$_REQUEST['chkp']."&cmdType=edit&mid=".base64_encode($rstRow[$iF])."\">".$rstRow[$tF]."</a></td></tr>";

$i++;
}//loop ended
$this->eGrid .= "</table>";
	
	return $this->eGrid;
	}///eGrid Ended



//////////////////////////////////////////////////////////////////////////

// Function for Menus
function drawMenu(){
  $this->nav= '<div id="ddtopmenubar" class="ddcolortabs" style="padding-left:15px;">
<ul>';
$sqlMenu="SELECT * FROM tblmenu WHERE men_master_id=0 AND men_place=1 order by men_order";
$ressqlMenu=mysqli_query($sqlMenu);
$i=1;
while($record=mysqli_fetch_array($ressqlMenu))
{

$qr=mysqli_query("select * FROM tblmenu where men_master_id ='".$record['men_id']."' order by men_order");
		$nrs=mysqli_num_rows($qr);
		if($nrs>0){
		$rel='rel="ddsubmenu'.$record['men_id'].'"';
		$lname=$lname.$record['men_id'].",";
		}else{
		$rel='';
		}
	if($rel=='')
	$menlink=$record["men_link"];
	else
	$menlink="#";
// for page links
if($record["men_link"]=="")
$FinalLink="page.php?pid=".$record['men_id'];
else
$FinalLink=$record["men_link"]."?pid=".$record['men_id'];
// if link is empty it directly throw to page.php other throw it to the given link.
			   if($record["men_id"]==1)
			   {
			   $this->nav.= '<li><span><a  href="'.$FinalLink.'" '.$rel.' class="selected" >'.$record["men_name"].'</a></span></li>
			   				 <li><span>|</span></li>';
			   }
			   else
			   {
				 $this->nav.= '<li><span><a href="'.$FinalLink.'" '.$rel.' >'.$record["men_name"].'</a></span></li>
				 			   <li><span>|</span></li>';
			   }


}

$this->nav.= '</ul></div>';
?>

<?php
$sqlMenu1="SELECT * FROM tblmenu WHERE men_master_id=0 AND men_place=1 order by men_order";
$ressqlMenu1=mysqli_query($sqlMenu1);
$i=1;
while($record1=mysqli_fetch_array($ressqlMenu1))
{
$this->nav.= '<div id="ddsubmenu'.$record1['men_id'].'" class="dropmenudiv_a">';
$q="select * from tblmenu where men_master_id ='".$record1["men_id"]."' order by men_order";
$qr=mysqli_query($q);
		$nrs=mysqli_num_rows($qr);
		while ($db_field1 = mysqli_fetch_array($qr) ) {
// for same as above
if($db_field1["men_link"]=="")
$FinalLink1="page.php?pid=".$db_field1['men_id'];
else
$FinalLink1=$db_field1["men_link"]."?pid=".$db_field1['men_id'];
//for sub menus.
		  $this->nav.= '<a href="'.$FinalLink1.'">'.$db_field1['men_name'].'</a>';

		}
$this->nav.= '</div>';		
}
$this->nav.='<script type="text/javascript">
//SYNTAX: tabdropdown.init("menu_id", [integer OR "auto"])
tabdropdown.init("ddtopmenubar",3)
</script>';
return $this->nav;
  
}//Menu Ended
//Function For Footer Menu
function drawfooterMenu($loc){
  
/*$sqlmenu="SELECT
tblmenu.men_name, tblmenu.men_alias, tblmenu.men_id
FROM
menu_place
Inner Join tblmenu ON menu_place.mp_id = tblmenu.men_place
WHERE
menu_place.mp_abv = '".$loc."' ORDER BY men_order";*/
$sqlmenu="SELECT
tblmenu.men_name, tblmenu.men_alias, tblmenu.men_id
FROM
menu_place
Inner Join tblmenu ON menu_place.mp_id = tblmenu.men_place
WHERE
men_master_id=0 AND men_place=1 ORDER BY men_order";
  $ressqlmenu=mysqli_query($sqlmenu);
  $this->footerMenu="<div id='navf'><ul>";
  while($row=mysqli_fetch_array($ressqlmenu))
  {
     $alias=$row["men_alias"];
	 $this->footerMenu.="<li><a href='".$alias."'>".$row["men_name"]."&nbsp;&nbsp;<span style='color:#FFFFFF;'>|</span></a></li>";
  }
  
 $this->footerMenu .="</ul></div>";
  return $this->footerMenu;
  
}//Menu Ended
function contactchange()
{
$thefile="admin/contact.txt";
$this->contact= file_get_contents($thefile);
return $this->contact;
}
// function for top flash banner
function flash_banner()
{
$this->banner='<img src="images/top_img_part_01.jpg" border="0" style="float:left;" />
<div id="navLayer" style=\"z-index=0;\"><script language="javascript">
CreateControl(document.getElementById("navLayer"),
"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
"fmov", "880", "177", "header-1.swf","transparent");

</script></div>';
return $this->banner;
}
//end of function
// Customer Speak Function
function cs_feedback()
{
$sql="SELECT * FROM tblcustomer_speak ORDER BY RAND() LIMIT 1";
$rec=mysqli_query($sql);
$record=mysqli_fetch_array($rec);
$this->cs='<div style="padding-top:15px; float:left;"><img src="images/rbar_bpanel_top.gif" /><dl>
<dt class="rbpanel"><p>Customer Speak</p><img src="images/rbar_bpanel_line.gif" style="padding-left:5px;" /><br/><span class="rpanel_btxt" style="padding-right:18px;padding-left:8px;width:240px;">"'.$record["cs_desc"].'"<br/><br />
</span>
<span class="rpanel_italian">'.substr($record["b_tag"],0,45).'</span>
</dt>
</dl><img src="images/rbar_bpanel_bbottom.gif" /></div></div>';
return $this->cs;
}
//End of function
function chklogin()
{
if($_SESSION["login_id"])
{
$this->login="<a href='logout.php' class='log_reg' style='padding-right:23px;'>Logout</a>";

}
else
{
$this->login="<a href='signin' class='log_reg' style='padding-right:23px;'>Login</a>";
}
return $this->login;
}
///////

function e_grid2($hCss, $lCss, $aW, $tN, $tF, $iF, $oB, $aD,$aU,$oF,$type){


	$this->eGrid2="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\" padding-left:20px; padding-right:20px;\">
  <tr>
    <td class=\"".$hCss."\" width=\"30\">S No.</td>
	<td class=\"".$hCss."\" width=\"".$aW."\">Action</td>
	<td class=\"".$hCss."\">Title</td></tr>";
//	$ordBy = ($oB == 'I') ? $tF : $iF;	
$ordBy = ($oB == 'T') ? $iF : $oB;	
	$result = "SELECT * from ".$tN." WHERE type='".$type."'  order by ".$ordBy;
				$nResult = mysqli_query($result);
					$nrows=mysqli_num_rows($nResult);
$i=1;
while($rstRow = mysqli_fetch_array($nResult))
	{
	$cont=explode(",",$aD);
	$contU=explode(",",$aU);
	$elink="";
	for($x=0;$x<count($cont);$x++){
	if($contU[$x]=='self'){
	$link="index_admin.php?chkp=".$_REQUEST['chkp']."&doc=".$type."&cmdType=edit&mid=".base64_encode($rstRow[$iF]);
	}elseif($contU[$x]=='p1'){
	$link="index_admin.php?chkp=".($_REQUEST['chkp']+1)."&mid=".base64_encode($rstRow[$iF]);
	}else{
	$link=$contU[$x]."&chkp=".$_REQUEST['chkp']."&mid=".base64_encode($rstRow[$iF]);
	}
		if($cont[$x]=='e'){
		
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/edit_small.jpg",$rstRow[$tF],"Click icon to edit.")."</a>";
		}elseif($cont[$x]=='d'){
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/delete_small.jpg",$rstRow[$tF],"Click icon to delete.")."</a>";
		}elseif($cont[$x]=='up'){
			if($i <= 1){
			$elink .= "<img src=\"images/no_up_dn.jpg\" />";
			}else{
			$elink .= "<a href=\"".$link."&ifl=".base64_encode("men_id")."&of=".base64_encode("men_order")."&t=".base64_encode($tN)."&act=up&rank=".$rstRow[$oF]."\">".$this->imgControl("images/up_order.jpg",$rstRow[$tF],"Click icon to Move up.")."</a>";
			
			}

		}elseif($cont[$x]=='dn'){
			if($i >= $nrows){
			$elink.="<img src=\"images/no_up_dn.jpg\" />";
			}else{
			$elink .= "<a href=\"".$link."&ifl=".base64_encode("men_id")."&of=".base64_encode("men_order")."&t=".base64_encode($tN)."&act=dn&rank=".$rstRow[$oF]."\">".$this->imgControl("images/down_order.jpg",$rstRow[$tF],"Click icon to Move up.")."</a>";
			
			}		
		}elseif($cont[$x]=='m'){
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/more_img.jpg",$rstRow[$tF],"Click icon to add more images.")."</a>";
		}elseif($cont[$x]=='s'){
		$elink .= "<a href=\"".$link."\">".$this->imgControl("images/add_sub_cat.jpg",$rstRow[$tF],"Click icon to add child.")."</a>";
		}
	}
	
	$this->eGrid2 .= "<tr>
    <td class=\"".$lCss."\" width=\"30\">".$i."</td>
	<td class=\"".$lCss."\" width=\"".$aW."\">".$elink."</td>
	<td class=\"".$lCss."\"><a href=\"index_admin.php?chkp=".$_REQUEST['chkp']."&doc=".$type."&cmdType=edit&mid=".base64_encode($rstRow[$iF])."\">".$rstRow[$tF]."</a></td></tr>";

$i++;
}//loop ended
$this->eGrid2 .= "</table>";
	
	return $this->eGrid2;
	}///eGrid Ended

function send_mail($prod,$email,$name,$telephone,$mobile)
{
$sql="SELECT * FROM tblcontentpages WHERE con_id=58";
$sqlres=mysqli_query($sql);
$record=mysqli_fetch_array($sqlres);
$msg=$record["con_body"];
$to =array("services@cyberforcesolutions.co.uk","$email");
//$to.= $email;
$subject = "Thanks to download $prod";
$header = "MIME-Versin: 1.0\n" .
		   "Content-type: text/html; charset=ISO-8859-1; format=flowed\n" .
		   "Content-Transfer-Encoding: 8bit\n" .
		   "From: $name\n" .
		   "X-Mailer: PHP" . phpversion();
//echo $msg;
	for($i=0;$i<count($to);$i++)
	{
	    @mail($to[$i],$subject,$msg,$header);
	}
}
function feature_product()
{
$this->fprod='';
$sql="SELECT * FROM tblproducts WHERE featured='y'";
$recsql=mysqli_query($sql);
$this->fprod.='<div style="width:180px; padding-left:96px;position:ewlative;" ><br />
<br />
<br />
';
while($resrec=mysqli_fetch_array($recsql))
{
$this->fprod.='<img src="images/rbar_sarrow.gif" style="padding-left:15px; padding-top:15px;" /><a href="free-trial-download" class="rbar_txt">'.$resrec["pro_name"].'</a><br/>';
}
$this->fprod.="</div>";
return $this->fprod;
}
// for date of Birth
function frm_date($day, $month, $year)
{

$mon=array("Jan","Feb","March","April","May","June","July","Aug","Sep","Oct","Nov","Dec");
$this->udate='<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="24%"><select name="day" class="combo">';
					  for($i=1;$i<=31;$i++)
					  { 
					  if($i==$day) 
					  $var='<option value='.$i.' selected>'.$i.'</option>';
					  else
					  $var='<option value='.$i.'>'.$i.'</option>';
				$this->udate.=$var;
				      }
				$this->udate.='</select></td>
                      <td width="25%"><select name="month" class="combo">';
					  for($j=0;$j<=11;$j++)
					  { 
					  if($mon[$j]==$month) 
					  $varmon='<option value='.$mon[$j].' selected>'.$mon[$j].'</option>';
					  else
					  $varmon='<option value='.$mon[$j].'>'.$mon[$j].'</option>';
				$this->udate.=$varmon;
				      }
						  
						$this->udate.='</select>
					  </td>
                      <td><select name="year" style="margin-left:15px;" class="combo">';
					  for($k=1970;$k<=2008;$k++)
					  { 
							if($k==$year) 
								$var3='<option value='.$k.' selected>'.$k.'</option>';
							else
								$var3='<option value='.$k.'>'.$k.'</option>';
						$this->udate.=$var3;
				      }
				$this->udate.='</select></td>
                    </tr>
                  </table>';
return $this->udate;

}
function pos_alertmessages($msg,$msgtype){
	
	if($msgtype=="alert-danger")
	{
		$faicon="fa-fw fa fa-times";
		$famsg="Error!";
	}
	elseif($msgtype=="alert-info")
	{
		$faicon="fa-fw fa fa-info";
		$famsg="Info!";
	}
	elseif($msgtype=="alert-success")
	{
		$faicon="fa-fw fa fa-check";
		$famsg="Success";
	}
	elseif($msgtype=="alert-warning")
	{
		$faicon="fa-fw fa fa-warning";
		$famsg="Warning";
	}
	
	
	
	if($msgtype!="")
	{
		$this->alertmessages='
			<div class="alert '.$msgtype.' fade in">
				<button class="close" data-dismiss="alert">
					x
				</button>
				<i class="'.$faicon.'"></i>
				<strong>'.$famsg.'</strong> '.$msg.'
			</div>
		';
	}
	else
	{
		$this->alertmessages='';
	}
	return $this->alertmessages;
}
function pos_captcha_checking($pass,$captcha,$returnurl,$captch_return_inputs){
	
	if($pass!=$captcha)
	{
		$this->alertmessages='
			<form name="frmcaptcha" id="frmsuc" method="post" action="'.$returnurl.'">
				<input type="hidden" name="msg_type" id="msg_type" value="alert-danger" />
				<input type="hidden" name="msg" id="msg" value="Invalid Security Code String" /> 
				'.$captch_return_inputs.'
			</form>
			<script>
			  document.frmcaptcha.submit();
			</script>
		';
	}
	else
	{
		$this->alertmessages='';
	}
	return $this->alertmessages;
}
function numberFormat($Amount)
{
	return number_format(round($Amount,2),2);
}
}//class ended

?>