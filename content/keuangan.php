<?php
if (!defined('INDEX')) die("");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Keuangan
    </h1>

    <?php if ($_SESSION['role'] === 'admin'): ?>
    <a class="btn btn-success" style="margin-top: 10px;" href="?hal=keuangan-tambah">Tambah</a>
    <?php endif; ?>

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
                                    <th style="border-color: #ddd;">Tanggal</th>
                                    <th style="border-color: #ddd;">Jenis</th>
                                    <th style="border-color: #ddd;">Jumlah</th>
                                    <th style="border-color: #ddd;">Keterangan</th>
                                    <th style="border-color: #ddd;">Donasi</th>
                                    <th style="border-color: #ddd;">Kategori</th>
                                    <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <th style="border-color: #ddd;">Aksi</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $query = "SELECT IFNULL(d.keterangan, '-') as keterangan_donasi, IFNULL(ku.nama_kategori, '-') as nama_kategori, k.* FROM keuangan k LEFT JOIN donasi d ON k.id_donasi = d.id_donasi LEFT JOIN kategori_keuangan ku ON ku.id_kategori = k.id_kategori ORDER BY k.id_keuangan DESC, k.tanggal DESC";
                            $result = mysqli_query($con, $query);
                            $no = 0;

                            while ($data = mysqli_fetch_assoc($result)) {
                                $no++;
                            ?>
                                <tr>
                                    <td style="border-color: #ddd;"><?= $no ?></td>
                                    <td style="border-color: #ddd;"><?= $data['tanggal'] ?></td>
                                    <td style="border-color: #ddd;"><?= $data['jenis'] ?></td>
                                    <td style="border-color: #ddd;"><?= rupiah($data['jumlah']) ?></td>
                                    <td style="border-color: #ddd;"><?= $data['keterangan'] ?></td>
                                    <td style="border-color: #ddd;"><?= $data['keterangan_donasi'] ?></td>
                                    <td style="border-color: #ddd;"><?= $data['nama_kategori'] ?></td>
                                    <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <!-- Tombol Aksi -->
                                    <td style="border-color: #ddd;">
                                        <!-- Tombol Edit -->
                                        <a href="?hal=keuangan-edit&id=<?= $data['id_keuangan'] ?>"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <!-- Tombol Hapus dengan Modal Konfirmasi -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#modal-hapus-<?= $data['id_keuangan'] ?>">
                                            Hapus
                                        </button>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal modal-success fade"
                                            id="modal-hapus-<?= $data['id_keuangan'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data keuangan ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Tombol Batal -->
                                                        <button type="button" class="btn btn-outline pull-left"
                                                            data-dismiss="modal">Batal</button>

                                                        <!-- Tombol Hapus -->
                                                        <a href="?hal=keuangan-hapus&id=<?= $data['id_keuangan'] ?>"
                                                            class='btn btn-outline'>Hapus</a>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </td>
                                    <?php endif; ?>
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