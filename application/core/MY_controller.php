<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if (!@$_SESSION['is_login']) {
            redirect('login/logout');
        }

        $this->id_akun = $_SESSION['id_akun'];
        $this->id_otoritas = $_SESSION['id_otoritas'];
        $this->nama = $_SESSION['nama'];
        $this->username = $_SESSION['username'];
        $this->foto = $_SESSION['foto'];
    }
}

/* End of file MY_controller.php */
