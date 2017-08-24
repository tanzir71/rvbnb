<div id="page-wrapper">
	<div class="container-fluid">
				
		<div class="row" style="margin-top: 20px">
				
				
			<div class="col-lg-12">

				<div class="panel panel-default">
				 
				    <div class="panel-body">
	                        <div class="form-group col-sm-4">
	                        	<label for="name">Email</label>
	                        	<input type="email" class="form-control" name="email" id="auto_email" autofocus="1">
	                        </div>

	                        <div class="form-group col-sm-2">
	                        	<button class="btn btn-primary" onclick="request_inbox()" style="margin-top: 25px">Request</button>
	                        </div>

	                    </form>
                    </div>
                </div>
				
				<div class="panel panel-default">
				    <div class="panel-body">

						<div role="tabpanel">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#inbox" aria-controls="home" role="tab" data-toggle="tab">Inbox</a>
								</li>
							</ul>
						
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="inbox">
									<?php if ($admin_inbox->num_rows()>0) { ?>
									<div class="table-responsive">
										<table class="table table-striped">
											<thead>
												<tr>
													<th>ID</th>
													<th>Name</th>
													<th>Email</th>
													<th>Reply</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($admin_inbox->result_array() as $value) {
													$this->db->where('id',$value['id2']);
													$this->db->where('status',1);
													$query=$this->db->get('alluser');
													if ($query->num_rows()>0) {
													$user_row=$query->row();
												?>
													<tr>
														<td><?php echo $value['id']; ?></td>
														<td>
															<a href="<?php echo base_url() ?>admin/user_details/<?php echo $user_row->id; ?>" target="_blank"><?php echo $user_row->fname.' '.$user_row->lname; ?></a>
														<td><?php echo $user_row->email; ?></td>
														
														<td>
															<button type="button" value="<?php echo $value['id'].':0'.':'.$value['id2']; ?>" class="btn btn-primary btn-sm" onclick="reply_inbox(this)" data-toggle="modal" data-target="#replay_message">Reply</button>
														</td>
													</tr>
												<?php }} ?>
											</tbody>
										</table>
									</div>
									<?php } ?>
								</div>
							</div>
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
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="send_button"  onclick="submit_messege(this)">Send</button>
			</div>

        </div>
    </div>
</div>