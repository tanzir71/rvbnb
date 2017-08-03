<?php

class Facebook extends CI_Controller{

	private $fb;
	 
	public function __construct()
	{
		parent::__construct();
		$this->load->library('facebooksdk');
		$this->fb = $this->facebooksdk;
	
	}

	public function login(){
		$cb = "http://localhost/rv/facebook/callback";
		$url = $this->fb->getLoginUrl($cb);
		echo "<a href='$url'>Login with Facebook</a>";
	}

	public function callback(){
		$act = $this->fb->getAccessToken();
		$data = $this->fb->getUserData($act);
		var_dump($data);
		//print_r($data);

		/*foreach ($data as $value) {
			echo $value.'<br>';
		}*/
	}


}
?>