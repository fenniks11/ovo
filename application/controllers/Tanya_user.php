<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tanya_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data = array(
            'title' => 'Upgrade OVO',
        );
        // select * from profil where nomor_ponsel = 083192164289
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();


        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('tanya_user', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }
}
