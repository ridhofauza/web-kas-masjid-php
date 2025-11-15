<?php
if (!defined('INDEX')) die("");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Kegiatan Masjid
    </h1>
    <a class="btn btn-success" style="margin-top: 10px;" href="?hal=kegiatan-masjid-tambah">Tambah</a>
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
                                    <th style="border-color: #ddd;">Tanggal Mulai</th>
                                    <th style="border-color: #ddd;">Tanggal Selesai</th>
                                    <th style="border-color: #ddd;">Lokasi</th>
                                    <th style="border-color: #ddd;">Dibuat Oleh</th>
                                    <th style="border-color: #ddd;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $query = "SELECT k.*, s.nama as nama_pembuat FROM kegiatan_masjid k INNER JOIN users s ON k.dibuat_oleh = s.id_user ORDER BY id_kegiatan DESC";
                            $result = mysqli_query($con, $query);
                            $no = 0;

                            while ($data = mysqli_fetch_assoc($result)) {
                                $no++;
                            ?>
                                <tr>
                                    <td style="border-color: #ddd;"><?= $no ?></td>
                                    <td style="border-color: #ddd;"><?= $data['nama_kegiatan'] ?></td>
                                    <td style="border-color: #ddd;"><?= $data['deskripsi'] ?></td>
                                    <td style="border-color: #ddd;"><?= $data['tanggal_mulai'] ?></td>
                                    <td style="border-color: #ddd;"><?= $data['tanggal_selesai'] ?></td>
                                    <td style="border-color: #ddd;"><?= $data['lokasi'] ?></td>
                                    <td style="border-color: #ddd;"><?= $data['nama_pembuat'] ?></td>
                                    <!-- Tombol Aksi -->
                                    <td style="border-color: #ddd;">
                                        <!-- Tombol Edit -->
                                        <a href="?hal=kegiatan-masjid-edit&id=<?= $data['id_kegiatan'] ?>"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <!-- Tombol Hapus dengan Modal Konfirmasi -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#modal-hapus-<?= $data['id_kegiatan'] ?>">
                                            Hapus
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal modal-success fade"
                                            id="modal-hapus-<?= $data['id_kegiatan'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus kegiatan ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Tombol Batal -->
                                                        <button type="button" class="btn btn-outline pull-left"
                                                            data-dismiss="modal">Batal</button>

                                                        <!-- Tombol Hapus -->
                                                        <a href="?hal=kegiatan-masjid-hapus&id=<?= $data['id_kegiatan'] ?>"
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