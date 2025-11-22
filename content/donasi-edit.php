<?php
if (!defined("INDEX")) die("");

$id = $_GET['id'];

// Ambil data pengguna dari database
$query = "SELECT * FROM donasi WHERE id_donasi=?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
   echo "Data donasi tidak ditemukan!";
   exit;
}
?>

<!-- SELECT2 EXAMPLE -->
<section class="content">
   <div class="box box-header">
      <div class="box-header with-border">
         <h3 class="box-title">Edit Donasi</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <div class="row">
            <div class="col-md-6">
               <form action="?hal=donasi-update" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                     <input type="hidden" name="id_donasi" value="<?= $data['id_donasi'] ?>">

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="nama_donatur" class="col-sm-2 col-form-label">Nama Donatur</label>
                        <div class="col-sm-6">
                           <input type="text" name="nama_donatur" id="nama_donatur" class="form-control" maxlength="255" value="<?= $data['nama_donatur'] ?>" required>
                           <input type="hidden" name="id_pengubah" value="<?= $_SESSION['id_user'] ?>">
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="kegiatan" class="col-sm-2 col-form-label">Kegiatan</label>
                        <div class="col-sm-6">
                           <select name="kegiatan" id="kegiatan" class="form-control">
                              <option value="" disabled selected hidden>Pilih Kegiatan</option>
                              <option value="">-</option>
                              <?php
                              $sql_kegiatan = "SELECT id_kegiatan, nama_kegiatan FROM kegiatan_masjid";
                              $stmt = mysqli_prepare($con, $sql_kegiatan);
                              mysqli_stmt_execute($stmt);
                              $result = mysqli_stmt_get_result($stmt);
                              while ($option = mysqli_fetch_assoc($result)) { ?>
                                 <option value="<?= $option['id_kegiatan'] ?>" <?= $data['id_kegiatan'] == $option['id_kegiatan'] ? 'selected' : ''; ?>><?= $option['nama_kegiatan'] ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="tanggal_donasi" class="col-sm-2 col-form-label">Tanggal Donasi</label>
                        <div class="col-sm-6">
                           <input type="date" name="tanggal_donasi" id="tanggal_donasi" class="form-control" value="<?= $data['tanggal_donasi'] ?>" required>
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
                           <textarea class="form-control" rows="3" name="keterangan" id="keterangan" required><?= $data['keterangan'] ?></textarea>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="metode_pembayaran" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                        <div class="col-sm-6">
                           <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                              <option value="transfer_bank" <?= $data['metode_pembayaran'] === 'transfer_bank' ? 'selected' : '' ?>>Transfer Bank</option>
                              <option value="qris" <?= $data['metode_pembayaran'] === 'qris' ? 'selected' : '' ?>>QRIS</option>
                              <option value="tunai" <?= $data['metode_pembayaran'] === 'tunai' ? 'selected' : '' ?>>Tunai</option>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="status_verifikasi" class="col-sm-2 col-form-label">Status Verifikasi</label>
                        <div class="col-sm-6">
                           <select name="status_verifikasi" id="status_verifikasi" class="form-control" required>
                              <option value="pending" <?= $data['status_verifikasi'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                              <option value="verifikasi" <?= $data['status_verifikasi'] === 'verifikasi' ? 'selected' : '' ?>>Verifikasi</option>
                              <option value="rejected" <?= $data['status_verifikasi'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="bukti_transfer" class="col-sm-2 col-form-label">Bukti Transfer</label>
                        <div class="col-sm-6">
                           <input type="hidden" name="bukti_transfer_old" value="<?= $data['bukti_transfer'] ?>">
                           <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*" class="form-control" style="margin-bottom: 20px;">
                           <?php if (!empty($data['bukti_transfer'])) { ?>
                              <img src="<?= $data['bukti_transfer'] ?>" alt="Bukti Transfer"
                                 style="width: 50px; height: 50px; border-radius: 100%;">
                           <?php } else { ?>
                              <p style="margin-bottom: 10px;">Tidak ada bukti transfer.</p>
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                     <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-6">
                           <a href="?hal=donasi" class="btn btn-danger">Batal</a>
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