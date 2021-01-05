<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upgrade_ovo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('NIK', 'Nomor Induk Keluarga', 'required|is_unique[profil_premier.NIK]', array('required' => '%s Harus Diisi!', 'is_unique' => '%s Sudah pernah terdaftar'));
        if ($this->form_validation->run() == true) {
            $config['upload_path'] = './assets/img/foto_ktp/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto_ktp')) {
                $data = array(
                    'title' => 'Upgrade OVO',
                );
                $data['user'] =
                    $this->db->get_where('profil', ['nomor_ponsel' =>
                    $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();
                $this->load->view('user/profil/headerprofil', $data);
                $this->load->view('user/upgrade_ovo', $data, FALSE);
                $this->load->view('user/profil/footerprofil', $data);
            } else {
                $upload_data = array('uploads' => $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/foto_ktp/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);

                $data = array(
                    'NIK' => $this->input->post('NIK'),
                    'id_pengguna' => $this->input->post('id_pengguna'),
                    'foto_ktp' => $upload_data['uploads']['file_name']
                );

                $this->db->insert('profil_premier', $data);

                $data = [
                    "jenis_ovo" => 1
                ];
                $this->db->set('jenis_ovo', $data["jenis_ovo"]);
                $this->db->where('nomor_ponsel', $this->session->userdata('nohp'));
                $this->db->update('profil');

                $this->session->set_flashdata('pesan', 'Berhasil upgrade ke OVO Premier.');
                redirect('user');
            }
        }
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();
        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('user/upgrade_ovo', $data, FALSE);
        $this->load->view('user/profil/footerprofil', $data);
    }
}
