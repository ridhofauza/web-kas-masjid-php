<?php
if(!defined("INDEX")) die("");
?>

<div class="card mt-4">
    <div class="card-header text-dark">
        <h4>Tambah Pegawai</h4>
    </div>
    <div class="card-body">
        <form action="?hal=pegawai_insert" method="post" enctype="multipart/form-data" class="mb-5">
            <div class="form-group row">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-4">
                    <div class="custom-file">
                        <input type="file" name="foto" id="foto" class="custom-file-input">
                        <label for="foto" class="custom-file-label">Pilih File</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-4">
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-4">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="jk" id="jk-laki" value="L" class="custom-control-input">
                        <label class="custom-control-label" for="jk-laki">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" name="jk" id="jk-perempuan" value="P" class="custom-control-input">
                        <label class="custom-control-label" for="jk-perempuan">Perempuan</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-4">
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-4">
                    <select name="jabatan" id="jabatan" class="custom-select" required>
                        <option value="">Pilih Jabatan</option>
                        <?php 
                $query = "SELECT * FROM jabatan";
                $result = mysqli_query($con, $query);
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<option value='$data[id_jabatan]'>$data[nama_jabatan]</option>";
                }
                ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-4">
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <a href="?hal=pegawai" class="btn btn-danger"><i class="bi bi-arrow-left"></i> Batal</a>
                    <button type="reset" class="btn btn-warning ms-2"><i class="bi bi-arrow-counterclockwise"></i>
                        Reset</button>
                    <button type="submit" class="btn btn-success ms-2"><i class="bi bi-save"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>