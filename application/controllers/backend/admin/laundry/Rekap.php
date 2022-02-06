<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/laundry/rekap/';
        $this->load->model($this->path . 'Cetak', 'm_cetak');
    }

    public function index()
    {
        $data = [
            'title' => 'Rekap Data Laundry',
            'li_active' => 'rekap_laundry',
            'li_open' => 'laundry',
            'uri_segment' => $this->path,
            'content' => $this->path . 'index',
            'script' => $this->path . 'index_js',
            'breadcrumb' => [
                'Laundry',
                'Rekap',
                'Index',
            ],
        ];

        $data['ref_bulan'] = ref_bulan();
        $data['ref_tahun'] = ref_tahun();

        $this->templates->load($data);
    }

    public function grafik_total_laundry()
    {

        $waktu = "(select waktu from laundry_has_status where is_active = '1' and id_data_laundry = a.id order by id asc limit 1 )";
        $this->db->select("count(a.id) as total, $waktu first_waktu");
        $this->db->where('a.is_active', '1');
        $this->db->group_by($waktu);
        $this->db->order_by($waktu, 'asc');
        $data = $this->db->get('data_laundry a')->result();

        $categories = [];
        $total = [];

        foreach ($data as $key) {
            $categories[] = $key->first_waktu;
            $total[] = (int)$key->total;
        }

        echo json_encode([
            'status' => 'success',
            'data' => [
                'categories' => $categories,
                'series' => [
                    [
                        'name' => 'Transaksi',
                        'data' => $total,
                    ],
                ],
            ],
        ]);
    }

    public function grafik_omset_laundry()
    {

        $waktu = "(select waktu from laundry_has_status where is_active = '1' and id_data_laundry = a.id order by id asc limit 1 )";
        $this->db->select("sum(a.biaya) as total, $waktu first_waktu");
        $this->db->where('a.is_active', '1');
        $this->db->group_by($waktu);
        $this->db->order_by($waktu, 'asc');
        $data = $this->db->get('data_laundry a')->result();

        $categories = [];
        $total = [];

        foreach ($data as $key) {
            $categories[] = $key->first_waktu;
            $total[] = (int)$key->total;
        }

        echo json_encode([
            'status' => 'success',
            'data' => [
                'categories' => $categories,
                'series' => [
                    [
                        'name' => 'Omset',
                        'data' => $total,
                    ],
                ],
            ],
        ]);
    }

    public function cetak_harian($bulan, $tahun)
    {
        $this->m_cetak->cetak_harian($bulan, $tahun);
    }

    public function cetak_bulanan($tahun)
    {
        $this->m_cetak->cetak_bulanan($tahun);
    }

    public function cetak_tahunan()
    {
        $this->m_cetak->cetak_tahunan();
    }
}

/* End of file Dashboard.php */
