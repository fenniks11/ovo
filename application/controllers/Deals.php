<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deals extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
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
}
