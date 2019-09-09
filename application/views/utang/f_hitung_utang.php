<html>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item active">Transaksi</li>
		<li class="breadcrumb-item active">Utang</li>
		<li class="breadcrumb-item active">Hitung Utang</li>
	</ol>

		<div style="width: 30%; margin-top: 15%; margin-left: 5%; border: solid; padding: 1%">
			<div class="form-group">
              <label>Kode Pembelian</label>
              <select onchange="hitung_utang()" id="utang" name="kd_pembelian" class="form-control">
              	<option selected disabled>--Pilih Kode--</option>
                <?php
                    foreach($pembelian as $data){
                        echo "<option data-tanggal=".$data['tanggal_pembelian']." data-total=".$data['total']." data-kondisi=".$data['kondisi']." data-nama=".$data['nama_pemasok']." value=".$data['kd_pembelian'].">".$data['kd_pembelian']."</option>";
                    }
                ?>
              </select>
            </div>
		</div>
    
		<div style="position: absolute; height: 65%; width: 40%	;left: 55%; top: 21%; border: solid; padding: 1%;">
			<form method="POST" action="<?php echo site_url('Utang/Lunas'); ?>">
			<div>
              <label>Kode Pembelian :</label><br>
              <h6 id="kdtext"></h6><br>
              <input type="text" id="kdvalue" name="kd_pembelian" hidden>
              <label>Tanggal Utang :</label><br>
              <h6 id="tanggaltext"></h6><br>
              <input type="text" id="tanggalvalue" name="tanggal" hidden>
              <label>Total :</label><br>
              <h6 id="totaltext"></h6><br>
              <input type="text" id="totalvalue" name="total" hidden>
              <label>Kondisi :</label><br>
              <h6 id="kondisitext"></h6><br>
              <input type="text" id="kondisivalue" name="kondisi" hidden>
              <label>Potongan</label><br>
              <h6 id="potongantext"></h6><br>
              <input type="text" id="potonganvalue" name="potongan" hidden>
          </div>
          <div style="position: absolute; height: 100%; width: 40%; left: 45%; top: 0%; border-left: solid; padding-left: 4%; padding-top: 2%;" ><br><br><br>
          	 <label>Jumlah :</label><br>
              <h3 id="jumlahtext"></h3><br>
              <input type="text" id="jumlahvalue" name="jumlah" hidden><br><br><br>
              <button type="submit" class="btn btn-primary" id="boo"><i class="fa fa-money"></i> Bayar</button><br><br>
              <a href="<?php echo site_url('Utang'); ?>" role="button" class="btn btn-danger"><i class="fa fa-fw fa-plus-circle"></i>Kembali</a>
          </div>
      </form>
  </div>
</body>
</html>