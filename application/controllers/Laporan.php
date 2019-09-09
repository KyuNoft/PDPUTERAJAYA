<?php
class Laporan extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Pemilik"){
			redirect('Login');
		}
	}

	//Laporan//

	public function Jurnal(){
		if(isset($_POST['print'])) {
			if($_POST['print'] == "printc"){
				if(empty($_POST['tgl_awal']) XOR empty($_POST['tgl_akhir']) AND empty($_POST['tgl_awal']) OR empty($_POST['tgl_akhir'])) {
					redirect('Laporan/Jurnal');
				}else{
					$data['jurnal'] = $this->m_laporan->GetJurnal();
					$this->template->load('template', 'jurnal/v_jurnal_pdf', $data);
				}
			}elseif($_POST['print'] == "printall"){
				$data['jurnal'] = $this->m_laporan->GetJurnalAll();
				$this->template->load('template', 'jurnal/v_jurnal_pdf', $data);
			}
		}else{
			$data['jurnal'] = $this->m_laporan->GetJurnal(); 
			$this->template->load('template', 'jurnal/v_jurnal', $data);
		}
	}
	
	public function BukuBesar(){
		if(isset($_POST['print'])) {
			if(isset($_POST['no_akun'])){
				$no_akun = $this->input->post('no_akun');
			}else{
				redirect('Laporan/BukuBesar');
			}
			$data['akun']     = $this->m_akun->GetDataAkun(); 
			$data['dataakun'] = $this->m_laporan->GetSaldoAkun($no_akun);
			$data['jurnal']   = $this->m_laporan->GetDataJurnal($no_akun); 
			$this->template->load('template', 'buku_besar/v_buku_besar_pdf', $data);
		}elseif(isset($_POST['excel'])) {
			if(isset($_POST['no_akun'])){
				$no_akun = $this->input->post('no_akun');
			}else{
				redirect('Laporan/BukuBesar');
			}
			$data['akun']     = $this->m_akun->GetDataAkun(); 
			$data['dataakun'] = $this->m_laporan->GetSaldoAkun($no_akun);
			$data['jurnal']   = $this->m_laporan->GetDataJurnal($no_akun); 
			$this->load->view('buku_besar/v_buku_besar_excel', $data);
		}else{
			if(empty($_POST['no_akun'])){
				$no_akun = '111';
			}else{
				$no_akun = $this->input->post('no_akun');
			}
			$data['akun']     = $this->m_akun->GetDataAkun(); 
			$data['dataakun'] = $this->m_laporan->GetSaldoAkun($no_akun);
			$data['jurnal']   = $this->m_laporan->GetDataJurnal($no_akun); 
			$this->template->load('template', 'buku_besar/v_buku_besar', $data);
		}
	}

	public function JurnalExcel(){
      	$data['jurnal'] = $this->m_laporan->GetJurnalAll();
      	$this->load->view('jurnal/v_jurnal_excel',$data);
    }
 }