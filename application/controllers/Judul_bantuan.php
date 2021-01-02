<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Judul_bantuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
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
