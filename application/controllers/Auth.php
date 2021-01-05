<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        // cek adakah session(login) berarti tidak boleh ke halaman login
        if ($this->session->userdata('nohp')) {
            redirect('user');
        }

        $this->form_validation->set_rules('nohp', 'Nomor HP', 'required|trim|is_natural');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|is_natural');
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'LOGIN';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $nohp = $this->input->post('nohp');
        $password = $this->input->post('password');

        $user = $this->db->get_where('profil', ['nomor_ponsel' => $nohp])->row_array();

        // Jika User terdaftar
        if ($user) {
            // jika Usernya aktif
            if ($user['is_active'] == 1) {
                //cekpassword

                if (password_verify($password, $user['password'])) {
                    $dataprofil = [
                        'nohp' => $user['nomor_ponsel'],
                        'jenis_ovo' => $user['jenis_ovo']
                    ];
                    $this->session->set_userdata($dataprofil);
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Password yang kamu masukkan salah :( </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                Nomor telepon ini sudah tidak aktif :( </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Nomor telepon ini belum terdaftar :( </div>');
            redirect('auth');
        }
    }

    public function register()
    {
        // cek adakah session(login) berarti tidak boleh ke halaman register
        if ($this->session->userdata('nohp')) {
            redirect('user');
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[profil.email]',
            [
                'is_unique' => 'Email ini Sudah terdaftar, masukkan email lain.'
            ]
        );
        $this->form_validation->set_rules('password', 'Password', 'required|trim|is_natural|min_length[6]|max_length[6]');
        $this->form_validation->set_rules('nohp', 'Nomor Hp', 'required|trim|is_natural|min_length[12]|max_length[12]|is_unique[profil.nomor_ponsel]');
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'REGISTER';
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('template/auth_footer');
        } else {
            $dataprofil = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama', true)),
                'nomor_ponsel' => $this->input->post('nohp'),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'img' => 'default.jpg',
                'jenis_ovo' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('profil', $dataprofil);
            $data_saldo = [
                'id_pengguna' => $this->db->insert_id(),
                'jumlah_saldo' => 0
            ];
            $this->db->insert('saldo', $data_saldo);
            $this->session->set_flashdata('pesan', '<div class="alert alert-primary" role="alert">
            Selamat akun kamu sudah terdaftar, login dulu yaa </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nohp');
        $this->session->unset_userdata('jenis_ovo');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
           Sampai jumpa kembali :) </div>');
        redirect('auth');
    }
}
