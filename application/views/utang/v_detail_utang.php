<html>
<ol class="breadcrumb">
        <li class="breadcrumb-item active">Transaksi</li>
        <li class="breadcrumb-item active">Utang</li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
<body>
    <h3 class="text-center" id="merienda">Daftar Utang</h3>
    <table class='table table-bordered' style="width: 60%; margin-top: 2%; margin-left: 20%">
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
                    $total= $total + $data['subtotal'];
                }
            ?>
            <tr>
                <td colspan="3" style="text-align: center;">Total</td>
                <td style="text-align: right;"><?php echo format_rp($total) ?></td>
            </tr>
        </table>
        <div style="margin-left: 20%">
        <a href="<?php echo site_url('Utang'); ?>" role="button" class="btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    </div>
</body>
</html>