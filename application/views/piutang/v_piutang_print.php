<html>
<head>
	<style type="text/css">
	h1{
		font-size: 100px;
	}
	h3{
		font-size: 50px;
	}
	@page :first{
		size: A4;
		margin-top: 4cm;
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
	<h2 align="center">Piutang Penjualan ke Pelanggan</h2><br>
	<h2 align="center"><?php echo date('Y-m-d')?></h2><br>
	<fieldset class="col-sm-&nbsp5" id="pos">
		<div id="edit"&nbsp&nbsp&nbsp>
		<p id="bi">Kode Penjualan<br> <?php echo $piutang['kd_penjualan']?></p><br>
		<p>Nama Pemasok &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $piutang['nama_pelanggan']?></p>
		<p>Tanggal Penjualan &nbsp: <?php echo $piutang['tanggal_penjualan']?></p>
		<p>Total &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo format_rp($piutang['total'])?></p>
		<?php if ($piutang['status'] == 'BL') {
			$status = 'Belum Dilunasi';
		}else{
			$status = 'Sudah Dilunasi';
		} ?>
		<br>
		<h3 id="kur"><?php echo $status ?></h3>
	</div><br>
	</fieldset>
</body>
</html>
<script>window.print()</script>