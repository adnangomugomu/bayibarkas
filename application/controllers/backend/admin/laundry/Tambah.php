<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tambah extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/laundry/tambah/';
    }

    public function index()
    {
        $data = [
            'title' => 'Tambah Data Laundry',
            'li_active' => 'tambah_laundry',
            'li_open' => 'laundry',
            'uri_segment' => $this->path,
            'content' => $this->path . 'index',
            'script' => $this->path . 'index_js',
            'breadcrumb' => [
                'Laundry',
                'Tambah',
                'Index',
            ],
        ];

        $data['ref_jenis_barang'] = ref_jenis_barang();
        $data['ref_status_laundry'] = ref_status_laundry();
        $data['ref_jenis_laundry'] = ref_jenis_laundry();
        $data['ref_estimasi_penanganan_laundry'] = ref_estimasi_penanganan_laundry();
        $data['ref_metode_pembayaran'] = ref_metode_pembayaran();
        $data['kode_laundry'] = $this->get_kode_laundry();

        $this->templates->load($data);
    }

    public function store()
    {
        cek_post();

        $token = generateRandomString();
        $kode_laundry = $this->get_kode_laundry();
        $jenis_laundry = $this->input->post('jenis_laundry', true);
        $estimasi_penanganan = $this->input->post('estimasi_penanganan', true);
        $metode_pembayaran = $this->input->post('metode_pembayaran', true);
        $biaya = $this->input->post('biaya', true);
        $waktu = $this->input->post('waktu', true);
        $nama = $this->input->post('nama', true);
        $merk = $this->input->post('merk', true);
        $no_hp = $this->input->post('no_hp', true);
        $alamat = $this->input->post('alamat', true);
        $keterangan = $this->input->post('keterangan', true);

        $this->db->insert('data_laundry', [
            'kode' => $kode_laundry,
            'id_estimasi' => $estimasi_penanganan,
            'id_metode_pembayaran' => $metode_pembayaran,
            'token' => $token,
            'nama_pemilik' => $nama,
            'nama_barang' => $merk,
            'alamat' => $alamat,
            'no_hp' => $no_hp,
            'biaya' => str_replace('.', '', $biaya),
            'keterangan' => $keterangan,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $id_data = $this->db->insert_id();

        if (is_array($jenis_laundry)) {
            foreach ($jenis_laundry as $key => $value) {
                $this->db->insert('laundry_has_jenis', [
                    'id_data_laundry' => $id_data,
                    'id_jenis' => $value,
                ]);
            }
        }

        $this->db->insert('laundry_has_status', [
            'id_data_laundry' => $id_data,
            'id_status' => 1, //? diterima
            'waktu' => date('Y-m-d', strtotime($waktu)),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        json([
            'status' => 'success',
            'msg' => 'data berhasil disimpan',
        ]);
    }

    public function get_kelengkapan_data()
    {
        cek_post();
        $id = $this->input->post('id');

        $this->db->where('id_ref_jenis_barang', $id);
        $this->db->where('is_active', '1');
        $kelengkapan = $this->db->get('ref_kelengkapan')->result();

        $this->db->select('a.id, a.biaya, b.jenis');
        $this->db->where('a.id_jenis_barang', $id);
        $this->db->where('a.is_active', '1');
        $this->db->join('ref_jenis_laundry b', 'b.id = a.id_jenis_laundry', 'left');
        $jenisLaundry = $this->db->get('jenis_barang_has_jenis_laundry a')->result();

        $this->db->select('a.id, a.biaya, b.jenis');
        $this->db->where('a.id_jenis_barang', $id);
        $this->db->where('a.is_active', '1');
        $this->db->join('ref_estimasi_penanganan_laundry b', 'b.id = a.id_estimasi', 'left');
        $jenisPenanganan = $this->db->get('jenis_barang_has_estimasi_penanganan a')->result();

        json([
            'status' => 'success',
            'data' => [
                'kelengkapan' => $kelengkapan,
                'jenisLaundry' => $jenisLaundry,
                'jenisPenanganan' => $jenisPenanganan,
            ],
        ]);
    }
}

/* End of file Dashboard.php */
