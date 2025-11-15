<?php
if(!defined("INDEX")) die("");

$id = $_POST['id'];
$nama = $_POST['nama'];
$query = "UPDATE jabatan SET nama_jabatan = '$nama' WHERE id_jabatan = '$id'";
$result = mysqli_query($con,$query);

if ($result) {?>
<script>
Swal.fire({
    position: "top-end",
    icon: "success",
    title: "Data Jabatan berhasil diupdate",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php
    // echo "Jabatan berhasil diperbarui!";
    echo "<meta http-equiv='refresh' content='2; url=?hal=jabatan'>";
} else {
    echo "Tidak dapat memperbarui data!<br>";
    echo mysqli_error();
}
?>