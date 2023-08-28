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
                              
                              <?php if($user->id_role == 2): ?>
                                <?php else: ?>
                              <button class="btn btn-primary btn-sm float-right tambah" data-toggle="modal"
                                  data-target="#tambah_data">Tambah Perbaikan</button>
                                  <a href="<?= base_url('perbaikan_barang/formulir') ?>" target="_blank" class="btn btn-primary btn-sm float-right mr-2"><i class="fas fa-print"></i> Formulir</a>
                                <?php endif ?>
                          </div>
                          <div class="card-body">
                              <table id="example2" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Barang</th>
                                          <th>Qty</th>
                                          <th>Vendor</th>
                                          <th>Tgl Perbaikan</th>
                                          <th>Keterangan</th>
                                          <th>Tgl Selesai</th>
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
                                          <td><?= $c->nm_vendor ?></td>
                                          <td><?= date('d-m-Y',strtotime($c->tgl_perbaikan))  ?></td>
                                          <td><?= $c->ket ?></td>
                                          <td><?= $c->tgl_selesai == '0000-00-00' || $c->tgl_selesai == '0' ? '-' : date('d-m-Y',strtotime($c->tgl_selesai)) ?></td>
                                          <td><span class="badge <?= $c->status == 'pengajuan' ? 'badge-danger' : 'badge-success' ?> "><?= $c->status ?></span></td>
                                          <td>
                                          <?php if($user->id_role == 3): ?>
                                                <?php if($c->status == 'pengajuan'): ?>
                                                    <a href="#" data-toggle="modal"
                                                    data-target="#edit_data<?= $c->id_perbaikan_barang ?>"
                                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                <a href="<?= base_url("karyawan/delete?id_karyawan=$c->id_perbaikan_barang")
                                                    ?>"
                                                    class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                    <?php elseif($c->status == 'diperbaiki'): ?>
                                                        <a href="#"  class="btn btn-sm btn-success selesai" id_perbaikan_barang="<?= $c->id_perbaikan_barang ?>">Selesai</a>
                                                        <a href="#"  class="btn btn-sm btn-danger selesai" id_perbaikan_barang="<?= $c->id_perbaikan_barang ?>">Musnahkan</a>
                                                <?php else: ?>
                                                <?php endif ?>
                                            <?php else: ?>
                                                <?php if($c->status == 'pengajuan'): ?>
                                                    <a href="#"  class="btn btn-sm btn-success setuju" kode_barang="<?= $c->kode_barang ?>" qty="<?= $c->qty ?>" id_perbaikan_barang="<?= $c->id_perbaikan_barang ?>">Cek</a>
                                                <?php else: ?>
                                                            
                                                <?php endif ?>
                                            <?php endif ?>
                                              
                                              
                                              
                                          </td>
                                      </tr>
                                      <?php endforeach ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>


                  </div>

                  <form action="<?= base_url('perbaikan_barang/add') ?>" method="post" enctype="multipart/form-data">
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
                                            <label for="">Barang Dari</label>
                                            <select name="dari" id="" class="form-control barang_dari">
                                                <option value="">Pilih</option>
                                                <option value="1">Pusat</option>
                                                <option value="2">Cabang</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-8">

                                        </div>
                                          <div class="col-lg-4 hilang pusat">
                                              <label for="">Nama barang</label>
                                              <select name="kode_barang" class="form-control hilang_disable input_pusat" id="">
                                                  <option value="">-Pilih Barang-</option>
                                                <?php foreach($barang as $b): ?>
                                                    <option value="<?= $b->kode ?>">(<?= $b->kode ?>)<?= $b->nm_barang ?></option>
                                                    <?php endforeach ?>
                                              </select>
                                          </div>
                                          <div class="col-lg-4 hilang pusat">
                                              <label for="">Vendor</label>
                                              <select name="id_vendor" class="form-control hilang_disable input_pusat" id="">
                                                  <option value="">-Pilih Vendor-</option>
                                                <?php foreach($vendor as $b): ?>
                                                    <option value="<?= $b->id_vendor ?>"><?= $b->nm_vendor ?></option>
                                                    <?php endforeach ?>
                                              </select>
                                          </div>
                                          <div class="col-lg-2 hilang pusat">
                                              <label for="">Qty</label>
                                              <input type="text" class="form-control hilang_disable input_pusat" name="qty">
                                          </div>
                                          <div class="col-lg-3 hilang pusat">
                                              <label for="">Tanggal Perbaikan</label>
                                              <input type="date" class="form-control hilang_disable input_pusat" name="tgl_perbaikan">
                                          </div>
                                          <div class="col-lg-3 hilang pusat">
                                              <label for="">Keterangan</label>
                                              <input type="text" class="form-control hilang_disable input_pusat" name="ket">
                                          </div>
                                          <div class="col-lg-3 hilang pusat">
                                              <label for="">Lampiran</label>
                                              <input type="file" class="form-control hilang_disable input_pusat" name="foto">
                                          </div>
                                          <!-- batasnya -->
                                          <div class="col-lg-4 hilang cabang">
                                              <label for="">Nama barang</label>
                                              <select name="id_cabang" class="form-control pilih_cabang hilang_disable input_cabang" id="">
                                                  <option value="">-Pilih Barang-</option>
                                                <?php foreach($cabang as $b): ?>
                                                    <option value="<?= $b->id_cabang ?>"><?= $b->nama ?></option>
                                                    <?php endforeach ?>
                                              </select>
                                          </div>
                                          <div class="col-lg-4 hilang cabang">
                                              <label for="">Nama barang</label>
                                              <select name="kode_barang" class="form-control get_barang hilang_disable input_cabang" id="">
                                                 
                                              </select>
                                          </div>
                                          <div class="col-lg-4 hilang cabang">
                                              <label for="">Vendor</label>
                                              <select name="id_vendor" class="form-control hilang_disable input_cabang" id="">
                                                  <option value="">-Pilih Vendor-</option>
                                                <?php foreach($vendor as $b): ?>
                                                    <option value="<?= $b->id_vendor ?>"><?= $b->nm_vendor ?></option>
                                                    <?php endforeach ?>
                                              </select>
                                          </div>
                                          <div class="col-lg-2 hilang cabang">
                                              <label for="">Qty</label>
                                              <input type="text" class="form-control hilang_disable input_cabang" name="qty">
                                          </div>
                                          <div class="col-lg-3 hilang cabang">
                                              <label for="">Tanggal Perbaikan</label>
                                              <input type="date" class="form-control hilang_disable input_cabang" name="tgl_perbaikan">
                                          </div>
                                          <div class="col-lg-3 hilang cabang">
                                              <label for="">Keterangan</label>
                                              <input type="text" class="form-control hilang_disable input_cabang" name="ket">
                                          </div>
                                          <div class="col-lg-3 hilang cabang">
                                              <label for="">Lampiran</label>
                                              <input type="file" class="form-control hilang_disable input_cabang" name="foto">
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
                  <form action="<?= base_url('perbaikan_barang/setujui') ?>" method="post" >
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
        $(document).on('click', '.selesai', function() {
            id_perbaikan_barang = $(this).attr('id_perbaikan_barang');
            
            $('.id_perbaikan_barang').val(id_perbaikan_barang);
            $("#selesai").modal('show');

        });

        
        

        $(document).on('click', '.tambah', function() {
            $('.hilang').hide();
            $('.hilang_disable').prop('disabled', true);
            

        });
        $(document).on('change', '.barang_dari', function() {
           var  id_barang_dari = $(this).val();
            
          if (id_barang_dari == '1') {
            $('.pusat').show();
            $('.cabang').hide();
            $('.input_pusat').prop('disabled', false);
            $('.input_cabang').prop('disabled', true);
          } else {
             $('.cabang').show();
             $('.pusat').hide();
             $('.input_pusat').prop('disabled', true);
             $('.input_cabang').prop('disabled', false);
          }

        });
        $(document).on('change', '.pilih_cabang', function() {
           var  id_cabang = $(this).val();
            
         $.ajax({
            type: "get",
            url: "<?= base_url('perbaikan_barang/get_barang?id_cabang=') ?>" + id_cabang,
            success: function (data) {
                $('.get_barang').html(data);
                
            }
         });

        });

        $(document).on('click', '.setuju', function() {
            id_perbaikan_barang = $(this).attr('id_perbaikan_barang');
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
