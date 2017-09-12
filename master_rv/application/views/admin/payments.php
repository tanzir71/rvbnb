<div id="page-wrapper">
	<div class="container-fluid">
				
		<div class="row" style="margin-top: 20px">
				
				
			<div class="col-lg-12">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">View all Payment</h3>
					</div>
					
					<div class="panel-body">
                        
						<?php
				        $this->db->where('status', 1);
				        $this->db->order_by('id', 'desc');
				        $query = $this->db->get('payments');
						if ($query->num_rows()>0) { ?>

							<div class="table-responsive">
									
								<table class="table table-striped" style="margin-bottom: 30px;border:1px solid #ddd">
									<thead>
										<th>#</th>
										<th>Title:</th>
										<th>Location:</th>
										<th>Vendor name:</th>
										<th>Phone number:</th>
										<th>Email:</th>
										<th>Amount:</th>
										<th colspan="2">Booking Date:</th>
										<th>Status</th>
									</thead>
									<tbody>
										<?php 
										$today = date("Y-m-d");
										$sl = 1;
										foreach ($query->result_array() as $value) { ?>

											<tr>
												<td><?php echo $sl++; ?></td>
												<?php
												if (strtotime($value['to_date'])<strtotime($today)) {
													$up_pay = array('payment_status' => 'old' );
													$this->db->where('id',$value['id']);
													$this->db->where('hostid',$value['hostid']);
													$this->db->where('hostid',$value['hostid']);
													$this->db->update('payments',$up_pay);
												}

												$this->db->where('id',$value['hostid']);
												$h_query = $this->db->get('host');
												$h_q_wor = $h_query->row();
												?>
													<td>
														<a href="<?php echo base_url() ?>home/host_rv/<?php echo $h_q_wor->id.'/'.preg_replace('/\s+/', '-', $h_q_wor->title) ?>" target="_blank"><?php echo $h_q_wor->title; ?>
                                        				</a>
													</td>
													<td><?php echo $h_q_wor->location; ?></td>

												<?php 
												$this->db->where('id',$h_q_wor->userid);
												$u_query = $this->db->get('alluser');
												$u_q_wor = $u_query->row();
												?>
													<td><?php echo $u_q_wor->fname; ?> <?php echo $u_q_wor->lname; ?></td>
													<td><?php echo $u_q_wor->phone; ?></td>
													<td><?php echo $u_q_wor->email; ?></td>
													<td><i class="fa fa-usd"></i><?php echo $value['total']/100; ?></td>
													<td width="12%"><?php echo $value['from_date']; ?> to </td>
													<td width="12%"><?php echo $value['to_date']; ?></td>
													<td>
														<?php 
															if ($value['payment_status']=='success') {
																echo 'Active';
															}else{
																echo "Passed";
															}
														?>
													</td>
											</tr>
										<?php }  ?>
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
