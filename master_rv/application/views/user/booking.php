<?php include_once'widget.php'; ?>

<?php $hostid; ?>
<?php $from_date; ?>
<?php $m_id; ?>
<?php $to_date; ?>
<p>
	<?php 
		//$conv_t = strtotime($to_date)-strtotime($from_date);
		//echo date("Y-m-d", $conv_t)
		$date1=date_create($from_date);
		$date2=date_create($to_date);

		$diff=date_diff($date1,$date2);
		$total_day = $diff->format("%a");
		//echo $diff->format("%R%a days");
	?>
</p>
<div class="home-directory">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="innerWrapper clearfix stepsPage">

					<div class="col-xs-12 col-sm-8">
						<div class="payment_side">
							<h3>Confirm and pay</h3>
							<p>
								<?php 
									$query_m_id = $this->user_model->get_booking_user($m_id,'alluser');
									if ($query_m_id->num_rows()>0) {
										$query_row = $query_m_id->row();
										echo $query_row->fname.' '.$query_row->lname;
									}
								?>
							</p>
							<div class="panel panel-default">
								<div class="panel-body">
									<form  action="/your-charge-code" method="POST" id="payment-form" role="form">
										<legend>Payment method</legend>
										<span class="payment-errors"></span>
									
										<div class="form-group col-sm-12 col-xs-12">
											<label for="">Card number</label>
											<input type="hidden" id="hostid" value="<?php echo $hostid; ?>">
											<input type="hidden" id="m_id" value="<?php echo $m_id; ?>">
											<input type="hidden" id="from_date" value="<?php echo $from_date; ?>">
											<input type="hidden" id="to_date" value="<?php echo $to_date; ?>">

											<input type="text" size="20" id="card_number" class="form-control" data-stripe="number" required>
										</div>

										<div class="form-row form-group col-sm-4 col-xs-12">
											<label for="">Expiration (MM/YY)</label>
											<input type="text" size="2" class="form-control" id="ex_mm" data-stripe="exp_month" placeholder="MM" required>
										</div>
										<div class="form-row form-group col-sm-4 col-xs-12">
											<input type="text" size="2" class="form-control" id="ex_yy" style="margin-top: 32px" data-stripe="exp_year" placeholder="YY" required>
										</div>

										<div class="form-group col-sm-4 col-xs-12">
											<label for="">CVC</label>
											<input type="text" size="4" class="form-control" id="cvc" data-stripe="cvc" required>
										</div>

										<div class="form-group col-sm-6 col-xs-12">
											<label for="">Billing Zip</label>
											<input type="text" size="6" class="form-control" id="zip" data-stripe="address_zip" required>
										</div>
										<div class="form-group col-sm-12 col-xs-12">
											<input type="submit" class="submit btn btn-default" value="Confirm booking">
										</div>
										
									</form>
								</div>
							</div>
						</div>
					</div>

					<?php
						$query_hostid = $this->user_model->get_booking_user($hostid,'host');
						if ($query_hostid->num_rows()>0) {
							$query_host = $query_hostid->row(); //host all date

					?>

					<div class="col-xs-12 col-sm-4">
						<div class="summary_booking">
							<h3>Host information</h3>
							<p>
								<?php 

										$query_h_id = $this->user_model->get_booking_user($query_host->userid,'alluser');
										if ($query_h_id->num_rows()>0) {
											$query_host_user = $query_h_id->row();
											echo $query_host_user->fname.' '.$query_host_user->lname;
										}
								?>
							</p>
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="host_ingo_img">
										<?php
											$query_h_id_file = $this->user_model->get_booking_user_f($query_host->id,'files');
											if ($query_h_id_file->num_rows()>0) {
												$query_host_image = $query_h_id_file->row();
										?>
											<img class="img img-responsive" src="<?php echo base_url() ?>assets/images/hosts/<?php echo $query_host_image->file_name; ?>" alt="host images">
										<?php } ?>
									</div>
									<h4><?php echo $query_host->title; ?></h4>
									<ul class="list-group">
										<li class="list-group-item">Amount: <i class="fa fa-usd"></i><?php echo $query_host->amount; ?> x <?php echo $total_day; ?> = <i class="fa fa-usd"></i><?php echo $total_amount = $query_host->amount*$total_day; ?></li>
										<li class="list-group-item">Location: <?php echo $query_host->location; ?></li>
										<li class="list-group-item">RV Types: Up to <u><?php echo $query_host->rv_sizes; ?></u> feet long.</li>
										<li class="list-group-item">RV Sizes: <?php echo $query_host->rv_types; ?></li>
										<li class="list-group-item">Selected date: <?php echo $from_date; ?> to <?php echo $to_date; ?></li>
									</ul>
								</div>
							</div>
						</div>
						
					</div>
					<?php } ?>


                </div>
            </div>


        </div>
    </div>
</div>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
	Stripe.setPublishableKey('pk_test_rZS5BiZSG8vIpVyQAXACPAT8');
	$(function() {
	  var $form = $('#payment-form');
	  $form.submit(function(event) {
		// Disable the submit button to prevent repeated clicks:
		$form.find('.submit').prop('disabled', true);
		$form.find('.submit').val('Please wait...');

		// Request a token from Stripe:
		Stripe.card.createToken($form, stripeResponseHandler);
		// Prevent the form from being submitted:
		return false;
	  });
	});
	function stripeResponseHandler(status, response) {
		 
		 if (response.error) {
			alert(response.error.message);
		 } else {
		 	var hostid = $("#hostid").val().trim();
		 	var m_id = $("#m_id").val().trim();
		 	var from_date = $("#from_date").val().trim();
		 	var to_date = $("#to_date").val().trim();

		 	var card_number = $("#card_number").val().trim();
		 	var ex_mm = $("#ex_mm").val().trim();
		 	var ex_yy = $("#ex_yy").val().trim();
		 	var zip = $("#zip").val().trim();
		 	var cvc = $("#cvc").val().trim();

			$.ajax({
				url: '<?php echo base_url('payment/process');?>',
				data: {access_token: response.id,hostid:hostid,m_id:m_id,from_date:from_date,to_date:to_date,card_number:card_number,ex_mm:ex_mm,ex_yy:ex_yy,zip:zip,cvc:cvc},
				type: 'POST',
				dataType: 'JSON',
				success: function(response){
					console.log(response);
					if(response.success)
					window.location.href="<?php echo base_url('user/payment_overview'); ?>";
				},
				error: function(error){
					console.log(error);
				}
			});
			//console.log(response.id);
		}
	}
</script>