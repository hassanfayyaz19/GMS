<?php

class imageFile{


/*---------Class is created by Saqib Ahmad------------------------
------------ Dated Feb 09, 2007----------------------------------
Details for the function are commented above the function declaration
Usage of the class:

instance of the class;*/

var $mass;//Massage
var $tName;//TempFile name for Upload
var $fName;//file name for save
var $imagePath;//Image Path
var $rsImg;//Is Resise Image
var $imgx;//image Width
var $imgy;// image height
var $thx;// thumb width
var $thy;// thumb height
var $imglock;//h:w:p lock the height...etc;




//-------------------------- Constructor-------------------------------------------------
function imageFile($rsimg){

	header('Content-type: image/jpeg');

	
	$this->rsImg = $rsimg;

	

}


/*$file_name(File name to be save on the disk), $temp_name(Temp Name), $imgR(is Image Resise True : False), $imgx(new width), $imgy(new height), $lock(h:w:p lock the height...etc), $strlogo watermark Path, $imp iamge destination folder Path

-----------------	Image Upload function	---------------------------------------
-----------------	---------------------	---------------------------------------

*/

function imageUpload($file_name, $temp_name, $imgx, $imgy, $lock, $strlogo, $imp){

			$this->tName=$temp_name;
			$this->fName=$file_name;
			$this->imagePath = $imp;
		
			$this->imgx = $imgx;
			$this->imgy = $imgy;
			$this->lock = $lock;
			
		// Upload File
		move_uploaded_file($this->tName, $this->imagePath . $this->fName);
		
		if (file_exists($this->imagePath . $this->fName)){
		//$this->mass=1;
 		} else {
			
		$this->mass="Errors!!";
		}
		
		
		if($this->rsImg==true){
		// Calling Resize Func--------------------------------------------------------------------------
		$this->imageRsz($this->imagePath . $this->fName, $this->imgx, $this->imgy, $this->lock, $strlogo, $this->imagePath);
		//$this->mass= 1;
		
		}
return $this->mass;
}

/*-------------Resizing Image Function Started -----------------------------------------------
imageRsz($fname, width, height, lock, watermark path, destination folder path )
----------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------
*/

function imageRsz($fname, $ix, $iy, $lock, $strlogo, $imp ){

			$filename = $fname;
			$this->imgx = $ix;
			$this->imgy = $iy;
			$this->lock = $lock;
			$this->imagePath = $imp;
			$img_ext=substr($filename,strlen($filename)-3,strlen($filename));

//----------------- Set a maximum height and width ------------------------
			$width = $this->imgx;
			$height = $this->imgy;


// Get new dimensions-----------------------------------------------------

list($width_orig, $height_orig) = getimagesize($filename);

//-------------------- Condition for height width check--------------------

if($width_orig >= $width || $height_orig >= $height){

//-----------Condition for lock--------------------------------------------

if($this->lock != 'h' && $this->lock!='w'){

if($width_orig > $height_orig){

	$chkw = ($height / $height_orig) * $width_orig;
	
		if($chkw < $width){
		//	$chkh=$height;
		$this->lock='h';
		}else{
		$this->lock='w';
		}
}else{

$chkh = ($width / $width_orig) * $height_orig;   
	if($chkh < $height){
	$this->lock='w';
	}else{
	$this->lock='h';
	}
}
}

if($this->lock=='h'){
	if($height < $height_orig){
	$width = ($height / $height_orig) * $width_orig;
	$height=$height;
	}else{
	$height=$height_orig;
	$width=$width_orig;	
	}

}else if($this->lock=='w') {
	if($width < $width_orig){
	$height = ($width / $width_orig) * $height_orig;   
	$width=$width;
	}else{
	$height=$height_orig;
	$width=$width_orig;
	}
}// Condition ended 


// Resample
$image_p = imagecreatetruecolor($width, $height);



if(strtoupper($img_ext)=='JPG'){
$image = imagecreatefromjpeg($filename);
}else if(strtoupper($img_ext)=='GIF'){
$image = imagecreatefromgif($filename);
}else if(strtoupper($img_ext)=='PNG'){
$image = imagecreatefrompng($filename);
}

$white = imagecolorallocate($image_p,255,255,255);
//$Gray = imagecolorallocate($line,230,230,230);
imagefill($image_p, 0, 0, $white);

imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

//------------ if User Lock both dimentions--------------------------------------------------

if($lock == 'b'){

//------------- Creating new image of lock dimentions---
Header('Content-type: image/png');
$image_p1 = imagecreatetruecolor($ix, $iy);
$white = imagecolorallocate($image_p1,255,255,255);
imagefill($image_p1, 0, 0, $white);

$xp=ceil(($ix-$width)/2);
$yp=ceil(($iy-$height)/2);

//-------imagecopy(destination,sourceimage,destx,desty,srcx,srcy,srcwidth,srcheight);
imagecopy($image_p1, $image_p, $xp, $yp, 0, 0, $width, $height);
// is there any water mark-------------------------------
$this->mass=$xp;
if($strlogo !=''){
list($width_lo, $height_lo) = getimagesize($strlogo);

$xp=($ix-$width_lo)/2;
$yp=($iy-$height_lo)/2;



Header('Content-type: image/png');

$line = imagecreatetruecolor($ix,$iy);
$white = imagecolorallocate($line,255,255,255);
$Gray = imagecolorallocate($line,230,230,230);
imagefill($line, 0, 0, $Gray);

imagesetthickness($line,2);
imageline($line, 0, 0, $ix, $iy, $white);
imageline($line, $ix, 0, 0, $iy,  $white);
ImageFilledRectangle($line,$xp,$yp,$width_lo+$xp,$height_lo+$yp,$Gray);
imagecolortransparent($line,$Gray);

$logo = imagecreatefrompng($strlogo);
imagecopy($image_p1, $logo,$xp,$yp,0,0,$width_lo, $height_lo);
imagecopymerge($image_p1, $line,0,0,0,0,$width, $height,100);
}// water Mark Pasting ended*------------------------------------------

//-----------output to destination folder------------------------------
imagejpeg($image_p1, $this->imagePath.$this->fName, 100);
//imagejpeg($image_p, $this->imagePath.$this->fName, 50);


}else{

// is there any water mark-------------------------------
if($strlogo !=''){

list($width_lo, $height_lo) = getimagesize($strlogo);

$xp=($width-$width_lo)/2;
$yp=($height-$height_lo)/2;

Header('Content-type: image/png');

$line = imagecreatetruecolor($width,$height);
$white = imagecolorallocate($line,255,255,255);
$Gray = imagecolorallocate($line,230,230,230);
imagefill($line, 0, 0, $Gray);

imagesetthickness($line,2);
imageline($line, 0, 0, $width, $height, $white);
imageline($line, $width, 0, 0, $height,  $white);
ImageFilledRectangle($line,$xp,$yp,$width_lo+$xp,$height_lo+$yp,$Gray);
imagecolortransparent($line,$Gray);

$logo = imagecreatefrompng($strlogo);


imagecopy($image_p, $logo,$xp,$yp,0,0,$width_lo, $height_lo);
imagecopymerge($image_p, $line,0,0,0,0,$width, $height,100);

}// water Mark Pasting ended*------------------------------------------

//-----------output to destination folder------------------------------

if(strtoupper($img_ext)=='JPG'){
imagejpeg($image_p, $this->imagePath.$this->fName, 100);
}else if(strtoupper($img_ext)=='GIF'){
imagegif($image_p, $this->imagePath.$this->fName);
}else if(strtoupper($img_ext)=='PNG'){
imagepng($image_p, $this->imagePath.$this->fName);
}




}// con for lock both Ended--------------------------------------------
}// Condition ended for height width check------------------------------
//imagejpeg($image_p, $this->imagePath.$this->fName, 50);
//$this->mass=1;

return $this->mass;
}



/*----------------Image Resize Old contains croped thumbs function----------------------------------------------------------*/
function imageRszcrop($fname, $ix, $iy, $lock, $strlogo, $imp ){

			$filename = $fname;
			$this->imgx = $ix;
			$this->imgy = $iy;
			$this->lock = $lock;
			$this->imagePath = $imp;
			$img_ext=substr($filename,strlen($filename)-3,strlen($filename));

//----------------- Set a maximum height and width ------------------------
			$width = $this->imgx;
			$height = $this->imgy;


// Get new dimensions-----------------------------------------------------

list($width_orig, $height_orig) = getimagesize($filename);

//-------------------- Condition for height width check--------------------

if($width_orig >= $width || $height_orig >= $height){

//-----------Condition for lock--------------------------------------------

if($this->lock != 'h' && $this->lock!='w'){

if($width_orig > $height_orig){

	$chkw = ($height / $height_orig) * $width_orig;
	
		if($chkw < $width){
		//	$chkh=$height;
		$this->lock='w';
		}else{
		$this->lock='h';
		}
}else{

$chkh = ($width / $width_orig) * $height_orig;   
	if($chkh < $height){
	$this->lock='h';
	}else{
	$this->lock='w';
	}
}
}

if($this->lock=='h'){

	$width = ($height / $height_orig) * $width_orig;
	$height=$height;

}else if($this->lock=='w') {
	
	$height = ($width / $width_orig) * $height_orig;   
	$width=$width;

}// Condition ended 


// Resample
$image_p = imagecreatetruecolor($width, $height);
$img_ext=substr($filename,strlen($filename)-3,strlen($filename));
if(strtoupper($img_ext)=='JPG'){
$image = imagecreatefromjpeg($filename);
}else if(strtoupper($img_ext)=='GIF'){
$image = imagecreatefromgif($filename);
}else if(strtoupper($img_ext)=='PNG'){
$image = imagecreatefrompng($filename);
}




imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

//------------ if User Lock both dimentions--------------------------------------------------

if($lock == 'b'){

//------------- Creating new image of lock dimentions---

$image_p1 = imagecreatetruecolor($ix, $iy);

$xp=($width-$ix)/2;
$yp=($height-$iy)/2;

//-------imagecopy(destination,sourceimage,destx,desty,srcx,srcy,srcwidth,srcheight);
imagecopy($image_p1, $image_p,0,0,$xp,$yp,$ix, $iy);

// is there any water mark-------------------------------
if($strlogo !=''){

list($width_lo, $height_lo) = getimagesize($strlogo);

$xp=($ix-$width_lo)/2;
$yp=($iy-$height_lo)/2;



Header('Content-type: image/png');

$line = imagecreatetruecolor($ix,$iy);
$white = imagecolorallocate($line,255,255,255);
$Gray = imagecolorallocate($line,230,230,230);
imagefill($line, 0, 0, $Gray);

imagesetthickness($line,2);
imageline($line, 0, 0, $ix, $iy, $white);
imageline($line, $ix, 0, 0, $iy,  $white);
ImageFilledRectangle($line,$xp,$yp,$width_lo+$xp,$height_lo+$yp,$Gray);
imagecolortransparent($line,$Gray);

$logo = imagecreatefrompng($strlogo);
imagecopy($image_p1, $logo,$xp,$yp,0,0,$width_lo, $height_lo);
imagecopymerge($image_p1, $line,0,0,0,0,$width, $height,100);

}// water Mark Pasting ended*------------------------------------------

//-----------output to destination folder------------------------------
imagejpeg($image_p1, $this->imagePath.$this->fName, 100);


}else{

// is there any water mark-------------------------------
if($strlogo !=''){

list($width_lo, $height_lo) = getimagesize($strlogo);

$xp=($width-$width_lo)/2;
$yp=($height-$height_lo)/2;

Header('Content-type: image/png');

$line = imagecreatetruecolor($width,$height);
$white = imagecolorallocate($line,255,255,255);
$Gray = imagecolorallocate($line,230,230,230);
imagefill($line, 0, 0, $Gray);

imagesetthickness($line,2);
imageline($line, 0, 0, $width, $height, $white);
imageline($line, $width, 0, 0, $height,  $white);
ImageFilledRectangle($line,$xp,$yp,$width_lo+$xp,$height_lo+$yp,$Gray);
imagecolortransparent($line,$Gray);

$logo = imagecreatefrompng($strlogo);


imagecopy($image_p, $logo,$xp,$yp,0,0,$width_lo, $height_lo);
imagecopymerge($image_p, $line,0,0,0,0,$width, $height,100);

}// water Mark Pasting ended*------------------------------------------

//-----------output to destination folder------------------------------
if(strtoupper($img_ext)=='JPG'){
imagejpeg($image_p, $this->imagePath.$this->fName, 100);
}else if(strtoupper($img_ext)=='GIF'){
imagegif($image_p, $this->imagePath.$this->fName);
}else if(strtoupper($img_ext)=='PNG'){
imagepng($image_p, $this->imagePath.$this->fName);
}


}// con for lock both Ended--------------------------------------------
}// Condition ended for height idth check------------------------------
$this->mass=1;

return $this->mass;
}


}//class ended



?>
