<?php include_once'widget.php'; ?>
<div class="home-directory">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                
                <h1>
                    <?php
                    if (isset($error)) {
                        echo '<span style="color:red">'.$error.'</span><br><br><a href="'.base_url().'user/become_a_host_review" class="btn btn-lg btn-default">Back</a>';
                    }else{
                        echo '<span style="color:#81B441">'.$success.'</span>';
                    }
                    ?>
                </h1>


            </div>
        </div>
    </div>
</div>