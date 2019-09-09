<html>
<?php if($this->session->userdata('alert') == "Sukses"){
            echo "<body onload='sukses()'>";
        }elseif ($this->session->userdata('alert') == "Gagal") {
            echo "<body onload='gagal()'>";
        }else{
            echo "<body>";
        };
        unset($_SESSION['alert']);?>
        <h3>Transaksi Penjualan Kredit</h3>
        <form method="POST" action="<?php echo site_url('Piutang/TambahDetail'); ?>">
            <div class="form-group">
              <label>Kode Penjualan</label>
              <input type="text" name="pk" value="<?php echo $pk; ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
              <label>Barang</label>
              <select name="kd_barang" class="form-control">
                <?php
                    foreach($barang as $data){
                        echo "<option value=".$data['kd_barang'].">".$data['nama_barang']."</option>";
                    }
                ?>
              </select>
            </div>
            <div class="form-group" style="width: 8%">
              <label>Jumlah</label>
              <input type="number" name="jumlah" class="form-control"><br>
              <?php echo form_error('jumlah'); ?>
            </div>
            <button type="submit" class="btn btn-default btn-info">Tambah Barang</button>
        </form>
        <h3 class="text-center" id="merienda">Daftar Penjualan</h3>
        <table class='table table-bordered'>
            <tr style="text-align: center; background-color: #a6a6a6">
                <td>Nama Barang</td>
                <td>Jumlah</td>
                <td>Harga per KG</td>
                <td>Subtotal</td>
            </tr>
            <?php
            $total = 0;
                foreach($detail as $data){
                    echo "
                        <tr>
                            <td>".$data['nama_barang']."</td>
                            <td align='right'>".$data['jumlah']."</td>
                            <td align='right'>".format_rp($data['harga'])."</td>
                            <td align='right'>".format_rp($data['subtotal'])."</td>
                        </tr>
                    ";
                    $total=$total + $data['subtotal'];
                }
            ?>
        </table>
        <form method="POST" action="<?php echo site_url('Piutang/Selesai'); ?>">
        <div class="form-group">
              <label>Pelanggan</label>
              <select name="id_pelanggan" class="form-control">
                <?php
                    foreach($pelanggan as $data){
                        echo "<option value=".$data['id_pelanggan'].">".$data['nama_pelanggan']."</option>";
                    }
                ?>
              </select>
              <!--<?php echo form_error('id_barang'); ?>-->
            </div>
            <input type="text" name="pk" value="<?php echo $pk; ?>" class="form-control" hidden>
            <input type="text" name="total" value="<?php echo $total; ?>" class="form-control" hidden>
            <button type="submit" class="btn btn-default btn-success">Selesai Jual</button>
          </form>
    </body>
</html>