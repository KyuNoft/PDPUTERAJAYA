<html onload="lezat()">
<body>

	<div class="form-group">
              <label>Barang</label>
              <select onchange="hitung()" id='barang' name="kd_barang" class="form-control">
                <?php
                    foreach($barang as $data){
                        echo "<option data-harga=".$data['harga']." value=".$data['kd_barang'].">".$data['nama_barang']."</option>";
                    }
                ?>
              </select>
            </div>


            <div class="form-group">
              <label>Kode Pembelian</label>
              <input id="kd" type="text" name="pk" class="form-control" readonly>
            </div>

            <div class="form-group">
              <label>Total</label>
              <input id="hasil" type="text" name="pk" class="form-control" readonly>
            </div>

            <?php
            $utang = new DateTime('2018-11-11');
            $bayar = new DateTime(date('Y-m-d'));
            $days  = $bayar->diff($utang)->format('%a');
            $total = 3 + $days;
            echo "<p>".$total."</p>"
            ?>

</body>
</html>