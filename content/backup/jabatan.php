<?php
if (!defined("INDEX")) die("");
?>

<h4 class="mt-2">Data Jabatan</h4>
<hr>
<a class="btn btn-success mb-3" href="?hal=jabatan_tambah">
    <i class="bi bi-plus"></i>Tambah</a>

<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $query = "SELECT * FROM jabatan ORDER BY id_jabatan DESC";
        $result = mysqli_query($con, $query);
        $no = 0;
        while ($data = mysqli_fetch_array($result)) {
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nama_jabatan'] ?></td>
                <td>
                    <a href="?hal=jabatan_edit&id=<?= $data['id_jabatan'] ?>" class="btn btn-sm btn-warning">
                        Edit</a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                        data-target="#modal<?=$no?>">
                        Hapus
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" data-backdrop="static" id="modal<?=$no?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus Jabatan <b><?= $data['nama_jabatan'] ?></b>
                                </div>
                                <div class=" modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                    <a href="?hal=jabatan_hapus&id=<?= $data['id_jabatan'] ?>"
                                        class="btn btn-danger px-4">
                                        Ya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>