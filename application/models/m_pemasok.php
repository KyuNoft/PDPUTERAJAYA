<?php
class m_pemasok extends ci_model{

	public function Get(){
		$query = $this->db->order_by('id_pemasok', 'ASC')->get('pemasok');
		return $query->result();
	}

	public function GeneratePK()
    	{    
    		$this->db->select('RIGHT(pemasok.id_pemasok,3) as pk', FALSE);
    		$this->db->order_by('id_pemasok','DESC');    
    		$this->db->limit(1);     
    		$query = $this->db->get('pemasok'); //<-----cek dulu apakah ada sudah ada pk di tabel.    
    		if($query->num_rows() <> 0){       
   			//jika pk ternyata sudah ada.      
    		$data = $query->row();      
    		$pk = intval($data->pk) + 1;     
    	}
    	else{       
    	//jika pk belum ada      
    		$pk = 1;     
    		}
    		$pkmax = str_pad($pk, 3, "0", STR_PAD_LEFT);    
    		$pkjadi = "PM-".$pkmax;     
    	return $pkjadi;  
    	}

	public function Simpan(){
		$data = array(
			'id_pemasok'   => $this->input->post('id_pemasok'),
			'nama_pemasok' => $this->input->post('nama_pemasok'),
			'no_telp'      => $this->input->post('no_telp'),
			'alamat'       => $this->input->post('alamat')
		);
		$this->db->insert('pemasok', $data);
	}

	public function GetUbah($kd){
		$this->db->where('id_pemasok',$kd);
		return $this->db->get('pemasok')->row_array();
	}

	/*public function ErrorUbah(){
		$this->db->where('id_pemasok', $this->input->post('id_pemasok'));
		return $this->db->get('pemasok')->row_array();
	}*/

	public function Ubah(){
		$data = array(
			'id_pemasok'   => $this->input->post('id_pemasok'),
			'nama_pemasok' => $this->input->post('nama_pemasok'),
			'no_telp'      => $this->input->post('no_telp'),
			'alamat'       => $this->input->post('alamat')
		);
		$this->db->where('id_pemasok', $this->input->post('id_pemasok'));
		$this->db->update('pemasok', $data);
	}

	public function Hapus($kd){
		$this->db->where('id_pemasok',$kd);
		$this->db->delete('pemasok');
	}

	public function GetDataPemasok(){
		$query = $this->db->get('pemasok');
		return $query->result_array();
	}
}