<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'karyawan' => $this->db->query("SELECT * FROM karyawan as a
            left join departemen as b on b.id_departemen = a.id_departemen
            ORDER BY a.id_karyawan DESC")->result(),
            'departemen' => $this->db->get('departemen')->result()
        ];

        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('karyawan/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function add()
    {
        $config['upload_path'] = './assets/karyawan/'; // Ganti dengan path folder upload sesuai dengan struktur folder Anda
        $config['allowed_types'] = 'gif|jpg|png'; // Jenis file yang diizinkan untuk diunggah (sesuaikan sesuai kebutuhan)
        $config['max_size'] = 10000; // Ukuran maksimum file dalam kilobyte (KB)

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            // Jika proses upload gagal, tangani kesalahan (misalnya menampilkan pesan error)
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            // Jika proses upload berhasil, ambil data tentang gambar yang diunggah
            $upload_data = $this->upload->data();

            // Lakukan sesuatu dengan data gambar yang diunggah (misalnya menyimpan informasi file ke database)
            $file_name = $upload_data['file_name']; // Nama file yang diunggah
            $file_type = $upload_data['file_type']; // Tipe file (ekstensi)
            $file_size = $upload_data['file_size']; // Ukuran file dalam byte

            $data = array(
                'nm_karyawan' => $this->input->post('nm_karyawan'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'id_departemen' => $this->input->post('id_departemen'),
                'tgl_bergabung' => $this->input->post('tgl_bergabung'),
                'alamat' => $this->input->post('alamat'),
                'foto' => $file_name // Simpan nama file ke kolom 'foto'
            );

            $this->db->insert('karyawan', $data);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('karyawan');
        }
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
