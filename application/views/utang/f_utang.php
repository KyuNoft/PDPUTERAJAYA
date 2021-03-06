<html>
<?php if($this->session->userdata('alert') == "Sukses"){
            echo "<body onload='sukses()'>";
        }elseif ($this->session->userdata('alert') == "Gagal") {
            echo "<body onload='gagal()'>";
        }else{
            echo "<body>";
        };
        unset($_SESSION['alert']);?>
        <h3>Transaksi Pembelian Kredit</h3>
        <form method="POST" action="<?php echo site_url('Utang/TambahDetail'); ?>">
            <div class="form-group">
              <label>Kode Pembelian</label>
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
        <h3 class="text-center" id="merienda">Daftar Pembelian</h3>
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
        <form method="POST" action="<?php echo site_url('Utang/Selesai'); ?>">
             <div class="form-group">
              <label>Potongan</label>
              <select name="kondisi" class="form-control">
                <option value="N/A">N/A</option>
                <option value="2/15">2/15 (Potongan 2% untuk pelunasan kurun waktu 15 Hari)</option>
                <option value="3/10">3/10 (Potongan 3% untuk pelunasan kurun waktu 10 Hari)</option>
                <option value="5/5">5/5 (Potongan 5% untuk pelunasan kurun waktu 5 Hari)</option>
              </select>
              <!--<?php echo form_error('id_barang'); ?>-->
            </div>
        <div class="form-group">
              <label>Pemasok</label>
              <select name="id_pemasok" class="form-control">
                <?php
                    foreach($pemasok as $data){
                        echo "<option value=".$data['id_pemasok'].">".$data['nama_pemasok']."</option>";
                    }
                ?>
              </select>
              <!--<?php echo form_error('id_barang'); ?>-->
            </div>
            <input type="text" name="pk" value="<?php echo $pk; ?>" class="form-control" hidden>
            <input type="text" name="total" value="<?php echo $total; ?>" class="form-control" hidden>
            <button type="submit" class="btn btn-default btn-success">Selesai Beli</button>
          </form>
    </body>
</html>