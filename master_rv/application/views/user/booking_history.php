<?php include_once'widget.php'; ?>

<div class="home-directory">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">

            	<?php include_once'profile_sidebar.php'; ?>

            </div>

            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            	<div class="panel panel-default">
            		<div class="panel-heading">
            			<h3 class="panel-title"><i class="fa fa-cog fa-spin"></i> Booking history</h3>
            		</div>
                    <div class="panel-body">
                        
						<?php 
						$m_userid = $this->session->userdata('airbnb');
						

						$this->db->where('m_userid', $m_userid);
				        //$this->db->where('payment_status', 'success');
				        $this->db->order_by('id', 'desc');
				        $query = $this->db->get('payments');
						if ($query->num_rows()>0) { ?>

							<div class="table-responsive">
									
								<table class="table table-striped" style="margin-bottom: 30px;border:1px solid #ddd">
									<thead>
										<th>Title:</th>
										<th>Location:</th>
										<th>Vendor name:</th>
										<th>Phone number:</th>
										<th>Email:</th>
										<th>Amount:</th>
										<th>Booking Date:</th>
										<th>Status</th>
									</thead>
									<tbody>
										<?php 
										$today = date("Y-m-d");
										foreach ($query->result_array() as $value) { ?>

											<tr>
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
													<td><?php echo $h_q_wor->title; ?></td>
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
													<td><?php echo $value['from_date']; ?> to <?php echo $value['to_date']; ?></td>
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