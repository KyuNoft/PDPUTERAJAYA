<?php
class m_pelanggan extends ci_model{

	public function Get(){
		$query = $this->db->order_by('id_pelanggan', 'ASC')->get('pelanggan');
		return $query->result();
	}

	public function GeneratePK()
    	{    
    		$this->db->select('RIGHT(pelanggan.id_pelanggan,3) as pk', FALSE);
    		$this->db->order_by('id_pelanggan','DESC');    
    		$this->db->limit(1);     
    		$query = $this->db->get('pelanggan'); //<-----cek dulu apakah ada sudah ada pk di tabel.    
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
    		$pkjadi = "PL-".$pkmax;     
    	return $pkjadi;  
    	}

	public function Simpan(){
		$data = array(
			'id_pelanggan'   => $this->input->post('id_pelanggan'),
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),
			'no_telp'        => $this->input->post('no_telp'),
			'alamat'         => $this->input->post('alamat')
		);
		$this->db->insert('pelanggan', $data);
	}

	public function GetUbah($kd){
		$this->db->where('id_pelanggan',$kd);
		return $this->db->get('pelanggan')->row_array();
	}

	/*public function ErrorUbah(){
		$this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
		return $this->db->get('pelanggan')->row_array();
	}*/

	public function Ubah(){
		$data = array(
			'id_pelanggan'   => $this->input->post('id_pelanggan'),
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),
			'no_telp'        => $this->input->post('no_telp'),
			'alamat'         => $this->input->post('alamat')
		);
		$this->db->where('id_pelanggan', $this->input->post('id_pelanggan'));
		$this->db->update('pelanggan', $data);
	}

	public function Hapus($kd){
		$this->db->where('id_pelanggan',$kd);
		$this->db->delete('pelanggan');
	}

	public function GetDataPelanggan(){
		$query = $this->db->get('pelanggan');
		return $query->result_array();
	}
}