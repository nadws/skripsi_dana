<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemusnahan_barang extends CI_Controller {

	public function index()
	{
		$data = [
            'title'=> 'Data Pemusnahan Barang',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row(),
            'inventaris' => $this->db->query("SELECT * FROM pemusnahan_barang as a
            left join barang as b on b.kode = a.kode_barang
            ORDER BY a.id_pemusnahan_barang DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
        ];

        $this->load->view('template/head',$data);
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('pemusnahan/index',$data);
        $this->load->view('template/footer',$data);
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

        if ($jumlah < 0) {
            $this->session->set_flashdata('error', "Gagal disimpan stok yang tersedia  $stok");
            redirect('pemusnahan_barang');
       } else {
        $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'qty' => $this->input->post('qty'),
            'tgl_pemusnahan' => $this->input->post('tgl_pemusnahan'),
            'ket' => $this->input->post('ket'),
           ];
           $this->db->insert('pemusnahan_barang',$data);
           $data = [
            'kode_barang' => $this->input->post('kode_barang'),
            'masuk' => 0,
            'keluar' => $this->input->post('qty'),
            'ket' => 'Pemusnahan'
        ];
        $this->db->insert('stok', $data);
        $this->session->set_flashdata('success', 'Berhasil disimpan');
       redirect('pemusnahan_barang');
       }
       
       

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
