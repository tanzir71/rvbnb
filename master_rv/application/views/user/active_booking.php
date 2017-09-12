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
            			<h3 class="panel-title"><i class="fa fa-cog fa-spin"></i> Active booking</h3>
            		</div>
                    <div class="panel-body">
                        
						<?php 
						$m_userid = $this->session->userdata('airbnb');
						

						$this->db->where('m_userid', $m_userid);
				        $this->db->where('payment_status', 'success');
				        $this->db->order_by('id', 'desc');
				        $query = $this->db->get('payments');
						if ($query->num_rows()>0) { ?>

							<div class="table-responsive">
									<?php foreach ($query->result_array() as $value) { ?>
								<table class="table table-striped" style="margin-bottom: 30px;border:1px solid #ddd">
									<tbody>
									<?php

										$this->db->where('id',$value['hostid']);
										$h_query = $this->db->get('host');
										$h_q_wor = $h_query->row();
										?>
										<tr>
											<th>Title:</th>
											<td>
												<a href="<?php echo base_url() ?>home/host_rv/<?php echo $h_q_wor->id.'/'.preg_replace('/\s+/', '-', $h_q_wor->title) ?>" target="_blank"><?php echo $h_q_wor->title; ?>
                                        		</a>
												
											</td>
										</tr>
										<tr>
											<th>Location:</th>
											<td><?php echo $h_q_wor->location; ?></td>
										</tr>

										<?php 
										$this->db->where('id',$h_q_wor->userid);
										$u_query = $this->db->get('alluser');
										$u_q_wor = $u_query->row();
										?>
										<tr>
											<th>Vendor name:</th>
											<td><?php echo $u_q_wor->fname; ?> <?php echo $u_q_wor->lname; ?></td>
										</tr>
										<tr>
											<th>Phone number:</th>
											<td><?php echo $u_q_wor->phone; ?></td>
										</tr>
										<tr>
											<th>Email:</th>
											<td><?php echo $u_q_wor->email; ?></td>
										</tr>

										<tr>
											<th>Amount:</th>
											<td><i class="fa fa-usd"></i><?php echo $value['total']/100; ?></td>
										</tr>

										<tr >
											<th>Booking Date:</th>
											<td><?php echo $value['from_date']; ?> to <?php echo $value['to_date']; ?></td>
										</tr>
									</tbody>
								</table>
								<?php }  ?>
							
							</div>




								
						<?php }  ?>
                    </div>




            	</div>

            </div>


        </div>
    </div>
</div>