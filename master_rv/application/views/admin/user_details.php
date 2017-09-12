<div id="page-wrapper">
	<div class="container-fluid">
				
		<div class="row" style="margin-top: 20px">
				
				
			<div class="col-lg-12">
			<?php 
			foreach ($host_user->result_array() as $user_value) { ?>		
				
				<div class="panel panel-default">
				 
				    <div class="panel-heading">
                    	<strong><?php echo $user_value['fname']?></strong> personal information
                    </div>


                    <div class="panel-body">
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Username</strong>: <?php echo $user_value['user']; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Name</strong>: <?php echo $user_value['fname'].' '.$user_value['lname']; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Email</strong>: <?php echo $user_value['email']; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Gender</strong>: <?php echo $user_value['gender']; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Birthday</strong>: <?php echo $user_value['birthday']; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Phone</strong>: <?php echo $user_value['phone']; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Location</strong>: <?php echo $user_value['live']; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <strong>Join Date</strong>: <?php echo $user_value['added_date']; ?>
                        </div>
                        <div class="col-sm-12 col-xs-12 become_review">
                            <strong>Yourself</strong>: <p><?php echo $user_value['yourself']; ?></p>
                        </div>
            		</div>

            	</div>
            	<div class="panel panel-default">
				 
				    <div class="panel-heading">
                    	<strong><?php echo $user_value['fname']?></strong> hosting Information
                    </div>

                    <div class="panel-body">

                    	<?php
                    	$this->db->where('userid',$user_value['id']);
                    	$this->db->where('reviews',1);
                    	$results = $this->db->get('host');
	                    if ($results->num_rows()>0) {
			            ?>
						
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>Host title</th>
										<th>Added Date</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($results->result_array() as $host_data) { ?>
									<tr>
										<td><?php echo $host_data['id']; ?></td>
										<td><?php echo $host_data['title']; ?></td>
										<td><?php echo date_format(date_create($host_data['added_date']),"F d, Y"); ?></td>
										<td><?php if ($host_data['status']==0) {
											echo '<button class="btn btn-sm btn-warning" disabled>Warning</button>';
										}else if ($host_data['status']==2) {
											echo '<button class="btn btn-sm btn-danger" disabled>Deleted</button>';
										}else{
											echo '<button class="btn btn-sm btn-success" disabled>Approved</button>';
										}
										?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>


			            <?php } ?>
                    </div>
                </div>


			<?php } ?>
			</div>
	
	
		</div>
	</div>
</div>