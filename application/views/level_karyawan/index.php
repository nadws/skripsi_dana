  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="float-left"><?= $title ?></h6>
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambah_data">Tambah Level Karyawan</button>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Level Karyawan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($level_karywan as $no => $c): ?>
                            <tr>
                                <td><?= $no+1 ?></td>
                                <td><?= $c->nm_level ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit_data<?= $c->id_level_karyawan ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url("level_karyawan/delete?id_level_karyawan=$c->id_level_karyawan") ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
          </div>

          <form action="<?= base_url('level_karyawan/add') ?>" method="post">
            <div class="modal fade" id="tambah_data">
              <div class="modal-dialog ">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Tambah <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                          <label for="">Level Karyawan</label>
                          <input type="text" class="form-control" name="nm_level" >
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
              </div>
            </div>
          </form>
          <?php foreach($level_karywan as $c): ?>
          <form action="<?= base_url('level_karyawan/edit') ?>" method="post">
            <div class="modal fade" id="edit_data<?=$c->id_level_karyawan ?>">
              <div class="modal-dialog ">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Tambah <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                          <label for="">Level Karyawan</label>
                          <input type="text" class="form-control" name="nm_level" value="<?= $c->nm_level ?>">
                          <input type="hidden" class="form-control" name="id_level_karyawan" value="<?= $c->id_level_karyawan ?>">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
              </div>
            </div>
          </form>
          <?php endforeach ?>
          
          
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
