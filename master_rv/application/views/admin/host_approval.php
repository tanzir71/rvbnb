<div id="page-wrapper">
	<div class="container-fluid">
				
		<div class="row" style="margin-top: 20px">
				
				
			<div class="col-lg-12">

				<div class="panel panel-default">
				 
				    <div class="panel-body">
					    <form action="<?php echo base_url() ?>admin/allhost_search" method="POST" target="_blank">

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
						<div role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#home" aria-controls="home" role="tab" data-toggle="tab">Pending</a>
								</li>
								<li role="presentation">
									<a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">Approved</a>
								</li>
							</ul>
						
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">
								<?php if ($host_history->num_rows()>0) { ?>
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
			                                        foreach ($host_history->result_array() as $value) {
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
			                    <?php }else{ echo 'no data.';} ?>
								</div>


								<div role="tabpanel" class="tab-pane" id="tab">
									<?php if ($host_success->num_rows()>0) { ?>
			            			<div class="table-responsive">
			                            <table class="table table-hover">
			                                <thead>
			                                    <tr>
			                                        <th>id</th>
			                                        <th>Publisher</th>
			                                        <th>Title</th>
			                                        <th>Location</th>
			                                        <th>RV Sizes</th>
			                                        <th>RV Types</th>
			                                        <th>Amount</th>
			                                        <th>Review</th>
			                                        <th>Appproved D.</th>
			                                        <th></th>
			                                        <th></th>
			                                    </tr>
			                                </thead>
			                                <tbody>
			                                    <?php
			                                        foreach ($host_success->result_array() as $values) {
			                                    ?>
			                                        <tr id="fadd<?php echo $values['id']; ?>">
			                                        	<td><?php echo $values['id']; ?></td>
			                                            <td>
			                                            	<?php  $results = $this->user_model->get_host_by_alluser_data($values['userid'],'alluser');
			                                            	foreach ($results->result_array() as $user_data) {
			                                            	?>
			                                                <a href="<?php echo base_url() ?>admin/user_details/<?php echo $user_data['id']; ?>" target="_blank"><?php echo $user_data['fname'].' '.$user_data['lname']; ?></a>
			                                                <?php } ?>
			                                            </td>
			                                            <td>
			                                                <a href="<?php echo base_url() ?>home/host_rv/<?php echo $values['id'].'/'.preg_replace('/\s+/', '-', $values['title']) ?>" target="_blank"><?php echo $values['title']; ?></a>
			                                            </td>
			                                            <td><?php echo $values['location']; ?></td>
			                                            <td><?php echo $values['rv_sizes']; ?> Feet</td>
			                                            <td><?php echo $values['rv_types']; ?></td>
			                                            <td><i class="fa fa-usd"> </i><?php echo $values['amount']; ?></td>
			                                            <td>
			                                            	
												            <?php 
									                        $sum = 0;
									                        $get_reviews = $this->user_model->get_host_by_data($values['id'],$values['userid'],'reviews');
									                        if ($get_reviews->num_rows() > 0) { 
									                            $total_review = $get_reviews->num_rows();

									                            foreach ($get_reviews->result_array() as $value_review) {
									                                $sum = $value_review['star']+$sum;
									                            }
									                            $sum_show = $sum/$total_review;
									                            echo '<span class="badge">'.number_format($sum_show, 1).'/Total: '.$get_reviews->num_rows().'</span>';
									                        }
									                        ?>
			                                            </td>
			                                            <td><?php echo $values['added_date']; ?></td>
			                                            <td><button type="button" class="btn btn-sm btn-warning" value="<?php echo $values['id']; ?>" onclick="disapprove_host(this)">Disapprove</button></td>

			                                            <td><button type="button" class="btn btn-sm btn-danger" value="<?php echo $values['id']; ?>" onclick="delete_host(this)">Delete</button></td>
			                                        </tr>
			                                    <?php } ?>
			                                </tbody>
			                            </table>
			                        </div>
			                    <?php }else{ echo 'no data.';} ?>
							</div>
						</div>

						
				    </div>
				
            	</div>
			
			</div>
	
	
		</div>
	</div>
</div>