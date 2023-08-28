<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Level_karyawan extends CI_Controller {

	public function index()
	{
		$data = [
            'title'=> 'Data level karywan',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'level_karywan' => $this->db->query("SELECT * FROM level_karyawan ORDER BY id_level_karyawan DESC")->result()
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('level_karyawan/index',$data);
        $this->load->view('template/footer',$data);
	}

    public function add()
    {
       $data = [
        'nm_level' => $this->input->post('nm_level'),
       ];
       $this->db->insert('level_karyawan',$data);
       $this->session->set_flashdata('success', 'Berhasil disimpan');
       redirect('level_karyawan');

    }
    public function edit()
    {
       $data = [
        'nm_level' => $this->input->post('nm_level'),
       ];
       $this->db->where('id_level_karyawan',$this->input->post('id_level_karyawan'));
       $this->db->update('level_karyawan',$data);
       $this->session->set_flashdata('success', 'Berhasil diupdate');
       redirect('level_karyawan');

    }

    public function delete()
    {
        $id_karyawan = $this->input->get('id_level_karyawan');
        if ($id_karyawan == '6' || $id_karyawan == '7' || $id_karyawan == '8') {
            $this->session->set_flashdata('error', 'gagal dihapus');
            redirect('level_karyawan');
        } else {
            $this->db->where('id_level_karyawan',$this->input->get('id_level_karyawan'));
            $this->db->delete('level_karyawan');
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect('level_karyawan');
        }
        
       
    }
}
