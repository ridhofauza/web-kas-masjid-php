<?php
if(!defined("INDEX")) die("");

$foto = $_FILES['foto']['name'];
$lokasi = $_FILES['foto']['tmp_name'];
$tipe = $_FILES['foto']['type'];
$ukuran = $_FILES['foto']['size'];

$id = $_POST['id']; 
$nama = $_POST['nama'];
$jk = $_POST['jk'];
$tgl = $_POST['tanggal'];
$id_jabatan = $_POST['jabatan'];
$ket = $_POST['keterangan'];

$error = "";

if ($foto == "") {
    $query = "UPDATE pegawai SET ";
    $query .= "nama_pegawai = '$nama', ";
    $query .= "jenis_kelamin = '$jk', ";
    $query .= "tgl_lahir = '$tgl', ";
    $query .= "id_jabatan = '$id_jabatan', ";
    $query .= "keterangan = '$ket'";
    $query .= "WHERE id_pegawai = '$id'";

    $result = mysqli_query($con,$query);
} else {
    if ($tipe != "image/jpeg" and $tipe != "image/jpg" and $tipe != "image/png") {
        $error = "Maaf, tipe file tidak di dukung!";
    } elseif ($ukuran >= 1000000) {
        echo $ukuran;
        $error = "Ukuran file terlalu besar (lebih dari 1 MB)!";
    } else {

        // menghapus foto sebelumnya
        $query = "SELECT * FROM pegawai WHERE id_pegawai = '$id'";
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_assoc($result);

        if (file_exists("images/$data[foto]")) {
            unlink("images/$data[foto]");
        }
        
        move_uploaded_file($lokasi, "images/".$foto);

    $query = "UPDATE pegawai SET ";
    $query .= "foto = '$foto', ";
    $query .= "nama_pegawai = '$nama', ";
    $query .= "jenis_kelamin = '$jk', ";
    $query .= "tgl_lahir = '$tgl', ";
    $query .= "id_jabatan = '$id_jabatan', ";
    $query .= "keterangan = '$ket'";
    $query .= "WHERE id_pegawai = '$id'";

    $result = mysqli_query($con,$query);
    }
}

if ($error != "") {
    echo $error;
    echo "<meta http-equiv='refresh' content='2; url=?hal=pegawai_edit'>";
} elseif ($result) {?>
<script>
Swal.fire({
    // position: "top-end",
    icon: "success",
    title: "Data Pegawai berhasil diupdate",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php
// echo "Berhasil memperbaharui data pegawai <b>$nama</b>";
echo "
<meta http-equiv='refresh' content='2; url=?hal=pegawai'>";
} else {
echo "Tidak dapat menyimpan data!<br>";
echo mysqli_error();
}
?>