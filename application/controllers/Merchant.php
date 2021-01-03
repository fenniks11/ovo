<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Merchant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sudah_login();
        $this->load->model('nota_m');
    }

    public function pln()
    {
        $data['title'] = 'PLN';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/pln', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function pln_id()
    {
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        $this->db->join('profil', 'profil.id_pengguna = jenis_transaksi.id_pengguna', 'left');
        $data['jenis_transaksi'] =
            $this->db->get('jenis_transaksi')->result_array();


        $this->db->join('profil', 'nota.id_pengguna = profil.id_pengguna', 'left');
        $data['total_tagihan'] =
            $this->db->get('nota')->row_array();

        $this->db->select('biaya, nominal, (biaya + nominal) as total ', FALSE);
        $this->db->join('nota', 'nota.no_referensi = total_tagihan.no_referensi', 'left');
        $data['total_bayar'] =
            $this->db->get('total_tagihan')->result_array();

        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required|trim',
            [
                'required' => 'Nominal harus dipilih'
            ]
        );

        $this->form_validation->set_rules(
            'id_pelanggan',
            'ID Pelanggan',
            'required|trim',
            [
                'required' => 'ID Pelanggan tidak boleh kosong harus diisi lebih dulu'
            ]
        );

        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'pln id',
                'no_referensi' => $this->nota_m->invoice_no(),
            );
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
                'status_transaksi' => 'berhasil',
                'id_jenis_transaksi' => $this->input->post('id_jenis_transaksi')
            ];

            $this->db->insert('nota', $data_listrik);

            $data_total = [
                'id_pengguna' => $this->input->post('id_pengguna'),
                'no_referensi' => $this->input->post('no_referensi'),
                'total' => $this->input->post('total')
            ];
            $this->db->insert('total_tagihan', $data_total);

            $data['user'] =
                $this->db->set("jumlah_saldo", "jumlah_saldo - $data_total[total]", FALSE);
            $this->db->get_where('profil', ['id_pengguna' =>
            $this->session->userdata('id_pengguna')])->row_array();
            $this->db->update("saldo");

            $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
                Transaksi Berhasil </div>');

            redirect('user');
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
