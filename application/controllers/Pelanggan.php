<?php
class Pelanggan extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Pemilik"){
			redirect('Login');
		}
	}

    // Master Data pelanggan//

	public function index(){
		$data['pelanggan'] = $this->m_pelanggan->Get();
		$data['pk']     = $this->m_pelanggan->GeneratePK();
		$this->template->load('template', 'v_pelanggan', $data);
	}

	public function Tambah(){
		$config = array(
			/*array(
				'field'  => 'id_pelanggan',
				'label'  => 'ID Pelanggan',
				'rules'  => 'required|min_length[6]|max_length[6]|is_unique[pelanggan.id_pelanggan]',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s Hanya 6 angka dan huruf',
					'max_length' => '%s Hanya 6 angka dan huruf',
					'is_unique'  => "".$_POST['id_pelanggan']." sudah terdafar di database")
			),*/
			array(
				'field'  => 'nama_pelanggan',
				'label'  => 'Nama Pelanggan',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Tidak boleh Kosong')
			),
			array(
				'field'  => 'no_telp',
				'label'  => 'No Telepon',
				'rules'  => 'required|numeric|min_length[12]|max_length[12]|is_natural_no_zero',
				'errors' => array(
					'required'           => '%s Tidak boleh Kosong',
					'numeric'            => '%s Hanya boleh berisi Angka 1-9',
					'min_length'         => '%s Hanya 12 angka dan huruf',
					'max_length'         => '%s Hanya 12 angka dan huruf',
					'is_natural_no_zero' => '%s Tidak boleh Minus')
			),
			array(
				'field'  => 'alamat',
				'label'  => 'Alamat',
				'rules'  => 'required',
				'errors' => array(
					'required'      => '%s Tidak boleh Kosong')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$alert["alert"] = "Gagal";
			$this->session->set_userdata($alert);
			$this->index();
		}else{
			$this->m_pelanggan->Simpan();
			$alert["alert"] = "Sukses";
			$this->session->set_userdata($alert);
			redirect('Pelanggan');
		}
	}

	/*public function GetUbahpelanggan(){
		$id = $this->uri->segment(3);
		$data['pelanggan'] = $this->m_pelanggan->GetUbah($id);
		$this->template->load('template', 'u_pelanggan', $data);
	}*/

	public function Ubah(){
	$config = array(
			array(
				'field'  => 'nama_pelanggan',
				'label'  => 'Nama Pelanggan',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Tidak boleh Kosong')
			),
			array(
				'field'  => 'no_telp',
				'label'  => 'No Telepon',
				'rules'  => 'required|numeric|min_length[12]|max_length[12]|is_natural_no_zero',
				'errors' => array(
					'required'           => '%s Tidak boleh Kosong',
					'numeric'            => '%s Hanya boleh berisi Angka 1-9',
					'min_length'         => '%s Hanya 12 angka dan huruf',
					'max_length'         => '%s Hanya 12 angka dan huruf',
					'is_natural_no_zero' => '%s Tidak boleh Minus')
			),
			array(
				'field'  => 'alamat',
				'label'  => 'Alamat',
				'rules'  => 'required',
				'errors' => array(
					'required'      => '%s Tidak boleh Kosong')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$data['pelanggan'] = $this->m_pelanggan->Get();
			$data['pk']      = $this->m_pelanggan->GeneratePK();
			//$data['pelanggan'] = $this->m_pelanggan->ErrorUbah();
			$this->session->set_userdata($alert);
			$this->index();
			$this->template->load('template', 'v_pelanggan', $data);
		}else{
			$this->m_pelanggan->Ubah();
			$alert["alert"] = "Sukses";
			$this->session->set_userdata($alert);
			redirect('Pelanggan');
		}
	}

	public function Hapus(){
		$id = $this->uri->segment(3);
		$this->m_pelanggan->Hapus($id);
		redirect('Pelanggan');
	}
}