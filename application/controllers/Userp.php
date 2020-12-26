<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userp extends CI_Controller
{

    public function _construct()
    {
        parent::__construct();
        sudah_login();
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['isi'] = 'home';
        $data['user'] = $this->db->get_where('profil', ['nomor_ponsel' =>
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
        $data['user'] = $this->db->get_where('profil', ['nomor_ponsel' =>
        $this->session->userdata('nohp')])->row_array();

        $this->load->view('user/headerprofil', $data);
        $this->load->view('user/profilp', $data);
        $this->load->view('user/footerprofil', $data);
    }
    public function topup()
    {
        $data = array(
            'title' => 'topup',
        );
        $this->load->view('user/topup', $data, FALSE);
    }
}
