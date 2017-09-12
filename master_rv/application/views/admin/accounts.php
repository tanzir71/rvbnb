<div id="page-wrapper">
	<div class="container-fluid">
				
		<div class="row" style="margin-top: 20px">
				
				
			<div class="col-lg-12">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Accounts</h3>
					</div>
					
					<div class="panel-body">


							<div class="table-responsive">
									
								<table class="table table-striped table-bordered" style="margin-bottom: 30px;border:1px solid #ddd">
									<thead>
										<th width="50%">Withdraw</th>
										<th width="50%">Payment</th>
									</thead>
									<tbody>
										
										<td>
											<?php
											$suma =0;
									        $this->db->where('status', 3);
									        $this->db->order_by('id', 'desc');
									        $querys = $this->db->get('payments');
											if ($querys->num_rows()>0) { ?>

												<div class="table-responsive">
														
													<table class="table table-striped" style="margin-bottom: 30px;border:1px solid #ddd">
														<thead>
															<th>#</th>
															<th>Vendor</th>
															<th class="text-right">Amount:</th>
														</thead>
														<tbody>
															<?php
															$sl = 1;
															foreach ($querys->result_array() as $values) {
																$suma = $suma+$values['total'];
															?>

																<tr>
																	<td><?php echo $sl++; ?></td>

																	<?php
																	$this->db->where('id',$values['m_userid']);
																	$ua_query = $this->db->get('alluser');
																	foreach ($ua_query->result_array() as $ua_q_wor) {
																	?>
																		<td><?php echo $ua_q_wor['fname']; ?> <?php echo $ua_q_wor['lname']; ?></td>
																	<?php } ?>




																		<td class="text-right"><i class="fa fa-usd"></i><?php echo $values['total']/100; ?></td>
																</tr>
															<?php }  ?>

																<tr>
																	<th colspan="2">Total</th>
																	<th colspan="1" class="text-right">
																		<i class="fa fa-usd"></i><?php echo $suma/100; ?>
																	</th>
																</tr>
														</tbody>
													</table>
													
												
												</div>
											<?php }  ?>
										</td>
										

										<td>
											<?php
											$sum =0;
									        $this->db->where('status', 1);
									        $this->db->order_by('id', 'desc');
									        $query = $this->db->get('payments');
											if ($query->num_rows()>0) { ?>

												<div class="table-responsive">
														
													<table class="table table-striped" style="margin-bottom: 30px;border:1px solid #ddd">
														<thead>
															<th>#</th>
															<th>Buyer</th>
															<th>Vendor</th>
															<th>Status</th>
															<th class="text-right">Amount:</th>
														</thead>
														<tbody>
															<?php
															$sl = 1;
															foreach ($query->result_array() as $value) {
																$sum = $sum+$value['total'];
															?>

																<tr>
																	<td><?php echo $sl++; ?></td>
																	<?php 
																	$this->db->where('id',$value['m_userid']);
																	$m_u_query = $this->db->get('alluser');
																	$m_q_data = $m_u_query->row();
																	?>
																		<td><?php echo $m_q_data->fname; ?> <?php echo $m_q_data->lname; ?></td>
																	<?php
																	$this->db->where('id',$value['hostid']);
																	$h_query = $this->db->get('host');
																	$h_q_wor = $h_query->row();

																	$this->db->where('id',$h_q_wor->userid);
																	$u_query = $this->db->get('alluser');
																	$u_q_wor = $u_query->row();
																	?>
																		<td><?php echo $u_q_wor->fname; ?> <?php echo $u_q_wor->lname; ?></td>


																		<td>
																			<?php 
																				if ($value['payment_status']=='success') {
																					echo 'Active';
																				}else{
																					echo "Passed";
																				}
																			?>
																		</td>


																		<td class="text-right"><i class="fa fa-usd"></i><?php echo $value['total']/100; ?></td>
																</tr>
															<?php }  ?>

																<tr>
																	<th colspan="3">Total</th>
																	<th colspan="2" class="text-right">
																		<i class="fa fa-usd"></i><?php echo $sum/100; ?>
																	</th>
																</tr>
														</tbody>
													</table>
													
												
												</div>
											<?php }  ?>
										</td>


									</tbody>
								</table>
								
							
							</div>

								
                    </div>

				</div>
			
			</div>
	
	
		</div>
	</div>
</div>
