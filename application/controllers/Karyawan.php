<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

    public function index()
    {
        $urutan = $this->db->query("SELECT max(a.urutan) as urutan FROM karyawan as a")->row();
        if (empty($urutan->urutan)) {
            $kode = '5001';
        } else {
            $kode = $urutan->urutan + 1;
        }
        
        $data = [
            'title' => 'Data Karyawan',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'karyawan' => $this->db->query("SELECT * FROM karyawan as a
            left join departemen as b on b.id_departemen = a.id_departemen
            left join level_karyawan as c on c.id_level_karyawan = a.id_level_karyawan
            ORDER BY a.id_karyawan DESC")->result(),
            'departemen' => $this->db->get('departemen')->result(),
            'nik' => $kode,
            'level' => $this->db->get('level_karyawan')->result()
        ];

        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('karyawan/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function add()
    {
        $urutan = $this->db->query("SELECT max(a.urutan) as urutan FROM karyawan as a")->row();
        if (empty($urutan->urutan)) {
            $kode = '5001';
        } else {
            $kode = $urutan->urutan + 1;
        }
        $data = [
            'nik' => $this->input->post('nik'),
            'nm_karyawan' => $this->input->post('nm_karyawan'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'id_departemen' => $this->input->post('id_departemen'),
            'tgl_bergabung' => $this->input->post('tgl_bergabung'),
            'alamat' => $this->input->post('alamat'),
            'foto' => 'default.png',
            'id_level_karyawan' => $this->input->post('id_level_karyawan'),
            'urutan' => $kode
        ];

        $this->db->insert('karyawan', $data);
        $data = array(
            'nama' => $this->input->post('nm_karyawan'),
            'username' => $this->input->post('nik'),
            'image' => 'default.png',
            'password' => password_hash($this->input->post('nik'), PASSWORD_DEFAULT),
            'id_role' => 2,
            'is_active' => 1
        );
        
        $this->db->insert('user', $data);
        $this->session->set_flashdata('success', 'Berhasil disimpan');
        redirect('karyawan');
    }
    public function edit()
    {
        $data = [
            'nama_departemen' => $this->input->post('nama_departemen'),
            'lokasi' => $this->input->post('alamat'),
        ];
        $this->db->where('id_departemen', $this->input->post('id_departemen'));
        $this->db->update('departemen', $data);
        $this->session->set_flashdata('success', 'Berhasil diupdate');
        redirect('departemen');
    }

    public function delete()
    {
        $this->db->where('id_departemen', $this->input->get('id_departemen'));
        $this->db->delete('departemen');
        $this->session->set_flashdata('success', 'Berhasil dihapus');
        redirect('departemen');
    }
}
