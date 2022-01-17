<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function index()
    {
        if (@$_SESSION['is_login']) {

            if ($_SESSION['id_otoritas'] == 1) $link = base_url('backend/admin/dashboard');

            redirect($link);
        }

        $data = [];
        $this->load->view('login/index', $data);
    }

    public function auth()
    {
        cek_post();

        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $this->db->where('username', $username);
        $this->db->where('password', sha1($password));
        $this->db->where('is_active', '1');
        $run = $this->db->get('dev_user')->row();

        if ($run) {

            $this->session->set_userdata([
                'is_login' => true,
                'id_akun' => $run->id,
                'id_otoritas' => $run->id_otoritas,
                'nama' => $run->nama,
                'foto' => $run->foto,
                'username' => $run->username,
            ]);

            if ($run->id_otoritas == 1) $link = base_url('backend/admin/dashboard');

            json([
                'status' => 'success',
                'msg' => 'Login berhasil',
                'link' => $link,
            ]);
        } else {
            json([
                'status' => 'failed',
                'msg' => 'pastikan username dan password sesuai !',
            ]);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}

/* End of file Login.php */
