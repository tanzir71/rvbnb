<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
	function __construct() {
		$this->tableName = 'alluser';
		$this->primaryKey = 'id';
	}
	public function checkUser($data = array()){
		$this->db->select($this->primaryKey);
		$this->db->from($this->tableName);
		$this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_uid'=>$data['oauth_uid']));
		$prevQuery = $this->db->get();
		$prevCheck = $prevQuery->num_rows();

		$session_id = session_id(); //my system
		
		if($prevCheck > 0){
			$prevResult = $prevQuery->row_array();
			$data['modified'] = date("Y-m-d H:i:s");
			$data['session'] = $session_id;
			$update = $this->db->update($this->tableName,$data,array('id'=>$prevResult['id']));
			$userID = $prevResult['id'];
		}else{
			$data['created'] = date("Y-m-d H:i:s");
			$data['modified'] = date("Y-m-d H:i:s");
			$data['session'] = $session_id;
			$insert = $this->db->insert($this->tableName,$data);
			$userID = $this->db->insert_id();
		}

		return $userID?$userID:FALSE;
    }
}
