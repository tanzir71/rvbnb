<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<div class="page_header page_height"> 

    <img src="http://placehold.it/1780x400" class="img-responsive" alt="">
    <div class="container">
        <ul class="bcrumbs">
            <li><a href="#">Home</a> </li>
            <li>Become a Host</li>
        </ul>
    </div>
</div>


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
                    <form class="row" method="POST" action="<?php echo base_url(); ?>user/host_step_three">




                        <div class="col-xs-12">
                            <div class="page-header">
                                <h4>Host Information</h4> 
                            </div>
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Title</label>
                            <input type="hidden" name="host_id" value="<?php echo $host_data->id; ?>">
                            <input class="form-control" name="title" type="text">
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Amount</label>
                            <input class="form-control" name="amount" type="number"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>RV Types: </label> &nbsp;&nbsp;&nbsp;
                            <label class="checkbox-inline">
                                <input class="input_check" name="rv_types" type="checkbox" value="1">Class A
                            </label>
                            <label class="checkbox-inline">
                              <input class="input_check" name="rv_types" type="checkbox" value="2">Class B
                            </label>
                            <label class="checkbox-inline">
                              <input class="input_check" name="rv_types" type="checkbox" value="3">Class C
                            </label> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>RV Sizes</label>
                            <input type="text" id="amount" name="rv_sizes" class="form-control" readonly style="color:#81B441; font-weight:bold;">
                            <div id="slider-range"></div>


                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>From Date</label>
                            <input class="form-control" name="from_date" id="from" type="text"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>To Date</label>
                            <input class="form-control" name="to_date" id="to" type="text"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Upload Image</label>
                            <input class="form-control" name="Image" type="file"> 
                        </div>

                        <div class="form-group col-xs-12">
                            <textarea name="editor1"></textarea>
                            <script>
                                CKEDITOR.replace( 'editor1' );
                            </script>
                        </div>

                        



                        <div class="col-xs-12">
                            <div class="well well-lg clearfix">
                                <ul class="pagers">
                                    <li class="previous pull-left"><a href="<?php echo base_url(); ?>user/become_a_host_location" class="hideContent btn btn-danger">back</a></li>
                                   <li class="next pull-right"><button type="submit" class="btn btn-default">Update &amp; Continue</button></li>


                                    <li class="previous pull-right"><a href="<?php echo base_url(); ?>user/become_a_host_review" class="btn btn-primary">Continue</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
