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
                        <div class="col-xs-3 progress-wizard-step disabled">
                            <div class="text-center progress-wizard-stepnum">Location Information</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>user/become_a_host_location" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step disabled">
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
                    <form class="row" method="POST" action="<?php echo base_url(); ?>user/host_step_one">

                        <div class="col-xs-12">
                            <div class="page-header">
                                <h4>User Information</h4> 
                            </div>
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>First Name</label>
                            <input type="hidden" name="id" value="<?php echo $user_data->id; ?>"> 
                            <input class="form-control" type="text" name="fname" value="<?php echo $user_data->fname; ?>" required=""> 
                        </div>

                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="lname" value="<?php echo $user_data->lname; ?>" required=""> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" value="<?php echo $user_data->email; ?>" required=""> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Phone Number</label>
                            <input class="form-control" type="text" name="phone" value="<?php echo $user_data->phone; ?>" required=""> 
                        </div>


                        <div class="col-xs-12">
                            <div class="well well-lg clearfix">
                                <ul class="pagers">
                                    <?php

                                    $host_ch = $this->user_model->host_data_check($this->session->userdata('airbnb'),$this->session->userdata('session'));
                                    if ($host_ch == FALSE) { ?>
                                        
                                        <li class="next pull-right"><button type="submit" class="btn btn-default">Update</button></li>
                                    <?php }else{ ?>
                                    
                                        <li class="previous pull-right"><a href="<?php echo base_url(); ?>user/become_a_host_location" class="btn btn-default">Next</a></li>
                                        
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
/*
    echo $this->session->userdata('session'); 
    echo $this->session->userdata('airbnb'); 
    echo $this->session->userdata('user'); 
*/
?>