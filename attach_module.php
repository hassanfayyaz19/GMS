<?php 
$sqlmodule="SELECT tblmodules.mod_name FROM tblmodules, tblmodulespages WHERE tblmodulespages.link_id=".$_GET['chkp']." and tblmodulespages.mod_id=tblmodules.mod_id";
$sqlmoduleQ=$db->record_select($sqlmodule);
/*$sqlmoduleQ=mysql_query($sqlmodule);
$sqlmoduleD=mysql_fetch_array($sqlmoduleQ);*/

$mod_name=$sqlmoduleQ[0]['mod_name'];



$btname='Add';

$btnvalue="Attach Modules";



$src='images/Add_bt.jpg';

$selFun="getmod(this,\"get_mods\");";

$result = "SELECT * FROM tblmodules order by mod_id  LIMIT 1";
$resultQ=$db->record_select($result);
foreach($resultQ as $rstRow)
{
	$mid=str_replace("&","&amp;",$rstRow['mod_id']);
}

?>

<script language="javascript" src="js/get_att_modules.js"></script>

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

    

                            <form class="smart-form" action="attach_module_act.php?purl=<?php echo $_REQUEST['chkp']?>" method="post" enctype="multipart/form-data">    

                            <?php echo $Form->input('hidden', 'mid', $mid, 'textfield',''); ?>

                            <?php echo $Form->input('hidden', 'txtpath', 'index_admin.php', 'textfield',''); ?>

                                <fieldset>

                                    <div class="row">

                                        <section class="col col-4">

                                            <label class="label">Select Module</label>

                                            <label class="select">

                                                <?php //echo $Form->selectList('select_module', $selFun, 'tblmodules', '', '', 'mod_id', '', '', 'input-sm','mod_name', ''); ?><i></i>
                                                <?php 	
													$sList="<select name='select_module' id='select_module' class='textfield' onChange='".$selFun."'>";
													$sql ="SELECT * FROM tblmodules order by mod_id ";
													$result=$db->record_select($sql);
													foreach($result as $code) {
													$sList .= "<option value=\"".$code['mod_id']."\" >".ucwords(strtolower($code['mod_name']))."</option>";
													}
													$sList .="</select>"; 
													echo $sList;
												?>

                                            </label>

                                        </section>

    								</div>

                                    <div class="row">

                                        <section class="col col-6">

                                            <label class="label">Assign to Users</label>

                                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td>



                                                <?php 

												$type=$_SESSION['utype'];

												if($type==1){

												$wc='typ_id <= 1000';

												}else{

												$wc='typ_id <> 1 and typ_id <> 2';

												}

												//$q=$db->select('tblusertype', '', '', $wc, '', '', '3' );
												$sqlsel="select * from tblusertype where $wc ";
												$i=0;
												
												$sqlselQ=$db->record_select($sqlsel);
												
												
												$nrows= $db->record_total($sqlsel);

												foreach($sqlselQ as $qlink) {

													$chkid="chkid".$i;

													$chk="chk".$i;

													$qr="select grp_permission from tblgroup where mod_id=$mid and typ_id= ".$qlink['typ_id']."";
													$nrows=$db->record_total($qr);

														if($nrows > 0)
														{
															$qrQ=$db->record_select($qr);
															foreach($qrQ as $rstRow)
															{

																if($rstRow[0]=="" || $rstRow[0]=="N"){

																echo '<label class="checkbox1">

																<input type="checkbox" value="Y" name="'.$chk.'" id="'.$chk.'">

																<i></i>'.$qlink['typ_name'].'</label><br />'.$Form->input('hidden', $chkid, $qlink['typ_id'], '','');

																}else{

																echo '<label class="checkbox1">

																<input type="checkbox" value="Y" checked="checked" name="'.$chk.'" id="'.$chk.'">

																<i></i>'.$qlink['typ_name'].'</label><br />'.$Form->input('hidden', $chkid, $qlink['typ_id'], '','');

																}

															}

														}else{

																echo '<label class="checkbox1">

																<input type="checkbox" value="Y" name="'.$chk.'" id="'.$chk.'">

																<i></i>'.$qlink['typ_name'].'</label><br />'.$Form->input('hidden', $chkid, $qlink['typ_id'], '','');

														}

												$i++;

												}

												echo $Form->input('hidden', 'tloop', $i, '','');

												?>

                                                </td>

  </tr>

</table>

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

