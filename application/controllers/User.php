<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sudah_login();

        $this->load->library('Ciqrcode');
        $this->load->library('Zend');
    }
    public function index()
    {

        $data['title'] = 'Home';
        $data['isi'] = 'home';
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();
        // $data = array(
        //     'title' => 'Home',
        //     'isi' => 'home'
        // );
        $this->load->view('user/layout/wrapper', $data, FALSE);
    }

    // Controller untuk menghandle Barcode dan QR Code
    public function QRcode($kodenya)
    {
        //  render qr dengan format gambar PNG
        QRcode::png(
            $kodenya,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 6,
            $margin = 2
        );
    }

    public function Barcode($kodenya)
    {
        $this->zend->load('Zend/Barcode');

        Zend_Barcode::render('code128', 'image', array('text' => $kodenya));
    }
    // end Controller untuk menghandle Barcode dan QR Code

    public function profil()
    {
        $data['title'] = 'Profil';
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] = $this->db->get_where('profil', ['nomor_ponsel' =>
        $this->session->userdata('nohp')])->row_array();

        $this->load->view('user/profil/headerprofil', $data);
        $this->load->view('user/profil/profil', $data);
        $this->load->view('user/profil/footerprofil', $data);
    }

    public function update_profil()
    {

        $this->form_validation->set_rules(
            'nohp',
            'Nomor Hp',
            'required|trim|is_natural|min_length[12]|max_length[12]',
            [
                'required' => 'Nomor Ponsel tidak boleh kosong',
                'is_natural' => 'Nomor ponsel diisi dengan angka 0123456789',
            ]
        );
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Profil';
            $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
            $data['user'] = $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

            $this->load->view('user/profil/headerprofil', $data);
            $this->load->view('user/profil/update_profil', $data);
            $this->load->view('user/profil/footerprofil', $data);
        } else {

            $dataprofil = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama', true)),
                'nomor_ponsel' => $this->input->post('nohp'),
                'email' => $this->input->post('email'),
                'img' => $this->input->post('img')
            ];

            // cek jika ada gambar yang akan di upload 
            $upload_image = $_FILES['img']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '8192';
                $config['upload_path'] = './assets/img/profil/';

                $this->load->library('upload', '$config');

                if ($this->upload->do_upload('img')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('img', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama_lengkap', $dataprofil['nama_lengkap']);
            $this->db->set('email', $dataprofil['email']);
            $this->db->where('nomor_ponsel', $dataprofil['nomor_ponsel']);
            $this->db->update('profil');

            $this->session->set_flashdata('pesan', '<div class="alert alert-info" role="alert">
            Akun berhasil diperbaharui</div>');
            redirect('user/update_profil');
            // 'email' => htmlspecialchars($this->input->post('email', true)),
            // 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            // 'img' => 'default.jpg',
            // 'jenis_ovo' => 2,
            // 'is_active' => 1,
            // 'date_created' => time()

        }
    }

    public function topup()
    {
        $this->form_validation->set_rules(
            'nominal_top_up',
            'Nominal Top Up',
            'required|trim|less_than_equal_to[10000000]|Greater_than_equal_to[10000]',
            [
                'less_than_equal_to' => 'Maksimal Top Up OVO Cash Rp.10.000.000',
                'Greater_than_equal_to' => 'Minimal Top Up OVO Cash adalah Rp.10000'
            ]
        );
        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'topup',
            );
            $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
            $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
            $data['user'] =
                $this->db->get_where('profil', ['nomor_ponsel' =>
                $this->session->userdata('nohp')])->row_array();
            $this->load->view('user/profil/headerprofil', $data);
            $this->load->view('user/profil/topup', $data, FALSE);
            $this->load->view('user/profil/footerprofil', $data);
        } else {
            $data_topup = [
                'nominal_top_up' => $this->input->post('nominal_top_up'),
                'id_pengguna' => $this->input->post("id_pengguna")
            ];
            $this->db->insert('top_up', $data_topup);

            $this->db->set("jumlah_saldo", "jumlah_saldo + $data_topup[nominal_top_up]", FALSE);
            $this->db->where("id_pengguna", $data_topup["id_pengguna"]);
            $this->db->update("saldo");
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
            TOP Up OVO kamu berhasil </div>');
            redirect('user');
        }
    }

    public function transfer()
    {
        $data = array(
            'title' => 'Transfer',
        );
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        if ($this->session->userdata('jenis_ovo') === '1') {
            $this->load->view('user/profil/headerprofil', $data);
            $this->load->view('user/transfer/transfer', $data, FALSE);
            $this->load->view('user/profil/footerprofil', $data);
        } else {

            redirect('tanya_user');
        }
    }
    public function sesama_ovo()
    {

        if ($this->session->userdata('jenis_ovo') === '1') {
            $this->form_validation->set_rules('nomor_ponsel_penerima', 'Nomor Hp', 'required|trim|is_natural|min_length[12]|max_length[12]');

            $this->form_validation->set_rules(
                'nominal',
                'Nominal Transfer',
                'required|trim|less_than_equal_to[10000000]|Greater_than_equal_to[10000]',
                [
                    'less_than_equal_to' => 'Maksimal Transfer Rp.10.000.000',
                    'Greater_than_equal_to' => 'Minimal Transfer adalah Rp.10000'
                ]
            );

            if ($this->form_validation->run() == false) {
                // kalau user tidak memnginput apapun
                $data = array(
                    'title' => 'TF ke sesama OVO',
                );
                $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
                $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
                $data['user'] =
                    $this->db->get_where('profil', ['nomor_ponsel' =>
                    $this->session->userdata('nohp')])->row_array();

                $this->load->view('user/profil/headerprofil', $data);
                $this->load->view('user/transfer/sesama_ovo', $data, FALSE);
                $this->load->view('user/profil/footerprofil', $data);
            } else {
                // kalau user sudah menginput semua form
                $data_transfer = [
                    'nominal' => $this->input->post('nominal'),
                    'nomor_ponsel_penerima' => $this->input->post('nomor_ponsel_penerima'),
                    'id_pengguna' => $this->input->post('id_pengguna')
                ];

                $data_hasil['saldo_kurang'] =
                    $this->db->select("IF(saldo.jumlah_saldo < $data_transfer[nominal], 1, 0) as saldo_kurang, saldo.jumlah_saldo", FALSE)
                    ->from('saldo')
                    ->join('transfer', 'transfer.id_pengguna=profil.id_pengguna')
                    ->get_where('profil', ['nomor_ponsel' => $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();
                // print_r($data_hasil["saldo_kurang"]["saldo_kurang"]);
                // exit;
                if ($data_hasil["saldo_kurang"]["saldo_kurang"]) {
                    // Kalau saldo kurang
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Transfer gagal, saldo kamu tidak cukup. Silahkan top up lebih dulu. </div>');
                    redirect('user');
                } else {
                    // kalau saldo mencukupi
                    $this->db->insert('transfer', $data_transfer);

                    $data['user'] =
                        $this->db->set("jumlah_saldo", "jumlah_saldo - $data_transfer[nominal]", FALSE);
                    $this->db->get_where('profil', ['id_pengguna' =>
                    $this->session->userdata('id_pengguna')])->row_array();
                    $this->db->update("saldo");


                    $this->db->set("jumlah_saldo", "jumlah_saldo + $data_transfer[nominal]", FALSE);
                    $this->db->where("id_pengguna");
                    $this->db->update("saldo");


                    $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
                        Transfer berhasil </div>');

                    redirect('user/sesama_ovo');
                }
            }
        } else {

            redirect('user');
        }
    }

    public function rek_bank()
    {
        if ($this->session->userdata('jenis_ovo') === '1') {
            $this->form_validation->set_rules('nomor_ponsel_penerima', 'Nomor Hp', 'required|trim|is_natural|min_length[12]|max_length[12]');

            $this->form_validation->set_rules(
                'nominal',
                'Nominal Transfer',
                'required|trim|less_than_equal_to[10000000]|Greater_than_equal_to[10000]',
                [
                    'less_than_equal_to' => 'Maksimal Transfer Rp.10.000.000',
                    'Greater_than_equal_to' => 'Minimal Transfer adalah Rp.10000'
                ]
            );

            if ($this->form_validation->run() == false) {
                $data = array(
                    'title' => 'TF ke rekening Bank',
                );
                $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
                $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
                $data['user'] =
                    $this->db->get_where('profil', ['nomor_ponsel' =>
                    $this->session->userdata('nohp')])->row_array();

                $this->load->view('user/profil/headerprofil', $data);
                $this->load->view('user/transfer/rek_bank', $data, FALSE);
                $this->load->view('user/profil/footerprofil', $data);
            } else {
                $data_transfer = [
                    'nominal' => $this->input->post('nominal'),
                    'waktu' => date('Y-m-d H:i:s'),
                    'nomor_ponsel_penerima' => $this->input->post('nomor_ponsel_penerima'),
                    'id_pengguna' => $this->input->post('id_pengguna')
                ];
                $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
                $this->db->get_where('profil', ['nomor_ponsel' =>
                $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();

                $this->db->insert('transfer', $data_transfer);

                $data['user'] =
                    $this->db->set("jumlah_saldo", "jumlah_saldo - $data_transfer[nominal]", FALSE);
                $this->db->get_where('profil', ['id_pengguna' =>
                $this->session->userdata('id_pengguna')])->row_array();
                $this->db->update("saldo");


                $this->db->set("jumlah_saldo", "jumlah_saldo + $data_transfer[nominal]", FALSE);
                $this->db->where("id_pengguna");
                $this->db->update("saldo");


                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
                Transfer berhasil </div>');

                redirect('user/sesama_ovo');
            }
        } else {

            redirect('user');
        }
    }

    public function upgrade_ovo()
    {
        $this->form_validation->set_rules('NIK', 'Nomor Induk Keluarga', 'required|is_unique[profil_premium.NIK]', array('required' => '%s Harus Diisi!', 'is_unique' => '%s Sudah pernah terdaftar'));
        if ($this->form_validation->run() == false) {
            $data = array(
                'title' => 'Upgrade OVO',
            );
            $data['user'] =
                $this->db->get_where('profil', ['nomor_ponsel' =>
                $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();
            $this->load->view('user/profil/headerprofil', $data);
            $this->load->view('user/profil/upgrade_ovo', $data, FALSE);
            $this->load->view('user/profil/footerprofil', $data);
        } else {
            $data = array(
                'NIK' => $this->input->post('NIK'),
                'id_pengguna' => $this->input->post('id_pengguna'),

                // 'foto_ktp' =>  $upload_data['uploads']['file_name']
            );

            $this->db->insert('profil_premium', $data);

            $data = array(
                'jenis_ovo' => 1
            );

            $this->db->set('jenis_ovo', $data['jenis_ovo']);
            $this->db->where('id_pengguna', $data['id_pengguna']);
            $this->db->update('profil');

            $this->session->set_flashdata('pesan', 'Berhasil upgrade ke OVO Premier.');
            redirect('user');
        }
    }
}
