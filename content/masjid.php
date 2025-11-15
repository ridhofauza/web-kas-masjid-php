<?php
if (!defined("INDEX")) die("");

$query = "SELECT * FROM masjid";
$result = mysqli_query($con, $query);

if ($result) {
    $data = mysqli_fetch_assoc($result);

    // Pastikan data ditemukan
    if ($data) {
        // Ambil nilai dari database
        $nama = htmlspecialchars($data['nama'] ?? '');
        $alamat = htmlspecialchars($data['alamat'] ?? '');
        $email = htmlspecialchars($data['email'] ?? '');
        $no_telp = htmlspecialchars($data['no_telp'] ?? '');
        $bank = htmlspecialchars($data['bank'] ?? '');
        $no_rek = htmlspecialchars($data['no_rek'] ?? '');
        $ketua_takmir = htmlspecialchars($data['ketua_takmir'] ?? '');
        $sekretaris = htmlspecialchars($data['sekretaris'] ?? '');
        $bendahara = htmlspecialchars($data['bendahara'] ?? '');
        $logo = htmlspecialchars($data['logo'] ?? '');
    } else {
        // Jika data tidak ditemukan, set nilai default
        $nama = "";
        $alamat = "";
        $email = "";
        $no_telp = "";
        $bank = "";
        $no_rek = "";
        $ketua_takmir = "";
        $sekretaris = "";
        $bendahara = "";
        $logo = "";
        echo "Data tidak ditemukan!"; // Tampilkan pesan jika data tidak ditemukan
    }
} else {
    echo "Error: " . mysqli_error($con); // Tampilkan pesan error jika query gagal
    exit;
}
?>

<section class="content">
    <div class="box box-header">
        <div class="box-header with-border">
            <h3 class="box-title">Struktur Masjid</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-default">
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="box-body">
                        <div class="form-group row" style="display: flex; align-items: center;">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama" id="nama" class="form-control" readonly
                                    value="<?= $nama ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea name="alamat" id="alamat" class="form-control" rows="3"
                                    readonly><?= $alamat ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; align-items: center;">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email" id="email" class="form-control" readonly
                                    value="<?= $email ?>">
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; align-items: center;">
                            <label for="no_telp" class="col-sm-3 col-form-label">No. Telp</label>
                            <div class="col-sm-8">
                                <input type="number" name="no_telp" id="no_telp" class="form-control" readonly
                                    value="<?= $no_telp ?>">
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; align-items: center;">
                            <label for="bank" class="col-sm-3 col-form-label">Bank</label>
                            <div class="col-sm-8">
                                <input type="text" name="bank" id="bank" class="form-control" readonly
                                    value="<?= $bank ?>">
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; align-items: center;">
                            <label for="no_rek" class="col-sm-3 col-form-label">No. Rek</label>
                            <div class="col-sm-8">
                                <input type="number" name="no_rek" id="no_rek" class="form-control" readonly
                                    value="<?= $no_rek ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="box-body">
                        <div class="form-group row" style="display: flex; align-items: center;">
                            <label for="ketua_takmir" class="col-sm-3 col-form-label">Ketua Takmir</label>
                            <div class="col-sm-8">
                                <input type="text" name="ketua_takmir" id="ketua_takmir" class="form-control" readonly
                                    value="<?= $ketua_takmir ?>">
                            </div>
                        </div>
                        <div class="form-group row" style="display: flex; align-items: center;">
                            <label for="sekretaris" class="col-sm-3 col-form-label">Sekretaris</label>
                            <div class="col-sm-8">
                                <input type="text" name="sekretaris" id="sekretaris" class="form-control" readonly
                                    value="<?= $sekretaris ?>">
                            </div>
                        </div>

                        <div class="form-group row" style="display: flex; align-items: center;">
                            <label for="bendahara" class="col-sm-3 col-form-label">Bendahara</label>
                            <div class="col-sm-8">
                                <input type="text" name="bendahara" id="bendahara" class="form-control" readonly
                                    value="<?= $bendahara ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logo" class="col-sm-3 col-form-label">Logo</label>
                            <div class="col-sm-8">
                                <?php if (isset($data['logo']) && !empty($data['logo'])) : ?>
                                <img src="images/<?= htmlspecialchars($logo) ?>" width="100">
                                <?php else : ?>
                                Logo belum diunggah.
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="box-default">
                            <div class="form-group row">
                                <!-- Label kosong untuk menyelaraskan tombol -->
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-6">
                                    <a href="?hal=masjid-edit" class="btn btn-warning">Edit</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</section>