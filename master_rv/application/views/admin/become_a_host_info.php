<script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
<div class="page_header" style="margin-top: 110px"> 

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
                            <a href="<?php echo base_url(); ?>admin/become_a_host" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step complete">
                            <div class="text-center progress-wizard-stepnum">Location Information</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>admin/become_a_host_location" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step complete">
                            <div class="text-center progress-wizard-stepnum">Host Information</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>admin/become_a_host_info" class="progress-wizard-dot"></a>
                        </div>
                        <div class="col-xs-3 progress-wizard-step disabled">
                            <div class="text-center progress-wizard-stepnum">Review</div>
                            <div class="progress">
                                <div class="progress-bar"></div>
                            </div>
                            <a href="<?php echo base_url(); ?>admin/become_a_host_review" class="progress-wizard-dot"></a>
                        </div>
                    </div>
                    <form class="row" method="POST" action="<?php echo base_url(); ?>admin/host_step_three">




                        <div class="col-xs-12">
                            <div class="page-header">
                                <h4>Host Information</h4> 
                            </div>
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Title</label>
                            <input class="form-control" id="" type="text"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Amount</label>
                            <input class="form-control" type="number"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>From Date</label>
                            <input class="form-control" id="from" type="text"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>To Date</label>
                            <input class="form-control" id="to" type="text"> 
                        </div>
                        <div class="form-group col-sm-6 col-xs-12">
                            <label>Upload Image</label>
                            <input class="form-control" type="file"> 
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
                                    <li class="previous pull-left"><a href="<?php echo base_url(); ?>admin/become_a_host_location" class="hideContent btn btn-danger">back</a></li>
                                   <li class="next pull-right"><button type="submit" class="btn btn-default">Continue</button></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>