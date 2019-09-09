<html>
	<body>
		<div class="form-inline">
		<form method="POST" action="<?php echo site_url().'/Laporan/BukuBesar';?>">
		  Pilih Akun: <select name="no_akun" class="form-control input-sm">
			<option value="#" disabled selected>Pilih Akun</option>
			<?php
				foreach($akun as $data){
					echo "
						<option value=".$data['no_akun'].">".$data['nama_akun']."</option>
					";
				}
			?>
		  </select>
		  <button class="btn btn-info" type="submit">Pilih</button>
		  <button type="submit" name="print" value="printc" class="btn btn-success">Print<i class="fa fa-fw fa-print"></i></button>
		  <button type="submit" name="excel" value="excel" class="btn btn-success">Export Excel<i class="fa fa-fw fa-file-excel-o"></i></button>
		</form>
	</div><br>
		<h3 align='center' id="merienda">Buku Besar <?php echo $dataakun['nama_akun'];?></h3>
		<table class='table table-bordered table-striped'>
			<thead align="center">
				<tr>
					<td>Tanggal</td>
					<td>Keterangan</td>
					<td>Debit</td>
					<td>Kredit</td>
					<td>Saldo</td>
			</tr>
		</thead>
			<?php
				echo "
					<tr>
						<td align='center'>0000-00-00</td>
						<td align='center'>Saldo Awal</td>
						<td></td>
						<td></td>
						<td align='right'>".format_rp($dataakun['saldo_awal'])."</td>
					</tr>
				";
				$saldo=$dataakun['saldo_awal'];
				foreach($jurnal as $data){
					echo "
						<tr>
							<td align='center'>".$data['tanggal_jurnal']."</td>
							<td align='center'>".$data['nama_akun']."</td>
						";
					if($data['posisi'] == 'debit'){
						if($dataakun['header_akun'] == 1 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6){
							$saldo = $saldo + $data['nominal'];
						}else{
							$saldo = $saldo - $data['nominal'];
						}
						echo "
							<td align='right'>".format_rp($data['nominal'])."</td>
							<td></td>
							<td align='right'>".format_rp($saldo)."</td>
						</tr>
						";
					}else{
						if($dataakun['header_akun'] == 1 or $dataakun['header_akun'] == 5 or $dataakun['header_akun'] == 6){
							$saldo = $saldo - $data['nominal'];
						}else{
							$saldo = $saldo + $data['nominal'];
						}
						echo "
							<td></td>
							<td align='right'>".format_rp($data['nominal'])."</td>
							<td align='right'>".format_rp($saldo)."</td>
						</tr>
						";
					}
				}
				echo "
					<tr>
						<td align='center'>0000-00-00</td>
						<td align='center'>Saldo Akhir</td>
						<td></td>
						<td></td>
						<td align='right'>".format_rp($saldo)."</td>
					</tr>
				";
			?>
		</table>
	</body>
</html>