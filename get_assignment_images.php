<?php
include "class/cls_db.php";
$db = new db();

foreach($_POST as $name => $val )
$$name=$val;

?>
<ul class="nav navbar-top-links navbar-left">
    <li class="dropdown">
        <div class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" style="padding:10px 0px 0px 30px;" id="sproduct_picture<?php echo $i;?>ofsize<?php echo $l;?>">
            Select Picture
        </div>
         <ul class="dropdown-menu mailbox animated bounceInDown" style="width:150px !important;">
         	<?php //AND tbl_stocks.client_id='$client'
			$itemQuery="SELECT * FROM tbl_items, tbl_stock_items, tbl_stock WHERE tbl_stock_items.item_id=tbl_items.item_id AND tbl_stock_items.stock_id=tbl_stock.stock_id AND tbl_items.status='Enable' AND tbl_items.item_id='".$item_id."'";
			$itemQueryselected=$db->record_select($itemQuery);
			foreach($itemQueryselected as $costoum)
			{
			$imagepath="plugins/images/stock/".$costoum['stock_image']."";
			if($costoum['stock_image']!=""){ ?>
            <li>
                <div class="message-center">
                    <a href="javascript:;" class="clsproimages" reli="<?php echo $i;?>" rel="<?php echo $l;?>" relimg="<?php echo $imagepath;?>" relid="<?php echo $costoum['stock_item_id'];?>">
                        <div class="mail-contnet" style="text-align:center;">
                        	<img src="<?php echo $imagepath;?>" width="50" alt="user" class="img-circle">
                        </div>
                    </a>
                </div>
            </li>
            <?php } }?>
        </ul>
    </li>
</ul>


<!--<ul class="dropdown-menu mailbox animated bounceInDown">
    <li>
        <div class="message-center">
            <a href="#">
                <div class="user-img"> <img src="plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                <div class="mail-contnet">
                    <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
            </a>
        </div>
    </li>
    <li>
        <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
    </li>
</ul>
-->


