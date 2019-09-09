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
		<h3 class="text-center">Daftar Piutang Lunas</h3>
		<div class="font">
	<table class="table text-center">
		<thead>
			<tr>
				<th class="column1">Kode Penjualan</th>
				<th class="column2">Nama Pemasok</th>
				<th class="column3">Tanggal Penjualan</th>
				<th class="column4">Total</th>
				<th class="column5">Status</th>
				<th class="column6">Tanggal Pelunasan</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total = 0;
			     foreach($piutangL as $data){
				    echo "
				         <tr>
				             <td>".$data['kd_penjualan']."</td>
				             <td>".$data['nama_pelanggan']."</td>
				             <td>".$data['tanggal_penjualan']."</td>
				             <td>".format_rp($data['total'])."</td>
				             <td>".$data['status']."</td>
				             <td>".$data['tanggal_pelunasan']."</td>
			 	        </tr>
			 	      ";
			 	      $total     = $total + $data['total'];
			 	  }
			?>
			<tr>
				<td colspan="6"></td>
			</tr>
			<tr>
				<td colspan="6"></td>
			</tr>
			<tr class="garis">
				<td colspan="3">Total</td>
				<td><?php echo format_rp($total) ?></td>
				<td colspan="2"></td>
			</tr>
		</tbody>
	</table>
</div><br>

		<h3 class="text-center">Daftar Piutang Belum Lunas</h3> <div class="font">
	<table class="table text-center">
		<thead>
			<tr>
				<th class="column1">Kode Penjualan</th>
				<th class="column2">Nama Pemasok</th>
				<th class="column3">Tanggal Penjualan</th>
				<th class="column4">Total</th>
				<th class="column5">Status</th>
				<th class="column6">Tanggal Pelunasan</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total = 0;
			     foreach($piutangBL as $data){
				    echo "
				         <tr>
				             <td>".$data['kd_penjualan']."</td>
				             <td>".$data['nama_pelanggan']."</td>
				             <td>".$data['tanggal_penjualan']."</td>
				             <td>".format_rp($data['total'])."</td>
				             <td>".$data['status']."</td>
				             <td>".$data['tanggal_pelunasan']."</td>
			 	        </tr>
			 	      ";
			 	      $total     = $total + $data['total'];
			 	  }
			?>
			<tr>
				<td colspan="6"></td>
			</tr>
			<tr>
				<td colspan="6"></td>
			</tr>
			<tr class="garis">
				<td colspan="3">Total</td>
				<td><?php echo format_rp($total) ?></td>
				<td colspan="2"></td>
			</tr>
		</tbody>
	</table>
</div><br>
</body>
</html>
<script>window.print()</script>