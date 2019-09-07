<?php
include "class/cls_db.php";
$db = new db('');
include("class/cls_functions.php");
$GeneralFunctions= new sitefun();
include("includes/common.inc.php");
include "class/cls_forms.php";

$chkp=$_GET['chkp'];
$m=$_GET['m'];

foreach($_POST as $name => $val)
$$name=$val;


if($uom_status=="on")
	$uom_status='Enable';
else
	$uom_status='Disable';

$sqluom="SELECT MAX(*) maxorder FROM tbl_uom";
$sqluomD=$db->record_select($sqluom);
$uom_order=$sqluomD[0]['maxorder'];

if(!isset($_POST['cmdType']))
{
    $sqlcheck="select * from tbl_uom where uom='$uom'";
    $check=$db->record_total($sqlcheck);
    if($check==0)
    {
        $sqlinsert="INSERT INTO tbl_uom (uom, uom_order, uom_status) VALUES ('$uom', '$uom_order', '$uom_status')";
        $uom_id=$db->record_insert($sqlinsert);
        if($uom_id>0)
        {

            ?>
            <form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $uom_id;?>&m=<?php echo $m;?>" >
                <input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" />
                <input type="hidden" name="msg" id="msg" value="Record Inserted successfully" />
            </form>
            <script>
                document.frmsuc.submit();
            </script>
            <?php
            exit;
        }
        else
        {
            ?>
            <form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>" >
                <input type="hidden" name="msg_type" id="msg_type" value="alert alert-danger alert-dismissable" />
                <input type="hidden" name="msg" id="msg" value="Error try again" />
            </form>
            <script>
                document.frmsuc.submit();
            </script>
            <?php
            exit;
        }
    }else
        {
            ?>
            <form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&m=<?php echo $m;?>" >
                <input type="hidden" name="msg_type" id="msg_type" value="alert alert-danger alert-dismissable" />
                <input type="hidden" name="msg" id="msg" value="Error try again" />
            </form>
            <script>
                document.frmsuc.submit();
            </script>
            <?php
            exit;
        }


}
else	// if Account edit
{

	$sqlinsert="UPDATE tbl_uom SET uom='$uom', uom_status='$uom_status' WHERE uom_id=$mid";
	if($db->query_execute($sqlinsert))
	{
		?>
			<form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $mid;?>&m=<?php echo $m;?>" >
				<input type="hidden" name="msg_type" id="msg_type" value="alert alert-success alert-dismissable" /> 
				<input type="hidden" name="msg" id="msg" value="Record updated successfully" /> 
			</form>
		  <script>
			  document.frmsuc.submit();
		  </script>
		<?php 
		exit;
	}
	else
	{
		?>
            <form name="frmsuc" id="frmsuc" method="post" action="index_admin.php?chkp=<?php echo $chkp;?>&cmdType=edit&mid=<?php echo $mid;?>&m=<?php echo $m;?>">
                <input type="hidden" name="msg_type" id="msg_type" value="alert alert-danger alert-dismissable" /> 
                <input type="hidden" name="msg" id="msg" value="Error try again" /> 
            </form>
          <script>
              document.frmsuc.submit();
          </script>
        <?php 
        exit;
	}
}
//chanay akhroat meva badam  pista
?>