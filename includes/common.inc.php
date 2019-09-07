<?php
include "../includes/common.url.php";
$themepath="http://localhost/fiverr/ampleadmin/";
$loadingimg="<div style='width:100%; margin-top:250px; text-align:center;'><img src='".$themepath."images/progressbar_green.gif' align='center' /></div>";
$ckeditorbasepath="admin/ckeditor/ckfinder/";
$webitepath="http://www.kzkmedia.com/";
$pattern = array(",","'"," ", "+", "$", "@", "!", "`", "%", "^", "&", "*", "(", ")","=","?","-");
$JQueryREforURL="/[-\/\\^$*',+?.()|[\]{}]/g";

$dateformat="d-m-Y";
$pricedecimal=".2";
$todayDate=date("m/d/Y");
$todayDateMysql=date("Y-m-d");

$session_utype=$_SESSION['utype'];


$session_login_id=$_SESSION['login_id'];

if($session_login_id!="")
{
// to get user login information
	$sqlgetlogininformation="SELECT * FROM tbllogin WHERE log_id=$session_login_id";
	$Nrlogin=$db->record_total($sqlgetlogininformation);
	if($Nrlogin==0)
	{?>
		<script>
			document.location="logout.php";
		</script>
	<?php }
	//$sqlgetlogininformationD=mysqli_fetch_array($sqlgetlogininformationQ);
    $sqlgetlogininformationD=$db->record_select($sqlgetlogininformation);
}
// to get user information
$sqlgetuserinformation="SELECT * FROM tbl_users WHERE log_id=$session_login_id";
$sqlgetuserinformationQ=mysqli_query($sqlgetuserinformation);
$sqlgetuserinformationD=mysqli_fetch_array($sqlgetuserinformationQ);

if($sqlgetuserinformationD['user_photo']!="")
	$user_display_photo="img/users/thumb/".$sqlgetuserinformationD['user_photo'];
else
	$user_display_photo="img/users/default.jpg";

if($sqlgetuserinformationD['name_code']=="N")
	$user_display_name=$sqlgetlogininformationD['log_name'];
else
	$user_display_name=$sqlgetuserinformationD['user_code'];


// to get general Informations
$sqlgeneral="SELECT * FROM tbl_general LIMIT 1";
$sqlgeneralD=$db->record_select($sqlgeneral);

$inc_general_name=$sqlgeneralD[0]['general_name'];
$inc_general_web_title=$sqlgeneralD[0]['general_web_title'];
$inc_general_phone=$sqlgeneralD[0]['general_phone'];
$inc_general_email=$sqlgeneralD[0]['general_email'];
$inc_general_logo=$sqlgeneralD[0]['general_logo'];
$inc_general_favico=$sqlgeneralD[0]['general_favico'];
$inc_general_survey_logo=$sqlgeneralD[0]['general_survey_logo'];
$currency=$sqlgeneralD[0]['general_currency'];

$admin_logo_path="plugins/images/general/".$inc_general_logo;
$admin_favico_path="plugins/images/general/".$inc_general_favico;

$in_party_B_name="Branch";
$monthsArray = array(
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
);
$ratio=1.0936;
$RoundUpTo=3;
$MaxRolDel=10;

$generalHeader='<table width="100%" border="0" cellspacing="0" cellpadding="0" class="generalheader">
                  <tr>
                    <td class="generalheaderbg"><img src="'.$admin_logo_path.'" width="80" /></td>
                    <td class="generalheaderbg headerheading" style="text-align:right;">'.$inc_general_web_title.'&nbsp; &nbsp; </td>
                  </tr>
                </table>';
?>