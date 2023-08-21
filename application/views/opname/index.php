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
                              <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambah_data">Tambah Opname</button>
                          </div>
                          <div class="card-body">
                              <table id="example2" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Tanggal</th>
                                          <th>Nota Opname</th>
                                          <th>Admin</th>
                                          <th>Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($opname as $no => $c) : ?>
                                          <tr>
                                              <td><?= $no + 1 ?></td>
                                              <td><?= date('d-m-Y',strtotime($c->tgl))  ?></td>
                                              <td><?= $c->no_nota_opname ?></td>
                                              <td><?= $c->admin ?></td>
                                              <td><a href="<?= base_url("Opname/detail?no_nota=$c->no_nota_opname") ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a></td>
                                          </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>


                  </div>

                  <form action="<?= base_url('opname/add') ?>" method="get" >
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
                                          <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Barang</th>
                                                    <th>Barang</th>
                                                    <th class="text-right">Stok</th>
                                                    <th>Check</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($barang as $no => $b): ?>
                                                <tr>
                                                    <td><?= $no+1 ?></td>
                                                    <td><?= $b->kode ?></td>
                                                    <td><?= $b->nm_barang ?></td>
                                                    <td align="right"><?= $b->masuk - $b->keluar ?></td>
                                                    <td align="center"><input type="checkbox" name="kode[]" value="<?= $b->kode ?>" id=""></td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                          </table>


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