<?php
error_reporting(0);
session_start();

class db{



/*---------Class is created by Saqib Ahmad------------------------

------------ Dated Feb 06, 2007----------------------------------*/



	var $DB_Server;

	var $DB_Username;

	var $DB_Password;

	var $DB_DBName;

	

	var $strPath;

	var $strPathA;

	var $conn;        

	var $db;

	var $pre;

	var $result;

	var $dbType=5;

	

	

	



//---------------Bilt in functions ---------------------Declaration-----------------------------



// Default MYSQL case 1: MSSQL SERVER



//----------------------------------------------------------------------------------------------



function connect($a, $b, $c, $d){//for db connection

	

	switch ($this->dbType){

	case 1:

	$obj = mssql_connect($a, $b, $c); 

	break;

	

	default://MYSQL 

	$obj = mysqli_connect($a, $b, $c, $d);

	}

	return $obj;

}//db connection ended





function selectDb($a, $b){//for select db

	

	switch ($this->dbType){

	case 1:

	$obj = mssql_select_db($a, $b); 

	break;

	

	default://MYSQL 

	$obj = mysqli_select_db($a, $b);

	}

	return $obj;

}//Select  db ended





function query($q){

	

	switch ($this->dbType){

	case 1:

	$obj = mssql_query($q);

	break;

	

	default://MYSQL 

	$obj = mysqli_query($q);

	}

	return $obj;

}

	

function fetchobj($q){

	

	switch ($this->dbType){

	case 1:

	$obj = mssql_fetch_object($q);

	break;

	

	default://MYSQL 

	$obj = mysqli_fetch_object($q);

	}

	return $obj;

}





function nrowobj($q){

	

	switch ($this->dbType){

	case 1:

	$obj = mssql_num_rows($q);

	break;

	

	default://MYSQL 

	$obj = mysqli_num_rows($q);

	}

	return $obj;

}



//--------------------------------------------------Ended-----------------------------------------	



	

	function db(){

	

	$this->DB_Server = "localhost";

	$this->DB_Username = "root";

	$this->DB_Password = "";

	$this->DB_DBName = "gms_db";

	

	$this->strPath = "images/";

	$this->strPathA = "images/";

	$this->conn = $this->connect($this->DB_Server, $this->DB_Username, $this->DB_Password, $this->DB_DBName);

	//$this->db = $this->selectDb($this->DB_DBName,$this->conn);

	}



	function select($t, $ob, $wf, $wc, $wv, $l, $s ){

	

switch ($this->dbType){

	

	case 1:

	//echo "SQL Server";

	break;

	

default://Mysql

//---------------------MySql Portion --------------------------------

	switch($s){

	case 1:

	$query="select * from $t";

	$this->result = $this->query($query);

	break;

	

	case 2://order by

	$query="select * from $t order by $ob";

	$this->result = $this->query($query);

	break;

	

	case 3://logintype

	$query="select * from $t where $wc ";

	$this->result = $this->query($query);

	break;

	

	case 4://where 

	$query="select $wf from $t where $wc ";

	$this->result = $this->query($query);

	break;

		

	}// switich ended

//---------------------MySql Portion Ended  ------------------------	

}//main db type switch ended

	

	return $this->result;

	}


function record_select($sql)	
{
	$count=0;
	$sqlQ=mysqli_query($this->conn,$sql);
	while($sqlDT=mysqli_fetch_array($sqlQ))
	{
		$data[$count]=$sqlDT;
		$count++;
	}
	return $data;
}
function query_execute($sql)	
{
	if(mysqli_query($this->conn,$sql))
		return 1;	
	else
		return 0;	

}
function record_insert($sql)	
{
	if(mysqli_query($this->conn,$sql))
	{
		$id=mysqli_insert_id($this->conn);
		return $id;	
	}
	else
	{
		return 0;	
	}

}
function record_total($sql)	
{
	$sqlQ=mysqli_query( $this->conn, $sql);
	$NR=mysqli_num_rows($sqlQ);
	return $NR;

}

	
}//class Ended



?>