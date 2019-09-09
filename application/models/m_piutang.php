<?php
class m_piutang extends ci_model{

	public function Get(){
		$this->db->select('penjk.kd_penjualan, penjk.tanggal_penjualan, penjk.total, penjk.status, penjk.tanggal_pelunasan, pgn.nama_pelanggan');
		$this->db->from('penjualan_kredit penjk');
		$this->db->join('pelanggan pgn', 'pgn.id_pelanggan = penjk.id_pelanggan');
		return $this->db->get()->result_array();
	}

	public function GeneratePK(){
	    //Kode penjualan otomatis
		$this->db->select('RIGHT(kd_penjualan,3) as pk', FALSE);
		$this->db->order_by('kd_penjualan','DESC');    
		$this->db->limit(1);
		$query = $this->db->get('penjualan_kredit');
		//Cek pk sudah ada tau belum
		if($query->num_rows() != 0){
		    //jika pk ternyata sudah ada
		    $data = $query->row();
		    $pk = intval($data->pk) + 1;
		}else{       
		    //jika pk belum ada
		    $pk = 1;
		}
		$pkmax = str_pad($pk, 3, "0", STR_PAD_LEFT);
		$pkjadi = "PJ-".$pkmax;

    	//Pembuatan Kode penjualan Baru
		$this->db->where('status', 'BS');
		$query = $this->db->get('penjualan_kredit');
		if($query->num_rows() == 0){
			$input = array(
				'kd_penjualan'      => $pkjadi,
				'tanggal_penjualan' => '0000-00-00',
				'total'             => 0,
				'status'            => 'BS',
				'tanggal_pelunasan' => '0000-00-00',
				'id_pelanggan'      => 'XXX',
			);
			$this->db->insert('penjualan_kredit', $input);
		}else{
			$pkjadi = $query->row()->kd_penjualan;
		}
		return $pkjadi;
    }

    public function GetDataDetail($kd){
    	$this->db->select('dpenjk.jumlah, dpenjk.subtotal, brg.nama_barang, brg.harga');
    	$this->db->from('detail_penjualan_kredit dpenjk');
    	$this->db->join('barang brg', 'dpenjk.kd_barang = brg.kd_barang');
		$this->db->where('dpenjk.kd_penjualan', $kd);
		return $this->db->get()->result_array();
	}

	public function SimpanDetail(){
    	//Ambil Harga dari Tabel Barang
    	$this->db->where('kd_barang', $this->input->post('kd_barang'));
    	$harga = $this->db->get('barang')->row()->harga;

        //Masukkan ke detail_penjualan_kredit
    	$this->db->where(array('kd_penjualan' => $this->input->post('pk'), 'kd_barang' => $this->input->post('kd_barang')));
    	$query = $this->db->get('detail_penjualan_kredit');
    	if($query->num_rows() == 0){
    		$subtotal = $this->input->post('jumlah') * $harga;
    		$insert = array(
			'kd_penjualan' => $this->input->post('pk'),
			'kd_barang'    => $this->input->post('kd_barang'),
			'jumlah'       => $this->input->post('jumlah'),
			'subtotal'     => $subtotal,
		);
			$this->db->insert('detail_penjualan_kredit', $insert);
		}else{
			$this->db->set('jumlah', "jumlah + ".$this->input->post('jumlah')."", FALSE);
			$this->db->set('subtotal', "subtotal + ".$this->input->post('jumlah') * $harga."", FALSE);
			$this->db->where(array('kd_penjualan' => $this->input->post('pk'), 'kd_barang' => $this->input->post('kd_barang')));
			$this->db->update('detail_penjualan_kredit');
		}
	}

	public function SelesaiJual(){
		//Update Tabel penjualan_kredit
		$this->db->set('tanggal_penjualan', date('y-m-d'));
		$this->db->set('total', $this->input->post('total'));
		$this->db->set('status', 'BL');
		$this->db->set('id_pelanggan', $this->input->post('id_pelanggan'));
		$this->db->where('kd_penjualan', $this->input->post('pk'));
		$this->db->update('penjualan_kredit');

		//Generate Jurnal//
		$debit = array(
			'kd_transaksi'   => $this->input->post('pk'),
			'no_akun'        => '112',
			'tanggal_jurnal' => date('Y-m-d'),
			'posisi'         => 'debit',
			'nominal'        => $this->input->post('total')
		);
		$this->db->insert('jurnal', $debit);

		$kredit = array(
			'kd_transaksi'   => $this->input->post('pk'),
			'no_akun'        => '411',
			'tanggal_jurnal' => date('Y-m-d'),
			'posisi'         => 'kredit',
			'nominal'        => $this->input->post('total')
		);
		$this->db->insert('jurnal', $kredit);
	}

	public function Pelunasan($kd, $total){
		//Update Tabel penjualan_kredit
		$this->db->set('status', 'L');
		$this->db->set('tanggal_pelunasan', date('y-m-d'));
		$this->db->where('kd_penjualan', $kd);
		$this->db->update('penjualan_kredit');

		//Generate Jurnal//
		$debit = array(
			'kd_transaksi'   => $kd,
			'no_akun'        => '111',
			'tanggal_jurnal' => date('Y-m-d'),
			'posisi'         => 'debit',
			'nominal'        => $total
		);
		$this->db->insert('jurnal', $debit);

		$kredit = array(
			'kd_transaksi'   => $kd,
			'no_akun'        => '112',
			'tanggal_jurnal' => date('Y-m-d'),
			'posisi'         => 'kredit',
			'nominal'        => $total
		);
		$this->db->insert('jurnal', $kredit);
	}

	public function GetDataPiutang(){
		$this->db->select('penjk.kd_penjualan, penjk.tanggal_penjualan, penjk.total, penjk.status, penjk.tanggal_pelunasan, pgn.nama_pelanggan');
		$this->db->from('penjualan_kredit penjk');
		$this->db->join('pelanggan pgn', 'pgn.id_pelanggan = penjk.id_pelanggan');
		$this->db->where('penjk.kd_penjualan', $this->input->post('kd_penjualan'));
		return $this->db->get()->row_array();
	}

	public function GetL(){
		$this->db->select('penjk.kd_penjualan, penjk.tanggal_penjualan, penjk.total, penjk.status, penjk.tanggal_pelunasan, pgn.nama_pelanggan');
		$this->db->from('penjualan_kredit penjk');
		$this->db->join('pelanggan pgn', 'pgn.id_pelanggan = penjk.id_pelanggan');
		$this->db->where('status', 'L');
		return $this->db->get()->result_array();
	}

	public function GetBL(){
		$this->db->select('penjk.kd_penjualan, penjk.tanggal_penjualan, penjk.total, penjk.status, penjk.tanggal_pelunasan, pgn.nama_pelanggan');
		$this->db->from('penjualan_kredit penjk');
		$this->db->join('pelanggan pgn', 'pgn.id_pelanggan = penjk.id_pelanggan');
		$this->db->where('status', 'BL');
		return $this->db->get()->result_array();
	}
}