<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");
include "class/cls_forms.php";

$purl=$_GET['chkp'];
foreach($_POST as $name => $val)
$$name=$val;


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

$login_id=$_SESSION['login_id'];
$pass=base64_encode(base64_encode($pass));
$sqlUser="SELECT * FROM tbllogin WHERE log_id='".$login_id."' AND log_pwd='".$pass."'";
$sqlUserQ=mysqli_query($sqlUser);
if(mysqli_num_rows($sqlUserQ)==0)
{
	?>
	<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $purl;?>" >
		<input type="hidden" name="msg_type" id="msg_type" value="alert alert-danger alert-dismissable" />
		<input type="hidden" name="msg" id="msg" value="Invalid Password please try again" /> 
	</form>
	<script>
	  document.frmsuc.submit();
	</script>
	<?php 
	exit;
}



backup_tables($db->DB_Server,$db->DB_Username,$db->DB_Password,$db->DB_DBName);

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	
	$link = mysqli_connect($host,$user,$pass);
	mysqli_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query('SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysqli_query('SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	$FileName='db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
	//$FileName='db-backup-1540923536.sql';
	//save file
	$handle = fopen($FileName,'w+');
	fwrite($handle,$return);
	if(fclose($handle))
	{
	$purl=$_GET['chkp'];
	
	
	$files_to_zip = array('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql');
	//if true, good; if false, zip creation failed
	$result = create_zip($files_to_zip,'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.zip');
	@unlink('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql');
	?>

    <form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $purl;?>" >
    	<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
		<input type="hidden" name="msg" id="msg" value="Backup has done successfully, <a href='<?php echo 'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.zip';?>'>Click Here </a> to download" />
    </form>
    <script>
      document.frmsuc.submit();
    </script>
    <?php 
	}
    exit;
}
?>