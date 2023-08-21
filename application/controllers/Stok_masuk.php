<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_masuk extends CI_Controller
{

    public function index()
    {
        $kode =  $this->db->query("SELECT max(a.urutan) as urutan_kode FROM barang as a")->row();
        if (empty($kode->urutan_kode)) {
           $kode_barang = '1001';
        } else {
            $kode_barang = $kode->urutan_kode + 1;
        }
        
        $data = [
            'title' => 'Stok Masuk Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'stok_masuk' => $this->db->query("SELECT a.no_nota_masuk, a.tgl, a.admin
             FROM stok_masuk as a 
             Group by a.no_nota_masuk")->result(),
            'kode' =>  $kode_barang,
            'barang' => $this->db->query("SELECT a.*, b.masuk, b.keluar FROM barang as a
            left join(
                SELECT b.kode_barang, sum(b.masuk) as masuk , sum(b.keluar) as keluar
                FROM stok as b 
                group by b.kode_barang
            ) as b on b.kode_barang = a.kode
             ORDER BY a.id_barang DESC")->result(),
        ];

        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('stok_masuk/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function add()
    {
        $kode = $this->input->get('kode');

        $urutan = $this->db->query("SELECT max(urutan) as urutan FROM stok_masuk as a ")->row();

        if (empty($urutan->urutan)) {
           $nota = '1001';
        } else {
            $nota = $urutan->urutan + 1;
        }
        

        $data = [
            'title' => 'Stok Masuk Barang',
            'kode' => $kode,
            'nota' => $nota,
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
        ];
        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('stok_masuk/add', $data);
        $this->load->view('template/footer', $data);
    }

    public function save()
    {
        $no_nota_masuk = $this->input->post('no_nota_masuk');
        $kode = $this->input->post('kode');
        $qty = $this->input->post('qty');
        $qty_sebelum = $this->input->post('qty_sebelum');



        $urutan = $this->db->query("SELECT max(urutan) as urutan FROM opname as a ")->row();

        if (empty($urutan->urutan)) {
           $nota_urutan = '1001';
        } else {
            $nota_urutan = $urutan->urutan + 1;
        }

        for ($x=0; $x <count($kode) ; $x++) { 
           $data = [
                'no_nota_masuk' => $no_nota_masuk,
                'kode_barang' => $kode[$x],
                'qty' => $qty[$x],
                'qty_sebelum' => $qty_sebelum[$x],
                'tgl' => date('Y-m-d'),
                'urutan' => $nota_urutan,
                'admin' => $this->session->userdata('username'),
           ];
           $this->db->insert('stok_masuk',$data);

           
            $data = [
                'kode_barang' => $kode[$x],
                'masuk' =>  $qty[$x],
                'keluar' => '0',
                'ket' => 'stok_masuk',
                'opname' => 'T'
              ];
              $this->db->insert('stok',$data);
           
        }
        $this->session->set_flashdata('success', 'Berhasil disimpan');
       redirect("stok_masuk/detail?no_nota=$no_nota_masuk");
    }

    public function detail()
    {
        
        $nota = $this->input->get('no_nota');

        $data = [
            'title' => 'Detail Stok Masuk',
            'nota' => $nota,
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'opname' => $this->db->query("SELECT * FROM stok_masuk as a left join barang as b on a.kode_barang =  b.kode where a.no_nota_masuk = '$nota'")->result()

        ];
        
        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('stok_masuk/detail', $data);
        $this->load->view('template/footer', $data);
       
    }

    
}
