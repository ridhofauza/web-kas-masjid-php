<?php
if(!defined("INDEX")) die("");

$id = $_GET['id'];
// isset($_GET['foto']) ? $_GET['foto'] : ''; untuk memastikan bahwa variabel $foto di-set dan tidak menghasilkan error jika tidak ada.
$foto = isset($_GET['foto']) ? $_GET['foto'] : ''; 


// Cek apakah foto ada dan valid sebelum menghapus
if (!empty($foto)) {
    $filePath = "images/$foto"; // Path file
    if (file_exists($filePath)) {
        if (!unlink($filePath)) {
            echo "Error: Tidak dapat menghapus file $filePath.<br>";
        }
    } else {
        echo "File $filePath tidak ditemukan.<br>";
    }
}

$query = "DELETE FROM pegawai WHERE id_pegawai = '$id'";
$result = mysqli_query($con,$query);

if ($result) {?>
<script>
Swal.fire({
    // position: "top-end",
    icon: "success",
    title: "Data Pegawai berhasil dihapus",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php
    // echo "Data pegawai berhasil dihapus!";
    echo "<meta http-equiv='refresh' content='2; url=?hal=pegawai'>";
} else {
    echo "Tidak dapat menghapus data pegawai!<br>";
    echo mysqli_error($con);
}
?>