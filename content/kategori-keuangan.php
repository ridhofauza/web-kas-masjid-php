<?php
if (!defined('INDEX')) die("");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Kategori Keuangan
    </h1>
    <a class="btn btn-success" style="margin-top: 10px;" href="?hal=kategori-keuangan-tambah">Tambah</a>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped" style="border-color: #ddd;">
                            <thead>
                                <tr style="background: #2c3e50; color: white;">
                                    <th style="border-color: #ddd;">No</th>
                                    <th style="border-color: #ddd;">Nama Kegiatan</th>
                                    <th style="border-color: #ddd;">Deskripsi</th>
                                    <th style="border-color: #ddd;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $query = "SELECT * FROM kategori_keuangan ORDER BY id_kategori DESC";
                            $result = mysqli_query($con, $query);
                            $no = 0;

                            while ($data = mysqli_fetch_assoc($result)) {
                                $no++;
                            ?>
                                <tr>
                                    <td style="border-color: #ddd;"><?= $no ?></td>
                                    <td style="border-color: #ddd;"><?= $data['nama_kategori'] ?></td>
                                    <td style="border-color: #ddd;"><?= $data['deskripsi'] ?></td>
                                    <!-- Tombol Aksi -->
                                    <td style="border-color: #ddd;">
                                        <!-- Tombol Edit -->
                                        <a href="?hal=kategori-keuangan-edit&id=<?= $data['id_kategori'] ?>"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <!-- Tombol Hapus dengan Modal Konfirmasi -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#modal-hapus-<?= $data['id_kategori'] ?>">
                                            Hapus
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal modal-success fade"
                                            id="modal-hapus-<?= $data['id_kategori'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Tombol Batal -->
                                                        <button type="button" class="btn btn-outline pull-left"
                                                            data-dismiss="modal">Batal</button>

                                                        <!-- Tombol Hapus -->
                                                        <a href="?hal=kategori-keuangan-hapus&id=<?= $data['id_kategori'] ?>"
                                                            class='btn btn-outline'>Hapus</a>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

</section>
<!-- /.content -->