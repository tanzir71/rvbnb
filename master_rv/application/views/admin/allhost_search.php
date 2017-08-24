<div id="page-wrapper">
	<div class="container-fluid">
				
		<div class="row" style="margin-top: 20px">
				
				
			<div class="col-lg-12">

				<div class="panel panel-default">
				 
				    <div class="panel-body">
					    <form action="<?php echo base_url() ?>admin/allhost_search" method="POST">

	                        <div class="form-group col-sm-3">
	                        	<label for="name">State</label>
	                        	<input type="text" class="form-control" name="state" id="auto_state">
	                        </div>
	                        <div class="form-group col-sm-3">
	                        	<label for="name">City</label>
	                        	<input type="text" class="form-control" name="city" id="auto_city">
	                        </div>
	                        <div class="form-group col-sm-3">
	                        	<label for="name">Street Location</label>
	                        	<input type="text" class="form-control" name="location" id="auto_location">
	                        </div>
	                        <div class="form-group col-sm-2">
	                        	<label for="name">Status</label>
	                        	<select class="form-control" name="status">
	                        		<option value=" ">Select status</option>
	                        		<option value="1">Approved</option>
	                        		<option value="0">Disapprove</option>
	                        	</select>
	                        </div>
	                        <div class="form-group col-sm-1">
	                        	<button class="btn btn-primary" style="margin-top: 25px">Search</button>
	                        </div>

	                    </form>
                    </div>
                </div>		
				
				<div class="panel panel-default">
				 
				    <div class="panel-heading">
                    	Host Review
                    </div>
				    <div class="panel-body">

            			<div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Publisher</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>RV Sizes</th>
                                        <th>RV Types</th>
                                        <th>Amount</th>
                                        <th>Reuquest Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($s_results as $value) {
                                    ?>
                                        <tr id="fad<?php echo $value['id']; ?>">
                                        	<td><?php echo $value['id']; ?></td>
                                            <td>
                                            	<?php  $results = $this->user_model->get_host_by_alluser_data($value['userid'],'alluser');
                                            	foreach ($results->result_array() as $user_data) {
                                            	?>
                                                <a href="<?php echo base_url() ?>admin/user_details/<?php echo $user_data['id']; ?>" target="_blank"><?php echo $user_data['fname'].' '.$user_data['lname']; ?></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url() ?>home/host_rv/<?php echo $value['id'].'/'.preg_replace('/\s+/', '-', $value['title']) ?>" target="_blank"><?php echo $value['title']; ?></a>
                                            </td>
                                            <td><?php echo $value['location']; ?></td>
                                            <td><?php echo $value['rv_sizes']; ?> Feet</td>
                                            <td><?php echo $value['rv_types']; ?></td>
                                            <td><i class="fa fa-usd"> </i><?php echo $value['amount']; ?></td>
                                            <td><?php echo $value['added_date']; ?></td>
                                            <td><button type="button" class="btn btn-sm btn-success" value="<?php echo $value['id']; ?>" onclick="approve_host(this)">Approve Now</button></td>
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