<html>
<body>
	<ol class="breadcrumb">
			<li class="breadcrumb-item active">Transaksi</li>
			<li class="breadcrumb-item active">Piutang</li>
			<li class="breadcrumb-item active">Daftar Piutang</li>
		</ol>
		<div align="center" class="form-inline">
			<form method="POST" action="<?php echo site_url('Piutang/PiutangPrint');?>">
					Kode Penjualan:
					<select name="kd_penjualan" class="form-control">
						<option value="#" disabled selected>Pilih Kode</option>
                <?php
                    foreach($piutang as $data){
                        echo "<option value=".$data['kd_penjualan'].">".$data['kd_penjualan']."</option>";
                    }
                ?>
              </select>
              <button type="submit" name="print" value="printc" class="btn btn-success"><i class="fa fa-fw fa-print"></i> Print</button>
          </form>
				&nbsp<form method="POST" action="<?php echo site_url('Piutang/PiutangPrintAll');?>">
					<button type="submit" name="print" value="printall" class="btn btn-success"><i class="fas fa-print"></i> Print Daftar</button></form></div><br>
				<!--&nbsp<a href="<?php //echo base_url('Pengiriman/PengirimanExcel')*/?>" type="button" class="btn btn-success">Export Excel<i class="fa fa-fw fa-file-excel-o"></i></a>
			</div><br>-->

			<a href="<?php echo site_url('Piutang/Tambah'); ?>" role="button" class="btn btn-info"><i class="fa fa-fw fa-plus-circle"></i>Tambah</a><br>

		<h3 class="text-center" id="merienda">Daftar Piutang</h3><br><br>
		<div class="pgn">
	<table class="table table-resposive text-center" id="dataTable">
		<thead>
			<tr>
				<th class="column1">Kode Penjualan</th>
				<th class="column2">Nama Pelanggan</th>
				<th class="column3">Tanggal Penjualan</th>
				<th class="column4">Total</th>
				<th class="column5">Status</th>
				<th class="column6">Tanggal Pelunasan</th>
				<th class="column7">Penagihan</th>
				<th class="column8">Detail</th>
			</tr>
		</thead>
		<tbody>
			<?php
			     foreach($piutang as $data){
				    echo "
				         <tr>
				             <td>".$data['kd_penjualan']."</td>
				             <td>".$data['nama_pelanggan']."</td>
				             <td>".$data['tanggal_penjualan']."</td>
				             <td>".format_rp($data['total'])."</td>
				             <td>".$data['status']."</td>
				             <td>".$data['tanggal_pelunasan']."</td> ";
				             $kd = $data['kd_penjualan'];
				             $s  = $data['status']?>
				             <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#Lunas<?php echo $kd;?>" <?php if($s == 'L'){echo "disabled"; }else{echo "";} ?>><i class="fa fa-fw fa-money"></i>Lunasi</button></td>
				             <td><a href="<?php echo site_url('Piutang/Detail/'.$kd.''); ?>" role="button" class="btn btn-danger"><i class="fas fa-table"></i>Detail</a></td>
			 	        </tr>
			 	     <?php
			 	  }
			?>
		</tbody>
	</table>
</div>
</body>
</html>

<!-- Modal Hapus -->
            <?php foreach ($piutang as $data) { ?>
                <div id=<?php echo "Lunas".$data['kd_penjualan']."" ?> class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="merienda">Penagihan</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <p>Lunasi Sekarang?</p>
                            </div>

                            <div class="modal-footer">
                                <a href="<?php echo site_url('Piutang/Lunas/'.$data['kd_penjualan'].'/'.$data['total'].''); ?>" role="button" class="btn btn-success"><i class="fa fa-fw fa-money"></i>Lunas</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>