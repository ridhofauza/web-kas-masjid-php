<?php
if(!defined("INDEX")) die("");


$id = $_GET['id'];
$query = "SELECT * FROM pegawai WHERE id_pegawai = '$id'";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_assoc($result);
?>

<div class="card mt-4">
    <div class="card-header text-dark">
        <h4>Edit Pegawai</h4>
    </div>
    <div class="card-body">
        <form action="?hal=pegawai_update" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$data['id_pegawai']?>">

            <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="foto">Foto</label>
                <div class="col-sm-4">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" id="foto"
                            onchange="previewImage(event)">
                        <label class="custom-file-label" for="foto" id="uploadFoto">Pilih Foto</label>
                        <img src="images/<?=$data['foto']?>" id="preview" width="120" alt="Foto Pegawai"
                            class="img-thumbnail mt-2 mb-5">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama Pegawai</label>
                <div class="col-sm-4">
                    <input type="text" name="nama" id="nama" class="form-control"
                        value="<?= htmlspecialchars($data['nama_pegawai'])?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-4">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="jk" id="laki" value="L"
                            <?= ($data['jenis_kelamin'] == "L") ? "checked" : ""; ?>>
                        <label class="custom-control-label" for="laki">Laki-laki</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="jk" id="perempuan" value="P"
                            <?= ($data['jenis_kelamin'] == "P") ? "checked" : ""; ?>>
                        <label class="custom-control-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-4">
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?=$data['tgl_lahir']?>"
                        required>
                </div>
            </div>

            <div class="form-group row">
                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-4">
                    <select name="jabatan" id="jabatan" class="custom-select">
                        <option value="">Pilih Jabatan</option>
                        <?php 
                        $queryj = "SELECT * FROM jabatan";
                        $resultj = mysqli_query($con, $queryj);
                        while ($j = mysqli_fetch_assoc($resultj)) {
                            echo "<option value='$j[id_jabatan]'";
                            if ($j['id_jabatan'] == $data['id_jabatan']) echo " selected"; 
                            echo "> $j[nama_jabatan] </option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-4">
                    <textarea name="keterangan" id="keterangan" class="form-control"
                        rows="5"><?=$data['keterangan']?></textarea>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="form-group row">
                <div class="col-sm-12 offset-sm-2">
                    <a href="?hal=pegawai" class='btn btn-danger me-2'><i class='bi bi-arrow-left'></i> Batal</a>
                    <button type='reset' class='btn btn-warning me-2'><i class='bi bi-arrow-counterclockwise'></i>
                        Reset</button>
                    <button type='submit' class='btn btn-success'><i class='bi bi-save'></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>