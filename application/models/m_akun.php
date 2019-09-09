<?php
class m_akun extends ci_model{

	public function Get(){
		$query = $this->db->order_by('no_akun', 'ASC')->get('akun');
		return $query->result();
	}

	public function Simpan(){
		$data = array(
			'no_akun'   => $this->input->post('no_akun'),
			'nama_akun' => $this->input->post('nama_akun')
		);
		$this->db->insert('akun', $data);
	}

	public function GetUbah($kd){
		$this->db->where('no_akun',$kd);
		return $this->db->get('akun')->row_array();
	}

	public function Ubah(){
		$data = array(
			'no_akun'   => $this->input->post('no_akun'),
			'nama_akun' => $this->input->post('nama_akun')
		);
		$this->db->where('no_akun', $this->input->post('no_akun'));
		$this->db->update('akun', $data);
	}

	public function Hapus($kd){
		$this->db->where('no_akun',$kd);
		$this->db->delete('akun');
	}

	public function GetDataAkun(){
		$query = $this->db->get('akun');
		return $query->result_array();
	}
}