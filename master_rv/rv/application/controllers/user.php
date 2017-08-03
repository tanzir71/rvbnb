<?php

 class User extends CI_Controller{
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");
		$this->load->library('facebook');//facebook load


		$admin_user = $this->session->userdata('admin');
		if(empty($admin_user))
		{	
			redirect('member/adminlogin1');
		}
		$this->load->model('user_model');
	
	}
	public function index(){
		$data['title'] = 'RVbnb | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('homes/index');
		$this->load->view('homes/home_page');
		$this->load->view('homes/footer');		 
	}

	function logout()
    {
		$this->session->unset_userdata('admin');
		// Remove local Facebook session
		$this->facebook->destroy_session();
		// Remove user data from session
		$this->session->unset_userdata('userData'); ///was data

		redirect('user');
	}

	public function profile(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['title'] = 'Profile | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/profile', $data);
		$this->load->view('homes/footer');
	}

	public function become_a_host(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);

		$data['title'] = 'Become a Host | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('user/become_a_host', $data);
		$this->load->view('homes/footer');

		
	}
	public function become_a_host_location(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['host_data'] = $this->user_model->host_data_check($this->session->userdata('admin'),$this->session->userdata('session'));

		if ($data['host_data'] == FALSE) {
			redirect('user/become_a_host');
		}else{

			$data['title'] = 'Become a Host Location | On-demand parking for your RV.';
			$this->load->view('homes/header',$data);

			$this->load->view('user/become_a_host_location', $data);
			$this->load->view('homes/footer');
		}
	}
	public function become_a_host_info(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['host_data'] = $this->user_model->host_data_check($this->session->userdata('admin'),$this->session->userdata('session'));

		if ($data['host_data'] == FALSE) {
			redirect('user/become_a_host');
		}else{

			$data['title'] = 'Become a Host Information | On-demand parking for your RV.';
			$this->load->view('homes/header',$data);

			$this->load->view('user/become_a_host_info', $data);
			$this->load->view('homes/footer');
		}
	}
	public function become_a_host_review(){
		$id = $this->session->userdata('admin');
		$data['user_data'] = $this->user_model->user_all_data($id);
		$data['host_data'] = $this->user_model->host_data_check($this->session->userdata('admin'),$this->session->userdata('session'));

		if ($data['host_data'] == FALSE) {
			redirect('user/become_a_host');
		}else{

			$data['title'] = 'Become a Host Review | On-demand parking for your RV.';
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
					'userid' => $this->session->userdata('admin'), 
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
        $this->form_validation->set_rules('borough',  'borough',  'required');
        $this->form_validation->set_rules('zip',  'zip',  'required');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('user/become_a_host_location');
		}else{

			$id = $this->session->userdata('admin');
			$country = $this->input->post('country');
			$host_id = $this->input->post('host_id');
			$state = $this->input->post('state');
			$city = $this->input->post('city');
			$borough = $this->input->post('borough');
			$zip = $this->input->post('zip');

			if (empty($id) || empty($country) || empty($state) || empty($city) || empty($borough) || empty($zip)) {
				redirect('user/become_a_host_location');
			}else{
				$update_host = array(
					'country' => $country, 
					'state' => $state, 
					'city' => $city, 
					'borough' => $borough,
					'zip' => $zip 
				);
				$this->db->where('id', $host_id);
				$this->db->where('userid', $this->session->userdata('admin'));
				$this->db->where('session', $this->session->userdata('session'));
				$this->db->update('host', $update_host);
				redirect('user/become_a_host_info');
			}
		}
	}



}
?>