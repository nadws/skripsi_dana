<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Data Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'barang' => $this->db->query("SELECT * FROM barang ORDER BY id_barang DESC")->result(),
            'departemen' => $this->db->get('departemen')->result()
        ];

        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('barang/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function add()
    {
        $config['upload_path'] = './assets/barang/'; // Ganti dengan path folder upload sesuai dengan struktur folder Anda
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
                'nm_barang' => $this->input->post('nm_barang'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'image' => $file_name // Simpan nama file ke kolom 'foto'
            );

            $this->db->insert('barang', $data);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('barang');
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
