<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?= base_url('assets/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font- weight-light">PT.Saba Indomedika</span>
  </a>

  <?php 
  $peminjaman_barang = $this->db->query("SELECT count('a.id_peminjaman_inv') as total_pinjam FROM inventaris_dipinjam as a where a.ket = 'pengajuan'")->row();
  ?>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url('assets/') ?>/img/<?= $user->image ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $user->nama ?></a>
      </div>
    </div>

    <!-- SidebarSearch Form -->


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>

            <p>
              Dashboard
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>
        <?php $menu1 = ['cabang', 'departemen', 'barang','vendor','level_karyawan'] ?>
        <?php if($this->session->userdata('id_role') == '1'): ?>
          <li class="nav-item  <?= (in_array($this->uri->segment(1), $menu1)) ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), $menu1)) ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-laptop-house"></i>
            <p>
              Data Master
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('cabang') ?>" class="nav-link <?= ($this->uri->segment(1) == 'cabang') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Cabang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('departemen') ?>" class="nav-link <?= ($this->uri->segment(1) == 'departemen') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Departemen</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('level_karyawan') ?>" class="nav-link <?= ($this->uri->segment(1) == 'level_karyawan') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Level Karyawan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('barang') ?>" class="nav-link <?= ($this->uri->segment(1) == 'barang') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('vendor') ?>" class="nav-link <?= ($this->uri->segment(1) == 'vendor') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Vendor</p>
              </a>
            </li>
          </ul>
        </li>
        <?php else: ?>
        <?php endif ?>

       
        <?php $menu2 = ['inventaris_pinjam','perbaikan_barang','karyawan','Pemusnahan_barang','opname','stok_masuk'] ?>
        <?php if($this->session->userdata('id_role') == '1'): ?>
          <li class="nav-item <?= (in_array($this->uri->segment(1), $menu2)) ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), $menu2)) ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Data Kegitan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('karyawan') ?>" class="nav-link <?= ($this->uri->segment(1) == 'karyawan') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Karyawan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('inventaris_pinjam') ?>" class="nav-link <?= ($this->uri->segment(1) == 'inventaris_pinjam') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Peminjaman barang</p>
                <?php if($peminjaman_barang->total_pinjam == 0): ?>
                <?php else: ?>
                    <span class="badge badge-danger  right"><?= $peminjaman_barang->total_pinjam ?></span>
                <?php endif ?>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('perbaikan_barang') ?>" class="nav-link <?= ($this->uri->segment(1) == 'perbaikan_barang') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Perbaikan barang</p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="<?= base_url('Pemusnahan_barang') ?>" class="nav-link <?= ($this->uri->segment(1) == 'Pemusnahan_barang') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Pemusnahan barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('opname') ?>" class="nav-link <?= ($this->uri->segment(1) == 'opname') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Opname barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('stok_masuk') ?>" class="nav-link <?= ($this->uri->segment(1) == 'stok_masuk') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Stok Masuk</p>
              </a>
            </li>
          </ul>
        </li>
        <?php else: ?>
          <li class="nav-item <?= (in_array($this->uri->segment(1), $menu2)) ? 'menu-open' : ''; ?>">
          <a href="#" class="nav-link <?= (in_array($this->uri->segment(1), $menu2)) ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Data Kegitan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('inventaris_pinjam') ?>" class="nav-link <?= ($this->uri->segment(1) == 'inventaris_pinjam') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Peminjaman barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('perbaikan_barang') ?>" class="nav-link <?= ($this->uri->segment(1) == 'perbaikan_barang') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Perbaikan barang</p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="<?= base_url('Pemusnahan_barang') ?>" class="nav-link <?= ($this->uri->segment(1) == 'Pemusnahan_barang') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Pemusnahan barang</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="<?= base_url('opname') ?>" class="nav-link <?= ($this->uri->segment(1) == 'opname') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Opname barang</p>
              </a>
            </li> -->
          </ul>
        </li>
        <?php endif ?>
       
        <li class="nav-item tmenu-open">
          <a href="#" class="nav-link tactive">
            <i class="nav-icon fas fa-print"></i>
            <p>
              Laporan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link tactive">
                <i class="far fa-circle nav-icon"></i>
                <p>Karyawan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Peminjaman Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Perbaikan Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pemusnahan Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link tactive">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengembalian barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Perbaikan barang selesai</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Stok Opname</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Stok Masuk</p>
              </a>
            </li>
          </ul>
        </li>
        <hr>
        <li class="nav-item">
          <a href="<?= base_url('auth/logout') ?>" class="nav-link ">
            <i class="nav-icon fas fa-sign-out-alt"></i>

            <p>
              Logout
              <!-- <span class="right badge badge-danger">New</span> -->
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>