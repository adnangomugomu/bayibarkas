<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public $path = 'backend/menu/';
    public $table = 'pilih_menu';

    public function __construct()
    {
        parent::__construct();
        cek_login();
        // $this->load->model($this->path . 'datatable', 'm_main');
    }

    public function index($menu = null)
    {
        init_sub_menu($menu);

        $data = [
            'title' => 'Kelola Menu',
            'header' => 'Developer Menu',
            'kode_aktif' => 'menu',
            'kode_aktif_sub' => null,
            'menu' => $menu,
            'uri_segment' => $this->path,
            'page' => $this->path . 'index',
            'script' => $this->path . 'index_js',
            'modal' => [
                $this->path . 'modal/modal_tambah',
                $this->path . 'modal/modal_ubah',
            ],
            'breadcrumb' => [
                'Kelola Menu',
                'index',
            ]
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
        $menu = $this->input->post('menu');
        if (!hak_akses_sub_menu($menu, 'tambah')) {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'Tidak ada hak akses',
            ]);
            die;
        }
        // ================= end init =================

        $this->db->insert($this->table, [
            'data' => $this->input->post('data', true),
            'data' => $this->input->post('data', true),
            'data' => $this->input->post('data', true),
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
        $menu = $this->input->post('menu');
        if (!hak_akses_sub_menu($menu, 'hapus')) {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'Tidak ada hak akses',
            ]);
            die;
        }
        // ================= end init =================

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
        $menu = $this->input->post('menu');
        if (!hak_akses_sub_menu($menu, 'lihat')) {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'Tidak ada hak akses',
            ]);
            die;
        }
        // ================= end init =================

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
        $menu = $this->input->post('menu');
        if (!hak_akses_sub_menu($menu, 'ubah')) {
            echo json_encode([
                'status' => 'failed',
                'msg' => 'Tidak ada hak akses',
            ]);
            die;
        }
        // ================= end init =================

        $this->db->where('id', $this->input->post('id', true));
        $run = $this->db->update($this->table, [
            'data' => $this->input->post('data', true),
            'data' => $this->input->post('data', true),
            'data' => $this->input->post('data', true),
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

/* End of file Home.php */
