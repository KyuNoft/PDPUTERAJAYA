<?php
class Barang extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Pemilik"){
			redirect('Login');
		}
	}

    // Master Data Barang//

	public function index(){
		$data['barang'] = $this->m_barang->Get();
		$data['pk']     = $this->m_barang->GeneratePK();
		$this->template->load('template', 'v_barang', $data);
	}

	public function Tambah(){
		$config = array(
			/*array(
				'field'  => 'kd_barang',
				'label'  => 'ID Barang',
				'rules'  => 'required|min_length[6]|max_length[6]|is_unique[barang.kd_barang]',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s Hanya 6 angka dan huruf',
					'max_length' => '%s Hanya 6 angka dan huruf',
					'is_unique'  => "".$_POST['kd_barang']." sudah terdafar di database")
			),*/
			array(
				'field'  => 'nama_barang',
				'label'  => 'Nama Barang',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Tidak boleh Kosong')
			),
			array(
				'field'  => 'harga',
				'label'  => 'Harga',
				'rules'  => 'required|numeric|is_natural_no_zero',
				'errors' => array(
					'required'           => '%s Tidak boleh Kosong',
					'numeric'            => '%s Hanya boleh berisi Angka 1-9',
					'is_natural_no_zero' => '%s Tidak boleh Minus')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$alert["alert"] = "Gagal";
			$this->session->set_userdata($alert);
			$this->index();
		}else{
			$this->m_barang->Simpan();
			$alert["alert"] = "Sukses";
			$this->session->set_userdata($alert);
			redirect('Barang');
		}
	}

	/*public function GetUbahBarang(){
		$id = $this->uri->segment(3);
		$data['barang'] = $this->m_barang->GetUbah($id);
		$this->template->load('template', 'u_barang', $data);
	}*/

	public function Ubah(){
	$config = array(
			array(
				'field'  => 'nama_barang',
				'label'  => 'Nama Barang',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Tidak boleh Kosong')
			),
			array(
				'field'  => 'harga',
				'label'  => 'Harga',
				'rules'  => 'required|numeric|is_natural_no_zero',
				'errors' => array(
					'required'           => '%s Tidak boleh Kosong',
					'numeric'            => '%s Hanya boleh berisi Angka 1-9',
					'is_natural_no_zero' => '%s Tidak boleh Minus')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$data['barang'] = $this->m_barang->Get();
			$data['pk']     = $this->m_barang->GeneratePK();
			//$data['barang'] = $this->m_barang->ErrorUbah();
			$alert["alert"] = "Gagal";
			$this->session->set_userdata($alert);
			$this->template->load('template', 'v_barang', $data);
		}else{
			$this->m_barang->Ubah();
			$alert["alert"] = "Sukses";
			$this->session->set_userdata($alert);
			redirect('Barang');
		}
	}

	public function Hapus(){
		$id = $this->uri->segment(3);
		$this->m_barang->Hapus($id);
		redirect('Barang');
	}
}