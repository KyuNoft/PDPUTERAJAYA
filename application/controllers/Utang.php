<?php
class Utang extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Pemilik"){
			redirect('Login');
		}
	}

	// Transaksi Pengiriman//

	public function index(){
		$data['utang']     = $this->m_utang->Get();
		//$data['dutang']  = $this->m_utang->GetDetail();
		$this->template->load('template', 'utang/v_utang', $data);
	}

	public function Detail($id){
		$data['detail']    = $this->m_utang->GetDataDetail($id);
		$this->template->load('template', 'utang/v_detail_utang', $data);
	}

	public function Tambah(){
		$data['pk']      = $this->m_utang->GeneratePK();
		$data['pemasok'] = $this->m_pemasok->GetDataPemasok();
		$data['barang']  = $this->m_barang->GetDataBarang();
		$data['detail']  = $this->m_utang->GetDataDetail($data['pk']);
		$this->template->load('template', 'utang/f_utang', $data);
	}

	public function test(){
		$data['pk']      = $this->m_utang->GeneratePK();
		$data['barang']  = $this->m_barang->GetDataBarang();
		$data['tgl']     = $this->m_utang->GetTest();
		$this->template->load('template', 'test', $data);
	}

	public function TambahDetail(){
		$config = array(
			array(
				'field'  => 'jumlah',
				'label'  => 'Jumlah',
				'rules'  => 'required|is_natural_no_zero',
				'errors' => array(
					'required'           => '%s Tidak boleh Kosong',
					'is_natural_no_zero' => '%s Hanya bilangan angka bulat positif')
			)
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>', '</li></div>');
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){
			$alert["alert"] = "Gagal";
			$this->session->set_userdata($alert);
			$this->Tambah();
		}else{
			$alert["alert"] = "Sukses";
			$this->session->set_userdata($alert);
			$this->m_utang->SimpanDetail();
		redirect('Utang/Tambah');
		}
	}

	public function Selesai(){
		$this->m_utang->SelesaiBeli();
		redirect('Utang');
	}

	public function Hitung(){
		$data['pembelian']  = $this->m_utang->GetHitung();
		$this->template->load('template', 'utang/f_hitung_utang', $data);
	}

	public function Lunas(){
		$this->m_utang->Pelunasan();
		redirect('Utang');
	}

	public function UtangPrint(){
		if(isset($_POST['kd_pembelian'])){
			$data['utang'] = $this->m_utang->GetDataUtang();
			$this->template->load('template', 'utang/v_utang_print', $data);
		}else{
			redirect('Utang');
		}
	}

	public function UtangPrintAll(){
			$data['utangL'] = $this->m_utang->GetL();
			$data['utangBL'] = $this->m_utang->GetBL();
			$this->template->load('template', 'utang/v_utang_print_all', $data);;
		}

	public function PengirimanExcel(){
      	$data['pengiriman'] = $this->m_pengiriman->GetPengiriman2();
      	$this->load->view('v_pengiriman_excel',$data);
      }
}