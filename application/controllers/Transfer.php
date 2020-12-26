<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transfer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sudah_login();
    }
    public function index()
    {
        $data = array(
            'title' => 'transfer',
        );
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        if ($this->session->userdata('jenis_ovo') === '1') {
            $this->load->view('user/transfer', $data, FALSE);

            echo ($this->session->userdata('jenis_ovo'));
        } else {

            redirect('user');
        }
    }
}
