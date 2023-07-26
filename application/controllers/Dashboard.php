<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$data = [
            'title'=> 'Dashboard',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('dashboard',$data);
        $this->load->view('template/footer',$data);
	}
}
