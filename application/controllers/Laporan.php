<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'karyawan' => $this->db->query("SELECT * FROM karyawan as a
            left join departemen as b on b.id_departemen = a.id_departemen
            left join level_karyawan as c on c.id_level_karyawan = a.id_level_karyawan
            ORDER BY a.id_karyawan DESC")->result(),
        ];

        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('template/footer', $data);
    }
}
