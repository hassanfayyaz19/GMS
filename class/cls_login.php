<?php
class login{
	var $errorMessage="";

	
	
	
	function login($u, $p, $svar,$logintypeid){
	session_start(); 
	//Db Class instance 
	$db = new db('');
	/*define("HTTP_SERVER", "http://".$_SERVER['HTTP_HOST']);
	define("HTTPS_SERVER", "https://".$_SERVER['HTTP_HOST']);*/
	$username=$u;
	$p =base64_encode($p);
	$p = base64_encode($p);
	
	$userpassword=$p;
	
	$q=$db->select('tbllogin', '', '', "log_name='$u' and log_pwd='$p' and log_sts = 'A'", '', '', '3' );
	$res = $db->nrowobj($db->result);
	
	$q=$db->select('tbllogin', '', 'typ_id', "log_name='$u' and log_pwd='$p'", '', '', '4' );
	 
	
	
	// check if the username and password combination is correct 
    if ($res == 1) { 
    
	
		// set the session 
        $_SESSION[$svar] = true; 
		while($qlink=$db->fetchobj($db->result)) {
		
		$_SESSION['utype'] = $qlink->typ_id; 
				 
	 }
	 	$rscheckcat = mysqli_query("Select log_id from tbllogin where log_name='$username' and log_pwd='$p'") or die(mysqli_error());
	 	$rstRow = mysqli_fetch_array($rscheckcat);
		$_SESSION['login_id'] =  $rstRow['log_id'];
		// to check user has survey rights or not
		if($logintypeid==2)
		{
			$sqluserlink="SELECT * FROM tbl_user_assign_modules_pages WHERE log_id=".$rstRow['log_id']." AND link_id=291";
			$sqluserlinkQ=mysqli_query($sqluserlink);
			$Nrreclink=mysqli_num_rows($sqluserlinkQ);
			if($Nrreclink==0)
			{
				echo "Loading...";
				?>
				<form name="frmsuc" id="frmsuc" method="post" action="index.php" >
					<input type="hidden" name="msg_type" id="msg_type" value="alert-danger" />
					<input type="hidden" name="msg" id="msg" value="Sorry you have no permission to survey" /> 
				</form>
				<script>
				  document.frmsuc.submit();
				</script>
				<?php
			}
			else
			{
				?>
				<script>
                  document.location="survey.php";
                </script>
                <?php
                exit;
			}
		}
		
         
		 
		 
		 //echo $_SESSION['utype'];
        // after login we move to the main page 
		//echo $_SESSION['utype'];
		if ($_SESSION['utype'] == '4')
		{
		   header('Location: index_admin.php?chkp=1');
			echo "Loading...";
			?>
				<script>
                    document.location="index_admin.php?chkp=394&m=130";
                </script>
			<?php 
			exit;
	    }
		
		if ($_SESSION['utype'] != '6')
		{
       header('Location: index_admin.php?chkp=1');
		echo "Loading...";
		?>
		<script>
		document.location="index_admin.php?chkp=1";
		</script>
		<?php 
		exit;
	   }
	   elseif ($_SESSION['utype'] == '7')
	   {
		header('Location: index.php?ptype=3'); 
		}
        //exit; 
    } else { 
//	echo $_SESSION['$svar'];
$this->errorMessage = 'Sorry<br><br>';
echo "Loading...";

	?>
	<form name="frmsuc" id="frmsuc" method="post" action="index.php" >
		<input type="hidden" name="msg_type" id="msg_type" value="alert-danger" />
		<input type="hidden" name="msg" id="msg" value="Invalid Username or Password" /> 
	</form>
	<script>
	  document.frmsuc.submit();
	</script>
	<?php 
 header('Location: index.php?massage=Sorry, wrong information.');
    exit;
       
} 


$this->errorMessage = 'Sorry, wrong information.<br><br>';
}




}
?>
