<div id="page-wrapper">
	<div class="container-fluid">
	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Buyers & Vendors</h1>
			</div>
		   
		</div>
				
				
		<div class="row">
				
				
			<div class="col-lg-12">			
				
				<div class="panel panel-default">
				 
				    <div class="panel-heading">
                        All Users
                    </div>
				    <div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>Username</th>
										<th>Fast Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Join Date</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										foreach ($alluser as $value) {
									?>
										<tr>
											<td><a href="#"><?php echo $value['user']; ?></a></td>
											<td><?php echo $value['fname']; ?></td>
											<td><?php echo $value['lname']; ?></td>
											<td><?php echo $value['email']; ?></td>
											<td><?php echo $value['phone']; ?></td>
											<td><?php 
												$add_dated = $value['added_date'];
												$date = date_create($add_dated);
												echo date_format($date,"d M, Y");
											?></td>
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