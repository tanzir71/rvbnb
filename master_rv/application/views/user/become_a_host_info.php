
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
                        <div class="col-xs-3 progress-wizard-step disabled">
                            <div class="text-center progress-wizard-stepnum">Review</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host_review" class="progress-wizard-dot"></a>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" action="<?php echo base_url() ?>user/host_information_setup" method="post">




                        <div class="col-xs-12">
                            <div class="page-header">
                                <h4>Host Information <code><span class="required_m">*</span>required</code></h4> 
                            </div>
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Title</label> <span class="required_m">*</span> <span class="badge">Don't use special character.</span> 
                            <input type="hidden" name="hostid" value="<?php echo $host_data->id; ?>"> 
                            <input class="form-control" name="title" type="text"  value="<?php echo $host_data->title; ?>">
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Amount <span class="badge"><i class="fa fa-usd"></i></span></label> <span class="required_m">*</span>
                            <input class="form-control" name="amount" type="number" value="<?php echo $host_data->amount; ?>"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>RV Types: </label> example(Class A, Class B, Class C) <span class="required_m">*</span>

                            <input type="text" class="form-control" name="rv_types" id="rv_type_val" value="<?php echo $host_data->rv_types; ?>">

                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>RV Sizes: <span class="badge">feet</span></label> <span class="required_m">*</span>
                            <input type="text" id="amount" name="rv_sizes" class="form-control" readonly style="color:#81B441; font-weight:bold;">
                            <?php if (!empty($host_data->rv_sizes)) {
                                echo 'You are Selected : '.$host_data->rv_sizes;
                            } ?>
                            <div id="slider-range"></div>


                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Available from: </label> <span class="required_m">*</span>
                            <input class="form-control" name="from_date" id="from" type="text" value="<?php echo $host_data->from_date; ?>" placeholder="yy-mm-dd"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Available till: </label> <span class="required_m">*</span>
                            <input class="form-control" name="to_date" id="to" type="text" value="<?php echo $host_data->to_date; ?>" placeholder="yy-mm-dd"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Multiple image upload: </label> <span class="required_m">*</span>
                            <input type="file" class="form-control" name="userFiles[]" multiple/> 
                        </div>

                        <?php  $results = $this->user_model->get_host_by_data($host_data->id,$host_data->userid,'files'); ?>
                        <div class="col-sm-12 col-xs-12 become_review">
                            <strong>Images </strong> :  <span class="badge badge-success"><?php echo $results->num_rows(); ?></span>
                        </div>

                        <?php
                        if ($results->num_rows() > 0) { 
                        foreach ($results->result_array() as $value) { ?>

                            <div class="col-sm-4 col-xs-12 become_review">

                                <div class="thumbnail" id="sohels<?php echo $value['id']; ?>">
                                    <img src="<?php echo base_url() ?>assets/images/hosts/<?php echo $value['file_name']; ?>" class="img-responsive" alt="Image">
                                    <div class="caption text-center">
                                        <button type="button" class="btn btn-sm btn-danger" value="<?php echo $value['id'].':'.$value['userid'].':'.$value['hostid']; ?>" onclick="return host_image_delete(this)">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </div>
                                </div>


                            </div>

                        <?php }} ?>


                        <div class="form-group col-xs-12">
                            <label>Description: </label>
                            <textarea name="editor1" class="form-control" style="height: 200px"><?php echo $host_data->description; ?></textarea>
                        </div>

                        



                        <div class="col-xs-12">
                            <div class="well well-lg clearfix">
                                <ul class="pagers">
                                    <li class="previous pull-left"><a href="<?php echo base_url(); ?>user/become_a_host_location" class="hideContent btn btn-default">Back</a></li>
                                    <li class="next pull-right">
                                        <input class="btn btn-default" type="submit" name="fileSubmit" value="Update &amp; Continue" style="height: 32px;margin-left: 10px">
                                    </li> &nbsp;


                                    <li class="previous pull-right"><a href="<?php echo base_url(); ?>user/become_a_host_review" class="btn btn-default">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>