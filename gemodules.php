<?php
include "class/cls_db.php";
$db = new db();
include "class/cls_forms.php";
$Form = new forms();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="listheading">S No. </td>
        <td class="listheading">Name</td>
        <td class="listheading">Action</td>
      </tr>
<?php

$type=$_SESSION['utype'];
		if($type==1){
		$wc='';
		}else{
		$wc='where mod_s_inditcation <> "S"';
		}
$result = "SELECT * FROM tblmodules $wc order by mod_id ";
					$nResult = mysqli_query($result);
					$nrows=mysqli_num_rows($nResult);
$i=1;
while($rstRow = mysqli_fetch_array($nResult))
	{
?>	  
	  
      <tr>
        <td width="30" class="listtxt"><?php echo $i?></td>
        <td  class="listtxt"><?php echo $rstRow['mod_name']?></td>
        <td width="60" class="listtxt"><a href="index_admin.php?chkp=<?php echo $_REQUEST['chkp']?>&cmdType=edit&mid=<?php echo base64_encode($rstRow['mod_id'])?>"><?php echo $Form->imgControl("assets/images/user_edit.png",$rstRow['mod_name'],"Click icon to edit.")?></a></td>
      </tr>
<?php
$i++;
}
?>	  
</table>
