<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Templates
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function load($data)
    {
        if ($_SESSION['id_otoritas'] == 1) $inc = 'sidebar_admin.php';

        $data['include_sidebar'] = $inc;

        $this->ci->load->view('templates/backend/main', $data);
    }
}

/* End of file LibraryName.php */