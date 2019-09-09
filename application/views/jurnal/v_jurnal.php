<html>
<body>
	<div class='container'>
		<div align="center" class="form-inline">
			<form method="POST" action="<?php echo site_url('Laporan/Jurnal');?>">
					Tanggal Awal : <input type='date' name='tgl_awal' class='form-control col-sm-3'>
					Tanggal Akhir : <input type='date' name='tgl_akhir' class='form-control col-sm-3'>
					<button type="submit" name="submit" value="filter" class="btn btn-info">Filter</button>
					<button type="submit" name="print" value="printc" class="btn btn-success">Print<i class="fa fa-fw fa-print"></i></button>
					<button type="submit" name="print" value="printall" class="btn btn-success">Print All<span class="glyphicon glyphicon-print"></span>></button>
					<a href = "<?php echo site_url()."Laporan/Jurnal"?>" role="button" class='btn btn-danger'>Lihat Semua</a>
				</form>
			</div><br><a href="<?php echo site_url()."Laporan/JurnalExcel"?>" type="button" class="btn btn-success">Export Excel<i class="fa fa-fw fa-file-excel-o"></i></a><br>
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
				    $tdebit  = 0;
				    $tkredit = 0;
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
							$tdebit = $tdebit + $data['nominal'];
						}else{
							echo "
								<td>".$spasi.$data['nama_akun']."</td>
								<td align='center'>".$data['no_akun']."</td>
								<td align='right'></td>
								<td align='right'>".format_rp($data['nominal'])."</td>
							</tr>
						";
						    $tkredit = $tkredit + $data['nominal'];
						}
					}
				?>
				<tr>
					<td colspan="3" align="center">Total</td>
					<td align="right"><?php echo format_rp($tdebit); ?></td>
					<td align="right"><?php echo format_rp($tkredit); ?></td>
				</tr>
			</tbody>
			</table>
		</div>
	</body>
</html>