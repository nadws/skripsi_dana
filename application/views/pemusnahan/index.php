  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0"><?= $title ?></h1>
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
                              <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                  data-target="#tambah_data">Tambah Pemusnahan</button>
                          </div>
                          <div class="card-body">
                              <table id="example2" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Barang</th>
                                          <th>Qty</th>
                                          <th>Tgl Pemusnahan</th>
                                          <th>Alasan</th>
                                          <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($inventaris as $no => $c) : ?>
                                      <tr>
                                          <td><?= $no + 1 ?></td>
                                          <td><?= $c->nm_barang ?></td>
                                          <td><?= $c->qty ?></td>
                                          <td><?= date('d-m-Y',strtotime($c->tgl_pemusnahan))  ?></td>
                                          <td><?= $c->ket ?></td>
                                          <td>
                                          <a href="#" data-toggle="modal"
                                                  data-target="#edit_data<?= $c->id_pemusnahan_barang ?>"
                                                  class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                              <a href="<?= base_url("karyawan/delete?id_karyawan=$c->id_pemusnahan_barang")
                                                  ?>"
                                                  class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a> 
                                          </td>
                                      </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>


                  </div>

                  <form action="<?= base_url('pemusnahan_barang/add') ?>" method="post" >
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
                                          <div class="col-lg-4">
                                              <label for="">Nama barang</label>
                                              <select name="id_barang" class="form-control" id="">
                                                  <option value="">-Pilih Barang-</option>
                                                <?php foreach($barang as $b): ?>
                                                    <option value="<?= $b->id_barang ?>"><?= $b->nm_barang ?></option>
                                                    <?php endforeach ?>
                                              </select>
                                          </div>
                                          <div class="col-lg-2">
                                              <label for="">Qty</label>
                                              <input type="text" class="form-control" name="qty">
                                          </div>
                                          <div class="col-lg-3">
                                              <label for="">Tanggal Pemusnahan</label>
                                              <input type="date" class="form-control" name="tgl_pemusnahan">
                                          </div>
                                          <div class="col-lg-3">
                                              <label for="">Alasan dimusnahkan</label>
                                              <input type="text" class="form-control" name="ket">
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
                  <form action="<?= base_url('Perbaikan_barang/selesai') ?>" method="post" >
                      <div class="modal fade" id="selesai">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Pengembalian Barang</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>

                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            Apakah perbaikan barang sudah selesai ?
                                        </div>
                                    </div>
                                    <input type="hidden" class="id_perbaikan_barang" name="id_perbaikan_barang">
                                     
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                      <button type="submit" class="btn btn-primary">Selesai</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
                  <!-- <?php foreach ($departemen as $no => $d) : ?>
          <form action="<?= base_url('departemen/edit') ?>" method="post">
            <div class="modal fade" id="edit_data<?= $c->id_departemen ?>">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                    <div class="col-lg-6">
                          <label for="">Nama Departemen</label>
                          <input type="text" class="form-control" name="nama_departemen" value="<?= $d->nama_departemen ?>">
                        </div>
                        <div class="col-lg-6">
                          <label for="">Lokasi</label>
                          <input type="text" class="form-control" name="alamat" value="<?= $d->lokasi ?>">
                          <input type="hidden" class="form-control" name="id_departemen" value="<?= $d->id_departemen ?>">
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
          <?php endforeach ?> -->

                  <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <script>
      $(document).ready(function() {
        $(document).on('click', '.selesai', function() {
            id_perbaikan_barang = $(this).attr('id_perbaikan_barang');
            
            $('.id_perbaikan_barang').val(id_perbaikan_barang);
            $("#selesai").modal('show');

        });
      });
  </script>
