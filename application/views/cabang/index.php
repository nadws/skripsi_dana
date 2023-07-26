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
              <li class="breadcrumb-item active">Starter Page</li>
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
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambah_data">Tambah Cabang</button>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telepon/Hp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cabang as $no => $c): ?>
                            <tr>
                                <td><?= $no+1 ?></td>
                                <td><?= $c->kode ?></td>
                                <td><?= $c->nama ?></td>
                                <td><?= $c->alamat ?></td>
                                <td><?= $c->no_hp ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#edit_data<?= $c->id_cabang ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url("cabang/delete?id_cabang=$c->id_cabang") ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
          </div>

          <form action="<?= base_url('cabang/add_cabang') ?>" method="post">
            <div class="modal fade" id="tambah_data">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Tambah <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                          <label for="">Kode</label>
                          <input type="text" class="form-control" name="kode">
                        </div>
                        <div class="col-lg-3">
                          <label for="">Nama Cabang</label>
                          <input type="text" class="form-control" name="nm_cabang" >
                        </div>
                        <div class="col-lg-3">
                          <label for="">Alamat</label>
                          <input type="text" class="form-control" name="alamat">
                        </div>
                        <div class="col-lg-3">
                          <label for="">No Telpon</label>
                          <input type="text" class="form-control" name="no_telpon">
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
          <?php foreach($cabang as $no => $c): ?>
          <form action="<?= base_url('cabang/edit_cabang') ?>" method="post">
            <div class="modal fade" id="edit_data<?= $c->id_cabang ?>">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Tambah <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                          <label for="">Kode</label>
                          <input type="hidden" class="form-control" name="id_cabang" value="<?= $c->id_cabang ?>">
                          <input type="text" class="form-control" name="kode" value="<?= $c->kode ?>">
                        </div>
                        <div class="col-lg-3">
                          <label for="">Nama Cabang</label>
                          <input type="text" class="form-control" name="nm_cabang"value="<?= $c->nama ?>" >
                        </div>
                        <div class="col-lg-3">
                          <label for="">Alamat</label>
                          <input type="text" class="form-control" name="alamat" value="<?= $c->alamat ?>">
                        </div>
                        <div class="col-lg-3">
                          <label for="">No Telpon</label>
                          <input type="text" class="form-control" name="no_telpon" value="<?= $c->no_hp ?>">
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

  
