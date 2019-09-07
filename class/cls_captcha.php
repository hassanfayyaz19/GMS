<?php

class captcha{


/*---------Class is created by Saqib Ahmad------------------------
------------ Dated Feb 05, 2007----------------------------------
Details for the function are commented above the function declaration
Usage of the class:

instance of the class;*/

var $imgSrc;
var $randStr;
var $strLen;
var $image;
var $md5v;
var $clr_white;
var $clr_black;
var $im;
function captcha(){

	//header("Content-Type: image/png");
	$this->imgSrc='imagecode_bg.png';
	$this->strLen=6;
	
	$this->md5v = md5(rand(0,9999));
	$this->randStr = substr($this->md5v, 10, $this->strLen);
	//$this->im=$this->create_image();
	$this->image = imagecreatefrompng($this->imgSrc);

	$this->clr_white = ImageColorAllocate($this->image, 255, 255, 255);
	$this->clr_black = ImageColorAllocate($this->image, 0, 0, 0);
		
	$this->im=imagestring($this->image, 5, 10, 10, $this->randStr, $this->clr_black);

	$this->im= imagepng($this->image);
	echo $this->im;

	imagedestroy($this->image);
}



}//class ended



?>
