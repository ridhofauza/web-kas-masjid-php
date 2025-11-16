<?php
if (!defined("INDEX")) die("");

// Ambil ID transaksi dari URL
$id = $_GET['id'];

// Ambil data transaksi dari database
$query = "SELECT * FROM keuangan WHERE id_keuangan=?";
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
         <h3 class="box-title">Edit Keuangan</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <div class="row">
            <div class="col-md-6">
               <form action="?hal=keuangan-update" method="POST">
                  <div class="box-body">

                     <input type="hidden" name="id_keuangan" value="<?= htmlspecialchars($data['id_keuangan']) ?>">

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="sumber" class="col-sm-2 col-form-label">Sumber</label>
                        <div class="col-sm-6">
                           <input type="text" name="sumber" id="sumber" class="form-control"
                              value="<?= htmlspecialchars($data['sumber']) ?>" required>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-6">
                           <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $data['tanggal'] ?>" required>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                        <div class="col-sm-6">
                           <select name="jenis" id="jenis" class="form-control" required>
                              <option value="pemasukan" <?= $data['jenis'] == 'pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
                              <option value="pengeluaran" <?= $data['jenis'] == 'pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="donasi" class="col-sm-2 col-form-label">Donasi</label>
                        <div class="col-sm-6">
                           <select name="donasi" id="donasi" class="form-control">
                              <option value="" disabled selected hidden>Pilih Donasi</option>
                              <option value="">-</option>
                              <?php
                              $sql_donasi = "SELECT id_donasi, keterangan FROM donasi WHERE status_verifikasi='verifikasi'";
                              $stmt = mysqli_prepare($con, $sql_donasi);
                              mysqli_stmt_execute($stmt);
                              $result = mysqli_stmt_get_result($stmt);
                              while ($option = mysqli_fetch_assoc($result)) {
                              ?>
                                 <option value="<?= $option['id_donasi'] ?>" <?= $option['id_donasi'] == $data['id_donasi'] ? 'selected' : '' ?>><?= $option['id_donasi'] . ' - ' . htmlspecialchars($option['keterangan']) ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-6">
                           <select name="kategori" id="kategori" class="form-control">
                              <option value="" disabled selected hidden>Pilih Kategori</option>
                              <option value="">-</option>
                              <?php
                              $sql_kategori = "SELECT id_kategori, nama_kategori FROM kategori_keuangan";
                              $stmt = mysqli_prepare($con, $sql_kategori);
                              mysqli_stmt_execute($stmt);
                              $result = mysqli_stmt_get_result($stmt);
                              while ($option = mysqli_fetch_assoc($result)) {
                              ?>
                                 <option value="<?= $option['id_kategori'] ?>" <?= $option['id_kategori'] == $data['id_kategori'] ? 'selected' : '' ?>><?= $option['id_kategori'] . ' - ' . $option['nama_kategori'] ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-6">
                           <input type="number" name="jumlah" id="jumlah" placeholder="0" min="0" step="1" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" value="<?= $data['jumlah'] ?>" required>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-6">
                           <textarea class="form-control" rows="3" name="keterangan" id="keterangan"><?= htmlspecialchars($data['keterangan']) ?></textarea>
                        </div>
                     </div>

                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                     <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-6">
                           <a href="?hal=keuangan" class="btn btn-danger">Batal</a>
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