<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Opname extends CI_Controller
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
            'title' => 'Opname Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'opname' => $this->db->query("SELECT a.no_nota_opname, a.tgl, a.admin
             FROM opname as a 
             Group by a.no_nota_opname")->result(),
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
        $this->load->view('opname/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function add()
    {
        $kode = $this->input->get('kode');

        $urutan = $this->db->query("SELECT max(urutan) as urutan FROM opname as a ")->row();

        if (empty($urutan->urutan)) {
           $nota = '1001';
        } else {
            $nota = $urutan->urutan + 1;
        }
        

        $data = [
            'title' => 'Opname Barang',
            'kode' => $kode,
            'nota' => $nota,
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
        ];
        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('opname/add', $data);
        $this->load->view('template/footer', $data);
    }

    public function save()
    {
        $nota_opname = $this->input->post('no_nota_opname');
        $kode = $this->input->post('kode');
        $qty_aktual = $this->input->post('qty_aktual');
        $qty_program = $this->input->post('qty_program');
        $ket = $this->input->post('ket');


        $urutan = $this->db->query("SELECT max(urutan) as urutan FROM opname as a ")->row();

        if (empty($urutan->urutan)) {
           $nota_urutan = '1001';
        } else {
            $nota_urutan = $urutan->urutan + 1;
        }

        for ($x=0; $x <count($kode) ; $x++) { 
           $data = [
                'no_nota_opname' => $nota_opname,
                'kode_barang' => $kode[$x],
                'qty_program' => $qty_program[$x],
                'qty_aktual' => $qty_aktual[$x],
                'ket' => $ket[$x],
                'tgl' => date('Y-m-d'),
                'urutan' => $nota_urutan,
                'admin' => $this->session->userdata('username'),
           ];
           $this->db->insert('opname',$data);

           if ($qty_program[$x] - $qty_aktual[$x] < 0) {
              $data = [
                'kode_barang' => $kode[$x],
                'masuk' => ($qty_program[$x] - $qty_aktual[$x]) * -1,
                'keluar' => '0',
                'ket' => 'opname',
                'opname' => 'Y'
              ];
              $this->db->insert('stok',$data);
           }else{
            $data = [
                'kode_barang' => $kode[$x],
                'masuk' => '0',
                'keluar' => $qty_program[$x] - $qty_aktual[$x],
                'ket' => 'opname',
                'opname' => 'Y'
              ];
              $this->db->insert('stok',$data);
           }
        }
        $this->session->set_flashdata('success', 'Berhasil disimpan');
       redirect("opname/detail?no_nota=$nota_opname");
    }

    public function detail()
    {
        
        $nota = $this->input->get('no_nota');

        $data = [
            'title' => 'Detail Opname Barang',
            'nota' => $nota,
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'opname' => $this->db->query("SELECT * FROM opname as a left join barang as b on a.kode_barang =  b.kode where a.no_nota_opname = '$nota'")->result()

        ];
        
        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('opname/detail', $data);
        $this->load->view('template/footer', $data);
       
    }

    
}
