<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3>
        </div>
        <ul class="nav" id="side-menu">
            
            <?php
			if($_SESSION['utype']==1 || $_SESSION['utype']==2)
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
			$nResult = mysqli_query($q);
				
			 $urltoken =sha1(session_id());	
			$mm='';
					  
				while($rstRow = mysqli_fetch_array($nResult))
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
					$sqlsubmenusQ = mysqli_query($sqlsubmenus);
					while($sqlsubmenusD=mysqli_fetch_array($sqlsubmenusQ)){
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
			$sqlmainmenu="SELECT * FROM tbl_user_assign_modules, tblmodules WHERE log_id=".$session_login_id." AND tbl_user_assign_modules.mod_id=tblmodules.mod_id";
			$sqlmainmenuQ=mysqli_query($sqlmainmenu);
			while($sqlmainmenuD=mysqli_fetch_array($sqlmainmenuQ))
			{
			?>
            
            <?php 
			}
			}// menu for other then admin users
			?>
        </ul>
    </div>
</div>