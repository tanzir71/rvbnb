<?php

 class User extends CI_Controller{
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");
		$this->load->library('facebook');//facebook load library


		$admin_user = $this->session->userdata('airbnb');
		$session = $this->session->userdata('session');
		$user = $this->session->userdata('user');
		if(empty($admin_user) || empty($session) || empty($user))
		{	
			redirect('member/adminlogin1');
		}
		$this->load->model('user_model');
	
	}
	public function index(){
		$data['title'] = 'Airrv | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('homes/index');
		$this->load->view('homes/home_page');
		$this->load->view('homes/footer');		 
	}

	function logout()
    {
		$this->session->unset_userdata('airbnb');
		$this->session->unset_userdata('session');
		$this->session->unset_userdata('user');
		// Remove local Facebook session
		$this->facebook->destroy_session();
		// Remove user data from session
		$this->session->unset_userdata('userData'); ///was data

		redirect('user');
	}

	public function profile(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['title'] = 'Profile | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/profile', $data);
		$this->load->view('homes/footer');
	}

	public function become_a_host(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);

		$user_data = $data['user_data'];
		if (empty($user_data->fname) || empty($user_data->lname) || empty($user_data->phone) || empty($user_data->email)) {
			$data['title'] = 'Become a Host | On-demand parking for your RV.';
			$this->load->view('homes/header',$data);

			$this->load->view('user/become_a_host', $data);
			$this->load->view('homes/footer');
		}else{
			$host_ch = $this->user_model->host_data_check($this->session->userdata('airbnb'),$this->session->userdata('session'));
            if ($host_ch == FALSE) {

            	$host_insert = array(
					'userid' => $this->session->userdata('airbnb'), 
					'session' => $this->session->userdata('session')
				);
				$this->db->insert('host', $host_insert);
				if ($this->db->affected_rows()>0) {
					redirect('user/become_a_host_location');
				}
            }else{
            	redirect('user/become_a_host_location');
            }


			
		}
	}
	public function become_a_host_location(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['host_data'] = $this->user_model->host_data_check($this->session->userdata('airbnb'),$this->session->userdata('session'));

		if ($data['host_data'] == FALSE) {
			redirect('user/become_a_host');
		}else{

			$data['title'] = 'Become a Host | On-demand parking for your RV.';
			$this->load->view('homes/header',$data);

			$this->load->view('user/become_a_host_location', $data);
			$this->load->view('homes/footer');
		}
	}
	public function become_a_host_info(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['host_data'] = $this->user_model->host_data_check($this->session->userdata('airbnb'),$this->session->userdata('session'));

		if ($data['host_data'] == FALSE) {
			redirect('user/become_a_host');
		}else{

			$data['title'] = 'Host Information | On-demand parking for your RV.';
			$this->load->view('homes/header',$data);

			$this->load->view('user/become_a_host_info', $data);
			$this->load->view('homes/footer');
		}
	}
	public function become_a_host_review(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['host_data'] = $this->user_model->host_data_check($this->session->userdata('airbnb'),$this->session->userdata('session'));

		if ($data['host_data'] == FALSE) {
			redirect('user/become_a_host');
		}else{

			$data['title'] = 'Host Review | On-demand parking for your RV.';
			$this->load->view('homes/header',$data);

			$this->load->view('user/become_a_host_review', $data);
			$this->load->view('homes/footer');
		}
	}



	public function host_step_one(){
		$this->load->library('form_validation');      
        $this->form_validation->set_rules('id',  'id',  'required');
        $this->form_validation->set_rules('fname',  'fname',  'required');
        $this->form_validation->set_rules('lname',  'lname',  'required');
        $this->form_validation->set_rules('email',  'email',  'required');
        $this->form_validation->set_rules('phone',  'phone',  'required');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('user/become_a_host');
		}else{

			$id = $this->input->post('id');
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');

			if (empty($fname) || empty($lname) || empty($email) || empty($phone)) {
				redirect('user/become_a_host');
			}else{
				$up_user = array(
					'fname' => $fname, 
					'lname' => $lname, 
					'email' => $email, 
					'phone' => $phone 
				);
				$this->db->where('id', $id);
				$this->db->update('alluser', $up_user);



				$host_insert = array(
					'userid' => $this->session->userdata('airbnb'), 
					'session' => $this->session->userdata('session')
				);
				$this->db->insert('host', $host_insert);
				if ($this->db->affected_rows()>0) {
					redirect('user/become_a_host_location');
				}else{
					redirect('user/become_a_host');
					//$this->session->userdata('session')
				}
				
			}
		}
	}

	public function host_step_two(){
		$this->load->library('form_validation');
        $this->form_validation->set_rules('host_id',  'host_id',  'required');
        $this->form_validation->set_rules('country',  'country',  'required');
        $this->form_validation->set_rules('state',  'state',  'required');
        $this->form_validation->set_rules('city',  'city',  'required');
        $this->form_validation->set_rules('lat',  'lat',  'required');
        $this->form_validation->set_rules('lng',  'lng',  'required');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('user/become_a_host_location');
		}else{

			$id = $this->session->userdata('airbnb');
			$lat = $this->input->post('lat');
			$lng = $this->input->post('lng');

			$country = $this->input->post('country');
			$host_id = $this->input->post('host_id');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$street = $this->input->post('street');
			$borough = $this->input->post('borough');
			$location = $this->input->post('location');
			$zip = $this->input->post('zip');

			if (empty($id) || empty($country)) {
				redirect('user/become_a_host_location');
			}else{
				$update_host = array(
					'lat' => $lat, 
					'country' => $country, 
					'lng' => $lng, 
					'state' => $state, 
					'street' => $street, 
					'city' => $city, 
					'borough' => $borough,
					'location' => $location,
					'zip' => $zip 
				);
				$this->db->where('id', $host_id);
				$this->db->where('userid', $this->session->userdata('airbnb'));
				$this->db->where('session', $this->session->userdata('session'));
				$this->db->update('host', $update_host);
				redirect('user/become_a_host_info');
			}
		}
	}


	public function host_information_setup(){

		$userid = $this->session->userdata('airbnb');
		$hostid = $this->input->post('hostid');

		$title = $this->input->post('title');
		$amount = $this->input->post('amount');
		$rv_sizes = $this->input->post('rv_sizes');

		$rv_types = $this->input->post('rv_types');

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$editor1 = $this->input->post('editor1');


		if (empty($hostid)) {
			redirect('user/become_a_host_info');
		}else{


			$data = array();
			if($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])){
				$filesCount = count($_FILES['userFiles']['name']);
				for($i = 0; $i < $filesCount; $i++){
					$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
					$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
					$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
					$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
					$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

					$uploadPath = 'assets/images/hosts/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '300px';
					//$config['max_width'] = '1024';
					//$config['max_height'] = '768';
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($this->upload->do_upload('userFile')){


						$fileData = $this->upload->data();
						$uploadData[$i]['file_name'] = $fileData['file_name'];
						$uploadData[$i]['created'] = date("Y-m-d H:i:s");
						$uploadData[$i]['userid'] = $userid;
						$uploadData[$i]['hostid'] = $hostid;


					}
				}
				if(!empty($uploadData)){
					//Insert files data into the database
					$insert = $this->user_model->insert($uploadData);
				} //images end

				


				$update_host_info = array(
					'title' => $title, 
					'amount' => $amount, 
					'rv_sizes' => $rv_sizes, 
					'rv_types' => $rv_types, 
					'from_date' => $from_date, 
					'to_date' => $to_date,
					'description' => $editor1 
				);
				$this->db->where('id', $hostid);
				$this->db->where('userid', $this->session->userdata('airbnb'));
				$this->db->where('session', $this->session->userdata('session'));
				$this->db->update('host',$update_host_info);
				if ($this->db->affected_rows()>0) {
					redirect('user/become_a_host_review');
				}else{
					redirect('user/become_a_host_info');
				}



			}


			
		}


	}

	public function change_profile_picture(){
		$this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $id = $this->session->userdata('airbnb');
        //$imag = $this->input->post('userfile');

        $this->db->where('id',$id);
        $query = $this->db->get('alluser');
        if ($query->num_rows()>0) {
        	$data = $query->row();
        	$images = $data->images;

        	if (!empty($images)) {
        		unlink('assets/images/profile/'.$images);
        	} //folder image delete

	        $config = array(
	        'upload_path' => 'assets/images/profile/', 
	        'allowed_types' => "gif|jpg|png|jpeg",
	        'overwrite' => TRUE,
	        //'max_size' => "2048000", 
	        //'max_height' => "768",
	        //'max_width' => "1024"
	        );
	        $this->load->library('upload', $config);
	        if(!$this->upload->do_upload('userpic'))
	        { 
	            $data['imageError'] =  $this->upload->display_errors();

	        }
	        else
	        {
	            $imageDetailArray = $this->upload->data();
	            $image =  $imageDetailArray['file_name'];

	            $image_up=array(
	                'images' => $image
	            );
	            $this->db->where('id',$id);
	            $this->db->update('alluser',$image_up);
	            redirect('user/profile');
	        }
        }
	}

	public function password_change(){
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$confirm_pass = $this->input->post('confirm_pass');

		$id = $this->session->userdata('airbnb');
		$this->db->where('id',$id);
        $query = $this->db->get('alluser');
        if ($query->num_rows()>0) {
        	$data = $query->row();
        	$password = $data->password;

        	if ($password == $old_pass && empty($data->oauth_provider) && $new_pass == $confirm_pass) {
        		$change_pass=array(
	                'password' => $new_pass
	            );
	            $this->db->where('id',$id);
	            $this->db->update('alluser',$change_pass);
	            if ($this->db->affected_rows()>0) {
	            	$msg['success'] = 'Password Change successfully.';
	            }
	            else{
	        		$msg['try_new'] = 'Type new password and try again!';
	        	}
        	}else{
        		$msg['mismatch'] = 'Old Password not matched !';
        	}
        }
        echo json_encode($msg);

	}

	public function host_image_delete(){
		$data = $this->input->post('all_id');
		$all_id = explode(':', $data);
		$id = $all_id['0'];
		$userid = $all_id['1'];
		$hostid = $all_id['2'];


		$this->db->where('id', $id);
		$this->db->where('hostid', $hostid);
		$images_data = $this->db->get('files');

		if ($images_data->num_rows()>0) {
			$image_datas = $images_data->row();
			$image = $image_datas->file_name;

			unlink('assets/images/hosts/'.$image);

			$this->db->where('id', $id);
			$this->db->where('hostid', $hostid);
	        $this->db->where('userid', $userid);
	        $this->db->delete('files');
	        if ($this->db->affected_rows()>0) {
	        	$msg = 'deleted successfully';
	        }else{
	        	$msg = 'deleted failed';
	        }
	    }
        echo json_encode($msg);
	}


	public function host_submit(){


		$userLogid = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($userLogid);

		$data['title'] = 'Host Published | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);



		$this->load->library('form_validation');
        $this->form_validation->set_rules('published_check',  'published_check',  'required');
        $this->form_validation->set_rules('id',  'id',  'required');
        if ($this->form_validation->run() === FALSE)
		{
			$data['error'] = 'Host not Published. Please, check all fields!';
		}else{

			$reviews = $this->input->post('published_check');
			$id = $this->input->post('id');

			if (empty($reviews)) {
				$data['error'] = 'Host not Published. Please, check all fields!';
			}else{
				$this->db->where('id', $id);
				$this->db->where('userid', $this->session->userdata('airbnb'));
				$this->db->where('session', $this->session->userdata('session'));
				$query = $this->db->get('host');
				if ($query->num_rows()>0) {
					$hDdata = $query->row();

					if (empty($hDdata->id) || empty($hDdata->userid) || empty($hDdata->session) || empty($hDdata->title) || empty($hDdata->state) || empty($hDdata->city)|| empty($hDdata->location) || empty($hDdata->zip) || empty($hDdata->country) || empty($hDdata->amount) || empty($hDdata->rv_sizes) || empty($hDdata->rv_types)) {
						$data['error'] = 'Host not Published. Please, check all fields!';
					}else{
						$submit = array('reviews' => $reviews );

						$this->db->where('id', $id);
						$this->db->where('userid', $this->session->userdata('airbnb'));
						$this->db->where('session', $this->session->userdata('session'));
						$this->db->update('host',$submit);
						if ($this->db->affected_rows()>0) {
							$data['success'] = 'Host Reviewed Successfully.';
						}else{
							$data['error'] = 'Host not Review. Please, check some errors!';
						}
					}
				}
			}

			
		}

		$this->load->view('user/host_published', $data);
		$this->load->view('homes/footer');
	}






	//profile working
	public function update_profile($val){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['title'] = 'Update Profile | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$data['all_up'] = $val;

		$this->load->view('user/update_profile', $data);
		$this->load->view('homes/footer');
	}


	public function update_profile_submit(){
		$this->load->library('form_validation');
        $this->form_validation->set_rules('fname',  'fname',  'trim');
        $this->form_validation->set_rules('lname',  'lname',  'trim');
        $this->form_validation->set_rules('gender',  'gender',  'trim');
        $this->form_validation->set_rules('from_date',  'from_date',  'trim');
        $this->form_validation->set_rules('email',  'email',  'trim');
        $this->form_validation->set_rules('phone',  'phone',  'trim');
        $this->form_validation->set_rules('location',  'location',  'trim');
        $this->form_validation->set_rules('yourself',  'yourself',  'trim');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('user/become_a_host_location');
		}else{

			$id = $this->session->userdata('airbnb');

			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$gender = $this->input->post('gender');
			$birthday = $this->input->post('from_date');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$live = $this->input->post('location');
			$yourself = $this->input->post('yourself');

			if (empty($id)) {
				redirect('user/update_profile');
			}else{
				$update_user = array(
					'fname' => $fname, 
					'lname' => $lname, 
					'gender' => $gender, 
					'birthday' => $birthday,
					'email' => $email,
					'phone' => $phone, 
					'live' => $live, 
					'yourself' => $yourself 
				);
				$this->db->where('id', $this->session->userdata('airbnb'));
				$this->db->update('alluser', $update_user);
				redirect('user/profile');
			}
		}
	}



	//parking by home page

	public function park_now(){

		$id = $this->input->post('id');

		$host_c_id = $this->input->post('c_id');
		$m_id = $this->session->userdata('airbnb');

		$from_date = strtotime($this->input->post('from_date'));
		$to_date = strtotime($this->input->post('to_date'));


		$host_data = $this->user_model->get_host($id);
		if ($host_data->num_rows()>0) {
			$host_info = $host_data->row();

			$host_from = strtotime($host_info->from_date);
			$host_to = strtotime($host_info->to_date);


			if ($host_from <= $from_date && $to_date <= $host_to && $from_date <= $host_to && $from_date <= $to_date) {
				if ($m_id == $host_c_id) {
					$data = 3;
				}else{
					$data =  1;
				}
			}else{
				$data =  2;
			}
		}


		echo json_encode($data);
	}


	public function booking($id,$from_date,$m_id,$to_date){

		$data['hostid'] = $id;
		$data['m_id'] = $m_id;
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;

		$data['title'] = 'Booking | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/booking', $data);
		$this->load->view('homes/footer');
	}


	public function hosting_history(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['host_history'] = $this->user_model->host_history($id);
		$data['title'] = 'Hosting History | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/hosting_history', $data);
		$this->load->view('homes/footer');
	}

	public function review_submit(){
		$r_id = $this->session->userdata('airbnb');

		$star = $this->input->post('rating');
		$title = $this->input->post('title');
		$comments = $this->input->post('comments');

		$hostid = $this->input->post('hostid');
		$userid = $this->input->post('userid');


		$this->db->where('r_id',$r_id);
		$this->db->where('hostid',$hostid);
		$this->db->where('userid',$userid);
		$query = $this->db->get('reviews');
		if ($query->num_rows()>0) {
			$msg = 3;
		}else{

			$this->db->where('id',$hostid);
			$this->db->where('userid',$userid);
			$query = $this->db->get('host');
			if ($query->num_rows()>0) {

				$insert = array(
					'hostid' => $hostid, 
					'userid' => $userid, 
					'r_id' => $r_id, 
					'star' => $star, 
					'title' => $title,
					'comment' => $comments 
				);

				$this->db->insert('reviews',$insert);
				if ($this->db->affected_rows()>0) {
					$msg = 1;
				}
			}else{
				$msg = 2;
			}

		}

		echo json_encode($msg);
	}


	public function chat_list(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['admin_inbox'] = $this->user_model->user_inbox_list($id);
		$data['user_inbox_list_sender'] = $this->user_model->user_inbox_list_sender($id);
		$data['admin_user_inbox'] = $this->user_model->admin_user_inbox($id);
		$data['title'] = 'Messaging | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/chat_list', $data);
		$this->load->view('homes/footer');
	}

	public function autocomplete_view_email()
	{
		$email=$this->input->post('id');
		$this->db->like('email', $email);
		$this->db->limit(20);
		$info=$this->db->get('alluser');
		if ($info->num_rows()>0) {
			$data=array();
			foreach($info->result_array() as $val)
			{
				array_push($data,$val['email']);
			}
			echo json_encode($data);
		}
	} //all user view

	public function request_inbox(){
		$email = $this->input->post('email');

		$id2 = $this->user_model->find_id_by_email($email);

		$chk = $this->user_model->chk_id_by_email_user($id2);
		if ($chk->num_rows()>0) {
			$result['old'] = 3;
		}else{


			$chk = $this->user_model->chk_id_by_email_user2($id2);
			if ($chk->num_rows()>0) {
				$result['old'] = 3;
			}else{

				$insert_message = array(
					'id1' => $this->session->userdata('airbnb'), 
					'id2' => $id2, 
					'type' => $this->session->userdata('airbnb')
				);
		        $this->db->insert("inbox",$insert_message);
		        if ($this->db->affected_rows()>0) {
		        	$result['success'] = 1;
		        }else{
		        	$result['failed'] = 2;
		        }
		    }

	    }
	    
        echo json_encode($result);
	}

	public function reply_inbox(){
		$all_val = $this->input->post('all_val');
		$explode = explode(':', $all_val);

		$id = $explode[0];
		$id1 = $explode[1];
		$id2 = $explode[2];
		if ($id1 == 0) {
			$result['final'] = $this->user_model->inbox_messege($id);
		}else{
			$result['final'] = $this->user_model->inbox_messege2($id);
		}

		echo json_encode($result);
	}
	public function reply_inbox_sender(){
		$all_val = $this->input->post('all_val');
		$explode = explode(':', $all_val);

		$id = $explode[0];
		$id1 = $explode[1];
		$id2 = $explode[2];

		$result['final'] = $this->user_model->inbox_messege($id);

		echo json_encode($result);
	}

	public function submit_messege(){
		$all_val = $this->input->post('all_val');
		$explode = explode(':', $all_val);

		$id = $explode[0];
		$id1 = $explode[1];
		$id2 = $explode[2];

		$details = $this->input->post('details');

		$insert_message = array(
			'details' => $details,
			'root' => $id, 
			'id1' => $id1, 
			'id2' => $id2, 
			'type' => $id2 
		);
        $this->db->insert("inbox",$insert_message);
        if ($this->db->affected_rows()>0) {
        	if ($id1 == 0) {
				$result['final'] = $this->user_model->inbox_messege($id);
			}else{
				$result['final'] = $this->user_model->inbox_messege2($id);
			}
        }
        echo json_encode($result);
	}


	public function hosting_delete(){
		$id = $this->input->post('val');

		$up_delete = array('status' => 2 );

		$this->db->where('id',$id);
		$this->db->update('host',$up_delete);
		if ($this->db->affected_rows()>0) {
			$msg = 1;
		}else{
			$msg = 2;
		}

		echo json_encode($msg);
	}

	public function confirm_chat_with_admin(){
		$id2 = $this->input->post('all_val');


		$insert = array(
			'id1' => 0, 
			'id2' => $this->session->userdata('airbnb'),
			'type' => $this->session->userdata('airbnb')
		);

		$this->db->insert('inbox',$insert);
		if ($this->db->affected_rows()>0) {
			$msg = 1;
		}else{
			$msg = 2;
		}
		echo json_encode($msg);
	}

	public function submit_messege_sender(){
		$all_val = $this->input->post('all_val');
		$explode = explode(':', $all_val);

		$id = $explode[0];
		$id1 = $explode[1];
		$id2 = $explode[2];

		$details = $this->input->post('details');

		$insert_message = array(
			'details' => $details,
			'root' => $id, 
			'id1' => $id1, 
			'id2' => $id2, 
			'type' => $id1
		);
        $this->db->insert("inbox",$insert_message);
        if ($this->db->affected_rows()>0) {
        	$result['final'] = $this->user_model->inbox_messege($id);
        }
        echo json_encode($result);
	}
	public function confirm_chat_with_this_user(){
		$id2 = $this->input->post('all_val');


		$insert = array(
			'id1' => $this->session->userdata('airbnb'), 
			'id2' => $id2,
			'type' => $this->session->userdata('airbnb')
		);

		$this->db->insert('inbox',$insert);
		if ($this->db->affected_rows()>0) {
			$msg = 1;
		}else{
			$msg = 2;
		}
		echo json_encode($msg);
	}


	public function edit_hosting(){
		$id = $this->input->post('id');
		$userid = $this->session->userdata('airbnb');
		$session = $this->session->userdata('session');


		$update_session = array(
			'session' => $session,
			'status' => 0,
			'reviews' => 0
		);

		$this->db->where('id',$id);
		$this->db->where('userid',$userid);
		$query = $this->db->update('host',$update_session);
		if ($query) {
			$msg = 1;
		}else{
			$msg = 2;
		}
		echo json_encode($msg);
	} //editing and updating complete.




	public function payment(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['title'] = 'Payment | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/payment', $data);
		$this->load->view('homes/footer');
	}

	public function payment_overview(){
		$data['title'] = 'Payment | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/payment_overview',$data);
		$this->load->view('homes/footer');
	}


	public function active_booking(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['title'] = 'Active Booking | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/active_booking', $data);
		$this->load->view('homes/footer');
	}

	public function booking_history(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['title'] = 'Booking History | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/booking_history', $data);
		$this->load->view('homes/footer');
	}

	public function transaction_hostory(){
		$id = $this->session->userdata('airbnb');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['title'] = 'Transaction History | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/transaction_hostory', $data);
		$this->load->view('homes/footer');
	}

	public function amount_withdraw(){
		$id = $this->session->userdata('airbnb');
		$amount = $this->input->post('amount')*100;


		$insert_with = array(
			'm_userid' => $id, 
			'status' => 4, 
			'total' => $amount 
		);

		$this->db->insert('payments',$insert_with);
		if ($this->db->affected_rows()>0) {
			$msg= 1;
		}else{
			$msg = 2;
		}
		echo json_encode($msg);

	}
	public function remove_review(){
		$review_id = $this->input->post('all_id');

		$this->db->where('id',$review_id);
		$this->db->delete('reviews');
		if ($this->db->affected_rows()>0) {
			$msg = 1;
		}else{
			$msg = 2;
		}
		echo json_encode($msg);

	}

	


}
?>