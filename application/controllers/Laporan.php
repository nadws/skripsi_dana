<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function index()
    {    
        $data = [
            'title' => 'Data Karyawan',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
        ];

        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('template/footer', $data);
    }
}
