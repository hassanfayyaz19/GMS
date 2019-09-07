<?php

// *** CAPTCHA image generation ***
// *** http://frikk.tk ***

//session_start();

// *** Tell the browser what kind of file is come'n at 'em! ***
header("Content-Type: image/png");

// *** Send a generated image to the browser ***
die(create_image());

// *** Function List ***
function create_image()
{
	// *** Generate a passcode using md5
	//	(it will be all lowercase hex letters and numbers ***
	$md5 = md5(rand(0,9999));
	$pass = substr($md5, 10, 6);

	// *** Set the session cookie so we know what the passcode is ***
	$_SESSION["pass"] = $pass;

	// *** Create the image resource ***
	$image = imagecreatefrompng('imagecode_bg.png');
//	$image = imagecreatetruecolor(80, 40);

	// *** We are making two colors, white and black ***
	$clr_white = ImageColorAllocate($image, 255, 255, 255);
	$clr_black = ImageColorAllocate($image, 0, 0, 0);

	// *** Make the background black ***
	
	//imagefill($image, 0, 0, $clr_black);
	
	// *** Set the image height and width ***
	/*imagefontheight(5);
	imagefontwidth(5);*/
	//$font=imageloadfont('Avril.ttf');
	

	// *** Add the passcode in white to the image ***
	
	$font = 'ank.ttf';

// Add some shadow to the text
imagettftext($image, 12, 5, 10, 30, $clr_black, $font, $pass);
	
//	imagestring($image, 5, 10, 10, $pass, $clr_black);

	// *** Throw in some lines to trick those cheeky bots! ***
/*
	imageline($image, 1, 1, 80, 1, $clr_white);
	imageline($image, 1, 39, 80, 39, $clr_white);
	imageline($image, 1, 1, 1, 40, $clr_white);
	imageline($image, 79, 1, 79, 40, $clr_white);*/

	// *** Return the newly created image in jpeg format ***
	return imagepng($image);

	// *** Just in case... ***
	imagedestroy($image);
}
?>
