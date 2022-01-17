<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->path = 'backend/admin/dashboard/';
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'li_active' => 'dashboard',
            'li_open' => '',
            'uri_segment' => $this->path,
            'content' => $this->path . 'index',
            'script' => $this->path . 'index_js',
            'breadcrumb' => [
                'Dashboard',
                'Index',
            ],
        ];
        $this->templates->load($data);
    }
}

/* End of file Dashboard.php */
