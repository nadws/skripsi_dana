  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
            <form action="">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0"><?= $title ?></h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active"><?= $title ?></li>
                      </ol>
                  </div>
                  
                  <div class="col-lg-3">
                    <select name="id_cabang" class="form-control" id="">
                                                    <option value="">-Pilih Cabang-</option>
                                                    <?php foreach($cabang as $c): ?>
                                                        <option value="<?= $c->id_cabang ?>"><?= $c->nama ?></option>
                                                        <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                  </div>
                  <!-- /.col -->
              </div><!-- /.row -->
              </form>
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
                              <h6 class="float-left">Cabang : <?= $nm_cabang ?></h6>
                                <?php if($user->id_role == 2): ?>
                                <?php else: ?>
                                    
                                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#tambah_data">Tambah Peminjaman</button>
                                    <a href="<?= base_url('inventaris_pinjam/formulir') ?>" target="_blank" class="btn btn-primary btn-sm float-right mr-2"><i class="fas fa-print"></i> Formulir</a>
                                <?php endif ?>
                              
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
                                          <th>Cabang</th>
                                          <th>Status</th>
                                          <th>Aksi</th>
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

                                          <td><?= $c->nama ?></td>
                                         
                                          <td><span class="badge <?= $c->ket == 'pengajuan' ? 'badge-danger' : ($c->ket == 'setuju' ? 'badge-success' : 'badge-warning' )  ?> "><?= $c->ket ?></span></td>
                                          <td>
                                            <?php if($c->status_pinjam == 'dipinjam'): ?>
                                                <?php if($user->id_role == 2): ?>
                                                    <?php if($c->ket == 'setuju' || $c->ket == 'tidak_setuju'): ?>
                                                    <?php else: ?>
                                                            <a href="#"  class="btn btn-sm btn-success setuju" kode_barang="<?= $c->kode_barang ?>" qty="<?= $c->qty ?>" id_inventaris="<?= $c->id_peminjaman_inv ?>">Cek</a>
                                                    <?php endif ?>
                                            <?php else: ?>
                                                <?php if($c->ket == 'tidak_setuju'): ?>
                                                    <span class="badge badge-danger">Gagal</span>
                                                    <?php else: ?>
                                                        
                                                        <a href="#"  class="btn btn-sm btn-success kembali" <?= $c->ket == 'pengajuan' ? 'hidden' : '' ?> kode_barang="<?= $c->kode_barang ?>" qty="<?= $c->qty ?>" id_inventaris="<?= $c->id_peminjaman_inv ?>">Mengembalikan</a>

                                                    <?php if($c->ket == 'setuju'): ?>
                                                    <?php else: ?>
                                                        <a href="#" data-toggle="modal"
                                                    data-target="#edit_data<?= $c->id_peminjaman_inv ?>"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    <a href="<?= base_url("karyawan/delete?id_karyawan=$c->id_peminjaman_inv")?>"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    <?php endif ?>
                                                        
                                                    <?php endif ?>
                                                    
                                                    
                                                <?php endif ?>
                                                
                                                <?php else: ?>
                                            <?php endif ?>
                                              
                                              
                                              
                                          </td>
                                      </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>


                  </div>

                  <form action="<?= base_url('inventaris_pinjam/add') ?>" method="post"  enctype="multipart/form-data">
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
                                              <select name="kode_barang" class="form-control" id="">
                                                  <option value="">-Pilih Barang-</option>
                                                <?php foreach($barang as $b): ?>
                                                    <option value="<?= $b->kode ?>">(<?= $b->kode ?>)<?= $b->nm_barang ?></option>
                                                    <?php endforeach ?>
                                              </select>
                                          </div>
                                          <div class="col-lg-2">
                                              <label for="">Qty</label>
                                              <input type="text" class="form-control" name="qty">
                                          </div>
                                          <div class="col-lg-3">
                                              <label for="">Peminjam</label>
                                              <select name="nik" class="form-control" id="">
                                                  <option value="">-Pilih Peminjam-</option>
                                                <?php foreach($karyawan as $k): ?>
                                                    <option value="<?= $k->nik ?>"><?= $k->nm_karyawan ?></option>
                                                    <?php endforeach ?>
                                              </select>
                                          </div>
                                          <div class="col-lg-3">
                                              <label for="">Cabang</label>
                                              <select name="id_cabang" class="form-control" id="">
                                                  <option value="">-Pilih Cabang-</option>
                                                <?php foreach($cabang as $c): ?>
                                                    <option value="<?= $c->id_cabang ?>"><?= $c->nama ?></option>
                                                    <?php endforeach ?>
                                              </select>
                                          </div>
                                          <div class="col-lg-3">
                                              <label for="">Tanggal Pinjam</label>
                                              <input type="date" class="form-control" name="tgl_pinjam">
                                          </div>
                                          <div class="col-lg-3">
                                              <label for="">Sampai Dengan</label>
                                              <input type="date" class="form-control" name="tgl_kembali">
                                          </div>
                                          <div class="col-lg-3">
                                              <label for="">Lampiran</label>
                                              <input type="file" class="form-control" name="foto">
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
                  <form action="<?= base_url('inventaris_pinjam/kembalikan') ?>" method="post" >
                      <div class="modal fade" id="kembalikan">
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
                                            Apakah barang yang dikembalikan sudah sesuai ?
                                        </div>
                                    </div>
                                    <input type="hidden" class="id_inventaris" name="id_peminjaman_inv">
                                    <input type="hidden" class="qty" name="qty">
                                    <input type="hidden" class="kode_barang" name="kode_barang">
                                     
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                      <button type="submit" class="btn btn-primary">Sesuai</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
                  <form action="<?= base_url('inventaris_pinjam/setujui') ?>" method="post" >
                      <div class="modal fade" id="setujui">
                          <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="modal-title">Peminjaman Barang</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>

                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            Baca lampiran sebelum menyetujui peminjaman barang !
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="lampiran"></div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="id_inventaris" name="id_peminjaman_inv">
                                    <input type="hidden" class="qty" name="qty">
                                    <input type="hidden" class="kode_barang" name="kode_barang">
                                    
                                     
                                  </div>
                                  <div class="modal-footer ">
                                      <!-- <button type="button" class="btn btn-default float-left" data-dismiss="modal">Close</button> -->
                                      <button type="submit" class="btn btn-primary float-right" name="setuju" value="setuju">Setuju</button>
                                      <button type="submit" class="btn btn-danger float-right" name="setuju" value="tidak">Tidak Setuju</button>
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

            $.ajax({
                type: "get",
                url: "<?= base_url('inventaris_pinjam/get_setuju?id_inventaris=') ?>" + id_inventaris,
                success: function (data) {
                    $('#lampiran').html(data);
                }
            });
            
            $('.id_inventaris').val(id_inventaris);
            $('.qty').val(qty);
            $('.kode_barang').val(kode_barang);
            $("#setujui").modal('show');

        });
      });
  </script>
