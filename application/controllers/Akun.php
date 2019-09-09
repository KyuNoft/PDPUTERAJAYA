<?php
class Akun extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Pemilik"){
			redirect('Login');
		}
	}

    // Master Data akun//

	public function index(){
		$data['akun'] = $this->m_akun->Get();
		//$data['pk']     = $this->m_akun->GeneratePK();
		$this->template->load('template', 'v_akun', $data);
	}

	public function Tambah(){
		$config = array(
			array(
				'field'  => 'no_akun',
				'label'  => 'No Akun',
				'rules'  => 'required|min_length[3]|max_length[3]|is_unique[akun.no_akun]',
				'errors' => array(
					'required'   => '%s Tidak boleh Kosong',
					'min_length' => '%s Hanya 3 angka dan huruf',
					'max_length' => '%s Hanya 3 angka dan huruf',
					'is_unique'  => "".$_POST['no_akun']." sudah terdafar di database")
			),
			array(
				'field'  => 'nama_akun',
				'label'  => 'Nama Akun',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Tidak boleh Kosong')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$alert["alert"] = "Gagal";
			$this->session->set_userdata($alert);
			$this->index();
		}else{
			$this->m_akun->Simpan();
			$sess["alert"] = "sukses";
			$this->session->set_userdata($sess);
			redirect('Akun');
		}
	}

	/*public function GetUbahakun(){
		$id = $this->uri->segment(3);
		$data['akun'] = $this->m_akun->GetUbah($id);
		$this->template->load('template', 'u_akun', $data);
	}*/

	public function Ubah(){
	$config = array(
			array(
				'field'  => 'nama_akun',
				'label'  => 'Nama Akun',
				'rules'  => 'required',
				'errors' => array(
					'required' => '%s Tidak boleh Kosong')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>','</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$data['akun'] = $this->m_akun->Get();
			//$data['pk']     = $this->m_akun->GeneratePK();
			//$data['akun'] = $this->m_akun->ErrorUbah();
			$this->session->set_userdata($alert);
			$this->index();
			$this->template->load('template', 'v_akun', $data);
		}else{
			$this->m_akun->Ubah();
			$sess["alert"] = "sukses";
			$this->session->set_userdata($sess);
			redirect('Akun');
		}
	}

	public function Hapus(){
		$id = $this->uri->segment(3);
		$this->m_akun->Hapus($id);
		redirect('Akun');
	}
}