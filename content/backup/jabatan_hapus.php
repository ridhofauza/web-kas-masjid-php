<?php
if(!defined("INDEX")) die("");

$id = $_GET['id'];
$query = "DELETE FROM jabatan WHERE id_jabatan = '$id'";
$result = mysqli_query($con,$query);

if ($result) {?>
<script>
Swal.fire({
    // position: "top-end",
    icon: "success",
    title: "Data Jabatan berhasil dihapus",
    showConfirmButton: false,
    timer: 1500
});
</script>
<?php

echo "
<meta http-equiv='refresh' content='2; url=?hal=jabatan'>";
} else {
echo "Tidak dapat maneghapus data!<br>";
echo mysqli_error();
}
?>