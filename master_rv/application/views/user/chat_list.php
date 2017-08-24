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
            			<h3 class="panel-title"><i class="fa fa-envelope"></i> Sender</h3>
            		</div>
                    <div class="panel-body">
                            <div class="form-group col-sm-4">
                                <label for="name">Email</label>
                                <input type="email" class="form-control" name="email" id="auto_email" autofocus="1"  placeholder="Search email">
                            </div>

                            <div class="form-group col-sm-2">
                                <button class="btn btn-default btn-lg" onclick="request_inbox()" style="margin-top: 30px">Apply</button>
                            </div>

                        </form>
                    </div>
                    <div class="panel-body">
                        <?php if ($user_inbox_list_sender->num_rows()>0) { ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user_inbox_list_sender->result_array() as $value_s) {
                                        if ($value_s['id2'] != 0) {
                                            $this->db->where('id',$value_s['id2']);
                                            $this->db->where('status',1);
                                            $query=$this->db->get('alluser');
                                            if ($query->num_rows()>0) {
                                            $user_row=$query->row();
                                    ?>
                                        <tr>
                                            <td><?php echo $user_row->fname.' '.$user_row->lname; ?></td>
                                            <td><?php echo $user_row->email; ?></td>
                                            
                                            <td>
                                                <button type="button" value="<?php echo $value_s['id'].':'.$this->session->userdata('airbnb').':'.$user_row->id; ?>" class="btn btn-primary btn-sm" onclick="reply_inbox_sender(this)" data-toggle="modal" data-target="#replay_message_sender">Reply</button>
                                            </td>
                                        </tr>
                                    <?php }}} ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } ?>
                    </div>


                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-envelope"></i> Receiver</h3>
                    </div>
                    <div class="panel-body">
                        <?php if ($admin_inbox->num_rows()>0) { ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Reply</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($admin_inbox->result_array() as $value) {
                                        if ($value['id1'] != 0) {
                                            $this->db->where('id',$value['id1']);
                                            $this->db->where('status',1);
                                            $query=$this->db->get('alluser');
                                            $user_row=$query->row();
                                    ?>
                                        <tr>
                                            <td><?php echo $user_row->fname.' '.$user_row->lname; ?></td>
                                            <td><?php echo $user_row->email; ?></td>
                                            
                                            <td>
                                                <button type="button" value="<?php echo $value['id'].':'.$user_row->id.':'.$this->session->userdata('airbnb'); ?>" class="btn btn-primary btn-sm" onclick="reply_inbox(this)" data-toggle="modal" data-target="#replay_message">Reply</button>
                                            </td>
                                        </tr>
                                    <?php }} ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } ?>
                    </div>

                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-envelope"></i> Admin</h3>
                    </div>
                    <div class="panel-body">
                           
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <tbody>

                                            <tr>
                                                <td>Admin</td>
                                                <?php if ($admin_user_inbox->num_rows()>0) { 
                                                    foreach ($admin_user_inbox->result_array() as $values) {
                                                    $this->db->where('id',$values['id2']);
                                                    $this->db->where('status',1);
                                                    $query=$this->db->get('alluser');
                                                    $user_row=$query->row();
                                                ?>
                                                    <td>
                                                        <button type="button" value="<?php echo $values['id'].':0'.':'.$values['id2']; ?>" class="btn btn-primary btn-sm" onclick="reply_inbox(this)" data-toggle="modal" data-target="#replay_message">Reply</button>
                                                    </td>
                                                <?php }}else{ ?>
                                                    <td>
                                                        <button type="button" value="<?php echo $this->session->userdata('airbnb'); ?>" class="btn btn-default btn-sm" onclick="confirm_chat_with_admin(this)">Confirm chat with admin</button>
                                                    </td>
                                                <?php } ?>

                                            </tr>
                                        
                                    </tbody>
                                </table>
                            </div>  
                    </div>

            	</div>

            </div>


        </div>
    </div>
</div>

<div class="modal fade-scale" id="replay_message" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                <h4 class="modal-title text-center">Reply Message</h4>
            </div>
            <div class="modal-body" style="background: #ffffff;">

                <div class="message_body" id="conversation_start">


                </div>
                <div class="message_area">
                    <textarea class="form-control" id="message_body" style="height: 80px !important;background: #eee;" placeholder="type message..."></textarea>
                </div>

            </div>
            <div class="modal-footer" style="text-align: right">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" id="send_button" onclick="submit_messege(this)">Send</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade-scale" id="replay_message_sender" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                <h4 class="modal-title text-center">Reply Message</h4>
            </div>
            <div class="modal-body" style="background: #ffffff;">

                <div class="message_body" id="conversation_start2">


                </div>
                <div class="message_area">
                    <textarea class="form-control" id="message_body2" style="height: 80px !important;background: #eee;" placeholder="type message..."></textarea>
                </div>

            </div>
            <div class="modal-footer" style="text-align: right">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" id="send_button2" onclick="submit_messege_sender(this)">Send</button>
            </div>

        </div>
    </div>
</div>