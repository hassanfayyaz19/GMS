<?php
if($_GET['cmdType']=="edit")
{
    $mid=$_GET['mid'];
    $sqleventId="SELECT * FROM tbl_uom WHERE uom_id=$mid";
    $sqleventIdQ=$db->record_select($sqleventId);
    foreach($sqleventIdQ[0] as $name => $val)
    $$name=$val;
    
    $pagetitle='Edit';
}
else
{
    $pagetitle='Add';
}
?>


        
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo $pagetitle;?> STOCK</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <?php
    if($_GET['cmdType']=="edit"){
    ?>
        <a href="index_admin.php?chkp=382&m=124" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ADD STOCK</a>
    <?php }?>
        <a href="index_admin.php?chkp=381&m=124" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">ALL STOCK</a>
        <!--<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
        <ol class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Form Layout</li>
        </ol>-->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!--.row-->
<form action="conf_add_stock.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>" id="form1" method="post" enctype="multipart/form-data">
<?php echo $GeneralFunctions->alertmessages($_POST['msg_type'],$_POST['msg']);?>
<?php echo $GeneralFunctions->cmdType($_GET['cmdType'],$_GET['mid']);?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="white-box">
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                        <div class="form-body">
                            <h3 class="box-title">Stock Information</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <select class="form-control select2" name="client_id" id="client_id" rel="0">
                                                <option value="">-Select Client-</option>
                                                <?php $sqlevents="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_sts='A' AND tbllogin.typ_id=3 AND tbllogin.log_id=tbl_users.log_id";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['log_id'];?>"><?php echo $sqleventsD['user_first_name'];?></option><?php }?>
                                            </select>
                                        </div>
                                        <span id="error_client_id" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <select class="form-control select2" name="location_id" id="location_id" rel="0">
                                                <option value="">-Select Location-</option>
                                                <?php $sqlevents="SELECT * FROM tbl_location WHERE location_status='Enable'";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['location_id'];?>"><?php echo $sqleventsD['location'];?></option><?php }?>
                                            </select>
                                        </div>
                                        <span id="error_location_id" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td>
                                        <table class="form-table customFields" id="customFields" width="100%">
                                          <tr>
                                            <th width="5%"><b>No.</b></th>
                                            <th width="15%"><b>Name</b></th>
                                            <th width="15%"><b>Code</b></th>
                                            <th width="14%"><b>Photo</b></th>
                                            <th width="5%"><b>Color</b></th>
                                            <th width="8%"><b>Color Code</b></th>
                                            <th width="11%"><b>UOM</b></th>
                                            <th width="10%"><b>Unit</b></th>
                                            <th width="15%" colspan="2"><b>Quantity(1st/2nd)</b></th>
                                            <th width="2%">&nbsp;</th>
                                          </tr>
                                           <tr valign="top">
                                                <td><input class="form-control" id="serial" name="serial[]" data-validate="required" value="1" readonly />
                                                    <input  value="1" name="maxrecord" id="maxrecord" type="hidden" />
                                                </td>
                                                <td id="itemnamesel0">
                                                <select class="form-control select2 itemName" name="item_name0" id="item_name0" rel="0">
                                                    <?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['item_id'];?>"><?php echo $sqleventsD['item_name'];?></option><?php }?>
                                                </select>
                                                </td>
                                                <td id="itemcodesel0">
                                                <select class="form-control select2 itemCode" name="item_code0" id="item_code0" rel="0">
                                                    <?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['item_id'];?>"><?php echo $sqleventsD['item_code'];?></option><?php }?>
                                                </select>
                                                </td>
                                                <td>
                                                    <div class="form-control">
                                                        <div class="bg btn-file">
                                                            <div id="view0" class="viewcls">
                                                                <i class="entypo-picture"></i> &nbsp;Upload Picture 
                                                            </div>
                                                            <input type="file" id="stock_pictures0" name="stock_pictures0" class="clsstockpicview" rel="0"/>
                                                        <div id="cross0"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input type="color" class="form-control colorpiker" style="padding:0px;" rel="0" id="stockcolor0" name="stockcolor0" value="#FF6347" /></td>
                                                <td><input type="text" class="form-control textAlign_center colorpikercode" rel="0" style="padding:0px;" id="stockcolorname0" name="stockcolorname0" value="#FF6347" /></td>
                                                <td id="itemuom0">
                                                    <div  class="input-group">
                                                <select class="form-control"  name="uom0" id="uom0" oninput="positionfreaze(0);">
                                                    <option value="0">Select UOM</option>
                                                    <?php 
                                                    $uomQuery="select * from tbl_uom where uom_status='Enable'";
                                                    $uomQueryselected=$db->record_select($uomQuery);
                                                    foreach($uomQueryselected as $uom){
                                                    ?>
                                                        <option value="<?php echo $uom['uom_id'];?>"><?php echo $uom['uom'];?></option>
                                                    <?php } ?>
                                                </select>
                                                </div>
                                                <span id="error_uom0" class="text-danger"></span>
                                                </td>
                                                <td id="unit0">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr>
                                                        <td width="85%"><input class="form-control clsunit" id="position0" name="position0" placeholder="Unit" type="number" rel="0">
                                                            <span id="error_position0" class="text-danger"></span>

                                                        </td>
                                                        <td><i class="fa fa-eye clseye" id="eye0" style="display:none; cursor:pointer; color:green;" rel="0"></i></td>
                                                      </tr>
                                                    </table>
                                                    
                                                    
                                                </td>
                                                <td><input class="form-control" id="firstquantity0" name="firstquantity0" readonly="readonly"  data-validate="required" placeholder="">
                                                    <input type="hidden" class="form-control" id="firstquantityh0" name="firstquantityh0" data-validate="required" placeholder="">
                                                </td>
                                                <td><input id="printpermission" name="printpermission" hidden />
                                                <input class="form-control" id="secondquantity0" name="secondquantity0" readonly="readonly" data-validate="required" placeholder="">
                                                <input type="hidden" class="form-control" id="secondquantityh0" name="secondquantityh0" data-validate="required" placeholder="">
                                                </td>
                                                <td style="text-align:center"><a href="javascript:void(0);" id="addCF"><i class="fa fa-plus"></i></a></td>
                                            </tr>
                                        </table>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                            <div id="roller">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="text-right">
                                            <button type="submit" id="sbmt" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                            <a href="index_admin.php?chkp=381&m=124" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>  
                                                                 
                            </div>
                            <!--/row-->
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form action="conf_send_email.php?chkp=<?php echo $_GET['chkp'];?>" method="post" id="FormEmail" enctype="multipart/form-data">
<input type="hidden" name="mid" value="<?php echo $_GET['mid'];?>" />
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabel">Unit</h4> </div>
                    <div class="modal-body">
                        <div id="emailformmsg">
                        
                        </div>
                        <div id="unitDiv">
                         
                        </div>
                        
                    </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
</div>

<!--.row-->
<!-- ============================================================== -->
<!-- .right-sidebar -->

<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->

<script>
var i=1;
$(document).on("click","#addCF", function(){
        $("#customFields").append('<tr class="rowTextCenter"><td><input class="form-control" id="serial" name="serial[]" data-validate="required" value="'+(i+1)+'" readonly /><input type="hidden" name="itemId'+(i)+'" id="itemId'+(i)+'" value="" /></td><td id="itemnamesel'+i+'"><select class="form-control select2 itemName" name="item_name'+i+'" id="item_name'+i+'" rel="'+i+'"><?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['item_id'];?>"><?php echo $sqleventsD['item_name'];?></option><?php }?></select></td><td id="itemcodesel'+i+'"><select class="form-control select2 itemCode" name="item_code'+i+'" id="item_code'+i+'" rel="'+i+'"><?php $sqlevents="SELECT * FROM tbl_items WHERE status='Enable'";$sqleventsQ=$db->record_select($sqlevents);foreach($sqleventsQ as $sqleventsD){?><option value="<?php echo $sqleventsD['item_id'];?>"><?php echo $sqleventsD['item_code'];?></option><?php }?></select></td><td><div class="form-control"><div class="bg btn-file"><div id="view'+i+'" class="viewcls"><i class="entypo-picture"></i> &nbsp;Upload Picture</div><input type="file" id="stock_pictures'+i+'" class="clsstockpicview" name="stock_pictures'+i+'" rel="'+i+'"/><div id="cross'+i+'"></div>   </div></div></td><td><input type="color" class="form-control colorpiker" style="padding:0px;" id="stockcolor'+i+'" name="stockcolor'+i+'" value="#F'+i+'A'+i+i+i+'" rel="'+i+'" /></td><td><input type="text" class="form-control textAlign_center" style="padding:0px;" id="stockcolorname'+i+'" name="stockcolorname'+i+'" value="#F'+i+'A'+i+i+i+'" onchange="colormerger('+i+',this.value)" /></td><td id="itemuom'+i+'"><select class="form-control"  name="uom'+i+'" id="uom'+i+'" oninput="positionfreaze('+i+');"><option value="0">Select UOM</option><?php $uomQuery="select * from tbl_uom where uom_status='Enable'";$uomQueryselected=$db->record_select($uomQuery);foreach($uomQueryselected as $uom){?><option value="<?php echo $uom['uom_id'];?>"><?php echo $uom['uom'];?></option><?php } ?></select></td><td><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="80%"><input class="form-control clsunit" id="position'+i+'" value="" name="position'+i+'" type="number" data-validate="required" placeholder="" rel="'+i+'"></td><td><i class="fa fa-eye clseye" id="eye'+i+'" style="display:none; cursor:pointer; color:green;" rel="'+i+'"></i></td></tr></table></td><td><input class="form-control" id="firstquantity'+i+'" readonly="readonly"  name="firstquantity'+i+'" data-validate="required" placeholder=""><input type="hidden" class="form-control" id="firstquantityh'+i+'" name="firstquantityh'+i+'" data-validate="required" placeholder=""></td><td><input class="form-control" id="secondquantity'+i+'" name="secondquantity'+i+'" data-validate="required"  readonly="readonly" placeholder=""><input type="hidden" class="form-control" id="secondquantityh'+i+'" name="secondquantityh'+i+'" data-validate="required" placeholder=""></td><td style="text-align:center"><a href="javascript:void(0);" class="inputcode remCF" rel="'+i+'" id="remCF"><i class="fa fa-times"></i></a></td></tr>');
        $("#item_name"+i+"").select2();
        $("#item_code"+i+"").select2();

        
        i++;
        document.getElementById("maxrecord").value=i;
    
    
});



$(document).on("click",".btnCancel", function(){
    $('#myModal1').modal('hide');
});

$(document).on("click",".btnunittotal", function(){
    var x=$(this).attr("relx");
    var i=$(this).attr("reli");
    var firtvaltemp;
    var secondvaltemp;
    var firtval=0;
    var secondval=0;
    
    for(var j=1;j<=<?php echo $MaxRolDel;?>;j++)
    {
        var removeField='#item'+x+'roll'+j+'';
        var removeFieldf='#item'+x+'roll'+j+'first'+j+'';
        var removeFields='#item'+x+'roll'+j+'second'+j+'';
        $(removeField).remove();
        $(removeFieldf).remove();
        $(removeFields).remove();
    }
    
    for(var j=1;j<=i;j++)
    {
        rollIdtemp="#tempitem"+x+"roll"+j;
        firtvaltemp="#tempitem"+x+"roll"+j+"first"+j;
        secondvaltemp="#tempitem"+x+"roll"+j+"second"+j;
        firtval=firtval+parseFloat(($(firtvaltemp).val()));
        secondval=secondval+parseFloat(($(secondvaltemp).val()));
        
        $("#roller").append(
            '<input value="'+($(rollIdtemp).val())+'" id="item'+x+'roll'+j+'" name="item'+x+'roll'+j+'" data-validate="required" type="hidden" />'+
            '<input value="'+($(firtvaltemp).val())+'" id="item'+x+'roll'+j+'first'+j+'"  name="item'+x+'roll'+j+'first'+j+'" data-validate="required" type="hidden" />'+
            '<input value="'+($(secondvaltemp).val())+'" id="item'+x+'roll'+j+'second'+j+'" name="item'+x+'roll'+j+'second'+j+'" data-validate="required" type="hidden" />');
        
    }
    //alert(firtval+"-"+secondval);
    $("#firstquantity"+x).val(firtval.toFixed(<?php echo $RoundUpTo;?>));
    $("#secondquantity"+x).val(secondval.toFixed(<?php echo $RoundUpTo;?>));
    
    $("#firstquantityh"+x).val(firtval.toFixed(<?php echo $RoundUpTo;?>));
    $("#secondquantityh"+x).val(secondval.toFixed(<?php echo $RoundUpTo;?>));
    $('#myModal1').modal('hide');
    $("#eye"+x).show();
    //document.getElementById("eye"+x).style.display="block";
    
});

$(document).on("change",".clsunit",function(){
    $('#myModal1').modal({show:true});
    //var totalunit=$(this).val();
    //var x=$(this).attr("rel");
    var x=$(this).attr("rel");
    var totalunit=$("#position"+x).val();
    var item_code_temp="#item_code"+x;
    var item_code_val=$(item_code_temp).val();
    
    
    
    // code to filter and select item code
    $.ajax({
    url: 'get_stock_unit_code.php',
    type: 'POST',
    data: { totalunit:totalunit, x:x, item_code:item_code_val}, // it will serialize the form data
        dataType: 'html'
    })
    .done(function(data){
        //var resultArray = jQuery.parseJSON(data);
        //alert(data);
        $("#unitDiv").html(data);
        var rollIdtemp,firtvaltemp,secondvaltemp,lastrollId,lastRollFirstVal,lastRollSecondVl;
        for(var j=1;j<=totalunit;j++)
        {
            // to get last hidden fields
            lastrollId='#item'+x+'roll'+j+'';
            lastRollFirstVal='#item'+x+'roll'+j+'first'+j+'';
            lastRollSecondVl='#item'+x+'roll'+j+'second'+j+'';
            
            // to store data
            rollIdtemp="#tempitem"+x+"roll"+j;
            firtvaltemp="#tempitem"+x+"roll"+j+"first"+j;
            secondvaltemp="#tempitem"+x+"roll"+j+"second"+j;
            
            
            if($(lastrollId).val())
            $(rollIdtemp).val($(lastrollId).val());
            
            if($(lastRollFirstVal).val()!="")
            $(firtvaltemp).val($(lastRollFirstVal).val());
            
            if($(lastRollSecondVl).val()!="")
            $(secondvaltemp).val($(lastRollSecondVl).val());
        }
        

    })
    .fail(function(){
        alert('Ajax Submit Failed ...');    
    }); });
$(document).on("click",".clseye",function(){
    $('#myModal1').modal({show:true});
    //var totalunit=$(this).val();
    //var x=$(this).attr("rel");
    var x=$(this).attr("rel");
    var totalunit=$("#position"+x).val();
    var item_code_temp="#item_code"+x;
    var item_code_val=$(item_code_temp).val();
    
    
    
    // code to filter and select item code
    $.ajax({
    url: 'get_stock_unit_code.php',
    type: 'POST',
    data: { totalunit:totalunit, x:x, item_code:item_code_val}, // it will serialize the form data
        dataType: 'html'
    })
    .done(function(data){
        //var resultArray = jQuery.parseJSON(data);
        //alert(data);
        $("#unitDiv").html(data);
        var rollIdtemp,firtvaltemp,secondvaltemp,lastrollId,lastRollFirstVal,lastRollSecondVl;
        for(var j=1;j<=totalunit;j++)
        {
            // to get last hidden fields
            lastrollId='#item'+x+'roll'+j+'';
            lastRollFirstVal='#item'+x+'roll'+j+'first'+j+'';
            lastRollSecondVl='#item'+x+'roll'+j+'second'+j+'';
            
            // to store data
            rollIdtemp="#tempitem"+x+"roll"+j;
            firtvaltemp="#tempitem"+x+"roll"+j+"first"+j;
            secondvaltemp="#tempitem"+x+"roll"+j+"second"+j;
            
            
            if($(lastrollId).val())
            $(rollIdtemp).val($(lastrollId).val());
            
            if($(lastRollFirstVal).val()!="")
            $(firtvaltemp).val($(lastRollFirstVal).val());
            
            if($(lastRollSecondVl).val()!="")
            $(secondvaltemp).val($(lastRollSecondVl).val());
        }
        

    })
    .fail(function(){
        alert('Ajax Submit Failed ...');    
    }); });

$(document).on("keyup",".clsyards", function(){
    var x=$(this).attr("relx");
    var i=$(this).attr("reli");
    var firstval=$(this).val();
    var secondval=(firstval/<?php echo $ratio;?>).toFixed(<?php echo $RoundUpTo;?>);
    var secondvaltemp="#tempitem"+x+"roll"+i+"second"+i;
    $(secondvaltemp).val(secondval);
});

$(document).on("keyup",".clsmeters", function(){
    var x=$(this).attr("relx");
    var i=$(this).attr("reli");
    var secondtval=$(this).val();
    var firstval=(secondtval*<?php echo $ratio;?>).toFixed(<?php echo $RoundUpTo;?>);
    var firtvaltemp="#tempitem"+x+"roll"+i+"first"+i;
    $(firtvaltemp).val(firstval);
});

$(document).on("change",".itemName",function(){
    var item_name=$(this).val();
    var x=$(this).attr("rel");
    var item_code_temp="#item_code"+x;
    var itemcodeseltemp="#itemcodesel"+x;
    var itemuomtemp="#itemuom"+x;
    // code to filter and select item code
    $.ajax({
    url: 'get_stock_itemcode.php',
    type: 'POST',
    data: { item_id:item_name, x:x}, // it will serialize the form data
        dataType: 'html'
    })
    .done(function(data){
        //var resultArray = jQuery.parseJSON(data);
        //alert(data);
        $(itemcodeseltemp).html(data); 
        $("#item_code"+x+"").select2();

    })
    .fail(function(){
        alert('Ajax Submit Failed ...');    
    });
    
    // to filter and select UOM against that item
    $.ajax({
    url: 'get_stock_itemcode_uom.php',
    type: 'POST',
    data: { item_id:item_name, x:x}, // it will serialize the form data
        dataType: 'html'
    })
    .done(function(data){
        //var resultArray = jQuery.parseJSON(data);
        //alert(data);
        $(itemuomtemp).html(data); 
        var newuom="#uom"+x;
        var newuomval=$(newuom).val();
       // console.log(newuomval);
        if(newuomval==7 || newuomval==4 )
        {
            $("#position"+x).prop('readonly', false);
            $("#secondquantity"+x).prop('readonly', true);
            $("#firstquantity"+x).prop('readonly', true);
        }
        if(newuomval!=1 && newuomval!=7  && newuomval!=4)
        {
            $("#position"+x).prop('readonly', true);
            $("#secondquantity"+x).prop('readonly', false);
            $("#firstquantity"+x).prop('readonly', false);
        } else
        {
            $("#position"+x).prop('readonly', false);
            $("#secondquantity"+x).prop('readonly', true);
            $("#firstquantity"+x).prop('readonly', true);
        }
        
        

    })
    .fail(function(){
        alert('Ajax Submit Failed ...');    
    });});

$(document).on("change",".itemCode",function(){
    var item_name=$(this).val();
    var x=$(this).attr("rel");
    var item_name_temp="#item_name"+x;
    var itemnameseltemp="#itemnamesel"+x;
    var itemuomtemp="#itemuom"+x;
    // code to filter and select item code
    $.ajax({
    url: 'get_stock_itemname.php',
    type: 'POST',
    data: { item_id:item_name, x:x}, // it will serialize the form data
        dataType: 'html'
    })
    .done(function(data){
        //var resultArray = jQuery.parseJSON(data);
        //alert(data);
        $(itemnameseltemp).html(data); 
        $("#item_name"+x+"").select2();

    })
    .fail(function(){
        alert('Ajax Submit Failed ...');    
    });
    
    // to filter and select UOM against that item
    $.ajax({
    url: 'get_stock_itemcode_uom.php',
    type: 'POST',
    data: { item_id:item_name, x:x}, // it will serialize the form data
        dataType: 'html'
    })
    .done(function(data){
        //var resultArray = jQuery.parseJSON(data);
        //alert(data);
        $(itemuomtemp).html(data);

    })
    .fail(function(){
        alert('Ajax Submit Failed ...');    
    });});

$(document).on("change",".clsstockpicview",function(){
    var x=$(this).attr("rel");
    if(document.getElementById("stock_pictures"+x).value!=""){
        document.getElementById("stockcolor"+x).disabled = true;
        document.getElementById("stockcolorname"+x).disabled = true;
        //toastr.success("","Photo Selected for the record "+(x+1),top);
        document.getElementById("view"+x).innerHTML = '<div class="col-md-6">'+
                                                      ' <img src="" id="stock_image'+x+'" width="40px" height="20px" style="border-radius:50%;">'+
                                                      '</div>';
        document.getElementById("cross"+x).innerHTML ='<div class="col-md-6"><i class="fa fa-times imgdel" rel="'+x+'"></i></div>';
        var reader = new FileReader();
            reader.onload = function (event){
            $('#stock_image'+x).attr('src', event.target.result);
            };
            var stockpick=document.getElementById("stock_pictures"+x);
            reader.readAsDataURL(stockpick.files[0]);
    }else{
        document.getElementById("stockcolor"+x).disabled = false;
        document.getElementById("stockcolorname"+x).disabled = false;
    }});

$(document).on('click', ".imgdel",function(){
    var x=$(this).attr("rel");
    document.getElementById("stockcolor"+x).disabled = false;
    document.getElementById("stockcolorname"+x).disabled = false;
    $("#stock_pictures"+x).val();
    $("#view"+x).html('<i class="entypo-picture"></i> &nbsp;Upload Picture ');
    $("#cross"+x).html('');});

$(document).on('click', ".remCF",function(){
    var x=$(this).attr("rel");
    var position=$("#position"+x).val();
    
    for(var j=1;j<=position;j++)
    {
        var rollIdtemp="#item"+x+"roll"+j;
        var firtvaltemp="#item"+x+"roll"+j+"first"+j;
        var secondvaltemp="#item"+x+"roll"+j+"second"+j;
        
        $("#firstquantityh"+x).val(0);
        $("#secondquantityh"+x).val(0);
        
        $(rollIdtemp).remove();
        $(firtvaltemp).remove();
        $(secondvaltemp).remove();
    }
    $(this).parent().parent().remove();
    
    

    
});

$(document).on('change', ".colorpiker",function(){
    var thisval=$(this).val();
    var thisid=$(this).attr("rel");
    document.getElementById("stockcolorname"+thisid).value = thisval;});

$(document).on('change', ".colorpikercode",function(){
    var thisval=$(this).val();
    var thisid=$(this).attr("rel");
    document.getElementById("stockcolor"+thisid).value = thisval;});
        
    //Warning Message
$('.deleteImg').click(function(){
    var mid=$(this).attr("rel");
    swal({   
        title: "Are you sure?",   
        text: "to delete this record",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        closeOnConfirm: false 
    }, function(){   
        //swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
        document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=deldownloadImg&mid="+mid;
    });});
$('.deleteFile').click(function(){
        var mid=$(this).attr("rel");
        swal({   
            title: "Are you sure?",   
            text: "to delete this record",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false 
        }, function(){   
            //swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
            document.location="conf_delete.php?chkp=<?php echo $_GET['chkp'];?>&m=<?php echo $_GET['m'];?>&cmdType=deldownloadFile&mid="+mid;
        });
    });

jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    
$(document).ready(function() {
            $('#sbmt').click(function (e) {
          e.preventDefault();
        var error_client_id = '';
        var error_location_id = '';
        var error_uom0 = '';
        var error_position0 = '';
        if($('#client_id').val() == '')
        {
            error_client_id = 'Client id is Required';
            $('#error_client_id').text(error_client_id);
            $('#client_id').css('border-color', '#cc0000');
        }
        else
        {
            error_client_id = '';
            $('#error_client_id').text(error_client_id);
            $('#client_id').css('border-color', '');
        }
        if($('#location_id').val() == '')
        {
            error_location_id = 'Location is Required';
            $('#error_location_id').text(error_location_id);
            $('#location_id').css('border-color', '#cc0000');
        }
        else
        {
            error_location_id = '';
            $('#error_location_id').text(error_location_id);
            $('#location_id').css('border-color', '');
        }
        if($('#uom0').val() == '0')
        {
            error_uom0 = 'UOM is Required';
            $('#error_uom0').text(error_uom0);
            $('#uom0').css('border-color', '#cc0000');
        }
        else
        {
            error_uom0 = '';
            $('#error_uom0').text(error_uom0);
            $('#uom0').css('border-color', '');
        }
 
                     

        
       if($('#client_id').val()!='' && $('#location_id').val()!='' && $('#uom0').val()!='' && $('#position0').val()!='')
       {
      $("#form1").submit();
       }

    });



        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-d�posez un fichier ici ou cliquez',
                replace: 'Glissez-d�posez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'D�sol�, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });

jQuery(document).ready(function() {
    
        $(document).on("keyup",".pagename",function(){
            var valu=$(this).val();
            var aliasvalu=valu.split(' ').join('-');
            var aliasvalu=aliasvalu.split(<?php echo $JQueryREforURL;?>).join('-');
            $("#page_alias").val(aliasvalu.toLowerCase());
        });
        
        $(document).on("blur",".pagename",function(){
            var valu=$(this).val();
            var aliasvalu=valu.split(' ').join('-');
            var aliasvalu=aliasvalu.split(<?php echo $JQueryREforURL;?>).join('-');
            $("#page_alias").val(aliasvalu.toLowerCase());
        });
    
    
    
        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
        $('.inline-editor').summernote({
            airMode: true
        });
        
        
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        
        
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        
        
    });
window.edit = function() {
    $(".click2edit").summernote()
}, window.save = function() {
    $(".click2edit").destroy()
}

$(".select2").select2();
</script>