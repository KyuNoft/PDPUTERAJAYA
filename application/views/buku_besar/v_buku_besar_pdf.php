<html>
	<head>
		<style>
	@page :first{
		size: A4;
		margin-top: 2cm;
		margin-bottom: 1in;
	}
	@page{
		size: A4;
		margin-top: 3cm;
	}
	@media print{
		.font{
		font-size: x-large;
	}
	</style>
	</head>
	<body>
		<h1 align='center' id="merienda">Buku Besar <?php echo $dataakun['nama_akun'];?></h1><br>
		<div class="font">
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
	</div>
	</body>
</html>

<script>window.print()</script>