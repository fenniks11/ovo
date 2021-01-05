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

    public function delete($id_notifikasi)
    {
        $data = array(
            'id_notifikasi' => $id_notifikasi
        );

        // DELETE FROM notifikasi WHERE ID = 1
        $this->db->where('id_notifikasi', $data['id_notifikasi']);
        $this->db->delete('notifikasi', $data);

        $this->session->set_flashdata('pesan', 'Data Berhasil dihapus.');
        redirect('notif');

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('notif', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }
}
