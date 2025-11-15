<?php
if(!defined("INDEX")) die("");
?>

<!-- SELECT2 EXAMPLE -->
<section class="content">
    <div class="box box-body">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Kategori Keuangan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="?hal=kategori-keuangan-insert" method="POST">
                        <div class="box-body">
                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" maxlength="100" required>
                                </div>
                            </div>
                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi"></textarea>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <a href="?hal=kategori-keuangan" class="btn btn-danger">Batal</a>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
    </div>
</section>
<!-- /.box -->
<!-- /.box -->