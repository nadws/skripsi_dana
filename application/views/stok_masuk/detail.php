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
                    <form action="<?= base_url("Opname/save") ?>" method="post">
                      <div class="card">
                          <div class="card-header">
                              <h6 class="float-left"><?= $title ?></h6> <br> <br>
                              <h6>Nota : <?=$nota ?></h6>
                          </div>
                            <div class="card-body">
                              <table  class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Kode Barang</th>
                                          <th>Nama Barang</th>
                                          <th >Qty Program</th>
                                          <th >Qty Masuk</th>
                                          <th >Stok Program</th>
                                          <th>Admin</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach($opname as $no => $k): ?>
                                        <tr>
                                            <td><?= $no+1?></td>
                                            <td><?= $k->kode ?></td>
                                            <td><?= $k->nm_barang ?></td>
                                            <td><?= $k->qty_sebelum ?></td>
                                            <td><?= $k->qty ?></td>
                                            <td><?= $k->qty_sebelum + $k->qty ?></td>
                                            <td><?= $k->admin ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                     
                                  </tbody>
                              </table>
                          </div>
                          <div class="card-footer">
                            <a href="<?= base_url('stok_masuk') ?>" class="btn btn-secondary">Kembali</a>
                          </div>
                      </div>
                      </form>


                  </div>

                  
                  

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