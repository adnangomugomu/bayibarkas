<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/laundry/data/';
        $this->table = 'data_laundry';
        $this->load->model($this->path . 'datatable', 'm_main');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Laundry',
            'li_active' => 'data_laundry',
            'li_open' => 'laundry',
            'uri_segment' => $this->path,
            'content' => $this->path . 'index',
            'script' => $this->path . 'index_js',
            'breadcrumb' => [
                'Laundry',
                'Data',
                'Index',
            ],
        ];

        $data['ref_status_laundry'] = ref_status_laundry();

        $this->templates->load($data);
    }

    function get_data()
    {
        echo $this->m_main->generate_table();
    }

    public function store()
    {
        cek_post();

        $id_data = $this->input->post('id_data', true);
        $status_data = $this->input->post('status_data', true);
        $waktu = $this->input->post('waktu', true);

        $this->db->insert('laundry_has_status', [
            'id_data_laundry' => $id_data,
            'id_status' => $status_data,
            'waktu' => date('Y-m-d', strtotime($waktu)),
            'is_active' => '1',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        echo json_encode([
            'status' => 'success',
            'msg' => 'Data berhasil disimpan'
        ]);
    }

    public function get_detail()
    {
        cek_post();

        $id_data = $this->input->post('id_data', true);

        $status_laundry = "(select e.status from laundry_has_status d left join ref_status_laundry e on e.id = d.id_status where d.id_data_laundry = a.id and d.is_active = '1' order by d.id desc limit 1) as status_laundry";
        $this->db->select("a.*, b.jenis as estimasi, c.jenis as metode, $status_laundry");
        $this->db->where('a.is_active', '1');
        $this->db->where('a.id', $id_data);
        $this->db->join('ref_estimasi_penanganan_laundry b', 'b.id = a.id_estimasi', 'left');
        $this->db->join('ref_metode_pembayaran c', 'c.id = a.id_metode_pembayaran', 'left');
        $data = $this->db->get($this->table . ' a')->row();

        $this->db->select('b.jenis');
        $this->db->where('a.id_data_laundry', $data->id);
        $this->db->where('a.is_active', '1');
        $this->db->join('ref_jenis_laundry b', 'b.id = a.id_jenis', 'left');
        $jenis = $this->db->get('laundry_has_jenis a')->result();

        $get_jenis = '';
        foreach ($jenis as $key) {
            $get_jenis .= '
                <span class="d-block">- ' . $key->jenis . '</span>
            ';
        }

        $data->get_jenis = $get_jenis;

        $this->db->select('a.*, b.status');
        $this->db->where('a.id_data_laundry', $id_data);
        $this->db->where('a.is_active', '1');
        $this->db->order_by('a.id', 'asc');
        $this->db->join('ref_status_laundry b', 'b.id = a.id_status', 'left');
        $status = $this->db->get('laundry_has_status a')->result();

        foreach ($status as $key) {
            $key->waktu = date('d-M-Y', strtotime($key->waktu));
        }

        echo json_encode([
            'status' => 'success',
            'msg' => 'Data berhasil ditemukan',
            'data' => $data,
            'status_laundry' => $status,
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

    public function delete_status_laundry()
    {
        cek_post();

        $id = $this->input->post('id', true);
        $this->db->where('id', $id);
        $this->db->update('laundry_has_status', [
            'deleted_at' => date('Y-m-d H:i:s'),
            'is_active' => '0',
        ]);

        echo json_encode([
            'status' => 'success',
            'msg' => 'Data berhasil dihapus'
        ]);
    }

    public function get_status()
    {
        cek_post();

        $id_data = $this->input->post('id_data', true);

        $this->db->select('a.*, b.status');
        $this->db->where('a.id_data_laundry', $id_data);
        $this->db->where('a.is_active', '1');
        $this->db->order_by('a.id', 'asc');
        $this->db->join('ref_status_laundry b', 'b.id = a.id_status', 'left');
        $data = $this->db->get('laundry_has_status a')->result();

        foreach ($data as $key) {
            $key->waktu = date('d-M-Y', strtotime($key->waktu));
        }

        echo json_encode([
            'status' => 'success',
            'msg' => 'Data berhasil ditemukan',
            'data' => $data,
        ]);
    }
}

/* End of file Dashboard.php */
