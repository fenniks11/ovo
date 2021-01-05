<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deals extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sudah_login();
    }
    public function index()
    {
        $data = array(
            'title' => 'Deals',
        );

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('deals/index', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }

    public function semua_cashback()
    {
        $data = array(
            'title' => 'Semua Cashback',
        );

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('deals/semua_cashback', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }

    public function semua_voucher()
    {
        $data = array(
            'title' => 'Semua Voucher',
        );

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('deals/semua_voucher', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }

    // fungsi-fungsi load cashback
    public function sos()
    {
        $data = array(
            'title' => 'Promo SOS Bisa di Nikmatin Dimana Aja',
        );

        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        $data['cashback'] =
            $this->db->get_where('cashback', ['id_cashback' => '1'])->row_array();

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('deals/cashback/sos', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);

        $data_cashback = [
            'id_cashback' => $data['cashback']['id_cashback'],
            'tgl_kadaluarsa' => $data['cashback']['tgl_akhir'],
            'id_pengguna' => $data['user']['id_pengguna']
        ];
        $harga = $data['cashback']['max_pot_harga'];
        $point = $data['cashback']['point'];

        // query cek jika saldo kurang
        // select if saldo.jumlah_saldo < max_pot_harga.cashback as saldo_kurang saldo.jumlah_saldo 
        // from saldo join nota on nota.id_pengguna = profil.id_pengguna 
        // where profil.nomor_ponsel = nomor ponsel yang sedang login

        $cek_saldo['saldo_kurang'] =
            $this->db->select("IF(saldo.jumlah_saldo < $harga, 1, 0) as saldo_kurang, saldo.jumlah_saldo", FALSE)
            ->from('saldo')
            ->join('nota', 'nota.id_pengguna=profil.id_pengguna')
            ->get_where('profil', ['nomor_ponsel' => $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();

        if ($cek_saldo["saldo_kurang"]["saldo_kurang"]) {
            // Kalau saldo kurang
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Transfer gagal, saldo kamu tidak cukup. Silahkan top up lebih dulu. </div>');
            redirect('user');
        } else {
            $this->db->trans_begin();

            // insert into
            $this->db->insert('trash_cashback', $data_cashback);
            $this->db->set("jumlah_saldo", "jumlah_saldo - $harga", FALSE);
            $this->db->set("point", "point + $point", FALSE);
            $this->db->where("id_pengguna", $data['user']['id_pengguna']);
            $this->db->update("saldo");

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }
    }

    // fungsi-funsgi load voucher
    public function voucher_makan()
    {
        $data = array(
            'title' => 'Promo SOS Bisa di Nikmatin Dimana Aja',
        );

        // select * from profil join saldo on saldo.id_pengguna = profil.id_pengguna
        // join jenis_user on jenis_user.jenis_ovo = profil. jenis_ovo
        // where nomor_ponsel = 083192164289
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        // select * from voucher where id_voucher = 1
        $data['voucher'] =
            $this->db->get_where('voucher', ['id_voucher' => '1'])->row_array();
        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('deals/voucher/voucher_makan', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);

        $data_voucher = [
            'id_voucher' => $data['voucher']['id_voucher'],
            'tgl_kadaluarsa' => $data['voucher']['tgl_akhir'],
            'id_pengguna' => $data['user']['id_pengguna']
        ];
        $harga = $data['voucher']['harga'];
        $point = $data['voucher']['point'];

        $cek_saldo['saldo_kurang'] =
            $this->db->select("IF(saldo.jumlah_saldo < $harga, 1, 0) as saldo_kurang, saldo.jumlah_saldo", FALSE)
            ->from('saldo')
            ->join('nota', 'nota.id_pengguna=profil.id_pengguna')
            ->get_where('profil', ['nomor_ponsel' => $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();

        if ($cek_saldo["saldo_kurang"]["saldo_kurang"]) {
            // Kalau saldo kurang
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Transfer gagal, saldo kamu tidak cukup. Silahkan top up lebih dulu. </div>');
            redirect('user');
        } else {
            $this->db->trans_begin();
            $this->db->insert('trash_voucher', $data_voucher);
            $this->db->set("jumlah_saldo", "jumlah_saldo - $harga", FALSE);
            $this->db->set("point", "point + $point", FALSE);
            $this->db->where("id_pengguna", $data['user']['id_pengguna']);
            $this->db->update("saldo");

            $this->db->set("banyak_voucher", "banyak_voucher - 1");
            $this->db->where("id_voucher", $data['voucher']['id_voucher']);

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }
    }
}
