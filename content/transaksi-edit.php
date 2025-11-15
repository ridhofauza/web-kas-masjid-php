<?php
if (!defined("INDEX")) die("");

// Ambil ID transaksi dari URL
$id = $_GET['id'];

// Ambil data transaksi dari database
$query = "SELECT * FROM transaksi WHERE id_transaksi=?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data transaksi tidak ditemukan!";
    exit;
}
?>

<!-- SELECT2 EXAMPLE -->
<section class="content">
    <div class="box box-header">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Transaksi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="?hal=transaksi-update" method="POST">
                        <div class="box-body">

                            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id_transaksi']) ?>">

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                                        value="<?= htmlspecialchars($data['tanggal']) ?>" required>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="<?= htmlspecialchars($data['nama']) ?>" required>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-6">
                                    <select name="kategori" id="kategori" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="pemasukan"
                                            <?= ($data['kategori'] == 'pemasukan') ? 'selected' : ''; ?>>Pemasukan
                                        </option>
                                        <option value="pengeluaran"
                                            <?= ($data['kategori'] == 'pengeluaran') ? 'selected' : ''; ?>>Pengeluaran
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nominal" id="nominal" class="form-control"
                                        value="<?= htmlspecialchars($data['nominal']) ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rincian" class="col-sm-2 col-form-label">Rincian</label>
                                <div class="col-sm-6">
                                    <textarea name="rincian" id="rincian" class="form-control" rows="3"
                                        required><?= html_entity_decode($data['rincian']) ?></textarea>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <a href="?hal=transaksi" class="btn btn-danger">Batal</a>
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