<?php
if (!defined('INDEX')) die("Akses langsung tidak diizinkan.");

// Ambil data pengguna dari database
$query = "SELECT u.nama as nama_donatur, k.nama_kegiatan, d.* FROM donasi d INNER JOIN users u ON u.id_user = d.id_user INNER JOIN kegiatan_masjid k ON k.id_kegiatan = d.id_kegiatan ORDER BY id_donasi DESC";
$result = mysqli_query($con, $query);
$no = 0;
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Donasi
    </h1>
    <a class="btn btn-success" style="margin-top: 10px;" href="?hal=donasi-tambah">Tambah</a>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped" style="border-color: #ddd;">
                            <thead>
                                <tr style="background: #2c3e50; color: white;">
                                    <th style="border-color: #ddd;">No</th>
                                    <th style="border-color: #ddd;">Nama Donatur</th>
                                    <th style="border-color: #ddd;">Nama Kegiatan</th>
                                    <th style="border-color: #ddd;">Tanggal Donasi</th>
                                    <th style="border-color: #ddd;">Jumlah</th>
                                    <th style="border-color: #ddd;">Keterangan</th>
                                    <th style="border-color: #ddd;">Metode Pembayaran</th>
                                    <th style="border-color: #ddd;">Status Verifikasi</th>
                                    <th style="border-color: #ddd;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = mysqli_fetch_assoc($result)) { 
                                $no++;
                            ?>
                                <tr>
                                    <td style="border-color: #ddd;"><?= $no ?></td>
                                    <td style="border-color: #ddd;"><?= htmlspecialchars($data['nama_donatur']) ?></td>
                                    <td style="border-color: #ddd;"><?= htmlspecialchars($data['nama_kegiatan']) ?></td>
                                    <td style="border-color: #ddd;"><?= htmlspecialchars($data['tanggal_donasi']) ?></td>
                                    <td style="border-color: #ddd;"><?= rupiah(htmlspecialchars($data['jumlah'])) ?></td>
                                    <td style="border-color: #ddd;"><?= htmlspecialchars($data['keterangan']) ?></td>
                                    <td style="border-color: #ddd;"><?= paymentMethod(htmlspecialchars($data['metode_pembayaran'])) ?></td>
                                    <td style="border-color: #ddd;">
                                       <span class="<?= htmlspecialchars($data['status_verifikasi']) === 'verifikasi'? 'bg-success' : (htmlspecialchars($data['status_verifikasi']) === 'pending' ? 'bg-info' : 'bg-warning') ?>" style="padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 600;"><?= strtoupper(htmlspecialchars($data['status_verifikasi'])) ?></span>
                                    </td>
                                    <td style="border-color: #ddd;">
                                        <a href="?hal=donasi-edit&id=<?= $data['id_donasi'] ?>"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <!-- Tombol Hapus dengan Modal Konfirmasi -->
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#modal-hapus-<?= $data['id_donasi'] ?>">
                                            Hapus
                                        </button>

                                        <!-- Cek Bukti Transfer -->
                                        <a href="<?= './'.$data['bukti_transfer'] ?>"
                                          class='btn btn-sm btn-primary'
                                          target="_blank">Bukti Transfer</a>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal modal-success fade"
                                            id="modal-hapus-<?= $data['id_donasi'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus donasi ini?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Tombol Batal -->
                                                        <button type="button" class="btn btn-outline pull-left"
                                                            data-dismiss="modal">Batal</button>

                                                        <!-- Tombol Hapus -->
                                                        <a href="?hal=donasi-hapus&id=<?= $data['id_donasi'] ?>&file=<?= $data['bukti_transfer'] ?>"
                                                            class='btn btn-outline'>Hapus</a>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->