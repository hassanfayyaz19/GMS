<?php
if($session_utype==4)
{
	include 'dashboard_supervisor.php';
}
if($session_utype==1 || $session_utype==2)
{
	if(isset($_POST['formfilter']))
	{
		/*$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];*/
		$fromdate=date("Y-m-d",strtotime($_POST['fromdate']));
		$todate=date("Y-m-d",strtotime($_POST['todate']));
		$fromdateC=$_POST['fromdate'];
		$todateC=$_POST['todate'];
		
		
		$partyb_id=$_POST['partyb_id'];
		if($partyb_id!="")
		{
			$partyBsql=' AND partyb_id='.$partyb_id.'';
			$voucherpartyBsql=' AND tbl_voucher.partyb_id='.$partyb_id.'';
			$paymentpartyBsql=' AND tbl_receive_payment.partyb_id='.$partyb_id.'';
		}
	}
	else
	{
		/*$fromdate=date("m/01/Y");
		$todate=date("m/d/Y");*/
		$fromdate=date("Y-01-01");
		//$fromdate=date("Y-m-d");
		$todate=date("Y-m-d");
		$fromdateC=date("01/01/Y");
		$todateC=date("m/d/Y");
		
		$partyBsql='';
		$voucherpartyBsql='';
		$paymentpartyBsql='';
	}
	// to get all invoices
	$sqlinvoices="SELECT * FROM tbl_invoice WHERE invoice_sts=1 AND (invoice_date BETWEEN '$fromdate' AND '$todate') ".$partyBsql."";
	$totalInvoices=$db->record_total($sqlinvoices);
	// to get sum of all invoices
	$sqlinvoicesamount="SELECT sum(invoice_total) as invoice_total FROM tbl_invoice WHERE invoice_sts=1 AND (invoice_date BETWEEN '$fromdate' AND '$todate') ".$partyBsql."";
	$sqlinvoicesamountQ=$db->record_select($sqlinvoicesamount);
	
	// to get tax sum of all invoices
	$sqltaxsumamount="SELECT sum(invoice_gst) as invoice_gst FROM tbl_invoice WHERE invoice_sts=1 AND invoice_date BETWEEN '$fromdate' AND '$todate' ".$partyBsql."";
	$sqltaxsumamountQ=$db->record_select($sqltaxsumamount);
	
	// to get all Received Payments
	$sqlpayments="SELECT * FROM tbl_receive_payment WHERE payment_sts=1 AND (payment_date BETWEEN '$fromdate' AND '$todate') ".$partyBsql."";
	$totalPayments=$db->record_total($sqlpayments);
	// to get som of all Received Payments
	$sqlpaymentsamount="SELECT sum(payment_amount) as payment_amount FROM tbl_receive_payment WHERE payment_sts=1 AND (payment_date BETWEEN '$fromdate' AND '$todate') ".$partyBsql."";
	$sqlpaymentsamountQ=$db->record_select($sqlpaymentsamount);
	
	
	
	// to get all Vouchers
	$sqlvouchers="SELECT * FROM tbl_voucher, tbl_receive_payment WHERE tbl_voucher.payment_id=tbl_receive_payment.payment_id AND (tbl_voucher.voucher_date BETWEEN '".$fromdate."' AND '".$todate."') ".$voucherpartyBsql."";
	$totalVouchers=$db->record_total($sqlvouchers);
	// to get sum of all Voucher Payments
	$sqlvoucherssamount="SELECT sum(tbl_receive_payment.payment_amount) as voucher_amount FROM tbl_voucher, tbl_receive_payment WHERE tbl_voucher.payment_id=tbl_receive_payment.payment_id AND tbl_receive_payment.payment_sts=1 AND (tbl_voucher.voucher_date BETWEEN '".$fromdate."' AND '".$todate."') ".$voucherpartyBsql."";
	$sqlvoucherssamountQ=$db->record_select($sqlvoucherssamount);
	
	// to get total accounts created by admin
	$sqlaccounts="SELECT * FROM tbl_account WHERE account_sts=1";
	$totalAccounts=$db->record_total($sqlaccounts);
	
	$pastDaysChart=$GeneralFunctions->get_past_date_arrays(date("m/d/Y"),"7","-","Y-m-d");
	
	
	// to get today cheques and amounts
	$sqltodaycheques="SELECT SUM(payment_amount) AS payment_amount FROM tbl_receive_payment WHERE cheque_date='".$todayDateMysql."' ".$paymentpartyBsql."";
	$totaltodaycheques=$db->record_total($sqltodaycheques);
	$sqltodaychequesQ=$db->record_select($sqltodaycheques);
	
	// to get future cheques and amounts
	$sqlfuturecheques="SELECT SUM(payment_amount) AS payment_amount FROM tbl_receive_payment WHERE cheque_date>'".$todayDateMysql."' ".$paymentpartyBsql."";
	$totalfuturecheques=$db->record_total($sqlfuturecheques);
	$sqlfuturechequesQ=$db->record_select($sqlfuturecheques);
	
	// to get total royalty from payments
	$final_total_royalty_on_payment=0;
	$sqlgetroyalty="SELECT sum(payment_amount) as payment_amount, client.partyb_id, partyb.royalty_id, tbl_royalty.royalty_percent, sum(payment_amount)* tbl_royalty.royalty_percent/100 as individual_sum FROM tbl_invoice, tbl_receive_payment, tbl_users as client, tbl_users as partyb, tbl_royalty WHERE tbl_invoice.invoice_id=tbl_receive_payment.invoice_id AND tbl_receive_payment.client_id=client.log_id AND client.partyb_id=partyb.log_id AND partyb.royalty_id=tbl_royalty.royalty_id AND (tbl_receive_payment.payment_date BETWEEN '".$fromdate."' AND '".$todate."') ".$paymentpartyBsql." GROUP BY tbl_receive_payment.client_id";
	$sqlgetroyaltyQ=$db->record_select($sqlgetroyalty);
	foreach($sqlgetroyaltyQ as $sqlgetroyaltyD)
	{
		$final_total_royalty_on_payment+=$sqlgetroyaltyD['individual_sum'];
	}
	
	//$sqlgetinvoicesroyalty="SELECT sum(invoice_total) as invoice_total, client.partyb_id, partyb.royalty_id, tbl_royalty.royalty_percent, sum(invoice_total)* tbl_royalty.royalty_percent/100 as individual_sum FROM tbl_invoice, tbl_users as client, tbl_users as partyb, tbl_royalty WHERE tbl_invoice.client_id=client.log_id AND client.partyb_id=partyb.log_id AND partyb.royalty_id=tbl_royalty.royalty_id GROUP BY tbl_invoice.client_id";
	
	$total_invoice_revenue=$sqlinvoicesamountQ[0]['invoice_total'];
	$total_payment_amount=$sqlpaymentsamountQ[0]['payment_amount'];
	$total_voucher_amount=$sqlvoucherssamountQ[0]['voucher_amount'];
	$total_today_pending_cheques=$sqltodaychequesQ[0]['payment_amount'];
	$total_future_pending_cheques=$sqlfuturechequesQ[0]['payment_amount'];
	$total_pending_payments=$total_invoice_revenue-$total_payment_amount;
	$total_pending_vouchers=$total_payment_amount-$total_voucher_amount;
	
	?>
	<!-- /.row -->
	<!-- ============================================================== -->
	<!-- Different data widgets -->
	<!-- ============================================================== -->
	<!--<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div class="row row-in">
				asd
				</div>
			</div>
		</div>
	</div>  --> 
	<form method="post" action=""> 
		<input type="hidden" name="formfilter" value="1" />
		<div class="row">
			<div class="col-sm-12">
				<div class="white-box">
					<div class="row">
						<div class="col-lg-3">
							<div class="example">
								<h5 class="box-title">From Date</h5>
								<input type="text" class="form-control datepicker-autoclose" name="fromdate" placeholder="mm/dd/yyyy" value="<?php echo $fromdateC;?>" /> </div>
						</div>
						<div class="col-lg-3">
							<div class="example">
								<h5 class="box-title">To Date</h5>
								<input type="text" class="form-control datepicker-autoclose" name="todate" placeholder="mm/dd/yyyy" value="<?php echo $todateC;?>" /> </div>
						</div>
						<div class="col-lg-3">
							<div class="example">
								<h5 class="box-title"><?php echo $in_party_B_name;?></h5>
									<select class="form-control select2" name="partyb_id" id="partyb_id">
										<option value="">Select <?php echo $in_party_B_name;?></option>
										<?php
										$sqlpartyb="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.typ_id=3";
										$sqlpartybQ=$db->record_select($sqlpartyb);
										foreach($sqlpartybQ as $sqlpartybD)
										{
										?> 
										<option value="<?php echo $sqlpartybD['log_id'];?>" <?php if($partyb_id==$sqlpartybD['log_id']) echo 'selected';?>><?php echo $sqlpartybD['log_name'];?></option>
										<?php }?>
									</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="example">
								<h5 class="box-title">&nbsp;</h5>
								<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Filter Results</button>    
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div class="row row-in">
					<div class="col-lg-3 col-sm-6 row-in-br divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-dribbble"><i class="icon-emotsmile"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalInvoices;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;"><!--Invoices-->
								<h4>Revenue Incld Tax(<?php echo $totalInvoices;?>)<br /><?php echo $currency;?> <?php echo number_format($total_invoice_revenue,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-dribbble" role="progressbar" aria-valuenow="<?php echo $totalInvoices;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalInvoices;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalInvoices;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
                    <div class="col-lg-3 col-sm-6 row-in-br divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-instagram"><i class="ti-clipboard"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalInvoices;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;"><!--Invoices-->
								<h4>Pending Voucher   <br /><?php echo $currency;?> <?php echo number_format($total_pending_vouchers,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-instagram" role="progressbar" aria-valuenow="<?php echo $totalInvoices;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalInvoices;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalInvoices;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
                    <div class="col-lg-3 col-sm-6 row-in-br  b-r-none divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md bg-info"><i class="icon-wallet"></i></span>
							</li>
							<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalPayments;?></h3>
							</li>
							<li class="col-middle">
								<h4>Payments<br /><?php echo $currency;?> <?php echo number_format($total_payment_amount,2);?></h4>
								<div class="progress">
									<div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo $totalPayments;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalPayments;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalPayments;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
                    <div class="col-lg-3 col-sm-6 row-in-br  b-r-none divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-dribbble"><i class="fa fa-database"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalPayments;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;">
								<a href="javascript:;" data-toggle="modal" data-target="#ModalTodayCheques">
								<h4>Today pending cheque<br /><?php echo $currency;?> <?php echo number_format($total_today_pending_cheques,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-dribbble" role="progressbar" aria-valuenow="<?php echo $totalPayments;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalPayments;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalPayments;?></span>
									</div>
								</div>
								</a>
								<div id="ModalTodayCheques" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
												<h4 class="modal-title" id="myModalLabel">Today Pending Cheques</h4> </div>
													<div class="modal-body">
														 <div class="row">
															<div class="col-md-12">
																
																
																
																
							<table id="demo-foo-pagination" class="table m-b-0 toggle-arrow-tiny" data-filter="#filter" data-filter-minimum="2" data-page-size="5">
									<thead>
										<tr>
											<th data-toggle="true"> #</th>
											<th data-toggle="true"> <?php echo $in_party_B_name;?></th>
											<th data-hide="phone"> Client </th>
											<th data-hide="phone"> Invoice #</th>
											<th data-hide="phone"> Cheque Date </th>
											<th data-hide="phone"> Bank name </th>
											<th data-hide="phone"> Cheque Number </th>
											<th data-hide="phone"> Amount </th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										$sqlevents="SELECT tbl_receive_payment.*, tbl_invoice.invoice_no, tbl_invoice.invoice_total, tbllogin.log_name, tbl_bank.bank_name FROM tbl_receive_payment, tbl_invoice, tbllogin, tbl_bank WHERE tbl_receive_payment.invoice_id=tbl_invoice.invoice_id AND tbllogin.log_id=tbl_receive_payment.log_id AND tbl_receive_payment.bank_id=tbl_bank.bank_id AND tbl_receive_payment.cheque_date='$todayDate' ORDER BY tbl_receive_payment.payment_id";
										$sqleventsQ=$db->record_select($sqlevents);
										foreach($sqleventsQ as $sqleventsD)
										{
											if($sqleventsD['payment_sts']=='A')
												$menuStatus='<span class="label label-table label-success">Active</span>';
											else
												$menuStatus='<span class="label label-table label-danger">In-Active</span>';
											
											// to get Client
											$sqlcleint="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=".$sqleventsD['client_id'];
											$sqlcleintQ=$db->record_select($sqlcleint);
											$currentPartyB=$sqlcleintQ[0]['partyb_id'];
											//$clientName=$sqlcleintQ[0]['user_first_name'];
											
											// to get registered by
											$sqlpartyB="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=".$currentPartyB;
											$sqlpartyBQ=$db->record_select($sqlpartyB);
											
											// to ensure that payment is editable or not , if it has voucher then not editable
											$sqlpaymentedit="SELECT * FROM tbl_voucher WHERE payment_id=".$sqleventsD['payment_id'];
											$ttlvoucher=$db->record_total($sqlpaymentedit);
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $sqlpartyBQ[0]['log_name'];?></td>
											<td><?php echo $sqlcleintQ[0]['log_name'];?></td>
											<td><?php echo $sqleventsD['invoice_no'];?></td>
											<td><?php echo date($dateformat,strtotime($sqleventsD['cheque_date']));?></td>
											<td><?php echo $sqleventsD['bank_name'];?></td>
											<td><?php echo $sqleventsD['cheque_no'];?></td>
											<td><?php echo $sqleventsD['payment_amount'];?></td>
										</tr>
									   <?php $i++;}?>
									</tbody>
								</table>
																
																
																
															</div>
														 </div>
														 
														 
													</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
											</div>
										</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
			</li>
						</ul>
					</div>
                    
                    
					
					
					
					
				</div>
				
				<div class="row row-in">
                	<div class="col-lg-3 col-sm-6 row-in-br divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md bg-danger"><i class="fa fa-briefcase"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalInvoices;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;"><!--Invoices-->
								<h4>Total Payable Tax  <br /><?php echo $currency;?> <?php echo number_format($sqltaxsumamountQ[0]['invoice_gst'],2);?></h4>
								<div class="progress">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $totalInvoices;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalInvoices;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalInvoices;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
                    <div class="col-lg-3 col-sm-6 row-in-br b-0 divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-youtube"><i class="ti-wallet"></i></span>
							</li>
							<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalVouchers;?></h3>
							</li>
							<li class="col-middle">
								<h4>Vouchers<br /><?php echo $currency;?> <?php echo number_format($total_voucher_amount,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-youtube" role="progressbar" aria-valuenow="<?php echo $totalVouchers;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalVouchers;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalVouchers;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="col-lg-3 col-sm-6 row-in-br divPadding10px">
	
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-primary"><i class="fa fa-lightbulb-o"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalAccounts;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;">
								<h4>Pending payment <br /><?php echo $currency;?> <?php echo number_format($total_pending_payments,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-primary" role="progressbar" aria-valuenow="<?php echo $totalAccounts;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalAccounts;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalAccounts;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
					
					
					<div class="col-lg-3 col-sm-6 row-in-br b-0 divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md bg-success"><i class="fa fa-credit-card-alt"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalVouchers;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;">
                            	<a href="javascript:;" data-toggle="modal" data-target="#ModalFutureCheques">
								<h4>Future pending cheque<br /><?php echo $currency;?> <?php echo number_format($total_future_pending_cheques,2);?></h4>
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?php echo $totalVouchers;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalVouchers;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalVouchers;?></span>
									</div>
								</div>
                                </a>
                                <div id="ModalFutureCheques" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
												<h4 class="modal-title" id="myModalLabel">Future Pending Cheques</h4> </div>
													<div class="modal-body">
														 <div class="row">
															<div class="col-md-12">
																
																
																
																
							<table id="demo-foo-pagination" class="table m-b-0 toggle-arrow-tiny" data-filter="#filter" data-filter-minimum="2" data-page-size="5">
									<thead>
										<tr>
											<th data-toggle="true"> #</th>
											<th data-toggle="true"> <?php echo $in_party_B_name;?></th>
											<th data-hide="phone"> Client </th>
											<th data-hide="phone"> Invoice #</th>
											<th data-hide="phone"> Cheque Date </th>
											<th data-hide="phone"> Bank name </th>
											<th data-hide="phone"> Cheque Number </th>
											<th data-hide="phone"> Amount </th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										$sqlevents="SELECT tbl_receive_payment.*, tbl_invoice.invoice_no, tbl_invoice.invoice_total, tbllogin.log_name, tbl_bank.bank_name FROM tbl_receive_payment, tbl_invoice, tbllogin, tbl_bank WHERE tbl_receive_payment.invoice_id=tbl_invoice.invoice_id AND tbllogin.log_id=tbl_receive_payment.log_id AND tbl_receive_payment.bank_id=tbl_bank.bank_id AND tbl_receive_payment.cheque_date>'".$todayDate."' ".$paymentpartyBsql." ORDER BY tbl_receive_payment.payment_id";
										$sqleventsQ=$db->record_select($sqlevents);
										foreach($sqleventsQ as $sqleventsD)
										{
											if($sqleventsD['payment_sts']=='A')
												$menuStatus='<span class="label label-table label-success">Active</span>';
											else
												$menuStatus='<span class="label label-table label-danger">In-Active</span>';
											
											// to get Client
											$sqlcleint="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=".$sqleventsD['client_id'];
											$sqlcleintQ=$db->record_select($sqlcleint);
											$currentPartyB=$sqlcleintQ[0]['partyb_id'];
											//$clientName=$sqlcleintQ[0]['user_first_name'];
											
											// to get registered by
											$sqlpartyB="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=".$currentPartyB;
											$sqlpartyBQ=$db->record_select($sqlpartyB);
											
											// to ensure that payment is editable or not , if it has voucher then not editable
											$sqlpaymentedit="SELECT * FROM tbl_voucher WHERE payment_id=".$sqleventsD['payment_id'];
											$ttlvoucher=$db->record_total($sqlpaymentedit);
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $sqlpartyBQ[0]['log_name'];?></td>
											<td><?php echo $sqlcleintQ[0]['log_name'];?></td>
											<td><?php echo $sqleventsD['invoice_no'];?></td>
											<td><?php echo date($dateformat,strtotime($sqleventsD['cheque_date']));?></td>
											<td><?php echo $sqleventsD['bank_name'];?></td>
											<td><?php echo $sqleventsD['cheque_no'];?></td>
											<td><?php echo $sqleventsD['payment_amount'];?></td>
										</tr>
									   <?php $i++;}?>
									</tbody>
								</table>
																
																
																
															</div>
														 </div>
														 
														 
													</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
											</div>
										</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
							</li>
						</ul>
					</div>
					
				</div>
				
				
				<div class="row row-in">
					<div class="col-lg-3 col-sm-6 row-in-br divPadding10px">
	
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-linkedin"><i class="fa fa-money"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalAccounts;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;">
								<h4><span id="royaltyText">Payment Royalty</span> <br /><?php echo $currency;?> <span id="royaltyAmount"><?php echo number_format($final_total_royalty_on_payment,2);?></span><a href="javascript:;" class="royaltybtn" id="royaltyId" rel="<?php echo $fromdateC."-".$todateC."-".$partyb_id;?>" abc="0">Invoice Royalty</a></h4>
								<div class="progress">
									<div class="progress-bar btn-linkedin" role="progressbar" aria-valuenow="<?php echo $totalAccounts;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalAccounts;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalAccounts;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
					
				</div>
				
				
				
				
				
				
			</div>
		</div>
	</div>
	 <!--row -->
	 <div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<h3 class="box-title">Last Week Progress chart</h3>
                <div style="width:100%;"><span style="background:#FF7676;"> &nbsp;  &nbsp;  &nbsp; </span> &nbsp; Invoices &nbsp; &nbsp; &nbsp; <span style="background:#2CABE3;"> &nbsp;  &nbsp;  &nbsp; </span> &nbsp; Payments &nbsp; &nbsp; &nbsp; <span style="background:#53E69D;"> &nbsp;  &nbsp;  &nbsp; </span> &nbsp; Vouchers </div>
				<div>
					<canvas id="chart2" height="100"></canvas>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<script>
	var ctx2 = document.getElementById("chart2").getContext("2d");
		var data2 = {
			labels: [<?php foreach($pastDaysChart as $pastDaysChartD){ echo '"'.date("D",strtotime($pastDaysChartD)).' '.date("d/m/Y",strtotime($pastDaysChartD)).'",';}?>],
			datasets: [
				{
					label: "INVOICES",
					fillColor: "rgba(255,118,118,0.8)",
					strokeColor: "rgba(255,118,118,0.8)",
					highlightFill: "rgba(255,118,118,1)",
					highlightStroke: "rgba(255,118,118,1)",
					data: [<?php foreach($pastDaysChart as $pastDaysChartD){$sqlcInvoices="SELECT * FROM tbl_invoice WHERE invoice_date='".$pastDaysChartD."'";$totalcinvoices=$db->record_total($sqlcInvoices);echo '"'.$totalcinvoices.'",'; }?>]
				},
				{
					label: "B",
					fillColor: "rgba(44,171,227,0.8)",
					strokeColor: "rgba(44,171,227,0.8)",
					highlightFill: "rgba(44,171,227,1)",
					highlightStroke: "rgba(44,171,227,1)",
					data: [<?php foreach($pastDaysChart as $pastDaysChartD){$sqlcPayment="SELECT * FROM tbl_receive_payment WHERE payment_date='".$pastDaysChartD."'";$totalcpayment=$db->record_total($sqlcPayment);echo '"'.$totalcpayment.'",'; }?>]
				},
				{
					label: "C",
					fillColor: "rgba(83,230,157,0.8)",
					strokeColor: "rgba(83,230,157,0.8)",
					highlightFill: "rgba(83,230,157,1)",
					highlightStroke: "rgba(83,230,157,1)",
					data: [<?php foreach($pastDaysChart as $pastDaysChartD){$sqlcVouchers="SELECT * FROM tbl_voucher WHERE voucher_date='".$pastDaysChartD."'";$totalcvouchers=$db->record_total($sqlcVouchers);echo '"'.$totalcvouchers.'",'; }?>]
				},
			]
		};
		
		var chart2 = new Chart(ctx2).Bar(data2, {
			scaleBeginAtZero : true,
			scaleShowGridLines : true,
			scaleGridLineColor : "rgba(0,0,0,.005)",
			scaleGridLineWidth : 0,
			scaleShowHorizontalLines: true,
			scaleShowVerticalLines: true,
			barShowStroke : true,
			barStrokeWidth : 0,
			tooltipCornerRadius: 2,
			barDatasetSpacing : 3,
			legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
			responsive: true
		});
		
		
		
	$(document).on("click","#royaltyId",function(){
	// 0 means invoice & 1 means payment
	
		var abc=$(this).attr("abc");
		var reldates=$(this).attr("rel");
		$.ajax({
			type: "POST",
			url: 'get_dashboard_royalty.php',
			data: { abc:abc,reldates:reldates } //send data if needed=
		})
		.done(function(data){
			var resultArray 	= jQuery.parseJSON(data);
			var finalPrice=resultArray['final_total_royalty_on_payment'];
			$("#royaltyAmount").html(finalPrice);
			if(abc==0)
			{
				$("#royaltyText").html("Invoice Royalty");
				$("#royaltyId").html("Payment Royalty");
				$("#royaltyId").attr("abc","1");
			}
			else
			{
				$("#royaltyText").html("Payment Royalty");
				$("#royaltyId").html("Invoice Royalty");
				$("#royaltyId").attr("abc","0");
			}
			
		});
	
	});	
	
	$(".select2").select2();
	jQuery('.datepicker-autoclose').datepicker({
			autoclose: true,
			todayHighlight: true
		});
	</script>
	<!-- ============================================================== -->
	<!-- end right sidebar -->
	<!-- ============================================================== -->
<?php 
}
elseif($session_utype==3)
{
	
	if(isset($_POST['formfilter']))
	{
		/*$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];*/
		$fromdate=date("Y-m-d",strtotime($_POST['fromdate']));
		$todate=date("Y-m-d",strtotime($_POST['todate']));
		$fromdateC=$_POST['fromdate'];
		$todateC=$_POST['todate'];
		
		
		$client_id=$_POST['client_id'];
		$partyb_id=$session_login_id;
		if($partyb_id!="")
		{
			$partyBsql=' AND partyb_id='.$partyb_id.'';
			$voucherpartyBsql=' AND tbl_voucher.partyb_id='.$partyb_id.'';
			$paymentpartyBsql=' AND tbl_receive_payment.partyb_id='.$partyb_id.'';
		}
		
		if($client_id!="")
		{
			$Clientsql='  AND client_id='.$client_id.'';
			$voucherClientsql=' AND tbl_voucher.client_id='.$client_id.'';
			$paymentClientsql=' AND tbl_receive_payment.client_id='.$client_id.'';
		}
	}
	else
	{
		$partyb_id=$session_login_id;
		if($partyb_id!="")
		{
			$partyBsql=' AND partyb_id='.$partyb_id.'';
			$voucherpartyBsql=' AND tbl_voucher.partyb_id='.$partyb_id.'';
			$paymentpartyBsql=' AND tbl_receive_payment.partyb_id='.$partyb_id.'';
		}
		/*$fromdate=date("m/01/Y");
		$todate=date("m/d/Y");*/
		$fromdate=date("Y-01-01");//$fromdate=date("Y-m-01"); $fromdate=date("Y-m-d",strtotime("-1 year"));
		$todate=date("Y-m-d");
		$fromdateC=date("01/01/Y");
		$todateC=date("m/d/Y");
	}
	// to get all invoices
	$sqlinvoices="SELECT * FROM tbl_invoice WHERE invoice_sts=1 ".$Clientsql." AND (invoice_date BETWEEN '$fromdate' AND '$todate') ".$partyBsql."";
	$totalInvoices=$db->record_total($sqlinvoices);
	// to get sum of all invoices
	$sqlinvoicesamount="SELECT sum(invoice_total) as invoice_total FROM tbl_invoice WHERE invoice_sts=1 ".$Clientsql." AND (invoice_date BETWEEN '$fromdate' AND '$todate') ".$partyBsql."";
	$sqlinvoicesamountQ=$db->record_select($sqlinvoicesamount);
	
	// to get sum of all credit notes
	$sqlinvoicescreditamount="SELECT sum(tbl_credit_note.credit_amount) as credit_amount FROM tbl_invoice, tbl_credit_note WHERE tbl_invoice.invoice_sts=1 AND tbl_invoice.invoice_id=tbl_credit_note.invoice_id ".$Clientsql." AND (tbl_invoice.invoice_date BETWEEN '$fromdate' AND '$todate') ".$partyBsql."";
	$sqlinvoicescreditamountQ=$db->record_select($sqlinvoicescreditamount);
	
	
	
	// to get tax sum of all invoices
	$sqltaxsumamount="SELECT sum(invoice_gst) as invoice_gst FROM tbl_invoice WHERE invoice_sts=1 ".$partyBsql." ".$Clientsql." AND (invoice_date BETWEEN '".$fromdate."' AND '".$todate."')";
	$sqltaxsumamountQ=$db->record_select($sqltaxsumamount);
	
	// to get all Received Payments
	$sqlpayments="SELECT * FROM tbl_receive_payment WHERE payment_sts=1 AND (payment_date BETWEEN '".$fromdate."' AND '".$todate."') ".$partyBsql."  ".$Clientsql."";
	$totalPayments=$db->record_total($sqlpayments);
	// to get som of all Received Payments
	$sqlpaymentsamount="SELECT sum(payment_amount) as payment_amount FROM tbl_receive_payment WHERE payment_sts=1 AND (payment_date BETWEEN '".$fromdate."' AND '".$todate."') ".$partyBsql." ".$Clientsql."";
	$sqlpaymentsamountQ=$db->record_select($sqlpaymentsamount);
	
	
	
	// to get all Vouchers
	$sqlvouchers="SELECT * FROM tbl_voucher, tbl_receive_payment WHERE tbl_voucher.payment_id=tbl_receive_payment.payment_id AND (tbl_voucher.voucher_date BETWEEN '".$fromdate."' AND '".$todate."') ".$voucherpartyBsql." ".$voucherClientsql."";
	$totalVouchers=$db->record_total($sqlvouchers);
	// to get sum of all Voucher Payments
	$sqlvoucherssamount="SELECT sum(tbl_receive_payment.payment_amount) as voucher_amount FROM tbl_voucher, tbl_receive_payment WHERE tbl_voucher.payment_id=tbl_receive_payment.payment_id AND tbl_receive_payment.payment_sts=1 AND (tbl_voucher.voucher_date BETWEEN '".$fromdate."' AND '".$todate."') ".$voucherpartyBsql." ".$voucherClientsql."";
	$sqlvoucherssamountQ=$db->record_select($sqlvoucherssamount);
	
	$pastDaysChart=$GeneralFunctions->get_past_date_arrays(date("m/d/Y"),"7","-","Y-m-d");
	
	// to get today cheques and amounts
	$sqltodaycheques="SELECT SUM(payment_amount) AS payment_amount FROM tbl_receive_payment WHERE cheque_date='".$todayDateMysql."' ".$partyBsql." ".$Clientsql."";
	$totaltodaycheques=$db->record_total($sqltodaycheques);
	$sqltodaychequesQ=$db->record_select($sqltodaycheques);
	
	// to get future cheques and amounts
	$sqlfuturecheques="SELECT SUM(payment_amount) AS payment_amount FROM tbl_receive_payment WHERE cheque_date>'".$todayDateMysql."' ".$partyBsql." ".$Clientsql."";
	$totalfuturecheques=$db->record_total($sqlfuturecheques);
	$sqlfuturechequesQ=$db->record_select($sqlfuturecheques);
	

	$total_invoice_wo_credit=$sqlinvoicesamountQ[0]['invoice_total'];
	$total_credit_amount_invoice=$sqlinvoicescreditamountQ[0]['credit_amount'];
	$total_invoice_revenue=$total_invoice_wo_credit-$total_credit_amount_invoice;
	
	$total_payment_amount=$sqlpaymentsamountQ[0]['payment_amount'];
	$total_voucher_amount=$sqlvoucherssamountQ[0]['voucher_amount'];
	$total_today_pending_cheques=$sqltodaychequesQ[0]['payment_amount'];
	$total_future_pending_cheques=$sqlfuturechequesQ[0]['payment_amount'];
	$total_pending_payments=$total_invoice_revenue-$total_payment_amount;
	$total_pending_vouchers=$total_payment_amount-$total_voucher_amount;
	
	
	// to get recieve payment
	$sqlpayback="SELECT * FROM tbl_final_invoice_payment, tbl_final_invoice_payment_detail WHERE tbl_final_invoice_payment.final_invoice_payment_id=tbl_final_invoice_payment_detail.final_invoice_payment_id AND tbl_final_invoice_payment.partyb_id=$session_login_id";
	$sqldetailQ=$db->record_select($sqlpayback);
	foreach($sqldetailQ as $sqldetailD)
	{
	
		$sqlpayment="SELECT * FROM  tbl_receive_payment WHERE payment_id=".$sqldetailD['payment_id'];
		$sqlpaymentQ=$db->record_select($sqlpayment);
		
		$sqlpartyB="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=".$sqlpaymentQ[0]['partyb_id'];
		$sqlpartyBQ=$db->record_select($sqlpartyB);
		
		$sqlinvoice="SELECT * FROM  tbl_invoice WHERE invoice_id=".$sqldetailD['invoice_id'];
		$sqlinvoiceQ=$db->record_select($sqlinvoice);
		
		$sqlroyalty="SELECT * FROM  tbl_royalty WHERE royalty_id=".$sqlpartyBQ[0]['royalty_id'];
		$sqlroyaltyQ=$db->record_select($sqlroyalty);
		$royalty_percent=$sqlroyaltyQ[0]['royalty_percent'];
	
		// to get total tax, amount 
		$sqlamounttax="SELECT SUM(gst_amount) as totalgst, SUM(amount) as totalamount FROM tbl_invoice_detail WHERE invoice_id=".$sqldetailD['invoice_id'];
		$sqlamounttaxQ=$db->record_select($sqlamounttax);
		
		//$totalamount=$sqlamounttaxQ[0]['totalamount'];
		
		$totalpaymentamount=$sqlpaymentQ[0]['payment_amount'];
		$totalroyaltyamount=$totalpaymentamount*$royalty_percent/100;
		
		$totalgst_invoice=$sqlamounttaxQ[0]['totalgst'];
		$invoice_total_amount=$sqlinvoiceQ[0]['invoice_total'];
		$payment_total_percent=round($totalpaymentamount*100/$invoice_total_amount,2);
		$new_payable_tax=round(($totalgst_invoice*$payment_total_percent/100),2);
													
		$finalAmount=$totalpaymentamount-$totalroyaltyamount-$new_payable_tax;
		$ttlpriceParback=$ttlpriceParback+$finalAmount;
		}
	?>
	<!-- /.row -->
	<!-- ============================================================== -->
	<!-- Different data widgets -->
	<!-- ============================================================== -->
	<!--<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div class="row row-in">
				asd
				</div>
			</div>
		</div>
	</div>  --> 
	<form method="post" action=""> 
		<input type="hidden" name="formfilter" value="1" />
		<div class="row">
			<div class="col-sm-12">
				<div class="white-box">
					<div class="row">
						<div class="col-lg-3">
							<div class="example">
								<h5 class="box-title">From Date</h5>
								<input type="text" class="form-control datepicker-autoclose" name="fromdate" placeholder="mm/dd/yyyy" value="<?php echo $fromdateC;?>" /> </div>
						</div>
						<div class="col-lg-3">
							<div class="example">
								<h5 class="box-title">To Date</h5>
								<input type="text" class="form-control datepicker-autoclose" name="todate" placeholder="mm/dd/yyyy" value="<?php echo $todateC;?>" /> </div>
						</div>
						<div class="col-lg-3">
							<div class="example">
								<h5 class="box-title">Clients</h5>
									<select class="form-control select2" name="client_id" id="client_id">
										<option value="">Select Clients</option>
										<?php
										$sqlpartyb="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.typ_id=4 AND tbl_users.partyb_id=$session_login_id";
										$sqlpartybQ=$db->record_select($sqlpartyb);
										foreach($sqlpartybQ as $sqlpartybD)
										{
										?> 
										<option value="<?php echo $sqlpartybD['log_id'];?>" <?php if($client_id==$sqlpartybD['log_id']) echo 'selected';?>><?php echo $sqlpartybD['log_name'];?></option>
										<?php }?>
									</select>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="example">
								<h5 class="box-title">&nbsp;</h5>
								<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Filter Results</button>    
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div class="row row-in">
					<div class="col-lg-3 col-sm-6 row-in-br divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-dribbble"><i class="icon-emotsmile"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalInvoices;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;"><!--Invoices-->
								<h4>Revenue Incld Tax <b>(<?php echo $totalInvoices;?>)</b><br /><?php echo $currency;?> <?php echo number_format($total_invoice_revenue,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-dribbble" role="progressbar" aria-valuenow="<?php echo $totalInvoices;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalInvoices;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalInvoices;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
                   <div class="col-lg-3 col-sm-6 row-in-br  b-r-none divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md bg-info"><i class="icon-wallet"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalPayments;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;">
								<h4>Received Payment <b>(<?php echo $totalPayments;?>)</b><br /><?php echo $currency;?> <?php echo number_format($total_payment_amount,2);?></h4>
								<div class="progress">
									<div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo $totalPayments;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalPayments;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalPayments;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
                    <div class="col-lg-3 col-sm-6 row-in-br divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-instagram"><i class="ti-clipboard"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalInvoices;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;"><!--Invoices-->
								<h4>Pending Voucher   <br /><?php echo $currency;?> <?php echo number_format($total_pending_vouchers,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-instagram" role="progressbar" aria-valuenow="<?php echo $totalInvoices;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalInvoices;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalInvoices;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
                    
                    <div class="col-lg-3 col-sm-6 row-in-br  b-r-none divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-dribbble"><i class="fa fa-database"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalPayments;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;">
								<a href="javascript:;" data-toggle="modal" data-target="#ModalTodayCheques">
								<h4>Today Pending Cheque<br /><?php echo $currency;?> <?php echo number_format($total_today_pending_cheques,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-dribbble" role="progressbar" aria-valuenow="<?php echo $totalPayments;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalPayments;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalPayments;?></span>
									</div>
								</div>
								</a>
								<div id="ModalTodayCheques" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
												<h4 class="modal-title" id="myModalLabel">Today Pending Cheques</h4> </div>
													<div class="modal-body">
														 <div class="row">
															<div class="col-md-12">
																
																
																
																
							<table id="demo-foo-pagination" class="table m-b-0 toggle-arrow-tiny" data-filter="#filter" data-filter-minimum="2" data-page-size="5">
									<thead>
										<tr>
											<th data-toggle="true"> #</th>
											<th data-hide="phone"> Client </th>
											<th data-hide="phone"> Invoice #</th>
											<th data-hide="phone"> Cheque Date </th>
											<th data-hide="phone"> Bank name </th>
											<th data-hide="phone"> Cheque Number </th>
											<th data-hide="phone"> Amount </th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										$sqlevents="SELECT tbl_receive_payment.*, tbl_invoice.invoice_no, tbl_invoice.invoice_total, tbllogin.log_name, tbl_bank.bank_name FROM tbl_receive_payment, tbl_invoice, tbllogin, tbl_bank WHERE tbl_receive_payment.invoice_id=tbl_invoice.invoice_id AND tbllogin.log_id=tbl_receive_payment.log_id AND tbl_receive_payment.bank_id=tbl_bank.bank_id AND tbl_receive_payment.cheque_date='".$todayDateMysql."' ".$paymentClientsql." ".$paymentpartyBsql." ORDER BY tbl_receive_payment.payment_id";
										$sqleventsQ=$db->record_select($sqlevents);
										foreach($sqleventsQ as $sqleventsD)
										{
											if($sqleventsD['payment_sts']=='A')
												$menuStatus='<span class="label label-table label-success">Active</span>';
											else
												$menuStatus='<span class="label label-table label-danger">In-Active</span>';
											
											// to get Client
											$sqlcleint="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=".$sqleventsD['client_id'];
											$sqlcleintQ=$db->record_select($sqlcleint);
											$currentPartyB=$sqlcleintQ[0]['partyb_id'];
											//$clientName=$sqlcleintQ[0]['user_first_name'];
											
											// to get registered by
											$sqlpartyB="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=".$currentPartyB;
											$sqlpartyBQ=$db->record_select($sqlpartyB);
											
											// to ensure that payment is editable or not , if it has voucher then not editable
											$sqlpaymentedit="SELECT * FROM tbl_voucher WHERE payment_id=".$sqleventsD['payment_id'];
											$ttlvoucher=$db->record_total($sqlpaymentedit);
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $sqlcleintQ[0]['log_name'];?></td>
											<td><?php echo $sqleventsD['invoice_no'];?></td>
											<td><?php echo date($dateformat,strtotime($sqleventsD['cheque_date']));?></td>
											<td><?php echo $sqleventsD['bank_name'];?></td>
											<td><?php echo $sqleventsD['cheque_no'];?></td>
											<td><?php echo $sqleventsD['payment_amount'];?></td>
										</tr>
									   <?php $i++;}?>
									</tbody>
								</table>
																
																
																
															</div>
														 </div>
														 
														 
													</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
											</div>
										</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
			</li>
						</ul>
					</div>
                    
				</div>
				
				<div class="row row-in">
                	<div class="col-lg-3 col-sm-6 row-in-br divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md bg-danger"><i class="fa fa-briefcase"></i></span>
							</li>
							<li class="col-middle" style="width:69%;"><!--Invoices-->
								<h4>Pay Back From HQ  <br /><?php echo $currency;?> <?php echo number_format($ttlpriceParback,2);?></h4>
								<div class="progress">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $ttlpriceParback;?>" aria-valuemin="0" aria-valuemax="<?php echo $ttlpriceParback;?>" style="width: 100%">
										<span class="sr-only">-</span>
									</div>
								</div>
							</li>
						</ul>
					</div>
                	
                    <div class="col-lg-3 col-sm-6 row-in-br divPadding10px">
	
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-primary"><i class="fa fa-lightbulb-o"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalAccounts;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;">
								<h4>Pending Payment <br /><?php echo $currency;?> <?php echo number_format($total_pending_payments,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-primary" role="progressbar" aria-valuenow="<?php echo $totalAccounts;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalAccounts;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalAccounts;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
                    <div class="col-lg-3 col-sm-6 row-in-br b-0 divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md btn-youtube"><i class="ti-wallet"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalVouchers;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;">
								<h4>Voucher To HQ <b>(<?php echo $totalVouchers;?>)</b><br /><?php echo $currency;?> <?php echo number_format($total_voucher_amount,2);?></h4>
								<div class="progress">
									<div class="progress-bar btn-youtube" role="progressbar" aria-valuenow="<?php echo $totalVouchers;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalVouchers;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalVouchers;?></span>
									</div>
								</div>
							</li>
						</ul>
					</div>
					
					
					
					<div class="col-lg-3 col-sm-6 row-in-br b-0 divPadding10px">
						<ul class="col-in">
							<li>
								<span class="circle circle-md bg-success"><i class="fa fa-credit-card-alt"></i></span>
							</li>
							<!--<li class="col-last">
								<h3 class="counter text-right m-t-15"><?php echo $totalVouchers;?></h3>
							</li>-->
							<li class="col-middle" style="width:69%;">
								<a href="javascript:;" data-toggle="modal" data-target="#ModalFutureCheques">
                                <h4>Future Pending Cheque<br /><?php echo $currency;?> <?php echo number_format($total_future_pending_cheques,2);?></h4>
								<div class="progress">
									<div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?php echo $totalVouchers;?>" aria-valuemin="0" aria-valuemax="<?php echo $totalVouchers;?>" style="width: 100%">
										<span class="sr-only"><?php echo $totalVouchers;?></span>
									</div>
								</div>
                                </a>
                                <div id="ModalFutureCheques" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
												<h4 class="modal-title" id="myModalLabel">Future Pending Cheques</h4> </div>
													<div class="modal-body">
														 <div class="row">
															<div class="col-md-12">
																
																
																
																
							<table id="demo-foo-pagination" class="table m-b-0 toggle-arrow-tiny" data-filter="#filter" data-filter-minimum="2" data-page-size="5">
									<thead>
										<tr>
											<th data-toggle="true"> #</th>
											<th data-hide="phone"> Client </th>
											<th data-hide="phone"> Invoice #</th>
											<th data-hide="phone"> Cheque Date </th>
											<th data-hide="phone"> Bank name </th>
											<th data-hide="phone"> Cheque Number </th>
											<th data-hide="phone"> Amount </th>
										</tr>
									</thead>
									<tbody>
										<?php
										
										$i=1;
										$sqlevents="SELECT tbl_receive_payment.*, tbl_invoice.invoice_no, tbl_invoice.invoice_total, tbllogin.log_name, tbl_bank.bank_name FROM tbl_receive_payment, tbl_invoice, tbllogin, tbl_bank WHERE tbl_receive_payment.invoice_id=tbl_invoice.invoice_id AND tbllogin.log_id=tbl_receive_payment.log_id AND tbl_receive_payment.bank_id=tbl_bank.bank_id AND tbl_receive_payment.cheque_date>'".$todayDateMysql."' ".$paymentClientsql." ".$paymentpartyBsql." ORDER BY tbl_receive_payment.payment_id";
										$sqleventsQ=$db->record_select($sqlevents);
										foreach($sqleventsQ as $sqleventsD)
										{
											if($sqleventsD['payment_sts']=='A')
												$menuStatus='<span class="label label-table label-success">Active</span>';
											else
												$menuStatus='<span class="label label-table label-danger">In-Active</span>';
											
											// to get Client
											$sqlcleint="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=".$sqleventsD['client_id'];
											$sqlcleintQ=$db->record_select($sqlcleint);
											$currentPartyB=$sqlcleintQ[0]['partyb_id'];
											//$clientName=$sqlcleintQ[0]['user_first_name'];
											
											// to get registered by
											$sqlpartyB="SELECT * FROM tbllogin, tbl_users WHERE tbllogin.log_id=tbl_users.log_id AND tbllogin.log_id=".$currentPartyB;
											$sqlpartyBQ=$db->record_select($sqlpartyB);
											
											// to ensure that payment is editable or not , if it has voucher then not editable
											$sqlpaymentedit="SELECT * FROM tbl_voucher WHERE payment_id=".$sqleventsD['payment_id'];
											$ttlvoucher=$db->record_total($sqlpaymentedit);
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $sqlcleintQ[0]['log_name'];?></td>
											<td><?php echo $sqleventsD['invoice_no'];?></td>
											<td><?php echo date($dateformat,strtotime($sqleventsD['cheque_date']));?></td>
											<td><?php echo $sqleventsD['bank_name'];?></td>
											<td><?php echo $sqleventsD['cheque_no'];?></td>
											<td><?php echo $sqleventsD['payment_amount'];?></td>
										</tr>
									   <?php $i++;}?>
									</tbody>
								</table>
																
																
																
															</div>
														 </div>
														 
														 
													</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
											</div>
										</div>
										<!-- /.modal-content -->
									</div>
									<!-- /.modal-dialog -->
								</div>
							</li>
						</ul>
					</div>
					
				</div>
				



				
			</div>
		</div>
	</div>
	 <!--row -->
	 <div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<h3 class="box-title">Last Week Progress chart</h3>
                <div style="width:100%;"><span style="background:#FF7676;"> &nbsp;  &nbsp;  &nbsp; </span> &nbsp; Invoices &nbsp; &nbsp; &nbsp; <span style="background:#2CABE3;"> &nbsp;  &nbsp;  &nbsp; </span> &nbsp; Payments &nbsp; &nbsp; &nbsp; <span style="background:#53E69D;"> &nbsp;  &nbsp;  &nbsp; </span> &nbsp; Vouchers </div>
				<div>
					<canvas id="chart2" height="100"></canvas>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->
	<script>
	var ctx2 = document.getElementById("chart2").getContext("2d");
		var data2 = {
			labels: [<?php foreach($pastDaysChart as $pastDaysChartD){ echo '"'.date("D",strtotime($pastDaysChartD)).' '.date("d/m/Y",strtotime($pastDaysChartD)).'",';}?>],
			datasets: [
				{
					label: "INVOICES",
					fillColor: "rgba(255,118,118,0.8)",
					strokeColor: "rgba(255,118,118,0.8)",
					highlightFill: "rgba(255,118,118,1)",
					highlightStroke: "rgba(255,118,118,1)",
					data: [<?php foreach($pastDaysChart as $pastDaysChartD){$sqlcInvoices="SELECT * FROM tbl_invoice WHERE invoice_date='".$pastDaysChartD."' AND partyb_id=$session_login_id";$totalcinvoices=$db->record_total($sqlcInvoices);echo '"'.$totalcinvoices.'",'; }?>]
				},
				{
					label: "B",
					fillColor: "rgba(44,171,227,0.8)",
					strokeColor: "rgba(44,171,227,0.8)",
					highlightFill: "rgba(44,171,227,1)",
					highlightStroke: "rgba(44,171,227,1)",
					data: [<?php foreach($pastDaysChart as $pastDaysChartD){$sqlcPayment="SELECT * FROM tbl_receive_payment WHERE payment_date='".$pastDaysChartD."' AND partyb_id=$session_login_id";$totalcpayment=$db->record_total($sqlcPayment);echo '"'.$totalcpayment.'",'; }?>]
				},
				{
					label: "C",
					fillColor: "rgba(83,230,157,0.8)",
					strokeColor: "rgba(83,230,157,0.8)",
					highlightFill: "rgba(83,230,157,1)",
					highlightStroke: "rgba(83,230,157,1)",
					data: [<?php foreach($pastDaysChart as $pastDaysChartD){$sqlcVouchers="SELECT * FROM tbl_voucher WHERE voucher_date='".$pastDaysChartD."' AND partyb_id=$session_login_id";$totalcvouchers=$db->record_total($sqlcVouchers);echo '"'.$totalcvouchers.'",'; }?>]
				},
			]
		};
		
		var chart2 = new Chart(ctx2).Bar(data2, {
			scaleBeginAtZero : true,
			scaleShowGridLines : true,
			scaleGridLineColor : "rgba(0,0,0,.005)",
			scaleGridLineWidth : 0,
			scaleShowHorizontalLines: true,
			scaleShowVerticalLines: true,
			barShowStroke : true,
			barStrokeWidth : 0,
			tooltipCornerRadius: 2,
			barDatasetSpacing : 3,
			legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
			responsive: true
		});
		
		
		
	$(document).on("click","#royaltyId",function(){
	// 0 means invoice & 1 means payment
	
		var abc=$(this).attr("abc");
		var reldates=$(this).attr("rel");
		$.ajax({
			type: "POST",
			url: 'get_dashboard_royalty.php',
			data: { abc:abc,reldates:reldates } //send data if needed=
		})
		.done(function(data){
			var resultArray 	= jQuery.parseJSON(data);
			var finalPrice=resultArray['final_total_royalty_on_payment'];
			$("#royaltyAmount").html(finalPrice);
			if(abc==0)
			{
				$("#royaltyText").html("Invoice Royalty");
				$("#royaltyId").html("Payment Royalty");
				$("#royaltyId").attr("abc","1");
			}
			else
			{
				$("#royaltyText").html("Payment Royalty");
				$("#royaltyId").html("Invoice Royalty");
				$("#royaltyId").attr("abc","0");
			}
			
		});
	
	});	
	
	$(".select2").select2();
	jQuery('.datepicker-autoclose').datepicker({
			autoclose: true,
			todayHighlight: true
		});
	</script>
	<!-- ============================================================== -->
	<!-- end right sidebar -->
	<!-- ============================================================== -->
<?php 
}
if($session_utype!=1 && $session_utype!=2)
{
	//echo $session_login_id;
	if($session_utype==3) // for Party B
	{
		$message_partyB_id=$session_login_id;
	}
	elseif($session_utype==5) // for Staff
	{
		$sqllogidforpartyb="SELECT partyb_id FROM tbl_users WHERE log_id=$session_login_id";
		$sqllogidforpartybQ=$db->record_select($sqllogidforpartyb);
		$message_partyB_id=$sqllogidforpartybQ[0]['partyb_id'];
	}
}

// to check the messsage and user's rights
$sqlmessagecheck="SELECT * FROM tbl_message, tbl_message_partyb WHERE tbl_message.message_id=tbl_message_partyb.message_id AND tbl_message_partyb.partyb_id=$message_partyB_id AND tbl_message.message_status=1 AND tbl_message_partyb.is_view=0 AND (from_date<='$todayDateMysql' AND to_date>='$todayDateMysql') ORDER BY message_order DESC";
$ttlsqlmessagecheck=$db->record_total($sqlmessagecheck);
if($ttlsqlmessagecheck>0)
{
$sqlmessagecheckQ=$db->record_select($sqlmessagecheck);
?>
<script>
$(window).on('load',function(){
        $('#myModal1').modal('show');
    });
</script>

<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form action="conf_accept_messages.php?chkp=<?php echo $_GET['chkp'];?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="message_partyb_id" value="<?php echo $sqlmessagecheckQ[0]['message_partyb_id'];?>" />
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $sqlmessagecheckQ[0]['message_title'];?></h4> </div>
                    <div class="modal-body">
                         <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo $sqlmessagecheckQ[0]['message_description'];?>
                                 </div>
                            </div>
                         </div>
                    </div>
            <div class="modal-footer">
            	<button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Accept this</button>
                <!--<button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>-->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</form>
</div>
<?php }?>
<script src="js/dashboard1.js"></script>
