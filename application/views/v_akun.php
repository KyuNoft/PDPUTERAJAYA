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
        <li class="breadcrumb-item active">Akun</li>
    </ol>

    <h3 class="text-center" id="merienda">Data Akun</h3>
    <a class="btn btn-info text-white" role="button" data-toggle="modal" data-target="#Tambah" id="boo"><i class="fa fa-fw fa-plus-circle"></i> Add Akun</a><br><br>

    <!--Tabel-->
    <div class="card mb-3">
        <div class="card-header"><i class="fas fa-table"></i> Data Akun</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>No Akun</th>
                                <th>Nama Akun</th>
                                <th style="text-align: center;">Ubah/Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($akun as $data) { ?>
                                <tr>
                                    <td><?php echo $data->no_akun; ?></td>
                                    <td><?php echo $data->nama_akun; ?></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn" data-toggle="modal" data-target="#Ubah<?php echo $data->no_akun;?>"><i class="fa fa-fw fa-edit"></i></button> / 
                                        <button type="button" class="btn" data-toggle="modal" data-target="#Hapus<?php echo $data->no_akun;?>"><i class="fa fa-fw fa-trash"></i></button></td>
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
                            <h4 class="modal-title" id="merienda">Akun</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form method="POST" action="<?php echo site_url('Akun/Tambah'); ?>">
                                <div class="form-group">
                                    <label>No Akun</label>
                                    <input type="text" name="no_akun" class="form-control"><br>
                                    <?php echo form_error('no_akun'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama Akun</label>
                                    <input type="text" name="nama_akun" class="form-control"><br>
                                    <?php echo form_error('nama_akun'); ?>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="boo"><i class="fa fa-save"></i> Simpan Akun</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal Ubah -->
            <?php foreach ($akun as $data) { ?>
            <div class="modal fade" id="Ubah<?php echo $data->no_akun;?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title" id="merienda">Ubah Akun</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <form method="POST" action="<?php echo site_url('Akun/Ubah'); ?>">
                                <div class="form-group">
                                    <label>No Akun</label>
                                    <input type="text" name="no_akun" class="form-control" value="<?php echo $data->no_akun; ?>" readonly><br>
                                    <?php echo form_error('no_akun'); ?>
                                </div>
                                <div class="form-group">
                                    <label>Nama Akun</label>
                                    <input type="text" name="nama_akun" class="form-control" value="<?php echo $data->nama_akun; ?>"><br>
                                    <?php echo form_error('nama_akun'); ?>
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
            <?php foreach ($akun as $data) { ?>
                <div id="Hapus<?php echo $data->no_akun;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title" id="merienda">Akun</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <p>Hapus Data?</p>
                            </div>

                            <div class="modal-footer">
                                <a href="<?php echo site_url('Akun/Hapus/'.$data->no_akun.''); ?>" role="button" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i>Hapus</a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </body>
        </html>