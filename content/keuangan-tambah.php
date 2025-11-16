<?php
if (!defined("INDEX")) die("");
?>

<!-- SELECT2 EXAMPLE -->
<section class="content">
   <div class="box box-body">
      <div class="box-header with-border">
         <h3 class="box-title">Tambah Keuangan</h3>

      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <div class="row">
            <div class="col-md-6">
               <form action="?hal=keuangan-insert" method="POST">
                  <div class="box-body">
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="sumber" class="col-sm-2 col-form-label">Sumber</label>
                        <div class="col-sm-6">
                           <input type="text" name="sumber" id="sumber" class="form-control" maxlength="100" required>
                        </div>
                     </div>
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-6">
                           <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                     </div>
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                        <div class="col-sm-6">
                           <select name="jenis" id="jenis" class="form-control" required>
                              <option value="" disabled selected hidden>Pilih Jenis</option>
                              <option value="pemasukan">Pemasukan</option>
                              <option value="pengeluaran">Pengeluaran</option>
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
                                 while($data = mysqli_fetch_assoc($result)) { 
                              ?>
                              <option value="<?= $data['id_donasi'] ?>"><?= $data['id_donasi'].' - '.htmlspecialchars($data['keterangan']) ?></option>
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
                                 while($data = mysqli_fetch_assoc($result)) {
                              ?>
                              <option value="<?= $data['id_kategori'] ?>"><?= $data['id_kategori'].' - '.$data['nama_kategori'] ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-6">
                           <input type="number" name="jumlah" id="jumlah" placeholder="0" min="0" step="1" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" required>
                        </div>
                     </div>
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-6">
                           <textarea class="form-control" rows="3" name="keterangan" id="keterangan"></textarea>
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
      <!-- /.box-body -->
   </div>
</section>
<!-- /.box -->
<!-- /.box -->