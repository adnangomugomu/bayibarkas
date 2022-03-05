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

        $data['ref_metode_pembayaran'] = ref_metode_pembayaran();
        $data['kode_laundry'] = $this->get_kode_laundry();

        $this->templates->load($data);
    }

    public function store()
    {
        cek_post();
        $data_barang = json_decode($this->input->post('data_barang'));

        $token = generateRandomString();
        $kode_laundry = $this->get_kode_laundry();
        $metode_pembayaran = $this->input->post('metode_pembayaran', true);
        $total_harga = $this->input->post('total_harga', true);
        $nama = $this->input->post('nama', true);
        $no_hp = $this->input->post('no_hp', true);
        $alamat = $this->input->post('alamat', true);

        $this->db->insert('data_laundry', [
            'id_status' => 1, //? diterima
            'kode' => $kode_laundry,
            'token' => $token,
            'total' => remove_titik($total_harga),
            'id_metode_pembayaran' => $metode_pembayaran,
            'nama_pemilik' => $nama,
            'alamat' => $alamat,
            'no_hp' => $no_hp,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_status' => date('Y-m-d H:i:s'),
        ]);

        $id_data = $this->db->insert_id();

        if (is_array($data_barang)) {
            foreach ($data_barang as $key => $value) {
                $this->db->insert('data_laundry_has_barang', [
                    'id_data_laundry' => $id_data,
                    'id_jenis_barang' => $value->jenis_barang,
                    'id_estimasi' => $value->estimasi_penanganan,
                    'biaya_servis' => remove_titik($value->biaya_servis),
                    'sub_total' => remove_titik($value->sub_total),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $id_data_barang = $this->db->insert_id();

                if (is_array($value->jenis_laundry)) {
                    foreach ($value->jenis_laundry as $key => $v) {
                        $this->db->insert('data_laundry_has_barang_has_jenis', [
                            'id_data_laundry_has_barang' => $id_data_barang,
                            'id_jenis_laundry' => $v,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);
                    }

                    foreach ($value->kelengkapan as $key => $v) {
                        $this->db->insert('data_laundry_has_barang_has_kelengkapan', [
                            'id_data_laundry_has_barang' => $id_data_barang,
                            'id_kelengkapan' => $v,
                            'created_at' => date('Y-m-d H:i:s'),
                        ]);
                    }
                }
            }
        }

        $this->db->insert('laundry_has_status', [
            'id_data_laundry' => $id_data,
            'id_status' => 1, //? diterima
            'waktu' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        json([
            'status' => 'success',
            'msg' => 'data berhasil disimpan',
        ]);
    }

    public function jenis_barang()
    {
        echo json_encode([
            'status' => 'success',
            'data' => ref_jenis_barang(),
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
