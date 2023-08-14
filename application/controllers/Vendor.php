<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	public function index()
	{
		$data = [
            'title'=> 'Data Vendor',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'vendor' => $this->db->query("SELECT * FROM vendor ORDER BY id_vendor DESC")->result()
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('vendor/index',$data);
        $this->load->view('template/footer',$data);
	}

    public function add()
    {
       $data = [
        'nm_vendor' => $this->input->post('nm_vendor'),
        'alamat' => $this->input->post('alamat'),
        'email' => $this->input->post('email'),
        'no_telp' => $this->input->post('no_telp'),
       ];
       $this->db->insert('vendor',$data);
       $this->session->set_flashdata('success', 'Berhasil disimpan');
       redirect('vendor');

    }
    public function edit()
    {
       $data = [
        'nm_vendor' => $this->input->post('nm_vendor'),
        'alamat' => $this->input->post('alamat'),
        'email' => $this->input->post('email'),
        'no_telp' => $this->input->post('no_telp'),
       ];
       $this->db->where('id_vendor',$this->input->post('id_vendor'));
       $this->db->update('vendor',$data);
       $this->session->set_flashdata('success', 'Berhasil diupdate');
       redirect('vendor');

    }

    public function delete()
    {
        $this->db->where('id_vendor',$this->input->get('id_vendor'));
        $this->db->delete('vendor');
        $this->session->set_flashdata('success', 'Berhasil dihapus');
        redirect('vendor');
    }
}
