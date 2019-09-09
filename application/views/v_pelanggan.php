<html>
<?php if($this->session->userdata('alert') == "Sukses"){
            echo "<body onload='sukses()'>";
        }elseif ($this->session->userdata('alert') == "Gagal") {
            echo "<body onload='gagal()'>";
        }else{
            echo "<body>";
        };
        unset($_SESSION['alert']);?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Master Data</li>
        <li class="breadcrumb-item active">Pelanggan</li>
    </ol>

    <h3 class="text-center" id="merienda">Data Pelanggan</h3>
    <a class="btn btn-info text-white" role="button" data-toggle="modal" data-target="#Tambah" id="boo"><i class="fa fa-fw fa-plus-circle"></i> Add Pelanggan</a><br><br>

    <!--Tabel-->
    <div class="card mb-3">
        <div class="card-header"><i class="fas fa-table"></i> Data Pelanggan</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th style="text-align: center;">Ubah/Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pelanggan as $data) { ?>
                                <tr>
                                    <td><?php echo $data->id_pelanggan; ?></td>
                                    <td><?php echo $data->nama_pelanggan; ?></td>
                                    <td><?php echo $data->no_telp; ?></td>
                                    <td><?php echo $data->alamat; ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn" data-toggle="modal" data-target="#Ubah<?php echo $data->id_pelanggan;?>"><i class="fa fa-fw fa-edit"></i></button> / 
                                        <button type="button" class="btn" data-toggle="modal" data-target="#Hapus<?php echo $data->id_pelanggan;?>"><i class="fa fa-fw fa-trash"></i></button></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted"><?php date_default_timezone_set("Asia/Jakarta");
                echo "Updated ".date("Y-m-d")." ".date("h:i:sa"); ?></div>
            </div>

            <!-- Modal Tambah -->
            <div class="modal fade" id="Tambah">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="merienda">Pelanggan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form method="POST" action="<?php echo site_url('Pelanggan/Tambah'); ?>">
                                <div class="form-group">
                                    <label>ID Pelanggan</label>
                                    <input type="text" name="id_pelanggan" class="form-control" value="<?php echo $pk; ?>" readonly><br>
                                    <?php echo form_error('id_pelanggan'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" class="form-control"><br>
                                    <?php echo form_error('nama_pelanggan'); ?>
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" name="no_telp" class="form-control"><br>
                                    <?php echo form_error('no_telp'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control"></textarea><br>
                                    <?php echo form_error('alamat'); ?>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="boo"><i class="fa fa-save"></i> Simpan Pelanggan</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Ubah -->
            <?php foreach ($pelanggan as $data) { ?>
            <div class="modal fade" id="Ubah<?php echo $data->id_pelanggan;?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="merienda">Ubah Pelanggan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form method="POST" action="<?php echo site_url('Pelanggan/Ubah'); ?>">
                                <div class="form-group">
                                    <label>ID Pelanggan</label>
                                    <input type="text" name="id_pelanggan" class="form-control" value="<?php echo $data->id_pelanggan; ?>" readonly><br>
                                    <?php echo form_error('id_pelanggan'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" class="form-control" value="<?php echo $data->nama_pelanggan; ?>"><br>
                                    <?php echo form_error('nama_pelanggan'); ?>
                                </div>
                                <div class="form-group">
                                    <label>No Telepon</label>
                                    <input type="text" name="no_telp" class="form-control" value="<?php echo $data->no_telp; ?>"><br>
                                    <?php echo form_error('no_telp'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control"><?php echo $data->alamat; ?></textarea><br>
                                    <?php echo form_error('alamat'); ?>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" id="boo"><i class="fa fa-edit"></i> Ubah</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Modal Hapus -->
            <?php foreach ($pelanggan as $data) { ?>
                <div id="Hapus<?php echo $data->id_pelanggan;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="merienda">Pelanggan</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <p>Hapus Data?</p>
                            </div>

                            <div class="modal-footer">
                                <a href="<?php echo site_url('Pelanggan/Hapus/'.$data->id_pelanggan.''); ?>" role="button" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i>Hapus</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>

        </body>
        </html>