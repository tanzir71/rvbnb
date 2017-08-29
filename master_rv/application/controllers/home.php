<?php

class Home extends CI_Controller{
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library("pagination");

		$this->load->database();
		$this->load->model('user_model');

		// Load facebook library
		$this->load->library('facebook');
		//Load user model
		$this->load->model('user');
	
	}
	public function index(){
		$data['authUrl'] =  $this->facebook->login_url();
		$data['title'] = 'Airrv | On-demand parking for your RV.';
		$this->load->view('homes/header',$data);

		$this->load->view('homes/index');
		$this->load->view('homes/home_page');
		$this->load->view('homes/footer');		 
	}
	public function location_data(){
		$location = $this->input->post('input_data');
		$from_date = $this->input->post('from');


		$result['final'] = $this->user_model->anyQueryApply($location,$from_date);

		

		echo json_encode($result);
	}

	public function autocomplete_view()
	{		
		
		$this->load->database();	
		
		$location=$this->input->post('id');
		
		

		$this->db->like('location', $location);
		$this->db->or_like('country', $location); 
		$this->db->or_like('state', $location); 
		$this->db->or_like('city', $location);


		$this->db->where('reviews', 1);
		$this->db->where('status', 1);

		$this->db->group_by('city','desc'); //last added
		$info=$this->db->get('host');
		if ($info->num_rows()>0) {


			$data=array();
			foreach($info->result_array() as $val)
			{
				array_push($data,$val['city']);
			}
			echo json_encode($data);

			
		}
		
	}


	public function host_rv($id, $title){
		//$sender = $this->session->userdata('airbnb');

		$title = $this->user_model->title_apply($id);

		$data['authUrl'] =  $this->facebook->login_url();
		$data['title'] = $title;

		$data['id'] = $id;
		$data['title'] = $title;

		if ($title=='') {
			redirect('home');
		}else{
			$this->load->view('homes/header',$data);
			$this->load->view('homes/host_rv',$data);
			$this->load->view('homes/footer');		
		}
		 
	}


	public function signup(){

		$this->load->library('form_validation');      
        $this->form_validation->set_rules('name',  'name',  'required');
        $this->form_validation->set_rules('email',  'email',  'required');
        $this->form_validation->set_rules('password',  'Password',  'required|min_length[1]');
        $this->form_validation->set_rules('confirm_password',  'Password',  'required|min_length[1]');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('home');
		}else{

			$name = $this->input->post('name');
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');
			$email = $this->input->post('email');

			if (empty($name) || empty($password) || empty($confirm_password) || empty($email)) {
				redirect('home');
			}else{
				$name_ch = $this->user_model->user_check($name);
				if ($name_ch==0) {
					redirect('home');
				}else{

					if ($password == $confirm_password) {
						$user_add = array(
							'user' => $name, 
							'password' => $confirm_password, 
							'email' => $email, 
							'status' => 1 
						);
						$this->db->insert('alluser', $user_add);
						

						$data = array(
						'name' => $name,
						'pass' => $confirm_password
						);
				
						$this->db->where('user', $data['name']);
						$query = $this->db->get("alluser");
						$row = $query->row();
				
				
				 		if($row->password == $data['pass'])
						{
							$this->session->set_userdata('airbnb', $row->id);
							
							session_start();
							$session_id = session_id( );
							
							$da=array(
								"session" => $session_id
							);
													
							
							$this->db->where('id',$row->id);
							$this->db->update('alluser',$da);

							$this->session->set_userdata('session', $session_id);
							$this->session->set_userdata('user', 'user');

							redirect('user');
						
						}


					}else{
						redirect('user');
					}
				}
			}


		}
	}


	



}
?>