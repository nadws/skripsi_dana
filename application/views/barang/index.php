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
                              <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambah_data">Tambah Karyawan</button>
                          </div>
                          <div class="card-body">
                              <table id="example2" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Barang</th>
                                          <th>Harga</th>
                                          <th>Stok</th>
                                          <th>Foto</th>
                                          <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($barang as $no => $c) : ?>
                                          <tr>
                                              <td><?= $no + 1 ?></td>
                                              <td><?= $c->nm_barang ?></td>
                                              <td>Rp. <?= number_format($c->harga, 0) ?></td>
                                              <td><?= $c->stok ?></td>
                                              <td align="center">
                                                  <a target="_blank" href="<?= base_url("assets/barang/$c->image") ?>"><img src="<?= base_url("assets/barang/$c->image") ?>" alt="" width="100px"></a>
                                              </td>
                                              <td>
                                                  <a href="#" data-toggle="modal" data-target="#edit_data<?= $c->id_barang ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                  <a href="<?= base_url("karyawan/delete?id_karyawan=$c->id_barang") ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                              </td>
                                          </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>


                  </div>

                  <form action="<?= base_url('barang/add') ?>" method="post" enctype="multipart/form-data">
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
                                              <input type="text" class="form-control" name="nm_barang">
                                          </div>
                                          <div class="col-lg-4">
                                              <label for="">Harga</label>
                                              <input type="text" class="form-control" name="harga">
                                          </div>
                                          <div class="col-lg-4">
                                              <label for="">Stok</label>
                                              <input type="text" class="form-control" name="stok">
                                          </div>
                                          <div class="col-lg-4 mt-2">
                                              <img id="previewFoto" src="" alt="Preview Foto" style="max-width: 100%; max-height: 200px; display: none;">
                                              <input type="file" class="form-control" name="foto" id="inputFoto">
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
  <script>
      // Mengambil elemen input file dan elemen img untuk preview
      const inputFoto = document.getElementById('inputFoto');
      const previewFoto = document.getElementById('previewFoto');

      // Event listener untuk saat gambar dipilih
      inputFoto.addEventListener('change', function() {
          // Cek apakah ada file yang dipilih
          if (this.files && this.files[0]) {
              const reader = new FileReader();

              // Event listener untuk saat gambar selesai di-load
              reader.addEventListener('load', function(e) {
                  // Mengganti atribut src dari elemen img dengan data URL gambar yang sudah di-load
                  previewFoto.src = e.target.result;
                  previewFoto.style.display = 'block'; // Menampilkan gambar
              });

              // Membaca data gambar sebagai URL data (data URL)
              reader.readAsDataURL(this.files[0]);
          }
      });
  </script>