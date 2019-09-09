<?php
class Piutang extends CI_controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('akses') != "Pemilik"){
			redirect('Login');
		}
	}

	// Transaksi Penjualan Kredit//
	public function index(){
		$data['piutang']     = $this->m_piutang->Get();
		$this->template->load('template', 'piutang/v_piutang', $data);
	}

	public function Detail($id){
		$data['detail']    = $this->m_piutang->GetDataDetail($id);
		$this->template->load('template', 'piutang/v_detail_piutang', $data);
	}

	public function Tambah(){
		$data['pk']        = $this->m_piutang->GeneratePK();
		$data['pelanggan'] = $this->m_pelanggan->GetDataPelanggan();
		$data['barang']    = $this->m_barang->GetDataBarang();
		$data['detail']    = $this->m_piutang->GetDataDetail($data['pk']);
		$this->template->load('template', 'piutang/f_piutang', $data);
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
			$this->m_piutang->SimpanDetail();
		redirect('Piutang/Tambah');
		}
	}

	public function Selesai(){
		$this->m_piutang->SelesaiJual();
		redirect('Piutang');
	}

	public function Lunas($kd, $total){
		$this->m_piutang->Pelunasan($kd, $total);
		redirect('Piutang');
	}

	public function PiutangPrint(){
		if(isset($_POST['kd_penjualan'])){
			$data['piutang'] = $this->m_piutang->GetDataPiutang();
			$this->template->load('template', 'piutang/v_piutang_print', $data);
		}else{
			redirect('Piutang');
		}
	}

	public function PiutangPrintAll(){
			$data['piutangL'] = $this->m_piutang->GetL();
			$data['piutangBL'] = $this->m_piutang->GetBL();
			$this->template->load('template', 'piutang/v_piutang_print_all', $data);;
		}

	public function PengirimanExcel(){
      	$data['pengiriman'] = $this->m_pengiriman->GetPengiriman2();
      	$this->load->view('v_pengiriman_excel',$data);
      }
}