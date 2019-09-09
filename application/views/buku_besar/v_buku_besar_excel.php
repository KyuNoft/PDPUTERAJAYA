<?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Buku Besar ".$dataakun['nama_akun'].".xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
 <body>
 	<div align="center">
	<h3>Buku Besar <?php echo $dataakun['nama_akun'];?></h3><br>
		<table border="1" width="40%">
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
						<td align='right'>".$dataakun['saldo_awal']."</td>
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
							<td align='right'>".$data['nominal']."</td>
							<td></td>
							<td align='right'>".$saldo."</td>
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
							<td align='right'>".$data['nominal']."</td>
							<td align='right'>".$saldo."</td>
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
						<td align='right'>".$saldo."</td>
					</tr>
				";
			?>
		</table>
	</div>
</body>