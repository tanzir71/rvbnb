<div id="page-wrapper">
	<div class="container-fluid">
				
		<div class="row" style="margin-top: 20px">
				
				
			<div class="col-lg-12">

				<div class="panel panel-default">
				 
				    <div class="panel-body">
					    <form action="<?php echo base_url() ?>admin/buyer_vendor_status" method="POST">

	                        <div class="form-group col-sm-1">
	                        	<label for="name">ID</label>
	                        	<input type="text" class="form-control" name="userid">
	                        </div>
	                        <div class="form-group col-sm-3">
	                        	<label for="name">Email</label>
	                        	<input type="email" class="form-control" name="email" id="auto_email">
	                        </div>
	                        <div class="form-group col-sm-3">
	                        	<label for="name">Status</label>
	                        	<select class="form-control" name="user_status">
	                        		<option value=" ">Select status</option>
	                        		<option value="1">Activate</option>
	                        		<option value="2">Deactivate</option>
	                        	</select>
	                        </div>
	                        <div class="form-group col-sm-2">
	                        	<button class="btn btn-primary" style="margin-top: 25px">Search</button>
	                        </div>

	                    </form>
                    </div>
                </div>		
				
				<div class="panel panel-default">
				 
				    <div class="panel-heading">
                        All Users
                    </div>
				    <div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Status</th>
										<th>Username</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Join Date</th>
										<th width="22%">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										foreach ($alluser as $value) {
									?>
										<tr>
											<td><?php echo $value['id']; ?></td>
											<td><a href="<?php echo base_url() ?>admin/user_details/<?php echo $value['id']; ?>" target="_blank"><?php echo $value['fname'].' '.$value['lname']; ?></a></td>
											<td>
												<?php if ($value['status']==1) {
													echo '<button class="btn btn-success btn-sm" type="button" disabled>Active</button>';
												}else if ($value['status']==2) {
													echo '<button class="btn btn-danger btn-sm" type="button" disabled>Inacitive</button>';
												}?>
											</td>
											<td><?php if (!empty($value['user'])) {
												echo $value['user'];
											}else{ echo '<a href="'.$value['profile_url'].'" target="_blank">Facebook</a>'; } ?></td>
											<td><?php echo $value['email']; ?></td>
											<td><?php echo $value['phone']; ?></td>
											<td><?php 
												$add_dated = $value['added_date'];
												$date = date_create($add_dated);
												echo date_format($date,"d M, Y");
											?></td>

											<td>
												<?php if ($value['status']==1) { ?>
												<button class="btn btn-danger btn-sm" type="button" value="<?php echo 'd|'.$value['id']; ?>" onclick="user_control(this)">Deactivate</button>

												<?php }elseif ($value['status']==2) { ?>

												<button class="btn btn-success btn-sm" type="button" value="<?php echo 'a|'.$value['id']; ?>" onclick="user_control(this)">Activate</button>

												<?php } ?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
				    </div>
				
            	</div>
			
			</div>
	
	
		</div>
	</div>
</div>