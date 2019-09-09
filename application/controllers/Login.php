<?php 
class Login extends CI_Controller{
 
	function index(){
		$this->load->view('login');
	}

	public function cek(){
		$cek = $this->m_login->cek();
		if($cek != 0){
			$login['akses'] = 'Pemilik';
			$this->session->set_userdata($login);

			$akses = $this->session->userdata('akses');
			redirect('Barang');
		}else{
			$data['error'] = 'Password yang anda masukkan salah';
			$this->load->view('login', $data);
		}
	}	

	public function Logout(){
		$this->session->sess_destroy();
		redirect('Login');
	}
}