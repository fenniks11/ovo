<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bantuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sudah_login();
    }

    public function index()
    {
        $data = array(
            'title' => 'bantuan',
        );

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('user/profil/bantuan', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }

    public function info()
    {
        $data = array(
            'title' => 'Info Umum',
        );

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('bantuan/info_umum', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }

    public function transaksi_merchant()
    {
        $data = array(
            'title' => 'Transaksi Di Merchant',
        );

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('bantuan/transaksi_di_merchant', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }
}
