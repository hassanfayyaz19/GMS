<?php
//echo base64_decode(base64_decode('TVRJek5EVTI='));
// to get invoice options
$sqlinvoiceoptions="SELECT * FROM tbl_user_role_options WHERE mod_id=113 AND typ_id=".$session_utype." AND (option_id=1 OR option_id=2) AND user_role_option_status=1";
$optionforinvoice=$db->record_total($sqlinvoiceoptions);

// to get Payment options
$sqlpaymentoptions="SELECT * FROM tbl_user_role_options WHERE mod_id=114 AND typ_id=".$session_utype." AND (option_id=1 OR option_id=2) AND user_role_option_status=1";
$optionforpayment=$db->record_total($sqlpaymentoptions);

// to get Voucher options
$sqlvoucheroptions="SELECT * FROM tbl_user_role_options WHERE mod_id=116 AND typ_id=".$session_utype." AND (option_id=1 OR option_id=2) AND user_role_option_status=1";
$optionforvoucher=$db->record_total($sqlvoucheroptions);

// to get Final Invoice options
$sqlfinalInvoiceoptions="SELECT * FROM tbl_user_role_options WHERE mod_id=117 AND typ_id=".$session_utype." AND (option_id=1 OR option_id=2) AND user_role_option_status=1";
$optionforFinalInvoice=$db->record_total($sqlfinalInvoiceoptions);


// to get quotation options
$sqlquotationoptions="SELECT * FROM tbl_user_role_options WHERE mod_id=121 AND typ_id=".$session_utype." AND (option_id=1 OR option_id=2) AND user_role_option_status=1";
$optionforquotation=$db->record_total($sqlquotationoptions);

?>
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="index_admin.php?chkp=1">
             <!--<b>
                <img src="<?php echo $admin_logo_path;?>" alt="<?php echo $inc_general_name;?>" width="50" class="dark-logo" />
                <img src="<?php echo $admin_logo_path;?>" alt="<?php echo $inc_general_name;?>" class="light-logo" />
             </b>-->
                <span class="hidden-xs">
                <b><span style="color:#1E459E;"><img src="plugins/images/logo-dsafe.png" width="50" /></span> <?php echo $inc_general_name;?></b>
             </span> </a>
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
            <!-- Invoices  -->
            <?php 
			if($optionforinvoice>0){
				// to get view option
				$sqlgetview="SELECT * FROM tbl_user_role_options WHERE mod_id=113 AND typ_id=".$session_utype." AND option_id=1 AND user_role_option_status=1";
				$optionforinvoiceview=$db->record_total($sqlgetview);
				// to get Add option
				$sqlgetadd="SELECT * FROM tbl_user_role_options WHERE mod_id=113 AND typ_id=".$session_utype." AND option_id=2 AND user_role_option_status=1";
				$optionforinvoiceadd=$db->record_total($sqlgetadd);
			?>
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="fa fa-lg fa-fw fa-credit-card"></i> INVOICE
                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                </a>
                <ul class="dropdown-menu mailbox animated bounceInDown">
                    <li>
                        <div class="drop-title">Manage Invoices</div>
                    </li>
                    <li>
                        <div class="message-center">
                            <?php if($optionforinvoiceadd>0){
							?>
                            <a href="index_admin.php?chkp=345&m=113">
                                <!--<div class="user-img"> <i class="fa fa-lg fa-fw fa-credit-card"></i> </div>-->
                                <div class="mail-contnet">
                                    <h5>New Invoice</h5> <span class="mail-desc"></span> <span class="time"></span> </div>
                            </a>
                            <?php 
							}if($optionforinvoiceview>0){?>
                            <a href="index_admin.php?chkp=344&m=113">
                                <!--<div class="user-img"> <i class="fa fa-lg fa-fw fa-check"></i> </div>-->
                                <div class="mail-contnet">
                                    <h5>List Invoice</h5> <span class="mail-desc"></span> <span class="time"></span> </div>
                            </a>
                            <?php }?>
                        </div>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <?php }?>
            <!-- Payments -->
            <?php if($optionforpayment>0){
				// to get view option
				$sqlgetpaymentview="SELECT * FROM tbl_user_role_options WHERE mod_id=114 AND typ_id=".$session_utype." AND option_id=1 AND user_role_option_status=1";
				$optionforpaymentview=$db->record_total($sqlgetpaymentview);
				// to get Add option
				$sqlgetpaymentadd="SELECT * FROM tbl_user_role_options WHERE mod_id=114 AND typ_id=".$session_utype." AND option_id=2 AND user_role_option_status=1";
				$optionforpaymentadd=$db->record_total($sqlgetpaymentadd);
			?>
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="fa fa-lg fa-fw fa-database"></i> PAYMENTS
                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                </a>
                <ul class="dropdown-menu mailbox animated bounceInDown">
                    <li>
                        <div class="drop-title">Manage Payments</div>
                    </li>
                    <li>
                        <div class="message-center">
                        	<?php 
							if($optionforpaymentadd>0){
								if($session_utype==1 || $session_utype==2){
							?>
                            <a href="index_admin.php?chkp=347&m=114">
                                <!--<div class="user-img"> <i class="fa fa-lg fa-fw fa-credit-card"></i> </div>-->
                                <div class="mail-contnet">
                                    <h5>New Payment</h5> <span class="mail-desc"></span> <span class="time"></span> </div>
                            </a>
                            <?php }
								}
							if($optionforpaymentview>0){?>
                            <a href="index_admin.php?chkp=346&m=114">
                                <!--<div class="user-img"> <i class="fa fa-lg fa-fw fa-check"></i> </div>-->
                                <div class="mail-contnet">
                                    <h5>List Payments</h5> <span class="mail-desc"></span> <span class="time"></span> </div>
                            </a>
                            <?php }?>
                        </div>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <?php }?>
          	<!-- Vouchers -->
            <?php if($optionforvoucher>0){
				// to get view option
				$sqlgetvoucherview="SELECT * FROM tbl_user_role_options WHERE mod_id=116 AND typ_id=".$session_utype." AND option_id=1 AND user_role_option_status=1";
				$optionforvoucherview=$db->record_total($sqlgetvoucherview);
				// to get Add option
				$sqlgetvoucheradd="SELECT * FROM tbl_user_role_options WHERE mod_id=116 AND typ_id=".$session_utype." AND option_id=2 AND user_role_option_status=1";
				$optionforvoucheradd=$db->record_total($sqlgetvoucheradd);
			?>
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="fa fa-lg fa-fw fa-briefcase"></i> VOUCHERS
                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                </a>
                <ul class="dropdown-menu mailbox animated bounceInDown">
                    <li>
                        <div class="drop-title">Manage Vouchers</div>
                    </li>
                    <li>
                        <div class="message-center">
                        	<?php if($optionforvoucheradd>0){?>
                            
                                <!--<div class="user-img"> <i class="fa fa-lg fa-fw fa-credit-card"></i> </div>-->
                                <?php if($session_utype==1 || $session_utype==2){?>
                                <a href="index_admin.php?chkp=351&m=116">
                                <div class="mail-contnet">
                                    <h5>New Voucher</h5> <span class="mail-desc"></span> <span class="time"></span> </div>
                                </a>
								<?php }?>
                            
                            <?php }if($optionforvoucherview>0){?>
                            <a href="index_admin.php?chkp=350&m=116">
                                <!--<div class="user-img"> <i class="fa fa-lg fa-fw fa-check"></i> </div>-->
                                <div class="mail-contnet">
                                    <h5>List Vouchers</h5> <span class="mail-desc"></span> <span class="time"></span> </div>
                            </a>
                            <?php }?>                            
                        </div>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <?php }?>
            <!-- Final Invoice List -->
            <?php if($optionforFinalInvoice>0){
				// to get view option
				$sqlgetfinalinvoiceview="SELECT * FROM tbl_user_role_options WHERE mod_id=117 AND typ_id=".$session_utype." AND option_id=1 AND link_id=352 AND user_role_option_status=1";
				$optionforfinalinvoiceview=$db->record_total($sqlgetfinalinvoiceview);
				$sqlgetfinalinvoicepaidview="SELECT * FROM tbl_user_role_options WHERE mod_id=117 AND typ_id=".$session_utype." AND option_id=1 AND link_id=364 AND user_role_option_status=1";
				$optionforfinalinvoicepaidview=$db->record_total($sqlgetfinalinvoicepaidview);
				$sqlgetfinalinvoicepartybview="SELECT * FROM tbl_user_role_options WHERE mod_id=117 AND typ_id=".$session_utype." AND option_id=1 AND link_id=366 AND user_role_option_status=1";
				$optionforfinalinvoicepartybview=$db->record_total($sqlgetfinalinvoicepartybview);
				
			?>
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="fa fa-lg fa-fw fa-credit-card"></i> FINAL INVOICE
                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                </a>
                <ul class="dropdown-menu mailbox animated bounceInDown">
                    <li>
                        <div class="drop-title">Final Invoice List</div>
                    </li>
                    <li>
                        <div class="message-center">
                        	<?php if($optionforfinalinvoiceview>0){?>
                            <a href="index_admin.php?chkp=352&m=117">
                                <!--<div class="user-img"> <i class="fa fa-lg fa-fw fa-check"></i> </div>-->
                                <div class="mail-contnet">
                                    <h5>Final Invoice</h5> <span class="mail-desc"></span> <span class="time"></span> </div>
                            </a>
                           <?php }if($optionforfinalinvoicepartybview>0){?>  
                            <a href="index_admin.php?chkp=366&m=117">
                                <!--<div class="user-img"> <i class="fa fa-lg fa-fw fa-check"></i> </div>-->
                                <div class="mail-contnet">
                                    <h5>Pay to Branch</h5> <span class="mail-desc"></span> <span class="time"></span> </div>
                            </a>
                            <?php }if($optionforfinalinvoicepaidview>0){
								if($session_utype==3 || $session_utype==5)
									$title_heading="Received Final Invoice";
								else
									$title_heading="Paid Final Invoice";
							
							?>  
                            <a href="index_admin.php?chkp=364&m=117">
                                <!--<div class="user-img"> <i class="fa fa-lg fa-fw fa-check"></i> </div>-->
                                <div class="mail-contnet">
                                    <h5><?php echo $title_heading;?></h5> <span class="mail-desc"></span> <span class="time"></span> </div>
                            </a>

                            <?php }?>
                            
                                                      
                        </div>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <?php }?>
            <?php 
			if($optionforquotation>0){
				// to get view option
				$sqlgetview="SELECT * FROM tbl_user_role_options WHERE mod_id=121 AND typ_id=".$session_utype." AND option_id=1 AND user_role_option_status=1";
				$optionforinvoiceview=$db->record_total($sqlgetview);
				// to get Add option
				$sqlgetadd="SELECT * FROM tbl_user_role_options WHERE mod_id=121 AND typ_id=".$session_utype." AND option_id=2 AND user_role_option_status=1";
				$optionforinvoiceadd=$db->record_total($sqlgetadd);
				
				// to get total quotations
				$sqltotalquotations="SELECT * FROM tbl_quotation ORDER BY quotation_id DESC LIMIT 3";
				$totalquotations=$db->record_total($sqltotalquotations);
			?>
            <li class="dropdown">
                <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="fa fa-lg fa-fw fa-bullhorn"></i> LATEST QUOTATIONS
                    <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                </a>
                <ul class="dropdown-menu mailbox animated bounceInDown">
                    <li>
                        <div class="drop-title"> <span class="text-danger"><?php echo $totalquotations;?></span> Quotations Created</div>
                    </li>
                    <li>
                        <div class="message-center">
                            <?php
                            $sqlalertsQ=$db->record_select($sqltotalquotations);
							foreach($sqlalertsQ as $sqlalertsD)
							{	
								// to get party B Logo
								$sqlpartyblogo="SELECT * FROM tbl_invoice_setting,tbl_users, tbllogin WHERE tbllogin.log_id=tbl_users.log_id AND tbl_invoice_setting.partyb_id=".$sqlalertsD['partyb_id']." AND tbl_invoice_setting.partyb_id=tbl_users.log_id";
								$sqlpartyblogoQ=$db->record_select($sqlpartyblogo);
								$path_partyb_logo="plugins/images/invoice/".$sqlpartyblogoQ[0]['invoice_logo'];	
								
								
								// to get Client information
								$sqlquoteclient="SELECT * FROM tbl_users WHERE log_id=".$sqlalertsD['client_id']."";		
								$sqlquoteclientQ=$db->record_select($sqlquoteclient);				
							?>
                                <a href="javascript:;">
                                    <div class="mail-contnet">
                                        <span class="mail-desc"><b>Client: </b><?php echo $sqlquoteclientQ[0]['user_first_name'];?></span>
                                        <!--<span class="mail-desc"><b>Date: </b> <?php echo date("m/d/Y",strtotime($sqlalertsD['quotation_date']));?></span>
                                        <span class="mail-desc"><b>Address: </b><?php echo $sqlquoteclientQ[0]['address'];?></span>
                                        <b><?php echo $in_party_B_name;?>: <?php echo $sqlpartyblogoQ[0]['log_name'];?></b> -->
                                    </div>
                                </a>
                            <?php }?>
                        </div>
                    </li>
                    <li>
                        <a class="text-center" href="index_admin.php?chkp=361&m=121"> <strong>See all Quotations</strong> <i class="fa fa-angle-right"></i> </a>
                    </li>
                </ul>
                <!-- /.dropdown-messages -->
            </li>
            <?php }?>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <!--<li>
                <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                    <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
            </li>-->
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                 <!--<img src="plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle">-->
                 <i class="fa fa-lg fa-fw fa-user"></i>
                 
                 <b class="hidden-xs"><?php echo $sqlgetlogininformationD[0]['log_name'];?></b><span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-text">
                                <h4><?php echo $sqlgetuserinformationD[0]['user_first_name'];?></h4>
                                <p class="text-muted"><?php echo $sqlgetuserinformationD[0]['user_email'];?></p><a href="index_admin.php?chkp=115&m=28" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="index_admin.php?chkp=115&m=28"><i class="ti-user"></i> Update Profile </a></li>
                    <li><a href="index_admin.php?chkp=10&m=28"><i class="fa fa-key"></i> Change Password </a></li>
                    
                    <?php if($session_login_id==1){?>
                    <li role="separator" class="divider"></li>
                    <li>
                    	<form name="fromchangelogin" method="post" action="change_login.php" target="_blank">
                        <input type="hidden" name="current_url" value="<?php echo 'http://'.$_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'].'';?>" />
                    	<div class="row">
                        	<div class="col-md-1"></div>
                            <div class="col-md-6">
                            	<input type="text" class="form-control" name="userlogin" placeholder="Change Login">
                            </div>
                            <div class="col-md-4">
                            	<input type="submit" class="btn btn-success m-r-10" value="Change" name="Login" />
                            </div>
                            <div class="col-md-1"></div>
                         </div>
                         </form>
                    </li>
                    <?php }?>
                    <li role="separator" class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>