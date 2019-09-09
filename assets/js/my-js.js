	
	function hitung(){var x, y, z, total;
		x = document.getElementById('barang').value;
		y = $( "#barang option:selected" ).data('harga');
		z = 0.02 * y;
		total = y - z
		document.getElementById('kd').value = x;
		document.getElementById('hasil').value = total;
	}

	function sukses(){
		swal("Berhasil!", "Data Berhasil dimasukkan", "success");
	}

	function gagal(){
		swal("Gagal!", "Data gagal dimasukkan", "error");
	}

	function hitung_utang(){
		var kode, tanggal, nominal, kondisi, nama, satuhari, ngutang, bayar, jarak, jmlhari, potongan, ttlbayar;
		kode    = document.getElementById('utang').value;
		tanggal = $( "#utang option:selected" ).data('tanggal');
		nominal = $( "#utang option:selected" ).data('total');
		kondisi = $( "#utang option:selected" ).data('kondisi');
		nama    = $( "#utang option:selected" ).data('nama');

		 //Ngitung total hari//
		 satuhari = 24*60*60*1000; // hours*minutes*seconds*milliseconds
		 ngutang  = new Date(tanggal);
		 bayar    = new Date();
		 jarak    = bayar - ngutang;
		 jmlhari  = Math.floor(jarak / satuhari); //Jumlah Jarak Dapat//

		 //Lihat Hitung Total Bayar berdasarkan Kondisi//
		 if (kondisi == '2/15') {
		 	if (jmlhari <=15) {
		 		potongan = nominal * 0.02;
		 		ttlbayar = nominal - potongan;
		 	}else{
		 		potongan = 0;
		 		ttlbayar = nominal;
		 	}
		 }else if (kondisi == '3/10') {
		 	if (jmlhari <=10) {
		 		potongan = nominal * 0.03;
		 		ttlbayar = nominal - potongan;
		 	}else {
		 		potongan = 0;
		 		ttlbayar = nominal;
		 	}
		 }else if (kondisi == '5/5') {
		 	if (jmlhari <=5) {
		 		potongan = nominal * 0.05;
		 		ttlbayar = nominal - potongan;
		 	}else {
		 		potongan = 0;
		 		ttlbayar = nominal;
		 	}
		 }else {
		 	potongan = 0;
		 	ttlbayar = nominal;
		 }

		 //Kirim Hasil Ke Inputan//
		 document.getElementById('kdvalue').value = kode;
		 document.getElementById('tanggalvalue').value = tanggal;
		 document.getElementById('totalvalue').value = nominal;
		 document.getElementById('kondisivalue').value = kondisi;
		 document.getElementById('potonganvalue').value = potongan;
		 document.getElementById('jumlahvalue').value = ttlbayar;


		 //Kirim Hasil ke Tampilan
		 document.getElementById('kdtext').innerHTML = kode;
		 document.getElementById('tanggaltext').innerHTML = tanggal;
		 document.getElementById('totaltext').innerHTML = "Rp. "+nominal+",-";
		 document.getElementById('kondisitext').innerHTML = kondisi;
		 document.getElementById('potongantext').innerHTML = "Rp. "+potongan+",-";
		 document.getElementById('jumlahtext').innerHTML = "Rp. "+ttlbayar+",-";
	}