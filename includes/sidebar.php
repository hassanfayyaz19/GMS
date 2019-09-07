<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3>
        </div>
        <ul class="nav" id="side-menu">
            
            <?php
			if($_SESSION['utype']==1)
			{
			$type=$_SESSION['utype'];
			$q=("SELECT
			tbllinks.link_id,
			tbllinks.link_name,
			tbllinks.link_path,
			tblgroup.grp_permission,
			tbllinks.link_s,
			tbllinks.link_rank,
			tblmodules.mod_name,
			tblmodules.mod_id,
			tblmodules.mod_des
			FROM
			tblmodulespages
			Inner Join tblgroup ON tblmodulespages.mod_id = tblgroup.mod_id
			Inner Join tbllinks ON tbllinks.link_id = tblmodulespages.link_id
			Inner Join tblmodules ON tblmodules.mod_id = tblmodulespages.mod_id
			WHERE
			tblgroup.typ_id =  '$type' and tblgroup.grp_permission = 'Y' AND tblmodules.mod_status='A' and tbllinks.link_s = 'Y' GROUP BY tblmodules.mod_name
			ORDER BY tblmodules.mod_order" );
			//order by tbllinks.link_rank
			$nResult = $db->record_select($q);
				
			 $urltoken =sha1(session_id());	
			$mm='';
					  
				foreach($nResult as $rstRow)
				{
					if($_GET['m']==$rstRow['mod_id'])
						$open_men=' style="display:block;"';
					else
						$open_men='';
					?>
            <li class="user-pro">
                <a href="javascript:void(0);"  class="waves-effect"><?php echo $rstRow['mod_des'];?> <span class="hide-menu"><?php echo $rstRow['mod_name'];?><span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: auto;">
                    <?php 
					$sqlsubmenus=("SELECT
					tbllinks.link_id,
					tbllinks.link_name,
					tbllinks.link_path,
					tblgroup.grp_permission,
					tbllinks.link_s,
					tbllinks.link_font,
					tbllinks.link_rank,
					tblmodules.mod_name,
					tblmodules.mod_id
					FROM
					tblmodulespages
					Inner Join tblgroup ON tblmodulespages.mod_id = tblgroup.mod_id
					Inner Join tbllinks ON tbllinks.link_id = tblmodulespages.link_id
					Inner Join tblmodules ON tblmodules.mod_id = tblmodulespages.mod_id
					WHERE
					tblgroup.typ_id =  '$type' and tblgroup.grp_permission = 'Y' and tbllinks.link_s = 'Y' AND tblmodules.mod_id=".$rstRow['mod_id']."
					ORDER BY tbllinks.link_rank" );
					//order by tbllinks.link_rank
					$sqlsubmenusQ = $db->record_select($sqlsubmenus);
					foreach($sqlsubmenusQ as $sqlsubmenusD){
					?>
                    <li><a href="<?php echo $rstRow['link_path']?>?chkp=<?php echo $sqlsubmenusD['link_id']?>&m=<?php echo $rstRow['mod_id']?>"><?php echo $sqlsubmenusD['link_font'];?> <span class="hide-menu"><?php echo $sqlsubmenusD['link_name']?></span></a></li>
                    <?php }?>
                </ul>
            </li>
            <?php
			}
            } // menu for admin
			else
			{
				
			$type=$_SESSION['utype'];
			$q=("SELECT * FROM tblmodules,tbl_user_role_options WHERE tblmodules.mod_id=tbl_user_role_options.mod_id AND tblmodules.mod_status='A' AND tbl_user_role_options.typ_id=$type AND tbl_user_role_options.option_id=1 AND tbl_user_role_options.user_role_option_status=1 GROUP BY tblmodules.mod_id ORDER BY tblmodules.mod_order" );
			//order by tbllinks.link_rank
			$nResult = $db->record_select($q);
				
			 $urltoken =sha1(session_id());	
			$mm='';
					  
				foreach($nResult as $rstRow)
				{
					if($_GET['m']==$rstRow['mod_id'])
						$open_men=' style="display:block;"';
					else
						$open_men='';
					
					
					// to get total links under menu
					//$sqlmodulepages="SELECT * FROM tblmodulespages,tbllinks, tbl_user_role_options WHERE tblmodulespages.link_id=tbllinks.link_id AND tblmodulespages.mod_id=".$rstRow['mod_id']." AND tbllinks.link_s='Y' AND tbllinks.link_id=tbl_user_role_options.link_id AND tbl_user_role_options.option_id=1 AND tbl_user_role_options.user_role_option_status=1 GROUP BY tbllinks.link_id"; //GROUP BY tbl_user_role_options.user_role_option_id
					$sqlmodulepages="SELECT * FROM tbllinks, tbl_user_role_options WHERE tbl_user_role_options.mod_id=".$rstRow['mod_id']." AND tbllinks.link_s='Y' AND tbllinks.link_id=tbl_user_role_options.link_id AND tbl_user_role_options.option_id=1 AND tbl_user_role_options.typ_id=$type AND tbl_user_role_options.user_role_option_status=1";
					$Nrpages=$db->record_total($sqlmodulepages);
					if($Nrpages>1)
					{
						$mod_link="#";
						$page_id=$modulesD['mod_id'];
					}
					else
					{
						$listmodulepagesQ=$db->record_select($sqlmodulepages);
						$mod_link=$listmodulepagesQ[0]['link_name'];
						$page_id=$listmodulepagesQ[0]['link_id'];
					}
					?>
            <li class="user-pro">
                <a href="javascript:void(0);" class="waves-effect"><?php echo $rstRow['mod_des'];?> <span class="hide-menu"><?php echo $rstRow['mod_name'];?><span class="fa arrow"></span></span>
                </a>
                <?php if($Nrpages>0){
					
				?>
                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: auto;">
                    <?php 
					/*$sqlsubmenus=("SELECT
					tbllinks.link_id,
					tbllinks.link_name,
					tbllinks.link_path,
					tblgroup.grp_permission,
					tbllinks.link_s,
					tbllinks.link_font,
					tbllinks.link_rank,
					tblmodules.mod_name,
					tblmodules.mod_id
					FROM
					tblmodulespages
					Inner Join tblgroup ON tblmodulespages.mod_id = tblgroup.mod_id
					Inner Join tbllinks ON tbllinks.link_id = tblmodulespages.link_id
					Inner Join tblmodules ON tblmodules.mod_id = tblmodulespages.mod_id
					WHERE
					tblgroup.typ_id =  '$type' and tblgroup.grp_permission = 'Y' and tbllinks.link_s = 'Y' AND tblmodules.mod_id=".$rstRow['mod_id']."
					ORDER BY tbllinks.link_rank" );*/
					//order by tbllinks.link_rank
					
					$sqlmodulepagesQ=$db->record_select($sqlmodulepages);
					foreach($sqlmodulepagesQ as $sqlsubmenusD)
					{
					//$sqlsubmenusQ = mysql_query($sqlsubmenus);
					//while($sqlsubmenusD=mysql_fetch_array($sqlsubmenusQ)){
					?>
                    <li><a href="<?php echo $rstRow['link_path']?>?chkp=<?php echo $sqlsubmenusD['link_id']?>&m=<?php echo $rstRow['mod_id']?>"><?php echo $sqlsubmenusD['link_font'];?> <span class="hide-menu"><?php echo $sqlsubmenusD['link_name']?></span></a></li>
                    <?php }?>
                </ul>
                <?php }?>
            </li>
            <?php
			}
            
			}// menu for other then admin users
			?>
        </ul>
    </div>
</div>