<?php
if(!defined("INDEX")) die("");
?>

<!-- SELECT2 EXAMPLE -->
<section class="content">
    <div class="box box-body">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Donasi</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="?hal=donasi-insert" method="POST" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="donatur" class="col-sm-2 col-form-label">Donatur</label>
                                <div class="col-sm-6">
                                    <select name="donatur" id="donatur" class="form-control" required>
                                        <option value="" disabled selected hidden>Pilih Donatur</option>
                                       <?php 
                                       $sql_donatur = "SELECT id_user, nama FROM users";
                                       $stmt = mysqli_prepare($con, $sql_donatur);
                                       mysqli_stmt_execute($stmt);
                                       $result = mysqli_stmt_get_result($stmt);
                                       while($data = mysqli_fetch_assoc($result)) { ?>
                                          <option value="<?= $data['id_user'] ?>"><?= $data['id_user'].' - '. $data['nama'] ?></option>
                                       <?php } ?>
                                    </select>
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
                                       while($data = mysqli_fetch_assoc($result)) { ?>
                                          <option value="<?= $data['id_kegiatan'] ?>"><?= $data['id_kegiatan'].' - '. $data['nama_kegiatan'] ?></option>
                                       <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="tanggal_donasi" class="col-sm-2 col-form-label">Tanggal Donasi</label>
                                <div class="col-sm-6">
                                    <input type="date" name="tanggal_donasi" id="tanggal_donasi" class="form-control" required>
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
                                    <textarea class="form-control" rows="3" name="keterangan" id="keterangan" required></textarea>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="metode_pembayaran" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-6">
                                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                                        <option value="" disabled selected hidden>Pilih Metode Pembayaran</option>
                                        <option value="transfer_bank">Transfer Bank</option>
                                        <option value="qris">QRIS</option>
                                        <option value="tunai">Tunai</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="status_verifikasi" class="col-sm-2 col-form-label">Status Verifikasi</label>
                                <div class="col-sm-6">
                                    <select name="status_verifikasi" id="status_verifikasi" class="form-control" required>
                                        <option value="" disabled selected hidden>Pilih Status Verifikasi</option>
                                        <option value="pending">Pending</option>
                                        <option value="verifikasi">Verifikasi</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="bukti_transfer" class="col-sm-2 col-form-label">Bukti Transfer</label>
                                <div class="col-sm-6">
                                    <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*" class="form-control"
                                        required>
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
        <!-- /.box-body -->
    </div>
</section>
<!-- /.box -->
<!-- /.box -->