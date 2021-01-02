<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Promo';
        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('user/promo/index', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }
}
