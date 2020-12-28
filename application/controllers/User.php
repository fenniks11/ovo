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
                'id_pengguna' => $this->input->post("id_pengguna")
            ];
            $this->db->insert('top_up', $data_topup);

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

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('user/profil/bantuan', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }

    public function transfer()
    {
        $data = array(
            'title' => 'Transfer',
        );
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        if ($this->session->userdata('jenis_ovo') === '1') {
            $this->load->view('user/profil/headerprofil', $data);
            $this->load->view('user/transfer/transfer', $data, FALSE);
            $this->load->view('user/profil/footerprofil', $data);
        } else {

            redirect('user');
        }
    }
    public function sesama_ovo()
    {
        if ($this->session->userdata('jenis_ovo') === '1') {
            $this->form_validation->set_rules('nomor_ponsel_penerima', 'Nomor Hp', 'required|trim|is_natural|min_length[12]|max_length[12]');

            $this->form_validation->set_rules(
                'nominal',
                'Nominal Transfer',
                'required|trim|less_than_equal_to[10000000]|Greater_than_equal_to[10000]',
                [
                    'less_than_equal_to' => 'Maksimal Transfer Rp.10.000.000',
                    'Greater_than_equal_to' => 'Minimal Transfer adalah Rp.10000'
                ]
            );

            if ($this->form_validation->run() == false) {
                $data = array(
                    'title' => 'TF ke sesama OVO',
                );
                $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
                $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
                $data['user'] =
                    $this->db->get_where('profil', ['nomor_ponsel' =>
                    $this->session->userdata('nohp')])->row_array();

                $this->load->view('user/profil/headerprofil', $data);
                $this->load->view('user/transfer/sesama_ovo', $data, FALSE);
                $this->load->view('user/profil/footerprofil', $data);
            } else {
                $data_transfer = [
                    'nominal' => $this->input->post('nominal'),
                    'nomor_ponsel_penerima' => $this->input->post('nomor_ponsel_penerima'),
                    'id_pengguna' => $this->input->post('id_pengguna')
                ];
                $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
                $this->db->get_where('profil', ['nomor_ponsel' =>
                $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();

                $this->db->insert('transfer', $data_transfer);

                $data['user'] =
                    $this->db->set("jumlah_saldo", "jumlah_saldo - $data_transfer[nominal]", FALSE);
                $this->db->get_where('profil', ['id_pengguna' =>
                $this->session->userdata('id_pengguna')])->row_array();
                $this->db->update("saldo");


                $this->db->set("jumlah_saldo", "jumlah_saldo + $data_transfer[nominal]", FALSE);
                $this->db->where("id_pengguna");
                $this->db->update("saldo");


                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
                Transfer berhasil </div>');

                redirect('user/sesama_ovo');
            }
        } else {

            redirect('user');
        }
    }

    public function rek_bank()
    {
        if ($this->session->userdata('jenis_ovo') === '1') {
            $this->form_validation->set_rules('nomor_ponsel_penerima', 'Nomor Hp', 'required|trim|is_natural|min_length[12]|max_length[12]');

            $this->form_validation->set_rules(
                'nominal',
                'Nominal Transfer',
                'required|trim|less_than_equal_to[10000000]|Greater_than_equal_to[10000]',
                [
                    'less_than_equal_to' => 'Maksimal Transfer Rp.10.000.000',
                    'Greater_than_equal_to' => 'Minimal Transfer adalah Rp.10000'
                ]
            );

            if ($this->form_validation->run() == false) {
                $data = array(
                    'title' => 'TF ke rekening Bank',
                );
                $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
                $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
                $data['user'] =
                    $this->db->get_where('profil', ['nomor_ponsel' =>
                    $this->session->userdata('nohp')])->row_array();

                $this->load->view('user/profil/headerprofil', $data);
                $this->load->view('user/transfer/rek_bank', $data, FALSE);
                $this->load->view('user/profil/footerprofil', $data);
            } else {
                $data_transfer = [
                    'nominal' => $this->input->post('nominal'),
                    'waktu' => date('Y-m-d H:i:s'),
                    'nomor_ponsel_penerima' => $this->input->post('nomor_ponsel_penerima'),
                    'id_pengguna' => $this->input->post('id_pengguna')
                ];
                $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
                $this->db->get_where('profil', ['nomor_ponsel' =>
                $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();

                $this->db->insert('transfer', $data_transfer);

                $data['user'] =
                    $this->db->set("jumlah_saldo", "jumlah_saldo - $data_transfer[nominal]", FALSE);
                $this->db->get_where('profil', ['id_pengguna' =>
                $this->session->userdata('id_pengguna')])->row_array();
                $this->db->update("saldo");


                $this->db->set("jumlah_saldo", "jumlah_saldo + $data_transfer[nominal]", FALSE);
                $this->db->where("id_pengguna");
                $this->db->update("saldo");


                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
                Transfer berhasil </div>');

                redirect('user/sesama_ovo');
            }
        } else {

            redirect('user');
        }
    }
}
