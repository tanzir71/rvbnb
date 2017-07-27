<?php
class Member extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
		$this->load->library('email');

	}

	
	
	function adminlogin()
	{
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->helper('form');
		$this->load->library('form_validation');      
        $this->form_validation->set_rules('name',  'name',  'required');
        $this->form_validation->set_rules('password',  'Password',  'required|min_length[1]');
        if ($this->form_validation->run() === FALSE)
		{
			redirect('home');
		}
		else
		{
			$this->load->database();			
				
			$data = array(
			'name' => $this->input->post('name'),
			'pass' => $this->input->post('password'),
			);
	
			$this->db->where('user', $data['name']);
			$query = $this->db->get("alluser");
			$row = $query->row();
	
	
	 		if($row->password == $data['pass'])
			{
				$this->session->set_userdata('admin', $row->id);
				
				session_start();
				$session_id = session_id( );
				
				$da=array(
					"session" => $session_id
				);
										
				
				$this->db->where('id',$row->id);
				$this->db->update('alluser',$da);

				redirect('admin');
			
			}


			else{

				redirect('admin');
			} 
		}
	}
	





}