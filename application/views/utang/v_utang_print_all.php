<html>
<head>
	<style>

	/* Tampilan Print */
	@media print{
		table{
			border: 2px solid black !important;
		}
		th, td{
			border: none !important;
		}
		.font{
			font-size: small;
			font-weight: bold;
		}
		.garis{
		border-top: 1px solid black !important;
	   }
	}
	@page :first{
		size: legal landscape;
		margin-top: 0.1px;
	}
	@page{
		size: A4;
		margin-top: 3cm;
		size: legal landscape;
	}

	/* Tampilan Layar */
	table{
		border: 2px solid black !important;
	}
	th, td{
		border: none !important;	
	}
	.garis{
		border-top: 1px solid black !important;
	}
	</style>
</head>
<body>

	<h1 align="center">PD Putera Jaya</h1>
	<h4 align="center"><?php echo date('Y-m-d')?></h4>
		<h3 class="text-center">Daftar Utang Lunas</h3>
		<div class="font">
	<table class="table text-center">
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
			</tr>
		</thead>
		<tbody>
			<?php
			$total = 0;
			$potongan = 0;
			$pelunasan = 0;
			     foreach($utangL as $data){
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
				             <td>".format_rp($data['pelunasan'])."</td>
			 	        </tr>
			 	      ";
			 	      $total     = $total + $data['total'];
			 	      $potongan  = $potongan + $data['potongan'];
			 	      $pelunasan = $pelunasan + $data['pelunasan'];
			 	  }
			?>
			<tr>
				<td colspan="9"></td>
			</tr>
			<tr>
				<td colspan="9"></td>
			</tr>
			<tr class="garis">
				<td colspan="3">Total</td>
				<td><?php echo format_rp($total) ?></td>
				<td colspan="3"></td>
				<td><?php echo format_rp($potongan) ?></td>
				<td><?php echo format_rp($pelunasan) ?></td>
			</tr>
		</tbody>
	</table>
</div><br>

		<h3 class="text-center">Daftar Utang Belum Lunas</h3>
		<div class="font">
	<table class="table text-center">
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
			</tr>
		</thead>
		<tbody>
			<?php
			$total = 0;
			$potongan = 0;
			$pelunasan = 0;
			     foreach($utangBL as $data){
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
				             <td>".format_rp($data['pelunasan'])."</td>
			 	        </tr>
			 	      ";
			 	      $total     = $total + $data['total'];
			 	      $potongan  = $potongan + $data['potongan'];
			 	      $pelunasan = $pelunasan + $data['pelunasan'];
			 	  }
			?>
			<tr>
				<td colspan="9"></td>
			</tr>
			<tr>
				<td colspan="9"></td>
			</tr>
			<tr class="garis">
				<td colspan="3">Total</td>
				<td><?php echo format_rp($total) ?></td>
				<td colspan="3"></td>
				<td><?php echo format_rp($potongan) ?></td>
				<td><?php echo format_rp($pelunasan) ?></td>
			</tr>
		</tbody>
	</table>
</div><br><br>
</body>
</html>
<script>window.print()</script>