<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
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
            'title' => 'Data Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'barang' => $this->db->query("SELECT a.*, b.masuk, b.keluar FROM barang as a
            left join(
                SELECT b.kode_barang, sum(b.masuk) as masuk , sum(b.keluar) as keluar
                FROM stok as b 
                group by b.kode_barang
            ) as b on b.kode_barang = a.kode
             ORDER BY a.id_barang DESC")->result(),
            'departemen' => $this->db->get('departemen')->result(),
            'kode' =>  $kode_barang
        ];

        $this->load->view('template/head', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('barang/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function add()
    {
        $kode =  $this->db->query("SELECT max(a.urutan) as urutan_kode FROM barang as a")->row();
        if (empty($kode->urutan_kode)) {
           $kode_barang = '1001';
        } else {
            $kode_barang = $kode->urutan_kode + 1;
        }
        
        $data = array(
            'kode' => $this->input->post('kode_barang'),
            'nm_barang' => $this->input->post('nm_barang'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'urutan' => $kode_barang
        );
        $this->db->insert('barang', $data);
        $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'masuk' => $this->input->post('stok'),
            'keluar' => '0',
            'ket' => 'Stok awal'
        ];
        $this->db->insert('stok', $data);
        $this->session->set_flashdata('success', 'Berhasil disimpan');
        redirect('barang');
            
        
    }
    public function edit()
    {
        $this->db->where('kode',$this->input->post('kode_barang'));
        $this->db->delete('barang');

        $this->db->where('kode_barang',$this->input->post('kode_barang'));
        $this->db->where('ket','Stok awal');
        $this->db->delete('stok');


        $config['upload_path'] = './assets/barang/'; // Ganti dengan path folder upload sesuai dengan struktur folder Anda
        $config['allowed_types'] = 'gif|jpg|png'; // Jenis file yang diizinkan untuk diunggah (sesuaikan sesuai kebutuhan)
        $config['max_size'] = 10000; // Ukuran maksimum file dalam kilobyte (KB)

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $data = array(
                'kode' => $this->input->post('kode_barang'),
                'nm_barang' => $this->input->post('nm_barang'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'urutan' => $this->input->post('urutan'),
                'image' => $this->input->post('foto_2'), // Simpan nama file ke kolom 'foto'
            );
            $this->db->insert('barang', $data);
            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'masuk' => $this->input->post('stok'),
                'keluar' => '0',
                'ket' => 'Stok awal'
            ];
            $this->db->insert('stok', $data);
        } else {
            // Jika proses upload berhasil, ambil data tentang gambar yang diunggah
            $upload_data = $this->upload->data();

            // Lakukan sesuatu dengan data gambar yang diunggah (misalnya menyimpan informasi file ke database)
            $file_name = $upload_data['file_name']; // Nama file yang diunggah
            $file_type = $upload_data['file_type']; // Tipe file (ekstensi)
            $file_size = $upload_data['file_size']; // Ukuran file dalam byte

            $data = array(
                'kode' => $this->input->post('kode_barang'),
                'nm_barang' => $this->input->post('nm_barang'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'image' => $file_name // Simpan nama file ke kolom 'foto'
            );
            $this->db->insert('barang', $data);
            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'masuk' => $this->input->post('stok'),
                'keluar' => '0',
                'ket' => 'Stok awal'
            ];
            $this->db->insert('stok', $data);
        }
        $this->session->set_flashdata('success', 'Berhasil disimpan');
        redirect('barang');
    }

    public function delete()
    {
        $this->db->where('id_departemen', $this->input->get('id_departemen'));
        $this->db->delete('departemen');
        $this->session->set_flashdata('success', 'Berhasil dihapus');
        redirect('departemen');
    }
}
