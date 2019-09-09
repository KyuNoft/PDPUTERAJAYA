<?php 
class m_login extends CI_Model{	

	function cek(){
		$this->db->where('password', md5($this->input->post('password')));
		return $this->db->get('account')->num_rows();
	}
}