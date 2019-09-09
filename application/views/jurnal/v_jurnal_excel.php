 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Jurnal.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
<body>
	<div align="center">
		<h3>Jurnal Umum</h3><br>
			<table border="1" width="40%">
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
				    $tdebit  = 0;
				    $tkredit = 0;
					$spasi='<span hidden>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>';
					foreach($jurnal as $data){
						echo "
							<tr>
								<td align='center'>".$data['tanggal_jurnal']."</td>
							";
						if($data['posisi'] =='debit'){
							echo "
								<td>".$data['nama_akun']."</td>
								<td align='center'>".$data['no_akun']."</td>
								<td align='right'>".$data['nominal']."</td>
								<td align='right'></td>
							</tr>
							";
							$tdebit = $tdebit + $data['nominal'];
						}else{
							echo "
								<td>".$spasi.$data['nama_akun']."</td>
								<td align='center'>".$data['no_akun']."</td>
								<td align='right'></td>
								<td align='right'>".$data['nominal']."</td>
							</tr>
						";
							$tkredit = $tkredit + $data['nominal'];
						}
					}
				?>
				<tr>
					<td colspan="3" align="center">Total</td>
					<td align="right"><?php echo $tdebit; ?></td>
					<td align="right"><?php echo $tkredit; ?></td>
				</tr>
			</tbody>
	</table>
</body>