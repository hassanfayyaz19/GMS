<?php
$name = $_POST['txtname'];

// to get module name
$sqlmodule="SELECT tblmodules.mod_name FROM tblmodules, tblmodulespages WHERE tblmodulespages.link_id=".$_GET['chkp']." and tblmodulespages.mod_id=tblmodules.mod_id";
$sqlmoduleQ=mysqli_query($sqlmodule);
$sqlmoduleD=mysqli_fetch_array($sqlmoduleQ);
$mod_name=$sqlmoduleD['mod_name'];

if ($_REQUEST['cmdType']=="" || !isset($_REQUEST['cmdType'])){
    $src='images/Add_bt.jpg';
    $btname='Add';
    $mid="";
    $mname="";
    $mdes="";
    $btnvalue="Add Module";
}else{
    $src='images/Save_bt.jpg';
    $btname='Submit';
    $mid=base64_decode($_REQUEST['mid']);
    $q="SELECT * from tblmodules where mod_id = $mid";
    $nResult = mysqli_query($q);
    while($rstRow = mysqli_fetch_array($nResult))
    {
        $mid=$rstRow['mod_id'];
        $mname=$rstRow['mod_name'];
        $mdes=$rstRow['mod_des'];
        $ms=$rstRow['mod_status'];
    }
    $mstatus="<select name='status'>
<option value='A' ";
    if ($ms=="A"){$mstatus.="selected";}

    $mstatus.=">Active</option>
<option value='D' ";
    if ($ms=="D"){$mstatus.="selected";}
    $mstatus.=">De-Active</option>
</select>";
    $mscap="Status:";
    $btnvalue="Edit Module";
}
?>
<!-- RIBBON -->
<div id="ribbon">

    <span class="ribbon-button-alignment"> 
        <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
            <i class="fa fa-refresh"></i>
        </span> 
    </span>

    <!-- breadcrumb -->
    <ol class="breadcrumb">
        <li>Home</li><li><?php echo $mod_name;?></li><li><?php echo $btnvalue;?></li>
    </ol>
    <!-- end breadcrumb -->

    <!-- You can also add more buttons to the
    ribbon for further usability

    Example below:

    <span class="ribbon-button-alignment pull-right">
    <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
    <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
    <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
    </span> -->

</div>
<!-- END RIBBON -->

<!-- MAIN CONTENT -->
<div id="content">

    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-edit fa-fw "></i>
                <?php echo $mod_name;?>
                <span>> 
                    <?php echo $btnvalue;?>
                </span>
            </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            <!--<ul id="sparks" class="">
                <li class="sparks-info">
                    <h5> My Income <span class="txt-color-blue">$47,171</span></h5>
                    <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                        1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
                    </div>
                </li>
                <li class="sparks-info">
                    <h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
                    <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
                        110,150,300,130,400,240,220,310,220,300, 270, 210
                    </div>
                </li>
                <li class="sparks-info">
                    <h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
                    <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
                        110,150,300,130,400,240,220,310,220,300, 270, 210
                    </div>
                </li>
            </ul>-->
        </div>
    </div>

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <!-- START ROW -->

        <div class="row">

            <!-- NEW COL START -->
            <article class="col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                    <!-- widget options:
                    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
    
                    data-widget-colorbutton="false"
                    data-widget-editbutton="false"
                    data-widget-togglebutton="false"
                    data-widget-deletebutton="false"
                    data-widget-fullscreenbutton="false"
                    data-widget-custombutton="false"
                    data-widget-collapsed="true"
                    data-widget-sortable="false"
    
                    -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Basic Form Elements </h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">

                            <form class="smart-form" action="module_act.php?purl=<?php echo $_REQUEST['chkp']?>" method="post">
                                <?php echo $Form->input('hidden', 'mid', $mid, 'textfield',''); ?>
                                <fieldset>
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Module Name</label>
                                            <label class="input">
                                                <input type="text" name="txtname" value="<?php echo $mname;?>" />
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Description</label>
                                            <label class="textarea">
                                                <textarea rows="3" class="custom-scroll" name="txtdes"><?php echo $mdes;?></textarea>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-2">
                                            <div class="inline-group">
                                                <label class="toggle">
                                                    <input type="checkbox" name="status"  <?php if($ms=="A") echo 'checked=""'; elseif($ms=="D") echo '';?>>
                                                    <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Status</label>
                                            </div>
                                        </section>
                                    </div>
                                </fieldset>

                                <footer>
                                    <button type="submit" class="btn btn-primary" value="<?php echo $btname;?>" name="<?php echo $btname;?>">
                                        Submit
                                    </button>
                                    <button type="button" class="btn btn-default" onClick="window.history.back();">
                                        Back
                                    </button>
                                </footer>
                            </form>

                        </div>



                        <div class="widget-body no-padding">

                            <script language="javascript" type="text/javascript">
                                getMod('','UsrDiv', 'gemodules.php',<?php echo $_REQUEST['chkp']?>);
                            </script>

                            <div id="UsrDiv" style="border:1px #CCCCCC solid;">Please wait while loading Module list...</div>

                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
                <!-- end widget -->

            </article>
            <!-- END COL -->

        </div>


    </section>
    <!-- end widget grid -->


</div>
<!-- END MAIN CONTENT -->
