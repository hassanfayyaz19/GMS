<?php
// code to get user rights for particular page
$modulePagesSQL="SELECT tbl_options.option_name,tbl_user_role_options.user_role_option_status FROM tbl_user_role_options, tbl_options WHERE tbl_user_role_options.link_id=$chkp AND tbl_user_role_options.typ_id=$session_utype AND tbl_user_role_options.option_id=tbl_options.options_id";
$modulePages=$db->record_select($modulePagesSQL);
foreach($modulePages as $modulePagesD)
$RoleArray[''.$modulePagesD['option_name'].'']=$modulePagesD['user_role_option_status'];
?>