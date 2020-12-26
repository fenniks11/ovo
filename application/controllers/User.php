<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sudah_login();
    }
    public function index()
    {
        $data['title'] = 'Home';
        $data['isi'] = 'home';
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();
        // $data = array(
        //     'title' => 'Home',
        //     'isi' => 'home'
        // );
        $this->load->view('user/layout/wrapper', $data, FALSE);
    }

    public function profil()
    {
        $data['title'] = 'Profil';
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] = $this->db->get_where('profil', ['nomor_ponsel' =>
        $this->session->userdata('nohp')])->row_array();

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('user/profil/profil', $data);
        $this->load->view('user/profil/footerprofil', $data);
    }

    public function update_profil()
    {
        $data['title'] = 'Halaman Update';
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] = $this->db->get_where('profil', ['nomor_ponsel' =>
        $this->session->userdata('nohp')])->row_array();

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('user/profil/update_profil', $data);
        $this->load->view('user/profil/footerprofil', $data);
    }

    public function topup()
    {
        $this->form_validation->set_rules(
            'nominal_top_up',
            'Nominal Top Up',
            'required|trim|less_than_equal_to[10000000]|Greater_than_equal_to[10000]',
            [
                'less_than_equal_to' => 'Maksimal Top Up OVO Cash Rp.10.000.000',
                'Greater_than_equal_to' => 'Minimal Top Up OVO Cash adalah Rp.10000'
            ]
        );
        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'topup',
            );
            $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
            $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
            $data['user'] =
                $this->db->get_where('profil', ['nomor_ponsel' =>
                $this->session->userdata('nohp')])->row_array();
            $this->load->view('user/profil/headerprofil', $data);
            $this->load->view('user/profil/topup', $data, FALSE);
            $this->load->view('user/profil/footerprofil', $data);
        } else {
            $data_topup = [
                'nominal_top_up' => $this->input->post('nominal_top_up'),
                'waktu_top_up' => date('Y-m-d'),
                'id_pengguna' => $this->input->post("id_pengguna")
            ];
            $this->db->insert('top_up', $data_topup);
            $data_saldo = [
                'jumlah_saldo' => $this->input->post('jumlah_saldo')
            ];
            $this->db->set("jumlah_saldo", "jumlah_saldo + $data_topup[nominal_top_up]", FALSE);
            $this->db->where("id_pengguna", $data_topup["id_pengguna"]);
            $this->db->update("saldo");
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
            TOP Up OVO kamu berhasil </div>');
            redirect('user');
        }
    }

    public function bantuan()
    {
        $data = array(
            'title' => 'bantuan',
        );
        $data['bantuan'] =
            $this->db->get()->result();

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('user/profil/bantuan', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }
}
