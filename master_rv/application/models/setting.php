<?php

class Setting extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}
	public function getWare($table,$col,$asc,$check=null){
		
		
		$wire = $this->session->userdata('wire');
		$type=$this->session->userdata('type');
			
			if(!empty($wire))
				$this->db->where('id',$wire);
		
		$this->db->order_by($col,$asc);
		$info=$this->db->get($table);
		
		return $info->result_array();
		
	}
	public function getWireList($table,$col,$asc,$check=null){
		
		$this->db->where('ch !=',0);
		$this->db->order_by($col,$asc);
		$info=$this->db->get($table);
		
		return $info->result_array();
		
	}
	public function getAll($table,$col=null,$val=null){
	
		$w = $this->session->userdata('wire');
				
		if(!empty($w) && $table != 'setting')
			$this->db->where('ware',$w);
		
		$this->db->order_by('id','DESC');

		if(!empty($col))
		$this->db->where($col,$val);

		$info=$this->db->get($table);
		return $info->result_array();
	} //need for create a user











	public function anyName($table,$col,$id,$name,$col2=null,$id2=null,$col3=null,$id3=null){
		
		$w = $this->session->userdata('wire');
		
		
		if(!empty($col2)){
			
			$this->db->where($col2,$id2);	

		}
		if(!empty($col3)){
			
			$this->db->where($col3,$id3);	

		}
		
		$this->db->where("(ware='".$w."')");


		$this->db->where($col,$id);
		$info=$this->db->get($table);
		if ($info->num_rows()>0) {
			foreach($info->result_array() as $val){				
				return $val[$name];				
			}
		}
	}




	//my query
	
	public function getAll_data($table){
		$this->db->order_by('id','desc');
		$info=$this->db->get($table);
		return $info->result_array();
	} 





	

}
?>