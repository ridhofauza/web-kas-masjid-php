<?php
if(!defined("INDEX")) die("");
?>

<!-- SELECT2 EXAMPLE -->
<section class="content">
    <div class="box box-body">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Pengguna</h3>

            <!-- <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                        class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                        class="fa fa-remove"></i></button>
            </div> -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="?hal=pengguna-insert" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-6">
                                    <input type="text" name="nama" id="nama" class="form-control" maxlength="100" required>
                                </div>
                            </div>
                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="username" class="col-sm-2 col-form-label">E-mail</label>
                                <div class="col-sm-6">
                                    <input type="email" name="username" id="username" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" maxlength="100" required>
                                </div>
                            </div>
                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" id="password" class="form-control" maxlength="100" required>
                                </div>
                            </div>
                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-6">
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" maxlength="15" required>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="role" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-6">
                                    <select name="role" id="role" class="form-control" required>
                                        <option value="">Pilih Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="jamaah">Jamaah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" style="display: flex; align-items: center;">
                                <label for="foto_profil" class="col-sm-2 col-form-label">Profil</label>
                                <div class="col-sm-6">
                                    <input type="file" name="foto_profil" id="foto_profil" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <a href="?hal=pengguna" class="btn btn-danger">Batal</a>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.col -->
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label>Multiple</label>
                        <select class="form-control select2" multiple="multiple" data-placeholder="Select a State"
                            style="width: 100%;">
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div> -->
                <!-- /.form-group -->
                <!-- <div class="form-group">
                        <label>Disabled Result</label>
                        <select class="form-control select2" style="width: 100%;">
                            <option selected="selected">Alabama</option>
                            <option>Alaska</option>
                            <option disabled="disabled">California (disabled)</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                        </select>
                    </div> -->
                <!-- /.form-group -->
                <!-- </div> -->
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- <div class="box-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
        </div> -->
    </div>
</section>
<!-- /.box -->
<!-- /.box -->