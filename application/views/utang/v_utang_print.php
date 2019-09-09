<html>
<head>
	<style type="text/css">
	h1{
		font-size: 100px;
	}
	@page :first{
		size: A4;
		margin-top: 1cm;
	}
	#pos{
		font-size: 40px;
	}
	#edit{
		background-color: white;
		font-family: 'Merienda One', cursive;
		padding-top: 5%;
		padding-bottom: 5%;
		padding-left: 12%;
		border: 3px solid black;
	}
	#bi{
		font-family: 'Bungee Inline', cursive;
		text-align: center;
	}
	#kur{
		padding-left: 0.1px;
		text-align: center
	}
</style>
</head>
<body><br><br><br>
	<h1 align="center">PD Putera Jaya</h1><br>
	<h2 align="center">Utang Pembelian ke Pemasok</h2><br>
	<h2 align="center"><?php echo date('Y-m-d')?></h2><br>
	<fieldset class="col-sm-&nbsp5" id="pos">
		<div id="edit"&nbsp&nbsp&nbsp>
		<p id="bi">Kode Pembelian<br> <?php echo $utang['kd_pembelian']?></p><br>
		<p>Nama Pemasok &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $utang['nama_pemasok']?></p>
		<p>Tanggal Pembelian &nbsp: <?php echo $utang['tanggal_pembelian']?></p>
		<p>Total &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo format_rp($utang['total'])?></p>
		<?php if ($utang['status'] == 'BL') {
			$status = 'Belum Dilunasi';
		}else{
			$status = 'Sudah Dilunasi';
		} ?>
		<p>Status &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $status ?></p>
		<?php if ($utang['kondisi'] == '2/15') {
			$kondisi = '2% dalam 15 Hari';
		}elseif ($utang['kondisi'] == '3/10') {
			$kondisi = '3% dalam 10 Hari';
		}elseif ($utang['kondisi'] == '5/5') {
			$kondisi = '5% dalam 5 Hari Bayar';
		}else {
			$kondisi = 'Tanpa Potongan';
		} ?>
		<p>Kondisi Potongan  &nbsp&nbsp&nbsp : <?php echo $kondisi?></p>
		<p>Tanggal Pelunasan &nbsp&nbsp: <?php echo $utang['tanggal_pelunasan']?></p>
		<p>Potongan &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo format_rp($utang['potongan'])?></p><br>
		<p id="kur">Pelunasan<br><?php echo format_rp($utang['pelunasan'])?></p>
	</div><br>
	</fieldset>
</body>
</html>
<script>window.print()</script>