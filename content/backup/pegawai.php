<?php
if (!defined("INDEX")) die("");
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header text-black">
            <h4 class="mb-0">Data pegawai</h4>
        </div>
        <div class="card-body">
            <a class="btn btn-success mb-3" href="?hal=pegawai_tambah">
                <i class="bi bi-plus"></i>Tambah</a>


            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>pegawai</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
        $query = "SELECT * FROM pegawai ";
        $query .= "LEFT JOIN jabatan ";
        $query .= "ON pegawai.id_pegawai = jabatan.id_jabatan ";
        $query .= "ORDER BY pegawai.id_pegawai DESC";
        $result = mysqli_query($con, $query);
        $no = 0;
        
        while ($data = mysqli_fetch_assoc($result)) {
            $no++;
        ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td>
                                <?php 
                if (isset($data['foto'])) {
                    ?>
                                <img src="images/<?=$data['foto']?>" width="100">
                                <?php
                }
                ?>

                            </td>
                            <td><?= $data['nama_pegawai'] ?></td>
                            <td><?= $data['jenis_kelamin'] ?></td>
                            <td><?= $data['tgl_lahir'] ?></td>
                            <td><?= $data['nama_jabatan'] ?></td>
                            <td><?= $data['keterangan'] ?></td>
                            <td>
                                <a href="?hal=pegawai_edit&id=<?= $data['id_pegawai'] ?>"
                                    class="btn btn-sm btn-warning">
                                    Edit</a>
                                <a href="?hal=pegawai_hapus&id=<?= $data['id_pegawai'] ?>"
                                    class="btn btn-sm btn-danger">
                                    Hapus</a>
                            </td>
                        </tr>
                        <?php
        }
        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>