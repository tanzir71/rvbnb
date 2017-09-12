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
            			<h3 class="panel-title"><i class="fa fa-credit-card-alt"></i> Payment</h3>
            		</div>
                    <div class="panel-body">



                        <?php 
                            $myid = $this->session->userdata('airbnb');
                            $this->db->where('userid',$myid);
                            $query = $this->db->get('host');
                            if ($query->num_rows()>0) {
                                foreach ($query->result_array() as $value) {
                                   $hostid = $value['id'];


                                    $this->db->where('hostid',$hostid);
                                    $this->db->where('status',1);
                                    $pay_query = $this->db->get('payments');
                                    if ($pay_query->num_rows()>0) {

                                        $sum = 0;
                                        foreach ($pay_query->result_array() as $pay_value) {
                                            $sum = $sum+$pay_value['total']/100;
                                            $sum2 = $sum*5/100;
                                        }

                                        //total user pay
                                        $this->db->where('m_userid',$myid);
                                        $this->db->where('status',4);
                                        $this->db->or_where('status',3);
                                        $c_query = $this->db->get('payments');
                                        $summ = 0;
                                        foreach ($c_query->result_array() as $paym_value) {
                                            $summ = $summ+$paym_value['total']/100;
                                            $summ2 = $summ*5/100;
                                        }
                                        error_reporting(E_ERROR);
                                        $total2 = $summ-$summ2;





                                        $total1 = $sum-$sum2;

                                        $total = $total1-$total2;
                                        echo '<h3>Your earnings : <i class="fa fa-usd"></i>'.$total.'</h3>';
                                        ?>


                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $total; ?>" aria-valuemin="0" aria-valuemax="5000" style="width:<?php echo $total; ?>%">
                                              <?php echo $total; ?>%
                                            </div>
                                        </div>
                                        <div style="display: block;margin-bottom: 10px;">
                                            <p class="pull-left">You've reached <?php echo $total; ?>% of your payment thresholds.</p>
                                            <p class="pull-right">payment thresholds: <i class="fa fa-usd"></i>150</p> <br>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 pad0 text-right">                            
                                            <button class="btn btn-lg btn-default"
                                            <?php if ($total>150){echo 'value="'.$myid.'" data-toggle="modal" data-target="#payment_withdraw"';}else{echo "disabled";} ?> >
                                                Withdraw
                                            </button>
                                        </div>




                                        <div class="modal fade-scale" id="payment_withdraw" data-backdrop="static" data-keyboard="false">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                                                        <h4 class="modal-title">Withdraw</h4>
                                                    </div>
                                                    <div class="modal-body" style="background: #ffffff;padding: 80px 20px;min-height: 200px">

                                                        <div class="form-group">
                                                            <label for="name">Amount</label>
                                                            <input type="text" id="amount_withdraw">
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-default" onclick="amount_withdraw()">Submit</button>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer" style="text-align: right">
                                                        <button type="button" class="btn" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>



                                    <?php }

                               }
                            }


                        ?>


                         
                        

                    </div>




            	</div>

            </div>


        </div>
    </div>
</div>