<?php
class m_laporan extends ci_model{

	public function GetJurnal(){
		if(isset($_POST['tgl_awal'], $_POST['tgl_akhir'])){
			$this->db->where('tanggal_jurnal >=', $_POST['tgl_awal']);
			$this->db->where('tanggal_jurnal <=', $_POST['tgl_akhir']);
		}
		$this->db->select('j.no, a.no_akun, a.nama_akun, j.tanggal_jurnal, j.posisi, j.nominal');
		$this->db->from('jurnal j');
		$this->db->join('akun a', 'a.no_akun = j.no_akun');
		$this->db->order_by('no');
		return $this->db->get()->result_array();
	}

	public function GetJurnalAll(){
		$this->db->select('j.no, a.no_akun, a.nama_akun, j.tanggal_jurnal, j.posisi, j.nominal');
		$this->db->from('jurnal j');
		$this->db->join('akun a', 'a.no_akun = j.no_akun');
		$this->db->order_by('no');
		return $this->db->get()->result_array();
	}
	
	public function GetSaldoAkun($no_akun){
		$this->db->where('no_akun', $no_akun);
		return $this->db->get('akun')->row_array();
	}
	
	public function GetDataJurnal($no_akun){
		$this->db->where('a.no_akun', $no_akun);
		$this->db->select('a.no_akun, j.tanggal_jurnal, a.nama_akun, j.posisi, j.nominal');
		$this->db->from('jurnal j');
		$this->db->join('akun a', 'a.no_akun = j.no_akun');
		$this->db->order_by('no');
		return $this->db->get()->result_array();

	}
}