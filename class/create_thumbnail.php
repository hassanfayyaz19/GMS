<?php
	/*
	Function ditchtn($arr,$thumbname)
	filters out thumbnails
	*/
	function ditchtn($arr,$thumbname) {
		foreach ($arr as $item)
		{
			if (!preg_match("/^".$thumbname."/",$item)){$tmparr[]=$item;}
		}
		return $tmparr;
	}

	/*
			Function directory($directory,$filters)
			reads the content of $directory, takes the files that apply to $filter 
			and returns an array of the filenames.
			You can specify which files to read, for example
			$files = directory(".","jpg,gif");
					gets all jpg and gif files in this directory.
			$files = directory(".","all");
					gets all files.
	*/
	function directory($dir,$filters) {
		$handle=opendir($dir);
		$files=array();
		if ($filters == "all"){while(($file = readdir($handle))!==false){$files[] = $file;}}
		if ($filters != "all")
		{
			$filters=explode(",",$filters);
			while (($file = readdir($handle))!==false)
			{
				for ($f=0;$f<sizeof($filters);$f++):
					$system=explode(".",$file);
					if ($system[1] == $filters[$f]){$files[] = $file;}
				endfor;
			}
		}
		closedir($handle);
		return $files;
	}

	/*
	Function createthumb($name,$filename,$new_w,$new_h)
	creates a resized image
	variables:
	$name		Original filename
	$filename	Filename of the resized image
	$new_w		width of resized image
	$new_h		height of resized image
	*/	
function createthumb($name,$filename,$new_w,$new_h) {
		$fn = basename($name); // extracting file name from the given url
		
		
		$len = strlen($fn);
		$l = $len - 3;
		//echo $l."<BR>";
		for ($i = 0; $i <= $len; $i++) {
			if ($i >= $l) { // If extension found
				$t = substr($fn,$i,1);
				$ext .= $t; // store extension in an array
			}	
		}
		
		//echo $ext."<BR>";
		
		if (preg_match('/jpg|jpeg/',$ext)) {
			$src_img = imagecreatefromjpeg($name);
		}
		if (preg_match('/png/',$ext)) {
			$src_img = imagecreatefrompng($name);
		}
		
	$old_x = imageSX($src_img);
		$old_y = imageSY($src_img);
		if ($old_x > $old_y) {
			$thumb_w = $new_w;
			$thumb_h = $old_y*($new_h/$old_x);
		}
		if ($old_x < $old_y) {
			$thumb_w = $old_x*($new_w/$old_y);
			$thumb_h = $new_h;
		}
		if ($old_x == $old_y) {
			$thumb_w = $new_w;
			$thumb_h = $new_h;
		}
		$dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
		if (preg_match("/png/",$system[1])) { // PNG
			imagepng($dst_img,$filename); 
		} else { // JPG
			imagejpeg($dst_img,$filename); 
		}
		imagedestroy($dst_img); 
		imagedestroy($src_img); 
	}
	
function CreateNormalPicture($name,$filename,$new_w,$new_h) {
		$fn = basename($name); // extracting file name from the given url
		//$system = explode('.',$fn); // then extracting file extension from the filename

//$system = explode('.',$fn); // then extracting file extension from the filename
		
		$len = strlen($fn);
		$l = $len - 3;
		//echo $l."<BR>";
		for ($i = 0; $i <= $len; $i++) {
			if ($i >= $l) { // If extension found
				$t = substr($fn,$i,1);
				$ext .= $t; // store extension in an array
			}	
		}
		
		
		$ext = strtolower($ext);
		if (preg_match('/jpg|jpeg/',$ext)) {
			$src_img = imagecreatefromjpeg($name);			
		}
		if (preg_match('/png/',$ext)) {
			$src_img = imagecreatefrompng($name);			
		}
		if (preg_match('/gif/',$ext)) {
			$src_img = imagecreatefromgif($name);			
		}
		
		$old_x = imageSX($src_img);
		$old_y = imageSY($src_img);
		$flg = false;
		if($old_x==$old_y){$case = 'first';}
		elseif($old_x > $old_y){$case = 'second';}
		else{$case = 'third';}
		if($old_x>$new_w && $old_y>$new_h){$flg = true;$cond = 'first';}
		elseif($old_x>$new_w && $old_y<=$new_h){$flg = true;$cond = 'first';}
		else{$cond = 'third';}
								
		switch($case)
			{
					case 'first':
						$flg = true;
						$thumb_w = $new_h;
						$thumb_h = $new_h;
					break;
					case 'second':
						$flg = true;
						$ratio = $old_x/$old_y;
						$amount = $old_x - $new_w;
						$thumb_w = $old_x - $amount;
						$thumb_h = $old_y - ($amount/$ratio);
					break;
					case 'third':
						$flg = true;
						$ratio = $old_y/$old_x;
						$amount = $old_y - $new_h;
						$thumb_h = $old_y - $amount;
						$thumb_w = $old_x - ($amount/$ratio);
					break;
				} 
		if($old_x < $new_w && $flg == false){$dst_x = ($new_w-$old_x)/2;}
		else{if($flg == true){$dst_x = ($new_w - $thumb_w)/2;}else{$dst_x = 0;}}
		if($old_y < $new_h  && $flg == false){$dst_y = ($new_h - $old_y)/2;}
		else{if($flg == true){$dst_y = ($new_h - $thumb_h)/2;}else{$dst_y = 0;}}
//		$dst_x=0;
//		$dst_y=0;
//		$thumb_w=$new_w;
//		$thumb_h=$new_h;
		
	 	$dst_img = ImageCreateTrueColor($new_w,$new_h);
		$bgColor = imagecolorallocate($dst_img, 55,53,54);
		imagefill($dst_img , 0,0 , $bgColor);
		
		imagecopyresampled($dst_img,$src_img,$dst_x,$dst_y,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
			
		if (preg_match("/png/",$system[1]))
		{ // PNG
			imagepng($dst_img,$filename,100); 
		}
		else if (preg_match("/gif/",$system[1]))
		{ // Gif
			imagegif($dst_img,$filename,100); 
		}
		else
		{ // JPG
			imagejpeg($dst_img,$filename,100); 
		}
		
		imagedestroy($dst_img); 
		imagedestroy($src_img); 
	}
	
function CreateHeaderPicture($name,$filename,$new_w,$new_h) {
		$fn = basename($name); // extracting file name from the given url
		//$system = explode('.',$fn); // then extracting file extension from the filename

//$system = explode('.',$fn); // then extracting file extension from the filename
		
		$len = strlen($fn);
		$l = $len - 3;
		//echo $l."<BR>";
		for ($i = 0; $i <= $len; $i++) {
			if ($i >= $l) { // If extension found
				$t = substr($fn,$i,1);
				$ext .= $t; // store extension in an array
			}	
		}
		
		
		$ext = strtolower($ext);
		if (preg_match('/jpg|jpeg/',$ext)) {
			$src_img = imagecreatefromjpeg($name);			
		}
		if (preg_match('/png/',$ext)) {
			$src_img = imagecreatefrompng($name);			
		}
		if (preg_match('/gif/',$ext)) {
			$src_img = imagecreatefromgif($name);			
		}
		
		$old_x = imageSX($src_img);
		$old_y = imageSY($src_img);
		$flg = false;
		
		
		if($old_x==$old_y){$case = 'first';}
		elseif($old_x > $old_y){$case = 'second';}
		else{$case = 'third';}
				
		if($old_x>$new_w && $old_y>$new_h){$flg = true;$cond = 'first';}
		elseif($old_x>$new_w && $old_y<=$new_h){$flg = true;$cond = 'first';}
		else{$cond = 'third';}
								
		switch($case)
		{
			case 'first':
				$flg = true;
				$thumb_w = $new_h;
				$thumb_h = $new_h;
			break;
			case 'second':
				$flg = true;
				$ratio = $old_x/$old_y;
				$amount = $old_x - $new_w;
				$thumb_w = $old_x - $amount;
				$thumb_h = $old_y - ($amount/$ratio);
			break;
			case 'third':
				$flg = true;
				$ratio = $old_y/$old_x;
				$amount = $old_y - $new_h;
				$thumb_h = $old_y - $amount;
				$thumb_w = $old_x - ($amount/$ratio);
			break;
		} 
		
		if($old_x < $new_w && $flg == false){$dst_x = ($new_w-$old_x)/2;}
		else{if($flg == true){$dst_x = ($new_w - $thumb_w)/2;}else{$dst_x = 0;}}
		if($old_y < $new_h  && $flg == false){$dst_y = ($new_h - $old_y)/2;}
		else{if($flg == true){$dst_y = ($new_h - $thumb_h)/2;}else{$dst_y = 0;}}
		
	
		$dst_img = ImageCreateTrueColor($new_w,$new_h);
		imagecopyresampled($dst_img,$src_img,$dst_x,$dst_y,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
		$trans = imagecolorallocate($dst_img,255,99,140);
		imagecolortransparent($dst_img,$trans);
		
		if (preg_match("/png/",$system[1]))
		{ // PNG
			imagepng($dst_img,$filename); 
		}
		else if (preg_match("/gif/",$system[1]))
		{ // Gif
			imagegif($dst_img,$filename); 
		}
		else
		{ // JPG
			imagejpeg($dst_img,$filename); 
		}
		
		imagedestroy($dst_img); 
		imagedestroy($src_img); 

	}	
	
?>