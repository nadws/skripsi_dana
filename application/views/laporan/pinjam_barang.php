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
                              
                                    <a href="<?= $status == 'dipinjam' ? base_url('laporan/print_peminjaman_barang') : base_url('laporan/print_pengembalian_barang') ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-print"></i> Print</a>   
                          </div>
                          <div class="card-body">
                              <table id="example2" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Barang</th>
                                          <th>Qty</th>
                                          <th>Tgl Pinjam</th>
                                          <th>Peminjam</th>
                                          <th>Tgl Kembali</th>
                                          <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php foreach ($inventaris as $no => $c) : ?>
                                      <tr>
                                          <td><?= $no + 1 ?></td>
                                          <td><?= $c->nm_barang ?></td>
                                          <td><?= $c->qty ?></td>
                                          <td><?= date('d-m-Y',strtotime($c->tgl_pinjam))  ?></td>
                                          <td><?= $c->nm_karyawan ?></td>
                                          <td><?= $c->tgl_kembali == '0000-00-00' ? '-' : date('d-m-Y',strtotime($c->tgl_kembali)) ?></td>
                                          <td><span class="badge <?= $c->status_pinjam == 'dipinjam' ? 'badge-danger' : 'badge-success' ?> "><?= $c->status_pinjam ?></span></td>
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
  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <script>
      $(document).ready(function() {
        $(document).on('click', '.kembali', function() {
            id_inventaris = $(this).attr('id_inventaris');
            qty = $(this).attr('qty');
            kode_barang = $(this).attr('kode_barang');
            
            $('.id_inventaris').val(id_inventaris);
            $('.qty').val(qty);
            $('.kode_barang').val(kode_barang);
            $("#kembalikan").modal('show');

        });
        $(document).on('click', '.setuju', function() {
            id_inventaris = $(this).attr('id_inventaris');
            qty = $(this).attr('qty');
            kode_barang = $(this).attr('kode_barang');
            
            $('.id_inventaris').val(id_inventaris);
            $('.qty').val(qty);
            $('.kode_barang').val(kode_barang);
            $("#setujui").modal('show');

        });
      });
  </script>
