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
	
	}
	public function index(){

		$data['title'] = 'RVbnb | On-demand parking for your RV.';
		$this->load->view('home/header',$data);

		$this->load->view('home/index');
		$this->load->view('home/home_page');
		$this->load->view('home/footer');		 
	}
	public function location_data(){
		$location = $this->input->post('input_data');
		$from_date = $this->input->post('from');
		$to_date = $this->input->post('to');


		$result['final'] = $this->user_model->anyQueryApply($location,$from_date,$to_date);

		

		echo json_encode($result);
	}

	public function autocomplete_view()
	{		
		
		$this->load->database();	
		
		$id=$this->input->post('id');
		
		$this->db->like('location', $id); 
		$info=$this->db->get('host');

		$data=array();
		foreach($info->result_array() as $val)
		{
			array_push($data,$val['location']);
		}
		echo json_encode($data);	
		
	}


	public function host_rv($id, $title){

		$title = $this->user_model->title_apply($id);

		$data['title'] = $title;

		$data['id'] = $id;
		$data['title'] = $title;

		if ($title=='') {
			redirect('home');
		}else{
			$this->load->view('home/header',$data);
			$this->load->view('home/host_rv',$data);
			$this->load->view('home/footer');		
		}
		 
	}



}
?>