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
            			<h3 class="panel-title"><i class="fa fa-credit-card-alt"></i> Transaction History</h3>
            		</div>
                    <div class="panel-body">
                        <?php

                            $m_userid = $this->session->userdata('airbnb');
                            $suma =0;

                            $this->db->where('m_userid', $m_userid);
                            $this->db->order_by('id', 'desc');
                            $querys = $this->db->get('payments');
                            if ($querys->num_rows()>0) { ?>

                                <div class="table-responsive">
                                        
                                    <table class="table table-striped" style="margin-bottom: 30px;border:1px solid #ddd">
                                        <thead>
                                            <th>#</th>
                                            <th>Vendor:</th>
                                            <th>Active:</th>
                                            <th class="text-right">Amount:</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sl = 1;
                                            foreach ($querys->result_array() as $values) {
                                                $suma = $suma+$values['total'];
                                            ?>

                                                <tr>
                                                    <td><?php echo $sl++; ?></td>
                                                    <?php 
                                                    $this->db->where('id',$values['hostid']);
                                                    $hs_query = $this->db->get('host');
                                                    $ha_q_wor = $hs_query->row();

                                                    $this->db->where('id',$ha_q_wor->userid);
                                                    $ua_query = $this->db->get('alluser');
                                                    $ua_q_wor = $ua_query->row();
                                                    ?>
                                                        <td><?php echo $ua_q_wor->fname; ?> <?php echo $ua_q_wor->lname; ?></td>


                                                        <td>
                                                            <?php 
                                                                if ($values['payment_status']=='success') {
                                                                    echo 'Active';
                                                                }else{
                                                                    echo "Passed";
                                                                }
                                                            ?>
                                                        </td>


                                                        <td class="text-right"><i class="fa fa-usd"></i><?php echo $values['total']/100; ?></td>
                                                </tr>
                                            <?php }  ?>

                                                <tr>
                                                    <th colspan="3">Total</th>
                                                    <th colspan="2" class="text-right">
                                                        <i class="fa fa-usd"></i><?php echo $suma/100; ?>
                                                    </th>
                                                </tr>
                                        </tbody>
                                    </table>
                                    
                                
                                </div>
                            <?php }else{echo 'No transaction.';}  ?>


                    </div>




            	</div>

            </div>


        </div>
    </div>
</div>