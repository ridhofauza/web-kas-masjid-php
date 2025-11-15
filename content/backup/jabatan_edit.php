<?php
if(!defined("INDEX")) die("");

$id = $_GET['id'];
$query = "SELECT * FROM jabatan WHERE id_jabatan='$id'";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result)
?>


<div class="container mt-4">
    <div class="card">
        <h4 class="card-header">Edit Jabatan</h4>
        <div class="card-body">
            <form action="?hal=jabatan_update" method="post">
                <input type="hidden" name="id" value="<?= $data['id_jabatan']?>">

                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama Jabatan</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" id="nama" class="form-control"
                            value="<?= htmlspecialchars($data['nama_jabatan'])?>">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-4 offset-sm-2">
                        <a href="?hal=jabatan" class="btn btn-danger"><i class="bi bi-arrow-left"></i> Batal</a>
                        <button type="reset" class="btn btn-warning"><i class="bi bi-arrow-counterclockwise"></i>
                            Reset</button>
                        <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>