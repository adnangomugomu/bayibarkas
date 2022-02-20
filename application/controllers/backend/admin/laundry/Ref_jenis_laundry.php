<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ref_jenis_laundry extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/laundry/ref_jenis_laundry/';
        $this->table = 'ref_jenis_laundry';
        $this->load->model($this->path . 'datatable', 'm_main');
    }

    public function index()
    {
        $data = [
            'title' => 'Referensi Jenis laundry',
            'li_active' => 'laundry_ref_jenis_laundry',
            'li_open' => 'laundry',
            'uri_segment' => $this->path,
            'content' => $this->path . 'index',
            'script' => $this->path . 'index_js',
            'breadcrumb' => [
                'Laundry',
                'Referensi',
                'Jenis laundry',
                'Index',
            ],
        ];

        $this->templates->load($data);
    }

    function get_data()
    {
        echo $this->m_main->generate_table();
    }

    public function store()
    {
        cek_post();
        $this->db->insert($this->table, [
            'jenis' => $this->input->post('jenis', true),
            'urutan' => $this->input->post('urutan', true),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        echo json_encode([
            'status' => 'success',
            'msg' => 'Data berhasil disimpan'
        ]);
    }

    public function delete()
    {
        cek_post();
        $id = $this->input->post('id', true);
        $this->db->where('id', $id);
        $this->db->update($this->table, [
            'deleted_at' => date('Y-m-d H:i:s'),
            'is_active' => '0',
        ]);

        echo json_encode([
            'status' => 'success',
            'msg' => 'Data berhasil dihapus'
        ]);
    }

    public function get()
    {
        cek_post();
        $id = $this->input->post('id', true);
        $this->db->where('id', $id);
        $this->db->where('is_active', '1');
        $run = $this->db->get($this->table)->row();

        if ($run) {
            echo json_encode([
                'status' => 'success',
                'msg' => 'Data berhasil ditemukan',
                'data' => $run,
            ]);
        }
    }

    public function update()
    {
        cek_post();
        $this->db->where('id', $this->input->post('id', true));
        $run = $this->db->update($this->table, [
            'jenis' => $this->input->post('jenis', true),
            'urutan' => $this->input->post('urutan', true),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($run) {
            echo json_encode([
                'status' => 'success',
                'msg' => 'Data berhasil disimpan'
            ]);
        }
    }
}

/* End of file Dashboard.php */
