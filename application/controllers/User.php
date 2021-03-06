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

        // select * from profil join saldo on saldo.id_pengguna = profil.id_pengguna
        // join jenis_user on jenis_user.jenis_ovo = profil.jenis_ovo where nomor_ponsel = 083192164289
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

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

        // SELECT * FROM profil JOIN jenis_user on jenis_user.jenis_ovo = profil.jenis_ovo
        // where nomor_ponsel = 083192164289
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

            // SELECT * FROM profil JOIN jenis_user on jenis_user.jenis_ovo = profil.jenis_ovo
            // where nomor_ponsel = 083192164289
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

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('img')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('img', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // UPDATE PROFIL SET nama_lengkap = 'Fenni Kristiani', email = 'fenni@gmail.com', nomor_ponsel = '083192164289';
            $this->db->set('nama_lengkap', $dataprofil['nama_lengkap']);
            $this->db->set('email', $dataprofil['email']);
            $this->db->where('nomor_ponsel', $dataprofil['nomor_ponsel']);
            $this->db->update('profil');

            $this->session->set_flashdata('pesan', '<div class="alert alert-info" role="alert">
            Akun berhasil diperbaharui</div>');
            redirect('user/update_profil');
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

            // SELECT * FROM profil JOIN jenis_user on jenis_user.jenis_ovo = profil.jenis_ovo
            // join saldo on saldo.id_pengguna = profil.id_pengguna
            // where nomor_ponsel = 083192164289
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
            $id_top_up = $this->db->insert_id();


            $notif = [
                'id_pengguna' => $this->input->post('id_pengguna'),
                'id_top_up' => $id_top_up,
                'isi_notifikasi' => 'Top Up'
            ];

            $this->db->insert('notifikasi', $notif);

            //UPDATE saldo SET jumlah_saldo = jumlah_saldo + '10000' WHERE id_pengguna = '1'
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
            // SELECT * FROM profil
            // where nomor_ponsel = 083192164289
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
                    // SELECT * FROM profil
                    // where nomor_ponsel = 083192164289
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
                    'pesan' => $this->input->post('pesan'),
                    'id_pengguna' => $this->input->post('id_pengguna')
                ];

                $data_hasil['saldo_kurang'] =
                    // select if saldo.jumlah_saldo < max_pot_harga.cashback, "YES", "NO" as saldo_kurang saldo.jumlah_saldo 
                    // from saldo join nota on nota.id_pengguna = profil.id_pengguna 
                    // where profil.nomor_ponsel = nomor ponsel yang sedang login
                    $this->db->select("IF(saldo.jumlah_saldo < $data_transfer[nominal], 1, 0) as saldo_kurang, saldo.jumlah_saldo", FALSE)
                    ->from('saldo')
                    ->join('transfer', 'transfer.id_pengguna=profil.id_pengguna')
                    ->get_where('profil', ['nomor_ponsel' => $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();

                if ($data_hasil["saldo_kurang"]["saldo_kurang"]) {
                    // Kalau saldo kurang
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Transfer gagal, saldo kamu tidak cukup. Silahkan top up lebih dulu. </div>');
                    redirect('user');
                } else {
                    // kalau saldo mencukupi
                    $this->db->insert('transfer', $data_transfer);
                    $id_transfer = $this->db->insert_id();

                    $notif = [
                        'isi_pesan' => $this->input->post('pesan'),
                        'id_pengguna' => $this->input->post('id_pengguna'),
                        'id_transfer' => $id_transfer,
                        'isi_notifikasi' => 'Transfer'
                    ];

                    $this->db->insert('notifikasi', $notif);

                    // UPDATE saldo set jumlah_saldo = jumlah_saldo - transfer.nominal 
                    // where profil.id_pengguna = id pengguna yang melakukan transfer
                    $data['user'] =
                        $this->db->set("jumlah_saldo", "jumlah_saldo - $data_transfer[nominal]", FALSE);
                    $this->db->get_where('profil', ['id_pengguna' =>
                    $this->session->userdata('id_pengguna')])->row_array();
                    $this->db->update("saldo");

                    // UPDATE saldo set jumlah_saldo = jumlah_saldo + transfer.nominal 
                    // where profil.id_pengguna = id pengguna yang menerima transfer
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

                // select * from profil join saldo on saldo.id_pengguna = profil.id_pengguna
                // join jenis_user on jenis_user.jenis_ovo = profil. jenis_ovo
                // where nomor_ponsel = 083192164289
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
                // select * from profil join saldo on saldo.id_pengguna = profil.id_pengguna
                // where nomor_ponsel = 083192164289
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
}
