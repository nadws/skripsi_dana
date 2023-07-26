<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends CI_Controller {

	public function index()
	{
		$data = [
            'title'=> 'Data Departemen',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'departemen' => $this->db->query("SELECT * FROM departemen ORDER BY id_departemen DESC")->result()
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('departemen/index',$data);
        $this->load->view('template/footer',$data);
	}

    public function add()
    {
       $data = [
        'nama_departemen' => $this->input->post('nama_departemen'),
        'lokasi' => $this->input->post('alamat'),
       ];
       $this->db->insert('departemen',$data);
       $this->session->set_flashdata('success', 'Berhasil disimpan');
       redirect('departemen');

    }
    public function edit()
    {
       $data = [
        'nama_departemen' => $this->input->post('nama_departemen'),
        'lokasi' => $this->input->post('alamat'),
       ];
       $this->db->where('id_departemen',$this->input->post('id_departemen'));
       $this->db->update('departemen',$data);
       $this->session->set_flashdata('success', 'Berhasil diupdate');
       redirect('departemen');

    }

    public function delete()
    {
        $this->db->where('id_departemen',$this->input->get('id_departemen'));
        $this->db->delete('departemen');
        $this->session->set_flashdata('success', 'Berhasil dihapus');
        redirect('departemen');
    }
}
