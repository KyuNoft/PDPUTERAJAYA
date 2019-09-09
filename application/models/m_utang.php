<?php
class m_utang extends ci_model{

	public function Get(){
		$this->db->select('pembk.kd_pembelian, pembk.tanggal_pembelian, pembk.total, pembk.status, pembk.kondisi, pembk.tanggal_pelunasan, pembk.potongan, pembk.pelunasan, pmk.nama_pemasok');
		$this->db->from('pembelian_kredit pembk');
		$this->db->join('pemasok pmk', 'pmk.id_pemasok = pembk.id_pemasok');
		return $this->db->get()->result_array();
	}

	/*public function GetTest(){
		$this->db->select('tanggal_pembelian');
		$this->db->from('pembelian_kredit');
		$this->db->where('kd_pembelian', 'PB-001');
		return $this->db->get();
	}*/

	public function GeneratePK(){
	    //Kode Pembelian otomatis
		$this->db->select('RIGHT(kd_pembelian,3) as pk', FALSE);
		$this->db->order_by('kd_pembelian','DESC');    
		$this->db->limit(1);
		$query = $this->db->get('pembelian_kredit');
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
		$pkjadi = "PB-".$pkmax;

    	//Pembuatan Kode Pembelian Baru
		$this->db->where('status', 'BS');
		$query = $this->db->get('pembelian_kredit');
		if($query->num_rows() == 0){
			$input = array(
				'kd_pembelian'      => $pkjadi,
				'tanggal_pembelian' => '0000-00-00',
				'total'             => 0,
				'status'            => 'BS',
				'kondisi'           => 'XXX',
				'tanggal_pelunasan' => '0000-00-00',
				'potongan'          => 0,
				'pelunasan'         => 0,
				'id_pemasok'        => 'XXX',
			);
			$this->db->insert('pembelian_kredit', $input);
		}else{
			$pkjadi = $query->row()->kd_pembelian;
		}
		return $pkjadi;
    }

    public function GetDataDetail($kd){
    	$this->db->select('dpembk.jumlah, dpembk.subtotal, brg.nama_barang, brg.harga');
    	$this->db->from('detail_pembelian_kredit dpembk');
    	$this->db->join('barang brg', 'dpembk.kd_barang = brg.kd_barang');
		$this->db->where('dpembk.kd_pembelian', $kd);
		return $this->db->get()->result_array();
	}

	public function SimpanDetail(){
    	//Ambil Harga dari Tabel Barang
    	$this->db->where('kd_barang', $this->input->post('kd_barang'));
    	$harga = $this->db->get('barang')->row()->harga;

        //Masukkan ke detail_pembelian_kredit
    	$this->db->where(array('kd_pembelian' => $this->input->post('pk'), 'kd_barang' => $this->input->post('kd_barang')));
    	$query = $this->db->get('detail_pembelian_kredit');
    	if($query->num_rows() == 0){
    		$subtotal = $this->input->post('jumlah') * $harga;
    		$insert = array(
			'kd_pembelian' => $this->input->post('pk'),
			'kd_barang'    => $this->input->post('kd_barang'),
			'jumlah'       => $this->input->post('jumlah'),
			'subtotal'     => $subtotal,
		);
			$this->db->insert('detail_pembelian_kredit', $insert);
		}else{
			$this->db->set('jumlah', "jumlah + ".$this->input->post('jumlah')."", FALSE);
			$this->db->set('subtotal', "subtotal + ".$this->input->post('jumlah') * $harga."", FALSE);
			$this->db->where(array('kd_pembelian' => $this->input->post('pk'), 'kd_barang' => $this->input->post('kd_barang')));
			$this->db->update('detail_pembelian_kredit');
		}
	}

	public function SelesaiBeli(){
		//Update Tabel pembelian_kredit
		$this->db->set('tanggal_pembelian', date('y-m-d'));
		$this->db->set('total', $this->input->post('total'));
		$this->db->set('status', 'BL');
		$this->db->set('kondisi', $this->input->post('kondisi'));
		$this->db->set('id_pemasok', $this->input->post('id_pemasok'));
		$this->db->where('kd_pembelian', $this->input->post('pk'));
		$this->db->update('pembelian_kredit');

		//Generate Jurnal//
		$debit = array(
			'kd_transaksi'   => $this->input->post('pk'),
			'no_akun'        => '511',
			'tanggal_jurnal' => date('Y-m-d'),
			'posisi'         => 'debit',
			'nominal'        => $this->input->post('total')
		);
		$this->db->insert('jurnal', $debit);

		$kredit = array(
			'kd_transaksi'   => $this->input->post('pk'),
			'no_akun'        => '211',
			'tanggal_jurnal' => date('Y-m-d'),
			'posisi'         => 'kredit',
			'nominal'        => $this->input->post('total')
		);
		$this->db->insert('jurnal', $kredit);
	}

	public function GetHitung(){
		$this->db->select('pembk.kd_pembelian, pembk.tanggal_pembelian, pembk.total, pembk.kondisi, pmk.id_pemasok, pmk.nama_pemasok');
    	$this->db->from('pembelian_kredit pembk');
    	$this->db->join('pemasok pmk', 'pembk.id_pemasok = pmk.id_pemasok');
    	$this->db->where('pembk.status', 'BL');
    	$this->db->order_by('pembk.kd_pembelian', 'ASC');
		return $this->db->get()->result_array();
	}

	public function Pelunasan(){
		$this->db->set('status', 'L');
		$this->db->set('tanggal_pelunasan', date('Y-m-d'));
		$this->db->set('potongan', $this->input->post('potongan'));
		$this->db->set('pelunasan', $this->input->post('jumlah'));
		$this->db->where('kd_pembelian', $this->input->post('kd_pembelian'));
		$this->db->update('pembelian_kredit');

		//Generate Jurnal//
		$debit = array(
			'kd_transaksi'   => $this->input->post('kd_pembelian'),
			'no_akun'        => '211',
			'tanggal_jurnal' => date('Y-m-d'),
			'posisi'         => 'debit',
			'nominal'        => $this->input->post('total')
		);
		$this->db->insert('jurnal', $debit);

		if ($this->input->post('potongan') != 0) {
			$kredit1 = array(
				'kd_transaksi'   => $this->input->post('kd_pembelian'),
				'no_akun'        => '512',
				'tanggal_jurnal' => date('Y-m-d'),
				'posisi'         => 'kredit',
				'nominal'        => $this->input->post('potongan')
			);
			$this->db->insert('jurnal', $kredit1);

			$kredit2 = array(
				'kd_transaksi'   => $this->input->post('kd_pembelian'),
				'no_akun'        => '111',
				'tanggal_jurnal' => date('Y-m-d'),
				'posisi'         => 'kredit',
				'nominal'        => $this->input->post('jumlah')
			);
			$this->db->insert('jurnal', $kredit2);
		}else{
			$kredit = array(
				'kd_transaksi'   => $this->input->post('kd_pembelian'),
				'no_akun'        => '111',
				'tanggal_jurnal' => date('Y-m-d'),
				'posisi'         => 'kredit',
				'nominal'        => $this->input->post('jumlah')
			);
			$this->db->insert('jurnal', $kredit);
		}
	}

	public function GetDataUtang(){
		$this->db->select('pembk.kd_pembelian, pembk.tanggal_pembelian, pembk.total, pembk.status, pembk.kondisi, pembk.tanggal_pelunasan, pembk.potongan, pembk.pelunasan, pmk.nama_pemasok');
		$this->db->from('pembelian_kredit pembk');
		$this->db->join('pemasok pmk', 'pmk.id_pemasok = pembk.id_pemasok');
		$this->db->where('pembk.kd_pembelian', $this->input->post('kd_pembelian'));
		return $this->db->get()->row_array();
	}

	public function GetL(){
		$this->db->select('pembk.kd_pembelian, pembk.tanggal_pembelian, pembk.total, pembk.status, pembk.kondisi, pembk.tanggal_pelunasan, pembk.potongan, pembk.pelunasan, pmk.nama_pemasok');
		$this->db->from('pembelian_kredit pembk');
		$this->db->join('pemasok pmk', 'pmk.id_pemasok = pembk.id_pemasok');
		$this->db->where('status', 'L');
		return $this->db->get()->result_array();
	}

	public function GetBL(){
		$this->db->select('pembk.kd_pembelian, pembk.tanggal_pembelian, pembk.total, pembk.status, pembk.kondisi, pembk.tanggal_pelunasan, pembk.potongan, pembk.pelunasan, pmk.nama_pemasok');
		$this->db->from('pembelian_kredit pembk');
		$this->db->join('pemasok pmk', 'pmk.id_pemasok = pembk.id_pemasok');
		$this->db->where('status', 'BL');
		return $this->db->get()->result_array();
	}
}