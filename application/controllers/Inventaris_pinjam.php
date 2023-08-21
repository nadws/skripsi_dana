<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class inventaris_pinjam extends CI_Controller {

	public function index()
	{
		$data = [
            'title'=> 'Data Peminjaman Inventaris',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM inventaris_dipinjam as a
            left join barang as b on b.kode = a.kode_barang
            left join karyawan as c on c.nik = a.nik
            ORDER BY a.id_peminjaman_inv DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
            'karyawan' => $this->db->get('karyawan')->result()
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('inventaris_pinjam/index',$data);
        $this->load->view('template/footer',$data);
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

        $this->session->set_flashdata('success', 'Barang berhasil dikembalikan');
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

       
        $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'qty' => $this->input->post('qty'),
            'tgl_pinjam' => $this->input->post('tgl_pinjam'),
            'nik' => $this->input->post('nik'),
            'status_pinjam'=> 'dipinjam',
            'tgl_kembali' => '0000-00-00',
            'ket' => 'pengajuan',
            'admin' => $this->session->userdata('username')
           ];
           $this->db->insert('inventaris_dipinjam',$data);
           
           $this->session->set_flashdata('success', 'Berhasil disimpan');
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

    public function delete()
    {
        $this->db->where('id_cabang',$this->input->get('id_cabang'));
        $this->db->delete('cabang');
        $this->session->set_flashdata('success', 'Berhasil dihapus');
        redirect('cabang');
    }
}
