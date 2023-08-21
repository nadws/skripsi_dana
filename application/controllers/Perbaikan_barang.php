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
            ORDER BY a.id_perbaikan_barang DESC")->result(),
            'barang' => $this->db->get('barang')->result(),
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
       $data = [
        'kode_barang' => $this->input->post('kode_barang'),
        'qty' => $this->input->post('qty'),
        'tgl_perbaikan' => $this->input->post('tgl_perbaikan'),
        'ket' => $this->input->post('ket'),
        'status'=> 'belum selesai',
        'tgl_selesai' => '0000-00-00'
       ];
       $this->db->insert('perbaikan_barang',$data);
       $this->session->set_flashdata('success', 'Berhasil disimpan');
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
}