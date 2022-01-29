<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/laundry/data/';
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

        $this->templates->load($data);
    }

    function get_data()
    {
        echo $this->m_main->generate_table();
    }
}

/* End of file Dashboard.php */
