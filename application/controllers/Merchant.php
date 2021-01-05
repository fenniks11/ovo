<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Merchant extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sudah_login();
        $this->load->model('nota_m');
    }

    public function pln()
    {
        // select * from profil join saldo on saldo.id_pengguna = profil.id_pengguna
        // join jenis_user on jenis_user.jenis_ovo = profil.jenis_ovo where nomor_ponsel = 083192164289
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        // query untuk mengambil data pengguna yang dimasukkan ke tabel nota.
        // select * from nota join profil on profil.id_pengguna
        $this->db->join('profil', 'nota.id_pengguna = profil.id_pengguna', 'left');
        $data['total_tagihan'] =
            $this->db->get('nota')->row_array();

        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required|trim',
            [
                'required' => 'Nominal harus dipilih'
            ]
        );
        $this->form_validation->set_rules(
            'nomor_meter',
            'Nomor Meter',
            'required|trim',
            [
                'required' => 'Nomor Meter harus diisi lebih dulu'
            ]
        );
        if ($this->form_validation->run() == false) {
            $data['title'] = 'PLN';
            $data['nomor_referensi'] = $this->nota_m->invoice_no();
            $this->load->view('user/merchant/headerMerchant', $data, FALSE);
            $this->load->view('user/merchant/pln', $data, FALSE);
            $this->load->view('user/merchant/footerMerchant', $data, FALSE);
        } else {
            $data_listrik = [
                'no_referensi' => $this->input->post('no_referensi'),
                'id_merchant' => 1,
                'nominal' => $this->input->post('nominal'),
                'id_pengguna' => $this->input->post("id_pengguna"),
                'biaya' => 2000,
                'status_transaksi' => 'berhasil',
            ];

            // Cek saldo apakah mencukupi atau tidak
            // select if saldo.jumlah_saldo < max_pot_harga.cashback ,"yes", "no" as saldo_kurang saldo.jumlah_saldo 
            // from saldo join nota on nota.id_pengguna = profil.id_pengguna 
            // where profil.nomor_ponsel = nomor ponsel yang sedang login
            $data_hasil['saldo_kurang'] =
                $this->db->select("IF(saldo.jumlah_saldo < $data_listrik[nominal], 1, 0) as saldo_kurang, saldo.jumlah_saldo", FALSE)
                ->from('saldo')
                ->join('nota', 'nota.id_pengguna=profil.id_pengguna')
                ->get_where('profil', ['nomor_ponsel' => $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();

            if ($data_hasil["saldo_kurang"]["saldo_kurang"]) {
                // Kalau saldo kurang
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Transfer gagal, saldo kamu tidak cukup. Silahkan top up lebih dulu. </div>');
                redirect('user');
            } else {
                // Kalau saldo mencukupi, maka,
                $data_transaksi = [
                    'id_pengguna' => $this->input->post("id_pengguna"),
                    'nama_transaksi' => 'Pembayaran listrik PLN'
                ];
                //Insert ke table jenis_transaksi 
                // insert into jenis_transaksi values ('', '2', 'Pembayaran listrik PLN');
                $this->db->insert('jenis_transaksi', $data_transaksi);
                $id_jenis_transaksi = $this->db->insert_id();

                // insert ke table nota
                // insert into nota values('', '1', '20000','20', '2000', 'berhasil' );
                $this->db->insert('nota', $data_listrik);

                // query untuk mengambil kolom biaya, nominal, kedua kolom ini dijumlahkan sebagai total
                // tujuannya untuk dimasukkan ke field "total" di table total_tagihan.

                // select biaya, nominal, (biaya + nominal) as total 
                // join total_tagihan on nota.no_referensi = total_tagihan.no_referensi
                // where nota.no_referensi = total_tagihan.no_referensi;
                $this->db->select('biaya, nominal, (biaya + nominal) as total ', FALSE);
                $this->db->join('total_tagihan', 'nota.no_referensi = total_tagihan.no_referensi', 'left');
                $data =
                    $this->db->get_where('nota', ['nota.no_referensi' => $data_listrik['no_referensi']])->row_array();

                $data_total = [
                    'id_pengguna' => $this->input->post('id_pengguna'),
                    'no_referensi' => $this->input->post('no_referensi'),
                    'total' => $data['total']
                ];
                $this->db->insert('total_tagihan', $data_total);

                $data_history = [
                    'id_pengguna' => $this->input->post('id_pengguna'),
                    'nominal' => $data['total'],
                    'waktu_transaksi' => $this->input->post('waktu_transaksi'),
                    'no_referensi' => $this->input->post('no_referensi'),
                    'id_jenis_transaksi' => $id_jenis_transaksi
                ];
                $this->db->insert('history', $data_history);
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
                        Transaksi Berhasil </div>');

                redirect('merchant/pln');
            }
        }
    }

    public function pulsa()
    {
        // select * from profil join saldo on saldo.id_pengguna = profil.id_pengguna
        // join jenis_user on jenis_user.jenis_ovo = profil.jenis_ovo where nomor_ponsel = 083192164289
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        // query untuk mengambil data pengguna yang dimasukkan ke tabel nota.
        // query untuk mengambil data pengguna yang dimasukkan ke tabel nota.
        // select * from nota join profil on profil.id_pengguna
        $this->db->join('profil', 'nota.id_pengguna = profil.id_pengguna', 'left');
        $data['total_tagihan'] =
            $this->db->get('nota')->row_array();

        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required|trim',
            [
                'required' => 'Nominal harus dipilih'
            ]
        );

        if ($this->form_validation->run() == false) {
            $data['title'] = 'PULSA';
            $data['nomor_referensi'] = $this->nota_m->invoice_no();
            $this->load->view('user/merchant/headerMerchant', $data, FALSE);
            $this->load->view('user/merchant/pulsa', $data, FALSE);
            $this->load->view('user/merchant/footerMerchant', $data, FALSE);
        } else {

            $data_pulsa = [
                'no_referensi' => $this->input->post('no_referensi'),
                'id_merchant' => 2,
                'nominal' => $this->input->post('nominal'),
                'id_pengguna' => $this->input->post("id_pengguna"),
                'biaya' => 2000,
                'status_transaksi' => 'berhasil',
            ];

            // Cek saldo apakah mencukupi atau tidak
            // select if saldo.jumlah_saldo < max_pot_harga.cashback, "yes", "no" as saldo_kurang saldo.jumlah_saldo 
            // from saldo join nota on nota.id_pengguna = profil.id_pengguna 
            // where profil.nomor_ponsel = nomor ponsel yang sedang
            $data_hasil['saldo_kurang'] =
                $this->db->select("IF(saldo.jumlah_saldo < $data_pulsa[nominal], 1, 0) as saldo_kurang, saldo.jumlah_saldo", FALSE)
                ->from('saldo')
                ->join('nota', 'nota.id_pengguna=profil.id_pengguna')
                ->get_where('profil', ['nomor_ponsel' => $this->session->userdata('nohp')], ['id_pengguna' => $this->session->userdata('id_pengguna')])->row_array();

            if ($data_hasil["saldo_kurang"]["saldo_kurang"]) {
                // Kalau saldo kurang
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Transfer gagal, saldo kamu tidak cukup. Silahkan top up lebih dulu. </div>');
                redirect('user');
            } else {
                // Kalau saldo mencukupi, maka,
                $data_transaksi = [
                    'id_pengguna' => $this->input->post("id_pengguna"),
                    'nama_transaksi' => 'Pembayaran Pulsa'
                ];
                //Insert ke table jenis_transaksi 

                $this->db->insert('jenis_transaksi', $data_transaksi);
                $id_jenis_transaksi = $this->db->insert_id();

                // insert ke table nota
                $this->db->insert('nota', $data_pulsa);

                // query untuk mengambil kolom biaya, nominal, kedua kolom ini dijumlahkan sebagai total
                // tujuannya untuk dimasukkan ke field "total" di table total_tagihan.

                // select biaya, nominal, (biaya + nominal) as total 
                // join total_tagihan on nota.no_referensi = total_tagihan.no_referensi
                // where nota.no_referensi = total_tagihan.no_referensi;
                $this->db->select('biaya, nominal, (biaya + nominal) as total ', FALSE);
                $this->db->join('total_tagihan', 'nota.no_referensi = total_tagihan.no_referensi', 'left');
                $data =
                    $this->db->get_where('nota', ['nota.no_referensi' => $data_pulsa['no_referensi']])->row_array();

                $data_total = [
                    'id_pengguna' => $this->input->post('id_pengguna'),
                    'no_referensi' => $this->input->post('no_referensi'),
                    'total' => $data['total']
                ];
                $this->db->insert('total_tagihan', $data_total);

                $data_history = [
                    'id_pengguna' => $this->input->post('id_pengguna'),
                    'nominal' => $data['total'],
                    'waktu_transaksi' => $this->input->post('waktu_transaksi'),
                    'no_referensi' => $this->input->post('no_referensi'),
                    'id_jenis_transaksi' => $id_jenis_transaksi
                ];
                $this->db->insert('history', $data_history);
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">
                        Transaksi Berhasil </div>');

                redirect('merchant/pln');
            }
        }
    }

    public function voucher_game()
    {
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        // query untuk mengambil data pengguna yang dimasukkan ke tabel nota.
        $this->db->join('profil', 'nota.id_pengguna = profil.id_pengguna', 'left');
        $data['total_tagihan'] =
            $this->db->get('nota')->row_array();

        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required|trim',
            [
                'required' => 'Nominal harus dipilih'
            ]
        );

        $data['title'] = 'Voucher Game';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/voucher_game', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function airPDAM()
    {
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        // query untuk mengambil data pengguna yang dimasukkan ke tabel nota.
        $this->db->join('profil', 'nota.id_pengguna = profil.id_pengguna', 'left');
        $data['total_tagihan'] =
            $this->db->get('nota')->row_array();

        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required|trim',
            [
                'required' => 'Nominal harus diisi'
            ]
        );

        if ($this->form_validation->run() == false) {
            $data['nomor_referensi'] = $this->nota_m->invoice_no();
            $data['title'] = 'Air PDAM';
            $this->load->view('user/merchant/headerMerchant', $data, FALSE);
            $this->load->view('user/merchant/airPDAM', $data, FALSE);
            $this->load->view('user/merchant/footerMerchant', $data, FALSE);
        } else {
        }
    }

    public function bpjs()
    {
        // Query mengambil isi data user dari table profil,
        // dijoinkan dengan table saldo untuk mengambil informasi saldo dari tabel saldo.
        // dijoinkan dengan table jenis_user untuk mengecek jenis user pengguna ovo.
        // Berdasarkan session userdata yang dimiliki user yaitu nomor_ponsel.
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        // query untuk mengambil nilai dari table jenis transaksi yang di dalamnya 
        // menggunakan id_pengguna dari table profil sebagai foreign key di table jenis_transaksi
        $this->db->join('profil', 'profil.id_pengguna = jenis_transaksi.id_pengguna', 'left');
        $data['jenis_transaksi'] =
            $this->db->get('jenis_transaksi')->result_array();

        // query untuk mengambil data pengguna yang dimasukkan ke tabel nota.
        $this->db->join('profil', 'nota.id_pengguna = profil.id_pengguna', 'left');
        $data['total_tagihan'] =
            $this->db->get('nota')->row_array();

        // query untuk mengambil kolom biaya, nominal, kedua kolom ini dijumlahkan sebagai total
        // tujuannya untuk dimasukkan ke field "total" di table total_tagihan.
        $this->db->select('biaya, nominal, (biaya + nominal) as total ', FALSE);
        $this->db->join('nota', 'nota.no_referensi = total_tagihan.no_referensi', 'left');
        $data['total_bayar'] =
            $this->db->get('total_tagihan')->result_array();

        $data['title'] = 'BJPS';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/bpjs', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function itk()
    {
        // Query mengambil isi data user dari table profil,
        // dijoinkan dengan table saldo untuk mengambil informasi saldo dari tabel saldo.
        // dijoinkan dengan table jenis_user untuk mengecek jenis user pengguna ovo.
        // Berdasarkan session userdata yang dimiliki user yaitu nomor_ponsel.
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        // query untuk mengambil nilai dari table jenis transaksi yang di dalamnya 
        // menggunakan id_pengguna dari table profil sebagai foreign key di table jenis_transaksi
        $this->db->join('profil', 'profil.id_pengguna = jenis_transaksi.id_pengguna', 'left');
        $data['jenis_transaksi'] =
            $this->db->get('jenis_transaksi')->result_array();

        // query untuk mengambil data pengguna yang dimasukkan ke tabel nota.
        $this->db->join('profil', 'nota.id_pengguna = profil.id_pengguna', 'left');
        $data['total_tagihan'] =
            $this->db->get('nota')->row_array();

        // query untuk mengambil kolom biaya, nominal, kedua kolom ini dijumlahkan sebagai total
        // tujuannya untuk dimasukkan ke field "total" di table total_tagihan.
        $this->db->select('biaya, nominal, (biaya + nominal) as total ', FALSE);
        $this->db->join('nota', 'nota.no_referensi = total_tagihan.no_referensi', 'left');
        $data['total_bayar'] =
            $this->db->get('total_tagihan')->result_array();

        $data['title'] = 'Internet & TV Kabel';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/itk', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function proteksi()
    {
        // Query mengambil isi data user dari table profil,
        // dijoinkan dengan table saldo untuk mengambil informasi saldo dari tabel saldo.
        // dijoinkan dengan table jenis_user untuk mengecek jenis user pengguna ovo.
        // Berdasarkan session userdata yang dimiliki user yaitu nomor_ponsel.
        $this->db->join('saldo', 'saldo.id_pengguna = profil.id_pengguna', 'left');
        $this->db->join('jenis_user', 'jenis_user.jenis_ovo = profil.jenis_ovo');
        $data['user'] =
            $this->db->get_where('profil', ['nomor_ponsel' =>
            $this->session->userdata('nohp')])->row_array();

        // query untuk mengambil nilai dari table jenis transaksi yang di dalamnya 
        // menggunakan id_pengguna dari table profil sebagai foreign key di table jenis_transaksi
        $this->db->join('profil', 'profil.id_pengguna = jenis_transaksi.id_pengguna', 'left');
        $data['jenis_transaksi'] =
            $this->db->get('jenis_transaksi')->result_array();

        // query untuk mengambil data pengguna yang dimasukkan ke tabel nota.
        $this->db->join('profil', 'nota.id_pengguna = profil.id_pengguna', 'left');
        $data['total_tagihan'] =
            $this->db->get('nota')->row_array();

        // query untuk mengambil kolom biaya, nominal, kedua kolom ini dijumlahkan sebagai total
        // tujuannya untuk dimasukkan ke field "total" di table total_tagihan.
        $this->db->select('biaya, nominal, (biaya + nominal) as total ', FALSE);
        $this->db->join('nota', 'nota.no_referensi = total_tagihan.no_referensi', 'left');
        $data['total_bayar'] =
            $this->db->get('total_tagihan')->result_array();

        $data['title'] = 'Proteksi';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/proteksi', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }

    public function lainnya()
    {
        $data['title'] = 'Merchant';
        $this->load->view('user/merchant/headerMerchant', $data, FALSE);
        $this->load->view('user/merchant/lainnya', $data, FALSE);
        $this->load->view('user/merchant/footerMerchant', $data, FALSE);
    }
}
