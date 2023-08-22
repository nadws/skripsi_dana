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
                              <a href="<?= base_url('Laporan/karyawan_print') ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-print"></i> Print</a>
                          </div>
                          <div class="card-body">
                              <table id="example2" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>NIK</th>
                                          <th>Nama</th>
                                          <th>Posisi</th>
                                          <th>Tanggal lahir</th>
                                          <th>Jenis Kelamin</th>
                                          <th>Lama Bekerja</th>
                                          <th>Departemen</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($karyawan as $no => $c) : ?>
                                          <tr>
                                              <td><?= $no + 1 ?></td>
                                              <td><?= $c->nik ?></td>
                                              <td><?= $c->nm_karyawan ?></td>
                                              <td><?= $c->nm_level ?></td>
                                              <td><?= date('d-m-Y', strtotime($c->tgl_lahir))  ?></td>
                                              <td><?= $c->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                              <td>
                                                  <?php $lahir    = new DateTime($c->tgl_bergabung);
                                                    $today        = new DateTime();
                                                    $umur = $today->diff($lahir);
                                                    echo $umur->y;
                                                    echo " Tahun ";
                                                    ?>
                                              </td>
                                              <td><?= $c->nama_departemen ?></td>
                                          </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>


                  </div>



                  <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->