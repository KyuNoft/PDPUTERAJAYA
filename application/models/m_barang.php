<?php
class m_barang extends ci_model{

	public function Get(){
		$query = $this->db->order_by('kd_barang', 'ASC')->get('barang');
		return $query->result();
	}

	public function GeneratePK()
    	{    
    		$this->db->select('RIGHT(barang.kd_barang,3) as pk', FALSE);
    		$this->db->order_by('kd_barang','DESC');    
    		$this->db->limit(1);     
    		$query = $this->db->get('barang'); //<-----cek dulu apakah ada sudah ada pk di tabel.    
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
    		$pkjadi = "BR-".$pkmax;     
    	return $pkjadi;  
    	}

	public function Simpan(){
		$data = array(
			'kd_barang'   => $this->input->post('kd_barang'),
			'nama_barang' => $this->input->post('nama_barang'),
			'harga'       => $this->input->post('harga')
		);
		$this->db->insert('barang', $data);
	}

	public function GetUbah($kd){
		$this->db->where('kd_barang',$kd);
		return $this->db->get('barang')->row_array();
	}

	/*public function ErrorUbah(){
		$this->db->where('kd_barang', $this->input->post('kd_barang'));
		return $this->db->get('barang')->row_array();
	}*/

	public function Ubah(){
		$data = array(
			'kd_barang'   => $this->input->post('kd_barang'),
			'nama_barang' => $this->input->post('nama_barang'),
			'harga'       => $this->input->post('harga')
		);
		$this->db->where('kd_barang', $this->input->post('kd_barang'));
		$this->db->update('barang', $data);
	}

	public function Hapus($kd){
		$this->db->where('kd_barang',$kd);
		$this->db->delete('barang');
	}

	public function GetDataBarang(){
		$query = $this->db->get('barang');
		return $query->result_array();
	}
}