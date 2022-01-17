<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/laundry/data/';
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
}

/* End of file Dashboard.php */
