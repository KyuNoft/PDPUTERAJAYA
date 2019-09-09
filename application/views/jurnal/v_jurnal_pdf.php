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
	</style>
</head>
<body>
	<div class="line">
		<h3 align='center' id="merienda">Jurnal Umum</h3><br>
			<table class='table table-bordered table-striped'>
				<thead align="center">
					<tr>
						<th>Tanggal Jurnal</th>
						<th>Keterangan</th>
						<th>Ref</th>
						<th>Debit</th>
						<th>Kredit</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$spasi='&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
					foreach($jurnal as $data){
						echo "
							<tr>
								<td align='center'>".$data['tanggal_jurnal']."</td>
							";
						if($data['posisi'] =='debit'){
							echo "
								<td>".$data['nama_akun']."</td>
								<td align='center'>".$data['no_akun']."</td>
								<td align='right'>".format_rp($data['nominal'])."</td>
								<td align='right'></td>
							</tr>
							";
						}else{
							echo "
								<td>".$spasi.$data['nama_akun']."</td>
								<td align='center'>".$data['no_akun']."</td>
								<td align='right'></td>
								<td align='right'>".format_rp($data['nominal'])."</td>
							</tr>
						";
						}
					}
				?>
			</tbody>
			</table>
	</body>
</html>

<script>window.print()</script>