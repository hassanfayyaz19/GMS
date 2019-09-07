<?php

class email{

var $to;
var $from;// string,
var $message;// string,
var $mass;



function emailnow($t, $m, $s, $f){
	$this->to=$t;
	$this->message = $m;
	$this->from=$f;
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Web Master <'.$this->from.'>' . "\r\n" ;
  if(mail($this->to, $s, $this->message, $headers)){
  $this->mass=1;
   }else{
	//echo error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	$this->mass=0;
}
return $this->mass;
}
//return $this->str_final;

}
?>