<?php
if (!defined("INDEX")) die("");
?>

<!-- SELECT2 EXAMPLE -->
<section class="content">
   <div class="box box-body">
      <div class="box-header with-border">
         <h3 class="box-title">Tambah Laporan</h3>

      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <div class="row">
            <div class="col-md-6">
               <form action="?hal=laporan-insert" method="POST">
                  <div class="box-body">
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="periode_tahun" class="col-sm-2 col-form-label">Periode Tahun</label>
                        <div class="col-sm-6">
                           <input type="number" name="periode_tahun" id="periode_tahun" placeholder="YYYY" value="<?= date('Y') ?>" min="1990" max="<?= date('Y') ?>" step="1" inputmode="numeric" oninput="validateYear(this)" class="form-control" required>
                        </div>
                     </div>
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="periode_bulan" class="col-sm-2 col-form-label">Periode Bulan</label>
                        <div class="col-sm-6">
                           <select name="periode_bulan" id="periode_bulan" class="form-control" onchange="getDataLaporan()" required>
                              <option value="" disabled selected hidden>Pilih Periode</option>
                              <?php
                              $bulan = mapMonth();
                              foreach ($bulan as $key => $value) {
                              ?>
                                 <option value="<?= $key ?>"><?= $value ?></option>
                              <?php
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="total_pemasukan" class="col-sm-2 col-form-label">Total Pemasukan</label>
                        <div class="col-sm-6">
                           <input type="number" name="total_pemasukan" id="total_pemasukan" placeholder="0" min="0" step="1" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" required readonly>
                        </div>
                     </div>
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="total_pengeluaran" class="col-sm-2 col-form-label">Total Pengeluaran</label>
                        <div class="col-sm-6">
                           <input type="number" name="total_pengeluaran" id="total_pengeluaran" placeholder="0" min="0" step="1" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" required readonly>
                        </div>
                     </div>
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="saldo_akhir" class="col-sm-2 col-form-label">Saldo Akhir</label>
                        <div class="col-sm-6">
                           <input type="number" name="saldo_akhir" id="saldo_akhir" placeholder="0" min="0" step="1" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" required readonly>
                        </div>
                     </div>
                     <div class="form-group row" style="display: flex; align-items: center;">
                        <label for="nama_user" class="col-sm-2 col-form-label">Dibuat oleh</label>
                        <?php
                        $id_user = $_SESSION['id_user'];
                        $sql_user = "SELECT id_user, nama FROM users WHERE id_user = ?";
                        $stmt_user = mysqli_prepare($con, $sql_user);
                        mysqli_stmt_bind_param($stmt_user, "i", $id_user);
                        mysqli_stmt_execute($stmt_user);
                        $result = mysqli_stmt_get_result($stmt_user);
                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                           <div class="col-sm-6">
                              <input type="text" name="nama_user" id="nama_user" class="form-control" maxlength="100" value="<?= $data['nama'] ?>" readonly required>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                     <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-6">
                           <a href="?hal=laporan" class="btn btn-danger">Batal</a>
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

<script>
   function validateYear(input) {
      input.value = input.value.replace(/[^0-9]/g, '').slice(0, 4);
      let currentYear = new Date().getFullYear();
      if (input.value.length === 4 && input.value > currentYear) {
         input.value = currentYear;
      }
      if (input.value.length === 4 && input.value < 1990) {
         input.value = 1990;
      }
   }

   function getDataLaporan() {
      const periodeTahun = document.getElementById('periode_tahun');
      const periodeBulan = document.getElementById('periode_bulan');
      const totalPemasukan = document.getElementById('total_pemasukan');
      const totalPengeluaran = document.getElementById('total_pengeluaran');
      const saldoAkhir = document.getElementById('saldo_akhir');


      $.ajax({
         url: "./konten-json.php?hal=laporan-data-ajax",
         type: "POST", // HTTP Method
         dataType: "json", // expect JSON response
         data: {
            periode_tahun: periodeTahun.value,
            periode_bulan: periodeBulan.value
         },
         success: function(response) {
            console.log('response ajax: ', response);
            totalPemasukan.value = response.total_pemasukan;
            totalPengeluaran.value = response.total_pengeluaran;
            saldoAkhir.value = response.saldo_akhir;
         },
         error: function(xhr, status, error) {
            console.error(xhr.responseText);
            console.error(error);
         }
      });
   }
</script>
<!-- /.box -->