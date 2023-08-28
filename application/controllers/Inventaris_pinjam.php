<?php
defined('BASEPATH') OR exit('No direct script access allowed');





class inventaris_pinjam extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }


	public function index()
	{
        $id_cabang = $this->input->get('id_cabang');
        if (empty($id_cabang)) {
            $inventaris = $this->db->query("SELECT * FROM inventaris_dipinjam as a
            left join barang as b on b.kode = a.kode_barang
            left join karyawan as c on c.nik = a.nik
            left join cabang  as d on d.id_cabang = a.id_cabang
            ORDER BY a.id_peminjaman_inv DESC")->result();
            $nm_cabang = 'Semua Cabang';
            
        } else {
            $inventaris = $this->db->query("SELECT * FROM inventaris_dipinjam as a
            left join barang as b on b.kode = a.kode_barang
            left join karyawan as c on c.nik = a.nik
            left join cabang  as d on d.id_cabang = a.id_cabang
            where a.id_cabang = $id_cabang
            ORDER BY a.id_peminjaman_inv DESC")->result();
            $cabang = $this->db->get_where('cabang',['id_cabang' => $id_cabang])->row();
            $nm_cabang = $cabang->nama;
        }
        
        

        



        // $qrCodeURL = base_url('dana/inventaris_pinjam/formulir');


		$data = [
            'title'=> 'Data Peminjaman Inventaris',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' =>  $inventaris,
            'barang' => $this->db->get('barang')->result(),
            'karyawan' => $this->db->get('karyawan')->result(),
            'cabang' => $this->db->get('cabang')->result(),
            'nm_cabang' => $nm_cabang
        
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('inventaris_pinjam/index',$data);
        $this->load->view('template/footer',$data);
	}

    public function generate_qr_code($url) {
        // Generate QR code and display it
        header('Content-Type: image/png');
        QrCode::format('png')->size(200)->generate($url);
    }

    public function kembalikan()
    {
        $data = [
            'tgl_kembali' => date('Y-m-d'),
            'status_pinjam' => 'kembali'
        ];
        $this->db->where('id_peminjaman_inv',$this->input->post('id_peminjaman_inv'));
        $this->db->update('inventaris_dipinjam',$data);

        $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'masuk' => $this->input->post('qty'),
            'keluar' => 0,
            'ket' => 'pengembalian peminjaman'
        ];
        $this->db->insert('stok', $data);

        $this->session->set_flashdata('success', 'Barang berhasil dikembalikan');
        redirect('inventaris_pinjam');
    }
    public function setujui()
    {
        $setuju = $this->input->post('setuju');
        
        if ($setuju == 'tidak') {
            $data = [
                'ket' => 'tidak_setuju'
            ];
            $this->db->where('id_peminjaman_inv',$this->input->post('id_peminjaman_inv'));
            $this->db->update('inventaris_dipinjam',$data);
            $this->session->set_flashdata('success', 'Peminjaman Tidak Disietujui');
        } else {
            $data = [
                'ket' => 'setuju'
            ];
            $this->db->where('id_peminjaman_inv',$this->input->post('id_peminjaman_inv'));
            $this->db->update('inventaris_dipinjam',$data);
    
            $kode = $this->input->post('kode_barang');
            $barang = $this->db->query("SELECT b.masuk, b.keluar FROM barang as a 
            left join(
                    SELECT b.kode_barang, sum(b.masuk) as masuk , sum(b.keluar) as keluar
                    FROM stok as b 
                    group by b.kode_barang
                ) as b on b.kode_barang = a.kode
            where a.kode = '$kode' ")->row();
    
            $jumlah = $barang->masuk - $barang->keluar -$qty;
            $stok = $barang->masuk - $barang->keluar;
    
            if ($jumlah < 0) {
                $this->session->set_flashdata('error', "Gagal disimpan stok yang tersedia  $stok");
                redirect('inventaris_pinjam');
           } else {
            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'masuk' => 0,
                'keluar' => $this->input->post('qty'),
                'ket' => 'Peminjaman'
            ];
            $this->db->insert('stok', $data);
            }
    
            $this->session->set_flashdata('success', 'Peminjaman Disietujui');
        }
        
       
        redirect('inventaris_pinjam');
    }

    public function add()
    {
        $kode = $this->input->post('kode_barang');
        $qty =  $this->input->post('qty');
        $barang = $this->db->query("SELECT b.masuk, b.keluar FROM barang as a 
        left join(
                SELECT b.kode_barang, sum(b.masuk) as masuk , sum(b.keluar) as keluar
                FROM stok as b 
                group by b.kode_barang
            ) as b on b.kode_barang = a.kode
        where a.kode = '$kode' ")->row();

        $jumlah = $barang->masuk - $barang->keluar -$qty;
        $stok = $barang->masuk - $barang->keluar;

        $config['upload_path'] = './assets/lampiran_pinjam/'; // Ganti dengan path folder upload sesuai dengan struktur folder Anda
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

            $data = [
                'kode_barang' => $this->input->post('kode_barang'),
                'qty' => $this->input->post('qty'),
                'tgl_pinjam' => $this->input->post('tgl_pinjam'),
                'nik' => $this->input->post('nik'),
                'tgl_kembali' => $this->input->post('tgl_kembali'),
                'ket' => 'pengajuan',
                'status_pinjam'=> 'dipinjam',
                'admin' => $this->session->userdata('username'),
                'id_cabang' => $this->input->post('id_cabang'),
                'lampiran' => $file_name
                
               ];
               $this->db->insert('inventaris_dipinjam',$data);
               
               $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        

       
        
           redirect('inventaris_pinjam');
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

    public function get_setuju()
    {
        $id = $this->input->get('id_inventaris');
        $pinjam = $this->db->get_where('inventaris_dipinjam', ['id_peminjaman_inv' => $id])->row();

        $data = ['lampiran'=>$pinjam];

        $this->load->view('inventaris_pinjam/lampiran',$data);
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
        'title' => 'PEMINJAMAN BARANG'
       ];
       $this->load->view('inventaris_pinjam/formulir',$data);
    }
}
