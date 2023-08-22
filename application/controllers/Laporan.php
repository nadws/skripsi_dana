<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function karyawan()
    {
        $data = [
            'title' => 'Laporan Data Karyawan',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'karyawan' => $this->db->query("SELECT * FROM karyawan as a
            left join departemen as b on b.id_departemen = a.id_departemen
            left join level_karyawan as c on c.id_level_karyawan = a.id_level_karyawan
            ORDER BY a.id_karyawan DESC")->result(),
        ];

        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('laporan/karyawan', $data);
        $this->load->view('template/footer', $data);
    }
    public function karyawan_print()
    {
        $data = [
            'title' => 'Laporan Data Karyawan',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'karyawan' => $this->db->query("SELECT * FROM karyawan as a
            left join departemen as b on b.id_departemen = a.id_departemen
            left join level_karyawan as c on c.id_level_karyawan = a.id_level_karyawan
            ORDER BY a.id_karyawan DESC")->result(),
        ];
        $this->load->view('laporan/print_karyawan', $data);
    }

    public function peminjaman_barang()
    {
        $data = [
            'title'=> 'Laporan Data Peminjaman Inventaris',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM inventaris_dipinjam as a
            left join barang as b on b.kode = a.kode_barang
            left join karyawan as c on c.nik = a.nik
            where a.status_pinjam = 'dipinjam'
            ORDER BY a.id_peminjaman_inv DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
            'karyawan' => $this->db->get('karyawan')->result(),
            'status' => 'pinjam'
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('laporan/pinjam_barang',$data);
        $this->load->view('template/footer',$data);
    }
    public function print_peminjaman_barang()
    {
        $data = [
            'title'=> 'Laporan Data Peminjaman Inventaris',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM inventaris_dipinjam as a
            left join barang as b on b.kode = a.kode_barang
            left join karyawan as c on c.nik = a.nik
            where a.status_pinjam = 'dipinjam'
            ORDER BY a.id_peminjaman_inv DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
            'karyawan' => $this->db->get('karyawan')->result(),
            
        ];

        
        $this->load->view('laporan/print_pinjam_barang',$data);
       
    }
    public function pengembalian_barang()
    {
        $data = [
            'title'=> 'Laporan Data Pengembalian Inventaris',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM inventaris_dipinjam as a
            left join barang as b on b.kode = a.kode_barang
            left join karyawan as c on c.nik = a.nik
            where a.status_pinjam = 'kembali'
            ORDER BY a.id_peminjaman_inv DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
            'karyawan' => $this->db->get('karyawan')->result(),
            'status' => 'kembali'
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('laporan/pinjam_barang',$data);
        $this->load->view('template/footer',$data);
    }
    public function print_pengembalian_barang()
    {
        $data = [
            'title'=> 'Laporan Data Pengembalian Inventaris',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM inventaris_dipinjam as a
            left join barang as b on b.kode = a.kode_barang
            left join karyawan as c on c.nik = a.nik
            where a.status_pinjam = 'kembali'
            ORDER BY a.id_peminjaman_inv DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
            'karyawan' => $this->db->get('karyawan')->result()
        ];

        
        $this->load->view('laporan/print_pinjam_barang',$data);
       
    }

    public function perbaikan_barang(Type $var = null)
    {
        $data = [
            'title'=> 'Laporan Data Perbaikan Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM perbaikan_barang as a
            left join barang as b on b.kode = a.kode_barang
            where a.status = 'belum selesai'
            ORDER BY a.id_perbaikan_barang DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
            'kode'=>'belum'
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('laporan/perbaikan',$data);
        $this->load->view('template/footer',$data);
    }
    public function print_perbaikan(Type $var = null)
    {
        $data = [
            'title'=> 'Laporan Data Perbaikan Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM perbaikan_barang as a
            left join barang as b on b.kode = a.kode_barang
            where a.status = 'belum selesai'
            ORDER BY a.id_perbaikan_barang DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
        ];

        $this->load->view('laporan/print_perbaikan',$data);
    }
    public function perbaikan_barang_selesai(Type $var = null)
    {
        $data = [
            'title'=> 'Laporan Data Perbaikan Barang Selesai',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM perbaikan_barang as a
            left join barang as b on b.kode = a.kode_barang
            where a.status = 'selesai'
            ORDER BY a.id_perbaikan_barang DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
            'kode'=>'selesai'
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('laporan/perbaikan',$data);
        $this->load->view('template/footer',$data);
    }
    public function print_perbaikan_barang_selesai(Type $var = null)
    {
        $data = [
            'title'=> 'Laporan Data Perbaikan Barang Selesai',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM perbaikan_barang as a
            left join barang as b on b.kode = a.kode_barang
            where a.status = 'selesai'
            ORDER BY a.id_perbaikan_barang DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
        ];

        $this->load->view('laporan/print_perbaikan',$data);
    }

    public function pemusnahan_barang(Type $var = null)
    {
        $data = [
            'title'=> 'Laporan Data Pemusnahan Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM pemusnahan_barang as a
            left join barang as b on b.kode = a.kode_barang
            ORDER BY a.id_pemusnahan_barang DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('laporan/pemusnahan',$data);
        $this->load->view('template/footer',$data);
    }
    public function print_pemusnahan_barang(Type $var = null)
    {
        $data = [
            'title'=> 'Laporan Data Pemusnahan Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM pemusnahan_barang as a
            left join barang as b on b.kode = a.kode_barang
            ORDER BY a.id_pemusnahan_barang DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
        ];

        $this->load->view('laporan/print_pemusnahan',$data);
    }
}
