<html>
<body>
	<ol class="breadcrumb">
			<li class="breadcrumb-item active">Transaksi</li>
			<li class="breadcrumb-item active">Utang</li>
			<li class="breadcrumb-item active">Daftar Utang</li>
		</ol>
		<div align="center" class="form-inline">
			<form method="POST" action="<?php echo site_url('Utang/UtangPrint');?>">
					Kode Pembelian:
					<select name="kd_pembelian" class="form-control">
						<option value="#" disabled selected>Pilih Kode</option>
                <?php
                    foreach($utang as $data){
                        echo "<option value=".$data['kd_pembelian'].">".$data['kd_pembelian']."</option>";
                    }
                ?>
              </select>
              <button type="submit" name="print" value="printc" class="btn btn-success"><i class="fa fa-fw fa-print"></i> Print</button>
          </form>
				&nbsp<form method="POST" action="<?php echo site_url('Utang/UtangPrintAll');?>">
					<button type="submit" name="print" value="printall" class="btn btn-success"><i class="fas fa-print"></i> Print Daftar</button></form></div>
				<!--&nbsp<a href="<?php //echo base_url('Pengiriman/PengirimanExcel')*/?>" type="button" class="btn btn-success">Export Excel<i class="fa fa-fw fa-file-excel-o"></i></a>
			</div><br>-->

			<br><a href="<?php echo site_url('Utang/Tambah'); ?>" role="button" class="btn btn-info"><i class="fa fa-fw fa-plus-circle"></i>Tambah</a><br>

		<h3 class="text-center" id="merienda">Daftar Utang</h3><br><br>
		<div class="pgn">
	<table class="table table-resposive text-center" id="dataTable">
		<thead>
			<tr>
				<th class="column1">Kode Pembelian</th>
				<th class="column2">Nama Pemasok</th>
				<th class="column3">Tanggal Pembelian</th>
				<th class="column4">Total</th>
				<th class="column5">Status</th>
				<th class="column6">Kondisi</th>
				<th class="column7">Tanggal Pelunasan</th>
				<th class="column8">Potongan</th>
				<th class="column9">Pelunasan</th>
				<th class="column10">Detail</th>
			</tr>
		</thead>
		<tbody>
			<?php
			     foreach($utang as $data){
				    echo "
				         <tr>
				             <td>".$data['kd_pembelian']."</td>
				             <td>".$data['nama_pemasok']."</td>
				             <td>".$data['tanggal_pembelian']."</td>
				             <td>".format_rp($data['total'])."</td>
				             <td>".$data['status']."</td>
				             <td>".$data['kondisi']."</td>
				             <td>".$data['tanggal_pelunasan']."</td>
				             <td>".format_rp($data['potongan'])."</td>
				             <td>".format_rp($data['pelunasan'])."</td> ";
				             $kd = $data['kd_pembelian']?>
				             <td><a href="<?php echo site_url('Utang/Detail/'.$kd.''); ?>" role="button" class="btn btn-danger"><i class="fas fa-table"></i>Detail</a></td>
			 	        </tr>
			 	     <?php
			 	  }
			?>
		</tbody>
	</table>
</div>
</body>
</html>