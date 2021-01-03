<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notif extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data = array(
            'title' => 'History',
        );

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('notif', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }
}
