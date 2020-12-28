<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Merchant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sudah_login();
    }
    public function index()
    {
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required|trim',
            [
                'required' => 'Nominal harus dipilih'
            ]
        );
        $this->form_validation->set_rules(
            'nomor_meter',
            'Nomor Meter',
            'required|trim',
            [
                'required' => 'Nomor Meter harus diisi lebih dulu'
            ]
        );

        if ($this->form_validation->run() == false) {
            $data['title'] = 'PLN';
            $this->load->view('user/merchant/headerMerchant', $data, FALSE);
            $this->load->view('user/merchant/pln', $data, FALSE);
            $this->load->view('user/merchant/footerMerchant', $data, FALSE);
        } else {
            $data_transaksi = [
                'id_pengguna' => $this->input->post("id_pengguna"),
                'nama_transaksi' => 'Pembayaran listrik PLN'
            ];

            $this->db->insert('jenis_transaksi', $data_transaksi);

            $data_listrik = [
                'nama_merchant' => 'PLN',
                'nominal' => $this->input->post('nominal'),
                'id_pengguna' => $this->input->post("id_pengguna"),
                'biaya' => 2000,
                'total' => intval($this->input->post('total')) +  intval($this->input->post('biaya')),
                'status_transaksi' => 'berhasil'
            ];

            $data['listrik'] =
                $this->db->get_where('nota', ['total' => $data_listrik['total']])->result_array();

            $this->load->view('user/merchant/headerMerchant', $data, FALSE);
            $this->load->view('user/merchant/pln', $data, FALSE);
            $this->load->view('user/merchant/footerMerchant', $data, FALSE);
            // $this->db->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = nota.id_jenis_transaksi', 'left');
            // $this->db->select('id_jenis_transaksi');
            // $this->db->get('jenis_transaksi');
            // $this->db->insert_id();
            $this->db->insert('nota', $data_listrik);

            // $this->db->set("jumlah_saldo", "jumlah_saldo + $data_listrik[nominal_top_up]", FALSE);
            // $this->db->where("id_pengguna", $data_listrik["id_pengguna"]);
            // $this->db->update("saldo");

        }
    }

    public function pulsa()
    {
        $data['title'] = 'PULSA';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/pulsa', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function voucher_game()
    {
        $data['title'] = 'PULSA';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/voucher_game', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function airPDAM()
    {
        $data['title'] = 'PULSA';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/airPDAM', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function bpjs()
    {
        $data['title'] = 'PULSA';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/bpjs', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function itk()
    {
        $data['title'] = 'PULSA';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/itk', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function proteksi()
    {
        $data['title'] = 'PULSA';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/proteksi', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function lainnya()
    {
        $data['title'] = 'PULSA';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/lainnya', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }
}
