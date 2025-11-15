<?php
if (!defined("INDEX")) die("");

// Ambil ID transaksi dari URL
$id = $_GET['id'];

// Ambil data transaksi dari database
$query = "SELECT * FROM kegiatan_masjid WHERE id_kegiatan=?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data kegiatan tidak ditemukan!";
    exit;
}
?>

<!-- SELECT2 EXAMPLE -->
<section class="content">
    <div class="box box-header">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Kegiatan Masjid</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="?hal=kegiatan-masjid-update" method="POST">
                        <div class="box-body">

                            <input type="hidden" name="id_kegiatan" value="<?= htmlspecialchars($data['id_kegiatan']) ?>">

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="nama_kegiatan" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control"
                                        value="<?= htmlspecialchars($data['nama_kegiatan']) ?>" required>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="tanggal_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?= $data['tanggal_mulai'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="tanggal_selesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"  
                                    value="<?= $data['tanggal_selesai'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                                <div class="col-sm-6">
                                    <input type="text" name="lokasi" id="lokasi" class="form-control" maxlength="255" value="<?= $data['lokasi'] ?>" required>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <a href="?hal=kegiatan-masjid" class="btn btn-danger">Batal</a>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</section>
<!-- /.box -->