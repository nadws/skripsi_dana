<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perbaikan_barang extends CI_Controller {

	public function index()
	{
		$data = [
            'title'=> 'Data Perbaikan Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM perbaikan_barang as a
            left join barang as b on b.kode = a.kode_barang
            left join vendor as c on c.id_vendor = a.id_vendor
            ORDER BY a.id_perbaikan_barang DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
            'cabang' => $this->db->get('cabang')->result(),
            'vendor' => $this->db->get('vendor')->result(),
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('perbaikan/index',$data);
        $this->load->view('template/footer',$data);
	}

    public function selesai()
    {
        $data = [
            'tgl_selesai' => date('Y-m-d'),
            'status' => 'selesai'
        ];
        $this->db->where('id_perbaikan_barang',$this->input->post('id_perbaikan_barang'));
        $this->db->update('perbaikan_barang',$data);
        $this->session->set_flashdata('success', 'Barang berhasil diperbaiki');
        redirect('Perbaikan_barang');
    }

    public function add()
    {
        $config['upload_path'] = './assets/lampiran_perbaikan/'; // Ganti dengan path folder upload sesuai dengan struktur folder Anda
        $config['allowed_types'] = 'gif|jpg|png'; // Jenis file yang diizinkan untuk diunggah (sesuaikan sesuai kebutuhan)
        $config['max_size'] = 10000; // Ukuran maksimum file dalam kilobyte (KB)

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            # code...
        } else {
            $upload_data = $this->upload->data();

            // Lakukan sesuatu dengan data gambar yang diunggah (misalnya menyimpan informasi file ke database)
            $file_name = $upload_data['file_name']; // Nama file yang diunggah
            $file_type = $upload_data['file_type']; // Tipe file (ekstensi)
            $file_size = $upload_data['file_size']; // Ukuran file dalam byte

        if ($this->input->post('dari') == '1') {
            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'qty' => $this->input->post('qty'),
                'tgl_perbaikan' => $this->input->post('tgl_perbaikan'),
                'ket' => $this->input->post('ket'),
                'status'=> 'pengajuan',
                'tgl_selesai' => '0000-00-00',
                'dari' => '1',
                'id_vendor' => $this->input->post('id_vendor'),
                'lampiran' => $file_name
               ];
               $this->db->insert('perbaikan_barang',$data);
               $this->session->set_flashdata('success', 'Berhasil disimpan');
        } else {
            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'qty' => $this->input->post('qty'),
                'tgl_perbaikan' => $this->input->post('tgl_perbaikan'),
                'ket' => $this->input->post('ket'),
                'status'=> 'pengajuan',
                'tgl_selesai' => '0000-00-00',
                'dari' => '1',
                'id_vendor' => $this->input->post('id_vendor'),
                'id_cabang' => $this->input->post('id_cabang'),
                'lampiran' => $file_name
               ];
               $this->db->insert('perbaikan_barang',$data);
               $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        }
        
       
       redirect('Perbaikan_barang');

    }
    public function edit_cabang()
    {
       $data = [
        'kode' => $this->input->post('kode'),
        'nama' => $this->input->post('nm_cabang'),
        'alamat' => $this->input->post('alamat'),
        'no_hp' => $this->input->post('no_telpon'),
       ];
       $this->db->where('id_cabang',$this->input->post('id_cabang'));
       $this->db->update('cabang',$data);
       $this->session->set_flashdata('success', 'Berhasil diupdate');
       redirect('cabang');

    }

    public function delete()
    {
        $this->db->where('id_cabang',$this->input->get('id_cabang'));
        $this->db->delete('cabang');
        $this->session->set_flashdata('success', 'Berhasil dihapus');
        redirect('cabang');
    }

    public function formulir()
    {
       $data = [
        'title' => 'PERBAIKAN BARANG'
       ];
       $this->load->view('perbaikan/formulir',$data);
    }

    public function get_barang()
    {
        $id_cabang = $this->input->get('id_cabang');
        $inventaris = $this->db->query("SELECT a.kode_barang, b.nm_barang 
        FROM inventaris_dipinjam as a
        left join barang as b on b.kode = a.kode_barang
        where a.id_cabang = '$id_cabang'
        GROUP BY a.kode_barang, b.nm_barang")->result();

        echo "<option>-Pilih Barang-</option>";
        foreach ($inventaris as $s) {
            echo "<option value='$s->kode_barang'>$s->nm_barang</option>";
        }
    }
}
