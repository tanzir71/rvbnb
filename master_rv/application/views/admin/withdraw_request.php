<div id="page-wrapper">
	<div class="container-fluid">
				
		<div class="row" style="margin-top: 20px">
				
				
			<div class="col-lg-12">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Withdraw request</h3>
					</div>
					
					<div class="panel-body">


							<div class="table-responsive">
									
								<?php
								$suma =0;
						        $this->db->where('status', 4);
						        $this->db->order_by('id', 'desc');
						        $querys = $this->db->get('payments');
								if ($querys->num_rows()>0) { ?>

									<div class="table-responsive">
											
										<table class="table table-striped" style="margin-bottom: 30px;border:1px solid #ddd">
											<thead>
												<th>#</th>
												<th>Vendor</th>
												<th class="text-right">Amount</th>
												<th>Dated</th>
												<th>Action</th>
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
															<td><a href="<?php echo base_url() ?>admin/user_details/<?php echo $ua_q_wor['id']; ?>" target="_blank"><?php echo $ua_q_wor['fname'].' '.$ua_q_wor['lname']; ?></a></td>
														<?php } ?>


															

															<td class="text-right"><i class="fa fa-usd"></i><?php echo $values['total']/100; ?></td>

															<td><?php echo  $values['added_date']; ?></td>
															<td>
																<button value="<?php echo $values['id']; ?>:3" onclick="payment_withdrw_by_admin(this)" class="btn btn-success btn-sm">Approve</button>
																<button value="<?php echo $values['id']; ?>:5" onclick="payment_withdrw_by_admin(this)" class="btn btn-danger btn-sm">Reject</button>
															</td>

													</tr>
												<?php }  ?>

													<tr>
														<th colspan="2">Total</th>
														<th class="text-right">
															<i class="fa fa-usd"></i><?php echo $suma/100; ?>
														</th>
														<th></th>
														<th></th>
													</tr>
											</tbody>
										</table>
										
									
									</div>
								<?php }  ?>
								
							
							</div>

								
                    </div>


                    <div class="panel-heading">
						<h3 class="panel-title">Reject withdraw request</h3>
					</div>
					
					<div class="panel-body">


							<div class="table-responsive">
									
								<?php
								$suma =0;
						        $this->db->where('status', 5);
						        $this->db->order_by('id', 'desc');
						        $querys = $this->db->get('payments');
								if ($querys->num_rows()>0) { ?>

									<div class="table-responsive">
											
										<table class="table table-striped" style="margin-bottom: 30px;border:1px solid #ddd">
											<thead>
												<th>#</th>
												<th>Vendor</th>
												<th class="text-right">Amount</th>
												<th>Dated</th>
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
															<td><a href="<?php echo base_url() ?>admin/user_details/<?php echo $ua_q_wor['id']; ?>" target="_blank"><?php echo $ua_q_wor['fname'].' '.$ua_q_wor['lname']; ?></a></td>
														<?php } ?>


															

															<td class="text-right"><i class="fa fa-usd"></i><?php echo $values['total']/100; ?></td>

															<td><?php echo  $values['added_date']; ?></td>

													</tr>
												<?php }  ?>

													<tr>
														<th colspan="2">Total</th>
														<th class="text-right">
															<i class="fa fa-usd"></i><?php echo $suma/100; ?>
														</th>
														<th></th>
														<th></th>
													</tr>
											</tbody>
										</table>
										
									
									</div>
								<?php }  ?>
								
							
							</div>

								
                    </div>

				</div>
			
			</div>
	
	
		</div>
	</div>
</div>
