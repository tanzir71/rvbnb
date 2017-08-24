<?php include_once'widget.php'; ?>

<div class="home-directory">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="innerWrapper clearfix stepsPage">
                    <div class="row progress-wizard" style="border-bottom:0;">
                        <div class="col-xs-3 progress-wizard-step complete">
                            <div class="text-center progress-wizard-stepnum">User Information</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step complete">
                            <div class="text-center progress-wizard-stepnum">Location Information</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host_location" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step complete">
                            <div class="text-center progress-wizard-stepnum">Host Information</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host_info" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step complete">
                            <div class="text-center progress-wizard-stepnum">Review</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host_review" class="progress-wizard-dot"></a>
                        </div>
                    </div>
                    <form class="row" method="POST" action="<?php echo base_url(); ?>user/host_submit">

                        
                        <div class="col-xs-12">
                            <div class="page-header">
                                <h4>Published information <code><span class="required_m">*</span>required</code></h4>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12 become_review">
                            <input type="hidden" name="id" value="<?php echo $host_data->id; ?>">
                            <span class="required_m">*</span> <strong>Title</strong>: <?php echo $host_data->title; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>Amount</strong>: <?php echo $host_data->amount; ?>
                        </div>
                        
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>Street</strong>: <?php echo $host_data->street; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>Country</strong>: <?php echo $host_data->country; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>State</strong>: <?php echo $host_data->state; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>City</strong> : <?php echo $host_data->city; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m"> &nbsp;</span> <strong>Borough/County</strong>: <?php echo $host_data->borough; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>ZIP Code</strong>: <?php echo $host_data->zip; ?>
                        </div>

                        
                        
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>RV Types</strong>: <?php echo $host_data->rv_types; ?>
                        </div>
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>RV Sizes</strong>: <?php echo $host_data->rv_sizes; ?> feet long.
                        </div>


                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>Available from</strong>: <?php echo $host_data->from_date; ?>
                        </div>                        
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>Available till</strong>: <?php echo $host_data->to_date; ?>
                        </div>

                        <?php  
                            $get_email_phone = $this->user_model->get_user_email_phone($host_data->userid);
                            if ($get_email_phone->num_rows()>0) {
                                $getuser_e_p = $get_email_phone->row();
                        ?>

                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>Phone Number</strong>: <?php echo $getuser_e_p->phone; ?>
                        </div>                        
                        <div class="col-sm-6 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>Email</strong>: <?php echo $getuser_e_p->email; ?>
                        </div>
                        <?php } ?>

                        <div class="col-sm-12 col-xs-12 become_review">
                            <strong>Description</strong>: <p><?php echo $host_data->description; ?></p>
                        </div>


                        <?php  $results = $this->user_model->get_host_by_data($host_data->id,$host_data->userid,'files'); ?>
                        <div class="col-sm-12 col-xs-12 become_review">
                            <span class="required_m">*</span> <strong>Images </strong>:  <span class="badge badge-success"><?php echo $results->num_rows(); ?></span>
                        </div>

                        <?php
                        if ($results->num_rows() > 0) { 
                        foreach ($results->result_array() as $value) { ?>

                            <div class="col-sm-4 col-xs-12 become_review">
                                <img src="<?php echo base_url() ?>assets/images/hosts/<?php echo $value['file_name']; ?>" class="img-responsive" alt="Image">
                            </div>

                        <?php }} ?>







                        <div class="col-xs-12 checkboxArea">
                            <div class="checkbox">
                                <input id="checkbox1" name="published_check" value="1" type="checkbox" required="1">
                                <label for="checkbox1"> Are you sure want to published ? </label>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="well well-lg clearfix">
                                <ul class="pagers">
                                    <li class="previous pull-left"><a href="<?php echo base_url(); ?>user/become_a_host_info" class="hideContent btn btn-default">Back</a></li>
                                    <li class="next pull-right"><button type="submit" class="btn btn-default">Submit</button></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>