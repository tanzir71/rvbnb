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
            			<h3 class="panel-title"><i class="fa fa-history"></i> Hosting History</h3>
            		</div>
            		<div class="panel-body">
                    <?php if ($host_history->num_rows()>0) { ?>
            			<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        <th>Title</th>
                                        <th>Location</th>
                                        <th>RV Sizes</th>
                                        <th>RV Types</th>
                                        <th>Amount</th>
                                        <th>Added Date</th>
                                        <th>Status</th>
                                        <th>Review</th>
                                        <th>Booking</th>
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($host_history->result_array() as $value) {
                                            if ($value['status'] ==1 || $value['status'] ==0) {
                                    ?>
                                        <tr id="sohel<?php echo $value['id']; ?>">
                                            <td><?php echo $value['id']; ?></td>
                                            <td><?php echo $value['title']; ?></td>
                                            <td><?php echo $value['location']; ?></td>
                                            <td><?php echo $value['rv_sizes']; ?> Feet</td>
                                            <td><?php echo $value['rv_types']; ?></td>
                                            <td><i class="fa fa-usd"> </i><?php echo $value['amount']; ?></td>
                                            <td><?php echo $value['added_date']; ?></td>
                                            <td><?php
                                                if ($value['status']==1) {
                                                    echo '<button class="btn btn-sm btn-success" disabled>Published</button>';
                                                }else if ($value['status']==0) {
                                                    echo '<button class="btn btn-sm btn-warning" disabled>Pending</button>';
                                                }
                                            ?></td>
                                            <td>           
                                                <?php 
                                                $sum = 0;
                                                $get_reviews = $this->user_model->get_host_by_data($value['id'],$value['userid'],'reviews');
                                                if ($get_reviews->num_rows() > 0) { 
                                                    $total_review = $get_reviews->num_rows();

                                                    foreach ($get_reviews->result_array() as $value_review) {
                                                        $sum = $value_review['star']+$sum;
                                                    }
                                                    $sum_show = $sum/$total_review;
                                                    echo '<span class="badge">'.number_format($sum_show, 1).'/Total: '.$get_reviews->num_rows().'</span>';
                                                }else{
                                                    echo 'No';
                                                }
                                                ?>
                                            </td>

                                            <td>
                                                <?php
                                                    $this->db->where('hostid', $value['id']);
                                                    $this->db->where('payment_status','success');
                                                    $this->db->where('status','1');
                                                    $pay_query = $this->db->get('payments');
                                                    if ($pay_query->num_rows()>0) {
                                                        foreach ($pay_query->result_array() as $pay_query_value) {
                                                            echo $pay_query_value['from_date'].' to '.$pay_query_value['to_date'].'<br>';
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" value="<?php echo $value['id'];  ?>" onclick="return hosting_delete(this)"><i class="fa fa-trash"></i></button>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-default btn-sm" value="<?php echo $value['id'];  ?>" onclick="return edit_hosting(this)">Edit</button>
                                            </td>
                                        </tr>
                                    <?php }} ?>
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