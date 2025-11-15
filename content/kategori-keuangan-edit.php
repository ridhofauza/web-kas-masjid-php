<?php
if (!defined("INDEX")) die("");

// Ambil ID transaksi dari URL
$id = $_GET['id'];

// Ambil data transaksi dari database
$query = "SELECT * FROM kategori_keuangan WHERE id_kategori=?";
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
            <h3 class="box-title">Edit Kategori Keuangan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="?hal=kategori-keuangan-update" method="POST">
                        <div class="box-body">

                            <input type="hidden" name="id_kategori" value="<?= htmlspecialchars($data['id_kategori']) ?>">

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                                        value="<?= htmlspecialchars($data['nama_kategori']) ?>" required>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <a href="?hal=kategori-keuangan" class="btn btn-danger">Batal</a>
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