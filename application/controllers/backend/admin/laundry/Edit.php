<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Edit extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/laundry/edit/';
    }

    public function index($id_data = null)
    {

        $this->db->select("a.*, b.jenis as estimasi, c.jenis as metode");
        $this->db->where('a.is_active', '1');
        $this->db->where('sha1(a.id)', $id_data);
        $this->db->join('ref_estimasi_penanganan_laundry b', 'b.id = a.id_estimasi', 'left');
        $this->db->join('ref_metode_pembayaran c', 'c.id = a.id_metode_pembayaran', 'left');
        $data_laundry = $this->db->get('data_laundry a')->row();

        $this->db->where('a.id_data_laundry', $data_laundry->id);
        $this->db->where('a.is_active', '1');
        $jenis = $this->db->get('laundry_has_jenis a')->result();

        $arr_jenis = [];
        foreach ($jenis as $key) {
            $arr_jenis[] = $key->id_jenis;
        }

        if (!$id_data || !$data_laundry) {
            dd([
                'status' => 'failed',
                'msg' => 'data tidak ditemukan',
            ]);
        }

        $data = [
            'title' => 'Edit Data Laundry',
            'li_active' => 'data_laundry',
            'li_open' => 'laundry',
            'uri_segment' => $this->path,
            'content' => $this->path . 'index',
            'script' => $this->path . 'index_js',
            'breadcrumb' => [
                'Laundry',
                'Edit Data',
                'Index',
            ],
        ];

        $data['ref_status_laundry'] = ref_status_laundry();
        $data['ref_jenis_laundry'] = ref_jenis_laundry();
        $data['ref_estimasi_penanganan_laundry'] = ref_estimasi_penanganan_laundry();
        $data['ref_metode_pembayaran'] = ref_metode_pembayaran();
        $data['kode_laundry'] = $this->get_kode_laundry();

        $data['data'] = $data_laundry;
        $data['jenis'] = $arr_jenis;

        $this->templates->load($data);
    }

    public function store()
    {
        cek_post();

        $id_data = $this->input->post('id_data', true);
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

        $this->db->where('id', $id_data);
        $this->db->update('data_laundry', [
            'id_estimasi' => $estimasi_penanganan,
            'id_metode_pembayaran' => $metode_pembayaran,
            'nama_pemilik' => $nama,
            'nama_barang' => $merk,
            'alamat' => $alamat,
            'no_hp' => $no_hp,
            'biaya' => str_replace('.', '', $biaya),
            'keterangan' => $keterangan,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->db->where('id_data_laundry', $id_data);
        $this->db->delete('laundry_has_jenis');

        if (is_array($jenis_laundry)) {
            foreach ($jenis_laundry as $key => $value) {
                $this->db->insert('laundry_has_jenis', [
                    'id_data_laundry' => $id_data,
                    'id_jenis' => $value,
                ]);
            }
        }

        json([
            'status' => 'success',
            'msg' => 'data berhasil disimpan',
        ]);
    }
}

/* End of file Dashboard.php */
