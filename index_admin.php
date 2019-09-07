<?php
include "class/cls_db.php";
//include "auth_user.php";
include "class/cls_forms.php";
include "class/cls_functions.php";
include('class/cls_imageFile.php');
$db = new db();
$Form = new forms($db);
$GeneralFunctions = new sitefun();
$strTitle="Web Administrative Panel";

include("includes/common.inc.php");
require_once("./dompdf/dompdf_config.inc.php");
//include("invoice_pdf_generation.php");

$url_link_id=$_GET['chkp'];
$url_mod_id=$_GET['m'];

if($url_link_id!=1 && $url_link_id!=355 && ($session_utype!=1 && $session_utype!=2))
{
// to check that user have permission for particular link or not?
$sqlchecklink="SELECT * FROM tbl_user_role_options WHERE typ_id=".$session_utype." AND link_id=".$url_link_id." AND user_role_option_status=1";
$totalsqlchecklink=$db->record_total($sqlchecklink);
if($totalsqlchecklink=="")
{
	$sqlcheckmod="SELECT * FROM tbl_user_role_options WHERE typ_id=".$session_utype." AND mod_id=".$url_mod_id." AND user_role_option_status=1";
	$totalsqlcheckmod=$db->record_total($sqlcheckmod);
	if($totalsqlcheckmod=="")
	{
?>
	<script>
		document.location="index.php";
	</script>
<?php }
}
}


// code to get user rights for particular page
$modulePagesSQL="SELECT tbl_options.option_name,tbl_user_role_options.user_role_option_status FROM tbl_user_role_options, tbl_options WHERE tbl_user_role_options.link_id=$url_link_id AND tbl_user_role_options.typ_id=$session_utype AND tbl_user_role_options.option_id=tbl_options.options_id";
$modulePages=$db->record_select($modulePagesSQL);
foreach($modulePages as $modulePagesD)
$RoleArray[''.$modulePagesD['option_name'].'']=$modulePagesD['user_role_option_status'];


// code to generate invoice on monthly or daily basis
$sqlcreateautoinvoice="SELECT * FROM tbl_invoice WHERE invoice_option_id=3 OR invoice_option_id=4 OR invoice_option_id=5";


if(!isset($_SESSION["login_id"]))
{?>
<script>
	document.location="index.php";
</script>
<?php }?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $admin_favico_path;?>">
    <title><?php echo $inc_general_name;?></title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    
   
    
    
    <!-- Date picker plugins css -->
    <link href="plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
	<script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    
    <script src="js/ajax.js"></script>
    
    <script src="js/func.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    
    <!-- summernotes CSS -->
    <link href="plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet" />
    <!--<script src="plugins/bower_components/summernote/dist/summernote.min.js"></script>-->
    <script src="plugins/bower_components/summernote/dist/summernote.js"></script>
    <link href="plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <!-- Touch Spin for orders -->
    <link href="plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <script src="plugins/bower_components/switchery/dist/switchery.min.js"></script>
	<script src="plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
    <script src="plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
    
    <!-- data table -->
    <link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    
    <!-- start - This is for export functionality only 
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>-->
    
    <!-- FooTable -->
    <link href="plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <script src="plugins/bower_components/footable/js/footable.all.min.js"></script>
    <script src="plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <!--FooTable init-->
    <script src="js/footable-init.js"></script>
    
    <!-- Sweet-Alert  -->
    <script src="plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
    <link href="plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    
    <!-- Dropzone -->
    <link href="plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <script src="plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
    
    <!--  for gallery and lightbox -->
    <script type="text/javascript" src="plugins/bower_components/gallery/js/animated-masonry-gallery.js"></script>
    <script type="text/javascript" src="plugins/bower_components/gallery/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="plugins/bower_components/fancybox/ekko-lightbox.min.js"></script>
    <link rel="stylesheet" type="text/css" href="plugins/bower_components/gallery/css/animated-masonry-gallery.css" />
    <link rel="stylesheet" type="text/css" href="plugins/bower_components/fancybox/ekko-lightbox.min.css" />
    
    
    <!-- for drop box -->
    <script src="plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" href="plugins/bower_components/dropify/dist/css/dropify.min.css">
    
    <!-- for Lightbox -->
    <script src="plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
    <link href="plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    
    
    
    
    <!--<link rel="stylesheet" href="plugins/bower_components/js/select2/select2-bootstrap.css">-->
	<link rel="stylesheet" href="plugins/bower_components/select2/select2.css">
    <script src="plugins/bower_components/select2/select2.min.js"></script>
    
    
    
    
    <!-- Chart JS 
    <script src="plugins/bower_components/Chart.js/chartjs.init.js"></script>-->
    <script src="plugins/bower_components/Chart.js/Chart.min.js"></script>
    <script src="js/jquery.PrintArea.js" type="text/JavaScript"></script>
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <!--<div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>-->
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include("includes/header.php");?>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php include("includes/sidebar.php");?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <?php 
				$result = ("SELECT * FROM tbllinks where link_id=$_REQUEST[chkp] ");		
				$nResult = $db->record_select($result);
					foreach($nResult as $rstRow)
					{
						$infile=$rstRow['link_file'];
						$infilepth="./".$infile;
						if(file_exists($infilepth))
						{
							include ("$infile"); 
						}
						else
						{
							echo "No file Exists";	
						}
					}
				?>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> <?php echo date("Y");?> &copy; Barion Systems </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="plugins/bower_components/morrisjs/morris.js"></script>
    <!-- chartist chart -->
    <script src="plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Calendar JavaScript -->
    <script src="plugins/bower_components/moment/moment.js"></script>
    <script src='plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>
    <script src="plugins/bower_components/calendar/dist/cal-init.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    
    <!-- Custom tab JavaScript -->
    <script src="js/cbpFWTabs.js"></script>
    <script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();
    </script>
    <script src="js/validator.js"></script>
    <script src="plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--Style Switcher -->
    <script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <style>
		.datepicker-orient-top{ margin-top:65px !important;}
	</style>
</body>
</html>
