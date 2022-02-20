<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting_estimasi_penanganan extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/laundry/setting_estimasi_penanganan/';
        $this->table = 'setting_estimasi_penanganan';
        $this->load->model($this->path . 'datatable', 'm_main');
    }

    public function index()
    {
        $data = [
            'title' => 'Setting Estimasi Penanganan',
            'li_active' => 'laundry_setting_estimasi_penanganan',
            'li_open' => 'laundry',
            'uri_segment' => $this->path,
            'content' => $this->path . 'index',
            'script' => $this->path . 'index_js',
            'breadcrumb' => [
                'Laundry',
                'Setting',
                'Estimasi Penanganan',
                'Index',
            ],
        ];

        $data['ref_estimasi'] = ref_estimasi_penanganan_laundry();
        $this->templates->load($data);
    }

    function get_data()
    {
        echo $this->m_main->generate_table();
    }

    public function store()
    {
        cek_post();
        $id_barang = $this->input->post('id_barang');
        $id_estimasi = $this->input->post('id_estimasi');
        $val = $this->input->post('val');

        $this->db->where('id_jenis_barang', $id_barang);
        $this->db->where('id_estimasi', $id_estimasi);
        $this->db->where('is_active', '1');
        $get_data = $this->db->get('jenis_barang_has_estimasi_penanganan')->row();

        if (empty($get_data)) {
            $this->db->insert('jenis_barang_has_estimasi_penanganan', [
                'id_jenis_barang' => $id_barang,
                'id_estimasi' => $id_estimasi,
                'biaya' => remove_titik($val),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $this->db->where('id', $get_data->id);
            $this->db->update('jenis_barang_has_estimasi_penanganan', [
                'biaya' => remove_titik($val),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }


        echo json_encode([
            'status' => 'success',
            'msg' => 'Data berhasil disimpan'
        ]);
    }

    public function get()
    {
        cek_post();
        $id = $this->input->post('id', true);
        $data = ref_estimasi_penanganan_laundry();

        foreach ($data as $key) {
            $this->db->where('id_jenis_barang', $id);
            $this->db->where('id_estimasi', $key->id);
            $this->db->where('is_active', '1');
            $harga = @$this->db->get('jenis_barang_has_estimasi_penanganan')->row()->biaya;
            $harga = $harga ? $harga : 0;
            $key->harga = $harga;
        }

        echo json_encode([
            'status' => 'success',
            'msg' => 'Data berhasil ditemukan',
            'data' => $data,
        ]);
    }
}

/* End of file Dashboard.php */
