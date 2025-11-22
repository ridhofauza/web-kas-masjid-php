<?php
if (!defined('INDEX')) die("");
?>

<!-- Content Header (Page header) -->
<section class="content-header">
   <h1>
      Data Laporan
   </h1>

   <?php if ($_SESSION['role'] === 'admin'): ?>
   <a class="btn btn-success" style="margin-top: 10px;" href="?hal=laporan-tambah">Tambah</a>
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
                           <th style="border-color: #ddd;">Periode</th>
                           <th style="border-color: #ddd;">Total Pemasukan</th>
                           <th style="border-color: #ddd;">Total Pengeluaran</th>
                           <th style="border-color: #ddd;">Saldo Akhir</th>
                           <th style="border-color: #ddd;">Tanggal Dibuat</th>
                           <th style="border-color: #ddd;">Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $query = "SELECT l.*, s.nama as nama_pembuat FROM laporan l INNER JOIN users s ON l.dibuat_oleh = s.id_user ORDER BY id_laporan DESC";
                        $result = mysqli_query($con, $query);
                        $no = 0;

                        while ($data = mysqli_fetch_assoc($result)) {
                           $no++;
                        ?>
                           <tr>
                              <td style="border-color: #ddd;"><?= $no ?></td>
                              <td style="border-color: #ddd;"><?= $data['periode'] ?></td>
                              <td style="border-color: #ddd;"><?= rupiah($data['total_pemasukan']) ?></td>
                              <td style="border-color: #ddd;"><?= rupiah($data['total_pengeluaran']) ?></td>
                              <td style="border-color: #ddd;"><?= rupiah($data['saldo_akhir']) ?></td>
                              <td style="border-color: #ddd;"><?= $data['tanggal_dibuat'] ?></td>
                              <!-- Tombol Aksi -->
                              <td style="border-color: #ddd;">
                                 <!-- Tombol Edit -->
                                 <a href="<?= './'.$data['file_pdf'] ?>" target="_blank"
                                    class="btn btn-primary btn-sm">
                                    Lihat
                                 </a>

                                 <?php if ($_SESSION['role'] === 'admin'): ?>
                                 <!-- Tombol Hapus dengan Modal Konfirmasi -->
                                 <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#modal-hapus-<?= $data['id_laporan'] ?>">
                                    Hapus
                                 </button>

                                 <!-- Modal Konfirmasi Hapus -->
                                 <div class="modal modal-success fade"
                                    id="modal-hapus-<?= $data['id_laporan'] ?>">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                             <h4 class="modal-title">Konfirmasi Hapus</h4>
                                          </div>
                                          <div class="modal-body">
                                             <p>Apakah Anda yakin ingin menghapus laporan ini?</p>
                                          </div>
                                          <div class="modal-footer">
                                             <!-- Tombol Batal -->
                                             <button type="button" class="btn btn-outline pull-left"
                                                data-dismiss="modal">Batal</button>

                                             <!-- Tombol Hapus -->
                                             <a href="?hal=laporan-hapus&id=<?= $data['id_laporan'] ?>&file=<?= $data['file_pdf'] ?>"
                                                class='btn btn-outline'>Hapus</a>
                                          </div>
                                       </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                 </div><!-- /.modal -->
                                 <?php endif; ?>
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